<?php

namespace App\Http\Controllers\Admin;

use App\Events\Web\Registred;
use App\Exports\RegistrationExport;
use App\Http\Controllers\Controller;
use App\Imports\ResoStudentImport;
use App\Imports\ResultImport;
use App\Models\ExaminationCenter;
use App\Models\Registration;
use App\Models\ResoStudent;
use App\Models\Result;
use App\Models\ShortLink;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

interface RegistrationInterface
{
    public function viewRegistrationList();
    public function viewRegistrationPreview($id);
    public function handleRegistrationDelete($id);
}

class RegistrationController extends Controller implements RegistrationInterface
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin')->except('logout');
    }

    public function generateShortLink($link)
    {
        $short_link = new ShortLink();
        $short_link->token = Str::random(5);
        $short_link->url = $link;
        $short_link->save();

        return "resonancehyderabad.com/a/".$short_link->token;
    }

    /**
     * View Registration List
     *
     * @return mixed
     */
    public function viewRegistrationList(): mixed
    {
        try {

            $registrations = Registration::all();

            return view('admin.pages.registration.registration-list', [
                'registrations' => $registrations
            ]);
        } catch (Exception $exception) {
            return redirect()->back()->with('message', [
                'status' => 'error',
                'title' => 'An error occcured',
                'description' => $exception->getMessage()
            ]);
        }
    }

    /**
     * View Registration Preview
     *
     * @return mixed
     */
    public function viewRegistrationPreview($id): mixed
    {
        try {

            $registration = Registration::find($id);

            if (!$registration) {
                return redirect()->back()->with('message', [
                    'status' => 'warning',
                    'title' => 'Registration center not found',
                    'description' => 'Registration center not found with specified ID'
                ]);
            }

            return view('admin.pages.registration.registration-preview', [
                'registration' => $registration
            ]);
        } catch (Exception $exception) {
            return redirect()->back()->with('message', [
                'status' => 'error',
                'title' => 'An error occcured',
                'description' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Handl Registration Delete
     *
     * @return RedirectResponse
     */
    public function handleRegistrationDelete($id): RedirectResponse
    {
        try {
            
            $registration = Registration::find($id);

            if (!$registration) {
                return redirect()->back()->with('message', [
                    'status' => 'warning',
                    'title' => 'Registration center not found',
                    'description' => 'Registration center not found with specified ID'
                ]);
            }

            $registration->delete();

            return redirect()->route('admin.view.registration.list')->with('message', [
                'status' => 'success',
                'title' => 'Registration deleted',
                'description' => 'The registration is successfully deleted.'
            ]);
        } catch (Exception $exception) {
            return redirect()->back()->with('message', [
                'status' => 'error',
                'title' => 'An error occcured',
                'description' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Handle Download Registration Excel
     *
     * @return mixed
     */
    public function handleDownloadRegistrationExcel(): mixed
    {
       return Excel::download(new RegistrationExport(),'Registrations.xlsx');
    
    }

    /**
     * View Registration List
     *
     * @return mixed
     */
    public function viewImport(): mixed
    {
        try {

            return view('admin.pages.registration.registration-import');
        } catch (Exception $exception) {
            return redirect()->back()->with('message', [
                'status' => 'error',
                'title' => 'An error occcured',
                'description' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Handle Import Excel Data
     *
     * @return mixed
     */
    public function handleImportExcelData(Request $request): mixed
    {
        try {

            $validation = Validator::make($request->all(), [
                'excel_file' => ['required', 'file', 'mimes:xlsx,xls'],
            ]);

            if ($validation->fails()) {
                return redirect()->back()->with('message', [
                    'status' => 'error',
                    'title' => 'Invalid Data',
                    'description' => $validation->errors()->first()
                ]);
            }

            Excel::import(new ResoStudentImport(), $request->file('excel_file'));

            // ResoStudent::where('is_migrated', false)->chunk(50, function($reso_student) {
            //     foreach ($reso_student as $key => $value) {
                   
            //         $registration = Registration::where('neet_application_no', $value->neet_application_no)->first();

            //         if (is_null($registration)) {
            //             $registration = new Registration();
            //             $registration->neet_application_no = $value->neet_application_no;
            //             $registration->name = $value->name;
            //             $registration->father_name = $value->father_name;
            //             $registration->date_of_birth = $value->date_of_birth;
            //             $registration->gender = $value->gender;
            //             $registration->email = $value->email;
            //             $registration->neet_reg_phone = $value->neet_registred_mobile_no;
            //             $registration->alternate_phone = $value->alternate_phone;
            //             $registration->examination_center_id = ExaminationCenter::where('name', $value->examination_center)->first()?->id;
            //             $registration->save();
            
            //             $registration = Registration::find($registration->id);
            //             $registration->reso_admit_card_no = "RNGT" . $registration->id;
            //             $registration->update();
            //         }

            //         $reso_student = ResoStudent::find($value->id);
            //         $reso_student->is_migrated = true;
            //         $reso_student->save();

            //         $admit_card_path = 'admit-card/'.$registration->reso_admit_card_no .'-' . date('dmY',strtotime($registration->date_of_birth)) . '.pdf';

            //         Pdf::loadView('web.admit-card', [
            //             'registration' => $registration
            //         ])->save(storage_path('app/'.$admit_card_path));

            //         $data = [
            //             'name' => $registration->name,
            //             'phone' => $registration->neet_reg_phone,
            //             'admit_card_no' => $registration->reso_admit_card_no,
            //             'pdf_link' => asset('storage/'.$admit_card_path),
            //             'download_link' => $this->generateShortLink(asset('storage/'.$admit_card_path))
            //         ];

            //         Event::dispatch(new Registred($data, $registration));
            //     }
            // });

            return redirect()->route('admin.view.registration.list')->with('message', [
                'status' => 'success',
                'title' => 'Records Added',
                'description' => 'The records is successfully added.'
            ]);

        } catch (Exception $exception) {

            // DB::rollBack();
            return redirect()->back()->with('message', [
                'status' => 'error',
                'title' => 'An error occcured',
                'description' => $exception->getMessage()
            ]);
        }
        
    }

    public function handleTestCode() {
        try {

            ResoStudent::where('is_migrated', false)->chunk(70, function($reso_student) {
                foreach ($reso_student as $key => $value) {

                    $registration = Registration::where('neet_application_no', $value->neet_application_no)->first();

                    if (is_null($registration)) {
                        $registration = new Registration();
                        $registration->neet_application_no = $value->neet_application_no;
                        $registration->name = $value->name;
                        $registration->father_name = $value->father_name;
                        $registration->date_of_birth = $value->date_of_birth;
                        $registration->gender = $value->gender;
                        $registration->email = $value->email;
                        $registration->neet_reg_phone = $value->neet_registred_mobile_no;
                        $registration->alternate_phone = $value->alternate_phone;
                        $registration->examination_center_id = ExaminationCenter::where('name', $value->examination_center)->first()?->id;
                        $registration->save();
            
                        $registration = Registration::find($registration->id);
                        $registration->reso_admit_card_no = "RNGT" . $registration->id;
                        $registration->update();
                    }

                    $reso_student = ResoStudent::find($value->id);
                    $reso_student->is_migrated = true;
                    $reso_student->save();

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
                }
            });
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }


    public function downloadAdmitCardCenterWise($center_id) {
        try {

            $reso_students = ResoStudent::all();

            $zip = new \ZipArchive;
            $zipFileName = 'sample.zip';

            if ($zip->open(public_path($zipFileName), \ZipArchive::CREATE) === TRUE) {

                foreach ($reso_students as $key => $reso_student) {
                
                    $registration = Registration::where('neet_application_no', $reso_student->neet_application_no)->where('examination_center_id', $center_id)->first();

                    if (!is_null($registration)) {
                        $admit_card_path = storage_path('app/admit-card/'.$registration->reso_admit_card_no .'-' . date('dmY',strtotime($registration->date_of_birth)) . '.pdf');
                        $zip->addFile($admit_card_path, basename($admit_card_path));
                    }

                }

                $zip->close();

                return response()->download(public_path($zipFileName))->deleteFileAfterSend(true);
            }


        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function handleSendTestKey() {

        $registrations = Registration::where('is_test_key_sent', false)->get();

            foreach ($registrations as $key => $value) {

                $response = Http::post('https://backend.api-wa.co/campaign/yokr/api', [
                    "apiKey" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY0ZDM1YzQ3NTdiNDJkMTA0NzFhNjBlNSIsIm5hbWUiOiJwdXJuYSIsImFwcE5hbWUiOiJBaVNlbnN5IiwiY2xpZW50SWQiOiI2NGQzNWM0NzU3YjQyZDEwNDcxYTYwZTAiLCJhY3RpdmVQbGFuIjoiTk9ORSIsImlhdCI6MTY5MTU3MzMxOX0.4AkHFTfGMUn9AP4q7tDAIHH0C5QUuXcsLfUOOW71AIg",
                    "campaignName" => "Neet Test Key",
                    "destination" => "+91". $value->neet_reg_phone,
                    "userName" => $value->name,
                    "media" => [
                        "url" => 'http://grandtest.resonancehyderabad.com/web/images/Reso%20NEET%20Grand%20Test%20KEY%202024.pdf',
                        "filename" => "Reso NEET Grand Test KEY 2024.pdf",
                    ]
                ]);
        
                if ($response->successful()) {

                    $registration = Registration::find($value->id);
                    $registration->is_test_key_sent = true;
                    $registration->save();

                    Log::info('TEST_KEY_WHATSAPP_SENT');
                    Log::info($response->json());
                } else {
                    Log::info('TEST_KEY_WHATSAPP_NOT_SENT');
                    Log::info($response->body());
                }

            }
    }

    /**
     * View Result Import
     *
     * @return mixed
     */
    public function viewResultImport(): mixed
    {
        try {

            return view('admin.pages.registration.registration-result-import');
        } catch (Exception $exception) {
            return redirect()->back()->with('message', [
                'status' => 'error',
                'title' => 'An error occcured',
                'description' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Handle Import Result Excel
     *
     * @return mixed
     */
    public function handleImportResultExcel(Request $request): mixed
    {
        try {

            $validation = Validator::make($request->all(), [
                'excel_file' => ['required', 'file', 'mimes:xlsx,xls'],
            ]);

            if ($validation->fails()) {
                return redirect()->back()->with('message', [
                    'status' => 'error',
                    'title' => 'Invalid Data',
                    'description' => $validation->errors()->first()
                ]);
            }

            Excel::import(new ResultImport(), $request->file('excel_file'));

            return redirect()->route('admin.view.registration.list')->with('message', [
                'status' => 'success',
                'title' => 'Records Added',
                'description' => 'The records is successfully added.'
            ]);

        } catch (Exception $exception) {

            // DB::rollBack();
            return redirect()->back()->with('message', [
                'status' => 'error',
                'title' => 'An error occcured',
                'description' => $exception->getMessage()
            ]);
        }
        
    }

    public function handleSendResult() {

        $results = Result::where('is_message_sent', false)->get();

            foreach ($results as $key => $value) {

                $registration = Registration::where('reso_admit_card_no', $value->admit_card_no)->first();

                if ($registration) {

                    $response = Http::post('https://backend.api-wa.co/campaign/yokr/api', [
                        "apiKey" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY0ZDM1YzQ3NTdiNDJkMTA0NzFhNjBlNSIsIm5hbWUiOiJwdXJuYSIsImFwcE5hbWUiOiJBaVNlbnN5IiwiY2xpZW50SWQiOiI2NGQzNWM0NzU3YjQyZDEwNDcxYTYwZTAiLCJhY3RpdmVQbGFuIjoiTk9ORSIsImlhdCI6MTY5MTU3MzMxOX0.4AkHFTfGMUn9AP4q7tDAIHH0C5QUuXcsLfUOOW71AIg",
                        "campaignName" => "Grand_Test_Result",
                        "destination" => "+91". $registration->neet_reg_phone,
                        "userName" => $registration->name,
                        "templateParams" => [$value->bot_marks, $value->phy_marks, $value->che_marks, $value->total_marks]
                    ]);
            
                    if ($response->successful()) {

                        $result = Result::find($value->id);
                        $result->is_message_sent = true;
                        $result->save();

                        Log::info('RESULT_WHATSAPP_SENT');
                        Log::info($response->json());
                    } else {
                        Log::info('RESULT_WHATSAPP_NOT_SENT');
                        Log::info($response->body());
                    }

                }

            }
    }
   
}
