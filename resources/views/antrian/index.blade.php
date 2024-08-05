<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengambilan Nomor Antrian</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-cover bg-center min-h-screen flex items-center justify-center"
    style="background-image: url('{{ asset('img/display-antrian.png') }}');">

    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto bg-white bg-opacity-90 shadow-2xl rounded-xl overflow-hidden backdrop-blur-lg">
            <div class="p-8">
                <h1 class="text-xl font-extrabold text-center text-gray-900 mb-2">Loket Nomor Antrian</h1>
                <h1 class="text-2xl font-extrabold text-center text-gray-900 mb-2">Rumah Sakit Umum Daerah</h1>
                <h1 class="text-2xl font-extrabold text-center text-gray-900 mb-8">Dr. H. Mohamad Rabain Muara Enim</h1>

                <!-- Menampilkan Waktu dan Tanggal -->
                <div class="text-center mb-12">
                    <p class="text-lg font-medium text-gray-700">
                        {{ $formattedDate }} | {{ $formattedTime }} WIB
                    </p>
                </div>
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif
                <!-- Grid Layout untuk Kolom Kiri dan Kanan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Kolom Kiri (BPJS dan Orthopedi BPJS) -->
                    <div>
                        <div class="space-y-4">
                            <!-- Antrian BPJS -->
                            <form action="{{ route('ambil.antrian') }}" method="POST">
                                @csrf
                                <input type="hidden" name="jenis_pasien" value="bpjs">
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 rounded-lg shadow-md transition duration-300 flex items-center justify-between px-6 my-6">
                                    <span>Ambil Antrian BPJS</span>
                                    <span class="bg-blue-500 py-1 px-3 rounded-lg text-sm font-bold">{{ $nomorAntrianBPJS }}</span>
                                </button>
                            </form>

                            <!-- Antrian Orthopedi BPJS -->
                            <form action="{{ route('ambil.antrian') }}" method="POST">
                                @csrf
                                <input type="hidden" name="jenis_pasien" value="bpjs">
                                <input type="hidden" name="poli" value="7">
                                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-4 rounded-lg shadow-md transition duration-300 flex items-center justify-between px-6 my-6">
                                    <span>Ambil Antrian Orthopedi BPJS</span>
                                    <span class="bg-purple-500 py-1 px-3 rounded-lg text-sm font-bold">{{ $nomorAntrianOrthopedi }}</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Kolom Kanan (Umum dan Orthopedi Umum) -->
                    <div>
                        <div class="space-y-4">
                            <!-- Antrian Umum -->
                            <form action="{{ route('ambil.antrian') }}" method="POST">
                                @csrf
                                <input type="hidden" name="jenis_pasien" value="umum">
                                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-4 rounded-lg shadow-md transition duration-300 flex items-center justify-between px-6 my-6">
                                    <span>Ambil Antrian Umum</span>
                                    <span class="bg-green-500 py-1 px-3 rounded-lg text-sm font-bold">{{ $nomorAntrianUmum }}</span>
                                </button>
                            </form>

                            <!-- Antrian Orthopedi Umum -->
                            <form action="{{ route('ambil.antrian') }}" method="POST">
                                @csrf
                                <input type="hidden" name="jenis_pasien" value="umum">
                                <input type="hidden" name="poli" value="7">
                                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-4 rounded-lg shadow-md transition duration-300 flex items-center justify-between px-6 my-6">
                                    <span>Ambil Antrian Orthopedi Umum</span>
                                    <span class="bg-red-500 py-1 px-3 rounded-lg text-sm font-bold">{{ $nomorAntrianOrthopedi}}</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/app.js')
</body>
</html>
