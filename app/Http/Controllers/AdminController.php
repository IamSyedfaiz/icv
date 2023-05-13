<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Models\Document;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function allPayment()
    {
        // $payments = Payment::all();
        $payments = Payment::orderByDesc('created_at')->get();
        // $payments = Payment::where('user_id', auth()->user()->id)->get();

        return view('all-payment', compact('payments'));
    }

    public function approvedPayment($id)
    {

        $data = Payment::find($id);
        $data->status = 'A';
        $data->save();
        // if ($certficate_id) {
        //     $cert = Certification::find($certficate_id);
        //     if ($cert) {
        //         $cert->certificate_status = 'Final';
        //         $cert->save();
        //     }
        // }


        return redirect()->back();
    }
    public function rejectedPayment($id)
    {
        $data = Payment::find($id);
        $data->status = 'R';
        $data->save();

        return redirect()->back();
    }
    public function document()
    {

        $certifications = Certification::has('documents')->latest()->get();

        return view('document', compact('certifications'));
    }
    public function approved_document($id)
    {

        $data = Certification::find($id);
        $data->status = 'A';
        $data->certificate_status = 'Final';
        $data->save();

        return redirect()->back();
    }
    public function rejected_document($id)
    {
        $data = Certification::find($id);
        $data->status = 'R';
        $data->certificate_status = 'Draft';

        $data->save();

        return redirect()->back();
    }
}
