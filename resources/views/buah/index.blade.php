<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Toko Buah - Sistem Penjualan</title>
    <!-- Google Fonts & FontAwesome untuk Ikon -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
        body { background-color: #f8fafc; color: #334155; display: flex; flex-direction: column; min-height: 100vh; }
        
        /* Navbar Portal */
        .navbar { background: #ffffff; border-bottom: 1px solid #e2e8f0; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .navbar h2 { color: #0f172a; font-size: 20px; font-weight: 700; display: flex; align-items: center; gap: 10px; }
        .navbar h2 i { color: #16a34a; }
        .user-profile { font-size: 14px; color: #64748b; background: #f1f5f9; padding: 8px 15px; border-radius: 20px; }

        /* Container Utama */
        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; width: 100%; flex: 1; }
        
        /* Alert Notifikasi */
        .alert { padding: 12px 20px; border-radius: 8px; margin-bottom: 25px; font-size: 14px; display: flex; align-items: center; gap: 10px; }
        .alert-success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .alert-danger { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

        /* Grid Layout Portal */
        .portal-grid { display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 25px; margin-bottom: 30px; }
        @media(max-width: 900px) { .portal-grid { grid-template-columns: 1fr; } }

        /* Card / Box Portal */
        .card { background: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); overflow: hidden; margin-bottom: 25px; }
        .card-header { background: #ffffff; padding: 20px 25px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; }
        .card-header h3 { font-size: 16px; font-weight: 600; color: #1e293b; display: flex; align-items: center; gap: 8px; }
        .card-header h3 i { color: #3b82f6; }
        .card-body { padding: 25px; }

        /* Tabel Modern */
        .table-responsive { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 14px; }
        th { background: #f8fafc; color: #475569; font-weight: 600; padding: 12px 16px; border-bottom: 2px solid #e2e8f0; }
        td { padding: 14px 16px; border-bottom: 1px solid #f1f5f9; color: #334155; }
        tr:hover td { background: #f8fafc; }
        .badge { background: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 500; }

        /* Form Styling */
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-size: 13px; font-weight: 500; color: #475569; }
        .form-control { width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; color: #1e293b; transition: all 0.2s; outline: none; }
        .form-control:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
        
        /* Tombol */
        .btn { background: #2563eb; color: white; border: none; padding: 12px 20px; font-size: 14px; font-weight: 600; border-radius: 8px; cursor: pointer; width: 100%; transition: background 0.2s; display: flex; justify-content: center; align-items: center; gap: 8px; }
        .btn:hover { background: #1d4ed8; }

        /* Footer */
        .footer { text-align: center; padding: 20px; color: #94a3b8; font-size: 13px; border-top: 1px solid #e2e8f0; background: #ffffff; margin-top: auto; }
    </style>
</head>
<body>

    <!-- Navbar Portal -->
    <div class="navbar">
        <h2><i class="fa-solid fa-store"></i> Portal Toko Buah</h2>
        <div class="user-profile"><i class="fa-regular fa-user"></i> Administrator</div>
    </div>

    <div class="container">

        <!-- Notifikasi Session -->
        @if(session('success'))
            <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger"><i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}</div>
        @endif

        <div class="portal-grid">
            <!-- Kolom Kiri: Katalog & Riwayat -->
            <div>
                <!-- Katalog Buah -->
                <!-- Katalog Buah -->
<div class="card">
    <div class="card-header">
        <h3><i class="fa-solid fa-boxes-stacked"></i> Katalog Stok Buah & Manajemen Admin</h3>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Buah</th>
                        <th>Harga / kg</th>
                        <th>Stok Tersedia</th>
                        <th>Deskripsi</th>
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
                           
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
            </div>

            <!-- Kolom Kanan: Form Transaksi -->
            <div>
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fa-solid fa-cash-register"></i> Input Transaksi Baru</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('buah.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Nama Pembeli</label>
                                <input type="text" name="nama_pembeli" class="form-control" placeholder="Masukkan nama pembeli..." required>
                            </div>
                            <div class="form-group">
                                <label>Pilih Buah</label>
                                <select name="buah_id" class="form-control" required>
                                    <option value="" disabled selected>-- Pilih Buah --</option>
                                    @foreach($buahs as $buah)
                                        @if($buah->stok > 0)
                                            <option value="{{ $buah->id }}">
                                                {{ $buah->nama_buah }} (Stok: {{ $buah->stok }} kg)
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Pembelian (kg)</label>
                                <input type="number" name="jumlah" class="form-control" min="1" placeholder="Contoh: 3" required>
                            </div>
                            <button type="submit" class="btn"><i class="fa-solid fa-cart-shopping"></i> Proses Transaksi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian Bawah: Riwayat Transaksi -->
        <div class="card">
            <div class="card-header">
                <h3><i class="fa-solid fa-clock-rotate-left"></i> Riwayat Transaksi Penjualan</h3>
            </div>
            <div class="card-body" style="padding: 0;">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pembeli</th>
                                <th>Buah yang Dibeli</th>
                                <th>Jumlah</th>
                                <th>Total Harga</th>
                                <th>Waktu Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksis as $index => $trx)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $trx->nama_pembeli }}</strong></td>
                                <td>{{ $trx->buah->nama_buah ?? 'Buah Dihapus' }}</td>
                                <td>{{ $trx->jumlah }} kg</td>
                                <td><strong>Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</strong></td>
                                <td>{{ $trx->created_at }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" style="text-align: center; color: #94a3b8; padding: 20px;">Belum ada data transaksi tercatat.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <div class="footer">
        &copy; 2026 Portal Toko Buah &bull; Dibangun dengan Laravel & Laragon
    </div>

</body>
</html>