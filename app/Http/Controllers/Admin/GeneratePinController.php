<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneratePin;
use Exception;

class GeneratePinController extends Controller
{
    public function store(Request $request)
    {
        try{
            $request->validate([
                'pin' => 'required|min:6|max:6',
            ]);

            GeneratePin::where('status', 'active')->update(['status' => 'inactive']);
            $generatePin = new GeneratePin();
            $generatePin->pin = $request->pin;
            $generatePin->status = 'active';
            $generatePin->save();
    
            return redirect()->route('dashboard')->with('Success', 'Berhasil membuat PIN baru');

        }catch(Exception $e){
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }
    }

    public function updatePinStatus(Request $request)
    {
        try {
            GeneratePin::where('status', 'active')->update(['status' => 'inactive']);
    
            return redirect()->route('dashboard')->with('Success', 'Status PIN berhasil diperbarui');
        } catch (Exception $e) {
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }
    }
}
