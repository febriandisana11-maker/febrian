<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manajemen Toko Buah</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
        body { background-color: #f8fafc; color: #334155; display: flex; flex-direction: column; min-height: 100vh; }
        
        /* Navbar Admin */
        .navbar { background: #0f172a; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .navbar h2 { font-size: 18px; font-weight: 600; display: flex; align-items: center; gap: 10px; }
        .navbar h2 i { color: #38bdf8; }
        .nav-link { background: #334155; color: white; padding: 8px 15px; border-radius: 6px; text-decoration: none; font-size: 13px; transition: background 0.2s; }
        .nav-link:hover { background: #475569; }

        /* Container */
        .container { max-width: 1100px; margin: 40px auto; padding: 0 20px; width: 100%; flex: 1; }
        
        /* Alert */
        .alert { padding: 12px 20px; border-radius: 8px; margin-bottom: 25px; font-size: 14px; display: flex; align-items: center; gap: 10px; }
        .alert-success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }

        /* Card */
        .card { background: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); overflow: hidden; margin-bottom: 25px; }
        .card-header { background: #ffffff; padding: 20px 25px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; }
        .card-header h3 { font-size: 16px; font-weight: 600; color: #1e293b; display: flex; align-items: center; gap: 8px; }
        .card-header h3 i { color: #2563eb; }
        .card-body { padding: 25px; }

        /* Grid Form */
        .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
        @media(max-width: 768px) { .form-grid { grid-template-columns: 1fr; } }
        .form-group { margin-bottom: 15px; }
        .form-group.full { grid-column: span 2; }
        .form-group label { display: block; margin-bottom: 6px; font-size: 13px; font-weight: 500; color: #475569; }
        .form-control { width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 13px; outline: none; }
        .form-control:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1); }

        /* Tabel */
        .table-responsive { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 14px; }
        th { background: #f8fafc; color: #475569; font-weight: 600; padding: 14px 16px; border-bottom: 2px solid #e2e8f0; }
        td { padding: 14px 16px; border-bottom: 1px solid #f1f5f9; color: #334155; }
        tr:hover td { background: #f8fafc; }
        .badge { background: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 500; }

        /* Button */
        .btn { background: #2563eb; color: white; border: none; padding: 10px 16px; font-size: 13px; font-weight: 600; border-radius: 6px; cursor: pointer; transition: background 0.2s; display: inline-flex; align-items: center; gap: 6px; }
        .btn:hover { background: #1d4ed8; }
        .btn-success { background: #16a34a; }
        .btn-success:hover { background: #15803d; }

        .footer { text-align: center; padding: 20px; color: #94a3b8; font-size: 13px; border-top: 1px solid #e2e8f0; background: #ffffff; margin-top: auto; }
    </style>
</head>
<body>

    <!-- Navbar Admin -->
    <div class="navbar">
        <h2><i class="fa-solid fa-gauge-high"></i> Dashboard Admin - Toko Buah</h2>
        <a href="{{ route('buah.index') }}" class="nav-link"><i class="fa-solid fa-arrow-left"></i> Kembali ke Website Utama</a>
    </div>

    <div class="container">

        @if(session('success'))
            <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
        @endif

        <!-- Form Tambah Buah Baru -->
        <div class="card">
            <div class="card-header">
                <h3><i class="fa-solid fa-circle-plus"></i> Tambah Data Buah Baru</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.buah.store') }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nama Buah</label>
                            <input type="text" name="nama_buah" class="form-control" placeholder="Contoh: Mangga Harum Manis" required>
                        </div>
                        <div class="form-group">
                            <label>Harga per kg (Rp)</label>
                            <input type="number" name="harga" class="form-control" placeholder="Contoh: 25000" min="0" required>
                        </div>
                        <div class="form-group">
                            <label>Stok Awal (kg)</label>
                            <input type="number" name="stok" class="form-control" placeholder="Contoh: 40" min="0" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control" placeholder="Keterangan singkat buah...">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success" style="margin-top: 10px;">
                        <i class="fa-solid fa-save"></i> Simpan Buah Baru
                    </button>
                </form>
            </div>
        </div>

        <!-- Tabel Manajemen Stok -->
        <div class="card">
            <div class="card-header">
                <h3><i class="fa-solid fa-boxes-stacked"></i> Daftar & Tambah Stok Buah</h3>
            </div>
            <div class="card-body" style="padding: 0;">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Buah</th>
                                <th>Harga / kg</th>
                                <th>Stok Saat Ini</th>
                                <th>Deskripsi</th>
                                <th>Aksi Tambah Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($buahs as $index => $buah)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $buah->nama_buah }}</strong></td>
                                <td>Rp {{ number_format($buah->harga, 0, ',', '.') }}</td>
                                <td><span class="badge">{{ $buah->stok }} kg</span></td>
                                <td>{{ $buah->deskripsi }}</td>
                                <td>
                                    <form action="{{ route('admin.buah.updateStok', $buah->id) }}" method="POST" style="display: flex; gap: 8px; align-items: center;">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="tambah_stok" min="1" placeholder="Jumlah" class="form-control" style="width: 90px;" required>
                                        <button type="submit" class="btn">
                                            <i class="fa-solid fa-plus"></i> Tambah
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="footer">
        &copy; 2026 Panel Admin Toko Buah
    </div>

</body>
</html>     