<?php

namespace App\Http\Controllers\Web;

use App\Enums\Gender;
use App\Events\Web\Registred;
use App\Http\Controllers\Controller;
use App\Models\ExaminationCenter;
use App\Models\Registration;
use App\Models\ShortLink;
use App\Models\VerificationOtp;
use Carbon\Carbon;
use Exception;
use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Enum;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Log;

class RegistrationController extends Controller
{

    public function generateShortLink($link)
    {
        $short_link = new ShortLink();
        $short_link->token = Str::random(5);
        $short_link->url = $link;
        $short_link->save();

        return "resonancehyderabad.com/a/".$short_link->token;
    }

    public function viewRegister() 
    {
        $examination_centers = ExaminationCenter::all();
        $genders = Gender::class;

        return view('web.register',[
            'examination_centers' => $examination_centers,
            'genders' => $genders
        ]);
    }

    public function handleRegister(Request $request) 
    {
        try {

            $validation = Validator::make($request->all(), [
                'neet_application_no' => ['required', 'string', 'min:1', 'max:250'],
                'name' => ['required', 'string',  'min:1', 'max:250'],
                'father_name' => ['required', 'string', 'min:1', 'max:250'],
                'date_of_birth' => ['required', 'string', 'min:1', 'max:250'],
                'gender' => ['required', 'string',  new Enum(Gender::class)],
                'email' => ['required', 'string', 'email', 'min:1', 'max:250'],
                'neet_reg_phone' => ['required', 'numeric', 'digits:10'],
                'alternate_phone' => ['required', 'numeric', 'digits:10'],
                'verification_otp' => ['required', 'numeric', 'digits:6'],
                'examination_center_id' => ['required', 'numeric', 'exists:examination_centers,id']
            ]);

            if ($validation->fails()) {
                return redirect()->back()->with(['error_message' => $validation->errors()->first()])->withInput();
            }

            $check_otp_exists = VerificationOtp::where('otp', $request->input('verification_otp'))->where('phone', $request->input('neet_reg_phone'))->exists();
            if (!$check_otp_exists) {
                return redirect()->back()->with(['error_message' => "Invalid OTP"])->withInput();
            }

            $registration = Registration::where('neet_application_no', $request->input('neet_application_no'))->first();

            if (is_null($registration)) {
                $registration = new Registration();
                $registration->neet_application_no = $request->input('neet_application_no');
                $registration->name = $request->input('name');
                $registration->father_name = $request->input('father_name');
                $registration->date_of_birth = $request->input('date_of_birth');
                $registration->gender = $request->input('gender');
                $registration->email = $request->input('email');
                $registration->neet_reg_phone = $request->input('neet_reg_phone');
                $registration->alternate_phone = $request->input('alternate_phone');
                $registration->examination_center_id = $request->input('examination_center_id');
                $registration->save();
    
                $registration = Registration::find($registration->id);
                $registration->reso_admit_card_no = "RNGT" . $registration->id;
                $registration->update();
            }

            $admit_card_path = 'admit-card/'.$registration->reso_admit_card_no .'-' . date('dmY',strtotime($registration->date_of_birth)) . '.pdf';

            Pdf::loadView('web.admit-card', [
                'registration' => $registration
            ])->save(storage_path('app/'.$admit_card_path));

            $data = [
                'name' => $registration->name,
                'phone' => $registration->neet_reg_phone,
                'admit_card_no' => $registration->reso_admit_card_no,
                'pdf_link' => asset('storage/'.$admit_card_path),
                'download_link' => $this->generateShortLink(asset('storage/'.$admit_card_path))
            ];

            Event::dispatch(new Registred($data, $registration));

            return redirect()->route('web.view.thankyou',['id' => $registration->id, 'date_of_birth' => $registration->date_of_birth]);

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function viewThankYou($id, $date_of_birth) {

        $registration = Registration::where('id', $id)->where('date_of_birth', $date_of_birth)->first();

        if (is_null($registration)) {
            return abort(404);
        }

        return view('web.thank-you',[
            'registration' => $registration
        ]);

    }

    public function handleSendVerificationOTP(Request $request) 
    {
        try {

            $validation = Validator::make($request->all(), [
                'phone' => ['required', 'numeric', 'digits:10'],
            ]);

            if ($validation->fails()) {
                return response([
                    'status' => false,
                    'message' => $validation->errors()->first()
                ], 200);
            }

            $verification_otp = new VerificationOtp();
            $verification_otp->phone = $request->input('phone');
            $verification_otp->otp = rand(100000,999999);
            $verification_otp->expiry = Carbon::now()->addMinutes(5);
            $verification_otp->save();

            $message = urlencode("Reso ESS one-time login OTP: ".$verification_otp->otp.", do not share this OTP with others. The OTP will be Valid for 5 minutes. Resonance Hyderabad.");

            $url = "http://ngbulksms.com/v3/api.php?username=resonancetrans&apikey=b2314f40c0bba958a3da&senderid=RESOHY&mobile=".$request->input('phone')."&message=".$message;
    
            $response = Http::get($url);
    
            if ($response->successful()) {
                Log::info('SMS_OTP_MESSAGE_SENT');
                Log::info($response->json());
            } else {
                Log::info('SMS_OTP_MESSAGE_ERROR');
                Log::info($response->body());
            }

            return response([
                'status' => true,
                'message' => "OTP Successfully Sent"
            ], 200);

        } catch (Exception $exception) {
            return response([
                'status' => false,
                'message' => $exception->getMessage()
            ], 500);
        }
    }
}
