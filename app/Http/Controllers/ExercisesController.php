<?php

namespace App\Http\Controllers;

use App\Company;
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

    /**
     * First time loading of the cells exercise with groups
     *
     */
    public  function  exerciseView(Request $request,$user_id){


       // Notify::success('The user has been created');






        //$user=Auth::id();
        $user=User::where('id',$user_id)->first();

        if($user->role=="admin"){
            $parent_id=$user_id;
        }else{
            $parent_id=$user_id;
        }

            $group = ProductGroups::where(['user_id' => $parent_id])->get();
            $productgroups = ProductGroups::select("productgroup.id as gid","productgroup.slug as gslug","productgroup.name as gname","exercises.*")
//                ->where(['parent_id' => $parent_id])
                ->leftjoin('exercises','exercises.group_id','productgroup.id')
                ->where(['productgroup.group_type' => 'exercises'])
                ->where(['productgroup.user_id' => $parent_id])
                ->orderBy('exercises.created_at', 'desc')->get();

            //$user=User::where('id',$user)->first();


//        dd( $group->toArray());




        if(!isset($user->id) || $user->role =="user")
        {
            abort(404);
        }

        $companies=Company::select('user_id','company_name')
            ->where('parent_id',Auth::id())
            ->get();
//        dd($companies->toArray());

        $products=array();

        $exerciseids=array();
        foreach($productgroups->toArray() as $product){
            $products[$product['gslug']][]=$product;
            $exerciseids[]=$product['id'];
        }

        if(count($exerciseids)>0){
            $exercisehasAttributes=ExerciseHasAttribute::wherein('exerciseid',$exerciseids)->get();
            $exercisedata=array();
            $attributes=$exercisehasAttributes->toArray();

            foreach($attributes  as $exerciseda){
                $exercisedata[$exerciseda['exerciseid']][$exerciseda['attributetype']][]= $exerciseda['attributeid'];


            }
        }

        $userfilter_info=User::select('materiallevel','traininglevel','musclegroupname','goal')->where('id',$user_id)->first();



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
            'user_has_schema.user_id')
            ->leftjoin('schema_has_exercise' ,'schema_has_exercise.schema_id','training_schema.id')
            ->leftjoin('user_has_schema' ,'user_has_schema.schema_id','schema_has_exercise.schema_id')
            ->leftjoin('exercises' ,'exercises.id','schema_has_exercise.exercise_id')
            ->leftjoin('productgroup' ,'productgroup.id','exercises.group_id')
            ->leftjoin('training_schedule' ,'training_schedule.schema_id','training_schema.id')
            ->where('training_schema.status',"complete")
            ->where('training_schema.parent_id',$user_id)
            ->groupby('training_schema.id')
            ->paginate(10);



        $exercises=TrainingSchema::select(
            'training_schema.id as schedule_id', //schema id
            'schema_has_exercise.exercise_id',
        'training_schema.parent_id',
            'schema_has_exercise.sets',
            'schema_has_exercise.reps',
            'schema_has_exercise.rust',
            'schema_has_exercise.ex_meta',
            'schema_has_exercise.priority',
            'exercises.path as imagepath',
            'exercises.name as ex_name',
            'productgroup.name as group_name',
            'schema_has_exercise.id as schemaexerciseid',
            'user_has_schema.user_id')
//            ->wherein('user_has_schema.user_id',$use)
            ->leftjoin('schema_has_exercise' ,'schema_has_exercise.schema_id','training_schema.id')
            ->leftjoin('user_has_schema' ,'user_has_schema.schema_id','schema_has_exercise.schema_id')
            ->leftjoin('exercises' ,'exercises.id','schema_has_exercise.exercise_id')
            ->leftjoin('productgroup' ,'productgroup.id','exercises.group_id')
            ->where('training_schema.status','incomplete')
            ->where('training_schema.parent_id',$user_id)
            ->whereNotNull('schema_has_exercise.exercise_id')
//                ->where('training_schema.id',$schedule_id)
            ->groupby('schema_has_exercise.exercise_id')
            ->orderby('training_schema.created_at','desc')
            ->get();





        if(count($exercises)){
            //dd($exercises->toArray());
            $schema_id=$exercises->toArray()[0]['schedule_id'];

            $usersObj=UserHasSchema::where('schema_id',$schema_id)->get();

            $user_ids=array_column($usersObj->toArray(),"user_id");
            $user_ids= array_unique($user_ids);

            $users=User::wherein('id',$user_ids)->get();
        }
        $schedule_id=isset($exercises->toArray()[0]['schedule_id']) ? $exercises->toArray()[0]['schedule_id']: "";
        return view('admin.exercises.index', compact('user','products','exercisedata','group','userfilter_info','companies','predefined_schemas','exercises','schedule_id','users'));
    }



    public  function editExerciseView(Request $request, $user_id,$schedule_id){



        //$user=Auth::id();
        $user=User::where('id',$user_id)->first();

        if($user->role=="admin"){
            $parent_id=$user_id;
        }else{
            $parent_id=$user_id;
        }

        $group = ProductGroups::where(['user_id' => $parent_id])->get();
        $productgroups = ProductGroups::select("productgroup.id as gid","productgroup.slug as gslug","productgroup.name as gname","exercises.*")
//                ->where(['parent_id' => $parent_id])
            ->leftjoin('exercises','exercises.group_id','productgroup.id')
            ->where(['productgroup.group_type' => 'exercises'])
            ->where(['productgroup.user_id' => $parent_id])
            ->orderBy('exercises.created_at', 'desc')->get();

        //$user=User::where('id',$user)->first();


//        dd( $group->toArray());




        if(!isset($user->id) || $user->role =="user")
        {
            abort(404);
        }

        $companies=Company::select('user_id','company_name')->where('parent_id',Auth::id())->get();

        $products=array();

        $exerciseids=array();
        foreach($productgroups->toArray() as $product){
            $products[$product['gslug']][]=$product;
            $exerciseids[]=$product['id'];
        }

        if(count($exerciseids)>0){
            $exercisehasAttributes=ExerciseHasAttribute::wherein('exerciseid',$exerciseids)->get();
            $exercisedata=array();
            $attributes=$exercisehasAttributes->toArray();

            foreach($attributes  as $exerciseda){
                $exercisedata[$exerciseda['exerciseid']][$exerciseda['attributetype']][]= $exerciseda['attributeid'];


            }
        }

        $userfilter_info=User::select('materiallevel','traininglevel','musclegroupname','goal')->where('id',$user_id)->first();



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
            'user_has_schema.user_id')
            ->leftjoin('schema_has_exercise' ,'schema_has_exercise.schema_id','training_schema.id')
            ->leftjoin('user_has_schema' ,'user_has_schema.schema_id','schema_has_exercise.schema_id')
            ->leftjoin('exercises' ,'exercises.id','schema_has_exercise.exercise_id')
            ->leftjoin('productgroup' ,'productgroup.id','exercises.group_id')
            ->leftjoin('training_schedule' ,'training_schedule.schema_id','training_schema.id')
            ->where('training_schema.id',$schedule_id)
            ->where('training_schema.parent_id',$user_id)
            ->groupby('training_schema.id')
            ->paginate(10);



        $exercises=TrainingSchema::select(
            'training_schema.id as schedule_id', //schema id
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
            'user_has_schema.user_id')
//            ->wherein('user_has_schema.user_id',$use)
            ->leftjoin('schema_has_exercise' ,'schema_has_exercise.schema_id','training_schema.id')
            ->leftjoin('user_has_schema' ,'user_has_schema.schema_id','schema_has_exercise.schema_id')
            ->leftjoin('exercises' ,'exercises.id','schema_has_exercise.exercise_id')
            ->leftjoin('productgroup' ,'productgroup.id','exercises.group_id')
//            ->where('training_schema.status','incomplete')
            ->where('training_schema.parent_id',$user_id)
            ->whereNotNull('schema_has_exercise.exercise_id')
                ->where('training_schema.id',$schedule_id)
            ->groupby('schema_has_exercise.exercise_id')
            ->orderby('training_schema.created_at','desc')
            ->get();


        if(!empty($exercises)){

            $user_ids=array_column($exercises->toArray(),"user_id");
            $user_ids= array_unique($user_ids);

            $users=User::wherein('id',$user_ids)->get();
        }
        $schedule_id=isset($exercises->toArray()[0]['schedule_id']) ? $exercises->toArray()[0]['schedule_id']: "";


        $schema_details=TrainingSchema::select('training_schema.schema_name','training_schema.schema_note','training_schema.id as schema_id','training_schedule.recurring','training_schedule.startdate','training_schedule.enddate','training_schedule.days')
            ->leftjoin('training_schedule','training_schema.id','training_schedule.schema_id')
            ->where('training_schema.id',$schedule_id)->first();
//        dd($schema_details->toArray());
        return view('admin.exercises.index', compact('user','products','exercisedata','group','userfilter_info','companies','predefined_schemas','exercises','schedule_id','users','schema_details'));


    }


    /*
     * Get Filtered exercise cells
     * */
    public function searchFiltterExercises(Request $request,$user_id){

        $user=User::where('id',$user_id)->first();

        if((isset($request->goal) || isset($request->musclegroupname) || isset($request->traininglevel) || isset($request->materiallevel))) // This is what i am needing.
        {
            $que=Exercise::query()
                ->select("productgroup.id as gid","productgroup.slug as gslug","exercises.*")
                ->join('productgroup','productgroup.id','exercises.group_id')
                ->join('exercise_has_attributes','exercise_has_attributes.exerciseid','exercises.id');


            if(isset($request->goal)){
                $goal=$request->goal;
                $que->where(function ($query) use ($goal) {
                    $query->where('exercise_has_attributes.attributeid', '=', $goal)
                        ->Where('exercise_has_attributes.attributetype', '=', 'musclegroup');
                });
            }

            if(isset($request->musclegroupname)) {
                $musclegroupname = $request->musclegroupname;
                $que->orwhere(function ($query) use ($musclegroupname) {
                    $query->where('exercise_has_attributes.attributeid', '=', $musclegroupname)
                        ->Where('exercise_has_attributes.attributetype', '=', 'musclegroupname');
                });
            }

            if(isset($request->traininglevel)) {
                $traininglevel=$request->traininglevel;
                $que->orwhere(function ($query) use ($traininglevel) {
                    $query->where('exercise_has_attributes.attributeid', '=', $traininglevel)
                        ->Where('exercise_has_attributes.attributetype', '=', 'traininglevel');
                });
            }
            if(isset($request->materiallevel)) {
                $materiallevel=$request->materiallevel;
                $que->orwhere(function ($query) use ($materiallevel) {
                    $query->where('exercise_has_attributes.attributeid', '=', $materiallevel)
                        ->Where('exercise_has_attributes.attributetype', '=', 'material');
                });
            }

            $que->where(['group_type' => 'exercises']);
            $que->where(['productgroup.user_id' => $user]);
            $que->orderBy('exercises.created_at', 'desc');

            $productgroups=$que->get();
        }else{
            //$user=Auth::id();
            $group = ProductGroups::where(['parent_id' => 0])->get();
            $productgroups = ProductGroups::select("productgroup.id as gid","productgroup.slug as gslug","productgroup.name as gname","exercises.*")
//                ->where(['parent_id' => 0])
                ->leftjoin('exercises','exercises.group_id','productgroup.id')
                ->where(['group_type' => 'exercises'])
                ->where(['productgroup.user_id' => $user_id])
                ->orderBy('exercises.created_at', 'desc')->get();


        }
        $products=array();
        foreach($productgroups->toArray() as $product){
            $products[$product['gslug']][]=$product;
            $exerciseids[]=$product['id'];
        }
        $exercisehasAttributes=ExerciseHasAttribute::wherein('exerciseid',$exerciseids)->get();
        $exercisedata=array();
        $attributes=$exercisehasAttributes->toArray();

        foreach($attributes  as $exerciseda){
            $exercisedata[$exerciseda['exerciseid']][$exerciseda['attributetype']][]= $exerciseda['attributeid'];
        }
        return view('admin.exercises.grid_view', compact('user','products','exercisedata','group'));
        exit;

    }

    public  function  addUserToSchema($userid,$schemaid){


        if($schemaid != "null"){

            $chek=UserHasSchema::where('user_id',$userid)->where('schema_id',$schemaid)->first();
            if(empty($chek)){
                $added=UserHasSchema::create(['user_id'=>$userid,'schema_id'=>$schemaid,'type'=>'created']);
                if($added){
                    $response=array("status"=>"success","message"=>"Schema scuccessfully updated");
                }else{
                    $response=array("status"=>"error","message"=>"Error occurred while updataing schema");
                }
                echo json_encode($response);
            }




        }
        exit;

    }
    public  function  removeUserFromSchema($userid,$schemaid){

        $delete=UserHasSchema::where('user_id',$userid)->where('schema_id',$schemaid)->delete();
        if($delete){
            $response=array("status"=>"success","message"=>"Schema scuccessfully updated");
        }else{
            $response=array("status"=>"error","message"=>"Error occurred while updataing schema");
        }
        echo json_encode($response);
        exit;

    }

    public function removeSessionUsers($id){
        $userhasschema=TrainingSchema::select('user_has_schema.id as schemaid')->leftjoin('user_has_schema','user_has_schema.schema_id','training_schema.id')
            ->where('user_has_schema.user_id',$id)
            ->where('training_schema.status','incomplete')
            ->first();
        if(!empty($userhasschema)){
            UserHasSchema::where('id',$userhasschema->schemaid)->delete();
        }
        $users=Session::get('user_ids');
        $usersexp=explode(",",$users);
        $arraynew = array_diff($usersexp,array($id));
        $userstosave=implode(",",$arraynew);
        Session::put('user_ids',$userstosave);
        Session::save();
        echo "success";
        exit;

    }


    public function loadUserSession($user_id){




        //$user=Auth::user();
        $usersar= Session::get('user_ids');


        $users= explode(",",$usersar);

        $users=User::wherein('id', $users)
            ->where('parent_id',$user_id)
            ->get();





        ob_clean();
        return view('admin.exercises.user_top_cell', compact('users'));

    }

    public function addExerciseGroup(Request $request,$user_id){

        //dd($request->input());

//        $user = Auth::user();
        $slug = str_slug($request->groupname);
        $parent_id = 0;
		$source="exercises";
        if($request->has('parent_id')){
            $parent_id = $request->parent_id;
            $groupExists = ProductGroups::where(['name' => $request->groupname])->where(['parent_id' => $parent_id])->where(['group_type' => $source])->count();
        }
        else
        {
        	$groupExists = ProductGroups::where(['name' => $request->groupname])->where(['parent_id' => 0])->where(['group_type' => $source])->count();
        }
        if(!$groupExists)
        {
       			 $groups = ProductGroups::create([
            			'name' => $request->groupname,
            			'slug' => $slug,
            			'parent_id' => $parent_id,
            			'imagepath' => 'noimage.jpeg',
            			'user_id' => $user_id,
            			'group_type' => $source,
        			]);


        			Session::flash('alert-success', 'Group '.$request->groupname." Successfully Added");
		}
		else
		{
			Session::flash('alert-warning', 'Group '.$request->groupname." Exists Please Use Unique");
		}

        return redirect()->back();
    }

    public  function updateExerciseGroup(Request $request,$gid){


        $groupExists = ProductGroups::where(['name' => $request->groupname])->count();
        if(!$groupExists){
            $slug = str_slug($request->groupname);
            $groups = ProductGroups::where('id',$gid)->update([
                'name' => $request->groupname,
                'slug' => $slug,
            ]);


//            Session::flash('alert-success', 'Group '.$request->groupname." Successfully Updated");
            Notify::success('Group '.$request->groupname." Successfully Updated");
        }else{
//            Session::flash('alert-warning', 'Group '.$request->groupname." Exists Please Use Unique");
            Notify::error('Group '.$request->groupname." Exists Please Use Unique");
        }

        return redirect()->back();

    }




    public function addExercise(Request $request,$user_id){
        $products=array();
        //$user = Auth::user();



        //foreach($request->file('imagefile') as $key=>$image)
       // {
           $slug = str_slug($request->productname);
           $image=$request->imagefile;
            if(!isset($image)){
                $name="noimage.jpeg";
            }else{
                $name = time().".".$image->getClientOriginalExtension();
                $destinationPath = public_path('/admin/images/groups/exercises/');
                $image->move($destinationPath, $name);
            }



           $productsss=Exercise::where('slug',$slug)->first();


            if(empty($productsss)) {

                foreach ($request->group_id as $gid) {
                    $barcode = "Slug: " . $slug . " Name: " . $gid . " Price: " . $request->price . "Tax: " . $request->tax;


                    $res = Exercise::create([
                        'name' => $request->productname,
                        'price' => $request->price,
                        'tax' => $request->tax,
                        'slug' => $slug,
                        'user_id' => $user_id,
                        'barcode' => $barcode,
                        'type' => 'image',
                        'group_id' => $gid,
                        'group_priority' => $request->group_priority,
                        'path' => $name
                    ]
                );


                if (isset($request->goal))
                    foreach ($request->goal as $attr) {
                        ExerciseHasAttribute::create(
                            ['exerciseid' => $res->id, 'attributeid' => $attr, 'attributetype' => 'goal']);
                    }
                if (isset($request->traininglevel))
                    foreach ($request->traininglevel as $attr) {
                        ExerciseHasAttribute::create(
                            ['exerciseid' => $res->id, 'attributeid' => $attr, 'attributetype' => 'traininglevel']);
                    }
                if (isset($request->musclegroup))
                    foreach ($request->musclegroup as $attr) {
                        ExerciseHasAttribute::create(
                            ['exerciseid' => $res->id, 'attributeid' => $attr, 'attributetype' => 'musclegroup']);
                    }
                if (isset($request->material))
                    foreach ($request->material as $attr) {
                        ExerciseHasAttribute::create(
                            ['exerciseid' => $res->id, 'attributeid' => $attr, 'attributetype' => 'material']);
                    }

                $errors = "Exercise  " . $request->productname . " successfully created";
            }

            }else{
                $errors="Exercise with ".$request->productname." Already exists try with different name";
            }

       // }
        Notify::success($errors);
       return redirect()->back()->with('message',  $errors);
        //return redirect()->back();


    }

    public function editExercise(Request $request,$exid){

        //foreach($request->file('imagefile') as $key=>$image)
        {


            $user=Auth::id();
            $story=Exercise::where('id',$exid)->first();
            $image=$request->imagefile;
            $slug = str_slug($request->productname);

            if(isset( $image)){
                if ($story->imagepath) {
                    @unlink(get_product_imge_path($story->imagepath));
                }
                $name = time().".".$image->getClientOriginalExtension();
                $destinationPath = public_path('/admin/images/groups/exercises/');
                $image->move($destinationPath, $name);

                foreach($request->group_id as $grp){

                    $re=Exercise::where('id',$exid)->where('group_id',$grp)->first();
                    $barcode = "Slug: " . $slug . " Name: " . $grp . " Price: " . $request->price . "Tax: " . $request->tax;
                    if(!empty($re)) {
                        $res = Exercise::where('id', $exid)->update(
                            [
                                'name' => $request->productname,
                                'price' => $request->price,
                                'tax' => $request->tax,
                                'group_priority' => $request->group_priority,
                                'group_id' => $grp,
                                'path' => $name
                            ]);
                    }else{
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
                            ]);
                    }
                }

            }else{
//                $res=Exercise::where('id',$exid)->update([
//                        'name' => $request->productname,
//                        'price' => $request->price,
//                        'tax' => $request->tax,
//                        'group_priority' => $request->group_priority,
//
//                    ]
//                );
                foreach($request->group_id as $grp) {


                    $barcode = "Slug: " . $slug . " Name: " . $grp . " Price: " . $request->price . "Tax: " . $request->tax;
                    $re=Exercise::where('id',$exid)->where('group_id',$grp)->first();
                      if(!empty($re)){
                       $res = Exercise::where('id', $exid)->update(
                           [
                               'name' => $request->productname,
                               'price' => $request->price,
                               'tax' => $request->tax,
                               'group_priority' => $request->group_priority,
                               'group_id' => $grp,
                           ]);
                       }else{
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

                              ]);
                      }

                }

            }




        }



        if(isset($request->goal)){
            echo $exid;
            ExerciseHasAttribute::where('exerciseid',$exid)->wherein('attributeid',$request->goal)->delete();
            foreach($request->goal as $attr){
                ExerciseHasAttribute::create(
                    ['exerciseid'=>$exid,'attributeid'=>$attr,'attributetype'=>'goal']);
            }
        }

        if(isset($request->traininglevel)){
            ExerciseHasAttribute::where('exerciseid',$exid)->wherein('attributeid',$request->traininglevel)->delete();
            foreach($request->traininglevel as $attr){
                ExerciseHasAttribute::create(
                    ['exerciseid'=>$exid,'attributeid'=>$attr,'attributetype'=>'traininglevel']);
            }
        }

        if(isset($request->musclegroup)){
            ExerciseHasAttribute::where('exerciseid',$exid)->wherein('attributeid',$request->musclegroup)->delete();
            foreach($request->musclegroup as $attr){
                ExerciseHasAttribute::create(
                    ['exerciseid'=>$exid,'attributeid'=>$attr,'attributetype'=>'musclegroup']);
            }
        }

        if(isset($request->material)){
            ExerciseHasAttribute::where('exerciseid',$exid)->wherein('attributeid',$request->material)->delete();
            foreach($request->material as $attr){
                ExerciseHasAttribute::create(
                    ['exerciseid'=>$exid,'attributeid'=>$attr,'attributetype'=>'material']);
            }
        }


        return redirect()->back()->with('message',  "Exercise  Updated Successfully");


    }



    public function deleteExercise($id){
        $story = Exercise::find($id);
        if (count($story)) {
            if ($story->imagepath) {
                @unlink(get_product_imge_path($story->imagepath));
            }

            $story->delete();
            Notify::success('Exercise deleted successfully.');
//            return redirect()->back()->with('message', 'Exercise deleted successfully.');
        } else {
            Notify::info('Exercise not found !');
//            return redirect()->back()->with('exception', 'Exercise not found !');
        }

        return redirect()->back();
    }


    public function  searchUser($user_id,$keyword){
        $users=User::where('name', 'like', '%'.$keyword.'%')
            ->where('parent_id',$user_id)
            ->get();
        ob_clean();
        return view('admin.exercises.search_user_response', compact('users'));

    }



    public  function  createschedule($uids=null,$exerciseid=null,$scheduleid=null){



        $uids=rtrim($uids,",");

        $str=str_replace("p_","",$exerciseid);
        $explode=explode("_",$str);
        $exerciseid=$explode[0];
        $user=$explode[1];


        if($uids !="null"){
            $uids=str_replace("null,","",$uids);
            $userids=explode(",",$uids);
        }else{
            #This schedule will be saved for admin itself

            $check_role=User::where('id',$user)->first();

            if($check_role->role=="admin")
            $userids=array(Auth::id());
            else if($check_role->role=="company")
                $userids=array($user);

        }



        try{


        $exercise=Exercise::select('productgroup.name as gname','productgroup.id as gid','exercises.*')
            ->join('productgroup','productgroup.id','exercises.group_id')
            ->where('exercises.user_id',$user)
            ->where('exercises.id',$exerciseid)
            ->first();

        if(!empty($exercise)){
            if($exercise->price>0){
                $response=array("status"=>"error","message"=>"Exercise is not free");
                return $response;
            }
            $gpriority=$exercise->group_priority;
        }

        if($scheduleid=="null"){

            $schedulePresent=TrainingSchema::select('training_schema.status','training_schema.id','user_has_schema.user_id')
                ->leftjoin('user_has_schema','user_has_schema.schema_id','training_schema.id')
                ->wherein('user_has_schema.user_id',$userids)
                ->where('training_schema.status','incomplete')
                ->get();
        }else{
            $schedulePresent=TrainingSchema::select('training_schema.status','training_schema.id','user_has_schema.user_id')
                ->leftjoin('user_has_schema','user_has_schema.schema_id','training_schema.id')
                ->where('training_schema.id',$scheduleid)
                ->get();
        }









        if(count($schedulePresent)==0){

            #save schema
            $schema=TrainingSchema::create([
                'parent_id'=>$user,
                'status'=>'incomplete']
            );

            #Save exercise in Schema has exercise
            if($schema){
                $createrelation=SchemaHasExercises::create([

                    'schema_id'=>$schema->id,
                    'exercise_id'=>$exerciseid,
                    'sets'=>0,
                    'reps'=>0,
                    'rust'=>0,
                    'priority'=>$gpriority]);


                if($createrelation){
                    #save user has schema
                    foreach($userids as $user){
                        $createrelation=UserHasSchema::create([

                            'user_id'=>$user,
                            'schema_id'=>$schema->id,
                            'type'=>'created',]);
                    }
                    $response[]=array("status"=>"success","message"=>"Exercise Schedule created and exercise added", "schedule_id"=>$schema->id,"userid"=>implode(",",$userids));

                }
                else{
                    $response[]=array("status"=>"error","message"=>"User Has schema updation error");
                    return $response;
                }
            }else{
                $response[]=array("status"=>"error","message"=>"Schema Creation error");
                return $response;
            }






        }else{
            $schemaid=$schedulePresent[0]['id'];
            $userids=implode(",",array_column($schedulePresent->toArray(),"user_id"));

            #add new exercise if not presant

            $checkifexercisealreadyadded=SchemaHasExercises::where('schema_id',$schemaid)
                ->where('exercise_id',$exerciseid)
                ->first();
            if(empty($checkifexercisealreadyadded)){

                $createrelation=SchemaHasExercises::create([

                    'schema_id'=>$schemaid,
                    'exercise_id'=>$exerciseid,
                    'sets'=>0,
                    'reps'=>0,
                    'rust'=>0,
                    'priority'=>$gpriority]);

                if($createrelation){

                    $response[]=array("status"=>"success","message"=>"Exercise Added to the schedule", "schedule_id"=>$schemaid,"userid"=>$userids);
                }else{
                    $response[]=array("status"=>"error","message"=>"Exercise was not added, due to some error");

                }
            }
            else{
                $response[]=array("status"=>"error","message"=>"Exercise already added in schedule","schedule_id"=>$schemaid,"userid"=>$userids);

            }



        }

       }
        catch (Exception $exception){
            $response[]=array("status"=>"error","message"=>"Exception: ".$exception->getMessage());
       }

      echo json_encode( $response);
      exit;

    }


    function addpredefinedchedule($userids=null,$schedul_id=null){

        $usersarr=explode(",",rtrim($userids,","));

        $schedulid=str_replace("scheduleid_","",$schedul_id);
        $usersobj=User::select('name','id')->get();
        $users=array();
        foreach($usersobj as $user)
        {
            $users[$user->id]=$user->name;
        }
        foreach($usersarr as $usid){

            $sch=UserHasSchema::where('user_id',$usid)->where('schema_id',$schedulid)->first();
            if(empty($sch)){
                $assign=UserHasSchema::where('schema_id',$schedulid)->create(
                    [
                        'user_id'=>$usid,
                        'schema_id'=>$schedulid,
                    ]
                );

                if( $assign){
                    $response[]=array("status"=>"success","message"=>"Schema added successfully to user ".$users[$usid],"schedule_id"=>$schedulid,"userid"=>$userids);
                }else{
                    $response[]=array("status"=>"error","message"=>"Some error occurred while assigning schedule");

                }


            }else{
                $response[]=array("status"=>"error","message"=>"Schedule already assigned to this user ".$users[$usid],"schedule_id"=>$schedulid,"userid"=>$userids);

            }

        }
        echo json_encode($response);
        exit;
    }




    public  function getorderdetails($orderid){

        $order=UserOrders::select('user_has_products.price','user_has_products.name')->leftjoin('user_has_products','user_has_products.orderid','user_orders.id')->where('id',$orderid)->get();
        return view('admin.updatecart', compact('order'));
    }

    public  function showAddedExercises($userids,$company_id,$schedule_id="null"){

        $userids=rtrim($userids,",");
        if($userids =="null"){
            $use=array($company_id);
        }else{
            $use=explode(",",$userids);
        }


        if($schedule_id=="null") {

            $exercises = TrainingSchema::select(
                'training_schema.id as schedule_id', //schema id
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
                'user_has_schema.user_id')
//            ->wherein('user_has_schema.user_id',$use)
                ->leftjoin('schema_has_exercise', 'schema_has_exercise.schema_id', 'training_schema.id')
                ->leftjoin('user_has_schema', 'user_has_schema.schema_id', 'schema_has_exercise.schema_id')
                ->leftjoin('exercises', 'exercises.id', 'schema_has_exercise.exercise_id')
                ->leftjoin('productgroup', 'productgroup.id', 'exercises.group_id')
                ->where('training_schema.status', 'incomplete')
                ->where('training_schema.parent_id', $company_id)
                ->whereNotNull('schema_has_exercise.exercise_id')
//                ->where('training_schema.id',$schedule_id)
                ->groupby('schema_has_exercise.exercise_id')
                ->orderby('training_schema.created_at', 'desc')
                ->get();

        }else{
            $exercises = TrainingSchema::select(
                'training_schema.id as schedule_id', //schema id
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
                'user_has_schema.user_id')
//            ->wherein('user_has_schema.user_id',$use)
                ->leftjoin('schema_has_exercise', 'schema_has_exercise.schema_id', 'training_schema.id')
                ->leftjoin('user_has_schema', 'user_has_schema.schema_id', 'schema_has_exercise.schema_id')
                ->leftjoin('exercises', 'exercises.id', 'schema_has_exercise.exercise_id')
                ->leftjoin('productgroup', 'productgroup.id', 'exercises.group_id')
//                ->where('training_schema.status', 'incomplete')
                ->where('training_schema.parent_id', $company_id)
                ->whereNotNull('schema_has_exercise.exercise_id')
                ->where('training_schema.id',$schedule_id)
                ->groupby('schema_has_exercise.exercise_id')
                ->orderby('training_schema.created_at', 'desc')
                ->get();
        }

//        dd($exercises->toArray());

        return view('admin.exercises.show_added_exercises', compact('exercises'));
    }

    public  function  loadPredefinedSchema(Request $request,$user_id){

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
            'user_has_schema.user_id')
            ->leftjoin('schema_has_exercise' ,'schema_has_exercise.schema_id','training_schema.id')
            ->leftjoin('user_has_schema' ,'user_has_schema.schema_id','schema_has_exercise.schema_id')
            ->leftjoin('exercises' ,'exercises.id','schema_has_exercise.exercise_id')
            ->leftjoin('productgroup' ,'productgroup.id','exercises.group_id')
            ->leftjoin('training_schedule' ,'training_schedule.schema_id','training_schema.id')
            ->where('training_schema.status',"complete")
            ->where('training_schema.parent_id',$user_id)
            ->groupby('training_schema.id')
            ->paginate(1);



//        dd($predefined_schemas->toArray());
        return view('admin.exercises.predefined_view',compact('predefined_schemas'));
    }

    public  function  loadPredefinedSchemaFilter(Request $request,$keyword=null){

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
            'user_has_schema.user_id')
            ->leftjoin('schema_has_exercise' ,'schema_has_exercise.schema_id','training_schema.id')
            ->leftjoin('user_has_schema' ,'user_has_schema.schema_id','schema_has_exercise.schema_id')
            ->leftjoin('exercises' ,'exercises.id','schema_has_exercise.exercise_id')
            ->leftjoin('productgroup' ,'productgroup.id','exercises.group_id')
            ->leftjoin('training_schedule' ,'training_schedule.schema_id','training_schema.id')
            ->leftjoin('users' ,'users.id','user_has_schema.user_id')
            ->where('training_schema.status',"complete")
            ->where('training_schema.parent_id',Auth::id())
            ->where('training_schema.schema_name' , 'like', '%'.$keyword.'%')
            ->orwhere('exercises.name' , 'like', '%'.$keyword.'%')
            ->orwhere('users.name' , 'like', '%'.$keyword.'%')
            ->orwhere('training_schedule.startdate' , 'like', '%'.$keyword.'%')
            ->orwhere('training_schedule.enddate' , 'like', '%'.$keyword.'%')
            ->groupby('training_schema.id')
            ->get();
        return view('admin.exercises.predefined_view',compact('predefined_schemas'));
    }



    public function loadDropableArea($calendar_id=null,$schedule_id){

        if($schedule_id=="null"){
            $exercises=TrainingSchema::select(
                'training_schema.id as schedule_id', //schema id
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
                'user_has_schema.user_id')
//            ->wherein('user_has_schema.user_id',$use)
                ->leftjoin('schema_has_exercise' ,'schema_has_exercise.schema_id','training_schema.id')
                ->leftjoin('user_has_schema' ,'user_has_schema.schema_id','schema_has_exercise.schema_id')
                ->leftjoin('exercises' ,'exercises.id','schema_has_exercise.exercise_id')
                ->leftjoin('productgroup' ,'productgroup.id','exercises.group_id')
                ->where('training_schema.status','incomplete')
                ->where('training_schema.parent_id',$calendar_id)
                ->whereNotNull('schema_has_exercise.exercise_id')
//                ->where('training_schema.id',$schedule_id)
            ->groupby('schema_has_exercise.exercise_id')
                ->orderby('training_schema.created_at','desc')
                ->get();
        }else{
            $exercises=TrainingSchema::select(
                'training_schema.id as schedule_id', //schema id
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
                'user_has_schema.user_id')
//            ->wherein('user_has_schema.user_id',$use)
                ->leftjoin('schema_has_exercise' ,'schema_has_exercise.schema_id','training_schema.id')
                ->leftjoin('user_has_schema' ,'user_has_schema.schema_id','schema_has_exercise.schema_id')
                ->leftjoin('exercises' ,'exercises.id','schema_has_exercise.exercise_id')
                ->leftjoin('productgroup' ,'productgroup.id','exercises.group_id')
//                ->where('training_schema.status','complete')
                ->where('training_schema.parent_id',$calendar_id)
                ->where('training_schema.id',$schedule_id)
            ->groupby('schema_has_exercise.exercise_id')
                ->orderby('training_schema.created_at','desc')
                ->get();
        }

//        echo $status."<br>";
//        echo  $calendar_id."<br>";
//        echo  $schedule_id."<br>";


        if(!empty($exercises)){

            $user_ids=array_column($exercises->toArray(),"user_id");
            $user_ids= array_unique($user_ids);

            $users=User::wherein('id',$user_ids)->get();
        }





        $schedule_id=isset($exercises->toArray()[0]['schedule_id']) ? $exercises->toArray()[0]['schedule_id']: "";

//
//        echo "<pre>";
//        print_r($exercises->toArray());
//        echo "</pre>";
////
////
//        exit;
        return view('admin.exercises.droparea',compact('users','exercises','schedule_id'));
    }



    public  function  loadAddedSchema($userids=null,$exercise_id){

        $useridsar=explode(",",rtrim($userids,","));
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
            'user_has_schema.user_id')
            ->leftjoin('schema_has_exercise' ,'schema_has_exercise.schema_id','training_schema.id')
            ->leftjoin('user_has_schema' ,'user_has_schema.schema_id','schema_has_exercise.schema_id')
            ->leftjoin('exercises' ,'exercises.id','schema_has_exercise.exercise_id')
            ->leftjoin('productgroup' ,'productgroup.id','exercises.group_id')
            ->leftjoin('training_schedule' ,'training_schedule.schema_id','training_schema.id')
            ->where('training_schema.status',"complete")
            ->wherein('user_has_schema.user_id',$useridsar)
            ->where('training_schema.parent_id',$exercise_id)
            ->groupby('training_schema.id')
            ->get();

        return view('admin.exercises.show_added_schedules',compact('predefined_schemas'));
    }


    public function  deleteAddedSchema($schemaid=null){
        $delete=UserHasSchema::where('schema_id',$schemaid)->delete();
        if($delete){
            return redirect()->back()->with('message', 'Schema deleted successfully.');
        } else {
            return redirect()->back()->with('exception', 'Schema not found !');
        }
    }

    public function showTrainingSchemaPdf($schemaid=null){
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
            ->leftjoin('schema_has_exercise' ,'schema_has_exercise.schema_id','training_schema.id')
            ->leftjoin('user_has_schema' ,'user_has_schema.schema_id','schema_has_exercise.schema_id')
            ->leftjoin('exercises' ,'exercises.id','schema_has_exercise.exercise_id')
            ->leftjoin('productgroup' ,'productgroup.id','exercises.group_id')
            ->leftjoin('training_schedule' ,'training_schedule.schema_id','training_schema.id')
            ->leftjoin('companies' ,'companies.user_id','training_schema.parent_id')
            ->leftjoin('users' ,'user_has_schema.user_id','users.id')
            ->where('training_schema.id',$schemaid)
            ->groupby('schema_has_exercise.id')
            ->get();



        $users=TrainingSchema::select(
            'user_has_schema.user_id',
            'users.name'
        )
            ->leftjoin('schema_has_exercise' ,'schema_has_exercise.schema_id','training_schema.id')
            ->leftjoin('user_has_schema' ,'user_has_schema.schema_id','schema_has_exercise.schema_id')
            ->leftjoin('users' ,'user_has_schema.user_id','users.id')
            ->where('training_schema.id',$schemaid)
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
        return view('admin.exercises.schema_pdf',compact('schemas','users'));

    }

    public  function loadPredefinedSchemaExercises($scheduleid=null){


        $predefined_schema=TrainingSchema::select( 'exercises.path as imagepath','exercises.name','schema_has_exercise.sets','schema_has_exercise.reps','schema_has_exercise.rust')
            ->leftjoin('schema_has_exercise' ,'schema_has_exercise.schema_id','training_schema.id')
            ->leftjoin('exercises' ,'exercises.id','schema_has_exercise.exercise_id')
//            ->where('training_schema.parent_id',Auth::id())
            ->where('training_schema.id',$scheduleid)
            ->get();
        return view('admin.exercises.carossel_view',compact('predefined_schema'));
    }

    public function editTrainingSchema(Request $request,$scheduleid){



        $create=SchemaHasExercises::where('id',$scheduleid)->update([
            'sets'=>$request->sets,
            'reps'=>$request->reps,
            'rust'=>$request->rust,
            'ex_meta'=>$request->ex_meta,
            'ex_name'=>$request->productname,
        ]);


        if( $create){

            Notify::success("Exercise  Updated Successfully");

//            return redirect()->back()->with('message',  "Exercise  Updated Successfully");
        }else{
            Notify::info("Schedule Not found");
//            return redirect()->back()->with('warning',  "Schedule Not found");
        }
        return redirect()->back();

    }

    public function deleteTrainingExercise(Request $request,$scheduleid){

        $deleted=SchemaHasExercises::where('id',$scheduleid)->delete();
        if( $deleted){
            Notify::success("Exercise  Deleted Successfully");
//            return redirect()->back()->with('message',  "Exercise  Deleted Successfully");
        }else{
            Notify::success("Schedule Not found");
//            return redirect()->back()->with('warning',  "Schedule Not found");
        }
        return redirect()->back();

    }


    public function deleteSchedule(Request $request,$id){

//        $schids=explode(",",rtrim($ids,","));
        $traingsscheule=TrainingSchema::where('id',$id)->delete();
        $create=UserHasSchema::where('schema_id',$id)->delete();
        $create=SchemaHasExercises::where('schema_id',$id)->delete();
        if($create){
            Session::forget('user_ids');
            Session::save();

            Notify::success("Trainig Schedule Deleted Successfully");

//            return redirect()->back()->with('message',  "Trainig Schedule Deleted Successfully");
        }else{
            Notify::info("Schedule Not found");
//            return redirect()->back()->with('warning',  "Schedule Not found");
        }
        return redirect()->back();

    }

    public  function  saveSchedule(Request $request,$ids){


            $recurring=isset($request->recurring) ? "yes":"no";


            $days=isset($request->days) ? implode(",",$request->days):"";
            $schema_name=$request->schema_name;
            $schema_note=$request->schema_note;
            $startdate=isset($request->startdate) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $request->startdate) )) : null;
//            $enddate=isset($request->enddate) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $request->enddate))) :null;

            $weeks=$request->weeks;


           echo  $enddate = date('Y-m-d H:i:s',strtotime($startdate.' + '.$weeks.' week'));

           echo  $duration=round(abs(strtotime($enddate) - strtotime($startdate)) / 60,2)." minute";

           echo  $rrule="FREQ=WEEKLY;INTERVAL=".$weeks.";BYDAY=".$days;
           
//        dd($request->input());
        //$idsarr=explode(",",rtrim($ids,","));

        $check_if_schedule_is_presant=TrainingSchedule::where('schema_id',$ids)->first();

        if(empty($check_if_schedule_is_presant)){
            $saveSchedule = TrainingSchedule::create(
                [
                    "recurring"=>$recurring,
                    "startdate"=>$startdate,
                    "enddate"=>$enddate,
                    "weeks"=>$weeks,
                    "duration"=>$duration,
                    "days"=>$days,
                    "rrule"=>$rrule,
                    "schema_id"=>$ids,
                ]
            );
        }else{
            $saveSchedule = TrainingSchedule::where("schema_id",$ids)->update(
                [
                    "recurring"=>$recurring,
                    "startdate"=>$startdate,
                    "weeks"=>$weeks,
                    "duration"=>$duration,
                    "enddate"=>$enddate,
                    "rrule"=>$rrule,
                    "days"=>$days,

                ]
            );


        }

        if($saveSchedule) {
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
                $users_in_schema=UserHasSchema::select('*','user_id as id')->where('schema_id',$ids)->get();


                #Here we save notification to intented user for whom schema was created.
                if(!empty($users_in_schema)){
                    $users_in_schema=$users_in_schema->toArray();
                    $id_ar=array_column($users_in_schema,"id");
                    $user=User::wherein('id',$id_ar)->get();
                    $training_schema=TrainingSchema::where('id',$ids)->first();
                    if(!empty($training_schema)){
                        $training_schema=$training_schema->toArray();
                        $training_schema=new TrainingSchemaCreated($training_schema);
                        $notification=Notification::send($user, $training_schema);

                    }


                }



                Notify::success("Schedule Saved Successfully, You can view this schedule under predefined schedule");
//                    return redirect()->back()->with('message',  "Schedule Saved Successfully, You can view this schedule under predefined schedule");

            }else{
                Notify::error("Error occurred while saving schedule, Please try again");
//                return redirect()->back()->with('warning',  "Error occurred while saving schedule, Please try again");
            }

        }else{
            Notify::error("Error occurred while saving schedule, Please try again");
//            return redirect()->back()->with('warning',  "Error occurred while saving schedule, Please try again");
        }
        return redirect()->back();


    }

    public function  deletePredefinedSchema(Request $request,$schid){


        $delete=TrainingSchema::where('id',$schid)->delete();
        $delete=TrainingSchedule::where('schema_id',$schid)->delete();
        $delete=UserHasSchema::where('schema_id',$schid)->delete();
        if($delete){
            Notify::success("Schema Deleted Successfully");
//            return redirect()->back()->with('message',  "Schema Deleted Successfully");
        }
        else
            {
                Notify::error("Error occurred while deleting schedule, Please try again");
//            return redirect()->back()->with('warning',  "Error occurred while deleting schedule, Please try again");
        }
        return redirect()->back();
    }


}
