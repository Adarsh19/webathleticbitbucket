<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Log;
use App\Newsletter;
use App\Subscription;
use App\Package;
use App\Company;
use App\CompanyUI;
use App\Page;
use App\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $user = Session::get('user');
        if ($user == null) {
            $user = '';
        }
        // $packages = DB::select('SELECT
        //     `packages`.*,
        //     `productmedia`.`name` as `pname`,
        //     `productmedia`.`slug` as `pslug`
        // FROM
        //     `packages`
        //     LEFT JOIN `productmedia`
        //     ON `productmedia`.`id` = `packages`.`products`');
        return view('welcome', compact('user', 'packages'));
    }

/*
**
** Use : Login in admin and user both profile.
** Function : Login();
** Created By : Sandeep
*/

    public function Login(Request $request)
    {
        $messages = [
            'email.required' => "Email is required",
            'email.email' => "You must provide valid email",
            'password.required' => "Password is required",
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:250',
            'password' => 'required|max:15',
            ], $messages);

        if (!$validator->fails()) {
            $email = $request->email;
            $password = $request->password;

            if (Auth::attempt(['email' => $email, 'password' => $password, 'activation_status' => 1])) {
                $user = Auth::user();
                if ($user->role == 'admin' || $user->role == 'company') {
                    $current_date = date('Y-m-d H:i:s');
                    User::where('id', \Auth::User()->id)->update(['updated_at' => $current_date]);
                    
                    $res = ['status' => 1 ,'message' => 'success' , 'redirect' => url('admin/dashboard')];
                } elseif ($user->role == 'user') {
                    User::where('id', \Auth::User()->id)->update(['updated_at' => $current_date]);
                    $res = ['status' => 1 ,'message' => 'success' , 'redirect' => url('/')];
                }
            } else {
                if (User::where('email', $email)->where('activation_status', 1)->count()>0) {
                    $user=User::where('email', $email)->where('activation_status', 1)->first();
                    if ($user->login_attemp==5) {
                        $user->activation_status=0;
                        $subject="Verify User Account";
                        $email=$user->email;
                        Mail::send('emails.activate_user', $user, function ($message) use ($email, $subject) {
                            $message->to($email)->subject($subject);
                        });
                    }
                    $user->login_attemp=$user->login_attemp?$user->login_attemp+1:1;
                    $user->save();
                    \Auth::logout();
                    if ($user->login_attemp>=10) {
                        $res = ['status' => 0 ,'message' => 'Kindly contact your Account Manager.'];
                    } elseif ($user->login_attemp>6) {
                        $res = ['status' => 0 ,'message' => 'Kindly check your mail and verify identity.'];
                    } else {
                        $res = ['status' => 0 ,'message' => 'Email or password not match please try again'];
                    }
                } else {
                    $res = ['status' => 0 ,'message' => 'Email or password not match please try again'];
                }
            }
        } else {
            $res = ['status' => 0 ,'message' => 'Email or password not match please try again'];
        }
        return Response::json($res);
    }

/*
**
** Use : Logout for admin and user both profile.
** Function : signout();
** Created By :
*/

    public function signout($slug="")
    {

        if (Auth::user()) {
            auth()->logout();
        }
        if($slug == "")
         return redirect("/");
        else
            return redirect("/org/$slug");
    }

/*
**
** Use : Logout for admin and user both profile.
** Function : signout();
** Created By :
*/
    public function signup($slug="",$id="", Request $request)
    {   
        $is_company = false;
        $company_data = array();
        $hasUI = false;
        if($slug != ""){
            $company = Company::where("slug", $slug)->first();
            if(!empty($company)){
                $hasUI = CompanyUI::where("company_id", $company->id)->get()->count();
                $is_company = true;
                $company_data['logo'] = $company->logo;
                $company_data['email'] = $company->email_main;
                $company_data['slug'] = $company->slug;
                $company_data['name'] = $company->name;
                $company_data['id'] = $company->id;
                $company_data['ui'] = CompanyUI::where("company_id", $company->id)->first();
            }
        }

        if (Session::has('user')) {
            $user = Session::get('user');
        } else {
            $user = "";
        }
        if ($id=="") {
            $packages = DB::select('SELECT
                    `packages`.*,
                    `companies`.`slug`,
                    `services`.`service`,
                    `services`.`sdescription`
                FROM
                    `packages`
                LEFT JOIN `package_services`
                    ON `package_services`.`package_id` = `packages`.`id`
                LEFT JOIN `companies`
                    ON `companies`.`id` = `packages`.`company_id`
                LEFT JOIN `services`
                    ON `services`.`id` = `package_services`.`service_id`');
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
                    ON `services`.`id` = `package_services`.`service_id`
                Where  `packages`.`id` = "'.$id.'"');
        }
        return view('pages.signup', compact('user', 'packages', 'company_data', 'hasUI', 'is_company'));
    }


/*
**
** Use : User  profile.
** Function : verifySignup();
** Created By :
*/

    public function verifySignup(Request $request)
    {

        if ($request->input('email')) {
            $email = "required|string|email|max:100|unique:users";
        } else {
            $email = "required|string|email|max:100|unique:users";
        }
        $validator = Validator::make($request->all(), [
                'username' => 'required',
                'email' => $email,
                'password' => 'required'
        ]);
        if ($validator->passes()) {
            $slug = str_replace('', '_', $request->input('username'));
            $data = array(
                "name" => $request->input('username'),
                "username" => $slug.mt_rand(1000, 9999),
                "email" => $request->input('email'),
                "phone" => $request->input('phone'),
                "packagefk" => $request->input('package'),
                "klant_sinds" => $request->input('userStartDate'),
                "sign" => $request->input('sign'),
                "created_at" => date("Y-m-d H:i:s"),
                "ip" =>  $request->ip(),
                "login_attemp" => 0,
                "browser" => $request->header('User-Agent'),
                "password" => Hash::make($request->input('password')),
                "role" => "user",
            );
            $users = User::create($data);
            if (!empty($users->id)) {
                $request->session()->flash('success', 'Registred successfully.');
            } else {
                $request->session()->flash('error', 'Operation failed !');
            }
            return redirect('/');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    //verify user as human by mail
    public function verifyUser($token = null)
    {
        $validator = Validator::make($request->all(), [
                 $token = "required"
        ]);
        if ($validator->passes()) {
            $users = User::where('id', base64_decode($token))->where('login_attemp', '<', 10)->first();
            if ($users) {
                $users->status=1;
                $users->save();
                $request->session()->flash('success', 'User verified successfully.');
            } else {
                $request->session()->flash('error', 'Operation failed !');
            }
        }
        return redirect()->route('home');
    }



    public function profile()
    {
        if (Session::has('user')) {
        } else {
            return redirect("/")->with(array("fail" => "You have to Login first to access our features."))->withInput();
        }
        $roles = Role::all();
        $user = Session::get('user');
        if ($user->role == 'user') {
            return view('admin.pages.user.profile', compact('user'));
        } elseif ($user->role == 'admin') {
            return view('admin.pages.profile', compact('user'));
        } else {
            return view('admin.pages.companys.profile', compact('user'));
        }
    }

    public function profileupdate(Request $request)
    {
        if (Session::has('user')) {
        } else {
            return redirect("/")->with(array("fail" => "You have to Login first to access our features."))->withInput();
        }
        $user = Session::get('user');
        $input = $request->all();
        $id = $input['user_id'];
        unset($input['_method'], $input['_token']);
        $input['birthday'] = !empty($input['birthday']) ? date('Y-m-d', strtotime(str_replace('/', '-', $input['birthday']))) : '';
        $input['klant_sinds'] = !empty($input['klant_sinds']) ? date('Y-m-d', strtotime(str_replace('/', '-', $input['klant_sinds']))) : '';
        $validator = Validator::make($input, [
            'name' => 'required|max:100',
            'username' => 'required|max:100',
            'email' => 'required|email|unique:users,id,' . $id,
            'gender' => 'required|in:m,f',
            'phone' => 'required|numeric|min:10',
            'address' => 'required|max:500',
            'birthday' => 'required|date|date_format:Y-m-d',
        ]);
        if ($validator->passes()) {
            if ($user->role == 'user') {
                $affected_row = User::where('id', $id)->update($input);
            } elseif ($user->role == 'admin') {
                $affected_row = User::where('id', $id)->update($input);
            } else {
                $affected_row = Company::where('id', $id)->update($input);
            }
            if (!empty($affected_row)) {
                if ($user->role == 'user') {
                    $data = User::where('id', $id)->first();
                } elseif ($user->role == 'admin') {
                    $data = User::where('id', $id)->first();
                } else {
                    $data = Company::where('id', $id)->first();
                }
                Session::forget('user');
                Session::flush();
                if (Session::has('user')) {
                    $user = Session::get('user');
                };
                Session::put('user', $data);
                $request->session()->flash('message', 'Profile update successfully.');
            } else {
                $request->session()->flash('exception', 'Operation failed !');
            }
            return redirect('/admin/dashboard');
        } else {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }
    }

    public function subscribe_file_upload(Request $request)
    {
        if (isAdmin()) {
            $file = $request->file('pdf_file');
            
            $fileData = array();
            $fileData['name'] = md5(microtime()) . '.' . $file->getClientOriginalExtension();
            $fileData['originalName'] = $file->getClientOriginalName();
            $basePath = base_path() . '/public/';
            $targetRealPath = $basePath . 'newsletter/';
            if (!File::isDirectory($targetRealPath)) {
                File::makeDirectory($targetRealPath, 0755, true, true);
            }

            $file->move($targetRealPath, $fileData['name']);
            Newsletter::create([
                    'file_name' => $fileData['name'],
                    'path' => $fileData['originalName'],
                ]);
        }
        return redirect('/');
    }

    public function subscribe(Request $request)
    {
        $inputs = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|max:100',
            'email' => 'required|max:100'
        ]);
        if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        $name = $request->get('name');
        $email = $request->get('email');
        Subscription::create([
                'name' => $name,
                'email' => $email,
            ])->save();

        $newsLetter = Newsletter::orderBy('id', 'desc')->first();
            $data = array(
                'newsLetter' => $newsLetter
                );
        if (isset($data['newsLetter']) || !empty($data['newsLetter'])) {
            $subject = 'email test';

            $fromEmail = 'jamshedhossan9@gmail.com';

            Mail::send('emails.subscribe', $data, function ($message) use ($email, $fromEmail, $subject) {
                $message->from($fromEmail);
                $message->to($email)->subject($subject);
            });
            return redirect('/');
        } else {
            return view('pages.home_page_form_success');
        }
    }
    public function services($id)
    {
        $packages = DB::select('SELECT distinct
                    `packages`.*,
                    `companies`.`slug`,
                    `services`.`service`,
                    `services`.`sdescription`
                FROM
                    `packages`
                LEFT JOIN `package_services`
                    ON `package_services`.`package_id` = `packages`.`id`
                LEFT JOIN `companies`
                    ON `companies`.`id` = `packages`.`user_id`
                LEFT JOIN `services`
                    ON `services`.`id` = `package_services`.`service_id`
                where `services`.`id`='.$id);
        
        //$packages = Package::where('products', $id)->get();
        return view('pages.services2', compact('packages'));
    }
    public function signup2(Request $request)
    {

        $package = Package::where('id', $request->get('package_id'))->first();
        $role = Role::where('id', $package->role_id)->first();

        if (strlen($request->get('password')) < 6) {
            $response = [
                'status' => 0 ,'message' => 'Password is too short' , 'redirect' => url('/')
            ];
            return Response::json($response);
        }

        if ($request->get('password') != $request->get('confirm_password')) {
            $response = [
                'status' => 0 ,'message' => 'Password and confirm are not same' , 'redirect' => url('/')
            ];
            return Response::json($response);
        }

        $email = trim($request->get('email'));

        $existUser = User::where('username', $request->get('username'))->count();
        if ($existUser) {
            $response = [
                'status' => 0 ,'message' => 'User name allready exist' , 'redirect' => url('/')
            ];
            return Response::json($response);
        }


        $exist = User::where('email', $email)->count();
        if (!$exist) {
            $data =
            [
                'username'   => $request->get('username'),
                'email'      => $email,
                'phone'      => $request->get('phone'),
                'password'   => Hash::make($request->get('password')),
                'role'       => $role->role,
                'parent_id'  => $role->user_id,
                'activation_status' => 1,
                 "ip" =>  $request->ip(),
                "login_attemp" => 0,
                "browser" => $request->header('User-Agent'),
               
            ];

            $user = User::create($data);

            $transaction = Transactions::create([
                    'user_id'          => $user->id,
                    'amount_received'  => $package->Start_fee,
                    'transaction_type' => $package->sell_category,
                ]);

            return $this->signupLogin($request);
        } else {
            $response = [
                'status' => 0 ,'message' => 'Email allready exist' , 'redirect' => url('/')
            ];
            return Response::json($response);
        }
    }

    public function signupLogin($request)
    {
        
        $email = $request->get('email');
        $password = $request->get('password');

        if (Auth::attempt(['email' => $email, 'password' => $password, 'activation_status' => 1])) {
            $user = Auth::user();

            $user->role = strtolower($user->role);

            if ($user->role == 'admin' || $user->role == 'company') {
                $res = ['status' => 1 ,'message' => 'success' , 'redirect' => url('admin/dashboard')];
            } elseif ($user->role == 'user') {
                $res = ['status' => 1 ,'message' => 'success' , 'redirect' => url('/')];
            }
        } else {
            $res = ['status' => 0 ,'message' => 'Email or password not match please try again'];
        }

        return Response::json($res);
    }

    public function mailContactForm($slug="", Request $request)
    {
        if($slug != ""){
            $company = Company::where("slug", $slug)->first();
        }
        try {
            $inputs = $request->all();
            $rules = [
                'name' => 'required',
                'email' => 'required',
                'onderwerp' => 'required',
                'bericht' => 'required'
            ];

            $validator=\Validator::make($inputs, $rules);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $data['contact'] = $request->all();
            $from = $request->email;
            $to = 'shabnikkigoyal@gmail.com';
            if($slug != "" && !empty($company)) $to = $company->email_main;
            $subject = 'Contact Form';


            Mail::send('contact_emailer', $data, function ($message) use ($from, $to, $subject) {
                $message->from($from);
                $message->to($to);
                $message->subject($subject);
                $message->getHeaders();
            });

            return back()->with('success', 'Message Successfully sent.');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function methodsPage()
    {
        $data['methods'] = Page::where('page_slug', '/methods')->where('page_name', 'methods')->first();
        return view('pages.methods', $data);
    }

    public function homePage($slug="")
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
        $home_page = Page::where('page_slug', '/')->where('page_name', 'home page')->first();
        return view('welcome', compact('home_page', 'company_data', 'is_company', 'hasUI'));
    }

    public function contact($slug=""){
        $is_company = false;
        $company_data = array();
        $hasUI = false;
        if($slug != ""){
            $company = Company::where("slug", $slug)->first();
            if(!empty($company)){
                $hasUI = CompanyUI::where("company_id", $company->id)->get()->count();
                $is_company = true;
                $company_data['logo'] = $company->logo;
                $company_data['email'] = $company->email_main;
                $company_data['slug'] = $company->slug;
                $company_data['name'] = $company->name;
                $company_data['id'] = $company->id;
                $company_data['ui'] = CompanyUI::where("company_id", $company->id)->first();
            }
        }

        return view('pages.contact', compact( 'company_data', 'is_company', 'hasUI'));
   
    }
}
