<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Auth;

class RolesController extends Controller
{
    
    /**
     * Construct
     * 
     * @return void
    */
	public function __construct()
    {
        if (Session::has('user')) {
            $user = Auth::user();
            if ($user->role == 'user') {
                return redirect()->back()->with(array("fail" => "You have have no authorisation."))->withInput();
            }
        } else {
            return redirect("/")->with(array("fail" => "You have to Login first to access our features."))->withInput();
        }
    }

    /**
     * Role index
     *   
	 * @return view
    */
	public function index()
    {
        $user = Auth::user();
        $role_id = $user->role;
        if ($role_id != "") {
            redirect('/');
        }

        $permissions = Permission::all();
        $roles = Role::all();
        $crole = $user->role;
        $role_id = $user->id;
        if ($crole != "admin") {
            $user_statuses = DB::select('SELECT
                    `user_statuses`.* 
                FROM
                    `user_statuses`  
                WHERE `user_statuses`.`user_id` = "'.$role_id.'"
                AND `user_statuses`.`added_by` = "'.$crole.'" ');
        } else {
            // $user_statuses = UserStatus::all();
            $user_statuses = DB::select('SELECT
                    `user_statuses`.* 
                FROM
                    `user_statuses`');
        }
        

        return view('admin.role.index', compact('user_statuses', 'permissions', 'roles', 'user'));
    }

    /**
     * Create a role
     *   
	 * @return array
    */
	public function create()
    {
        $z = Auth::user();
        $role_id = $z->id;
        return Package::create([
            'role' => $data['role'],
            'rdescription' => $data['rdescription'],
            'user_id'=> $role_id,
            'added_by'=> $z->role
        ]);
    }

    /**
     * Fetch all roles
     *   
	 * @return JSON
    */
	public function get()
    {
        $z = Auth::user();
        $crole = $z->role;
        $role_id = $z->id;
        if ($z->role != "admin") {
            $roles = DB::select('SELECT
                    `roles`.*
                FROM
                    `roles`
                WHERE `user_id` = "'.$role_id.'"
                AND `added_by` = "'.$crole.'" ');
        } else {
            $roles =  Role::all();
        }
        foreach ($roles as $customers) {
            $cdate = date("d-m-Y", strtotime($customers->created_at));
            $udate = date("d-m-Y", strtotime($customers->updated_at));
            $row = array();
            $role ='<button class="btn btn-default btn-xs" onclick="attach_permissions(' . $customers->id . '); " role="button" tabindex="0" data-id="' . $customers->id . '">' . $customers->role . '</button>';
            $row['role'] = $role;
            $row['id'] = $customers->id;
            $row['rdescription'] = $customers->rdescription;
            $row['created_at'] = $cdate;
            $row['updated_at'] = $udate;
            $row['action'] =  '<button class="btn btn-success btn-xs attach-permissions-button" onclick = "attach_permissions(' . $customers->id . ');" data-id="' . $customers->id . '" data-toggle="tooltip" data-original-title="Attach Permissions"><i class="fa fa-plus"></i></button>
                <button class="btn btn-info btn-xs view-button" onclick = "view(' . $customers->id . ');" data-id="' . $customers->id . '" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye"></i></button> 
                        <button class="btn btn-primary btn-xs edit-button" onclick = "edit(' . $customers->id . ');" data-id="' . $customers->id . '" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger btn-xs delete-button" onclick = "remove(' . $customers->id . ');" data-id="' . $customers->id . '"data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash"></i></button>';
            $data[] = $row;
        }
        if ($roles == array()) {
            $data = array();
        }
        return Response::json([ 'data' => $data ]);
    }

    public function store(Request $request)
    {
        $z = Auth::user();
        $role_id = $z->id;
        $validator = $validator = Validator::make(
            $request->all(),
            [
            'role' => 'required|regex:/^[\pL\s\-]+$/u',
            'rdescription' => 'required'
            ],
            [
            'rdescription.required' => 'The Role Description is required.',
            ]
        );

        if ($validator->passes()) {
            $roles = Role::create([
                'role' => $request->input('role'),
                'rdescription' => $request->input('rdescription'),
                'user_id'=> $role_id,
                'added_by'=> $z->role,
                'created_at' => date("Y-m-d H:i:s")
            ]);

            if (!empty($roles->id)) {
                $request->session()->flash('message', 'Role added successfully.');
            } else {
                $request->session()->flash('exception', 'Operation failed !');
            }

            return Response::json(['success' => '1']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    public function show($id)
    {
        $roles = Role::all();
        echo json_encode($roles[0]);
    }

    public function edit($id)
    {
        $z = Auth::user();
        $crole = $z->role;
        $role_id = $z->id;

        $rpermissions = DB::select('SELECT
            `roles`.`role`,
            `permissions`.*
        FROM
            `roles`
        LEFT JOIN `role_credentials`
            ON `role_credentials`.`role_id` = `roles`.`id`
        LEFT JOIN `permissions`
            ON `permissions`.`id` = `role_credentials`.`menu_id`
        WHERE `role_credentials`.`role_id` = '.$id.'
        AND `permissions`.`user_id` = "'.$role_id.'"
        AND `permissions`.`added_by` = "'.$crole.'" ');
        echo json_encode($rpermissions);
    }

    public function update(Request $request, $id)
    {
        $roles = Role::find($id);
        $validator = $validator = Validator::make(
            $request->all(),
            [
            'role' => 'required|regex:/^[\pL\s\-]+$/u',
            'rdescription' => 'required'
            ],
            [
            'rdescription.required' => 'The Role Description is required.',
            ]
        );

        if ($validator->passes()) {
            $roles->role = $request->get('role');
            $roles->rdescription = $request->get('rdescription');
            // $roles->added_by => $z->role;
            $roles->updated_at = date("Y-m-d H:i:s");

            $affected_row = $roles->save();

            if (!empty($affected_row)) {
                $request->session()->flash('message', 'Role updated successfully.');
            } else {
                $request->session()->flash('exception', 'Operation failed !');
            }
            return Response::json(['success' => '1']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    public function destroy($id)
    {
        $roles = Role::find($id);
        if ($roles) {
            $roles->delete();
            return redirect()->back()->with('message', 'Role delete successfully.');
        } else {
            return redirect()->back()->with('exception', 'Role not found !');
        }
    }
    public function bulkDestroy($ids)
    {


        $deleteUsers =  Role::whereIn('id', $ids)
            ->delete();

        if ($deleteUsers) {
            $result = ['affected_row'=>$deleteUsers,'status'=>'success'];
        } else {
            $result = ['affected_row'=>$deleteUsers,'status'=>'failed'];
        }
        return $result;
    }
    public function bulkDestroyRequest(Request $request)
    {
        $ids = json_decode($request->get('ids'), true);
        $delete = $this->bulkDestroy($ids);
        if ($delete) {
            return redirect()->back()->with('message', 'Role deleted successfully.');
        }
        return redirect()->back()->with('exception', 'Role not found !');
    }
}
