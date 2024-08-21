<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\InstrumenSDQ;
use App\Models\InstrumenSRQ;
use Illuminate\Http\Request;
use Str;

class MandiriController extends Controller
{
    public function inputUsia()
    {   
        return view('client.page.mandiri.page.input-usia');
    }

    public function checkUsia(Request $request)
    {
        $inputUsia = $request->input_usia;
        $token = Str::random(60);
        
        if($inputUsia >= 4){
            session()->put('usia', $inputUsia);
            session()->put('token', $token);
            return redirect()->route('mandiriQuestions', $token)->with('success');
        }else{
            return redirect()->back()->with('error', 'Ooppss... Minimal usia adalah 4 tahun!');
        }
    }

    public function questions(Request $request)
    {   
        $sdqQuestions = collect();
        $srqQuestions = collect();
        $token = $request->session()->get('token');
        $umur = $request->session()->get('usia');

        if(!$umur || !$token){
            return redirect()->route('inputUsia');
        }

        if ($umur >= 4 && $umur <= 10) {
            $sdqQuestions = InstrumenSDQ::where('kategori', '4-10 Tahun')->get();
        } elseif ($umur >= 11 && $umur <= 17) {
            $sdqQuestions = InstrumenSDQ::where('kategori', '11-17 Tahun')->get();
        } else {
            $srqQuestions = InstrumenSRQ::all();
        }

        return view('client.page.mandiri.page.questions', compact('sdqQuestions', 'srqQuestions', 'umur'));
    }

    public function response(Request $request){
        $umur = $request->session()->get('usia');
        $token = $request->session()->get('token');
        if (!$token || !$umur) {
            return redirect()->route('inputUsia');
        }
    
        $data = $request->all();
        
        if($umur <= 17){
            
            $results = [
                'E' => 0,
                'C' => 0, 
                'H' => 0, 
                'P' => 0, 
            ];
        
            foreach ($data as $key => $value) {
                if (strpos($key, 'sdq-') === 0) {
                    $urutan = explode('-', $key)[1];
                    $question = InstrumenSDQ::where('urutan', $urutan)->first();
                    
                    if ($question) {
                        $score = intval($value);
                        switch ($question->domain) {
                            case 'E':
                                $results['E'] += $score;
                                break;
                            case 'C':
                                $results['C'] += $score;
                                break;
                            case 'H':
                                $results['H'] += $score;
                                break;
                            case 'P':
                                $results['P'] += $score;
                                break;
                        }
                    }
                }
            }
        
            $totalDifficultyScore = $results['E'] + $results['C'] + $results['H'] + $results['P'];
    
            if ($umur < 11) {
                if ($totalDifficultyScore >= 0 && $totalDifficultyScore <= 13) {
                    $category = 'Normal';
                    $img = 'Normal';
                    $summary = 'Nilai normal menunjukkan bahwa anak atau remaja tersebut tidak memiliki masalah perilaku dan emosi yang signifikan. Kategori ini tidak memerlukan pemeriksaan lanjutan.';
                } elseif ($totalDifficultyScore >= 14 && $totalDifficultyScore <= 16) {
                    $category = 'Borderline';
                    $img = 'Borderline';
                    $summary = 'Nilai ambang (borderline) mengindikasikan bahwa anak atau remaja tersebut berpotensi mengalami masalah emosi dan perilaku. Kategori ini juga harus dianggap sebagai kasus yang membutuhkan pemeriksaan lanjutan.';
                } elseif ($totalDifficultyScore >= 17 && $totalDifficultyScore <= 40) {
                    $category = 'Case of Concern';
                    $img = 'Abnormal';
                    $summary = "Nilai case of concern menunjukkan adanya 'kasus' yang signifikan pada anak atau remaja dengan masalah perilaku dan emosi. Kategori ini memerlukan perhatian utama dan harus dilakukan pemeriksaan lanjutan.";
                }
            } else {
                if ($totalDifficultyScore >= 0 && $totalDifficultyScore <= 15) {
                    $category = 'Normal';
                    $img = 'Normal';
                    $summary = 'Nilai normal menunjukkan bahwa anak atau remaja tersebut tidak memiliki masalah perilaku dan emosi yang signifikan. Kategori ini tidak memerlukan pemeriksaan lanjutan.';
                } elseif ($totalDifficultyScore >= 16 && $totalDifficultyScore <= 19) {
                    $category = 'Borderline';
                    $img = 'Borderline';
                    $summary = 'Nilai ambang (borderline) mengindikasikan bahwa anak atau remaja tersebut berpotensi mengalami masalah emosi dan perilaku. Kategori ini juga harus dianggap sebagai kasus yang membutuhkan pemeriksaan lanjutan.';
                } elseif ($totalDifficultyScore >= 20 && $totalDifficultyScore <= 40) {
                    $category = 'Case of Concern';
                    $img = 'Abnormal';
                    $summary = "Nilai case of concern menunjukkan adanya 'kasus' yang signifikan pada anak atau remaja dengan masalah perilaku dan emosi. Kategori ini memerlukan perhatian utama dan harus dilakukan pemeriksaan lanjutan.";
                }
            }
        } else {
            $totalScoreSRQ = 0;
            foreach ($data as $key => $value) {
                if (strpos($key, 'srq-') === 0) {
                    $urutan = explode('-', $key)[1];
                    $question = InstrumenSRQ::where('urutan', $urutan)->first();
                    
                    if ($question) {
                        $score = intval($value);
                        $totalScoreSRQ += $score;
                    }
                }
            }

            if ($totalScoreSRQ >= 8) {
                $category = 'Butuh Dukungan Lebih Lanjut';
                $img = 'Psyco';
                $summary = 'Hasil menunjukkan bahwa Anda membutuhkan dukungan lebih lanjut.';
            } else {
                $category = 'Tidak Butuh Dukungan Lebih Lanjut';
                $img = 'Happy';
                $summary = 'Hasil menunjukkan bahwa Anda tidak membutuhkan dukungan lebih lanjut.';
            }
        }
        $request->session()->flush();
        return view('client.page.mandiri.page.result', compact('category', 'img', 'summary'));
    }
    
}
