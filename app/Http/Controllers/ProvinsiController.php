<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Http\Requests\StoreProvinsiRequest;
use App\Http\Requests\UpdateProvinsiRequest;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function api(Request $request)
    {
        $provinsis = Provinsi::orderBy('id', 'desc')->get();
        $datatables = datatables()->of($provinsis)->addIndexColumn()->editColumn('created_at', function(Provinsi $provinsi) {
            return convert_date($provinsi->created_at);
        })->make(true);
        return $datatables;
    }
    
    public function index()
    {
        return view('provinsi');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProvinsiRequest $request)
    {
        Provinsi::create($request->all());
        return redirect()->route('provinsi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Provinsi $provinsi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provinsi $provinsi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProvinsiRequest $request, Provinsi $provinsi)
    {
        $provinsi->update($request->all());
        return redirect()->route('provinsi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provinsi $provinsi)
    {
        $provinsi->delete();
    }
}
