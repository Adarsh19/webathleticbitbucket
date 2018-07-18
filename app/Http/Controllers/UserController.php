<?php

namespace App\Http\Controllers;

use App\ExerciseAccentMuscleGroup;
use App\ExerciseGoal;
use App\ExerciseMaterial;
use App\ExerciseTrainingLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\UserOmtrekmeting;
use App\userBarcodeScan;
use App\UserExcercise;
use App\UserOptions;
use App\UsersMeta;
use App\Vetmeting;
use App\UserDailyFood;
use App\UserFoodUsed;
use App\UserOrders;
use Carbon\Carbon;
use App\Helper;
use App\User;
use App\Permission;
use App\Package;
use App\Company;
use App\PackageHistory;
use App\CheckIn;
use App\Role;
use \Spatie\Activitylog\Models\Activity;
use Excel;
use App\Tests;
use App\TestAnswer;
use App\UserDailyValue;

class UserController extends Controller
{

    /**
     * Construct
     * 
     * @return void
    */
	public function __construct()
    {
        
        if (Session::has('user')) {
            $user = Session::get('user');
            if ($user->role != 'admin') {
                return redirect()->back()->with(array("fail" => "You have have no authorisation."))->withInput();
            }
        } else {
            return redirect("/")->with(array("fail" => "You have to Login first to access our features."))->withInput();
        }
    }

	/**
     * Dashboard
     *
     * @param Request $request
	 * @return view 
    */
    public function dashboard(Request $request)
    {

        # code...
        $users = User::orderBy('created_at', 'DESC')->get();

        $totalUsers = count($users);
        $currentUsers = User::where('created_at', '>=', Carbon::now()->startOfMonth())->count();
        $diffUsers = $currentUsers - $totalUsers;
        if ($totalUsers && $diffUsers) {
            $diffPercentage = round((abs($diffUsers) / $totalUsers) * 100);
        } else {
            $diffPercentage = 0;
        }
        $lastMonthNew = User::whereMonth(
            'created_at',
            '=',
            Carbon::now()->subMonth()->month
        )->count();
        $lastMonthBlocked = User::whereMonth(
            'blocked_at',
            '=',
            Carbon::now()->subMonth()->month
        )->count();


        $permissions = Permission::all();
       
        $roles = Role::all();


        return view('admin.dashboard', compact('users', 'totalUsers', 'currentUsers', 'diffUsers', 'diffPercentage', 'lastMonthNew', 'lastMonthBlocked', 'permissions', 'roles'));
    }

	/*
	** Use : View Users list
	** Function For: Admin only
	**
	*/
    public function index(Request $request)
    {
       # code...
        $conditions = [['role' ,'!=','admin']];

        if ($request->type) {
            $conditions[] = ['role','=',$request->type];
        }
        if (isset($request->tab)) {
            $tab = $request->tab;
        } else {
            $tab = '';
        }
        $users = User::where($conditions)->orderBy('created_at', 'DESC')->get();
        $check_in_tab = $request->check_in;

        $totalUsers = count($users);
        $currentUsers = User::where('created_at', '>=', Carbon::now()->startOfMonth())->count();
        $diffUsers = $currentUsers - $totalUsers;
        if ($totalUsers && $diffUsers) {
            $diffPercentage = round((abs($diffUsers) / $totalUsers) * 100);
        } else {
            $diffPercentage = 0;
        }
        $lastMonthNew = User::whereMonth(
            'created_at',
            '=',
            Carbon::now()->subMonth()->month
        )->count();
        $lastMonthBlocked = User::whereMonth(
            'blocked_at',
            '=',
            Carbon::now()->subMonth()->month
        )->count();
       
        if ($request->ajax()) {
            if ($request->type == "checkin") {
                $checkins = CheckIn::orderBy('created_at', 'DESC')->get();
                $users=[];
                foreach ($checkins as $checkin) {
                   $bg = ($checkin->user->check_in_counter <= 2) ? "bg-warning" : "bg-success";
                    $users[]=['DT_RowClass'=>$bg,'id'=>$checkin->log_id,'checkDate'=>date('d-m-Y H:i', strtotime($checkin->created_at)),'username'=>$checkin->user->name,'checkremain'=>$checkin->user->check_in_counter, 'company'=>$checkin->user->package->company->name];
                }
            } elseif ($request->type=='history') {
                $users = Activity::orderBy('created_at', 'DESC')->get();
                foreach ($users as $value) {
                    if($value->causer != "" || $value->causer != 0)
                        $value->causer_name=$value->causer->name;
                    else
                        $value->causer_name = "Invalid Causer";
                    // $value->created_at = date('d-m-Y H:i', strtotime($value->created_at));
                }
            }
            return Response::json([ 'data' => $users ]);
        } else {
            $z = Auth::user();
            $crole = $z->role;
            $role_id = $z->id;
            if ($z->role != "admin") {
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
            $packages = Package::orderBy('created_at', 'DESC')->get();
            $companies = Company::orderBy('created_at', 'DESC')->get();
            return view('admin.pages.users.index', compact('users', 'totalUsers', 'currentUsers', 'diffUsers', 'diffPercentage', 'lastMonthNew', 'packages', 'lastMonthBlocked', 'user_statuses', 'tab', 'check_in_tab', 'companies'));
        }
    }
	/*
	**
	** Use : Create New User
	** Function For: Admin and user
	**
	*/
    public function store(Request $request)
    {
        $input = $request->all();
        unset($input['_token'], $input['confirm_password']);
        // chnage date formate for save into database
        $input['birthday'] = !empty($input['birthday'])? date('Y-m-d', strtotime(str_replace('/', '-', $input['birthday']))) : '';
        $input['klant_sinds'] = !empty($input['klant_sinds']) ? date('Y-m-d', strtotime(str_replace('/', '-', $input['klant_sinds']))) : '';
        $validator  = Validator::make($input, [
                'first_name' => 'required|max:100',
                'surname' => 'required|max:100',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
                'gender' => 'required|in:m,f',
                'phone' => 'required|numeric|min:10',
                'address' => 'required|max:500',
                'birthday' => 'required|date|date_format:Y-m-d',
                'klant_sinds' => 'required|date|date_format:Y-m-d',
                'role' => 'required|in:admin,user,company',
                'activation_status' => 'required',
            ], [
                'activation_status.required' => 'Activation status is required.',
            ]);

        if ($validator->passes()) {
            User::insert($input);
            return Response::json(['success' => '1' , 'message' => 'New User Created successfully.']);
        } else {
        }
    }

    public function show($id)
    {
        $user = User::where('id', $id)->first();
        $roles = Role::all();
        $user->age = $user->birthday;
        $user->klant_sinds = date('d/m/Y', strtotime($user->klant_sinds));
        $user->birthday = date('d/m/Y', strtotime($user->birthday));
        $user->klant_sinds = date('d/m/Y', strtotime($user->klant_sinds));

        //$user = Auth::id();

        $balance = UserOrders::where('userid', $id)->first();
        
        $materials=ExerciseMaterial::get();
        $goals=ExerciseGoal::get();
        $training_levels=ExerciseTrainingLevel::get();
        $accent_muscle_group=ExerciseAccentMuscleGroup::get();



        return view('admin.pages.users.view', compact('user', 'roles', 'materials', 'goals', 'training_levels', 'accent_muscle_group', 'balance'));
    }

   
	/*
	**
	** Use : Update the profile for the given user.
	** Function For: Admin and user
	**
	*/
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $input = $request->all();
        unset($input['_method'], $input['_token']);
        // chnage date formate for save into database
        $input['birthday'] = !empty($input['birthday'])? date('Y-m-d', strtotime(str_replace('/', '-', $input['birthday']))) : '';
        $input['klant_sinds'] = !empty($input['klant_sinds']) ? date('Y-m-d', strtotime(str_replace('/', '-', $input['klant_sinds']))) : '';

        $validator  = Validator::make($input, [
                'first_name' => 'required|max:100',
                'surname' => 'required|max:100',
                'email' => 'required|email|unique:users,id,'.$id,
                'gender' => 'required|in:m,f',
                'phone' => 'required|numeric|min:10',
                'address' => 'required|max:500',
                'birthday' => 'required|date|date_format:Y-m-d',
                'klant_sinds' => 'required|date|date_format:Y-m-d',
                'role' => 'required|in:admin,user,company',
                'activation_status' => 'required',
            ], [
                'activation_status.required' => 'Activation status is required.',
            ]);

        if ($validator->passes()) {
            if ($input['packagefk'] != $user->packagefk) {
                $package = Package::where('id', $input['packagefk'])->pluck('entree');
                $input['check_in_counter'] = $package[0];
                $data = array(
                    "causer_id" => Auth::id(),
                    "user_id"      => $id,
                    "package_id" => $input['packagefk'],
                    "type" => 0 // Type : 0 (Package Changed)
                    );

                PackageHistory::create($data);
            }

            User::where('id', $id)->update($input);

            return Response::json(['success' => '1']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    public function get()
    {
        $users = User::all();
        // $roles = Role::all();
        foreach ($users as $customers) {
            // foreach( $roles as $r ){
            //     if( $customers->role == $r->id ){
            //         $role = $r->role;
            //     }else{
            //         $role = "unknown";
            //     }
            // }
   
            $row = array();
            $row['id'] = $customers->id;
            $row['name'] = $customers->name;
            $row['username'] = $customers->username;
            $row['email'] = $customers->email;
            $row['phone'] = $customers->phone;
            $row['address'] = $customers->address;
            $row['birthday'] = $customers->birthday;
            $row['role'] = $customers->role;
            // $row['role'] = $role;
            $row['action'] = '<a href="' . route("admin.users.show", $customers->id) . '"><button class="btn btn-info btn-xs view-button" data-id="' . $customers->id . '" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye"></i></button></a>
            <a href="' . route("admin.users.edit", $customers->id) . '"><button class="btn btn-primary btn-xs edit-button" data-id="' . $customers->id . '" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></button></a>
            <button class="btn btn-danger btn-xs delete-button" onclick = "remove(' . $customers->id . ');" data-id="' . $customers->id . '"data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash"></i></button>';
            $data[] = $row;
        }
        return Response::json(['data' => $data]);
    }


    
    public function edit($id)
    {
        $roles = Role::all();
        $user = User::all()->where("id", $id)->first();
        return view('admin.pages.users.edit', compact('user', 'roles'));
    }

    public function addnewuser(Request $request)
    {
        try {
            if ($request->input('email')) {
                $email = "required|string|email|max:100";
            } else {
                $email = "required|string|email|max:100|unique:users";
            }

            if ($request->input('username')) {
                $username = "required|alpha_dash|max:50";
            } else {
                $username = "required|alpha_dash|max:50|unique:users";
            }
            $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:100',
                    'username' => $username,
                    'email' => $email,
                    'gender' => 'required',
                    'phone' => 'required|string|max:25',
                    'address' => 'required|string|max:250',
                    'about' => 'required|string',
                    'birthday' => 'nullable|string|max:250',
                    'iban' => 'nullable|string|max:250',
                    'taal' => 'nullable|string|max:250',
                    'klant_sinds' => 'nullable|string|max:250',
            ]);
            if ($validator->fails()) {
                $request->session()->flash('exception', 'Some thing is wrong');
                return redirect()->back()
                            ->withErrors($validator, 'signup')
                            ->withInput();
            }
            $z = Session::get('user');
            $role_id = $z->id;
            $birthday = str_replace('/', '-', $request->input('birthday'));
            $klant_sinds = str_replace('/', '-', $request->input('klant_sinds'));
            $data = array(
                "name" => $request->input('name'),
                "username" => $request->input('username'),
                "email" => $request->input('email'),
                "gender" => $request->input('gender'),
                "phone" => $request->input('phone'),
                "address" => $request->input('address'),
                "about" => $request->input('about'),
                "birthday" => date("Y-m-d", strtotime($birthday)),
                "iban" => $request->input('iban'),
                "taal" => $request->input('taal'),
                "klant_sinds" => date("Y-m-d", strtotime($klant_sinds)),
                "block_reason" => $request->input('block_reason'),
                "created_at" => date("Y-m-d H:i:s"),
                "password" => Hash::make($request->input('password')),
                "role" => $request->input('role'),
                "user_id" => $role_id,
                "activation_status" => $request->input('activation_status'),
                "packagefk" => $request->input('packagefk'),
                "ip" =>  $request->ip(),
                "login_attemp" => 0,
                "browser" => $request->header('User-Agent'),
               
            );
            $users = User::create($data);
            if (!empty($users->id)) {
                if ($request->input('packagefk') > 0) {
                    $package = Package::where('id', $data['packagefk'])->pluck('entree');
                    User::where('id', $users->id)->update(array("check_in_counter"=>$package[0]));
                    $data = array(
                    "causer_id" => Auth::id(),
                    "user_id"      => $users->id,
                    "package_id" => $request->input('packagefk'),
                    "type" => 1 // Type : 1 (Package Assigned)
                    );

                    PackageHistory::create($data);
                }
                $request->session()->flash('success', 'User added successfully.');
            } else {
                $request->session()->flash('error', 'Operation failed !');
            }
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
            return  redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function new()
    {
        $roles = Role::all();
        $user = User::where('id', 1)->first();
        return view('admin.pages.users.view', compact('roles', 'user'));
    }

	/*
	**
	** Use : Delete the profile.
	** Function For: Admin
	**
	*/
    public function destroy($id)
    {
        $user = User::find($id);
        if (count($user)) {
            if ($user->featured_image) {
                @unlink(public_path('profile_images/' . $user->avatar));
            }
            $user->delete();
            return redirect()->back()->with('message', 'User delete successfully.');
        } else {
            return redirect()->back()->with('exception', 'Post not found !');
        }
    }
    public function block($id)
    {
        $user = User::find($id);
        if (count($user)) {
            if ($user->featured_image) {
                @unlink(public_path('profile_images/' . $user->avatar));
            }
            $user->delete();
            return redirect()->back()->with('message', 'User delete successfully.');
        } else {
            return redirect()->back()->with('exception', 'Post not found !');
        }
    }

	/*
	**
	** Use : Update the profile Image.
	** Function For: Admin
	**
	*/
    public function updateImage(Request $request)
    {
        # code...
        if (!empty($request->base64_src) && isset($request->base64_src)) {
            $result = false;
            $urls = getcwd();
            $url = str_replace("\\", "/", $urls);
            switch ($request->action) {
                case 'update_site_image':
                    $result = Helper::saveSiteImage($request->file('base64_src'), 'site_images/', $request->id); // base64 , destinationPath, id
                    if ($result) {
                       return redirect()->back()->with('message', 'Logo added successfully.');
                    }
                    break;
                case 'update_profile_image':
                    $result = Helper::saveProfileImage($request->base64_src, 'profile_images/', $request->id); // base64 , destinationPath, id
                    break;
                default:
                    # code...
                    break;
            }

            if ($result) {
                $response = ['status'=>1 ,'success' => 'success'];
               //return redirect()->back()->with('message', 'Logo added successfully.');
            } else {
                $response = ['status'=>0 ,'error' => 'error'];
            }
          
            return \Response::json($response);
        }
    }


	/*
	**
	** Use : Show the profile for the given user.
	** Function For: Admin only
	**
	*/
    public function user_dashboard($id)
    {
       /*// $user = User::where('id', $id)->first();
       //return json_encode($user);
        $user = User::where('id', 1)->first();
        dd($user);
        return view('admin.pages.users.view', compact('user'));*/
        // $id = 1;

        $user = User::where('id', $id)
            ->first();
        if ($user==null) {
            return redirect()->back();
        }
        UsersMeta::where('user_id', $id);
        $tDate = date('Y-m-d');

        $kcaldates = array();
        $kcaldays = array();
        $kcalvals = array();

        $weightdates = array();
        $weightvals = array();

        $sleepdates = array();
        $sleepvals = array();

        $trainingdates = array();
        $trainingvals = array();
        $trainingfiles = array();
        $umid = array();
        for ($i = 9; $i >=0; $i--) {
            $d=date('Y-m-d', strtotime('-'.$i.' days'));
            $usermeta = UserDailyValue::where('user_id', $id)
                 ->whereDate('date', date('Y-m-d', strtotime('-'.$i.' days')))->orderBy('id', 'desc')->first();

            // $usermeta = UsersMeta::where('user_id', $id)
            //     ->where('date', $tYear . '-' . $tMonth . '-' . ($i + 1))->first();

             $umid[] = isset($usermeta->id) ? $usermeta->id : 0;
             $kcaldates[] = date('d F', strtotime('-'.$i.' days')) ;//. "-" . $tMonth;
             $kcaldays[] = date('l', strtotime($d));
             $kcalvals[] = isset($usermeta->kcal) ? $usermeta->kcal : 0;

            //$weightdates[] = date('d',strtotime('-'.$i.' days'));// . "-" . $tMonth;
            $weightvals[] = isset($usermeta->weight) ? $usermeta->weight : 0;

            $sleepdates[] = date('d', strtotime('-'.$i.' days')) ;//. "-" . $tMonth;
            $sleepvals[] = isset($usermeta->sleep_q1) ? $usermeta->sleep_q1 : 0;

            // $trainingdates[$i] = ($i + 1) ;//. "-" . $tMonth;
            // $trainingfiles[$i] = isset($usermeta->training) ? $usermeta->training : "";
            // $trainingvals[$i] = (isset($usermeta->training) && $usermeta->training != NULL && $usermeta->training != "") ? "1" : "0";
        }

        $sectionData = [
            'kcaldate' => $kcaldates,
            'kcaldays' => $kcaldays,
            'kcalvals' => $kcalvals,
            //'weightdates' => $weightdates,
            'weightvals' => $weightvals,
            'sleepdates' => $sleepdates,
            'sleepvals' => $sleepvals,
            //'trainingdates' => $trainingdates,
            //'trainingfiles' => $trainingfiles,
            'umid' => $umid
            //'trainingvals' => $trainingvals
            ];
        $tests = Tests::where('company_id', $user->parent_id)->orderBy('id', 'desc')->where('status', '1')->get();
        $userfood = UserDailyFood::where('user_id', $user->id)->orderBy('id', 'desc')->first();
        $userfoodused = UserFoodUsed::where('user_id', $user->id)->orderBy('id', 'desc')->first();
        
        return view('admin.pages.users.dashboard', compact('user', 'sectionData', 'userfood', 'userfoodused', 'tests'));
    }

	/*
	**
	** Use : Update the profile Image.
	** Function For: Admin
	**
	*/
    public function genrate_file(Request $request)
    {
        dd($request->all());

        //return $excel->download($export, 'invoices.xlsx');
    }


    public function storeUserDailyFood(Request $request)
    {
        $user = Auth::user();
        $validator = $validator = Validator::make($request->all(), [
            'kcal' => 'required|numeric',
            'eiwit' =>  'required|numeric',
            'koolhydraat' => 'required|numeric',
            'vezel' =>  'required|numeric',
            'vet' => 'required|numeric',
            'kcal_baw' =>  'required|numeric',
            'eiwit_baw' => 'required|numeric',
            'koolhydraat_baw' =>  'required|numeric',
            'vezel_baw' => 'required|numeric',
            'vet_baw' =>  'required|numeric',
        ]);
           

        if ($validator->passes()) {
            $userDailyFood = UserDailyFood::create([
                'kcal' => $request->input('kcal'),
                'eiwit' => $request->input('eiwit'),
                'koolhydraat' => $request->input('koolhydraat'),
                'vezel' => $request->input('vezel'),
                'vet' => $request->input('vet'),
                'kcal_baw' => $request->input('kcal_baw'),
                'eiwit_baw' => $request->input('eiwit_baw'),
                'koolhydraat_baw' => $request->input('koolhydraat_baw'),
                'daily_note' => $request->input('daily_note'),
                'vezel_baw' => $request->input('vezel_baw'),
                'vet_baw' => $request->input('vet_baw'),
                'user_id' => $request->input('user_id'),
                'date' => date('Y-m-d'),
                'created_at' => date("Y-m-d H:i:s")
            ]);

            if (!empty($userDailyFood->id)) {
                $request->session()->flash('message', 'Food Information added successfully.');
            } else {
                $request->session()->flash('exception', 'Operation failed !');
            }

            return Response::json(['success' => '1','status'=>'200']);
        }
        return Response::json(['errors' => $validator->errors(),'status'=>'404']);
    }
    public function storeUserFoodUsed(Request $request)
    {
        $user = Auth::user();
        $validator = $validator = Validator::make($request->all(), [
            'kcal' => 'required|numeric',
            'eiwit' =>  'required|numeric',
            'koolhydraat' => 'required|numeric',
            'vezel' =>  'required|numeric',
            'vet' => 'required|numeric',
            'kcal_baw' =>  'required|numeric',
            'eiwit_baw' => 'required|numeric',
            'koolhydraat_baw' =>  'required|numeric',
            'vezel_baw' => 'required|numeric',
            'vet_baw' =>  'required|numeric',
        ]);
           

        if ($validator->passes()) {
            $userDailyFood = UserFoodUsed::create([
                'kcal' => $request->input('kcal'),
                'eiwit' => $request->input('eiwit'),
                'koolhydraat' => $request->input('koolhydraat'),
                'vezel' => $request->input('vezel'),
                'vet' => $request->input('vet'),
                'kcal_baw' => $request->input('kcal_baw'),
                'eiwit_baw' => $request->input('eiwit_baw'),
                'koolhydraat_baw' => $request->input('koolhydraat_baw'),
                'vezel_baw' => $request->input('vezel_baw'),
                'vet_baw' => $request->input('vet_baw'),
                'daily_note' => $request->input('daily_note'),
                'user_id' => $request->input('user_id'),
                'date' => date('Y-m-d'),
                'created_at' => date("Y-m-d H:i:s")
            ]);

            if (!empty($userDailyFood->id)) {
                $request->session()->flash('message', 'Food Information added successfully.');
            } else {
                $request->session()->flash('exception', 'Operation failed !');
            }

            return Response::json(['success' => '1','status'=>'200']);
        }
        return Response::json(['errors' => $validator->errors(),'status'=>'404']);
    }

    public function getFoodDetails(Request $request)
    {
        $data=[];
        $user = User::where('id', $request->id)
            ->first();
        if ($request->type=='consumed') {
            $userfood = UserFoodUsed::where('user_id', $user->id)->orderBy('id', 'desc')->orderBy('id', 'desc')->get();
        } else {
            $userfood = UserDailyFood::where('user_id', $user->id)->orderBy('id', 'desc')->orderBy('id', 'desc')->get();
        }

        foreach ($userfood as $food) {
            $row = array();
            $row['id'] = $food->id;
            $row['date'] = date('d M,Y', strtotime($food->date));
            $row['kcal'] = $food->kcal;
            $row['koolhydraat'] = $food->koolhydraat;
            $row['vezel'] = $food->vezel;
            $row['vet'] = $food->vet;
            $row['eiwit'] = $food->eiwit;
            $row['kcal_baw'] = $food->kcal_baw;
            $row['koolhydraat_baw'] = $food->koolhydraat_baw;
            $row['vezel_baw'] = $food->vezel_baw;
            $row['vet_baw'] = $food->vet_baw;
            $row['eiwit_baw'] = $food->eiwit_baw;
            $data[] = $row;
        }
        return Response::json(['data' => $data]);
    }

    public function storeUserDailyValues(Request $request)
    {
        $user = Auth::user();
        $validator = $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'weight' =>  'required|numeric',
            'kcal' => 'required|numeric',
            'file' =>  'image|size:4084',
            'sleep_q1' => 'required|numeric',
            'sleep_q2' =>  'required|boolean',
            'sleep_q3' => 'required|boolean',
        ]);
           

        if ($validator->passes()) {
            $file=null;
            if ($request->has('file')) {
                $request->file('file')->store('uploads/'.$data['id'].'/training');
                $file=$request->file('file')->getClientOriginalName();
            }
            $userDaily = UserDailyValue::create([
                'kcal' => $request->input('kcal'),
                'date' => date('Y-m-d', strtotime($request->input('date'))),
                'weight' => $request->input('weight'),
                'file' => $file,
                'sleep_q1' => $request->input('sleep_q1'),
                'sleep_q2' => $request->input('sleep_q2'),
                'sleep_q3' => $request->input('sleep_q3'),
                'sleep_q4' => $request->input('sleep_q4'),
                'user_id' => $request->input('user_id'),
                'created_at' => date("Y-m-d H:i:s")
            ]);

            if (!empty($userDaily->id)) {
                $request->session()->flash('message', 'Daily Information added successfully.');
            } else {
                $request->session()->flash('exception', 'Operation failed !');
            }

            return Response::json(['success' => '1','status'=>'200']);
        }
        return Response::json(['errors' => $validator->errors(),'status'=>'404']);
    }



	/*
	**
	** Use : Check a user in after checks.
	** Function For: Admin
	**
	*/
    public function checkIn(Request $request)
    {

        $user_id = $request->user_id;

        $user = User::where('id', $user_id)->first();
        //fetch last check-in date
        $user_lc = $user->last_check_in;
        
        //check user's availabe check in
        $user_counter = $user->check_in_counter;

        //fetch user's package
        $user_package = $user->packagefk;

        $now = Carbon::now()->format('Y-m-d h:i:s');
        
        if ($user_lc == "0000-00-00 00:00:00" && $user_counter > 0) {
            //first time check-in

            //fetch allowed check-in
            $package_check_brim = (isset(Package::where('id', $user_package)
                ->pluck('entree')[0]) ? Package::where('id', $user_package)
                ->pluck('entree')[0] : 0);

            if ($package_check_brim > $user_counter) {
                //derement counter
                User::whereId($user_id)->decrement('check_in_counter', 1, ['last_check_in'=>$now]);
                
                //log check_in
                $data = array(
                    "responsee_id" => Auth::id(),
                    "user_id"      => $user_id,
                    );

                CheckIn::create($data);

                return Response::json([ 'status' => true, 'msg' => "User Successfully Checked in" ]);
            } else {
                return Response::json([ 'status' => false, 'msg' => "Invalid available check in" ]);
            }
        } elseif ($user_counter > 0) {
            User::whereId($user_id)->decrement('check_in_counter', 1, ['last_check_in'=>$now]);

            //log check_in
            $data = array(
                "responsee_id" => Auth::id(),
                "user_id"      => $user_id
                );

            CheckIn::create($data);

            return Response::json([ 'status' => true, 'msg' => "User Successfully Checked in" ]);
        } else {
            return Response::json([ 'status' => false, 'msg' => "Zero check-in available" ]);
        }
    }

	/*
	**
	** Use : Remove Last check in.
	** Function For: Admin
	**
	*/
    public function checkInRemove(Request $request)
    {
        if ($request->log_id) {
            $log = CheckIn::find($request->input('log_id'));
            if (count($log)) :
                $user = $log->user_id;
                $log->delete();
                User::whereId($user)->increment('check_in_counter', 1);
            endif;
            return Response::json(['status'=>true, 'msg'=>"Success : Check in successfully removed."]);
        } else {
            return Response::json(['status'=>false]);
        }
    }

    public function log_remove(Request $request)
    {
        if ($request->log_id) {
            $log = Activity::find($request->input('log_id'));
            if ($log) :
                $log->delete();
            endif;
            $request->session()->flash('success','Success : Log successfully removed.');
             return redirect()->back()->with('message', 'Success : Log successfully removed.');
        } else {
            return Response::json(['status'=>false]);
        }
    }

    public function acceptTerms()
    {
         User::where('id', Auth::id())->update(array("accepted_terms"=>1));
         return Response::json([ 'status' => true ]);
    }

    public function bulkDestroy($ids, $type)
    {
        if($type == "user"){

            $deleteUsers =  User::whereIn('id', $ids)
            ->delete();
   
        }
        if($type == "checkin"){

            $deleteUsers =  CheckIn::whereIn('id', $ids)
            ->delete();
   
        }
        if($type == "history"){

            $deleteUsers =  Activity::whereIn('id', $ids)
            ->delete();
   
        }
        if ($deleteUsers) {
            $result = ['affected_row'=>$deleteUsers,'status'=>'success'];
        } else {
            $result = ['affected_row'=>$deleteUsers,'status'=>'failed'];
        }
        return $result;
    }

    /**
     *  bulk destroy by ids
     *      
     * @param Request $Request
     * @redirect
    */
    public function bulkDestroyURequest(Request $request)
    {
        $ids = json_decode($request->get('checkboxes_field'), true);
        $delete = $this->bulkDestroy($ids, $request->get('type'));
        if ($delete) {
            return redirect()->back()->with('message', '$type deleted successfully.');
        }
        return redirect()->back()->with('exception', '$type not found !');
    }
}
