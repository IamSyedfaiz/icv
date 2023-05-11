<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function allPayment()
    {
        $payments = Payment::all();
        // $payments = Payment::where('user_id', auth()->user()->id)->get();

        return view('all-payment', compact('payments'));
    }

    public function approvedPayment($id, $certficate_id)
    {

        $data = Payment::find($id);
        $data->status = 'A';
        $data->save();
        if ($certficate_id) {
            $cert = Certification::find($certficate_id);
            if ($cert) {
                $cert->certificate_status = 'Final';
                $cert->save();
            }
        }


        return redirect()->back();
    }
    public function rejectedPayment($id)
    {
        $data = Payment::find($id);
        $data->status = 'R';
        $data->save();

        return redirect()->back();
    }
}
