<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Http\Requests\StorePendudukRequest;
use App\Http\Requests\UpdatePendudukRequest;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function total(Request $request)
    {
        $penduduk_total = Penduduk::with('kabupaten.provinsi')->where('name','like', '%'. $request['search'] .'%')->orWhere('nik','like', '%'. $request['search'] .'%')->filter(compact('request'))->count();

        $provinsi_total = $request['provinsi'] ? Provinsi::where('id', $request['provinsi'])->count() : Provinsi::count();

        $kabupaten_total = $request['provinsi'] ? ($request['kabupaten'] ? Kabupaten::where('id', $request['kabupaten'])->count() : Kabupaten::where('provinsi_id', $request['provinsi'])->count()) : Kabupaten::count();

        return compact('penduduk_total', 'provinsi_total', 'kabupaten_total');
    }
    public function api(Request $request)
    {
        $penduduks = Penduduk::with('kabupaten.provinsi')->orderBy('id', 'desc')->filter(compact('request'))->get();
        $datatables = datatables()->of($penduduks)->addIndexColumn()->editColumn('created_at', function(Penduduk $penduduk) {
            return convert_date($penduduk->created_at);
        })->editColumn('tgl_lahir', function(Penduduk $penduduk) {
            return date("j-m-Y", strtotime($penduduk->tgl_lahir));
        })->editColumn('address', function(Penduduk $penduduk) {
            return "{$penduduk->address}, Kab. {$penduduk->kabupaten->name}, Provinsi {$penduduk->kabupaten->provinsi->name}";
        })->make(true);
        return $datatables;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provinsis = Provinsi::all();
        $kabupatens = Kabupaten::all();

        // $provinsi_total = $provinsis->count();
        // $kabupaten_total = $kabupatens->count();
        // $penduduk_total = Penduduk::count();
        return view('dashboard', compact('provinsis','kabupatens'));
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
    public function store(StorePendudukRequest $request)
    {
        Penduduk::create($request->all());
        return redirect()->route('penduduk.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penduduk $penduduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penduduk $penduduk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePendudukRequest $request, Penduduk $penduduk)
    {
        $penduduk->update($request->all());
        return redirect()->route('penduduk.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();
    }
}
