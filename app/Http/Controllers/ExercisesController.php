<?php

namespace App\Http\Controllers;

use App\Exercise;
use App\ExerciseHasAttribute;
use App\ExerciseTrainingSchema;
use App\Notifications\TrainingSchemaCreated;
use App\ProductGroups;
use App\ProductMedias;
use App\Exercises;
use App\SchemaHasExercises;
use App\TrainingSchedule;
use App\TrainingSchema;
use App\UserHasExercises;

use App\UserHasSchema;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
//use App\Exercise;
use App\User;
use App\UserHasProducts;
use App\UserOrders;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jleon\LaravelPnotify\Notify;
use Mockery\CountValidator\Exception;
use NotifiersHelpers;

class ExercisesController extends Controller
{

	/**
     * Construct
     * 
     * @return void
    */
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

    /**
     * First time loading of the cells exercise with groups
	 *
     * @param Request $request
	 * @return view
     */
    public function exerciseView(Request $request)
    {
        $user=Auth::id();
        $group = ProductGroups::where(['parent_id' => 0])->get();
        $productgroups = ProductGroups::select("productgroup.id as gid", "productgroup.slug as gslug", "exercises.*")->where(['parent_id' => 0])
            ->leftjoin('exercises', 'exercises.group_id', 'productgroup.id')
            ->where(['productgroup.group_type' => 'exercises'])
            ->where(['productgroup.user_id' => $user])
            ->orderBy('exercises.created_at', 'desc')->get();
        $user=Auth::user();
        $products=array();

        $exerciseids=array();
        foreach ($productgroups->toArray() as $product) {
            $products[$product['gslug']][]=$product;
            $exerciseids[]=$product['id'];
        }

        if (count($exerciseids)>0) {
            $exercisehasAttributes=ExerciseHasAttribute::wherein('exerciseid', $exerciseids)->get();
            $exercisedata=array();
            $attributes=$exercisehasAttributes->toArray();

            foreach ($attributes as $exerciseda) {
                $exercisedata[$exerciseda['exerciseid']][$exerciseda['attributetype']][]= $exerciseda['attributeid'];
            }
        }

        $userfilter_info=User::select('materiallevel', 'traininglevel', 'musclegroupname', 'goal')->where('id', Auth::id())->first();


        return view('admin.exercises.index', compact('user', 'products', 'exercisedata', 'group', 'userfilter_info'));
    }

	/**
     * Get Filtered exercise cells
	 *
     * @param Request $request
	 * @return view
     */ 
    public function searchFiltterExercises(Request $request)
    {
        if ((isset($request->goal) || isset($request->musclegroupname) || isset($request->traininglevel) || isset($request->materiallevel))) { // This is what i am needing.
            $que=Exercise::query()
                ->select("productgroup.id as gid", "productgroup.slug as gslug", "exercises.*")
                ->join('productgroup', 'productgroup.id', 'exercises.group_id')
                ->join('exercise_has_attributes', 'exercise_has_attributes.exerciseid', 'exercises.id');


            if (isset($request->goal)) {
                $goal=$request->goal;
                $que->where(function ($query) use ($goal) {
                    $query->where('exercise_has_attributes.attributeid', '=', $goal)
                        ->Where('exercise_has_attributes.attributetype', '=', 'musclegroup');
                });
            }

            if (isset($request->musclegroupname)) {
                $musclegroupname = $request->musclegroupname;
                $que->orwhere(function ($query) use ($musclegroupname) {
                    $query->where('exercise_has_attributes.attributeid', '=', $musclegroupname)
                        ->Where('exercise_has_attributes.attributetype', '=', 'musclegroupname');
                });
            }

            if (isset($request->traininglevel)) {
                $traininglevel=$request->traininglevel;
                $que->orwhere(function ($query) use ($traininglevel) {
                    $query->where('exercise_has_attributes.attributeid', '=', $traininglevel)
                        ->Where('exercise_has_attributes.attributetype', '=', 'traininglevel');
                });
            }
            if (isset($request->materiallevel)) {
                $materiallevel=$request->materiallevel;
                $que->orwhere(function ($query) use ($materiallevel) {
                    $query->where('exercise_has_attributes.attributeid', '=', $materiallevel)
                        ->Where('exercise_has_attributes.attributetype', '=', 'material');
                });
            }
            $user=Auth::id();
            $que->where(['group_type' => 'exercises']);
            $que->where(['productgroup.user_id' => $user]);
            $que->orderBy('exercises.created_at', 'desc');

            $productgroups=$que->get();
        } else {
            $user=Auth::id();
            $group = ProductGroups::where(['parent_id' => 0])->get();
            $productgroups = ProductGroups::select("productgroup.id as gid", "productgroup.slug as gslug", "exercises.*")->where(['parent_id' => 0])
                ->leftjoin('exercises', 'exercises.group_id', 'productgroup.id')
                ->where(['group_type' => 'exercises'])
                ->where(['productgroup.user_id' => $user])
                ->orderBy('exercises.created_at', 'desc')->get();
        }
        $products=array();
        foreach ($productgroups->toArray() as $product) {
            $products[$product['gslug']][]=$product;
            $exerciseids[]=$product['id'];
        }
        $exercisehasAttributes=ExerciseHasAttribute::wherein('exerciseid', $exerciseids)->get();
        $exercisedata=array();
        $attributes=$exercisehasAttributes->toArray();

        foreach ($attributes as $exerciseda) {
            $exercisedata[$exerciseda['exerciseid']][$exerciseda['attributetype']][]= $exerciseda['attributeid'];
        }
        return view('admin.exercises.grid_view', compact('user', 'products', 'exercisedata', 'group'));
        exit;
    }

    /**
     * Update session
	 *
     * @param string $ids
	 * echo JSON
     */ 
	public function updateSession($ids)
    {
         $users=rtrim($ids, ",");
        $res=Session::put('user_ids', $users);
        Session::save();
        $rs=array("status"=>"success","message"=>"Session updated");
        echo json_encode($rs);
        exit;
    }

    /**
     * Remove session
	 *
     * @param string $id
	 * echo "success"
     */ 
	public function removeSessionUsers($id)
    {
        $userhasschema=TrainingSchema::select('user_has_schema.id as schemaid')->leftjoin('user_has_schema', 'user_has_schema.schema_id', 'training_schema.id')
            ->where('user_has_schema.user_id', $id)
            ->where('training_schema.status', 'incomplete')
            ->first();
        if (!empty($userhasschema)) {
            UserHasSchema::where('id', $userhasschema->schemaid)->delete();
        }
        $users=Session::get('user_ids');
        $usersexp=explode(",", $users);
        $arraynew = array_diff($usersexp, array($id));
        $userstosave=implode(",", $arraynew);
        Session::put('user_ids', $userstosave);
        Session::save();
        echo "success";
        exit;
    }


    /**
     * Load user session
	 *
	 * return view
     */ 
	public function loadUserSession()
    {
        $user=Auth::user();
        $usersar= Session::get('user_ids');


        $users= explode(",", $usersar);

        $users=User::wherein('id', $users)->get();


        ob_clean();
        return view('admin.exercises.user_top_cell', compact('users'));
    }

    
	/**
     * Add exercise group
	 *
     * @param Request $request
	 * @redirect
     */
	public function addExerciseGroup(Request $request)
    {
        $user = Auth::user();
        $slug = str_slug($request->groupname);
        $parent_id = 0;
        $source="exercises";
        if ($request->has('parent_id')) {
            $parent_id = $request->parent_id;
            $groupExists = ProductGroups::where(['name' => $request->groupname])->where(['parent_id' => $parent_id])->where(['group_type' => $source])->count();
        } else {
            $groupExists = ProductGroups::where(['name' => $request->groupname])->where(['parent_id' => 0])->where(['group_type' => $source])->count();
        }
        if (!$groupExists) {
                 $groups = ProductGroups::create([
                        'name' => $request->groupname,
                        'slug' => $slug,
                        'parent_id' => $parent_id,
                        'imagepath' => 'noimage.jpeg',
                        'user_id' => $user->id,
                        'group_type' => $source,
                    ]);
                    Session::flash('alert-success', 'Group '.$request->groupname." Successfully Added");
        } else {
            Session::flash('alert-warning', 'Group '.$request->groupname." Exists Please Use Unique");
        }

        return redirect()->back();
    }
    
	/**
     * Update exercise group
	 *
     * @param Request $request
	 * @redirect
     */ 
	public function updateExerciseGroup(Request $request)
    {
        $user = Auth::user();
        $slug = str_slug($request->groupname);
        $parent_id = 0;
        $source="exercises";
        $parent_id = $request->parentid;
        $updateType = $request->typegroup;
        $groupid = $request->groupid;
        if ($updateType!="subgroup") {
            $groupExists = ProductGroups::where(['name' => $request->groupname])->where(['parent_id' => 0])->where(['group_type' => $source])->where('id', '!=', $groupid)->count();
        } else {
            $groupExists = ProductGroups::where(['name' => $request->groupname])->where(['parent_id' => $parent_id])->where(['group_type' => $source])->where('id', '!=', $groupid)->count();
        }
        if (!$groupExists) {
            $th=DB::table('productgroup')
            ->where('id', $groupid)
            ->update(['name' =>$request->groupname,'parent_id' =>$parent_id,'slug' =>$slug]);
                    Session::flash('alert-success', 'Group '.$request->groupname." Successfully Updated");
        } else {
            Session::flash('alert-warning', 'Group '.$request->groupname." Exists Please Use Unique");
        }
        if ($parent_id > 0) {
            $group = ProductGroups::where(['id' => $parent_id])->first();
            return redirect('/exercises/exercises-group/'.$group->slug);
        }
        return redirect('/exercises/view');
    }


	/**
     * Get Filtered exercise cells
	 *
     * @param Request $request
	 * return view
     */ 
    public function addExercise(Request $request)
    {
        $products=array();
        $user = Auth::user();



        //foreach($request->file('imagefile') as $key=>$image)
       // {
           $slug = str_slug($request->productname);
           $image=$request->imagefile;
        if (!isset($image)) {
            $name="noimage.jpeg";
        } else {
            $name = time().".".$image->getClientOriginalExtension();
            $destinationPath = public_path('/admin/images/groups/exercises/');
            $image->move($destinationPath, $name);
        }



           $productsss=Exercise::where('slug', $slug)->first();


        if (empty($productsss)) {
            foreach ($request->group_id as $gid) {
                $barcode = "Slug: " . $slug . " Name: " . $gid . " Price: " . $request->price . "Tax: " . $request->tax;


                $res = Exercise::create([
                    'name' => $request->productname,
                    'price' => $request->price,
                    'tax' => $request->tax,
                    'slug' => $slug,
                    'user_id' => $user->id,
                    'barcode' => $barcode,
                    'type' => 'image',
                    'group_id' => $gid,
                    'group_priority' => $request->group_priority,
                    'path' => $name
                ]);


                if (isset($request->goal)) {
                    foreach ($request->goal as $attr) {
                        ExerciseHasAttribute::create(
                            ['exerciseid' => $res->id, 'attributeid' => $attr, 'attributetype' => 'goal']
                        );
                    }
                }
                if (isset($request->traininglevel)) {
                    foreach ($request->traininglevel as $attr) {
                        ExerciseHasAttribute::create(
                            ['exerciseid' => $res->id, 'attributeid' => $attr, 'attributetype' => 'traininglevel']
                        );
                    }
                }
                if (isset($request->musclegroup)) {
                    foreach ($request->musclegroup as $attr) {
                        ExerciseHasAttribute::create(
                            ['exerciseid' => $res->id, 'attributeid' => $attr, 'attributetype' => 'musclegroup']
                        );
                    }
                }
                if (isset($request->material)) {
                    foreach ($request->material as $attr) {
                        ExerciseHasAttribute::create(
                            ['exerciseid' => $res->id, 'attributeid' => $attr, 'attributetype' => 'material']
                        );
                    }
                }

                $errors = "Exercise  " . $request->productname . " successfully created";
            }
        } else {
            $errors="Exercise with ".$request->productname." Already exists try with different name";
        }

       // }
        return redirect()->back()->with('message', $errors);
        //return redirect()->back();
    }

    /**
     * Edit excercise
	 *
     * @param Request $request
     * @param integer $exid
	 * @redirect
     */ 
	public function editExercise(Request $request, $exid)
    {

        //foreach($request->file('imagefile') as $key=>$image)
        {
            $user=Auth::id();
            $story=Exercise::where('id', $exid)->first();
            $image=$request->imagefile;
            $slug = str_slug($request->productname);

        if (isset($image)) {
            if ($story->imagepath) {
                @unlink(get_product_imge_path($story->imagepath));
            }
            $name = time().".".$image->getClientOriginalExtension();
            $destinationPath = public_path('/admin/images/groups/exercises/');
            $image->move($destinationPath, $name);

            foreach ($request->group_id as $grp) {
                $re=Exercise::where('id', $exid)->where('group_id', $grp)->first();
                $barcode = "Slug: " . $slug . " Name: " . $grp . " Price: " . $request->price . "Tax: " . $request->tax;
                if (!empty($re)) {
                    $res = Exercise::where('id', $exid)->update(
                        [
                            'name' => $request->productname,
                            'price' => $request->price,
                            'tax' => $request->tax,
                            'group_priority' => $request->group_priority,
                            'group_id' => $grp,
                            'path' => $name
                        ]
                    );
                } else {
                    $res = Exercise::create(
                        [
                            'name' => $request->productname,
                            'price' => $request->price,
                            'tax' => $request->tax,
                            'slug' => $slug,
                            'user_id' => $user->id,
                            'barcode' => $barcode,
                            'type' => 'image',
                            'group_id' => $grp,
                            'group_priority' => $request->group_priority,
                            'path' => $name
                        ]
                    );
                }
            }
        } else {
//                $res=Exercise::where('id',$exid)->update([
//                        'name' => $request->productname,
//                        'price' => $request->price,
//                        'tax' => $request->tax,
//                        'group_priority' => $request->group_priority,
//
//                    ]
//                );
            foreach ($request->group_id as $grp) {
                $barcode = "Slug: " . $slug . " Name: " . $grp . " Price: " . $request->price . "Tax: " . $request->tax;
                $re=Exercise::where('id', $exid)->where('group_id', $grp)->first();
                if (!empty($re)) {
                    $res = Exercise::where('id', $exid)->update(
                        [
                           'name' => $request->productname,
                           'price' => $request->price,
                           'tax' => $request->tax,
                           'group_priority' => $request->group_priority,
                           'group_id' => $grp,
                        ]
                    );
                } else {
                       $res = Exercise::create(
                           [
                               'name' => $request->productname,
                               'price' => $request->price,
                               'tax' => $request->tax,
                               'slug' => $slug,
                               'user_id' => $user->id,
                               'barcode' => $barcode,
                               'type' => 'image',
                               'group_id' => $grp,
                               'group_priority' => $request->group_priority,

                           ]
                       );
                }
            }
        }

        }
        if (isset($request->goal)) {
            echo $exid;
            ExerciseHasAttribute::where('exerciseid', $exid)->wherein('attributeid', $request->goal)->delete();
            foreach ($request->goal as $attr) {
                ExerciseHasAttribute::create(
                    ['exerciseid'=>$exid,'attributeid'=>$attr,'attributetype'=>'goal']
                );
            }
        }

        if (isset($request->traininglevel)) {
            ExerciseHasAttribute::where('exerciseid', $exid)->wherein('attributeid', $request->traininglevel)->delete();
            foreach ($request->traininglevel as $attr) {
                ExerciseHasAttribute::create(
                    ['exerciseid'=>$exid,'attributeid'=>$attr,'attributetype'=>'traininglevel']
                );
            }
        }

        if (isset($request->musclegroup)) {
            ExerciseHasAttribute::where('exerciseid', $exid)->wherein('attributeid', $request->musclegroup)->delete();
            foreach ($request->musclegroup as $attr) {
                ExerciseHasAttribute::create(
                    ['exerciseid'=>$exid,'attributeid'=>$attr,'attributetype'=>'musclegroup']
                );
            }
        }

        if (isset($request->material)) {
            ExerciseHasAttribute::where('exerciseid', $exid)->wherein('attributeid', $request->material)->delete();
            foreach ($request->material as $attr) {
                ExerciseHasAttribute::create(
                    ['exerciseid'=>$exid,'attributeid'=>$attr,'attributetype'=>'material']
                );
            }
        }


        return redirect()->back()->with('message', "Exercise  Updated Successfully");
    }


    /**
     * Delete exercise
	 *
     * @param integer $id
	 * @redirect
     */ 
	public function deleteExercise($id)
    {
        $story = Exercise::find($id);
        if (count($story)) {
            if ($story->imagepath) {
                @unlink(get_product_imge_path($story->imagepath));
            }

            $story->delete();
            return redirect()->back()->with('message', 'Exercise deleted successfully.');
        } else {
            return redirect()->back()->with('exception', 'Exercise not found !');
        }
    }


    /**
     * Search user
	 *
     * @param string $keyword
	 * @return view
     */ 
	public function searchUser($keyword)
    {
        $users=User::where('name', 'like', '%'.$keyword.'%')->get();
        ob_clean();
        return view('admin.exercises.search_user_response', compact('users'));
    }

    
    /**
     * Create schedule
	 *
     * @param string $uids
     * @param integer $exerciseid
	 * @return view
     */ 
	public function createschedule($uids = null, $exerciseid = null)
    {
        $uids=rtrim($uids, ",");



        if ($uids !="null") {
            $uids=str_replace("null,", "", $uids);
            $userids=explode(",", $uids);
        } else {
            #This schedule will be saved for admin itself
            $userids=array(Auth::id());
        }



        try {
            $exerciseid=str_replace("p_", "", $exerciseid);
            $user=Auth::id();

            $exercise=Exercise::select('productgroup.name as gname', 'productgroup.id as gid', 'exercises.*')
            ->join('productgroup', 'productgroup.id', 'exercises.group_id')
            ->where('exercises.user_id', $user)
            ->where('exercises.id', $exerciseid)
            ->first();

            if (!empty($exercise)) {
                if ($exercise->price>0) {
                    $response=array("status"=>"error","message"=>"Exercise is not free");
                    return $response;
                }
                $gpriority=$exercise->group_priority;
            }

            $schedulePresent=TrainingSchema::select('training_schema.status', 'training_schema.id', 'user_has_schema.user_id')
            ->leftjoin('user_has_schema', 'user_has_schema.schema_id', 'training_schema.id')
            ->wherein('user_has_schema.user_id', $userids)
            ->where('training_schema.status', 'incomplete')
            ->get();


            if (count($schedulePresent)==0) {
                #save schema
                $schema=TrainingSchema::create([
                'parent_id'=>Auth::id(),
                'status'=>'incomplete']);

                #Save exercise in Schema has exercise
                if ($schema) {
                    $createrelation=SchemaHasExercises::create([

                        'schema_id'=>$schema->id,
                        'exercise_id'=>$exerciseid,
                        'sets'=>0,
                        'reps'=>0,
                        'rust'=>0,
                        'priority'=>$gpriority]);


                    if ($createrelation) {
                            #save user has schema
                        foreach ($userids as $user) {
                            $createrelation=UserHasSchema::create([

                            'user_id'=>$user,
                            'schema_id'=>$schema->id,
                            'type'=>'created',]);
                        }
                            $response[]=array("status"=>"success","message"=>"Exercise Schedule created and exercise added", "schedule_id"=>$schema->id,"userid"=>implode(",", $userids));
                    } else {
                        $response[]=array("status"=>"error","message"=>"User Has schema updation error");
                        return $response;
                    }
                } else {
                    $response[]=array("status"=>"error","message"=>"Schema Creation error");
                    return $response;
                }
            } else {
                $schemaid=$schedulePresent[0]['id'];
                $userids=implode(",", array_column($schedulePresent->toArray(), "user_id"));

                #add new exercise if not presant

                $checkifexercisealreadyadded=SchemaHasExercises::where('schema_id', $schemaid)
                ->where('exercise_id', $exerciseid)
                ->first();
                if (empty($checkifexercisealreadyadded)) {
                    $createrelation=SchemaHasExercises::create([

                    'schema_id'=>$schemaid,
                    'exercise_id'=>$exerciseid,
                    'sets'=>0,
                    'reps'=>0,
                    'rust'=>0,
                    'priority'=>$gpriority]);

                    if ($createrelation) {
                        $response[]=array("status"=>"success","message"=>"Exercise Added to the schedule", "schedule_id"=>$schemaid,"userid"=>$userids);
                    } else {
                        $response[]=array("status"=>"error","message"=>"Exercise was not added, due to some error");
                    }
                } else {
                    $response[]=array("status"=>"error","message"=>"Exercise already added in schedule","schedule_id"=>$schemaid,"userid"=>$userids);
                }
            }
        } catch (Exception $exception) {
            $response[]=array("status"=>"error","message"=>"Exception: ".$exception->getMessage());
        }

        echo json_encode($response);
        exit;
    }

	/**
     * Add predefined schedule
	 *
     * @param string $userids
     * @param integer $schedul_id
	 * @return JSON
     */ 
	function addpredefinedchedule($userids = null, $schedul_id = null)
    {

        $usersarr=explode(",", rtrim($userids, ","));

        $schedulid=str_replace("scheduleid_", "", $schedul_id);
        $usersobj=User::select('name', 'id')->get();
        $users=array();
        foreach ($usersobj as $user) {
            $users[$user->id]=$user->name;
        }
        foreach ($usersarr as $usid) {
            $sch=UserHasSchema::where('user_id', $usid)->where('schema_id', $schedulid)->first();
            if (empty($sch)) {
                $assign=UserHasSchema::where('schema_id', $schedulid)->create(
                    [
                        'user_id'=>$usid,
                        'schema_id'=>$schedulid,
                    ]
                );

                if ($assign) {
                    $response[]=array("status"=>"success","message"=>"Schema added successfully to user ".$users[$usid],"schedule_id"=>$schedulid,"userid"=>$userids);
                } else {
                    $response[]=array("status"=>"error","message"=>"Some error occurred while assigning schedule");
                }
            } else {
                $response[]=array("status"=>"error","message"=>"Schedule already assigned to this user ".$users[$usid],"schedule_id"=>$schedulid,"userid"=>$userids);
            }
        }
        echo json_encode($response);
        exit;
    }



	/**
     * Create schedule old
	 *
     * @param string $uids
     * @param integer $exerciseid
	 * @return JSON
     */ 
    public function createscheduleold($uids = null, $exerciseid = null)
    {
        $response=array();
        try {
            $uids=rtrim($uids, ",");

            if ($uids !="null") {
                $uids=str_replace("null,", "", $uids);
                $userids=explode(",", $uids);
            } else {
                #This schedule will be saved for admin itself
                $userids=Auth::id();
            }

            $exerciseid=str_replace("p_", "", $exerciseid);
            $user=Auth::id();
            $exercise=Exercise::select('productgroup.name as gname', 'productgroup.id as gid', 'exercises.*')
                ->join('productgroup', 'productgroup.id', 'exercises.group_id')
                ->where('exercises.user_id', $user)
                ->where('exercises.id', $exerciseid)
                ->first();
            if (!empty($exercise)) {
                if ($exercise->price>0) {
                    $response=array("status"=>"error","message"=>"Exercise is not free");
                    return $response;
                }
            }
            if (!empty($exercise)) {
                $exercisename=$exercise->name;
                $price=$exercise->price;
                $tax=$exercise->tax;
                $gid=$exercise->gid;
                $exid=$exercise->id;
                $gname=$exercise->gname;
                $imagepath=$exercise->path;
                $gpriority=$exercise->group_priority;




                $schedulePresent=TrainingSchema::select('training_schema.status', 'user_has_schema.user_id')
                    ->leftjoin('user_has_schema', 'user_has_schema.schema_id', 'training_schema.id')
                ->wherein('user_has_schema.user_id', $userids)
                    ->where('training_schema.status', 'incomplete')
                    ->get();


                if (count($schedulePresent)==0) {
                    foreach ($userids as $userid) {
                        $checkifexercisealreadyadded=SchemaHasExercises::where('schema_id', $scheduleid)
                            ->where('exercise_id', $exid)
                            ->first();
                        if (empty($checkifexercisealreadyadded)) {
                            $createrelation=SchemaHasExercises::create([

                                'schema_id'=>$scheduleid,
                                'exercise_id'=>$exid,
                                'sets'=>0,
                                'reps'=>0,
                                'rust'=>0,
                                'priority'=>$gpriority]);

                            if ($createrelation) {
                                $response[]=array("status"=>"success","message"=>"Exercise Schedule created and exercise added", "schedule_id"=>$scheduleid,"userid"=>$userid);
                            } else {
                                $response[]=array("status"=>"error","message"=>"Exercise was not added, due to some error");
                            }
                        } else {
                            $response[]=array("status"=>"error","message"=>"Exercise already added in schedule","schedule_id"=>$scheduleid,"userid"=>$userid);
                        }
                    }
                } else {
                    foreach ($schedulePresent as $scheduleP) {
                        $scheduleid=$scheduleP->id;
                        $uid=$scheduleP->user_id;
                        $checkifexercisealreadyadded=SchemaHasExercises::where('schedule_id', $scheduleid)
                            ->where('exercise_id', $exid)
                            ->first();
                        if (empty($checkifexercisealreadyadded)) {
                            $createrelation=SchemaHasExercises::create([

                                'schema_id'=>$scheduleid,
                                'exercise_id'=>$exid,
                                'sets'=>0,
                                'reps'=>0,
                                'rust'=>0,
                                'priority'=>$gpriority]);

                            if ($createrelation) {
                                $response[]=array("status"=>"success","message"=>"Exercise Schedule created and exercise added","schedule_id"=>$scheduleid,"userid"=>$uid);
                            } else {
                                $response[]=array("status"=>"error","message"=>"Exercise was not added, due to some error","schedule_id"=>$scheduleid,"userid"=>$uid);
                            }
                        } else {
                            $response[]=array("status"=>"error","message"=>"Exercise already added in schedule","schedule_id"=>$scheduleid,"userid"=>$uid);
                        }
                    }

                    //$response=array("status"=>"error","message"=>"Exercise already added in schedule","schedule_id"=>$scheduleid);
                }
            } else {
                $response[]=array("status"=>"error","message"=>"Exercise not presant");
            }


//            $schedule=ExerciseTrainingSchema::where('status','incomplete')->where('userid',$userid)->first();
//            if(!empty($schedule)){
//
//            }
        } catch (Exception $exception) {
            $response[]=array("status"=>"error","message"=>"Exception: ".$exception->getMessage());
        }

        echo json_encode($response);
        exit;
    }

	/**
     * Get order details
	 *
     * @param integer $orderid
	 * @return view
     */
    public function getorderdetails($orderid)
    {

        $order=UserOrders::select('user_has_products.price', 'user_has_products.name')->leftjoin('user_has_products', 'user_has_products.orderid', 'user_orders.id')->where('id', $orderid)->get();
        return view('admin.updatecart', compact('order'));
    }

	/**
     * Show added exercises
	 *
     * @param string $userids
	 * @return view
     */ 
	public function showAddedExercises($userids)
    {

        $userids=rtrim($userids, ",");
        if ($userids =="null") {
            $use=array(Auth::id());
        } else {
            $use=explode(",", $userids);
        }



        $orders=TrainingSchema::select(
            'training_schema.id as schedule_id',
            'schema_has_exercise.exercise_id',
            'schema_has_exercise.sets',
            'schema_has_exercise.reps',
            'schema_has_exercise.rust',
            'schema_has_exercise.ex_meta',
            'schema_has_exercise.priority',
            'exercises.path as imagepath',
            'exercises.name as ex_name',
            'productgroup.name as group_name',
            'schema_has_exercise.id as schemaexerciseid',
            'user_has_schema.user_id'
        )
            ->wherein('user_has_schema.user_id', $use)
            ->leftjoin('schema_has_exercise', 'schema_has_exercise.schema_id', 'training_schema.id')
            ->leftjoin('user_has_schema', 'user_has_schema.schema_id', 'schema_has_exercise.schema_id')
            ->leftjoin('exercises', 'exercises.id', 'schema_has_exercise.exercise_id')
            ->leftjoin('productgroup', 'productgroup.id', 'exercises.group_id')
             ->where('training_schema.status', "incomplete")
            ->groupby('schema_has_exercise.exercise_id')
            ->get();




        return view('admin.exercises.show_added_exercises', compact('orders'));
    }	
	
    /**
     * Load predefined schema
	 *
     * @param Request $request
	 * @return view
     */ 
    public function loadPredefinedSchema(Request $request)
    {

        $predefined_schemas=TrainingSchema::select(
            'training_schema.id as schedule_id',
            'training_schema.schema_name',
            'training_schema.schema_note',
            'schema_has_exercise.exercise_id',
            'schema_has_exercise.sets',
            'schema_has_exercise.reps',
            'schema_has_exercise.rust',
            'schema_has_exercise.priority',
            'exercises.path as imagepath',
            'exercises.name as ex_name',
            'productgroup.name as group_name',
            'training_schedule.recurring',
            'training_schedule.days',
            'training_schedule.startdate',
            'training_schedule.enddate',
            'schema_has_exercise.id as schemaexerciseid',
            'user_has_schema.user_id'
        )
            ->leftjoin('schema_has_exercise', 'schema_has_exercise.schema_id', 'training_schema.id')
            ->leftjoin('user_has_schema', 'user_has_schema.schema_id', 'schema_has_exercise.schema_id')
            ->leftjoin('exercises', 'exercises.id', 'schema_has_exercise.exercise_id')
            ->leftjoin('productgroup', 'productgroup.id', 'exercises.group_id')
            ->leftjoin('training_schedule', 'training_schedule.schema_id', 'training_schema.id')
            ->where('training_schema.status', "complete")
            ->where('training_schema.parent_id', Auth::id())
            ->groupby('training_schema.id')
            ->get();

//        dd($predefined_schemas->toArray());
        return view('admin.exercises.predefined_view', compact('predefined_schemas'));
    }

   
    /**
     * Load predefined schema filter
	 *
     * @param Request $request
     * @param string $keyword default 'null'
	 * @return view
     */ 
	public function loadPredefinedSchemaFilter(Request $request, $keyword = null)
    {

        $predefined_schemas=TrainingSchema::select(
            'training_schema.id as schedule_id',
            'training_schema.schema_name',
            'training_schema.schema_note',
            'schema_has_exercise.exercise_id',
            'schema_has_exercise.sets',
            'schema_has_exercise.reps',
            'schema_has_exercise.rust',
            'schema_has_exercise.priority',
            'exercises.path as imagepath',
            'exercises.name as ex_name',
            'productgroup.name as group_name',
            'training_schedule.recurring',
            'training_schedule.days',
            'training_schedule.startdate',
            'training_schedule.enddate',
            'schema_has_exercise.id as schemaexerciseid',
            'user_has_schema.user_id'
        )
            ->leftjoin('schema_has_exercise', 'schema_has_exercise.schema_id', 'training_schema.id')
            ->leftjoin('user_has_schema', 'user_has_schema.schema_id', 'schema_has_exercise.schema_id')
            ->leftjoin('exercises', 'exercises.id', 'schema_has_exercise.exercise_id')
            ->leftjoin('productgroup', 'productgroup.id', 'exercises.group_id')
            ->leftjoin('training_schedule', 'training_schedule.schema_id', 'training_schema.id')
            ->leftjoin('users', 'users.id', 'user_has_schema.user_id')
            ->where('training_schema.status', "complete")
            ->where('training_schema.parent_id', Auth::id())
            ->where('training_schema.schema_name', 'like', '%'.$keyword.'%')
            ->orwhere('exercises.name', 'like', '%'.$keyword.'%')
            ->orwhere('users.name', 'like', '%'.$keyword.'%')
            ->orwhere('training_schedule.startdate', 'like', '%'.$keyword.'%')
            ->orwhere('training_schedule.enddate', 'like', '%'.$keyword.'%')
            ->groupby('training_schema.id')
            ->get();
        return view('admin.exercises.predefined_view', compact('predefined_schemas'));
    }

    /**
     * Get Filtered exercise cells
	 *
     * @param Request $request
	 * return view
     */ 
	public function loadAddedSchema($userids = null)
    {

        $useridsar=explode(",", rtrim($userids, ","));

        $predefined_schemas=TrainingSchema::select(
            'training_schema.id as schedule_id',
            'training_schema.schema_name',
            'training_schema.schema_note',
            'schema_has_exercise.exercise_id',
            'schema_has_exercise.sets',
            'schema_has_exercise.reps',
            'schema_has_exercise.rust',
            'schema_has_exercise.priority',
            'exercises.path as imagepath',
            'exercises.name as ex_name',
            'productgroup.name as group_name',
            'training_schedule.recurring',
            'training_schedule.days',
            'training_schedule.startdate',
            'training_schedule.enddate',
            'schema_has_exercise.id as schemaexerciseid',
            'user_has_schema.user_id'
        )
            ->leftjoin('schema_has_exercise', 'schema_has_exercise.schema_id', 'training_schema.id')
            ->leftjoin('user_has_schema', 'user_has_schema.schema_id', 'schema_has_exercise.schema_id')
            ->leftjoin('exercises', 'exercises.id', 'schema_has_exercise.exercise_id')
            ->leftjoin('productgroup', 'productgroup.id', 'exercises.group_id')
            ->leftjoin('training_schedule', 'training_schedule.schema_id', 'training_schema.id')
            ->where('training_schema.status', "complete")
            ->wherein('user_has_schema.user_id', $useridsar)
            ->groupby('training_schema.id')
            ->get();
        return view('admin.exercises.show_added_schedules', compact('predefined_schemas'));
    }


    /**
     * Delete added schema
	 *
     * @param integer $schemaid default 'null'
	 * @redirect
     */ 
	public function deleteAddedSchema($schemaid = null)
    {
        $delete=UserHasSchema::where('schema_id', $schemaid)->delete();
        if ($delete) {
            return redirect()->back()->with('message', 'Schema deleted successfully.');
        } else {
            return redirect()->back()->with('exception', 'Schema not found !');
        }
    }

    /**
     * Show training schema PDF
	 *
     * @param integer $schemaid default 'null'
	 * @return view
     */ 
	public function showTrainingSchemaPdf($schemaid = null)
    {
        $schemas=TrainingSchema::select(
            'training_schema.id as schedule_id',
            'training_schema.parent_id',
            'schema_has_exercise.exercise_id',
            'schema_has_exercise.sets',
            'schema_has_exercise.reps',
            'schema_has_exercise.rust',
            'schema_has_exercise.ex_meta',
            'schema_has_exercise.priority',
            'exercises.path as imagepath',
            'exercises.name as ex_name',
            'productgroup.name as group_name',
            'training_schedule.recurring',
            'training_schedule.days',
            'training_schedule.startdate',
            'training_schedule.enddate',
            'companies.avatar as company_logo',
            'companies.name as company_name',
            'schema_has_exercise.id as schemaexerciseid',
            'user_has_schema.user_id',
            'users.name as user_name'
        )
            ->leftjoin('schema_has_exercise', 'schema_has_exercise.schema_id', 'training_schema.id')
            ->leftjoin('user_has_schema', 'user_has_schema.schema_id', 'schema_has_exercise.schema_id')
            ->leftjoin('exercises', 'exercises.id', 'schema_has_exercise.exercise_id')
            ->leftjoin('productgroup', 'productgroup.id', 'exercises.group_id')
            ->leftjoin('training_schedule', 'training_schedule.schema_id', 'training_schema.id')
            ->leftjoin('companies', 'companies.user_id', 'training_schema.parent_id')
            ->leftjoin('users', 'user_has_schema.user_id', 'users.id')
            ->where('training_schema.id', $schemaid)
            ->groupby('schema_has_exercise.id')
            ->get();



        $users=TrainingSchema::select(
            'user_has_schema.user_id',
            'users.name'
        )
            ->leftjoin('schema_has_exercise', 'schema_has_exercise.schema_id', 'training_schema.id')
            ->leftjoin('user_has_schema', 'user_has_schema.schema_id', 'schema_has_exercise.schema_id')
            ->leftjoin('users', 'user_has_schema.user_id', 'users.id')
            ->where('training_schema.id', $schemaid)
            ->groupby('user_has_schema.user_id')
            ->get();


//        $schemas=array();
//        dd($schemas->toArray());
//        foreach($schemasobj->toArray() as $schema){
//            $schemas[$schema['user_id']]['company_name']=$schema['company_name'];
//            $schemas[$schema['user_id']]['company_logo']=$schema['company_logo'];
//            $schemas[$schema['user_id']]['user_name']=$schema['name'];
//            $schemas[$schema['user_id']]['data'][]=$schema;
//        }

        $schemas=$schemas->toArray();
        return view('admin.exercises.schema_pdf', compact('schemas', 'users'));
    }

    /**
     * Load predefined schema exercises
	 *
     * @param integer $scheduleid default 'null'
	 * @return view
     */ 
	public function loadPredefinedSchemaExercises($scheduleid = null)
    {


        $predefined_schema=TrainingSchema::select('exercises.path as imagepath', 'exercises.name', 'schema_has_exercise.sets', 'schema_has_exercise.reps', 'schema_has_exercise.rust')
            ->leftjoin('schema_has_exercise', 'schema_has_exercise.schema_id', 'training_schema.id')
            ->leftjoin('exercises', 'exercises.id', 'schema_has_exercise.exercise_id')
            ->where('training_schema.parent_id', Auth::id())
            ->where('training_schema.id', $scheduleid)
            ->get();
        return view('admin.exercises.carossel_view', compact('predefined_schema'));
    }
	
	/**
     * Edit training schema
	 *
     * @param Request $request
     * @param integer $scheduleid
	 * @redirect
     */  
	public function editTrainingSchema(Request $request, $scheduleid)
    {
        $create=SchemaHasExercises::where('id', $scheduleid)->update([
            'sets'=>$request->sets,
            'reps'=>$request->reps,
            'rust'=>$request->rust,
            'ex_meta'=>$request->ex_meta,
            'ex_name'=>$request->productname,
        ]);


        if ($create) {
            return redirect()->back()->with('message', "Exercise  Updated Successfully");
        } else {
            return redirect()->back()->with('warning', "Schedule Not found");
        }
    }

    /**
     * Delete training exercise
	 *
     * @param Request $request
     * @param integer $scheduleid
	 * @redirect
     */  
	public function deleteTrainingExercise(Request $request, $scheduleid)
    {

        $deleted=SchemaHasExercises::where('id', $scheduleid)->delete();
        if ($deleted) {
            return redirect()->back()->with('message', "Exercise  Deleted Successfully");
        } else {
            return redirect()->back()->with('warning', "Schedule Not found");
        }
    }


    /**
     * Delete schedule
	 *
     * @param Request $request
     * @param integer $id
	 * @redirect
     */ 
	public function deleteSchedule(Request $request, $id)
    {

//        $schids=explode(",",rtrim($ids,","));
        $traingsscheule=TrainingSchema::where('id', $id)->delete();
        $create=UserHasSchema::where('schema_id', $id)->delete();
        $create=SchemaHasExercises::where('schema_id', $id)->delete();
        if ($create) {
            Session::forget('user_ids');
            Session::save();
            return redirect()->back()->with('message', "Trainig Schedule Deleted Successfully");
        } else {
            return redirect()->back()->with('warning', "Schedule Not found");
        }
    }

    /**
     * Save schedule
	 *
     * @param Request $request
     * @param string $ids
	 * @redirect
     */ 
	public function saveSchedule(Request $request, $ids)
    {

            $recurring=isset($request->recurring) ? "yes":"no";
            $days=isset($request->days) ? implode(",", $request->days):"";
            $schema_name=$request->schema_name;
            $schema_note=$request->schema_note;


            $startdate=isset($request->startdate) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $request->startdate))) : null;
            $enddate=isset($request->enddate) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $request->enddate))) :null;

//        dd($request->input());
        //$idsarr=explode(",",rtrim($ids,","));

        $saveSchedule = TrainingSchedule::create(
            [
                "recurring"=>$recurring,
                "startdate"=>$startdate,
                "enddate"=>$enddate,
                "days"=>$days,
                "schema_id"=>$ids,
            ]
        );
        if ($saveSchedule) {
            $updateSchema = TrainingSchema::where('id', $ids)->update(
                [
                    "status" => "complete",
                    "schema_name" => $schema_name,
                    "schema_note" => $schema_note,
                ]
            );

//            $updateSchema = UserHasSchema::where('schema_id', $ids)->update(
//                [
//                    "schema_name" => $schema_name,
//                    "schema_note" => $schema_note,
//                ]
//            );


            if ($updateSchema) {
                    Session::forget('user_ids');
                    Session::save();
                if (isset($request->printpdf)) {
                    return redirect('/admin/exercises/schema/pdf/'.$ids);
                }

                #We send notification to users which have been added to this schedule
                $users_in_schema=UserHasSchema::select('*', 'user_id as id')->where('schema_id', $ids)->get();


                #Here we save notification to intented user for whom schema was created.
                if (!empty($users_in_schema)) {
                    $users_in_schema=$users_in_schema->toArray();
                    $id_ar=array_column($users_in_schema, "id");
                    $user=User::wherein('id', $id_ar)->get();
                    $training_schema=TrainingSchema::where('id', $ids)->first();
                    if (!empty($training_schema)) {
                        $training_schema=$training_schema->toArray();
                        $training_schema=new TrainingSchemaCreated($training_schema);
                        $notification=Notification::send($user, $training_schema);
                    }
                }



                    return redirect()->back()->with('message', "Schedule Saved Successfully, You can view this schedule under predefined schedule");
            } else {
                return redirect()->back()->with('warning', "Error occurred while saving schedule, Please try again");
            }
        } else {
            return redirect()->back()->with('warning', "Error occurred while saving schedule, Please try again");
        }
    }
}
