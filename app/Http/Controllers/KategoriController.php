<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $rsetKategori = Kategori::all();
        return view('kategori.index',compact('rsetKategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'deskripsi'              => 'required',
            'kategori'              => 'required'
        ]);
        //upload image
        // $foto = $request->file('foto');
        // $foto->storeAs('public/foto', $foto->hashName());
        //create post
        Kategori::create([
            'deskripsi'              => $request->deskripsi,
            'kategori'              => $request->kategori
        ]);

        //redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rsetKategori = Kategori::find($id);
        return view('kategori.show', compact('rsetKategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $akategori = array(
        'blank' => 'Pilih Kategori',
        'M' => 'M',
        'A' => 'A',
        'BHP' => 'BHP',
        'BTHP' => 'BTHP'
    );

    $rsetKategori = Kategori::find($id);
    return view('kategori.edit', compact('rsetKategori', 'akategori'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $this->validate($request, [
        'deskripsi' => 'required',
        'kategori' => 'required',
    ]);

    $rsetKategori = Kategori::find($id);

    $rsetKategori->update([
        'deskripsi' => $request->deskripsi,
        'kategori' => $request->kategori,
        // other fields...
    ]);

    return redirect()->route('kategori.index')->with(['success' => 'Data Kategori Berhasil Diubah!']);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rsetKategori = Kategori::find($id);
        $rsetKategori->delete();

        //redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Barang Berhasil Dihapus!']);
    }
}
