<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\SDQResponse;
use App\Models\Peserta;
use Carbon\Carbon;

class ExcelExportSDQ implements FromView
{
    protected $startDateSDQ;
    protected $endDateSDQ;

    public function __construct($startDateSDQ, $endDateSDQ)
    {
        $this->startDateSDQ = $startDateSDQ;
        $this->endDateSDQ = $endDateSDQ;
    }
    
    public function view(): View
    {
        if ($this->startDateSDQ && strlen($this->startDateSDQ) == 10 && preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $this->startDateSDQ)) {
            $start_date_sdq = Carbon::createFromFormat('m/d/Y', $this->startDateSDQ)->format('Y-m-d');
        } else {
            $start_date_sdq = null;
        }
        
        if ($this->endDateSDQ && strlen($this->endDateSDQ) == 10 && preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $this->endDateSDQ)) {
            $end_date_sdq = Carbon::createFromFormat('m/d/Y', $this->endDateSDQ)->format('Y-m-d');
        } else {
            $end_date_sdq = null;
        }
        
        $participantsSDQ = Peserta::whereHas('sdqResponses', function ($query) use ($start_date_sdq, $end_date_sdq) {
            $query->whereIn('test_type', ['SDQ 4-10 Tahun', 'SDQ 11-17 Tahun']);
            if ($start_date_sdq && $end_date_sdq) {
                $query->whereHas('participant', function ($query) use ($start_date_sdq, $end_date_sdq) {
                    $query->whereBetween('date', [$start_date_sdq, $end_date_sdq]);
                });
            }
        })->get();

        $tableDataSDQ = [];

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
                } else {
                    $kesimpulan = 'Case of Consern';
                }
            } else {
                if ($totalKesulitan >= 0 && $totalKesulitan <= 15) {
                    $kesimpulan = 'Normal';
                } elseif ($totalKesulitan >= 16 && $totalKesulitan <= 19) {
                    $kesimpulan = 'Borderline';
                } else {
                    $kesimpulan = 'Case of Consern';
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
                'sekolah' => $participant->sekolah,
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

        return view('admin.dashboard.partials.tables.tables-sdq', [
            'tableDataSDQ' => $tableDataSDQ
        ]);
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
}
