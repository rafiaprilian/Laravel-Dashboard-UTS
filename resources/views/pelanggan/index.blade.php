@extends('layouts.app')
@section('content')
<div class="mt-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


     <div class="card small-card shadow-sm mt-4">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                 <h5 class="mb-0">Data Pelanggan</h5>
                <a href="{{ route('pelanggan.create') }}" class="btn btn-success" style="border-radius: 12px;">+ Tambah Transaksi</a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pelanggan as $i => $p)
                        <tr>
                           <td>{{ $i + $pelanggan->firstItem() }}</td>
                            <td>{{ $p->nama_pelanggan }}</td>
                            <td>{{ $p->email }}</td>
                            <td>{{ $p->no_hp }}</td>
                            <td>{{ $p->alamat }}</td>
                            <td>
                                <a href="{{ route('pelanggan.edit', $p->id_pelanggan) }}" class="btn btn-sm btn-warning me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('pelanggan.destroy', $p->id_pelanggan) }}" method="POST" style="display:inline;">
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

            {{ $pelanggan->links() }}
        </div>
    </div>

    
</div>
@endsection
