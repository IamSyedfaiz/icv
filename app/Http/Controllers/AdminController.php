<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Models\Document;
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
        // $payments = Payment::all();
        // $payments = Payment::where('user_id', auth()->user()->id)->get();
        // $certifications = Certification::all();
        $documents = Document::all();


        return view('document', compact('documents'));
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
