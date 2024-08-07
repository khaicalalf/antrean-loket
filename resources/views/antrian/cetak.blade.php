<head>
    <!-- Required meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content=''>
    <meta name='author' content=''>



    <!-- Bootstrap CSS -->
    @vite('resources/css/app.css')
</head>

<body style='font-family:Arial;width:auto;height:auto;margin:0;margin-left:0px;'>
    <div class='justify-content-left'>
        <div class='col-15'>
            <div class='col-2'>
                <div class='pt-2 text-center'>
                    <span style='font-weight:bold;font-size:13px;'>Rumah Sakit Umum Daerah</span>
                    <br />
                    <span style='font-weight:bold;font-size:14px;'>Dr. H. Mohamad Rabain</span>
                </div>

                <div style="text-align:center;border-bottom:solid;padding-bottom:1px">
                    <h5 style='font-size:12px;'>{{ now()->format('l, d F Y H:i') }}</h5>
                </div>

                <div style="text-align:center;border-bottom:solid;padding-bottom:1px;">
                    <h1 style='font-size:50px;' class='fw-bold text-center lh-1'>
                        {{ strtoupper($antrian->jenis_pasien) }} {{ $antrian->nomor_antrian }}
                        @if ($antrian->poli == 7)
                            <p style='font-size:16px;' class='pb-2'>Orthopedi {{ $antrian->no_antrian_poli }}</p>
                        @endif
                </div>


                <div class='text-center pt-1'>
                    <span style="font-size:10px;">Jalan Sultan Mahmud Badaruddin II No. 48</span>
                    <br />
                    <span style="text-center;font-size:10px;">Tlp. 0734-424345</span>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script>
        window.onload = function() {
            window.print(); // Menampilkan dialog cetak secara otomatis
            window.onafterprint = function() {
                window.location.href =
                    "{{ url('/') }}"; // Mengarahkan pengguna kembali ke halaman index setelah cetak selesai
            };
        };
    </script>
</body>
