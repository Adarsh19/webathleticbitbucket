<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\PermissionPivot;
use Auth;

class PermissionsController extends Controller
{
    public function __construct()
    {
        if (Auth::user()) {
            $user = Auth::user();
            if ($user->role != 'admin') {
                return redirect()->back()->with(array("fail" => "You have have no authorisation."))->withInput();
            }
        } else {
            return redirect("/")->with(array("fail" => "You have to Login first to access our features."))->withInput();
        }
    }

    public function index()
    {
        $user = Auth::user();
        $role_id = $user->role;
        if ($role_id != "") {
            redirect('/');
        }
        $permissions = Permission::all();
        return view('admin.permission.index', compact('permissions', 'user'));
    }

    public function create()
    {
        $z = Auth::user();
        $role_id = $z->id;
        $crole = $z->role;
        return Package::create([
            'permission' => $data['permission'],
            'pdescription' => $data['pdescription'],
            'user_id' => $role_id,
            'added_by' => $crole
        ]);
    }

    public function get()
    {
        $z = Auth::user();
        $crole = $z->role;
        $role_id = $z->id;
        if ($z->role != "admin") {
            $permissions = DB::select('SELECT
                    `permissions`.*
                FROM
                    `permissions`
                WHERE `user_id` = "'.$role_id.'"
                AND `added_by` = "'.$crole.'" ');
        } else {
            $permissions = Permission::all();
        }
        foreach ($permissions as $customers) {
            $cdate = date("d-m-Y", strtotime($customers->created_at));
            $udate = date("d-m-Y", strtotime($customers->updated_at));
            $row = array();
            $row['id'] = $customers->id;
            $row['permission'] = $customers->permission;
            $row['pdescription'] = $customers->pdescription;
            $row['created_at'] = $cdate;
            $row['updated_at'] = $udate;
            $row['action'] =  '<button class="btn btn-info btn-xs view-button" onclick = "permissionView(' . $customers->id . ');" data-id="' . $customers->id . '" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye"></i></button> 
                      <button class="btn btn-primary btn-xs edit-button" onclick = "permissionEdit(' . $customers->id . ');" data-id="' . $customers->id . '" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></button>
                      <button class="btn btn-danger btn-xs delete-button" onclick = "permissionRemove(' . $customers->id . ');" data-id="' . $customers->id . '"data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash"></i></button>';
            $data[] = $row;
        }
        if ($permissions == array()) {
            $data = array();
        }
        return Response::json([ 'data' => $data ]);
    }

    public function store(Request $request)
    {
        $z = Auth::user();
        $role_id = $z->id;
        $crole = $z->role;
        $validator = $validator = Validator::make(
            $request->all(),
            [
            'permission' => 'required|regex:/^[\pL\s\-]+$/u',
            'route_name' => 'required',
            'pdescription' => 'required'

            ],
            [
            'pdescription.required' => 'The Permission Description is required.',
            ]
        );

        if ($validator->passes()) {
            $data= array(
                'route_name' => $request->input('route_name'),
                'dependent_routes' => $request->input('dependent_routes'),
                'block_name' => $request->input('block_name'),
                'permission' => $request->input('permission'),
                'pdescription' => $request->input('pdescription'),
                'user_id' => $role_id,
                'added_by' => $crole,
                'created_at' => date("Y-m-d H:i:s")
            );
            $permissions = Permission::create($data)->toSql();
            
            if (!empty($permissions->id)) {
                $request->session()->flash('message', 'Permission added successfully.');
            } else {
                $request->session()->flash('exception', 'Operation failed !');
            }

            return Response::json(['success' => '1']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    public function show($id)
    {
        $permissions = Permission::where('id', $id)->first();
        echo json_encode($permissions);
    }

    public function edit($id)
    {
        $permissions = Permission::where('id', $id)->first();
        echo json_encode($permissions);
    }

    public function update(Request $request, $id)
    {
        $permissions = Permission::find($id);

        $validator = $validator = Validator::make(
            $request->all(),
            [
            'permission' => 'required|regex:/^[\pL\s\-]+$/u',
            'route_name' => 'required',
            'pdescription' => 'required'
            ],
            [
            'pdescription.required' => 'The Permission Description is required.',
            ]
        );

        if ($validator->passes()) {
            $permissions->route_name=$request->get('route_name');
            $permissions->dependent_routes= $request->get('dependent_routes');
            $permissions->block_name=$request->get('block_name');
               
            $permissions->permission = $request->get('permission');
            $permissions->pdescription = $request->get('pdescription');
            $permissions->updated_at = date("Y-m-d H:i:s");

            $affected_row = $permissions->save();

            if (!empty($affected_row)) {
                $request->session()->flash('message', 'Permission updated successfully.');
            } else {
                $request->session()->flash('exception', 'Operation failed !');
            }
            return Response::json(['success' => '1']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    public function destroy($id)
    {
        $permissions = Permission::find($id);
        if ($permissions) {
            $permissions->delete();
            return redirect()->back()->with('message', 'Permission delete successfully.');
        } else {
            return redirect()->back()->with('exception', 'Permission not found !');
        }
    }
    public function bulkDestroy($ids)
    {


        $deleteUsers =  Permission::whereIn('id', $ids)
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
            return redirect()->back()->with('message', 'Permission deleted successfully.');
        }
        return redirect()->back()->with('exception', 'Permission not found !');
    }
    public function get_permissions_for_attach_role(Request $request)
    {
        $roleId = $request->get('id');
        $data = Permission::all();
        return view('admin.permission.attach-permissions', compact('data', 'roleId'));
    }

    public function set_permissions_for_attach_role(Request $request)
    {
        $action = $request->post('action');
        $roleId = $request->post('roleid');
        $permissionId = $request->post('permissionid');
        $userId = $request->post('userid');
        if ($action == 'add') {
            $data = array(
            'role_id' => $roleId,
            'permission_id' => $permissionId,
            'user_id' => $userId
            );
            $result = PermissionPivot::create($data);
            if (!empty($data)) {
                $status = 'Permission attached successfully';
            } else {
                $status = 'Oops! Permission not attached.';
            }
            return Response::json($status);
        }
        if ($action == 'remove') {
            $data = PermissionPivot::where('role_id', $roleId)->where('permission_id', $permissionId)->delete();
            if (!empty($data)) {
                $status = 'Permission removed successfully';
            } else {
                $status = 'Oops! Permission not removed';
            }
            return Response::json($status);
        }
    }
}
