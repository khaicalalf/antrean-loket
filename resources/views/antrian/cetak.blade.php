<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Nomor Antrian</title>
    <style>
        @media print {
            @page {
                size: 80mm 200mm;
                /* Ukuran kertas kecil */
                margin: 0;
                /* Margin kertas */
            }

            body {
                font-family: Arial, sans-serif;
                color:black;
                margin: 0;
                padding: 0;
                width: 80mm;
                /* Lebar kertas */
                height: 200mm;
                /* Tinggi kertas */
                background: none;
                /* Menghilangkan background default */
            }

            .container {
                width: 100%;
                height: 40%;
                padding: 10mm;
                box-sizing: border-box;
                position: relative;
                text-align: center;
                background-image: url('{{ asset('img/display-antrian.png') }}');
                /* Gambar background */
                background-size: cover;
                background-position: center;
                color: white;
                /* Warna teks kontras */
            }

            .header {
                margin-bottom: 15mm;
            }

            .header h2 {
                font-size: 12px;
                margin: 0;
            }

            .nomor-antrian {
                font-size: 24px;
                /* Ukuran font nomor antrian */
                font-weight: bold;
                margin-bottom: 15mm;
            }
            .poli{
                font-size: 16px;
                /* Ukuran font nomor antrian */
                font-weight: bold;
            }

            .footer {
                font-size: 10px;
                margin-top: 10mm;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <h2>Rumah Sakit Umum Daerah</h2>
            <h2>Dr. H. Mohamad Rabain</h2>
        </div>

        <!-- Nomor Antrian -->
        <div class="nomor-antrian">
            {{ strtoupper($antrian->jenis_pasien) }} {{ $antrian->nomor_antrian }}
            @if ($antrian->poli == 7) <br>
            <p class="poli">Orthopedi {{ $antrian->no_antrian_poli }}</p>
            @endif
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Terima kasih telah menunggu. Silakan menunggu panggilan.</p>
            <p>{{ now()->format('l, d F Y H:i') }}</p>
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print(); // Menampilkan dialog cetak secara otomatis
            window.onafterprint = function() {
                window.location.href = "{{ url('/') }}"; // Mengarahkan pengguna kembali ke halaman index setelah cetak selesai
            };
        };
    </script>
    

</body>

</html>
