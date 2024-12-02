<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin: 20px 0;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }

        button {
            display: inline-block;
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }

        .btn-danger {
            background-color: #e74c3c;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        /* Navbar Styling */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar a {
            color: #AA5486;
            text-decoration: none;
            margin: 0 15px;
            font-size: 18px;
            font-weight: 500;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .navbar form {
            margin: 0;
        }

        .logout-btn {
            background-color: #e74c3c;
            border: none;
            padding: 8px 15px;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        label {
            font-weight: bold;
        }

        input[type="file"] {
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .file-upload {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .file-upload button {
            width: auto;
        }

        /* Status messages */
        .status-message {
            font-size: 16px;
            margin-top: 20px;
        }

        .text-muted {
            color: #7f8c8d;
        }

        .text-success {
            color: #27ae60;
        }

        .text-danger {
            color: #e74c3c;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        <div>
            <a href="{{ route('user.dashboard') }}">Dashboard</a>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <!-- Dashboard Content -->
    <div class="container">
        <h2>User Dashboard</h2>
        <p>Welcome, <strong>{{ Auth::user()->name }}</strong>!</p>

        @if($booking && $booking->status == \App\Models\Booking::STATUS_BOOKING_PENDING)
            <p class="status-message text-muted">
                Booking Anda sedang dalam proses review. Kami akan memberi tahu Anda setelah proses selesai. Mohon tunggu konfirmasi dari kami.
            </p>
        
            @elseif($booking && $booking->status == \App\Models\Booking::STATUS_BOOKING_CONFIRMED)
    <p>Booking Anda sudah disetujui! Silakan lakukan pembayaran menggunakan rekening berikut:</p>
    
    <div>
        
        <!-- Display Rental Duration and Total Price -->
        <h3>Detail Pembayaran:</h3>
        <p>Durasi Sewa: {{ $lamaSewa }} bulan</p>
        <p>Harga Per Bulan: Rp {{ number_format($booking->kamar->harga, 0, ',', '.') }}</p>
        <p>Total Harga yang Harus Dibayar: Rp {{ number_format($totalHarga, 0, ',', '.') }}</p>
        <h3>Rekening Pembayaran:</h3>
        <ul>
            <li>BCA: 123-456-789</li>
            <li>Mandiri: 987-654-321</li>
            <li>BRI: 111-222-333</li>
        </ul>

        <div>
            <h3>QRIS Pembayaran:</h3>
            <img src="{{ asset('images/qris.png') }}" alt="QRIS Payment">
        </div>

        <h3>Download Surat Perjanjian:</h3>
        <a href="{{ asset('files/surat_perjanjian_rusunawa_undip.docx') }}" download>
            <button>Download Surat Perjanjian</button>
        </a>

        <h3>Upload Bukti Pembayaran dan Surat Perjanjian:</h3>
        <div class="file-upload">
            <form action="{{ route('upload.payment') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="payment_proof">Pilih file bukti pembayaran:</label>
                <input type="file" name="payment_proof" required>

                <label for="agreement_proof">Pilih file surat perjanjian:</label>
                <input type="file" name="agreement_proof" required>

                <button type="submit">Kirim Bukti Pembayaran dan Surat Perjanjian</button>
            </form>
        </div>

    </div>

        @elseif($booking && $booking->status == \App\Models\Booking::STATUS_BOOKING_CANCELED)
            <p class="status-message text-muted">
                Booking Anda ditolak. Kami mohon maaf atas ketidaknyamanan ini. Akun Anda akan dihapus, dan Anda bisa mendaftar ulang jika Anda masih berminat.
            </p>
            <form action="{{ route('delete.account') }}" method="POST">
                @csrf
                <button type="submit" class="btn-danger">Hapus Akun dan Daftar Ulang</button>
            </form>
        @elseif($booking && $booking->status == \App\Models\Booking::STATUS_PAYMENT_PENDING)
            <p class="status-message text-muted">
                Pembayaran Anda sedang dalam proses review. Kami akan segera memberi tahu Anda jika pembayaran Anda telah diterima atau ada tindakan lebih lanjut yang perlu dilakukan.
            </p>
        @elseif($booking && $booking->status == \App\Models\Booking::STATUS_PAYMENT_CONFIRMED)
            <p class="status-message text-success">Pembayaran Anda telah disetujui! Terima kasih telah melakukan pembayaran.</p>
            <p class="status-message ">Silakan datang pada tanggal yang sesuai untuk melakukan check in melalui kantor kami</p>
        @elseif($booking && $booking->status == \App\Models\Booking::DONE)
            @if(count($notifications) > 0)
                <div class="alert alert-info">
                    <ul>
                        @foreach($notifications as $notification)
                            <li>{{ $notification->message }}</li>
                        @endforeach
                    </ul>
                </div>
                <!-- Form for uploading payment proof -->
                <div class="mt-4">
                    <h4>Upload Bukti Pembayaran</h4>
                    <form action="{{ route('user.uploadPaymentProof') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="payment_proof">Pilih Bukti Pembayaran</label>
                            <input type="file" class="form-control" name="payment_proof" id="payment_proof" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            @elseif($booking && $booking->status == \App\Models\Booking::DONE)
                <p class="status-message text-success">
                    Status sewa anda telah aktif, lakukan pembayaran 1 minggu sebelum masa sewa anda habis. Kami akan memberikan notifikasi jika anda masuk ke masa pembayaran sewa. Terimakasih.
                </p>

            @endif
        @endif
    </div>
</body>

</html>
