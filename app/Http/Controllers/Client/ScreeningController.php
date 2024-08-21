<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneratePin;
use App\Models\InstrumenSDQ;
use App\Models\InstrumenSRQ;
use App\Models\SDQResponse;
use App\Models\SRQResponse;
use App\Models\DaftarPuskesmas;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Mail\TestResultMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Peserta;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ScreeningController extends Controller
{
    public function inputPin()
    {   
        return view('client.page.screening.page.input-pin');
    }

    public function checkPin(Request $request)
    {
        $latestPinRecord = GeneratePin::orderBy('created_at', 'desc')->first();
        $latestPin = $latestPinRecord ? $latestPinRecord->pin : null;
        $pinInput = $request->input_pin;
        
        if($latestPin && $latestPin === $pinInput && $latestPinRecord->status === 'active'){
            $request->session()->regenerate();
            return redirect()->route('formData')->with('success', 'PIN yang anda masukkan sesuai');
        }else{
            return redirect()->back()->with('error', 'Ooppss... Pin yang Anda masukkan salah!');
        }
    }

    public function formData(Request $request)
    {   
        session()->flash('success');
        return view('client.page.screening.page.input-data');
    }

    public function inputData(Request $request)
    {
        try{
            $request->validate([
                'nama_lengkap' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[a-zA-Z\s]+$/', 
                ],
                'tanggal_lahir' => 'required|string',
                'jenis_kelamin' => 'required|string',
                'nomor_hp' => [
                    'required',
                    'string',
                    'max:15',
                    'regex:/^[0-9]+$/', 
                ],
                'email' => 'required|email|max:255',
                'alamat' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s,.\-\/]+$/',
                'kelurahan' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[a-zA-Z\s]+$/',
                ],
                'kecamatan' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[a-zA-Z\s]+$/', 
                ],
                'kabupaten' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[a-zA-Z\s]+$/', 
                ],
            ],[
                'nama_lengkap.regex' => 'Nama lengkap hanya boleh mengandung huruf dan spasi.',
                'jenis_kelamin' => 'Jenis kelamin harus dipilih.',
                'nomor_hp.regex' => 'Nomor hp hanya boleh mengandung angka.',
                'kelurahan.regex' => 'Kelurahan hanya boleh mengandung huruf dan spasi.',
                'kecamatan.regex' => 'Kecamatan hanya boleh mengandung huruf dan spasi.',
                'kabupaten.regex' => 'Kabupaten hanya boleh mengandung huruf dan spasi.',
            ]);
    
            $tanggalLahir = new \DateTime($request->tanggal_lahir);
            $today = new \DateTime();
            $interval = $today->diff($tanggalLahir);
            $umur = $interval->y;
    
            if ($umur < 4) {
                session()->keep('success');
                return redirect()->back()->withErrors([
                    'tanggal_lahir' => 'Umur peserta minimal 4 tahun.',
                ])->withInput();
            }

            $peserta = new Peserta();
            $peserta->nama_lengkap = $request->nama_lengkap;
            $peserta->tanggal_lahir = $request->tanggal_lahir;
            $peserta->jenis_kelamin = $request->jenis_kelamin;
            $peserta->nomor_hp = $request->nomor_hp;
            $peserta->email = $request->email;
            $peserta->alamat = $request->alamat;
            $peserta->kelurahan = $request->kelurahan;
            $peserta->kecamatan = $request->kecamatan;
            $peserta->kabupaten = $request->kabupaten;
            $peserta->token = Str::random(60);

            $peserta->save();
            $request->session()->put('token', $peserta->token);
            $request->session()->regenerate();
            session()->keep('success');
            return redirect()->route('screeningQuestions', $peserta->token)->with('success', 'Berhasil mengisi data diri');

        }catch(\Illuminate\Validation\ValidationException $e){
            session()->keep('success');
            return redirect()->back()->withErrors($e->errors())->withInput();
        }catch(Exception $e){
            session()->keep('success');
            return redirect()->back()->withErrors([
                'general' => 'Terjadi kesalahan saat memproses data. Silakan coba lagi.',
            ])->withInput();
        }
    }

    public function questions(Request $request)
    {   
        session()->keep('success');
        $token = $request->session()->get('token');
        if (!$token) {
            abort(403, 'Unauthorized access');
        }

        $peserta = Peserta::where('token', $token)->first();

        if (!$peserta || $peserta->token != $token) {
            abort(403, 'Unauthorized access');
        }

        $tanggalLahir = $peserta->tanggal_lahir;
        $tanggalLahirCarbon = Carbon::createFromFormat('d/m/Y', $tanggalLahir);
        $umur = $tanggalLahirCarbon->age;

        $sdqQuestions = collect();
        $srqQuestions = collect();

        if ($umur >= 4 && $umur <= 10) {
            $sdqQuestions = InstrumenSDQ::where('kategori', '4-10 Tahun')->get();
        } elseif ($umur >= 11 && $umur <= 17) {
            $sdqQuestions = InstrumenSDQ::where('kategori', '11-17 Tahun')->get();
        } else {
            $srqQuestions = InstrumenSRQ::all();
        }

        return view('client.page.screening.page.questions', compact('sdqQuestions', 'srqQuestions', 'umur'));
    }

    public function sdqResponse(Request $request){
        session()->keep('success');
        $token = $request->session()->get('token');
        if (!$token) {
            abort(403, 'Unauthorized access');
        }

        $participant = Peserta::where('token', $token)->first();

        if (!$participant) {
            abort(403, 'Unauthorized access');
        }

        $data = $request->all();
        $testType = $request->input('test_type');
        
        foreach ($data as $key => $value) {
            if (strpos($key, 'sdq-') === 0) {
                $urutan = explode('-', $key)[1];
                $question = InstrumenSDQ::where('urutan', $urutan)->first();
                
                if ($question) {
                    SDQResponse::create([
                        'participant_id' => $participant->id_peserta,
                        'question_id' => $question->id_sdq,
                        'score' => $value,
                        'test_type' => $testType,
                        'domain' => $question->domain,
                        'date' => Carbon::now()->format('Y-m-d'),
                    ]);
                }
            }
        }
        $request->session()->forget('success');
        return redirect()->route('result', $participant->token)->with('done', 'Responses saved successfully');
    }
    public function srqResponse(Request $request){
        session()->keep('success');
        $token = $request->session()->get('token');
        if (!$token) {
            abort(403, 'Unauthorized access');
        }

        $participant = Peserta::where('token', $token)->first();

        if (!$participant) {
            abort(403, 'Unauthorized access');
        }

        $data = $request->all();
        $testType = $request->input('test_type');
        
        foreach ($data as $key => $value) {
            if (strpos($key, 'srq-') === 0) {
                $urutan = explode('-', $key)[1];
                $question = InstrumenSRQ::where('urutan', $urutan)->first();
                
                if ($question) {
                    SRQResponse::create([
                        'participant_id' => $participant->id_peserta,
                        'question_id' => $question->id_srq,
                        'test_type' => $testType,
                        'score' => $value,
                        'date' => Carbon::now()->format('Y-m-d'),
                    ]);
                }
            }
        }
        
        $request->session()->forget('success');
        return redirect()->route('result', $participant->token)->with('done', 'Responses saved successfully');
    }

    public function result(Request $request){
        $token = $request->session()->get('token');
        if (!$token) {
            abort(403, 'Unauthorized access');
        }

        $participant = Peserta::where('token', $token)->first();

        if (!$participant) {
            abort(403, 'Unauthorized access');
        }

        $tanggalLahir = $participant->tanggal_lahir;
        $tanggalLahirCarbon = Carbon::createFromFormat('d/m/Y', $tanggalLahir);
        $umur = $tanggalLahirCarbon->age;

        if($umur <= 17){
            $responseSDQ = SDQResponse::where('participant_id', $participant->id_peserta)->get();
    
            $domains = ['E' => 0, 'C' => 0, 'H' => 0, 'P' => 0];
    
            foreach ($responseSDQ as $response) {
                if (array_key_exists($response->domain, $domains)) {
                    $domains[$response->domain] += $response->score;
                }
            }
    
            $totalDifficultyScore = $domains['E'] + $domains['C'] + $domains['H'] + $domains['P'];
    
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
            $responseSRQ = SRQResponse::where('participant_id', $participant->id_peserta)->get();
            $responseYes = $responseSRQ->sum('score');
            
            if ($responseYes >= 8) {
                $category = 'Butuh Dukungan Lebih Lanjut';
                $img = 'Psyco';
                $summary = 'Hasil menunjukkan bahwa Anda membutuhkan dukungan lebih lanjut.';
            } else {
                $category = 'Tidak Butuh Dukungan Lebih Lanjut';
                $img = 'Happy';
                $summary = 'Hasil menunjukkan bahwa Anda tidak membutuhkan dukungan lebih lanjut.';
            }
        }

        if ($request->session()->get('email_sent', false)) {
            return $this->generateResultView($request, $participant, $img, $summary, $category);
        }

        $userEmail = $participant->email;

        try{
            Mail::to($userEmail)->send(new TestResultMail($category, $img, $summary));
        } catch(Exception $e){
            abort(400);
        }

        $request->session()->put('email_sent', true);

        $puskesmas = DaftarPuskesmas::getDummyData();
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = array_slice($puskesmas, ($currentPage - 1) * $perPage, $perPage);
        $paginator = new LengthAwarePaginator($currentItems, count($puskesmas), $perPage, $currentPage, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        return view('client.page.screening.page.result', ['puskesmas' => $paginator], compact('img', 'category', 'summary'));
    }

    private function generateResultView(Request $request, $participant, $img, $summary, $category)
    {
        $puskesmas = DaftarPuskesmas::getDummyData();
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = array_slice($puskesmas, ($currentPage - 1) * $perPage, $perPage);
        $paginator = new LengthAwarePaginator($currentItems, count($puskesmas), $perPage, $currentPage, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        return view('client.page.screening.page.result', ['puskesmas' => $paginator], compact('img', 'category', 'summary'));
    }
}
