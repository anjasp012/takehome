<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CheckOngkirController extends Controller
{
    public function index()
    {
        $provinces = Province::pluck('name', 'province_id');
        return view('ongkir', compact('provinces'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities($id)
    {
        $city = Regency::where('province_id', $id)->pluck('name', 'city_id');
        return response()->json($city);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check_ongkir(Request $request)
    {
        // dd($request->all());
        $cost = RajaOngkir::ongkosKirim([
            'origin'        => 79, // ID kota/kabupaten asal
            'destination'   => $request->regency, // ID kota/kabupaten tujuan
            'weight'        => 250, // berat barang dalam gram
            'courier'       => $request->courier // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();


        return response()->json($cost[0]);
    }
}
