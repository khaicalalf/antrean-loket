<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Antrian;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    public function index()
    {
            $now = Carbon::now(); // Waktu sekarang
    
            // Format hari, tanggal, nama bulan, dan tahun
            $formattedDate = $now->translatedFormat('l, d F Y');
            $formattedTime = $now->format('H:i');
    
            // Menghitung jumlah antrian per jenis pasien untuk hari ini
            $tanggalHariIni = $now->format('Y-m-d');
            $antrianBPJS = Antrian::where('jenis_pasien', 'bpjs')
                                    ->whereDate('created_at', $tanggalHariIni)
                                    ->count();
    
            $antrianUmum = Antrian::where('jenis_pasien', 'umum')
                                    ->whereDate('created_at', $tanggalHariIni)
                                    ->count();
    
            $antrianOrthopedi = Antrian::where('poli', '7')
                                    ->whereDate('created_at', $tanggalHariIni)
                                    ->count();
    
            // Mendapatkan nomor antrian terakhir untuk setiap jenis pasien
            $nomorAntrianBPJS = $antrianBPJS > 0 ? $antrianBPJS : 0;
            $nomorAntrianUmum = $antrianUmum > 0 ? $antrianUmum : 0;
            $nomorAntrianOrthopedi = $antrianOrthopedi > 0 ? $antrianOrthopedi + 18 : 18; // Mulai dari 19 sesuai aturan
    
            return view('antrian.index', [
                'formattedDate' => $formattedDate,
                'formattedTime' => $formattedTime,
                'nomorAntrianBPJS' => $nomorAntrianBPJS,
                'nomorAntrianUmum' => $nomorAntrianUmum,
                'nomorAntrianOrthopedi' => $nomorAntrianOrthopedi,
            ]);
        
    }

    // public function ambilAntrian(Request $request)
    // {
    //     $jenisPasien = $request->input('jenis_pasien');
    //     $poli = $request->input('poli'); // Ambil poli dari form jika ada

    //     $antrian = Antrian::create([
    //         'jenis_pasien' => $jenisPasien,
    //         'poli' => $poli, // Simpan poli jika ada
    //     ]);

    //     return redirect()->route('antrian.index');
    // }

    public function ambilAntrian(Request $request)
    {
        $jenisPasien = $request->input('jenis_pasien');
        $poli = $request->input('poli');
        $now = Carbon::now();
        $currentTime = $now->format('H:i');

        // Batasi pengambilan antrian hanya pada jam 7 pagi hingga 12 siang
        if ($currentTime < '07:00' || $currentTime > '18:00') {
            return back()->with('error', 'Nomor antrian hanya bisa diambil dari jam 7 pagi hingga jam 12 siang.');
        }

        $hariIni = $now->isoFormat('dddd');
        $tanggalHariIni = $now->format('Y-m-d');
        if ($poli == 7) {
            if (!in_array($hariIni, ['Monday', 'Tuesday', 'Wednesday', 'Thursday'])) {
                return back()->with('error', 'Antrian orthopedi hanya tersedia pada hari Senin, Rabu, dan Kamis.');
            }

            $antrianOrthoCount = Antrian::where('poli', 7)->whereDate('created_at', $tanggalHariIni)->count();
            if ($antrianOrthoCount >= 27) {
                return back()->with('error', 'Antrian orthopedi sudah penuh.');
            }
            $nomorAntrian = Antrian::where('jenis_pasien', $jenisPasien)->whereDate('created_at', $tanggalHariIni)->max('nomor_antrian') + 1;
            $noAntrianPoli = $antrianOrthoCount + 19; // Mulai dari nomor 19
        } else {
            $nomorAntrian = Antrian::where('jenis_pasien', $jenisPasien)->whereDate('created_at', $tanggalHariIni)->max('nomor_antrian') + 1;
            $noAntrianPoli = null;
        }

        $antrian = Antrian::create([
            'jenis_pasien' => $jenisPasien,
            'poli' => $poli,
            'nomor_antrian' => $nomorAntrian,
            'no_antrian_poli' => $noAntrianPoli
        ]);

        // Mengarahkan ke halaman cetak bukti antrian
        return redirect()->route('cetak.antrian', $antrian->id);
    }

    public function cetakAntrian($id)
    {
        $antrian = Antrian::findOrFail($id);

        return view('antrian.cetak', compact('antrian'));
    }
}

