<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        // Menggunakan metode getKategoriAll untuk mendapatkan data kategori
        $kategoriAll = Kategori::getKategoriAll();

        // Filter berdasarkan query pencarian
        if ($query) {
            $kategoriAll = $kategoriAll->filter(function ($item) use ($query) {
                return stripos($item->deskripsi, $query) !== false || stripos($item->kategori, $query) !== false;
            });
        }

        return view('kategori.index', compact('kategoriAll'));
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
            'deskripsi' => 'required',
            'kategori'  => 'required|in:M,A,BHP,BTHP' // Validasi jenis kategori
        ]);

        Kategori::create([
            'deskripsi' => $request->deskripsi,
            'kategori'  => $request->kategori
        ]);

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
        $akategori = [
            'blank' => 'Pilih Kategori',
            'M'     => 'Barang Modal',
            'A'     => 'Alat',
            'BHP'   => 'Bahan Habis Pakai',
            'BTHP'  => 'Bahan Tidak Habis Pakai'
        ];

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
            'kategori'  => 'required|in:M,A,BHP,BTHP' // Validasi jenis kategori
        ]);

        $rsetKategori = Kategori::find($id);

        $rsetKategori->update([
            'deskripsi' => $request->deskripsi,
            'kategori'  => $request->kategori,
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

        return redirect()->route('kategori.index')->with(['success' => 'Data Barang Berhasil Dihapus!']);
    }

    // Function untuk update API kategori
    function updateAPIKategori(Request $request, $kategori_id)
    {
        $kategori = Kategori::find($kategori_id);

        if (null == $kategori) {
            return response()->json(['status' => "kategori tidak ditemukan"]);
        }

        $kategori->deskripsi = $request->deskripsi;
        $kategori->kategori = $request->kategori;
        $kategori->save();

        return response()->json(["status" => "kategori berhasil diubah"]);
    }

    // Function untuk membuat index API
    function showAPIKategori(Request $request)
    {
        $kategori = Kategori::getKategoriAll(); // Mengambil data kategori dengan keterangan
        return response()->json($kategori);
    }

    // Function untuk create API
    function createAPIKategori(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required|string|max:100',
            'kategori' => 'required|in:M,A,BHP,BTHP',
        ]);

        $kat = Kategori::create([
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
        ]);

        return response()->json(["status" => "data berhasil dibuat"]);
    }

    // Function untuk delete API
    function deleteAPIKategori($kategori_id)
    {
        $del_kategori = Kategori::findOrFail($kategori_id);
        $del_kategori->delete();

        return response()->json(["status" => "data berhasil dihapus"]);
    }
}
