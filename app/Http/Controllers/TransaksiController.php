<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function create()
    {
        $pelanggan = Pelanggan::all();
        return view('transaksi.form', compact('pelanggan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pelanggan' => 'required|exists:t_pelanggan,id_pelanggan',
            'tanggal_transaksi' => 'required|date',
            'total_transaksi' => 'required|numeric|min:1',
        ]);

        Transaksi::create($validated);

        return redirect()->route('dashboard')->with('success', 'Data transaksi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $pelanggan = Pelanggan::all();
        return view('transaksi.edit', compact('transaksi', 'pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_pelanggan' => 'required|exists:t_pelanggan,id_pelanggan',
            'tanggal_transaksi' => 'required|date',
            'total_transaksi' => 'required|numeric|min:1',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($validated);

        return redirect()->route('dashboard')->with('success', 'Data transaksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('dashboard')->with('success', 'Data transaksi berhasil dihapus.');
    }
}
