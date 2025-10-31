@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="card mx-auto" style="max-width:600px;">
        <div class="card-body">
            <h4 class="mb-4 text-center">{{ isset($pelanggan) ? ' Edit Pelanggan' : ' Tambah Pelanggan' }}</h4>

            <form method="POST" action="{{ isset($pelanggan) ? route('pelanggan.update', $pelanggan->id_pelanggan) : route('pelanggan.store') }}">
                @csrf
                @if(isset($pelanggan)) @method('PUT') @endif

                <div class="mb-3">
                    <label>Nama Pelanggan</label>
                    <input type="text" class="form-control" name="nama_pelanggan" value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email', $pelanggan->email ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label>No HP</label>
                    <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp', $pelanggan->no_hp ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea class="form-control" name="alamat" rows="3" required>{{ old('alamat', $pelanggan->alamat ?? '') }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
