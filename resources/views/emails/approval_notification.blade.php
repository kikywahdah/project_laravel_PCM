<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $approved ? 'Akun Disetujui' : 'Akun Ditolak' }} - PCM Benowo</title>
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
            background: {{ $approved ? 'linear-gradient(135deg, #28a745 0%, #20c997 100%)' : 'linear-gradient(135deg, #dc3545 0%, #c82333 100%)' }};
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
        .icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: {{ $approved ? '#28a745' : '#6c757d' }};
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
        <div class="icon">
            {{ $approved ? '✅' : '❌' }}
        </div>
        <h2>{{ $approved ? 'Akun Anda Telah Disetujui!' : 'Akun Anda Ditolak' }}</h2>
        <p>Sistem PCM Benowo</p>
    </div>
    
    <div class="content">
        <p>Halo <strong>{{ $pengguna->nama_lengkap }}</strong>,</p>
        
        @if($approved)
            <p>🎉 Selamat! Akun Anda telah berhasil disetujui oleh admin sistem PCM Benowo.</p>
            
            <p>Anda sekarang dapat:</p>
            <ul>
                <li>✅ Login ke sistem menggunakan email dan password yang telah didaftarkan</li>
                <li>✅ Mengakses semua fitur yang tersedia</li>
                <li>✅ Mengelola data aset dan usaha</li>
                <li>✅ Melihat dashboard dan laporan</li>
            </ul>
            
            <a href="{{ route('login') }}" class="btn">🚀 Login Sekarang</a>
            
            <p><strong>Informasi Login:</strong></p>
            <ul>
                <li><strong>Email:</strong> {{ $pengguna->email }}</li>
                <li><strong>Password:</strong> Password yang Anda daftarkan saat registrasi</li>
            </ul>
            
        @else
            <p>Maaf, akun Anda tidak disetujui oleh admin sistem PCM Benowo.</p>
            
            <p>Hal ini dapat disebabkan oleh beberapa alasan:</p>
            <ul>
                <li>❌ Informasi yang tidak lengkap atau tidak valid</li>
                <li>❌ Email yang tidak sesuai dengan kebijakan sistem</li>
                <li>❌ Alasan keamanan atau kebijakan internal</li>
            </ul>
            
            <p>Jika Anda merasa ini adalah kesalahan, silakan:</p>
            <ul>
                <li>📧 Hubungi admin melalui email: <strong>rezkyfadliahwahdahh@gmail.com</strong></li>
                <li>📝 Daftar ulang dengan informasi yang lebih lengkap dan valid</li>
            </ul>
        @endif
        
        <hr style="margin: 20px 0; border: none; border-top: 1px solid #ddd;">
        
        <p><strong>Terima kasih telah tertarik bergabung dengan sistem PCM Benowo.</strong></p>
        
        @if($approved)
            <p>Kami berharap Anda dapat memanfaatkan sistem ini dengan baik untuk mengelola aset dan usaha Anda.</p>
        @else
            <p>Kami berharap dapat membantu Anda di lain kesempatan.</p>
        @endif
    </div>
    
    <div class="footer">
        <p>Email ini dikirim otomatis oleh sistem PCM Benowo</p>
        <p>Jangan balas email ini. Untuk bantuan, hubungi admin sistem.</p>
    </div>
</body>
</html>
