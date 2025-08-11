<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Permintaan Persetujuan Akun - PCM Benowo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #0066cc 0%, #0052a3 100%);
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 0 0 8px 8px;
        }
        .user-info {
            background: white;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
            border-left: 4px solid #0066cc;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #0066cc;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 15px 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>🔐 Permintaan Persetujuan Akun Baru</h2>
        <p>Sistem PCM Benowo</p>
    </div>
    
    <div class="content">
        <p>Halo Super Admin,</p>
        
        <p>Ada permintaan pendaftaran akun baru yang memerlukan persetujuan Anda:</p>
        
        <div class="user-info">
            <h4>📋 Informasi Pengguna:</h4>
            <p><strong>Nama Lengkap:</strong> {{ $pengguna->nama_lengkap }}</p>
            <p><strong>Email:</strong> {{ $pengguna->email }}</p>
            <p><strong>Tanggal Registrasi:</strong> {{ $pengguna->tanggal_dibuat->format('d/m/Y H:i') }}</p>
        </div>
        
        <p>Silakan review informasi di atas dan tentukan apakah akun ini dapat disetujui atau ditolak.</p>
        
        <a href="{{ $approvalUrl }}" class="btn">🔍 Review & Setujui Akun</a>
        
        <p><small>Link ini akan mengarahkan Anda ke halaman admin untuk melakukan review dan persetujuan.</small></p>
        
        <hr style="margin: 20px 0; border: none; border-top: 1px solid #ddd;">
        
        <p><strong>Catatan:</strong></p>
        <ul>
            <li>Hanya akun yang disetujui yang dapat login ke sistem</li>
            <li>Akun yang ditolak akan otomatis dihapus dari database</li>
            <li>Pengguna akan menerima notifikasi email setelah keputusan Anda</li>
        </ul>
    </div>
    
    <div class="footer">
        <p>Email ini dikirim otomatis oleh sistem PCM Benowo</p>
        <p>Jangan balas email ini. Gunakan link di atas untuk melakukan review.</p>
    </div>
</body>
</html>
