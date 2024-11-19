<?php

namespace App\Http\Controllers\Staff;

use App\Models\Role;
use App\Models\User;
use App\Mail\AccountUpdate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Resources\User\UserResource;

class UserController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $users = UserResource::collection(User::with('role', 'customer')->where('role_id', Role::CUSTOMER)->get());

            return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('actions', function($row)
            {
                $new_row = collect($row);

                $btn = "
                <div class='dropdown'>
                    <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    <i class='fas fa-ellipsis-v'></i>
                    </a>
                    <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>";

                    if ($row['is_activated'] !== 1) {
                        $btn .= "
                                <a class='dropdown-item' href='javascript:void(0)' 
                                onclick='crud_activate_deactivate($new_row[id], `staff.users.update` , `activate`, `.user_dt`, `Activate this Account`)'>Activate Account</a>";
                    } else {
                        $btn .= "
                                <a class='dropdown-item' href='javascript:void(0)' 
                                onclick='crud_activate_deactivate($new_row[id], `staff.users.update` , `deactivate`, `.user_dt`, `Deactivate this Account`)'>Deactivate Account</a>";
                    }

                    $btn.=    "<a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($new_row[id],`staff.users.destroy`,`.user_dt`)'>Delete</a>
                    </div>
                </div> ";

               return $btn;
           })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('staff.user.index');
    }

    public function update(User $user)
{
    if (request()->has('option')) {
        $option = request('option');

        // Activate or Deactivate User
        if ($option === 'activate') {
            $user->update(['is_activated' => 1]);
        } elseif ($option === 'deactivate') {
            $user->update(['is_activated' => 0]);
        } else {
            return response()->json(['error' => 'Invalid option'], 400);
        }

        try {
            // Email user
            Mail::to($user)->send(new AccountUpdate($user));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send email: ' . $e->getMessage()], 500);
        }

        return response()->json(['success' => 'User updated successfully']);
    }

    return response()->json(['error' => 'No option provided'], 400);
}

}