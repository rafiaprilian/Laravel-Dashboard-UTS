<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card mx-auto" style="max-width:600px;">
        <div class="card-body">
            <h4 class="mb-4 text-center">Edit Transaksi</h4>

            <form method="POST" action="{{ route('transaksi.update', $transaksi->id_transaksi) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Pelanggan</label>
                    <select name="id_pelanggan" class="form-select" required>
                        @foreach($pelanggan as $p)
                            <option value="{{ $p->id_pelanggan }}" {{ $p->id_pelanggan == $transaksi->id_pelanggan ? 'selected' : '' }}>
                                {{ $p->nama_pelanggan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tanggal Transaksi</label>
                    <input type="date" class="form-control" name="tanggal_transaksi" value="{{ $transaksi->tanggal_transaksi }}" required>
                </div>

                <div class="mb-3">
                    <label>Total Transaksi (Rp)</label>
                    <input type="number" step="0.01" class="form-control" name="total_transaksi" value="{{ $transaksi->total_transaksi }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
