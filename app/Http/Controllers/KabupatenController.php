<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Http\Requests\StoreKabupatenRequest;
use App\Http\Requests\UpdateKabupatenRequest;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function api(Request $request)
    {
        $kabupatens = Kabupaten::with('provinsi')->filter(compact('request'))->get();
        $datatables = datatables()->of($kabupatens)->addIndexColumn()->editColumn('created_at', function(Kabupaten $kabupaten) {
            return convert_date($kabupaten->created_at);
        })->make(true);
        return $datatables;
    }
    public function index()
    {
        $provinsis = Provinsi::all();
        return view('kabupaten', compact('provinsis'));
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
    public function store(StoreKabupatenRequest $request)
    {
        Kabupaten::create($request->all());
        return redirect()->route('kabupaten.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kabupaten $kabupaten)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kabupaten $kabupaten)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKabupatenRequest $request, Kabupaten $kabupaten)
    {
        $kabupaten->update($request->all());
        return redirect()->route('kabupaten.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kabupaten $kabupaten)
    {
        $kabupaten->delete();
    }
}
