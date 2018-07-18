<?php

namespace App\Http\Controllers;

use App\Role;
use App\ServiceOpeningHours;
use App\Company;
use App\CompanyUI;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\AdminMiddleware;
use App\ExerciseAccentMuscleGroup;
use App\ExerciseGoal;
use App\ExerciseMaterial;
use App\ExerciseTrainingLevel;

class CompanyController extends Controller
{
    /**
     * Construct
     * 
     * @return void
    */
	public function __construct()
    {
        $this->middleware(AdminMiddleware::class, ['except' => ['show']]);
    }

    /**
     * Company home page
     *
     * @param Request $request
	 * @return view
    */
	public function index(Request $request)
    {
        return view('admin.pages.companys.index');
    }

    /**
     * Fetch company record by id
     *
     * @param integer $id
	 * @return view
    */
	public function show($id)
    {
        if (!Gate::allows('check-route', \Route::current()->getName())) {
            return back()->with('authMessage', "You are unauthorized to perform this operation");
        }
        
        $company = Company::where('id', $id)->first();
        $companyUI = CompanyUI::where("company_id", $company->id)->first();
        return view('admin.pages.companys.view', compact('company', 'companyUI'));
    }

    /**
     * Update Company
     *
     * @param integer $id
	 * @return view
    */
	public function edit($id)
    {
        $ohObj=ServiceOpeningHours::where('user_id', $id)->first();
        if (!empty($ohObj)) {
            $opening_hours=array(
                "min_time"=>$ohObj->min_time,
                "max_time"=>$ohObj->max_time,
                "days"=>explode(",", $ohObj->business_days),
                "business_hours"=>explode(",", $ohObj->business_hours),
            );
        } else {
            $opening_hours=array(
                "min_time"=>"",
                "max_time"=>"",
                "days"=>array(),
                "business_hours"=>array(),
            );
        }
        
        $materials=ExerciseMaterial::where('user_id', $id)->get();
        $goals=ExerciseGoal::where('user_id', $id)->get();
        $training_levels=ExerciseTrainingLevel::where('user_id', $id)->get();
        $accent_muscle_group=ExerciseAccentMuscleGroup::where('user_id', $id)->get();
        $company = Company::where("id", $id)->first();
        $companyUI = CompanyUI::where("company_id", $company->id)->first();
        return view('admin.pages.companys.edit', compact('company', 'opening_hours', 'materials', 'goals', 'training_levels', 'accent_muscle_group', 'companyUI'));
    }
    public function updateUi(Request $request){
        $data = $this->validate(
            $request,
            [
            'header'     => 'required|max:6',
            'background'     => 'required|max:6',
            'footer'     => 'required|max:6',
            'sidemenu'     => 'required|max:6',
            'text'     => 'required|max:6',
            ],
            [
            'header.required'     => 'Header color empty',
            'background.required' => 'Background color empty',
            'footer.required'       => 'Footer color empty',
            'sidemenu.required'       => 'Side Menu color empty',
            'text.required'   => 'Text color empty',
            ]
        );
        $data = $request->all();
        $cUI = CompanyUI::where("company_id", $request->company_id)->get()->count();
        // Update a company

        if($cUI > 0){
                CompanyUI::where('company_id', $request->company_id)
                    ->update([
                    'header'     => $data['header'],
                    'background'     => $data['background'],
                    'footer'     => $data['footer'],
                    'sidemenu'     => $data['sidemenu'],
                    'text'     => $data['text'],
                    ]);
                }
        else{
            $data = array(

                    'header'     => $data['header'],
                    'background' => $data['background'],
                    'footer'     => $data['footer'],
                    'sidemenu'   => $data['sidemenu'],
                    'text'       => $data['text'],
                    'company_id' => $data['company_id']
            );
            CompanyUI::create($data);
        }
    }
    
	/**
     * Save company data after update
     *
     * @param Request $request
	 * @param integer $id
	 * @redirect
    */
	public function update(Request $request, $id)
    {
        $company = new Company();
        $data = $this->validate(
            $request,
            [
            'company_name'     => 'required|max:100',
            'address'          => 'required|max:500',
            'primary_language' => 'required|max:100',
            'City'             => 'required|max:100',
            'phone_main'       => 'required|max:100',
            'email_main'       => 'required',
            'allow_cashback'   => 'required|in:1,2',
            'visit_location'   => 'required|in:1,2',
            'slug'             => 'required'
            ],
            [
            'company_name.required'     => 'Bedrijfsnaam  is verplicht',
            'primary_language.required' => 'Primaire taal  is verplicht',
            'address.required'          => 'Het adresveld is verplicht',
            'City.required'             => 'Het veld stad is verplicht',
            'phone_main.required'       => 'Telefoon algemeen is verplicht',
            'email_main.required'       => 'Email algemeen is verplicht',
            'allow_cashback.required'   => 'U moet kiezen of u wel/geen cashback toestaat',
            'visit_location.required'   => 'U heeft niet aangegeven of men u kan bezoeken',
            'slug.required'             => 'Slug is verplicht'
            ]
        );
        $data = $request->all();
        
        // Update a company
        Company::where('id', $id)
            ->update([
            'user_id' => auth()->user()->id,
            'company_name' => $data['company_name'],
            'Soort' => $data['Soort'],
            'address' => $data['address'],
            'zipcode' => $data['zipcode'],
            'City' => $data['City'],
            'state' => $data['state'],
            'Contactpersoon' => $data['Contactpersoon'],
            'phone_main' => $data['phone_main'],
            'phone_contact' => $data['phone_contact'],
            'phone_administration' => $data['phone_administration'],
            'email_main' => $data['email_main'],
            'email_contact' => $data['email_contact'],
            'email_administration' => $data['email_administration'],
            'kvk_number' => $data['kvk_number'],
            'btw_number' => $data['btw_number'],
            'primary_language' => $data['primary_language'],
            'allow_cashback' => $data['allow_cashback'],
            'visit_location' => $data['visit_location'],
            'slug' => $data['slug']
            ]);
       
        return redirect()->route('admin.companys.index')->with('message', 'Company updated successfully');
    }

    /**
     * Company listing page
     *
     * @return view
    */
	public function get()
    {
        $data = [];
        $companies = Company::select('id', 'company_name', 'Soort', 'phone_main', 'email_main', 'address', 'City', 'Contactpersoon')->get();
        foreach ($companies as $key => $company) {
            $data[$key]['id'] = $company->id;
            $data[$key]['name'] = $company->company_name;
            $data[$key]['username'] = $company->Soort;
            $data[$key]['email'] = $company->phone_main;
            $data[$key]['phone'] = $company->email_main;
            $data[$key]['address'] = $company->address;
            $data[$key]['role'] = $company->City;
            $data[$key]['Bedrijfsnaam'] = $company->Contactpersoon;
            $data[$key]['action'] = '<a href="' . route("admin.companys.show", $company->id) . '"><button class="btn btn-info btn-xs view-button" data-id="' . $company->id . '" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye"></i></button></a>
            <a href="' . route("admin.companys.edit", $company->id) . '"><button class="btn btn-primary btn-xs edit-button" data-id="' . $company->id . '" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></button></a>
            <button class="btn btn-danger btn-xs delete-button" onclick = "remove(' . $company->id . ');" data-id="' . $company->id . '"data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash"></i></button>';
        }
        return Response::json(['data' => $data]);
    }

	/**
     * Destroy company
     *			
	 * @param integer $id
	 * @redirect
    */
	public function destroy($id)
    {
        $company = Company::destroy($id);
        return redirect()->back()->with('message', 'Company delete successfully.');
    }

    /**
     * Save a new company data
     *
     * @param Request $request
	 * @redirect 
    */
	public function addnewcompany(Request $request)
    {
        $company = new Company();
        $data = $this->validate(
            $request,
            [
                'company_name'     => 'required|max:100',
                'address'          => 'required|max:500',
                'primary_language' => 'required|max:100',
                'City'             => 'required|max:100',
                'phone_main'       => 'required|max:100',
                'email_main'       => 'required',
                'allow_cashback'   => 'required|in:1,2',
                'visit_location'   => 'required|in:1,2',
                'slug'             => 'required|max:100',
            ],
            [
                'company_name.required'     => 'Bedrijfsnaam field is required',
                'primary_language.required' => 'Primaire taal field is required',
                'phone_main.required'       => 'Telefoon Algemeen field is required',
                'email_main.required'       => 'Email Algemeen field is required',
                'allow_cashback.required'   => 'Staat cashback toe field is required',
                'visit_location.required'   => 'Visite location field is required',
                'slug.required'             => 'Slug is verplicht'
            ]
        );
        $data = $request->all();
        
        $company = new Company();
        $company->user_id              = auth()->user()->id;
        $company->company_name         = $data['company_name'];
        $company->Soort                = $data['Soort'];
        $company->address              = $data['address'];
        $company->zipcode              = $data['zipcode'];
        $company->City                 = $data['City'];
        $company->state                = $data['state'];
        $company->Contactpersoon       = $data['Contactpersoon'];
        $company->phone_main           = $data['phone_main'];
        $company->phone_contact        = $data['phone_contact'];
        $company->phone_administration = $data['phone_administration'];
        $company->email_main           = $data['email_main'];
        $company->email_contact        = $data['email_contact'];
        $company->email_administration = $data['email_administration'];
        $company->kvk_number           = $data['kvk_number'];
        $company->btw_number           = $data['btw_number'];
        $company->primary_language     = $data['primary_language'];
        $company->allow_cashback       = $data['allow_cashback'];
        $company->visit_location       = $data['visit_location'];
        $company->slug                 = $data['slug'];
        $company->last_invoice_number  = rand(1000,100000);
        $company->save();

        $user = new User();
        $user->name  = $data['Contactpersoon'];
        $user->username  = $data['phone_main'];
        $user->email = $data['email_administration'];
        $user->password = bcrypt('admin');
        $user->role = "company";
        $user->role_id = "3";
        $user->activation_status = "1";
        $user->first_name = $data['Contactpersoon'];
        $user->company = $company->id;
        $user->parent_id = $company->id;
        $user->save();


        return redirect()->route('admin.companys.index')->with('message', 'Company added successfully');
    }
    
    
    /**
     * Save opening hours
     *
     * @param Request $request
     * @param interger $user_id
	 * @redirect 
    */
    public function saveOpeningHours(Request $request, $user_id)
    {

        $ispresant=ServiceOpeningHours::where('user_id', $user_id)->get();
        if (empty($ispresant)) {
            $create=ServiceOpeningHours::create([
                'min_time'=>$request->min_time,
                'max_time'=>$request->max_time,
                'user_id'=>$user_id,
                'business_hours'=>implode($request->businesshours, ","),
                'business_days'=>implode($request->days, ","),
            ]);
            if ($create) {
                return redirect()->back()->with('message', 'Opening Hours saved successfully');
            } else {
                return redirect()->back()->with('message', 'Some error occurred hile saving details');
            }
        } else {
            $update=ServiceOpeningHours::where('user_id', $user_id)->update([
                'min_time'=>$request->min_time,
                'max_time'=>$request->max_time,
                'business_hours'=>implode($request->businesshours, ","),
                'business_days'=>implode($request->days, ","),
            ]);
            if ($update) {
                return redirect()->back()->with('message', 'Opening Hours updated successfully');
            } else {
                return redirect()->back()->with('message', 'Some error occurred hile updating details');
            }
        }
    }

    /**
     * Company add page
     *
	 * @return view 
    */
	public function new()
    {
        return view('admin.pages.companys.add');
    }
	
	/**
     * Company bulk destroy
	 *		
     * @param interger $ids
	 * @return array
    */
    public function bulkDestroy($ids)
    {
        $deleteUsers =  Company::whereIn('id', $ids)
            ->delete();

        if ($deleteUsers) {
            $result = ['affected_row'=>$deleteUsers,'status'=>'success'];
        } else {
            $result = ['affected_row'=>$deleteUsers,'status'=>'failed'];
        }
        return $result;
    }

    /**
     * Company bulk destroy by ids
	 *		
     * @param Request $Request
	 * @redirect
    */
	public function bulkDestroyRequest(Request $Request)
    {
        $ids = json_decode($request->get('ids'), true);
        $delete = $this->bulkDestroy($ids);
        if ($delete) {
            return redirect()->back()->with('message', 'Company delete successfully.');
        }
        return redirect()->back()->with('exception', 'Company not found !');
    }
}
