<?php

namespace App\Http\Controllers;


use App\Company;
use App\FoodProducts;
use App\FoodProductsUnits;
use App\MealHasFoodproducts;
use App\Meals;
use App\ProductGroups;
use App\User;
use App\UserHasMeals;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Jleon\LaravelPnotify\Notify;


class FoodProductsController extends Controller
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



    public function index(Request $request,$companyid){

        $user=User::where('id',$companyid)->first();
        if(!isset($user->id) || $user->role =="user")
        {
            abort(404);
        }

        $companies=Company::select('user_id','company_name')
            ->where('parent_id',$companyid)
            ->get();



        $groups = ProductGroups::select("productgroup.id as gid","productgroup.slug as gslug","productgroup.name as gname","food_products.*")
//                ->where(['parent_id' => $parent_id])
            ->leftjoin('food_products','food_products.group_id','productgroup.id')
            ->where(['productgroup.group_type' => 'foodproducts'])
            ->where(['productgroup.user_id' => $companyid])
            ->orderBy('food_products.created_at', 'desc')->get();


        return view('admin.foodproducts.index',compact('user','companies','groups'));

    }

    public function deleteGroup(Request $request,$gid){
//        $delete=ProductGroups::where('id',$gid)->delete();
//        $delete=UserHasMeals::where('eatan_at',$gid)->delete();
//        $delete=FoodProductsUnits::where('eatan_at',$gid)->delete();


        $delete= DB::table('productgroup')
            ->leftJoin('user_has_meals', 'user_has_meals.eatan_at', '=', 'productgroup.id')
            ->leftJoin('food_producct_units', 'food_producct_units.food_product_id', '=', 'user_has_meals.food_product_id')
            ->where('productgroup.id', $gid)
            ->delete();

//        dd($delete);
        if($delete){

            Notify::success("Product Group successfully deleted");
        }else{
            Notify::error("Error occurred while deleting group");
        }
        return redirect()->back();

    }

    public function editGroup(Request $request,$gid){
        $slug = str_slug($request->groupname);
        $update=ProductGroups::where('id',$gid)->update(['name'=>$request->groupname,'slug'=>$slug]);
        if($update){
            Notify::success("Product Group successfully updated");
        }else{
            Notify::error("Error occurred while updating group");

        }
        return redirect()->back();

    }

    public  function  addGroup(Request $request , $companyid){
        $slug = str_slug($request->groupname);
        $parent_id = 0;
        $source="foodproducts";
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
                'user_id' => $companyid,
                'group_type' => $source,
            ]);


            Notify::success('Group '.$request->groupname." Successfully Added");
        }
        else
        {
            Notify::warning('Group '.$request->groupname." Exists Please Use Unique");
        }

        return redirect('admin/food-products/'.$companyid."/".$groups->id);
    }


    public function addDropGroup(Request $request , $companyid){
        $slug = str_slug($request->groupname);
        $parent_id = 0;
        $source="foodproducts_drop";
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
                'user_id' => $companyid,
                'group_type' => $source,
            ]);


            Notify::success('Group '.$request->groupname." Successfully Added");
        }
        else
        {
            Notify::info('Group '.$request->groupname." Exists Please Use Unique");
        }

        return redirect()->back();
    }


    public function addFoodProduct(Request $request,$company_id){

        $validator = $validator = Validator::make($request->all(), [
            'name' => 'required|max:250',
            'merk' => 'required|min:5|max:150',
            'category' => 'required|integer',
//            'groups' => 'required|integer',
            'synoniemen' => 'required|string',
            'path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240|dimensions:max_width=5000,max_height=3000',
        ]);




        if ($validator->passes()) {

            $slug = str_slug($request->name);
            $image=$request->path;
            if(!isset($image)){
                $name="noimage.jpeg";
            }else{
                $name = time().".".$image->getClientOriginalExtension();
                $destinationPath = public_path('/admin/images/groups/foodproducts/');
                $image->move($destinationPath, $name);
            }
            $isproducts=FoodProducts::where('slug',$slug)->where('user_id',$company_id)->first();


            if(empty($isproducts)) {
                foreach ($request->groups as $group){

                    $barcode = "Slug: " . $slug . " Name: " . $group . " Price: " . $request->price . "Tax: " . $request->tax;
                    $object=$request->input();
                    $object['price']=0;
                    $object['tax']=0;
                    $object['slug']=$slug;
                    $object['path']=$name;
                    $object['barcode']=$barcode;
                    $object['user_id']=$company_id;
                    $object['group_id']=$group;
                    unset($object['_token']);
                    unset($object['nutrtoggle']);
                    unset($object['groups']);

                    $res = FoodProducts::create($object);



                    #Save Units here



                    $amount=$request->amounts;
                    $weight=$request->foodweights;
                    $setdefault=$request->sel_default;
                    $setdefault=$setdefault - 1;
                    foreach ($request->foodunit as $key=>$units){

                        $setdefault=0;
                        if($setdefault==$key){
                            $setdefault=1;
                        }
                       $res= FoodProductsUnits::create([

                            'food_product_id'=>$res->id,
                            'foodunit'=>$units,
                            'amount'=>$amount[$key],
                            'weight'=>$weight[$key],
                            'setdefault'=>$setdefault,
                        ]);



                    }


                    $success="Success fully created";
                }


                return redirect()->back()
                    ->with([$success]);

            }else{
                $errors="Exercise with ".$request->name." Already exists try with different name";
                return redirect()->back()
                    ->withErrors([$errors])
                    ->withInput();
            }



        }
        return redirect()->back()
            ->withErrors($validator->errors())
            ->withInput();
    }


    public function editFoodProduct(Request $request,$pid,$company_id){




        $validator = $validator = Validator::make($request->all(), [
            'name' => 'required|max:250',
            'merk' => 'required|min:5|max:150',
            'category' => 'required|integer',
            'synoniemen' => 'required|string',
            'path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240|dimensions:max_width=5000,max_height=3000',
        ]);


        if ($validator->passes()) {

            $object=$request->input();
            $slug = str_slug($request->name);
            $image=$request->path;


            $getProduct=FoodProducts::where('user_id',$company_id)->first();

            if(isset($image)){

                if(strlen($getProduct->path)>0){
                    #remove old image already added
                    $destinationPath = public_path('/admin/images/groups/foodproducts/');
                    if(file_exists($destinationPath.$getProduct->path))
                    unlink($destinationPath.$getProduct->path);
                }

                $name = time().".".$image->getClientOriginalExtension();
                $destinationPath = public_path('/admin/images/groups/foodproducts/');
                $image->move($destinationPath, $name);
                $object['path']=$name;
            }





            //if(empty($isproducts)) {

                foreach ($request->groups as $group) {

                    $isproducts=FoodProducts::where('slug',$slug)
                        ->where('user_id',$company_id)
                        ->where('id','<>',$pid)
                        ->where('group_id',$group)
                        ->first();
                    if(empty($isproducts)) {

                        $check_if_alreadyadded=FoodProducts::
                            where('id',$pid)
                            ->where('group_id',$group)
                            ->first();

                        if(empty($check_if_alreadyadded)){
                            $barcode = "Slug: " . $slug . " Name: " . $group . " Price: " . $request->price . "Tax: " . $request->tax;
//                            $object=$request->input();
                            $object['price']=0;
                            $object['tax']=0;
                            $object['slug']=$slug;

                            $object['barcode']=$barcode;
                            $object['user_id']=$company_id;
                            $object['group_id']=$group;
                            unset($object['_token']);
                            unset($object['nutrtoggle']);
                            unset($object['groups']);

                            $res = FoodProducts::create($object);
                            $messagesp[]="Success fully created";
                        }else{
                            $object['price'] = 0;
                            $object['tax'] = 0;
                            $object['slug'] = $slug;
                            $object['group_id'] = $group;
                            unset($object['_token']);
                            unset($object['nutrtoggle']);
                            unset($object['groups']);
                            $res = FoodProducts::where('id', $pid)->update($object);
                            $messages[] = $slug." Success fully updated";
                        }




                    }else{
                        $messages[]= $request->name." already exists for in same group,same company";

                    }
                }

                return redirect()->back()
                    ->with($messages);

        }

        return redirect()->back()
            ->withErrors($validator->errors())
            ->withInput();
    }

    public function showProducts(Request $request,$user_id,$group_id){

        $products = ProductGroups::select("productgroup.id as gid","productgroup.slug as gslug","productgroup.name as gname","food_products.*","food_producct_units.foodunit","food_producct_units.amount","food_producct_units.weight")
//                ->where(['parent_id' => $parent_id])
            ->leftjoin('food_products','food_products.group_id','productgroup.id')
            ->leftjoin('food_producct_units','food_producct_units.food_product_id','food_products.id')
            ->where(['productgroup.group_type' => 'foodproducts'])
            ->where(['productgroup.user_id' => $user_id])
            ->where(['food_products.group_id' => $group_id])
            ->where(['food_producct_units.setdefault' => 1])
            ->orderBy('food_products.created_at', 'desc')->paginate(10);

//        dd($groups->toArray());
        $user=User::where('id',$user_id)->first();
        if(!isset($user->id) || $user->role =="user")
        {
            abort(404);
        }

        $companies=Company::select('user_id','company_name')
            ->where('parent_id',Auth::id())
            ->get();




        $users=array();

        $groups = ProductGroups::select("productgroup.id as gid","productgroup.slug as gslug","productgroup.name as gname")
//                ->where(['parent_id' => $parent_id])
//            ->leftjoin('food_products','food_products.group_id','productgroup.id')
            ->where(['productgroup.group_type' => 'foodproducts'])
            ->where(['productgroup.user_id' => $user_id])->get();
//            ->orderBy('food_products.created_at', 'desc')->get();


        $drop_groups=ProductGroups::where('group_type','foodproducts_drop')
            ->where('user_id',$user_id)->get();

//        dd($drop_groups);


        return view('admin.foodproducts.index',compact('user','companies','groups','products','drop_groups','users'));

    }


    public function nutritionTracking(Request $request,$user_id,$date){


        $user=User::where('id',$user_id)->first();




        $sec = strtotime($date);

        $date = date("Y-m-d", $sec);


        $mealsO=UserHasMeals::select('food_products.path','food_products.name as pname','food_products.kal','food_products.eiwit','food_products.eiwit','food_products.koolhydraten','food_products.vitb1','food_products.verzadigd','user_has_meals.eatan_at','food_products.id as fid','user_has_meals.id as mid','productgroup.name','food_producct_units.weight','food_producct_units.amount','food_producct_units.setdefault','food_producct_units.foodunit')
            ->leftjoin('food_products','food_products.id','user_has_meals.food_product_id')
            ->leftjoin('productgroup','productgroup.id','user_has_meals.eatan_at')
            ->leftjoin('food_producct_units','food_producct_units.food_product_id','food_products.id')
            ->where('user_has_meals.user_id',$user_id)
            ->where('food_producct_units.setdefault',1)
            ->where('user_has_meals.date','like','%'.$date.'%')
            ->get();

        $meals=array();
        foreach ($mealsO as $meal)
        {

            $meals[$meal->eatan_at]["name"]=$meal->name;
            $meals[$meal->eatan_at]["data"][]=$meal->toArray();
        }

//        echo "<pre>";
//        print_r($meals);
//        exit;

        return view('admin.foodproducts.index',compact('user','meals'));

    }


    public function deleteProduct(Request $request,$pid){

        $query_check=FoodProducts::where('id',$pid)->where('user_id',Auth::id())->first();

        if(!empty($query_check)){

            $delete=FoodProducts::where('id',$pid)->delete();
            if($delete){
                Notify::success("Product Deleted successfully");
            }else{
                Notify::error("Error occurred while deleting,please try again");
            }
        }else{
            Notify::info("Product Not found");
        }
        return redirect()->back();

    }

    public function getProduct(Request $request,$user_id,$pid){

        $groups = ProductGroups::select("productgroup.id as gid","productgroup.slug as gslug","productgroup.name as gname","food_products.*")
//                ->where(['parent_id' => $parent_id])
            ->leftjoin('food_products','food_products.group_id','productgroup.id')
            ->where(['productgroup.group_type' => 'foodproducts'])
            ->where(['productgroup.user_id' => $user_id])
            ->orderBy('food_products.created_at', 'desc')->get();
        $user=User::where('id',$user_id)->first();
        $products = ProductGroups::select("productgroup.id as gid","productgroup.slug as gslug","productgroup.name as gname","food_products.*")
            ->leftjoin('food_products','food_products.group_id','productgroup.id')
            ->where(['food_products.id' => $pid])
            ->orderBy('food_products.created_at', 'desc')->first();

        $units=FoodProductsUnits::where('food_product_id',$pid)->get();

        return view('admin.foodproducts.modal_content',compact('products','user','groups','units'));

    }


    public  function  assignMeal(Request $request,$pid=null){




        $date=Carbon::parse($request->date)->format('Y-m-d');
        $meal=UserHasMeals::create([
            'user_id'=>Auth::id(),
            'food_product_id'=>$pid,
            'date'=>$date,
            'eatan_at'=>$request->eatan_at,
            'quantity'=>$request->quantity,
            'units'=>$request->units
            ]
        );



        if($meal){
            Notify::success("Product Added successfully");
        }else{
            Notify::error("Error occurred while adding,please try again");
        }

        return redirect()->back();

    }


    public function copymeal(Request $request){


        $targetdates=array();
        $mids=rtrim($request->mids,',');
        if($request->advanced=="default"){

            $targetdates=array($request->targetdate);

        }else{


           $days=implode(",",$request->days);

            if(strlen($mids)>0){

                $startdate=$request->startdate;



                if(isset($request->enddate)){
                    $enddate=$request->enddate;
                    $targetdates=$this->getDateForSpecificDayBetweenDates($startdate,$enddate,$days);
                }
                else{
                    $weeks=$request->weeks;
                    if(strlen($weeks)>0){

                        $enddate=$request->enddate;

                       $enddate = date('Y-m-d',strtotime($startdate.' + '.$weeks.' week'));

                        $targetdates=$this->getDateForSpecificDayBetweenDates($startdate,$enddate,$days);
                    }else{
                        Notify::info("Please choose week days");
                    }

                }



            }else{
                Notify::info("Please choose days, at least one");
            }


        }


        $saved_meal=UserHasMeals::wherein('id',[$mids])->get();

        foreach ($saved_meal as $mealll){

            foreach ($targetdates as $traget){
               $create= UserHasMeals::create([
                   "food_product_id"=>$mealll->food_product_id,
                   "eatan_at"=>$mealll->eatan_at,
                   "quantity"=>$mealll->quantity,
                   "units"=>$mealll->units,
                   "user_id"=>$mealll->user_id,
                   "date"=>$traget,
               ]);
            }

        }
        if($create){
            Notify::success("Meal successfully copied");
        }

        return redirect()->back();
    }

    public function deletemeal(Request $request){
      $ids=rtrim($request->ids,",");

        $sec = strtotime($request->date);
        $datemtch = date("Y-m-d", $sec);

      //$datemtch=$request->date;


        $meal=UserHasMeals::wherein('id',[$ids])
            ->where('date','like','%'.trim($datemtch).'%')
            ->delete();


        if($meal){
            Notify::success("Meal Deleted successfully");
        }else{
            Notify::error("Error occurred while deleting,please try again");
        }
        return redirect()->back();
    }




    private function getDateForSpecificDayBetweenDates($startDate,$endDate,$day_number_comma){


//        $dates=getDateForSpecificDayBetweenDates('2018-07-01','2018-08-01','1,2');
//        print_r($dates);

        $endDate = strtotime($endDate);

        $exp=explode(",",$day_number_comma);
        $date_array=array();
        foreach($exp as $day_number){
            $days=array('1'=>'Monday','2' => 'Tuesday','3' => 'Wednesday','4'=>'Thursday','5' =>'Friday','6' => 'Saturday','7'=>'Sunday');
            for($i = strtotime($days[$day_number], strtotime($startDate)); $i <= $endDate; $i = strtotime('+1 week', $i))
                $date_array[]=date('Y-m-d',$i);
        }
        return $date_array;

    }




}
