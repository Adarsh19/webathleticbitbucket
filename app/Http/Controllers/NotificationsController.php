<?php

namespace App\Http\Controllers;

use App\Notifications;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NotificationsController extends Controller
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

    public function viewNotifications(Request $request, $id)
    {


        $userid=Auth::id();
        if ($id=="all") {
            $notificationsO=Notifications::where('notifiable_id', $userid)->paginate(10);
        } else {
            $notificationsO=Notifications::
                  where('notifiable_id', $userid)
                ->where('id', $id)->paginate(10);
        }

        $notifications=array();
        foreach ($notificationsO as $notif) {
            $notificationarr=$notif->toArray();
            $fulldate=Carbon::parse($notificationarr['created_at'])->format('F Y');

            //$notifications[]=array("created_at"=>$fulldate,"data"=>$notif->toArray());

            $notifications[$fulldate]['created_at']=$fulldate;
            $notifications[$fulldate]['data'][]=$notif->toArray();
        }

//        dd($notifications);
        return view('admin.notifications.notifications_timeline', compact('notifications'));
    }
}
