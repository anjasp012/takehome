<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Pengunjung;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index($slug)
    {
        $product = Product::with('galleries', 'user', 'variations')->whereSlug($slug)->firstOrFail();
        $galleries = $product->galleries;
        $variations = $product->variations;
        // dd($foto, $fotovariation);
        // dd($product->variationHigherPrice->price);
        $productSimilar = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->take(4)->get();
        return view('pages.detail', [
            'product' => $product,
            'galleries' => $galleries,
            'variations' => $variations,
            'productSimilar' => $productSimilar
        ]);
    }

    public function add(Request $request, $id)
    {
        $request->validate([
            'size' => ['required'],
            'variation' => ['required']
        ]);
        $data = [
            'product_id' => $id,
            'size' => $request->size,
            'variation_id' => $request->variation,
        ];
        Auth::user()->cart()->create($data);
        return redirect()->route('cart');
    }

    public function pengunjung(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'no_wa' => 'required',
            'no_hp' => 'required',
        ]);
        $data = [
            'product_id' => $id,
            'nama' => $request->nama,
            'email' => $request->email,
            'no_wa' => $request->no_wa,
            'no_hp' => $request->no_hp,
        ];
        Pengunjung::create($data);
        return back()->with('success', 'Terimakasih telah mengunjungi website kami. Selanjutnya team marketing kami akan mengirimkan pricelist kepada anda');
    }
}
