<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f5f7fa; }
        .card {
            max-width: 600px;
            margin: 40px auto;
            border-radius: 15px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="card">
        <div class="card-body">
            <h4 class="mb-4 text-center fw-bold">Tambah Transaksi Baru</h4>

            <form method="POST" action="{{ route('transaksi.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="id_pelanggan" class="form-label">Pilih Pelanggan</label>
                    <select class="form-select" name="id_pelanggan" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($pelanggan as $p)
                            <option value="{{ $p->id_pelanggan }}">{{ $p->nama_pelanggan }}</option>
                        @endforeach
                    </select>
                    @error('id_pelanggan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                    <input type="date" class="form-control" name="tanggal_transaksi" required>
                    @error('tanggal_transaksi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="total_transaksi" class="form-label">Total Transaksi (Rp)</label>
                    <input type="number" step="0.01" class="form-control" name="total_transaksi" required>
                    @error('total_transaksi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
