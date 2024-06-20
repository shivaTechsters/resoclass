<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Permission;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Role;

interface AdminAccessInterface
{
    public function viewAdminAccessList();
    public function viewAdminAccessCreate();
    public function viewAdminAccessUpdate($id);
    public function handleAdminAccessCreate(Request $request);
    public function handleAdminAccessUpdate(Request $request, $id);
    public function handleToggleAdminAccessStatus(Request $request);
    public function handleAdminAccessDelete($id);
}

class AdminAccessController extends Controller implements AdminAccessInterface
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
     * View Admin Access List
     *
     * @return mixed
     */
    public function viewAdminAccessList(): mixed
    {
        try {

            $admin = Admin::find(auth()->user()->id);
            if (!$admin->can(Permission::VIEW_ACCESS->value)) {
                return redirect()->back()->with('message', [
                    'status' => 'warning',
                    'title' => 'Unauthorized Access',
                    'description' => "You do not have access to this url"
                ]);
            }

            $admins = Admin::whereNot('id', auth()->user()->id)->get();

            return view('admin.pages.access.access-list', [
                'admins' => $admins
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
     * View Admin Access Create
     *
     * @return mixed
     */
    public function viewAdminAccessCreate(): mixed
    {
        try {

            $admin = Admin::find(auth()->user()->id);
            if (!$admin->can(Permission::ADD_ACCESS->value)) {
                return redirect()->back()->with('message', [
                    'status' => 'warning',
                    'title' => 'Unauthorized Access',
                    'description' => "You do not have access to this url"
                ]);
            }

            $roles = Role::all();

            return view('admin.pages.access.access-create', [
                'roles' => $roles
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
     * View Admin Access Update
     *
     * @return mixed
     */
    public function viewAdminAccessUpdate($id): mixed
    {
        try {

            $admin = Admin::find(auth()->user()->id);
            if (!$admin->can(Permission::EDIT_ACCESS->value)) {
                return redirect()->back()->with('message', [
                    'status' => 'warning',
                    'title' => 'Unauthorized Access',
                    'description' => "You do not have access to this url"
                ]);
            }

            $admin = Admin::find($id);

            if (!$admin) {
                return redirect()->back()->with('message', [
                    'status' => 'warning',
                    'title' => 'Admin not found',
                    'description' => 'Admin not found with specified ID'
                ]);
            }

            $roles = Role::all();

            return view('admin.pages.access.access-update', [
                'roles' => $roles,
                'admin' => $admin
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
     * Handle Admin Access Create
     *
     * @return RedirectResponse
     */
    public function handleAdminAccessCreate(Request $request): RedirectResponse
    {
        try {

            $validation = Validator::make($request->all(), [
                'name' => ['required', 'string', 'min:1', 'max:250'],
                'email' => ['required', 'string', 'email',  'min:1', 'max:250', 'unique:admins'],
                'phone' => ['required', 'numeric', 'digits_between:10,12', 'unique:admins'],
                'role_id' => ['required', 'string', 'exists:roles,id'],
                'password' => ['required', 'string', 'min:6', 'max:20', 'confirmed'],
            ]);

            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            }

            $admin = new Admin();
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->phone = $request->input('phone');
            $admin->password = Hash::make($request->input('password'));
            $admin->save();

            $role = Role::find($request->input('role_id'));
            $admin->assignRole($role);

            return redirect()->route('admin.view.admin.access.list')->with('message', [
                'status' => 'success',
                'title' => 'Admin access created',
                'description' => 'The admin access is successfully created.'
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
     * Handle Admin Access Update
     *
     * @return RedirectResponse
     */
    public function handleAdminAccessUpdate(Request $request, $id): RedirectResponse
    {
        try {

            $admin = Admin::find($id);

            if (!$admin) {
                return redirect()->back()->with('message', [
                    'status' => 'warning',
                    'title' => 'Admin not found',
                    'description' => 'Admin not found with specified ID'
                ]);
            }

            $validation = Validator::make($request->all(), [
                'name' => ['required', 'string', 'min:1', 'max:250'],
                'email' => ['required', 'string', 'email',  'min:1', 'max:250', Rule::unique('admins')->ignore($id)],
                'phone' => ['required', 'numeric', 'digits_between:10,12', Rule::unique('admins')->ignore($id)],
                'password' => ['nullable', 'string', 'min:6', 'max:20', 'confirmed'],
            ]);

            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            }

            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->phone = $request->input('phone');
            if ($request->input('password')) {
                $admin->password = Hash::make($request->input('password'));
            }
            $admin->update();

            return redirect()->route('admin.view.admin.access.list')->with('message', [
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
     * Handle Toggle Admin Access Status
     *
     * @return Response
     */
    public function handleToggleAdminAccessStatus(Request $request): Response
    {
        try {

            $validation = Validator::make($request->all(), [
                'admin_id' => ['required', 'numeric', 'exists:admins,id']
            ]);

            if ($validation->fails()) {
                return response([
                    'status' => false,
                    'message' => $validation->errors()->first(),
                    'error' => $validation->errors()->getMessages()
                ], 200);
            }

            $admin = Admin::find($request->input('admin_id'));
            $admin->status = !$admin->status;
            $admin->update();

            return response([
                'status' => true,
                'message' => "Status successfully updated",
                'data' => $admin
            ], 200);
        } catch (Exception $exception) {
            return response([
                'status' => false,
                'message' => "An error occcured",
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Handl Admin Access Delete
     *
     * @return RedirectResponse
     */
    public function handleAdminAccessDelete($id): RedirectResponse
    {
        try {

            $admin = Admin::find(auth()->user()->id);
            if (!$admin->can(Permission::DELETE_ACCESS->value)) {
                return redirect()->back()->with('message', [
                    'status' => 'warning',
                    'title' => 'Unauthorized Access',
                    'description' => "You do not have access to this url"
                ]);
            }

            $admin = Admin::find($id);

            if (!$admin) {
                return redirect()->back()->with('message', [
                    'status' => 'warning',
                    'title' => 'Admin not found',
                    'description' => 'Admin not found with specified ID'
                ]);
            }

            $admin->delete();

            return redirect()->route('admin.view.admin.access.list')->with('message', [
                'status' => 'success',
                'title' => 'Admin access deleted',
                'description' => 'The admin access is successfully deleted.'
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
