<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Feedback;
use App\Models\Peserta;
use Exception;

class HomepageController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->forget(['success', 'token', 'pin']);
        return view('client.page.homepage.homepage');
    }

    public function screening(Request $request)
    {
        $request->session()->forget(['success', 'token', 'pin']);
        return view('client.page.screening.page.screening');
    }

    public function mandiri(Request $request)
    {
        $request->session()->forget(['success', 'token', 'pin']);
        return view('client.page.mandiri.page.mandiri');
    }
    public function forbidden(Request $request)
    {
        $request->session()->forget(['success', 'token', 'pin']);
        return view('client.page.mandiri.page.forbidden');
    }

    public function review(){
        return view('client.partials.feedback');
    }

    public function submitReview(Request $request){
        try{
            $request->validate([
                'name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
                'feedback' => 'required|regex:/^[a-zA-Z0-9\s,.\-\/]+$/',
                'rating' => 'required|numeric|min:1|max:5',
            ], [
                'name.regex' => 'Nama hanya boleh mengandung huruf!',
                'rating.required' => 'Rating harus diisi!',
            ]);

            $review = new Review();
            $review->nama = $request->input('name');
            $review->ulasan = $request->input('feedback');
            $review->rating = $request->input('rating');
            $review->save();
            return redirect()->back()->with('success', 'Terima kasih atas ulasan anda');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function submitFeedback(Request $request){
        try{

            $token = $request->session()->get('token');
            if (!$token) {
                abort(403, 'Unauthorized access');
            }

            $participant = Peserta::where('token', $token)->first();

            if (!$participant) {
                abort(403, 'Unauthorized access');
            }

            $existingFeedback = Feedback::where('nama', $participant->nama_lengkap);
            if ($existingFeedback && $existingFeedback->count() > 0) {
                return redirect()->back()->with('error', 'Anda hanya dapat mengirimkan umpan balik satu kali saja');
            } else {
                $request->validate([
                    'name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
                    'school' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s,.\-\/]+$/',
                    'feedback' => 'required|regex:/^[a-zA-Z0-9\s,.\-\/]+$/',
                ], [
                    'name.regex' => 'Nama hanya boleh mengandung huruf!',
                    'school.regex' => 'Asal sekolah hanya boleh mengandung huruf dan angka !',
                    'feedback.required' => 'Umpan balik harus diisi!',
                ]);
    
                $feedback = new Feedback();
                $feedback->nama = $request->input('name');
                $feedback->sekolah = $request->input('school');
                $feedback->umpan_balik = $request->input('feedback');
                $feedback->save();
                return redirect()->back()->with('success', 'Terima kasih atas umpan balik anda');
            }
            
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }
}
