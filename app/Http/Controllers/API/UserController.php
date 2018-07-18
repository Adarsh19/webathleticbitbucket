<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Package;
use App\Company;
use App\PackageHistory;
use App\CheckIn;
use App\Role;

/**
 * Class AuthController
 * @package App\Http\Controllers\Auth
 */
class UserController extends Controller
{

/**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function markCheck(Request $request)
    {
        $inputs = $request->all();
        try {
            $user_id = $inputs['user_id'];

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
                    return apiResponse(true, 200, 'User Successfully Checked in');

                } else {
                    return apiResponse(false, 400, 'Invalid available check in');
                }
            } elseif ($user_counter > 0) {
                User::whereId($user_id)->decrement('check_in_counter', 1, ['last_check_in'=>$now]);

                //log check_in
                $data = array(
                    "responsee_id" => Auth::id(),
                    "user_id"      => $user_id
                    );

                CheckIn::create($data);

                 return apiResponse(true, 200, 'User Successfully Checked in');
            } else {
                return apiResponse(false, 400, 'Zero check-in available'); 
            }
        } catch (\Exception $exception) {
            return apiResponse(false, 500, lang('messages.server_error'));
        }
    }

}
