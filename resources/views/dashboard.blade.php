@extends('layouts.app')
@section('content')

<div class=" py-4">
    <div class="row g-4 align-items-stretch">
        <div class="col-lg-8 d-flex">
            <div class="card small-card shadow-sm flex-fill">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Grafik Total Transaksi</h5>
                        <form method="GET" action="{{ route('dashboard') }}">
                            <select name="filter"  class="form-select form-select-sm" style="border-radius: 12px" onchange="this.form.submit()">
                                <option value="month" {{ $filter == 'month' ? 'selected' : '' }}>Per Bulan</option>
                                <option value="year" {{ $filter == 'year' ? 'selected' : '' }}>Per Tahun</option>
                            </select>
                        </form>
                    </div>
                    <canvas id="chartTransaksi" style="min-height: 300px; flex: 1;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4 d-flex flex-column justify-content-between">
            <div class="card small-card flex-fill mb-3">
                <div class="card-body card-content">
                    <div class="icon-circle">
                        <i class="fa-solid fa-users fa-2x icon-primary"></i>
                    </div>
                    <div class="card-text">
                        <h6 class="text-primary">Total Pelanggan</h6>
                        <h4 class="text-dark mb-0">{{ $totalPelanggan }}</h4>
                    </div>
                </div>
            </div>

            <div class="card small-card flex-fill mb-3">
                <div class="card-body card-content">
                    <div class="icon-circle">
                        <i class="fa-solid fa-coins fa-2x icon-success"></i>
                    </div>
                    <div class="card-text">
                        <h6 class="text-success">Total Transaksi</h6>
                        <h4 class="text-dark mb-0">{{ $totalTransaksi }}</h4>
                    </div>
                </div>
            </div>

            <div class="card small-card flex-fill">
                <div class="card-body card-content">
                    <div class="icon-circle">
                        <i class="fa-solid fa-star fa-2x icon-warning"></i>
                    </div>
                    <div class="card-text">
                        <h6 class="text-warning">Pelanggan Teraktif</h6>
                        <h5 class="text-dark mb-0">{{ $topPelanggan ?? '-' }}</h5>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible mt-4 fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card small-card shadow-sm mt-4">
        <div class="card-body">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 gap-2">
                <form method="GET" action="{{ route('dashboard') }}" 
                    class="d-flex flex-wrap flex-md-nowrap align-items-center">
                    <input type="text" 
                        name="search" 
                        class="form-control me-2 mb-2 mb-md-0" 
                        placeholder="Cari nama pelanggan..."
                        value="{{ $search }}" 
                        style="border-radius: 12px; min-width: 180px;">
                    <button class="btn btn-primary" style="border-radius: 12px;">Cari</button>
                </form>
                <div class="d-flex justify-content-md-end">
                    <a href="{{ route('transaksi.create') }}" 
                    class="btn btn-success w-100 w-md-auto" 
                    style="border-radius: 12px; min-width: 180px;">
                        + Tambah Transaksi
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-middle text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pelanggan</th>
                        <th>Email</th>
                        <th>Tanggal Transaksi</th>
                        <th>Total Transaksi</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi as $i => $t)
                        <tr>
                            <td>{{ $i + $transaksi->firstItem() }}</td>
                            <td>{{ $t->pelanggan->nama_pelanggan }}</td>
                            <td>{{ $t->pelanggan->email }}</td>
                            <td>{{ \Carbon\Carbon::parse($t->tanggal_transaksi)->format('d M Y') }}</td>
                            <td>Rp {{ number_format($t->total_transaksi, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('transaksi.edit', $t->id_transaksi) }}" class="btn btn-sm btn-warning me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('transaksi.destroy', $t->id_transaksi) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6">Tidak ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- <div class="d-flex justify-content-center"> --}}
                {{ $transaksi->appends(['search' => $search])->links() }}
            {{-- </div> --}}
        </div>
    </div>

</div>



<script>
    const ctx = document.getElementById('chartTransaksi');
    const chartData = @json($chartData);
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartData.map(item => item.label),
            datasets: [{
                label: 'Total Transaksi',
                data: chartData.map(item => item.total),
                backgroundColor: '#0d6efd'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
