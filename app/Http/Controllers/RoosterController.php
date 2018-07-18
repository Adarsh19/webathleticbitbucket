<?php
/**
 * Developer Showket
 * This controller will handle all functionalities related
 * to Rooster calendar for both Comapny and Admins
 *
 */
namespace App\Http\Controllers;

use App\CalendarConnectedUser;
use App\Company;
use App\Role;
use App\Service;
use App\ServiceOpeningHours;
use App\ServiceSchedule;
use App\ServiceScheduleEvents;
use App\ServiceScheduleHasUsers;
use App\TrainingSchedule;
use App\User;
use DateInterval;
use DateTime;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Jleon\LaravelPnotify\Notify;



class RoosterController extends Controller
{



    public function __construct(){
        if (Auth::user()){
            $user = Auth::user();

            if($user->role == 'user'){
                return redirect()->back()->with(array("fail" => "You have have no authorisation."))->withInput();
            }
        } else {
            return redirect("/")->with(array("fail" => "You have to Login first to access our features."))->withInput();
        }
    }

    public  function  index(Request $request,$user_id=null,$schedule_id=null,$date=null){

        $user = User::where('id',$user_id)->first();

        if(!isset($user->id) || $user->role =="user")
        {
            abort(404);
        }

        //$id= $user->id;
        $default_first_calendar="";
        $default_first_calendar_obj=ServiceSchedule::select('id')->where('user_id',$user_id)->first();

        //dd($default_first_calendar_obj->toArray());
        $opening_hours="";
        if(!empty($default_first_calendar_obj))
            $default_first_calendar=$default_first_calendar_obj->id;
        #We show all roles to Admin, But only company added roles to company




        if($user->role == 'admin'){
            $roles=Role::select('id','role','user_id')->get();
        }else if($user->role == 'company'){
            echo $roles=Role::select('id','role','user_id')
                ->where('user_id',$user_id)
                ->toSql();
        }

        





        $opening_hours_obj=ServiceOpeningHours::where('user_id',$user_id)->first();

        //dd($opening_hours_obj->toArray());

        $opening_hours="";
        if(!empty($opening_hours_obj))
          $opening_hours=json_encode($opening_hours_obj->toArray());


        $services=Service::select('id','service','bg_color')->get();
        $service_schedules=ServiceSchedule::where('user_id',$user_id)->get();

        $companies=Company::select('user_id','company_name')
            ->where('parent_id',Auth::id())
            ->get();

//        Notify::info("This notice won't fadeout")->sticky();
//




        return view('admin.rooster.index',compact('date','user','service_schedules','roles','opening_hours','default_first_calendar','services','companies'));
    }



    public function updateConnectedUser(Request $request,$rowid)
    {


        $parent_userid=Auth::id();
        $connectedup = CalendarConnectedUser::where('parent_user_id',$parent_userid)
            ->where('id',$rowid)  //user_id here is the row id basically
            ->update([
                'user_color_code' => $request->color,'user_id'=>$request->user_id,
            ]);
        if ($connectedup) {
            Notify::success($request->user_name . " Successfully updated");
        } else {
            Notify::error("Some error occurred while updating user");
        }
        return redirect()->back();

    }


    public function saveConnectedUser(Request $request){


         $parent_userid=Auth::id();
         $ispresant=CalendarConnectedUser::where('parent_user_id',$parent_userid)
            ->where('schedule_id',$request->schedule_id)
            ->where('user_id',$request->user_id)
            ->first();




        if(empty($ispresant)) {

            $connected = CalendarConnectedUser::create([
                'parent_user_id' => $parent_userid,
                'user_id' => $request->user_id,
                'schedule_id' => $request->schedule_id,
                'user_color_code' => $request->color,
            ]);

            if ($connected) {
                Notify::success($request->user_name . " Successfully added");
            } else {
                Notify::error("Some error occurred while adding user");
            }




        }else{
            Notify::info("User already added in this schedule");


        }
        return redirect()->back();
    }

    public function deleteConnectedUser(Request $request,$userid){
        $parent_userid=Auth::id();
        $ispresant_del=CalendarConnectedUser::where('parent_user_id',$parent_userid)
            ->where('user_id',$userid)
            ->delete();
        if($ispresant_del){
            Notify::success(" Successfully disconnected");
        }else{
            Notify::error("Some error occurred while diconnecting  user");
        }
        return redirect()->back();
    }

    public function  searchUsers(Request $request,$type,$keyword,$service_id){
        $parent_id=Auth::id();
        $service=Service::where('id',$service_id)->first();
        $users=User::select('users.*','calendar_connected_users.user_color_code')
            ->leftjoin('calendar_connected_users','calendar_connected_users.user_id','users.id')
            ->where('name', 'like', '%'.$keyword.'%')
            ->where('users.parent_id', '=', $parent_id)
            ->get();

        #we need to fetch users based on role here
//        foreach($usersobj as $user){
//
//        }

        return view('admin.rooster.search_users', compact('users','service','type'));

    }

    public function addServiceSchedule(Request $request){


        $user_id=$request->user_id;
        if(!isset($user_id))
            $user_id=Auth::id();
        if(empty(ServiceSchedule::where('title','like','%'.$request->schedule_title.'%')->where('user_id',$user_id)->first())){
            $createschedule=ServiceSchedule::create([
                'title'=>$request->schedule_title,
                'user_id'=>$request->user_id,
                'role'=>$request->role,
                'color'=>$request->color,
                'dragdrop'=>isset($request->drag)?1:0,
            ]);
            if($createschedule){
                Notify::success($request->schedule_title." Successfully created");
            }else{
                Notify::success("Some error occurred while creating   schedule ".$request->schedule_title);
            }
        }else{
            Notify::success("You are trying to create duplicate schedule ".$request->schedule_title);

        }
        return redirect()->back();


    }
    public function editServiceSchedule(Request $request,$schedule_id){



        $user_id=Auth::id();

        $is_presant=ServiceSchedule::where('user_id',$user_id)->where('id',$schedule_id)->first();

        if(!empty($is_presant)){
            $dragdrop=isset($request->drag) ? 1:0;


            $updateshedule=ServiceSchedule::where('id',$schedule_id)->
            update([
                'title'=>$request->schedule_title,
                'user_id'=>$user_id,
                'role'=>$request->role,
                'dragdrop'=>$dragdrop,
                'color'=>$request->color
            ]);

            if($updateshedule){
                Notify::success($request->schedule_title." Successfully created");
            }else{
                Notify::error("Some error occurred while creating   schedule ".$request->schedule_title);
            }
        }else{
            Notify::info("You are trying to create duplicate schedule/or you are not authorized to update this schedule ".$request->schedule_title);


        }
        return redirect()->back();


    }


    public function deleteServiceSchedule(Request $request,$schedule_id){

        $user_id=Auth::id();
        if(!empty(ServiceSchedule::where('user_id',$user_id)->where('id',$schedule_id)->first())){
            $deleteshedule=ServiceSchedule::where('id',$schedule_id)->delete();
            if($deleteshedule){
                Notify::success(" Successfully deleted");
            }else{
                Notify::error("Some error occurred while deleting schedule ");
            }
        }else{
            Notify::info("Schedule not found or you don't have permissions to delete");
            return redirect()->back()->with('exception', "Schedule not found or you don't have permissions to delete");

        }
        return redirect()->back();


    }

    public function loadConnectedUsers(Request $request,$userid){

//        dd($userid);
        $parent_userid=Auth::id();
        $connected_users=CalendarConnectedUser::select('calendar_connected_users.id as id','calendar_connected_users.user_color_code','calendar_connected_users.user_id','users.name')
            ->leftjoin('users','users.id','calendar_connected_users.user_id')
            //->where('calendar_connected_users.user_id',$userid)
            ->where('calendar_connected_users.parent_user_id',$parent_userid)
            ->where('users.parent_id',$parent_userid)
            ->get();
        return view('admin.rooster.connected_users', compact('connected_users'));
    }

    private function getrecurrence($request){
        $rule="";
        if(isset($request->recurringtype)){
            if($request->recurringtype=="daily"){
                if($request->countuingselect=="forever"){
                    $rule="FREQ=DAILY;INTERVAL=".$request->numberrecur;
                }
                else if($request->countuingselect=="for"){
                    $rule="FREQ=DAILY;INTERVAL=".$request->numberrecur.";COUNT=".$request->untilnumber;
                }
                else if($request->countuingselect=="untill"){
                    $rule="FREQ=DAILY;INTERVAL=".$request->numberrecur.";UNTIL=".$request->date_untill_recur; //20180515T235959Z
                }
            }
            else if($request->recurringtype=="weekly"){
                $days=implode(",",$request->days);
                if($request->countuingselect=="forever"){
                    $rule="FREQ=WEEKLY;INTERVAL=$request->numberrecur;BYDAY=".$days;
                }
                else if($request->countuingselect=="for"){
                    $rule="FREQ=WEEKLY;INTERVAL=".$request->numberrecur.";BYDAY=".$days.";COUNT=".$request->untilnumber;
                }
                else if($request->countuingselect=="untill"){
                    $rule="FREQ=WEEKLY;INTERVAL=$request->numberrecur;BYDAY=".$days.";UNTIL=".$request->date_untill_recur; //20180515T235959Z
                }
            }

            else if($request->recurringtype=="monthly"){
                if($request->countuingselect=="forever"){
                    $rule="FREQ=MONTHLY;INTERVAL=".$request->numberrecur.";BYMONTHDAY=".$request->monthday;
                }
                else if($request->countuingselect=="for"){
                    $rule="FREQ=MONTHLY;INTERVAL=".$request->numberrecur.";BYMONTHDAY=".$request->monthday.";COUNT=".$request->untilnumber;
                }
                else if($request->countuingselect=="untill"){
                    $rule="FREQ=MONTHLY;INTERVAL=".$request->numberrecur.";BYMONTHDAY=".$request->monthday.";UNTIL=".$request->date_untill_recur; //20180515T235959Z
                }
            }
            else if($request->recurringtype=="yearly"){
                if($request->countuingselect=="forever"){
                    if(isset($request->dayinmonth))
                        $rule="FREQ=YEARLY;INTERVAL=".$request->numberrecur.";BYMONTH=".$request->month.";BYDAY=".$request->yearday;
                    else
                        $rule="FREQ=YEARLY;BYMONTH=".$request->month;
                }
                else if($request->countuingselect=="for"){
                    if(isset($request->dayinmonth))
                        $rule="FREQ=YEARLY;INTERVAL=".$request->numberrecur.";BYMONTH=".$request->month.";BYDAY=".$request->yearday.";COUNT=5".$request->untilnumber;
                    else
                        $rule="FREQ=YEARLY;BYMONTH=".$request->month.";COUNT=".$request->untilnumber;
                }
                else if($request->countuingselect=="untill"){
                    if(isset($request->dayinmonth))
                        $rule="FREQ=YEARLY;INTERVAL=".$request->numberrecur.";BYMONTH=".$request->month.";BYDAY=".$request->yearday.";UNTIL=".$request->date_untill_recur; //20180515T235959Z
                    else
                        $rule="FREQ=YEARLY;BYMONTH=".$request->month.";UNTIL=".$request->date_untill_recur;
                }
            }
        }
        return $rule;

    }


    private function addEvent($request,$type){



        $rule="";
        if($type=="create")
        {


            echo $rule=$this->getrecurrence($request);
        }else{
            //$rule=$request->rule;

            echo $rule=$this->getrecurrence($request);
        }


        $success=false;

        $allday=(isset($request->allday))? 1: 0;
        $dragable=(isset($request->dragable))? true: false;
        $canbook=(isset($request->book))? '1': '0';
        $url=(isset($request->url))? $request->url: '';
        $reminder=(isset($request->url))? $request->url: '';
        $start=$end="";
        if(isset($request->allday)){
            $start = date('Y-m-d H:i:s', strtotime($request->date_from));
            $end = date('Y-m-d H:i:s', strtotime($request->date_untill));
        }
        else{
             $start = date('Y-m-d', strtotime($request->date_from)) ." ".$request->time_from.":00";



              $end = date('Y-m-d', strtotime($request->date_untill)) ." ".$request->time_untill.":00";
        }


        $date1Timestamp = strtotime($start);
        $date2Timestamp = strtotime($end);
        //$duration = $date2Timestamp - $date1Timestamp;
        $duration=round(abs($date2Timestamp - $date1Timestamp) / 60,2)." minute";

        $servicemname=Service::select('service','bg_color','user_mass')->where('id',$request->service)->first();

        $create=ServiceScheduleEvents::create([

            'title'=>$servicemname->service,
            'backgroundColor'=>$servicemname->bg_color,
            'borderColor'=>$servicemname->bg_color,
            'title'=>$servicemname->service,
            'start'=> $start,
            'end'=>$end,
            'service_schedule_id'=>$request->schedule_id,
            'location'=>$request->location,
            'notes'=>$request->description,
            'url'=>$url,
            'reminder'=>$reminder,
            'duration'=>$duration,
            'editable'=>$dragable,
            'can_user_book'=>$canbook,
            'rrule'=>$rule,
            'all_day'=>$allday,

        ]);
        if($create){
        $success=true;
        }

        #Save Users




        if(isset($request->user_ids)){
            $user_max=$servicemname->user_mass;
            $i=1;
            $servicehas=array();
            foreach($request->user_ids as $users){
                if($users != null){
                    if($i > $user_max)
                        $book=0;
                    else
                        $book=1;
                    $i++;
                    $servicehas[]=array("user_id"=>$users,"service_schedule_id"=>$request->schedule_id,"bookflag"=>$book);
                }


            }

            if(count($servicehas))
            $save_relations=ServiceScheduleHasUsers::insert($servicehas);
        }



      return $success;




    }




    public function saveScheduleEvent(Request $request){

        $success=$this->addEvent($request,'create');
        if($success){
            Notify::success("Schedule Successfully Create");
        }
        else{
            Notify::error("Some error occurred while creating, please try again later");

        }
        return redirect()->back();

    }

    public  function  loadEvents(Request $request,$scheduleid){

         $start=$request->start;
         $end=$request->end;
        $events=ServiceScheduleEvents::

        where(function($queryout) use ($start,$end){
            $queryout->where(function($query) use ($start,$end){
                $query->where('start','>=',$start)
                    ->where('start','<=',$end);
            })
                ->orwhere(function($query2) use ($start,$end){
                    $query2->where('end','>=',$start)
                        ->where('end','<=',$end);
                })
                ->orwhere(function($query3) use ($start,$end){
                    $query3->where('start','<=',$start)
                        ->where('end','>=',$end);
                });
        })->where('service_schedule_id','=',$scheduleid)

        ->get();




        $trainignEvents=TrainingSchedule::leftjoin('training_schema','training_schema.id','training_schedule.schema_id')
//            ->where('training_schema.parent_id',1)
            ->get();




        $matches = array();
        foreach ($events->toArray() as $event) {
            //$matches=$event;
            $ins=generateInstances($event, $start, $end);

            $matches = array_merge($matches, $ins);
        }


        foreach ($trainignEvents->toArray() as $event) {
            //$matches=$event;
            $event['duration']=$event['duration'];
            $event['start']=$event['startdate'];
            $event['end']=$event['enddate'];
            $event['title']=$event['schema_name'];
            $event['parent_id']=$event['parent_id'];
            $ins=generateInstances($event, $start, $end);




            $matches = array_merge($matches, $ins);
        }


        ob_clean();
//        print_r(json_encode($matches));
        echo json_encode($matches);
        exit;
    }





    public  function updateEvent(Request $request,$schedule_id) {
        $date_format = 'Y-m-d H:i:s';

        $event=$request->input();
        $rulee=$this->getrecurrence($request);

        $event['rule']=$rulee;


        $editMode = $request->recur_edit_mode;

        $mappings = array(
            // Basic event properties. This is not all properties, only those needed explicitly
            // while processing recurrence. The others are read and set generically.
            'event_id'   => 'id',
            'start_date' => 'start',
            'end_date'   => 'end',

            // Recurrence-specific properties needed for processing recurring events:
            'rrule'                => 'rrule',
            'duration'             => 'duration',
            'orig_event_id'        => 'origid',
            'recur_edit_mode'      => 'redit',
            'recur_instance_start' => 'ristart',
            'recur_series_start'   => 'rsstart',

            // Recurrence exceptions
            'exdate' => 'exdate'
        );

        if ($editMode) {




            // This is a recurring event, so determine how to handle it.
            // First, load the original master event for this instance:
            //$master_event = $db->select('events', $event[$mappings['orig_event_id']]);

            //dd($request->input());

            $master_event=ServiceScheduleEvents::where('id',$request->orig_event_id)->first()->toArray();
            // Select by id returns an array of one item, so grab it
            //$master_event = $master_event[0];
            $event_id = $master_event['id'];
            $event['start']=$event['date_from']." ".$event['time_from'];
            $event['end']=$event['date_untill']." ".$event['time_untill'];
            switch ($editMode) {
                // NOTE: Both the "single" and "future" cases currently create new
                // events in order to represent edited versions of recurrence instances.
                // This could more flexibly be handled within a single master
                // event by supporting multiple RRULE and EXRULE definitions per
                // event. This would be a bit more complex to implement and would
                // also require more processing code to arrive at the final event
                // series to return when querying. For this example (which is already
                // complex enough) we're sticking to the simpler edit implementations
                // which can simply go through the existing default event logic, but
                // you are free to implement these however you'd like in real projects.

                case 'single':
                    // Create a new event based on the data passed in (the
                    // original event does not need to be updated in this case):


                    $this->addEvent($request,'create');

                    // Add an exception for the original occurrence start date
                    // so that the original instance will not be displayed:
                    addExceptionDate($event_id, $event['recur_instance_start']);


                    break;

                case 'future':
                    // In this sample code we're going to split the original event
                    // into two: the original up to the edit date and a new event
                    // from the edit date to the series end date. Because of this we
                    // only end-date the original event, don't update it otherwise.
                    // This could be done all within a single event as explained in
                    // the comments above, but for this example we're keeping it simple.

                    // First update the original event to end at the instance start:

//                    print_r($event['date_from']);
//                    print_r($request->input());
//                    exit;



                    $endDate = new DateTime($event['start']);



                    // We're at the day level of precision, so roll the end date back to the
                    // end of the previous day so it will display correctly in the UI.
                    $endDate->setTime(0, 0, 0)->modify('-1 second');
                    // Save the original end date before changing it so that we can
                    // apply it below to the newly-created series:
                    $originalEndDate = $master_event['end'];

                    // End-date the master event (including the RRULE) to the instance start:
                    $master_event = endDateRecurringSeries($master_event, $endDate);
                    // Persist changes:

                    update('service_events', $master_event,$schedule_id);

                    // Now create the new event for the updated future series.
                    // Update the recurrence instance start date to the edited date:
//                    $event['recur_instance_start'] = $event['start'];
//                    // Don't reuse the existing instance id since we're creating a new event:
//                    unset($event['event_id']);
//                    // Overwrite the instance end date with the master (series) end date:
//                    $event['end_date'] = $originalEndDate;
                    // Create the new event (which also persists it). Note that we are NOT calling
                    // addEvent() here, which recalculates the end date for recurring events. In this
                    // case we always want to keep the existing master event end date.\

                    $request->recur_instance_start=$event['start'];
                    $request->end=$originalEndDate;

//                    dd($request->input());

                    //$event = insert('service_events', cleanEvent($event));
                    $event= $this->addEvent($request,"update");

                    break;

                case 'all':


                    $event['start']=$event['date_from']." ".$event['time_from'];
                    $event['end']=$event['date_untill']." ".$event['time_untill'];
                    // Make sure the id is the original id, not the instance id:
                    $event['event_id'] = $event_id;
                    // Base duration off of the current instance start / end since the end
                    // date for the series will be some future date:
                    $event['duration'] = calculateDuration(
                        $event['start'], $event['end']);
                    // In case the start date was edited by the user, we need to update the
                    // original event to use the new start date
                    $instanceStart = new DateTime($event['recur_instance_start']);
                    $editedStart = new DateTime($event['start']);
                    $startDiff = $instanceStart->diff($editedStart);

                    // If start date has changed we're going to use the edited start date as the new
                    // series start date, so there's nothing else to do. However if start date is
                    // unchanged, we'll need to reset the instance start to the original series start
                    // so that we don't shift the recurring series on every edit. We'll also have to
                    // check whether the start time has changed, and if so, apply the edited offset
                    // to the original series start date. Fun!
                    if ($startDiff->days === 0) {
                        // Capture any edited time diff before we overwrite the start date
                        $startTimeDiff = calculateDuration($event['recur_instance_start'],
                            $event['start']);

                        // The start date has not changed, so revert to the
                        // original series start since we are updating the master event
                        $event['start'] = $master_event['start'];

                        if ($startTimeDiff !== 0) {
                            // The start time has changed, so even though the day is the same we
                            // still have to update the master event with the new start time
                            $seriesStart = new DateTime($event['start']);
                            if ($startTimeDiff > 0) {
                                $interval = new DateInterval('PT'.$startTimeDiff.'M');
                            }
                            else {
                                // Goofy logic required to handle negative diffs correctly for PHP
                                $interval = new DateInterval('PT'.(-1 * $startTimeDiff).'M');
                                $interval->invert = 1; // Good old PHP
                            }
                            // Apply the time offset to the original start date
//                            $event['start'] = $seriesStart->add($interval)->format($date_format);
                            $event['start'] = $seriesStart->add($interval)->format($date_format);
                        }
                    }
                    // Finally, update the end date to the original series end date. This is
                    // especially important in the case where this series may have been split
                    // previously (e.g. by a "future" edit) so we want to preserve the current
                    // end date, and not assume that it should be the default max date.
                    $event['ultend'] = calculateEndDate($event);

//                    dd($event['end']);
                    // Persist changes:

//                    echo "<pre>";
//                    print_r($event);
//                    exit;
                    $event['service_schedule_id']=$event['service_id'];

                    $allday=(isset($event['allday']))? 1: 0;
                    $dragable=(isset($event['dragable']))? true: false;
                    $canbook=(isset($event['book']))? '1': '0';



                    $eventup=array(
                        'rrule'=>$event['rule'],
                        'start'=>$event['start'],
                        'end'=>$event['end'],
                        'location'=>$event['location'],
                        'notes'=>$event['description'],
                        'can_user_book'=>$canbook,
                        'editable'=>$dragable,
                        'service_id'=>$event['service_id'],
                        'all_day'=> $allday,
                        'id'=> $event['orig_event_id'],

                    );

                    $eventu = update('service_events', $eventup);


                    $servicemname=Service::select('user_mass')->where('id',$event['service_id'])->first();

                    //echo $event['service_id'];
//                    dd($event);

                    $delete_all_first=ServiceScheduleHasUsers::where('service_schedule_id',$schedule_id)->delete();


                    if(isset($request->user_ids)) {
                        $user_max = $servicemname->user_mass;
                        $i = 1;
                        foreach ($request->user_ids as $users) {
                            if ($i > $user_max)
                                $book = 0;
                            else
                                $book = 1;
                            $i++;
                            $servicehas[] = array("user_id" => $users, "service_schedule_id" => $schedule_id, "bookflag" => $book);

                        }

                        $save_relations = ServiceScheduleHasUsers::insert($servicehas);
                    }



            }
        }
        else {
//            if ($event[$mappings['rrule']]) {
//                // There was no recurrence edit mode, but there is an rrule, so this was
//                // an existing non-recurring event that had recurrence added to it. Need
//                // to calculate the duration and end date for the series.
//                $event[$mappings['duration']] = calculateDuration(
//                    $event[$mappings['start_date']], $event[$mappings['end_date']]);
//                $event[$mappings['end_date']] = calculateEndDate($event);
//            }
//            else if ($event[$mappings['orig_event_id']]){
//                // In case the original event was recurring and was made non-recurring
//                // we need to reset the original id and clean it up
//                $event[$mappings['event_id']] = $event[$mappings['orig_event_id']];
//                // Null out the recurrence-specific fields that are left over
//                unset($event[$mappings['rrule']]);
//                unset($event[$mappings['duration']]);
//            }
//
//            $event = $db->update('events', cleanEvent($event));
        }

        if($event){
            Notify::success("Schedule Successfully Updated");
        }
        else{
            Notify::error("Some error occurred while updating, please try again later");

        }
        return redirect()->back();



    }


    function deleteEvent(Request $request) {
//        global $db, $mappings;


        $event=$request->input();
        $editMode = $event['recur_edit_mode'];

        if ($editMode) {
            // This is a recurring event, so determine how to handle it.
            // First, load the original master event for this instance:
            $master_event = ServiceScheduleEvents::where('id',$event['orig_event_id'])->first()->toArray();
//            dd($event);
//            dd($master_event);
            // Select by id returns an array of one item, so grab it
//            $master_event = $master_event[0;
            $event_id = $master_event['id'];


            $event['start']=$event['date_from']." ".$event['time_from'];

            switch ($editMode) {
                case 'single':
                    // Not actually deleting, just adding an exception so that this
                    // date instance will no longer be returned in queries:
                    addExceptionDate($event_id, $event['recur_instance_start']);
                    break;

                case 'future':
                    // Not actually deleting, just updating the series end date so that
                    // any future dates beyond the edited date will no longer be returned.
                    // Use this instance's start date as the new end date of the master event:
                    $endDate = new DateTime($event['start']);
                    // We're at the day level of precision, so roll the end date back to the
                    // end of the previous day so it will display correctly in the UI.
                    $endDate->setTime(0, 0, 0)->modify('-1 second');

                    // Now update the RRULE with this new end date also:
                    $master_event = endDateRecurringSeries($master_event, $endDate);

                    update('service_events', cleanEvent($master_event));
                    break;

                case 'all':
                    // Actually destroy the master event and remove any existing exceptions
                    $del=ServiceScheduleEvents::where('id',$event_id)->delete();
                    $rem=removeExceptionDates($event_id);
                    print_r($del);
                    print_r($rem);
                    break;
            }
        }
        else {
            // This is a plain old non-recurring event, nuke it
            $event_id = $event['orig_event_id'];
            ServiceScheduleEvents::where('id',$event_id)->delete();
            removeExceptionDates($event_id);
        }

        Notify::success("Schedule Successfully Deleted");
            return redirect()->back();

    }

    public  function  loadBookReservateUsers(Request $request,$schedule_id){
        $connected_users_with_service=ServiceScheduleHasUsers::select('users.id','users.name','calendar_connected_users.user_color_code','service_schedule_has_users.bookflag')
            ->leftjoin('users','users.id','service_schedule_has_users.user_id')
            ->leftjoin('calendar_connected_users','users.id','calendar_connected_users.user_id')
            ->where('service_schedule_has_users.service_schedule_id',$schedule_id)->groupby('service_schedule_has_users.user_id')->get();

//        dd($connected_users_with_service->toArray());
        return view('admin.rooster.connected_users_with_service', compact('connected_users_with_service'));

    }



}
