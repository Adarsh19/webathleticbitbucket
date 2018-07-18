<?php

namespace App\Http\Controllers;

use App\Package;
use App\Service;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Auth;
use App\PackageService;

use App\Company;
use App\CompanyInvoice;
use App\User;
use App\PackageHistory;
use PDF;
use DateTime;

class PackageController extends Controller
{
    public function __construct()
    {
        if (Auth::user()) {
            $user = Auth::user();
            if ($user->role == 'user') {
                return redirect()->back()->with(array("fail" => "You have have no authorisation."))->withInput();
            }
        } else {
            return redirect("/")->with(array("fail" => "You have to Login first to access our features."))->withInput();
        }
    }

    public function index(Request $request)
    {
        $finance = $request->finance;
        $user = Auth::user();
        $role_id = $user->role;
        $crole = $user->id;
        // if($role_id != ""){
        //     redirect('/');
        // }
 
        $packages = DB::select('SELECT
                `packages`.*,
                `roles`.`role`,
                company_name
            FROM
                `packages`
            LEFT JOIN `companies`
                    ON `companies`.`id` = `packages`.`company_id`
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
        return view('admin.package.index', compact('services', 'packages', 'user', 'roles', 'companys', 'finance'));
    }

    public function create()
    {

        $z = Auth::user();
        $role_id = $z->id;
        if (isAdmin()) {
            $company_id=$data['company_id'];
        } else {
            $company_id=$z->parent_id;
        }

        return Package::create([
            'name'=>$data['name'],
            'company_id' => $company_id,
            'days' => $data['days'],
            'credits' => $data['credits'],
            'products' => $data['service'],
            'pro_rato' => $data['pro_rato'],
            'expand_automatically' => $data['expand_automatically'],
            'Start_fee' => $data['Start_fee'],
            'entree' => $data['entree'],
            'sell_category' => $data['sell_category'],
            'enquette' => $data['enquette'],
            'payment_days' => $data['payment_days'],
            'max_users' => $data['max_users'],
            'added_by'=> $z->role,
            'user_id'=> $data['role_id']
        ]);
    }

    public function get()
    {
        $z = Auth::user();
        $crole = $z->role;
        $role_id = $z->id;
        $crole = $z->id;
        if ($z->role != "admin") {
                $packages = DB::select('SELECT
                    `packages`.*,
                    company_name
                FROM
                    `packages`
                LEFT JOIN `companies`
                    ON `companies`.`id` = `packages`.`company_id`
                WHERE `packages`.`user_id` = "'.$role_id.'"
                AND `packages`.`added_by` = "'.$crole.'"');
        } else {
            $packages = DB::select('SELECT
                    `packages`.*,
                    company_name
                FROM
                    `packages`
                LEFT JOIN `companies`
                    ON `companies`.`id` = `packages`.`company_id`
                ');
        }
        foreach ($packages as $customers) {
            if ($customers->expand_automatically == 0) {
                $eauto = '<a href="' . route('admin.activatedPackageRoute', $customers->id) . '" data-toggle="tooltip" data-original-title="Click to Activate"><button  class="btn btn-warning btn-xs btn-flat btn-block"><i class="icon fa fa-arrow-down"></i>Inactive</button></a>';
            }
            if ($customers->expand_automatically == 1) {
                $eauto = '<a href="' . route('admin.deactivatedPackageRoute', $customers->id) . '" data-toggle="tooltip" data-original-title="Click to Deactivate"><button  class="btn btn-success btn-xs btn-flat btn-block"><i class="icon fa fa-arrow-up"></i>Active</button></a>';
            }
            $cdate = date("d-m-Y", strtotime($customers->created_at));
            $udate = date("d-m-Y", strtotime($customers->updated_at));
            $row = array();
            $row['id'] = $customers->id;
            $row['name'] = $customers->name;
            $row['company_name'] = $customers->company_name;
            $row['days'] = $customers->days;
            $row['credits'] = $customers->credits;
            $row['pro_rato'] = $customers->pro_rato;
            $row['Start_fee'] = $customers->Start_fee;
            $row['entree'] = $customers->entree;
            $row['enquette'] = $customers->enquette;
            $row['sell_category'] = $customers->sell_category;
            $row['max_users'] = $customers->max_users;
            $row['eauto'] = $eauto;
            $row['created_at'] = $cdate;
            $row['updated_at'] = $udate;
            $row['action'] =  '<button class="btn btn-info btn-xs view-button" onclick = "view(' . $customers->id . ');" data-id="' . $customers->id . '" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye"></i></button> 
                      <button class="btn btn-primary btn-xs edit-button" onclick = "edit(' . $customers->id . ');" data-id="' . $customers->id . '" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></button>
                      <button class="btn btn-danger btn-xs delete-button" onclick = "remove(' . $customers->id . ');" data-id="' . $customers->id . '"data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash"></i></button>
					  <a href="/admin/download-pdf/' . $customers->id . '" target="_blank"><button class="btn btn-success btn-xs check-in-user"  data-id="' . $customers->id . '"data-toggle="tooltip" data-original-title="View Invoice"><i class="fa fa-file-pdf-o"></i></button></a>';
            $data[] = $row;
        }
        if ($packages == array()) {
            $data = array();
        }
        return Response::json([ 'data' => $data ]);
    }

    public function activated($id)
    {
        $affected_row = Package::where('id', $id)
            ->update(['expand_automatically' => 1]);

        if (!empty($affected_row)) {
            return redirect()->back()->with('message', 'Activated successfully.');
        }
        return redirect()->back()->with('exception', 'Operation failed !');
    }

    public function deactivated($id)
    {
        $affected_row = Package::where('id', $id)
            ->update(['expand_automatically' => 0]);

        if (!empty($affected_row)) {
            return redirect()->back()->with('message', 'Deactivated successfully.');
        }
        return redirect()->back()->with('exception', 'Operation failed !');
    }

    public function companyPackages(Request $request)
    {
        $company_id = $request->input('company_id');
        $packages = Package::where("company_id", $company_id)->get();

        return Response::json(['packages' => $packages]);
    }

    public function store(Request $request)
    {
        $z = Auth::user();
        $role_id = $z->id;
        $crole = $z->role;
        $validator = $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'service' => 'required',
            'days' => 'required|numeric',
            'credits' => 'required|numeric',
            'pro_rato' => 'required|numeric',
            'expand_automatically' => 'required',
            'sell_category' => 'required',
            'payment_days' => 'required',
            'role_id' => 'required',
            'max_users' => 'required|numeric',
            'Start_fee' => 'required|numeric',
            'entree' => 'required|numeric',
        ]);

        if ($validator->passes()) {
            $package = Package::create([
                'company_id'=>isAdmin()?$request->get('company_id'):Auth::user()->parent_id,
                'name' => $request->input('name'),
                'days' => $request->input('days'),
                'credits' => $request->input('credits'),
                'pro_rato' => $request->input('pro_rato'),
                'expand_automatically' => $request->input('expand_automatically'),
                'Start_fee' => $request->input('Start_fee'),
                'entree' => $request->input('entree'),
                'sell_category' => $request->input('sell_category'),
                'payment_days' => $request->input('payment_days'),
                'role_id' => $request->input('role_id'),
                'max_users' => $request->input('max_users'),
                'user_id' => $z->id,
                'added_by'=> $crole,
                'created_at' => date("Y-m-d H:i:s")
            ]);

            if (!empty($package->id)) {
                foreach($request->input('service') as $service){
                    $services = PackageService::create([
                        'package_id' => $package->id,
                        'service_id' => $service,
                        'created_at' => date("Y-m-d H:i:s")
                    ]);                    
                }
                $request->session()->flash('message', 'Package added successfully.');
            } else {
                $request->session()->flash('exception', 'Operation failed !');
            }

            return Response::json(['success' => '1']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    public function show($id)
    {
        $packages = DB::select('SELECT
            `packages`.*,
            `services`.`service`,
            `roles`.`role`,company_name
        FROM
            `packages`
        LEFT JOIN `companies`
            ON `companies`.`id` = `packages`.`company_id`
        LEFT JOIN `package_services`
            ON `package_services`.`package_id` = `packages`.`id`
        LEFT JOIN `services`
            ON `services`.`id` = `package_services`.`service_id`
        LEFT JOIN `roles`
            ON `roles`.`id` = `packages`.`role_id`
        WHERE `packages`.`id` = '.$id);
        $services_all = DB::select('SELECT
            service_id
        FROM
            `package_services`
        WHERE `package_id` = '.$id);
        $services=[];
        foreach ($services_all as $service) {
            $services[]=$service->service_id;
        }
        $packages=$packages[0];
        $packages->services_all=$services;
       
        echo json_encode($packages);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $z = Session::get('user');
        $package = Package::find($id);

        $validator = $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'service' => 'required',
            'days' => 'required|numeric',
            'credits' => 'required|numeric',
            'pro_rato' => 'required|numeric',
            'expand_automatically' => 'required',
            'sell_category' => 'required',
            'role_id' => 'required',
            'payment_days' => 'required',
            'Start_fee' => 'required|numeric',
            'max_users' => 'required|numeric',
            'entree' => 'required|numeric',
            'enquette' => 'required|numeric',
        ]);

        if ($validator->passes()) {
            if(isAdmin()){
                $package->company_id = $request->get('company_id');
            }
            else
                $package->company_id = Auth::user()->parent_id;
            $package->name = $request->get('name');
            $package->days = $request->get('days');
            $package->credits = $request->get('credits');
            $package->pro_rato = $request->get('pro_rato');
            $package->expand_automatically = $request->get('expand_automatically');
            $package->Start_fee = $request->get('Start_fee');
            $package->entree = $request->get('entree');
            $package->enquette = $request->get('enquette');
            $package->payment_days = $request->get('payment_days');
            $package->sell_category = $request->get('sell_category');
            $package->role_id = $request->get('role_id');
            $package->max_users = $request->get('max_users');
            $package->user_id = \Auth::User()->id;
            $package->updated_at = date("Y-m-d H:i:s");

            $affected_row = $package->save();

            if (!empty($affected_row)) {
                PackageService::where('package_id',$package->id)->whereNotIn('service_id',$request->input('service'))->delete();
                foreach($request->input('service') as $service){
                    if(PackageService::where('package_id',$package->id)->where('service_id',$service)->count()==0)
                        $services = PackageService::create([
                            'package_id' => $package->id,
                            'service_id' => $service,
                            'created_at' => date("Y-m-d H:i:s")
                        ]);                    
                }
                $request->session()->flash('message', 'Package updated successfully.');
            } else {
                $request->session()->flash('exception', 'Operation failed !');
            }
            return Response::json(['success' => '1']);
        } else {
            return Response::json(['errors' => $validator->errors()]);
        }
    }

    public function destroy($id)
    {
        $packages = Package::find($id);
        if ($packages) {
            $packages->delete();
            return redirect()->back()->with('message', 'Package delete successfully.');
        } else {
            return redirect()->back()->with('exception', 'Package not found !');
        }
    }

    public function bulkDestroy($ids)
    {

        $deleteUsers =  Package::whereIn('id', $ids)
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
            return redirect()->back()->with('message', 'Package delete successfully.');
        }
        return redirect()->back()->with('exception', 'Package not found !');
    }	
	
	public function downloadPDF(Request $request, $id)
    {
    	$invoice = CompanyInvoice::where('company_invoice_id', $id)->first();
    	$package = Package::where('id', $invoice->package_id)->first();
    	$user =    User::where('id', $invoice->user_id)->first();	
    	$company = Company::where('id', $package->company_id)->first();			
		
		//echo "<pre>";print_r($company);die;
		
		//return view('admin.package.pdfView', compact('invoice', 'package', 'user', 'company'));
		$pdf = PDF::loadView('admin.package.pdfView', compact('invoice', 'package', 'user', 'company'));

		return $pdf->download('invoice-' . $invoice->invoice_number .'.pdf');

    }
	
	public function getinvoices()
    {
        $date = strtotime("+14 day");
		$dueDate = date('Y-m-d', $date);
		$z = Auth::user();
        $crole = $z->role;
        $role_id = $z->id;
        if ($z->role != "admin") {
                $invoices = DB::select('SELECT
                    `company_invoices`.*,
                    `packages`.`id`
                FROM
                    `company_invoices`
                LEFT JOIN `packages`
                    ON `packages`.`id` = `company_invoices`.`package_id`
                WHERE `packages`.`user_id` = "'.$role_id.'"
                AND `packages`.`added_by` = "'.$crole.'"
                AND `company_invoices`.`expand_automatically` = 0
				
				
				');
        } else {
            $invoices = DB::select('SELECT
                    `company_invoices`.*,
                    `packages`.`id`
                FROM `company_invoices`
                LEFT JOIN `packages`
                ON `packages`.`id` = `company_invoices`.`package_id` 
				WHERE`company_invoices`.`expand_automatically` = 0	
					');
        }
		//echo "<pre>";print_r($invoices);die;
		
        foreach ($invoices as $inv) {            

            $user =    User::where('id', $inv->user_id)->first();
			$package = Package::where('id', $inv->package_id)->first();
			$row = array();
            $row['id'] = $inv->company_invoice_id;
            $row['package_id'] = $package->name;
            $row['user_id'] = $user->name;
            $row['invoice_number'] = $inv->invoice_number;
            $row['quantity'] = $inv->quantity;
            $row['total_amount'] = $inv->total_amount;
            $row['invoice_date'] = date('m/d/Y');
            $row['due_date'] = date('m/d/y', strtotime($dueDate));           
            $row['created_at'] = date('Y-m-d H:i:s');
            $row['updated_at'] = date('Y-m-d H:i:s');
            $row['action'] =  '<a href="/admin/download-invoice/' . $inv->company_invoice_id . '" target="_blank"><button class="btn btn-success btn-xs check-in-user"  data-id="' . $inv->company_invoice_id . '"data-toggle="tooltip" data-original-title="View Invoice"><i class="fa fa-file-pdf-o"></i></button></a>';
            $data[] = $row;
        }
        if ($invoices == array()) {
            $data = array();
        }
		//echo "<pre>";print_r(Response::json([ 'data' => $data ]));die;
		
        return Response::json([ 'data' => $data ]);
    }
	
	public function invoiceCron(Request $request)
    {   	
		$packageHistory = PackageHistory::all();
		
		$today = date('m/d/Y');
		
		foreach($packageHistory as $ph) {
			
			$package = Package::where('id', $ph->package_id)->first();
			$company = Company::where('id', $package->company_id)->first();	
			//echo "<pre>";print_r($package->payment_days);die;
			
			$payment_days = explode(",", $package->payment_days);			
				
			$perDayCredit = $package->credits / $package->days;			
			$perDayFees = $package->Start_fee / $package->days;
			
			$diff = round(abs(strtotime($today) - strtotime($company->last_invoice_date))/86400);
		
			if ($diff > 0 ) {
			
				if ($package->expand_automatically == 1) {					
					
					if (in_array($today, $payment_days)) {
						
						$invoice = new CompanyInvoice;
						$invoice->package_id = $ph->package_id;
						$invoice->user_id = auth()->user()->id;
						$invoice->invoice_number = (int)$company->last_invoice_number + 1;
						$invoice->quantity = $diff*$perDayCredit;
						$invoice->total_amount = $diff*$perDayFees;
						$invoice->invoice_date = date('Y-m-d');
						$invoice->due_date = date('Y-m-d', strtotime("+14 day"));
						$invoice->expand_automatically = 1;
						$invoice->save();
						
						Company::where('id', $package->company_id)
							->update([
							'last_invoice_number'     => $company->last_invoice_number + 1,
							'last_invoice_date'     => date('Y-m-d')
							
						]);
					}				
					
				} else { 
					$invoice = new CompanyInvoice;
					$invoice->package_id = $ph->package_id;
					$invoice->user_id = auth()->user()->id;
					$invoice->invoice_number = (int)$company->last_invoice_number + 1;
					$invoice->quantity = $diff*$perDayCredit;
					$invoice->total_amount = $diff*$perDayFees;
					$invoice->invoice_date = date('Y-m-d');
					$invoice->due_date = date('Y-m-d', strtotime("+14 day"));
					$invoice->expand_automatically = 0;
					$invoice->save();

					Company::where('id', $package->company_id)
						->update([
						'last_invoice_number' => (int)$company->last_invoice_number + 1,
						'last_invoice_date'     => date('Y-m-d')
					]);
				}		
			}			
		}			
		
		$response = [
            'status' => 'success',
            'http_status_code' =>  200,
            'message' => 'Invoice cron have run successfully!',
            'data' => []
        ];
		
		return new JsonResponse($response, 200);

    }
}
