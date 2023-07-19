<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Roles;
use App\Models\Certification;
use App\Models\Consultant;
use App\Models\Document;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\User;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use PDF;

class UserController extends Controller
{
    public function create_user(Request $request)
    {

        $request->validate([
            'urole' => 'required',
            'uphone' => 'nullable|digits:10',
            'upassword' => 'nullable|min:8',
        ], [
            'uphone.digits' => 'Please enter a valid 10-digit mobile number',
            'upassword.min' => 'The password must be at least 8 characters',
        ]);

        if (User::where('email', $request->uemail)->exists()) {
            $request->validate([
                'uemail' => 'required|unique:users,email',
            ]);
        } else {
            if ($request->urole == 'Sales') {
                $data = new User();
                $data->name = $request->uname;
                $data->password = bcrypt($request->upassword);
                $data->phone = $request->uphone;
                $data->active = 'Y';
                $data->email = $request->uemail;
                $data->parent_id = auth()->user()->id;
                $data->assignRole(Roles::SALES()->getValue());
                $data->save();
            } else {
                $data = new User();
                $data->name = $request->uname;
                $data->password = bcrypt($request->upassword);
                $data->phone = $request->uphone;
                $data->active = 'Y';
                $data->email = $request->uemail;
                $data->parent_id = auth()->user()->id;
                $data->assignRole(Roles::ADMIN()->getValue());
                $data->save();
            }
        }


        return redirect()->back()->with('success', 'Add User Successfully ');
    }
    public function changeActive($id, $active)
    {
        $user             = User::find($id);
        $user->active     = $active;
        $msg              = ($active == "Y") ? 'Suspended' :  'Activated';

        if ($user->save()) {
            return back()->with('success', 'User Account ' . $msg . ' Succesfully')->with('user', $user)->with('msg', $msg);
        } else {
            return back()->with('error', "Error Updating Client Profile")->with('user', $user)->with('msg', $msg);
        }
    }
    public function create_consultant(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|digits:10',
        ], [
            'phone.digits' => 'Please enter a valid 10-digit mobile number',
        ]);

        if (Consultant::where('email', $request->c_email)->exists()) {
            $request->validate([
                'c_email' => 'required|unique:consultants,email',
            ]);
        } else {
            $data = new Consultant();
            $data->name = $request->c_name;
            $data->business_name = $request->c_business_name;
            $data->address = $request->c_address;
            $data->phone = $request->phone;
            $data->email = $request->c_email;
            $data->user_id = auth()->user()->id;

            $data->save();
        }
        return redirect()->back()->with('success', 'Add Consultant Successfully ');
    }
    public function create_icv($id)
    {
        $data = Certification::find($id);
        $scopeSize = session('scopeSize');
        $registeredSize = session('registeredSize');
        $businessSize = session('businessSize');
        // return $scopeSize;
        return view('draft_icv', compact('data', 'scopeSize', 'registeredSize', 'businessSize'));
    }
    public function create_ici($id)
    {
        $data = Certification::find($id);
        $scopeSize = session('scopeSize');
        $registeredSize = session('registeredSize');
        $businessSize = session('businessSize');
        // return $scopeSize;
        return view('draft_ici', compact('data', 'scopeSize', 'registeredSize', 'businessSize'));
    }
    public function create_star($id)
    {
        $data = Certification::find($id);
        $scopeSize = session('scopeSize');
        $registeredSize = session('registeredSize');
        $businessSize = session('businessSize');
        // return $draft_data;
        return view('draft_star', compact('data', 'scopeSize', 'registeredSize', 'businessSize'));
    }
    public function final_icv($id)
    {
        $data = Certification::find($id);
        // return $draft_data;
        return view('preview_icv', compact('data'));
    }
    public function final_ici($id)
    {
        $data = Certification::find($id);
        // return $draft_data;
        return view('preview_ici', compact('data'));
    }
    public function final_star($id)
    {
        $data = Certification::find($id);
        // return $draft_data;
        return view('preview_star', compact('data'));
    }
    public function uploadDocument(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file',
            'file_name' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = new Document;
        $data->file_name = $request->file_name;
        $data->consultant_id = $request->consultant_id;
        $data->certificate_id = $request->certificate_id;
        $data->addMediaFromRequest('file')->toMediaCollection('post_image');
        $data->user_id = auth()->user()->id;
        $data->save();
        $userId = auth()->user()->id;
        $user = User::whereHas('documents', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->select('parent_id')
            ->first();

        $parentId = @$user->parent_id;
        // DD($parentId);

        $userFind = User::find($parentId);
        $ConsultantFind = Consultant::find($request->consultant_id);
        $CertificationFind = Certification::find($request->certificate_id);


        $data = [
            'consultant' => $ConsultantFind->name,
            'certificate' => $CertificationFind->business_name,
            'balance' => 'File Name : ' . $request->file_name,
            'text' => 'Please Approve This File',
        ];
        // return $userFind->email;



        Mail::send('email.email_info', @$data, function ($msg) use ($data, $userFind, $request) {
            $msg->from('racap@omegawebdemo.com.au');
            $msg->to($userFind->email);
            $msg->subject('File Approval ');
        });


        return redirect()->back();
    }

    public function deleteDocument($id)
    {
        $data = Document::find($id);
        $data->delete();

        return redirect()->back();
    }

    public function uploadPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_type' => 'required',
            'payment_balance' => 'required|numeric',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = new Payment;
        $data->payment_type = $request->payment_type;
        $data->payment_balance = $request->payment_balance;
        $data->consultant_id = $request->consultant_id;
        $data->certificate_id = $request->certificate_id;
        $data->user_id = auth()->user()->id;
        $data->save();

        $userId = auth()->user()->id;
        $user = User::whereHas('payments', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->select('parent_id')
            ->first();

        $parentId = @$user->parent_id;
        // DD($parentId);

        $userFind = User::find($parentId);
        $ConsultantFind = Consultant::find($request->consultant_id);
        $CertificationFind = Certification::find($request->certificate_id);


        $data = [
            'consultant' => $ConsultantFind->name,
            'certificate' => $CertificationFind->business_name,
            'balance' => 'Payment Received : ' . $request->payment_balance,
            'text' => 'Please Approve This Payment',

        ];
        // return $userFind->email;

        Mail::send('email.email_info', @$data, function ($msg) use ($data, $userFind) {
            $msg->from('racap@omegawebdemo.com.au');
            $msg->to($userFind->email);
            $msg->subject('Payment Approval');
        });


        return redirect()->back();
    }
    public function consultantPayment(Request $request)
    {
        $payments = Payment::where('user_id', auth()->user()->id)->get();
        // $payments = Payment::all();
        // $payments = Payment::with(['user', 'user.parent'])->get();


        return view('consultant-all-payments', compact('payments'));
    }

    public function deleteCertificate($id)
    {
        $data = Certification::find($id);
        $data->delete();

        return redirect()->back();
    }

    public function editCertificate(Request $request, $id)
    {
        $scopeSize_value = $request->scope_font_size;
        $registeredSize_value = $request->registered_font_size;
        $businessSize_value = $request->business_font_size;

        session(['scopeSize' => $scopeSize_value]);
        session(['registeredSize' => $registeredSize_value]);
        session(['businessSize' => $businessSize_value]);
        $data = Certification::find($id);
        $data->business_name = $request->business_name;
        $data->scope_registration = $request->scope_registration;
        $data->registered_site = $request->registered_site;
        $data->save();
        // return $data->certificate_template;

        if ($data->certificate_template == 'icv') {
            return redirect('/create-icv/' . $data->id);
        } elseif ($data->certificate_template == 'ici') {
            return redirect('/create-ici/' . $data->id);
        } elseif ($data->certificate_template == 'star') {
            return redirect('/create-star/' . $data->id);
        } else {
            return redirect()->back();
        }
    }
    public function createInvoice()
    {
        return view('create-invoice');
    }
    public function storeInvoice(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'invoice_number' => 'required',
            'item_number' => 'required',
            'amount' => 'required|numeric',
            'tax' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        // return $validatedData;

        // Invoice::create($validatedData);

        // Save the form data to the database in a single line
        // $invoiceData = Invoice::create($validatedData);
        // return view('store_invoice');
        // return view('p');
        // $data = [
        //     'order' => $order,
        //     'parts' => $parts,
        //     'payment' => $payment,
        //     'client' => $client,
        // ];

        $pdf = PDF::loadView('payment-receipt', compact('validatedData'));
        // Return the PDF as a response
        return $pdf->stream('payment_receipt.pdf');
    }
}
