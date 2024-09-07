<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
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

    public function feedback(){
        return view('client.partials.feedback');
    }

    public function submitFeedback(Request $request){
        try{
            $request->validate([
                'name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
                'feedback' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s,.\-\/]+$/',
                'rating' => 'required|numeric|min:1|max:5',
            ], [
                'name.regex' => 'Nama hanya boleh mengandung huruf!',
                'rating.required' => 'Rating harus diisi!',
            ]);
    
            $feedback = new Feedback();
            $feedback->nama = $request->input('name');
            $feedback->ulasan = $request->input('feedback');
            $feedback->rating = $request->input('rating');
            $feedback->save();
            return redirect()->back()->with('success', 'Terima kasih atas ulasan anda');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }
}
