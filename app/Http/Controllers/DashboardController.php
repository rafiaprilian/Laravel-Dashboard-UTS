<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'month');
        $search = $request->get('search', '');

        // Statistik
        $totalPelanggan = Pelanggan::count();
        $totalTransaksi = Transaksi::count();

        // Pelanggan paling sering transaksi
        $topPelanggan = Transaksi::select('t_pelanggan.nama_pelanggan', DB::raw('COUNT(*) as jumlah'))
            ->join('t_pelanggan', 't_transaksi.id_pelanggan', '=', 't_pelanggan.id_pelanggan')
            ->groupBy('t_pelanggan.nama_pelanggan')
            ->orderByDesc('jumlah')
            ->limit(1)
            ->value('nama_pelanggan');

        // Grafik transaksi per bulan / tahun
        $chartData = Transaksi::selectRaw(
            $filter === 'year' ?
                'YEAR(tanggal_transaksi) as label, SUM(total_transaksi) as total' :
                'MONTHNAME(tanggal_transaksi) as label, SUM(total_transaksi) as total'
        )
            ->groupBy('label')
            ->orderBy('label')
            ->get();

        // Daftar transaksi + search nama pelanggan
        $transaksi = Transaksi::with('pelanggan')
            ->whereHas('pelanggan', function($q) use ($search) {
                $q->where('nama_pelanggan', 'like', "%$search%");
            })
            ->orderByDesc('tanggal_transaksi')
            ->paginate(10);

        return view('dashboard', compact(
            'totalPelanggan', 'totalTransaksi',
            'topPelanggan', 'chartData', 'transaksi', 'search', 'filter'
        ));
    }
}
