<?php

namespace App\Http\Controllers;

use App\Rolepermissions;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use Carbon\Carbon;

class RolepermissionsController extends Controller
{
     /**
     * Construct
     * 
     * @return void
    */
	public function __construct()
    {
        if (Session::has('user')) {
            if ($user->role == 'user') {
                return redirect()->back()->with(array("fail" => "You have have no authorisation."))->withInput();
            }
        } else {
            return redirect("/")->with(array("fail" => "You have to Login first to access our features."))->withInput();
        }
    }

    /**
     * Role permission index
     *   
	 * @return view
    */
	public function index()
    {
        $z = Session::get('user');
        $role_id = $z->role;
        if ($role_id != "") {
            redirect('/');
        }
    }

    /**
     * Destroy role
     *   
     * @param integer $id 
	 * @redirect
    */
	public function destroy($id)
    {
        $rolepermissions = Rolepermissions::find($id);
        if ($roles) {
            $roles->delete();
            return redirect()->back()->with('message', 'Role Permission deleted successfully.');
        } else {
            return redirect()->back()->with('exception', 'Role not found !');
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


        $deleteUsers =  Rolepermissions::whereIn('id', $ids)
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
            return redirect()->back()->with('message', 'Permission deleted successfully.');
        }
        return redirect()->back()->with('exception', 'Permission not found !');
    }
    
	/**
     * Updated role
     *   
     * @param Request $request
	 * @return JSON
    */
	public function roleupdate(Request $request)
    {
        $z = Session::get('user');
        $user_id = $z->role;

        $role_id = $_GET['role_id'];
        return redirect('admin.rolepermission.destroy', $role_id);
        $menu = array();
        $menu = $$_GET['menu_id[]'];
        foreach ($menu as $menu_id) {
            $rolepermissions->role_id = $role_id;
            $rolepermissions->menu_id = $menu_id;
            $rolepermissions->user_id = $user_id;
            $rolepermissions->created_at = date("Y-m-d H:i:s");
            $affected_row = $rolepermissions->save();
        }
        if (!empty($affected_row)) {
            $request->session()->flash('message', 'Role Permission updated successfully.');
        } else {
            $request->session()->flash('exception', 'Operation failed !');
        }
        return Response::json(['success' => '1']);
    }
    
	/**
     * Updated role
     *   
     * @param Request $request
	 * @redirect
    */
	public function update(Request $request)
    {
        $menu = array();
        $menu = $_POST['menu_id'];
        $role_id = $_POST['role_id'];
        Rolepermissions::where(array("role_id"=>$role_id))->delete();
       
        //return redirect('admin.rolepermission.destroy',$role_id);
        
        foreach ($menu as $menu_id) {
//            $rolepermissions->role_id = $role_id;
//            $rolepermissions->menu_id = $menu_id;
//            $rolepermissions->created_at = date("Y-m-d H:i:s");
            $affected_row = Rolepermissions::create([
                "role_id" => $role_id,
                "menu_id" => $menu_id,
                "created_at" => date("Y-m-d H:i:s")
            ]);
        }
        if (!empty($affected_row)) {
            $request->session()->flash('message', 'Role Permission updated successfully.');
        } else {
            $request->session()->flash('exception', 'Operation failed !');
        }
        return redirect()->route('admin.roles.index');
    }
}
