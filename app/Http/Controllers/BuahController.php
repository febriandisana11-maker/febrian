<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buah;
use App\Models\Transaksi;

class BuahController extends Controller
{
    // Menampilkan halaman utama katalog & transaksi pembeli
    public function index()
    {
        $buahs = Buah::all();
        $transaksis = Transaksi::with('buah')->latest()->get();
        return view('buah.index', compact('buahs', 'transaksis'));
    }

    // Menyimpan data transaksi pembelian
    public function store(Request $request)
    {
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'buah_id' => 'required|exists:buahs,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $buah = Buah::findOrFail($request->buah_id);

        if ($buah->stok < $request->jumlah) {
            return back()->with('error', 'Stok buah tidak mencukupi!');
        }

        $total_harga = $buah->harga * $request->jumlah;

        Transaksi::create([
            'nama_pembeli' => $request->nama_pembeli,
            'buah_id' => $request->buah_id,
            'jumlah' => $request->jumlah,
            'total_harga' => $total_harga,
        ]);

        $buah->stok -= $request->jumlah;
        $buah->save();

        return redirect()->back()->with('success', 'Transaksi berhasil diproses!');
    }

    // Menambah stok buah
    public function updateStok(Request $request, $id)
    {
        $request->validate([
            'tambah_stok' => 'required|integer|min:1',
        ]);

        $buah = Buah::findOrFail($id);
        $buah->stok += $request->tambah_stok;
        $buah->save();

        return redirect()->back()->with('success', 'Stok buah ' . $buah->nama_buah . ' berhasil ditambahkan!');
    }

    // --- TAMBAHKAN KEDUA METHOD DI BAWAH INI ---

    // Menampilkan halaman dashboard admin
    public function adminIndex()
    {
        $buahs = Buah::all();
        return view('buah.admin', compact('buahs'));
    }

    // Menyimpan data buah baru dari halaman admin
    public function storeBuah(Request $request)
    {
        $request->validate([
            'nama_buah' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        Buah::create([
            'nama_buah' => $request->nama_buah,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Buah baru berhasil ditambahkan ke katalog!');
    }
}