<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExaminationCenter;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

interface ExaminationCenterInterface
{
    public function viewExaminationCenterList();
    public function viewExaminationCenterCreate();
    public function viewExaminationCenterUpdate($id);
    public function handleExaminationCenterCreate(Request $request);
    public function handleExaminationCenterUpdate(Request $request, $id);
    public function handleExaminationCenterDelete($id);
}

class ExaminationCenterController extends Controller implements ExaminationCenterInterface
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

    /**
     * View Examination Center List
     *
     * @return mixed
     */
    public function viewExaminationCenterList(): mixed
    {
        try {

            $examination_centers = ExaminationCenter::all();

            return view('admin.pages.examination-center.examination-center-list', [
                'examination_centers' => $examination_centers
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
     * View Examination Center Create
     *
     * @return mixed
     */
    public function viewExaminationCenterCreate(): mixed
    {
        try {

            return view('admin.pages.examination-center.examination-center-create');

        } catch (Exception $exception) {
            return redirect()->back()->with('message', [
                'status' => 'error',
                'title' => 'An error occcured',
                'description' => $exception->getMessage()
            ]);
        }
    }

    /**
     * View Examination Center Update
     *
     * @return mixed
     */
    public function viewExaminationCenterUpdate($id): mixed
    {
        try {

            $examination_center = ExaminationCenter::find($id);

            if (!$examination_center) {
                return redirect()->back()->with('message', [
                    'status' => 'warning',
                    'title' => 'Examination center not found',
                    'description' => 'Examination center not found with specified ID'
                ]);
            }

            return view('admin.pages.examination-center.examination-center-update', [
                'examination_center' => $examination_center
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
     * Handle Examination Center Create
     *
     * @return RedirectResponse
     */
    public function handleExaminationCenterCreate(Request $request): RedirectResponse
    {
        try {

            $validation = Validator::make($request->all(), [
                'name' => ['required', 'string', 'min:1', 'max:250'],
                'address' => ['required', 'string', 'min:1', 'max:1000'],
                'google_maps_link' => ['required', 'string', 'min:1', 'max:1000'],
            ]);

            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            }

            $examination_center = new ExaminationCenter();
            $examination_center->name = $request->input('name');
            $examination_center->address = $request->input('address');
            $examination_center->google_maps_link = $request->input('google_maps_link');
            $examination_center->save();

            return redirect()->route('admin.view.examination.center.list')->with('message', [
                'status' => 'success',
                'title' => 'Examination center created',
                'description' => 'The Examination center is successfully created.'
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
     * Handle Examination Center Update
     *
     * @return RedirectResponse
     */
    public function handleExaminationCenterUpdate(Request $request, $id): RedirectResponse
    {
        try {

            $examination_center = ExaminationCenter::find($id);

            if (!$examination_center) {
                return redirect()->back()->with('message', [
                    'status' => 'warning',
                    'title' => 'Examination center not found',
                    'description' => 'Examination center not found with specified ID'
                ]);
            }

            $validation = Validator::make($request->all(), [
                'name' => ['required', 'string', 'min:1', 'max:250'],
                'address' => ['required', 'string', 'min:1', 'max:1000'],
                'google_maps_link' => ['required', 'string', 'min:1', 'max:1000'],
            ]);

            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            }

            $examination_center->name = $request->input('name');
            $examination_center->address = $request->input('address');
            $examination_center->google_maps_link = $request->input('google_maps_link');
            $examination_center->update();

            return redirect()->route('admin.view.examination.center.list')->with('message', [
                'status' => 'success',
                'title' => 'Changes saved',
                'description' => 'The changes are successfully saved.'
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
     * Handl Examination Center Delete
     *
     * @return RedirectResponse
     */
    public function handleExaminationCenterDelete($id): RedirectResponse
    {
        try {
            
            $examination_center = ExaminationCenter::find($id);

            if (!$examination_center) {
                return redirect()->back()->with('message', [
                    'status' => 'warning',
                    'title' => 'Examination center not found',
                    'description' => 'Examination center not found with specified ID'
                ]);
            }

            $examination_center->delete();

            return redirect()->route('admin.view.examination.center.list')->with('message', [
                'status' => 'success',
                'title' => 'Examination cnter deleted',
                'description' => 'The Examination center is successfully deleted.'
            ]);
        } catch (Exception $exception) {
            return redirect()->back()->with('message', [
                'status' => 'error',
                'title' => 'An error occcured',
                'description' => $exception->getMessage()
            ]);
        }
    }
}
