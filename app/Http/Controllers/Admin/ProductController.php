<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSpesification;
use App\Models\ProductVariation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Product::with('user', 'category');
            return DataTables::of($query)
                ->addColumn('favorite', function ($item) {
                    return '
                    <form id="favoriteForm-' . $item->id . '" action="' . route("product.updateFavorite", $item->id) .  '" method="POST">
                        ' . method_field('PUT') . csrf_field() . '
                        <div class="form-check form-switch">
                            <input name="favorite" class="form-check-input" type="checkbox" role="switch" id="favoriteToggle-' . $item->id . '" ' . ($item->favorite ? "checked" : "") . ' onclick="submitForm(' . $item->id . ')">
                        </div>
                    </form>
                    <script>
                        function submitForm(itemId) {
                            document.getElementById("favoriteForm-" + itemId).submit();
                        }
                    </script>
                ';
                })
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-bs-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a href="' . route('product.edit', $item->id) .  '" class="dropdown-item">Sunting</a>
                                    <form action="' . route("product.destroy", $item->id) .  '" method="POST">
                                        ' . method_field('DELETE') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['favorite', 'action'])
                ->make();
        }

        return view('pages.admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('store_status', true)->get();
        $categories = Category::all();
        return view('pages.admin.product.create', [
            'categories' => $categories,
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name . '-' . now()->timestamp);
        $data['size_s'] = $request->size_s ? true : false;
        $data['size_m'] = $request->size_m ? true : false;
        $data['size_l'] = $request->size_l ? true : false;
        $data['size_xl'] = $request->size_xl ? true : false;
        $data['size_xxl'] = $request->size_xxl ? true : false;

        // dd($request->spesifications);
        $product = Product::create($data);
        if ($request->spesifications) {
            foreach ($request->spesifications as $spesification) {
                $this->spesifications(@$spesification['id'], $product->id, $spesification['name'], $spesification['description']);
            }
        }
        if ($request->variations) {
            foreach ($request->variations as $key => $variation) {
                $validationResult = $this->variations($key, @$variation['id'], $product->id, $variation['name'], $variation['type'], $variation['price'], $variation['stok'], $variation['photos'] ?? null);
                if ($validationResult != null && $validationResult->fails()) {
                    return redirect()->back()->withErrors($validationResult)->withInput();
                }
            }
        }

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Product::with(['spesifications', 'variations'])->findOrFail($id);
        $spesifications = $item->spesifications;
        $variations = $item->variations;
        $users = User::where('store_status', true)->get();
        $categories = Category::all();
        return view('pages.admin.product.edit', [
            'item' => $item,
            'spesifications' => $spesifications,
            'variations' => $variations,
            'categories' => $categories,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $item = Product::findOrFail($id);
        $data = $request->all();
        // dd($data);

        $data['slug'] = Str::slug($request->name . '-' . now()->timestamp);
        $data['size_s'] = $request->size_s ? true : false;
        $data['size_m'] = $request->size_m ? true : false;
        $data['size_l'] = $request->size_l ? true : false;
        $data['size_xl'] = $request->size_xl ? true : false;
        $data['size_xxl'] = $request->size_xxl ? true : false;

        $item->update($data);
        if ($request->spesifications) {
            foreach ($request->spesifications as $spesification) {
                $this->spesifications($spesification['id'], $id, $spesification['name'], $spesification['description']);
            }
        }
        if ($request->variations) {
            foreach ($request->variations as $key => $variation) {
                $validationResult = $this->variations($key, $variation['id'], $id, $variation['name'], $variation['type'], $variation['price'], $variation['stok'], $variation['photos'] ?? null);
                if ($validationResult != null && $validationResult->fails()) {
                    return redirect()->back()->withErrors($validationResult)->withInput();
                }
            }
        }
        if ($request->spesificationDelete) {
            ProductSpesification::whereIn('id', $request->spesificationDelete)->delete();
        }
        if ($request->variationDelete) {
            ProductVariation::whereIn('id', $request->variationDelete)->delete();
        }

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Product::findOrFail($id);
        $item->spesifications()->delete();
        $item->variations()->delete();
        $galeries = $item->galleries()->get()->pluck('photos');
        foreach ($galeries as $galery) {
            File::delete('storage/' . $galery);
        }
        $item->galleries()->delete();
        $item->delete();

        return redirect()->back();
    }

    public function spesifications($id = null, $product_id, $name,  $description)
    {
        ProductSpesification::updateOrCreate(['id' => $id], [
            'product_id' => $product_id,
            'name' => $name,
            'description' => $description,
        ]);
    }

    public function variations($key, $id = null, $product_id, $name, $type, $price, $stok, $photos)
    {
        // dd($photos);
        if ($photos) {
            $validator = Validator::make(
                ['variations[' . $key . '][photos]' => $photos],
                ['variations[' . $key . '][photos]' => 'file|mimes:jpeg,png,pdf|max:1024'],
                [
                    'variations*.required' => 'The Photos field is required.',
                    'variations*.max' => 'The Photos may not be greater than :max kilobytes.',
                    'variations*.mimes' => 'The Photos must be a JPEG, PNG, or PDF file.'
                ]
            );
            // dd($validator);

            if ($validator->fails()) {
                // Validation failed
                return $validator;
            }
        }
        if ($id != null) {
            $variation = ProductVariation::find($id);
            $variation->update(
                [
                    'product_id' => $product_id,
                    'name' => $name,
                    'type' => $type,
                    'price' => $price,
                    'stok' => $stok,
                    'photos' => $photos != null ? $photos->store('assets/productVariation', 'public') : $variation->photos,
                ]
            );
        } else {
            ProductVariation::create(
                [
                    'product_id' => $product_id,
                    'name' => $name,
                    'type' => $type,
                    'price' => $price,
                    'stok' => $stok,
                    'photos' => $photos != null ? $photos->store('assets/productVariation', 'public') : null,
                ]
            );
        }
    }

    public function updateFavorite(Request $request, $id)
    {
        $product = Product::find($id);
        if ($request->favorite == 'on') {
            $product->update([
                'favorite' => true,
            ]);
        } else {
            $product->update([
                'favorite' => false,
            ]);
        }

        return back();
    }
}
