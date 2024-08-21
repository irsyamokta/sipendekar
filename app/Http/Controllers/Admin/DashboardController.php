<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExcelExportSDQ;
use App\Exports\ExcelExportSRQ;
use Illuminate\Http\Request;
use App\Models\GeneratePin;
use App\Models\InstrumenSDQ;
use App\Models\InstrumenSRQ;
use App\Models\SDQResponse;
use App\Models\SRQResponse;
use App\Models\Peserta;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $pin = GeneratePin::all()->sortDesc()->take(1);

        $participants = Peserta::where('created_at', '>=', Carbon::now()->subMonth())->get();

        $month = Carbon::now();
        $formatDate = $month->locale('id')->isoFormat('MMMM');

        $dataUsia = $participants->map(function ($participant) {
            return Carbon::parse($participant->tanggal_lahir)->age;
        });

        $totalParticipants = $participants->count();

        $usia_4_18 = $dataUsia->filter(function ($age) {
            return $age >= 4 && $age <= 18;
        })->count();

        $usia_18_keatas = $dataUsia->filter(function ($age) {
            return $age > 18;
        })->count();

        $usia_4_18_percentage = $totalParticipants ? round(($usia_4_18 / $totalParticipants) * 100, 2) : 0;
        $usia_18_keatas_percentage = $totalParticipants ? round(($usia_18_keatas / $totalParticipants) * 100, 2) : 0;

        return view('admin.dashboard.menu.dashboard', compact('pin', 'usia_4_18_percentage', 'usia_18_keatas_percentage', 'totalParticipants', 'formatDate'));
    }

    public function sdq()
    {
        return view('admin.dashboard.menu.sdq');
    }

    public function sdqFirst()
    {
        $data = InstrumenSDQ::where('kategori', '4-10 Tahun')->get();
        return view('admin.dashboard.menu.submenu-sdq-first', compact('data'));
    }
    public function sdqSecond()
    {
        $data = InstrumenSDQ::where('kategori', '11-17 Tahun')->get();
        return view('admin.dashboard.menu.submenu-sdq-second', compact('data'));
    }

    public function srq()
    {
        $data = InstrumenSRQ::all();
        return view('admin.dashboard.menu.srq', compact('data'));
    }

    public function report(Request $request)
    {
        $searchSDQ = $request->input('search_sdq');
        $startSDQ = $request->input('start_sdq');
        $endSDQ = $request->input('end_sdq');

        $searchSRQ = $request->input('search_srq');
        $startSRQ = $request->input('start_srq');
        $endSRQ = $request->input('end_srq');

        session()->flash('search_sdq', $searchSDQ);
        session()->flash('search_srq', $searchSRQ);
        session()->flash('start_sdq', $startSDQ);
        session()->flash('end_sdq', $endSDQ);
        session()->flash('start_srq', $startSRQ);
        session()->flash('end_srq', $endSRQ);

        if ($startSDQ && strlen($startSDQ) == 10 && preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $startSDQ)) {
            $start_date_sdq = Carbon::createFromFormat('m/d/Y', $startSDQ)->format('Y-m-d');
        } else {
            $start_date_sdq = null;
        }
        
        if ($endSDQ && strlen($endSDQ) == 10 && preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $endSDQ)) {
            $end_date_sdq = Carbon::createFromFormat('m/d/Y', $endSDQ)->format('Y-m-d');
        } else {
            $end_date_sdq = null;
        }

        if ($startSRQ && strlen($startSRQ) == 10 && preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $startSRQ)) {
            $start_date_srq = Carbon::createFromFormat('m/d/Y', $startSRQ)->format('Y-m-d');
        } else {
            $start_date_srq = null;
        }
        
        if ($endSRQ && strlen($endSRQ) == 10 && preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $endSRQ)) {
            $end_date_srq = Carbon::createFromFormat('m/d/Y', $endSRQ)->format('Y-m-d');
        } else {
            $end_date_srq = null;
        }

        $participantsSDQ = Peserta::whereHas('sdqResponses', function ($query) use ($searchSDQ, $start_date_sdq, $end_date_sdq) {
            $query->whereIn('test_type', ['SDQ 4-10 Tahun', 'SDQ 11-17 Tahun']);
            if ($start_date_sdq && $end_date_sdq) {
                $query->whereHas('participant', function ($query) use ($start_date_sdq, $end_date_sdq) {
                    $query->whereBetween('date', [$start_date_sdq, $end_date_sdq]);
                });
            }
            if ($searchSDQ) {
                $query->whereHas('participant', function ($query) use ($searchSDQ) {
                    $query->where('nama_lengkap', 'like', "%{$searchSDQ}%")
                        ->orWhere('alamat', 'like', "%{$searchSDQ}%")
                        ->orWhere('email', 'like', "%{$searchSDQ}%")
                        ->orWhere('nomor_hp', 'like', "%{$searchSDQ}%");
                });
            }
        })->paginate(10,  ['*'], 'sdq_page');

        $participantsSRQ = Peserta::whereHas('srqResponses', function ($query) use ($searchSRQ, $start_date_srq, $end_date_srq) {
            $query->where('test_type', 'SRQ');
            if ($start_date_srq && $end_date_srq) {
                $query->whereHas('participant', function ($query) use ($start_date_srq, $end_date_srq) {
                    $query->whereBetween('date', [$start_date_srq, $end_date_srq]);
                });
            }
            if ($searchSRQ) {
                $query->whereHas('participant', function ($query) use ($searchSRQ) {
                    $query->where('nama_lengkap', 'like', "%{$searchSRQ}%")
                        ->orWhere('alamat', 'like', "%{$searchSRQ}%")
                        ->orWhere('email', 'like', "%{$searchSRQ}%")
                        ->orWhere('nomor_hp', 'like', "%{$searchSRQ}%");
                });
            }
        })->paginate(10,  ['*'], 'srq_page');

        $tableDataSDQ = [];
        $tableDataSRQ = [];

        foreach ($participantsSDQ as $index => $participant) {
            $sdqResponses = SDQResponse::where('participant_id', $participant->id_peserta)
                                        ->whereIn('test_type', ['SDQ 4-10 Tahun', 'SDQ 11-17 Tahun'])
                                        ->get();

            if ($sdqResponses->isEmpty()) {
                continue;
            }

            $scores = [
                'E' => 0,
                'C' => 0,
                'H' => 0,
                'P' => 0,
                'Pro' => 0,
            ];

            foreach ($sdqResponses as $response) {
                if (isset($scores[$response->domain])) {
                    $scores[$response->domain] += $response->score;
                }
            }

            $totalKesulitan = $scores['E'] + $scores['C'] + $scores['H'] + $scores['P'];
            $totalKekuatan = $scores['Pro'];

            $usia = Carbon::parse($participant->tanggal_lahir)->age;

            $E = $this->interpretasiDomainE($usia, $scores['E']);
            $C = $this->interpretasiDomainC($usia, $scores['C']);
            $H = $this->interpretasiDomainH($usia, $scores['H']);
            $P = $this->interpretasiDomainP($usia, $scores['P']);
            $Pro = $this->interpretasiDomainPro($usia, $scores['Pro']);


            if ($usia < 11) {
                if ($totalKesulitan >= 0 && $totalKesulitan <= 13) {
                    $kesimpulan = 'Normal';
                } elseif ($totalKesulitan >= 14 && $totalKesulitan <= 16) {
                    $kesimpulan = 'Borderline';
                } elseif ($totalKesulitan >= 17 && $totalKesulitan <= 40) {
                    $kesimpulan = 'Case of Concern';
                }
            } else {
                if ($totalKesulitan >= 0 && $totalKesulitan <= 15) {
                    $kesimpulan = 'Normal';
                } elseif ($totalKesulitan >= 16 && $totalKesulitan <= 19) {
                    $kesimpulan = 'Borderline';
                } elseif ($totalKesulitan >= 20 && $totalKesulitan <= 40) {
                    $kesimpulan = 'Case of Concern';
                }
            }

            $tanggalPemeriksaan = $sdqResponses->first()->date;
            $parseDate = Carbon::parse($tanggalPemeriksaan);
            $formatDate = $parseDate->locale('id')->isoFormat('dddd, D MMMM YYYY');

            $tableDataSDQ[] = [
                'no' => $index + 1,
                'nama_lengkap' => $participant->nama_lengkap,
                'usia' => $usia,
                'jenis_kelamin' => $participant->jenis_kelamin,
                'alamat' => $participant->alamat,
                'kelurahan' => $participant->kelurahan,
                'kecamatan' => $participant->kecamatan,
                'kabupaten' => $participant->kabupaten,
                'email' => $participant->email,
                'no_hp' => $participant->nomor_hp,
                'jenis_tes' => $sdqResponses->first()->test_type ?? 'N/A',
                'skor_emosional' => $scores['E'],
                'skor_perilaku' => $scores['C'],
                'skor_hiperaktifitas' => $scores['H'],
                'skor_teman_sebaya' => $scores['P'],
                'total_skor_kesulitan' => $totalKesulitan,
                'total_skor_kekuatan' => $totalKekuatan,
                'kesimpulan' => $kesimpulan,
                'tanggal_pemeriksaan' => $formatDate,
                'E' => $E,
                'C' => $C,
                'H' => $H,
                'P' => $P,
                'Pro' => $Pro,
            ];
        }

        foreach ($participantsSRQ as $index => $participant) {
            $srqResponses = SRQResponse::where('participant_id', $participant->id_peserta)
                                        ->where('test_type', 'SRQ')
                                        ->get();

            $scores = [
                'SRQ' => 0,
            ];

            foreach ($srqResponses as $response) {
                $scores['SRQ'] += $response->score;
            }

            $usia = Carbon::parse($participant->tanggal_lahir)->age;
            $totalScore = $scores['SRQ'];

            if ($totalScore >= 8) {
                $kesimpulan = 'Butuh Dukungan Lebih Lanjut';
            } else {
                $kesimpulan = 'Tidak Butuh Dukungan Lebih Lanjut';
            }

            $tanggalPemeriksaan = $srqResponses->first()->date;
            $parseDate = Carbon::parse($tanggalPemeriksaan);
            $formatDate = $parseDate->locale('id')->isoFormat('dddd, D MMMM YYYY');

            $tableDataSRQ[] = [
                'no' => $index + 1,
                'nama_lengkap' => $participant->nama_lengkap,
                'usia' => $usia,
                'jenis_kelamin' => $participant->jenis_kelamin,
                'alamat' => $participant->alamat,
                'kelurahan' => $participant->kelurahan,
                'kecamatan' => $participant->kecamatan,
                'kabupaten' => $participant->kabupaten,
                'email' => $participant->email,
                'no_hp' => $participant->nomor_hp,
                'jenis_tes' => 'SRQ',
                'total_score' => $totalScore,
                'kesimpulan' => $kesimpulan,
                'tanggal_pemeriksaan' => $formatDate,
            ];
        }

        return view('admin.dashboard.menu.report', compact('tableDataSDQ', 'tableDataSRQ', 'participantsSDQ', 'participantsSRQ'));
    }

    private function interpretasiDomainE($usia, $score)
    {
        if ($usia <= 10) {
            if ($score <= 3) {
                return 'Skor ini mendekati rata-rata - kemungkinan besar tidak ada masalah signifikan secara klinis pada area ini';
            } elseif ($score == 4) {
                return 'Skor ini sedikit meningkat, yang mungkin mencerminkan masalah klinis yang signifikan';
            } else {
                return 'Skor ini tinggi - terdapat risiko besar terjadinya masalah klinis yang signifikan di bidang ini';
            }
        } else {
            if ($score <= 5) {
                return 'Skor ini mendekati rata-rata - kemungkinan besar tidak ada masalah signifikan secara klinis pada area ini';
            } elseif ($score == 6) {
                return 'Skor ini sedikit meningkat, yang mungkin mencerminkan masalah klinis yang signifikan';
            } else {
                return 'Skor ini tinggi - terdapat risiko besar terjadinya masalah klinis yang signifikan di bidang ini';
            }
        }
    }
    private function interpretasiDomainC($usia, $score)
    {
        if ($usia <= 10) {
            if ($score <= 2) {
                return 'Skor ini mendekati rata-rata - kemungkinan besar tidak ada masalah signifikan secara klinis pada area ini';
            } elseif ($score == 3) {
                return 'Skor ini sedikit meningkat, yang mungkin mencerminkan masalah klinis yang signifikan';
            } else {
                return 'Skor ini tinggi - terdapat risiko besar terjadinya masalah klinis yang signifikan di bidang ini';
            }
        } else {
            if ($score <= 3) {
                return 'Skor ini mendekati rata-rata - kemungkinan besar tidak ada masalah signifikan secara klinis pada area ini';
            } elseif ($score == 4) {
                return 'Skor ini sedikit meningkat, yang mungkin mencerminkan masalah klinis yang signifikan';
            } else {
                return 'Skor ini tinggi - terdapat risiko besar terjadinya masalah klinis yang signifikan di bidang ini';
            }
        }
    }
    private function interpretasiDomainH($usia, $score)
    {
        if ($usia <= 10) {
            if ($score <= 5) {
                return 'Skor ini mendekati rata-rata - kemungkinan besar tidak ada masalah signifikan secara klinis pada area ini';
            } elseif ($score == 6) {
                return 'Skor ini sedikit meningkat, yang mungkin mencerminkan masalah klinis yang signifikan';
            } else {
                return 'Skor ini tinggi - terdapat risiko besar terjadinya masalah klinis yang signifikan di bidang ini';
            }
        } else {
            if ($score <= 5) {
                return 'Skor ini mendekati rata-rata - kemungkinan besar tidak ada masalah signifikan secara klinis pada area ini';
            } elseif ($score == 6) {
                return 'Skor ini sedikit meningkat, yang mungkin mencerminkan masalah klinis yang signifikan';
            } else {
                return 'Skor ini tinggi - terdapat risiko besar terjadinya masalah klinis yang signifikan di bidang ini';
            }
        }
    }
    private function interpretasiDomainP($usia, $score)
    {
        if ($usia <= 10) {
            if ($score <= 2) {
                return 'Skor ini mendekati rata-rata - kemungkinan besar tidak ada masalah signifikan secara klinis pada area ini';
            } elseif ($score == 3) {
                return 'Skor ini sedikit meningkat, yang mungkin mencerminkan masalah klinis yang signifikan';
            } else {
                return 'Skor ini tinggi - terdapat risiko besar terjadinya masalah klinis yang signifikan di bidang ini';
            }
        } else {
            if ($score <= 3) {
                return 'Skor ini mendekati rata-rata - kemungkinan besar tidak ada masalah signifikan secara klinis pada area ini';
            } elseif ($score <= 5) {
                return 'Skor ini sedikit meningkat, yang mungkin mencerminkan masalah klinis yang signifikan';
            } else {
                return 'Skor ini tinggi - terdapat risiko besar terjadinya masalah klinis yang signifikan di bidang ini';
            }
        }
    }
    private function interpretasiDomainPro($usia, $score)
    {
        if ($usia <= 10) {
            if ($score >= 6 && $score <= 10) {
                return 'Skor ini mendekati rata-rata - kemungkinan besar tidak ada masalah signifikan secara klinis pada area ini';
            } elseif ($score == 5) {
                return 'Skor ini sedikit meningkat, yang mungkin mencerminkan masalah klinis yang signifikan';
            } else {
                return 'Skor ini tinggi - terdapat risiko besar terjadinya masalah klinis yang signifikan di bidang ini';
            }
        } else {
            if ($score >= 6 && $score <= 10) {
                return 'Skor ini mendekati rata-rata - kemungkinan besar tidak ada masalah signifikan secara klinis pada area ini';
            } elseif ($score == 5) {
                return 'Skor ini sedikit meningkat, yang mungkin mencerminkan masalah klinis yang signifikan';
            } else {
                return 'Skor ini tinggi - terdapat risiko besar terjadinya masalah klinis yang signifikan di bidang ini';
            }
        }
    }

    public function sdqDownloadExcel(Request $request)
    {
        $startDateSDQ = session('start_sdq');
        $endDateSDQ = session('end_sdq');
        $filename = 'Laporan_SDQ_' . Carbon::now()->format('d-m-Y') . '.xlsx';

        return Excel::download(new ExcelExportSDQ($startDateSDQ, $endDateSDQ), $filename);
    }
    public function srqDownloadExcel(Request $request)
    {
        $startDateSRQ = session('start_srq');
        $endDateSRQ = session('end_srq');
        $filename = 'Laporan_SRQ_' . Carbon::now()->format('d-m-Y') . '.xlsx';

        return Excel::download(new ExcelExportSRQ($startDateSRQ, $endDateSRQ), $filename);
    }

}
