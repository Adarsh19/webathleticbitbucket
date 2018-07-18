<?php

namespace App\Http\Controllers;

use App\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Auth;

class UserStatusController extends Controller
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

   /**
    * User status index
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
        $userStatus = UserStatus::all();
        return view('admin.user_status.index', compact('userStatus'));
    }

   /**
    * Add user status
    *
    * @return array
    */	
	public function create()
    {
        $z = Auth::user();
        $role_id = $z->id;
        $crole = $z->role;
        return Package::create([
            'status' => $data['status'],
            'description' => $data['description'],
            'user_id' => $role_id,
            'added_by' => $crole, 
            'status_type' => $data['status_type'], 
        ]);
    }
	
	/**
     * Get user statuc
     *
     * @return JSON
     */
    public function get()
    {
        $z = Auth::user();
        $crole = $z->role;
        $role_id = $z->id;
        if ($z->role != "admin") {
            $user_statuses = DB::select('SELECT
                    `user_statuses`.*, `users`.`name` as user_name, `users`.`role` as user_role
                FROM
                    `user_statuses`
                inner join `users` on `users`.`id` = `user_statuses`.`user_id` 
                WHERE `user_statuses`.`user_id` = "'.$role_id.'"
                AND `user_statuses`.`added_by` = "'.$crole.'" ');
        } else {
            // $user_statuses = UserStatus::all();
            $user_statuses = DB::select('SELECT
                    `user_statuses`.*, `users`.`name` as user_name, `users`.`role` as user_role
                FROM
                    `user_statuses`
                inner join `users` on `users`.`id` = `user_statuses`.`user_id` 
                 ');
        }
        $data = array();
        foreach ($user_statuses as $user_statuses) {
            $cdate = date("d-m-Y", strtotime($user_statuses->created_at));
            $udate = date("d-m-Y", strtotime($user_statuses->updated_at));
            $row = array();
            $row['id'] = $user_statuses->id;
            $row['status'] = $user_statuses->status;
            $row['description'] = $user_statuses->description;
            $row['status_type'] = $user_statuses->status_type;
            $row['created_at'] = $cdate;
            $row['updated_at'] = $udate;
            $row['user_name'] = $user_statuses->user_name;
            $row['user_role'] = $user_statuses->user_role;
            $row['action'] =  '<button class="btn btn-info btn-xs view-button" onclick = "view(' . $user_statuses->id . ');" data-id="' . $user_statuses->id . '" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye"></i></button> 
                      <button class="btn btn-primary btn-xs edit-button" onclick = "edit(' . $user_statuses->id . ');" data-id="' . $user_statuses->id . '" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></button>
                      <button class="btn btn-danger btn-xs delete-button" onclick = "remove(' . $user_statuses->id . ');" data-id="' . $user_statuses->id . '"data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash"></i></button>';
            $data[] = $row;
        }
        if (empty($user_statuses)) {
            $data = array();
        }
        return Response::json([ 'data' => $data ]);
    }

    /**
     * Store
     *
     * @param Request $request
     * @return JSON
     */
	public function store(Request $request)
    {
        $z = Auth::user();
        $role_id = $z->id;
        $crole = $z->role;
        $validator = $validator = Validator::make(
            $request->all(),
            [
            'status' => 'required|regex:/^[\pL\s\-]+$/u',
            'description' => 'required'
            ],
            [
            'description.required' => 'The Status Description is required.',
            ]
        );

        if ($validator->passes()) {
            $data= array(
                'status' => $request->input('status'),
                'description' => $request->input('description'),
                'user_id' => $role_id,
                'added_by' => $crole,
                'status_type' => $request->input('status_type'),
                'created_at' => date("Y-m-d H:i:s")
            );
            $user_statuses = UserStatus::create($data)->toSql();
            
            if (!empty($user_statuses->id)) {
                $request->session()->flash('message', 'Status added successfully.');
            } else {
                $request->session()->flash('exception', 'Operation failed !');
            }

            return Response::json(['success' => '1']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

     /**
     * Show
     *
     * @param interger $id
     * @return JSON
     */
	public function show($id)
    {
        $permissions = UserStatus::where('id', $id)->first();
        echo json_encode($permissions);
    }

     /**
     * Edit
     *
     * @param interger $id
     * @return JSON
     */
	public function edit($id)
    {
        $permissions = UserStatus::where('id', $id)->first();
        echo json_encode($permissions);
    }

     /**
     * Update
     *
     * @param Request $request
     * @param interger $id
     * @return JSON
     */
	public function update(Request $request, $id)
    {
        $user_statuses = UserStatus::find($id);

        $validator = $validator = Validator::make(
            $request->all(),
            [
            'status' => 'required|regex:/^[\pL\s\-]+$/u',
            'description' => 'required',
            'status_type' => 'required',
            ],
            [
            'description.required' => 'The Status Description is required.',
            ]
        );

        if ($validator->passes()) {
            $user_statuses->status = $request->get('status');
            $user_statuses->description = $request->get('description');
            $user_statuses->updated_at = date("Y-m-d H:i:s");

            $affected_row = $user_statuses->save();

            if (!empty($affected_row)) {
                $request->session()->flash('message', 'Status updated successfully.');
            } else {
                $request->session()->flash('exception', 'Operation failed !');
            }
            return Response::json(['success' => '1']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

     /**
     * Destroy
     *
     * @param interger $id
     * @redirect
     */
	public function destroy($id)
    {
        $user_statuses = UserStatus::find($id);
        if ($user_statuses) {
            $user_statuses->delete();
            return redirect()->back()->with('message', 'Status delete successfully.');
        } else {
            return redirect()->back()->with('exception', 'Status not found !');
        }
    }

     /**
     * Bulk destroy
     *
     * @param string $ids
     * @return array
     */
	public function bulkDestroy($ids)
    {


        $deleteUsers =  UserStatus::whereIn('id', $ids)
           ->delete();

        if ($deleteUsers) {
            $result = ['affected_row'=>$deleteUsers,'status'=>'success'];
        } else {
            $result = ['affected_row'=>$deleteUsers,'status'=>'failed'];
        }
        return $result;
    }
	
	 /**
     * Bulk destroy request
     *
     * @param Request $request
     * @redirect
     */
    public function bulkDestroyRequest(Request $request)
    {
        $ids = json_decode($request->get('ids'), true);
        $delete = $this->bulkDestroy($ids);
        if ($delete) {
            return redirect()->back()->with('message', 'User deleted successfully.');
        }
        return redirect()->back()->with('exception', 'User not found !');
    }
}
