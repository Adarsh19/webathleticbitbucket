<?php

namespace App\Http\Controllers;

use App\Service;
use App\Company;
use App\CompanyUI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Http\Middleware\CheckAdminOrCompanyMiddleware;

use App\Package;
use App\Role;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(CheckAdminOrCompanyMiddleware::class, ['except' => ['show','update','userview']]);
        // if (Auth::user()){
        //     $user = Auth::user();;
        //     if($user->role == 'user'){
        //         return redirect()->back()->with(array("fail" => "You have have no authorisation."))->withInput();
        //     }
        // } else {
        //     return redirect("/")->with(array("fail" => "You have to Login first to access our features."))->withInput();
        // }
    }

    public function index($slug="")
    {

        $is_company = false;
        $company_data = array();
        $hasUI = false;
        if(isset($slug) && $slug != ""){
            $company = Company::where("slug", $slug)->first();
            if(!empty($company)){
                $hasUI = CompanyUI::where("company_id", $company->id)->get()->count();
                $is_company = true;
                $company_data['logo'] = $company->logo;
                $company_data['slug'] = $company->slug;
                $company_data['name'] = $company->name;
                $company_data['id'] = $company->id;
                $company_data['ui'] = CompanyUI::where("company_id", $company->id)->first();
            }
        }

        $user = Auth::user();
        $role_id = $user->role;
        $crole = $user->id;
        // if($role_id != ""){
        //     redirect('/');
        // }
        $packages = DB::select('SELECT
                `packages`.*,
                `services`.`service`,
                `roles`.`role`
            FROM
                `packages`
            LEFT JOIN `package_services`
                ON `package_services`.`package_id` = `packages`.`id`
            LEFT JOIN `services`
                ON `services`.`id` = `package_services`.`service_id`
            LEFT JOIN `roles`
                ON `roles`.`id` = `packages`.`role_id`');
        $services = Service::all();
        $companys = Company::orderBy('created_at', 'DESC')->get();
        if ($user->role != "admin") {
            $roles = DB::select('SELECT
                    `roles`.*
                FROM
                    `roles`
                WHERE `user_id` = "'.$role_id.'"
                AND `added_by` = "'.$crole.'" ');
        } else {
            $roles =  Role::all();
        }
        return view('admin.service.index', compact('services', 'packages', 'user', 'roles', 'companys', 'company_data', 'is_company', 'hasUI'));
    }

    public function userview($slug="", Request $request)
    {

        $is_company = false;
        $company_data = array();
        $hasUI = false;
        if(isset($slug) && $slug != ""){
            $company = Company::where("slug", $slug)->first();
            if(!empty($company)){
                $hasUI = CompanyUI::where("company_id", $company->id)->get()->count();
                $is_company = true;
                $company_data['logo'] = $company->logo;
                $company_data['slug'] = $company->slug;
                $company_data['name'] = $company->name;
                $company_data['id'] = $company->id;
                $company_data['ui'] = CompanyUI::where("company_id", $company->id)->first();
            }
            $packages = DB::select('SELECT
                `packages`.*,
                `companies`.`slug`,
                `services`.`service`,
                `services`.`sdescription`
            FROM
                `packages`
            LEFT JOIN `companies`
                ON `companies`.`id` = `packages`.`company_id`
            LEFT JOIN `package_services`
                ON `package_services`.`package_id` = `packages`.`id`
            LEFT JOIN `services`
                ON `services`.`id` = `package_services`.`service_id`
              Where  `companies`.`slug` = "'.$slug.'"');
        } else {
            $packages = DB::select('SELECT
                `packages`.*,
                `companies`.`slug`,
                `services`.`service`,
                `services`.`sdescription`
            FROM
                `packages`
            LEFT JOIN `companies`
                ON `companies`.`id` = `packages`.`company_id`
            LEFT JOIN `package_services`
                ON `package_services`.`package_id` = `packages`.`id`
            LEFT JOIN `services`
                ON `services`.`id` = `package_services`.`service_id`');
        }
        return view('pages.services', compact('packages', 'user', 'companys', 'company_data', 'is_company', 'hasUI'));
    }

    public function create()
    {
        $z = Auth::user();
        ;
        $role_id = $z->id;
        return Service::create([
            'service' => $data['service'],
            'sdescription' => $data['sdescription'],
            'sprice' => $data['sprice'],
            'user_mass' => $data['user_mass'],
            'payment_time' => $data['payment_time'],
            'company_id'=> $role_id,
            'added_by'=> $z->role
        ]);
    }

    // public function get()
    // {
    //     // $roles = Role::all();
    //     $z = Auth::user();
    //     if($z->role != "admin"){
    //         $role_id = $z->id;
    //         $services = DB::select('SELECT
    //                                     `services`.*
    //                                 FROM
    //                                     `services`
    //                                 WHERE `company_id` = "'.$role_id.'"
    //                                 AND `added_by` = "'.$z->role.'" ');
    //         foreach ($services as $customers) {
    //             $cdate = date("d-m-Y", strtotime($customers->created_at));
    //             $udate = date("d-m-Y", strtotime($customers->updated_at));
    //             $row = array();
    //             $row['service'] = $customers->service;
    //             $row['sdescription'] = $customers->sdescription;
    //             $row['sprice'] = $customers->sprice;
    //             $row['user_mass'] = $customers->user_mass;
    //             $row['payment_time'] = $customers->payment_time;
    //             $row['created_at'] = $cdate;
    //             $row['updated_at'] = $udate;
    //             $row['action'] =  '<button class="btn btn-info btn-xs view-button" onclick = "view(' . $customers->id . ');" data-id="' . $customers->id . '" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye"></i></button>
    //                       <button class="btn btn-primary btn-xs edit-button" onclick = "edit(' . $customers->id . ');" data-id="' . $customers->id . '" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></button>
    //                       <button class="btn btn-danger btn-xs delete-button" onclick = "remove(' . $customers->id . ');" data-id="' . $customers->id . '"data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash"></i></button>';
    //             $data[] = $row;
    //         }
    //     }else{
    //         $services = DB::select('SELECT
    //             `services`.*,
    //             `companies`.`name` as `cname`
    //         FROM
    //             `services`
    //         LEFT JOIN `companies`
    //             ON `companies`.`id` = `services`.`company_id`');
    //         foreach ($services as $customers) {
    //             $cdate = date("d-m-Y", strtotime($customers->created_at));
    //             $udate = date("d-m-Y", strtotime($customers->updated_at));
    //             $row = array();
    //             $row['service'] = $customers->service;
    //             $row['sdescription'] = $customers->sdescription;
    //             $row['sprice'] = $customers->sprice;
    //             $row['user_mass'] = $customers->user_mass;
    //             $row['payment_time'] = $customers->payment_time;
    //             $row['cname'] = $customers->cname;
    //             $row['created_at'] = $cdate;
    //             $row['updated_at'] = $udate;
    //             $row['action'] = '<button class="btn btn-info btn-xs view-button" onclick = "view(' . $customers->id . ');" data-id="' . $customers->id . '" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye"></i></button>
    //                       <button class="btn btn-primary btn-xs edit-button" onclick = "edit(' . $customers->id . ');" data-id="' . $customers->id . '" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></button>
    //                       <button class="btn btn-danger btn-xs delete-button" onclick = "remove(' . $customers->id . ');" data-id="' . $customers->id . '"data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash"></i></button>';
    //             $data[] = $row;
    //         }
    //     }
    //     if($services == array()){
    //         $data = array();
    //     }
    //     return Response::json( [ 'data' => $data ] );
    // }

    // created-by: sub-MDK 30-05-18
    public function get()
    {
        $z = Auth::user();
        $data = array();
        if ($z->role != "admin") {
            $role_id = $z->id;
            $services = DB::table('services')
                ->select('id', 'service', 'sdescription', 'sprice', 'user_mass', 'payment_time', 'created_at', 'updated_at')
                ->where('company_id', $role_id)
                ->where('added_by', $z->role)
                ->get();
        } else {
            $services = DB::table('services')
                ->select('services.id', 'services.service', 'services.sdescription', 'services.sprice', 'services.user_mass', 'services.payment_time', 'services.created_at', 'services.updated_at', DB::raw('companies.name as cname'))
                ->leftjoin('companies', 'companies.id', '=', 'services.company_id')
                ->get();
        }
            
        foreach ($services as $customers) {
            $row = array();
            $row['id'] = $customers->id;
            $row['service'] = $customers->service;
            $row['sdescription'] = $customers->sdescription;
            $row['sprice'] = $customers->sprice;
            $row['user_mass'] = $customers->user_mass;
            $row['payment_time'] = $customers->payment_time;
            if ($z->role == "admin") {
                $row['cname'] = $customers->cname;
            }
            $row['created_at'] = date("d-m-Y", strtotime($customers->created_at));
            $row['updated_at'] = date("d-m-Y", strtotime($customers->updated_at));
            $row['action'] = '<button class="btn btn-info btn-xs view-button" onclick = "view_service(' . $customers->id . ');" data-id="' . $customers->id . '" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye"></i></button> 
                      <button class="btn btn-primary btn-xs edit-button" onclick = "edit_service(' . $customers->id . ');" data-id="' . $customers->id . '" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></button>
                      <button class="btn btn-danger btn-xs delete-button" onclick = "remove_service(' . $customers->id . ');" data-id="' . $customers->id . '"data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash"></i></button>';
            $data[] = $row;
        }
        return Response::json([ 'data' => $data ]);
    }

    public function store(Request $request)
    {
        $z = Auth::user();
        ;
        $role_id = $z->id;
        $validator = $validator = Validator::make(
            $request->all(),
            [
            'service' => 'required|regex:/^[\pL\s\-]+$/u',
            'sdescription' => 'required',
            'sprice' => 'required|numeric',
            'user_mass' => 'required|numeric',
            'payment_time' => 'required|numeric'
            ],
            [
            'sdescription.required' => 'The Service Description is required.',
            'sprice.required' => 'The Service Price is required.',
            'sprice.numeric' => 'The Service Price is must be in digits.',
            'user_mass.required' => 'The Service Users is required.',
            'user_mass.numeric' => 'The Service Users is must be in digits.',
            'payment_time.required' => 'The Service Payment Time is required.',
            'payment_time.numeric' => 'The Service Payment Time is must be in minuts.',
            ]
        );

        if ($validator->passes()) {
            $services = Service::create([
                'service' => $request->input('service'),
                'sdescription' => $request->input('sdescription'),
                "sprice" => $request->input('sprice'),
                "user_mass" => $request->input('user_mass'),
                "payment_time" => $request->input('payment_time'),
                "company_id" => $role_id,
                'added_by' => $z->role,
                'created_at' => date("Y-m-d H:i:s")
            ]);

            if (!empty($services->id)) {
                $request->session()->flash('message', 'Service added successfully.');
            } else {
                $request->session()->flash('exception', 'Operation failed !');
            }

            return Response::json(['success' => '1']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    public function show($id)
    {
        $services = DB::select('SELECT
                `services`.*,
                `companies`.`company_name` as `cname`
            FROM
                `services`
            LEFT JOIN `companies`
                ON `companies`.`id` = `services`.`company_id`
            Where  `services`.`id` = '.$id);
        echo json_encode($services[0]);
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $services = Service::find($id);
        $validator = $validator = Validator::make(
            $request->all(),
            [
            'service' => 'required|regex:/^[\pL\s\-]+$/u',
            'sdescription' => 'required',
            'sprice' => 'required|numeric',
            'user_mass' => 'required|numeric',
            'payment_time' => 'required|numeric'
            ],
            [
            'sdescription.required' => 'The Service Description is required.',
            'sprice.required' => 'The Service Price is required.',
            'sprice.numeric' => 'The Service Price is must be in digits.',
            'user_mass.required' => 'The Service Users is required.',
            'user_mass.numeric' => 'The Service Users is must be in digits.',
            'payment_time.required' => 'The Service Payment Time is required.',
            'payment_time.numeric' => 'The Service Payment Time is must be in minuts.',
            ]
        );

        if ($validator->passes()) {
            $services->service = $request->get('service');
            $services->sdescription = $request->get('sdescription');
            $services->sprice = $request->get('sprice');
            $services->user_mass = $request->get('user_mass');
            $services->payment_time = $request->get('payment_time');
            if ($request->get('company_id') != null) {
                $services->company_id = $request->get('company_id');
            }
            $services->updated_at = date("Y-m-d H:i:s");
            // echo "<pre>service: ";print_r($services);exit();
            $affected_row = $services->save();

            if (!empty($affected_row)) {
                $request->session()->flash('message', 'Service updated successfully.');
            } else {
                $request->session()->flash('exception', 'Operation failed !');
            }
            return Response::json(['success' => '1']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    public function destroy($id)
    {
        $services = Service::find($id);
        if ($services) {
            $services->delete();
            return redirect()->back()->with('message', 'Service delete successfully.');
        } else {
            return redirect()->back()->with('exception', 'Service not found !');
        }
    }

    public function bulkDestroy($ids)
    {


        $deleteUsers =  Service::whereIn('id', $ids)
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
            return redirect()->back()->with('message', 'Service deleted successfully.');
        }
        return redirect()->back()->with('exception', 'Service not found !');
    }
}
