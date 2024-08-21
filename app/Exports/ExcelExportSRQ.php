<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\SRQResponse;
use App\Models\Peserta;
use Carbon\Carbon;

class ExcelExportSRQ implements FromView
{
    protected $startDateSRQ;
    protected $endDateSRQ;

    public function __construct($startDateSRQ, $endDateSRQ)
    {
        $this->startDateSRQ = $startDateSRQ;
        $this->endDateSRQ = $endDateSRQ;
    }
    public function view(): View
    {
        if ($this->startDateSRQ && strlen($this->startDateSRQ) == 10 && preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $this->startDateSRQ)) {
            $start_date_srq = Carbon::createFromFormat('m/d/Y', $this->startDateSRQ)->format('Y-m-d');
        } else {
            $start_date_srq = null;
        }
        
        if ($this->endDateSRQ && strlen($this->endDateSRQ) == 10 && preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $this->endDateSRQ)) {
            $end_date_srq = Carbon::createFromFormat('m/d/Y', $this->endDateSRQ)->format('Y-m-d');
        } else {
            $end_date_srq = null;
        }

        $participantsSRQ = Peserta::whereHas('srqResponses', function ($query) use ($start_date_srq, $end_date_srq) {
            $query->where('test_type', 'SRQ');
            if ($start_date_srq && $end_date_srq) {
                $query->whereHas('participant', function ($query) use ($start_date_srq, $end_date_srq) {
                    $query->whereBetween('date', [$start_date_srq, $end_date_srq]);
                });
            }
        })->get();
        
        $tableDataSRQ = [];

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
                'email' => $participant->email,
                'kelurahan' => $participant->kelurahan,
                'kecamatan' => $participant->kecamatan,
                'kabupaten' => $participant->kabupaten,
                'no_hp' => $participant->nomor_hp,
                'jenis_tes' => 'SRQ',
                'total_score' => $totalScore,
                'kesimpulan' => $kesimpulan,
                'tanggal_pemeriksaan' => $formatDate,
            ];
        }
        return view('admin.dashboard.partials.tables.tables-srq', [
            'tableDataSRQ' => $tableDataSRQ
        ]);

    }
}
