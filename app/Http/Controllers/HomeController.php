<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Models\Consultant;
use App\Models\Document;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->active == 'N') {
            // return 1;
            Auth::logout();
            return redirect()->back()->with('danger', 'Your Account has been Suspended');
        } else {
            $draftCount = Certification::where('certificate_status', 'draft')->where('user_id', auth()->user()->id)->count();
            $finalCount = Certification::where('certificate_status', 'final')->where('user_id', auth()->user()->id)->count();
            // $certifications = Certification::where('user_id', auth()->user()->id)->get();
            return view('home', compact('draftCount', 'finalCount'));
        }
    }
    public function add_user()
    {
        return view('add-user');
    }
    public function all_user()
    {
        $users = User::where('parent_id', auth()->user()->id)->get();
        return view('all-users', compact('users'));
    }
    public function add_consultant()
    {
        return view('add-consultant');
    }
    public function all_consultant()
    {
        $consultants = Consultant::where('user_id', auth()->user()->id)->get();

        return view('all-consultant', compact('consultants'));
    }
    public function view_draft_cert()
    {
        $current_date = now();
        $format_current_date = $current_date->format('d-m-y');
        $first_date = $current_date->copy()->addMonth(10);
        $format_first_date = $first_date->format('d-m-y');
        $second_date = $first_date->copy()->addMonth(10);
        $format_second_date = $second_date->format('d-m-y');
        $due_date = $second_date->copy()->addMonth(10);
        $format_due_date = $due_date->format('d-m-y');
        $consultants = Consultant::where('user_id', auth()->user()->id)->get();
        return view('add-draft-cert', compact(['format_current_date', 'format_first_date', 'format_second_date', 'format_due_date', 'consultants']));
    }
    public function add_draft_cert($id)
    {

        $current_date = now();
        $format_current_date = $current_date->format('d-m-y');
        $first_date = $current_date->copy()->addMonth(10);
        $format_first_date = $first_date->format('d-m-y');
        $second_date = $first_date->copy()->addMonth(10);
        $format_second_date = $second_date->format('d-m-y');
        $due_date = $second_date->copy()->addMonth(10);
        $format_due_date = $due_date->format('d-m-y');
        // return $format_due_date;

        $consultants = Consultant::where('id', $id)->first();
        $documents = Document::all();

        return view('add-draft-cert', compact(['format_current_date', 'format_first_date', 'format_second_date', 'format_due_date', 'consultants', 'documents']));
    }
    public function all_certs()
    {
        $certifications = Certification::where('user_id', auth()->user()->id)->get();
        return view('all-certs', compact('certifications'));
    }
    public function consultant($id)
    {
        $draftCount = Certification::where('certificate_status', 'draft')->where('user_id', auth()->user()->id)->count();
        $finalCount = Certification::where('certificate_status', 'final')->where('user_id', auth()->user()->id)->count();
        $consultant = Consultant::where('id', $id)->first();
        return view('consultant', compact('consultant', 'draftCount', 'finalCount'));
    }
    public function store_draft_cert(Request $request)
    {



        $validator = Validator::make($request->all(), [
            'certificate_template' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            $errors = $validator->errors();

            // Retrieve the error message for the certificate_template field
            $errorMessage = $errors->first('certificate_template');

            // Handle the error (e.g., redirect back with error message)
            return redirect()->back()->with('danger', $errorMessage);
        }

        $data = new Certification;
        $data->consultant_id = $request->consultant_id;
        $data->user_id = auth()->user()->id;
        $data->certificate_template = $request->certificate_template;
        $data->standerd = '9001';
        $data->certificate_status = $request->certificate_status;
        $data->business_name = $request->business_name;
        $data->scope_registration = $request->scope_registration;
        $data->registered_site = $request->registered_site;
        $data->certificate_number = $request->certificate_number;
        $data->date_registration = $request->date_registration;
        $data->first_surveillance_audit = $request->first_surveillance_audit;
        $data->second_surveillance_audit = $request->second_surveillance_audit;
        $data->certification_due_date = $request->certification_due_date;
        $data->save();


        if ($request->certificate_template == 'icv') {
            return redirect('/create-icv/' . $data->id);
        } elseif ($request->certificate_template == 'ici') {
            return redirect('/create-ici/' . $data->id);
        } elseif ($request->certificate_template == 'star') {
            return redirect('/create-star/' . $data->id);
        } else {
            return redirect()->back();
        }
    }
    public function store_final_cert(Request $request, $id)
    {
        // return $request;
        $data = Certification::find($id);
        $data->certificate_number = $request->certificate_number;
        $data->date_registration = $request->date_registration;
        $data->first_surveillance_audit = $request->first_surveillance_audit;
        $data->second_surveillance_audit = $request->second_surveillance_audit;
        $data->certification_due_date = $request->certification_due_date;
        $data->save();


        if ($request->certificate_template == 'icv') {
            return redirect('/final-icv/' . $id);
        } elseif ($request->certificate_template == 'ici') {
            return redirect('/final-ici/' . $id);
        } elseif ($request->certificate_template == 'star') {
            return redirect('/final-star/' . $id);
        } else {
            return redirect()->back();
        }
    }
    public function edit_draft_cert($id)
    {

        $ici_cert = Certification::where('certificate_template', 'ici')->where('certificate_status', 'Final')
            ->whereNotNull('date_registration')->latest('updated_at')->first();
            // return 123;

        if ($ici_cert) {
            // return $ici_cert;

            $ici_cert_no = explode('/', $ici_cert->certificate_number)[1];
            $final_ici_cert = substr($ici_cert_no, 0, 4)+1;
        } else {

            $final_ici_cert = 3100;
        }

        $star_cert = Certification::where('certificate_template', 'star')->where('certificate_status', 'Final')
            ->whereNotNull('date_registration')->latest('updated_at')->first();

        if ($star_cert) {

            $star_cert_no = explode('/', $star_cert->certificate_number)[1];
            $final_star_cert = substr($star_cert_no, 0, 4)+1;
        } else {
            $final_star_cert = 1100;
        }



        $icv_cert = Certification::where('certificate_template', 'icv')->where('certificate_status', 'Final')
            ->whereNotNull('date_registration')->latest('updated_at')->first();

        if ($icv_cert) {

            $icv_cert_no = explode('/', $icv_cert->certificate_number)[1];
            $final_icv_cert = substr($icv_cert_no, 4, 6)+1;
            // return $final_icv_cert;
        } else {
            $final_icv_cert = 900;
        }
        $current_date = now();
        $format_current_date = $current_date->format('d-m-y');
        $first_date = $current_date->copy()->addMonth(10);
        $format_first_date = $first_date->format('d-m-y');
        $second_date = $first_date->copy()->addMonth(10);
        $format_second_date = $second_date->format('d-m-y');
        $due_date = $second_date->copy()->addMonth(10);
        $format_due_date = $due_date->format('d-m-y');
        $certification = Certification::where('id', $id)->first();
        $documents = Document::all();
        $payments = Payment::all();
        $first_number = rand(1000,  10000);
        $second_number = rand(100,  1000);
        $third_number = rand(10,  100);
        $fourth_number = rand(1000,  10000);
        $ici_Certificate_number = 'ICI' . '/' . $final_ici_cert . $second_number . '/' . $third_number;
        // return $ici_Certificate_number;
        $icv_Certificate_number = 'IN' . '/' . $first_number . $final_icv_cert . '/' . $fourth_number;
        $star_Certificate_number = 'SR' . '/' . $final_star_cert . $second_number . '/' . $fourth_number;


        return view('edit-draft-cert', compact('certification', 'documents', 'format_current_date', 'format_first_date', 'format_second_date', 'format_due_date', 'payments', 'ici_Certificate_number', 'icv_Certificate_number', 'star_Certificate_number'));
        // 
    }
    public function report()
    {

        $certifications = Certification::all();

        return view('report-cert', compact('certifications'));
    }
    public function filter_report(Request $request)
    {

        // $certifications = Certification::all();


        $certification = (new Certification)->newQuery();

        if (!empty(request()->get('from_date'))) {
            $fromDate = Carbon::createFromFormat('Y-m-d', request()->get('from_date'));
            $certification->whereDate('created_at', $fromDate);
        } else {
            $certifications = $certification->orderBy('id', 'ASC')->get();
        }
        $certifications = $certification->get();


        return view('report-cert', compact('certifications'));
    }
}