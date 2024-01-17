<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductGallery;
use App\Models\ProductSpesification;
use App\Models\ProductVariation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class DashboardProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['galleries', 'category'])->where('user_id', Auth::user()->id)->get();
        return view('pages.dashboard-products', [
            'products' => $products
        ]);
    }

    public function details(string $id)
    {
        $categories = Category::get();
        $product = Product::with(['spesifications', 'variations'])->find($id);
        $spesifications = $product->spesifications;
        $variations = $product->variations;
        return view('pages.dashboard-products-details', [
            'product' => $product,
            'spesifications' => $spesifications,
            'variations' => $variations,
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $categories = Category::get();
        return view('pages.dashboard-products-create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'meta_keyword' => ['required'],
            'meta_description' => ['required'],
            'name' => ['required', 'min:3'],
            'price' => ['required', 'numeric'],
            'discon_price' => ['nullable', 'numeric'],
            'description' => ['required'],
            'category_id' => ['required'],
            'thumbnail' => ['required'],
            'kondisi' => ['required'],
        ]);


        DB::transaction(function () use ($request) {
            $product = auth()->user()->products()->create([
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'name' => $request->name,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'discon_price' => $request->discon_price,
                'slug' => Str::slug($request->name . '-' . now()->timestamp),
                'description' => $request->description,
                'link_youtube' => $request->link_youtube,
                'kondisi' => $request->kondisi,
                'size_s' => $request->size_s ? true : false,
                'size_m' => $request->size_m ? true : false,
                'size_l' => $request->size_l ? true : false,
                'size_xl' => $request->size_xl ? true : false,
                'size_xxl' => $request->size_xxl ? true : false,
            ]);
            if ($request->spesifications) {
                foreach ($request->spesifications as $spesification) {
                    $this->spesifications($spesification['id'] ?? null, $product->id, $spesification['name'], $spesification['description']);
                }
            }
            if ($request->variations) {
                foreach ($request->variations as $key => $variation) {
                    $this->variations($key, $variation['id'] ?? null, $product->id, $variation['name'], $variation['type'], $variation['price'], $variation['stok'], $variation['photos'] ?? null);
                }
            }
            foreach ($request->file('thumbnail') as $imagefile) {
                $name_pic = "product-" . Str::random(10) . '.' . $imagefile->extension();
                $pic = new ProductGallery();
                $imagefile->storeAs('public/assets/product', $name_pic);
                $pic->photos = 'assets/product/' . $name_pic;
                $pic->product_id = $product->id;
                $pic->save();
            };
        });

        return redirect(route('dashboard-product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'meta_keyword' => ['required'],
            'meta_description' => ['required'],
            'name' => ['required', 'min:3'],
            'price' => ['required', 'numeric'],
            'discon_price' => ['nullable', 'numeric'],
            'description' => ['required'],
            'category_id' => ['required'],
            'link_youtube' => ['required'],
        ]);

        $product->update([
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'discon_price' => $request->discon_price,
            'description' => $request->description,
            'link_youtube' => $request->link_youtube,
            'size_s' => $request->size_s ? true : false,
            'size_m' => $request->size_m ? true : false,
            'size_l' => $request->size_l ? true : false,
            'size_xl' => $request->size_xl ? true : false,
            'size_xxl' => $request->size_xxl ? true : false,
        ]);
        if ($request->spesifications) {
            foreach ($request->spesifications as $spesification) {
                $this->spesifications($spesification['id'], $product->id, $spesification['name'], $spesification['description']);
            }
        }
        if ($request->variations) {
            foreach ($request->variations as $key => $variation) {
                $validationResult = $this->variations($key, $variation['id'], $product->id, $variation['name'], $variation['type'], $variation['price'], $variation['stok'], $variation['photos'] ?? null);
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

        return redirect(route('dashboard-product'));
    }

    public function addImage(Request $request, Product $product)
    {
        $request->validate([
            'thumbnail' => ['required']
        ]);
        foreach ($request->file('thumbnail') as $imagefile) {
            $name_pic = "product-" . Str::random(10) . '.' . $imagefile->extension();
            $pic = new ProductGallery();
            $imagefile->storeAs('public/assets/product', $name_pic);
            $pic->photos = 'assets/product/' . $name_pic;
            $pic->product_id = $product->id;
            $pic->save();
        };

        return back();
    }

    public function deletephoto(string $id)
    {
        $photo = ProductGallery::find($id);
        File::delete('storage/' . $photo->photos);
        $photo->delete();
        return back();
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
}
