<?php

namespace App\Http\Controllers;

use App\ProductGroups;
use App\ProductMedias;
use App\Transaction;
use App\Transactions;
use App\User;
use App\UserHasProducts;
use App\UserOrders;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\CountValidator\Exception;

class ProductsController extends Controller
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
     * Product groups
     * 
     * @return view
    */
	public function productogroups()
    {

        $user = Auth::user();
        $productgroups = ProductGroups::where(['parent_id' => 0])->where('group_type', 'products')->orderBy('created_at', 'desc')->paginate();

        $user = Auth::user();
        $userid =Auth::id();


            $products = ProductMedias::select('*', DB::raw('count(*) as total'))->where('user_id', $userid)->whereNull('group_id')->orderBy('created_at', 'desc')->groupby('category')->get();
            $variationso = ProductMedias::whereNull('group_id')->where('user_id', $userid)->orderBy('created_at', 'desc')->get();

        $variations=array();
        foreach ($variationso->toArray() as $variation) {
            $variations[$variation['category']][]=$variation;
        }

        $orders=$this->getTodayPrders();


//        echo "<pre>";
//        print_r( $variations);
//        dd($products->toArray());

        return view('admin.products.index', compact('user', 'productgroups', 'variations', 'products', 'orders', 'user'));
    }

    /**
     * Get today's product order
     * 
     * @return array
    */
	public function getTodayPrders()
    {
        $dt = Carbon::now();         // bool(true) => uses     __toString()
        $today=$dt->toDateString();

        $ordersobj=UserOrders::select('user_has_products.productid', 'user_has_products.quantity', DB::raw('SUM(user_has_products.quantity) as total'))
            ->leftjoin('user_has_products', 'user_has_products.orderid', 'user_orders.id')
            ->where('user_orders.updated_at', 'like', '%'.$today.'%')
            ->where('user_orders.status', 'paid')
            ->groupby('user_has_products.productid')
            ->get();
        $orders=array();
        foreach ($ordersobj as $order) {
            $orders[$order->productid]=$order->total;
        }
        return $orders;
    }

	/**
     * View Orders
     * 
     * @param Request $request
     * @return array
    */
    public function viewOrders(Request $request)
    {
        $query="";
        $orders="";
        if ($request->isMethod('post')) {
           // echo "<pre>";
           // print_r($_REQUEST);
                $keyword = $request->keyword;
                $query = UserOrders::query()
                    ->select('user_orders.*', 'users.name', DB::raw('count(*) as quantity'))
                    ->leftjoin('users', 'user_orders.userid', 'users.id')
                    ->leftjoin('user_has_products', 'user_has_products.orderid', 'user_orders.id')
                    ->where('user_has_products.orderid', '%' . $keyword . '%')
                    ->orwhere('users.name', 'like', '%' . $keyword . '%')
                    ->orwhere('users.id', 'like', '%' . $keyword . '%')
                    ->orwhere('user_orders.updated_at', 'like', '%' . $keyword . '%')
                    ->orwhere('user_orders.status', 'like', '%' . $keyword . '%')
                    ->orwhere('user_orders.userid', 'like', '%' . $keyword . '%');

            if (isset($request->startdate)) {
                $startdate = $request->startdate;
                $enddate = $request->enddate;
                $query->where('user_orders.updated_at', '>=', $startdate);
                $query->where('user_orders.updated_at', '<=', $enddate);
            }
                $query ->groupby('user_orders.id');


            $query->paginate(10);
        } else {
            $query=UserOrders::select('user_orders.*', 'users.name', DB::raw('count(*) as quantity'))
                ->where('status', 'paid')
                ->leftjoin('users', 'user_orders.userid', 'users.id')
                ->leftjoin('user_has_products', 'user_has_products.orderid', 'user_orders.id')
                ->groupby('user_orders.id');
        }

//        dd( $query->get()->toArray());
        $orders=$query->paginate(10);


        return view('admin.products.vieworders', compact('orders'));
    }

    public function loaduserlastaccessed()
    {

        $userid=Session::get('userid_products');

        $user=User::where('id', $userid)->first();
        return view('admin.products.authusercell', compact('user'))->with('userid', $userid);
    }

    public function addProductGroup(Request $request)
    {



        $user = Auth::user();
        $slug = str_slug($request->groupname);
        $parent_id = 0;

        if ($request->has('parent_id')) {
            $parent_id = $request->parent_id;
        }
        $is_presant=ProductGroups::where('slug', $slug)->first();
        if (empty($is_presant)) {
            $groups = ProductGroups::create([
                'name' => $request->groupname,
                'slug' => $slug,
                'parent_id' => $parent_id,
                'imagepath' => 'noimage.jpeg',
                'user_id' => $user->id,
            ]);
            Session::flash('alert-success', "Product Group ".$request->groupname." Created Successfully");
        } else {
            Session::flash('alert-warning', "Product Group  ".$request->groupname." already exists");
        }

        return redirect()->back();
    }

    public function groups($groupslug)
    {

        $user = Auth::user();
        $group = ProductGroups::where(['slug' => $groupslug])->first();
        $variations=array();
        $products=array();
        $productgroups=array();
        if (!empty($group)) {
            $productgroups = ProductGroups::where(['parent_id' => $group->id ])->orderBy('created_at', 'desc')->get();
            $user = Auth::user();
            if (isset($user)) {
                $products = ProductMedias::select('*', DB::raw('count(*) as total'))->where(['group_id' => $group->id ])->groupby('category')->orderBy('created_at', 'desc')->get();
                $variationso = ProductMedias::where(['group_id' => $group->id ])->orderBy('created_at', 'desc')->get();

                //$products = ProductMedias::where(['group_id' => $group->id ])->orderBy('created_at', 'desc')->get();
            } else {
                $variationso = ProductMedias::where(['group_id' => $group->id ])->orderBy('created_at', 'desc')->get();
                $products = ProductMedias::select('*', DB::raw('count(*) as total'))->where(['group_id' => $group->id ])->groupby('category')->orderBy('created_at', 'desc')->get();

                // $products = ProductMedias::where(['group_id' => $group->id])->orderBy('created_at', 'desc')->get();
            }
            $variations=array();
            foreach ($variationso->toArray() as $variation) {
                $variations[$variation['category']][]=$variation;
            }
            return view('admin.products.index', compact('productgroups', 'group', 'products', 'variations', 'user'));
        } else {
            echo "Sorry, the page you are looking for could not be found.";
        }
    }




    public function addProduct(Request $request)
    {
        $products=array();
        $user = Auth::user();
        foreach ($request->file('imagefile') as $key => $image) {
            $slug = str_slug($_REQUEST['productname'][$key]);
            $carbon = new Carbon();
            $cat="product_".$carbon->now();
            $name = time().$key.'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/public/admin/images/groups/products/');

            $image->move($destinationPath, $name);
            if ($_REQUEST['stocktype'][$key]) {
                $stock=0;
            } else {
                $stock=$_REQUEST['stock'][$key];
            }

            if (isset($request->group_id)) {
                $group=$request->group_id;
            } else {
                $group=null;
            }

            $productsss=ProductMedias::where('slug', $slug)->first();
            if (empty($productsss)) {
                $res = ProductMedias::create([
                        'name' => $_REQUEST['productname'][$key],
                        'price' => $_REQUEST['price'][$key],
                        'tax' => $_REQUEST['tax'][$key],
                        'stock' => $stock,
                        'unlimited_stock' => $_REQUEST['stocktype'][$key],
                        'category' => $cat,
                        'slug' => $slug,
                        'user_id' => $user->id,
                        'type' => 'image',
                        'group_id' => $request->group_id,
                        'path' => $name
                    ]);
                $errors[]="Product  ".$_REQUEST['productname'][$key]." successfully created";
            } else {
                $errors[]="Product with ".$_REQUEST['productname'][$key]." Already exists try with different name";
            }
        }
        Session::flash('alert-success', implode("\n", $errors));
//        if($request->group_id > 0){
//            $group = ProductGroups::where(['id' => $request->group_id])->first();
//            if($group->parent_id == 0)
//                return redirect('/product-group/'.$group->slug );
//            else
//                return redirect('/products/'.$group->slug );
//        }
        return redirect()->back();
    }



    public function subgroupproducts($subgroupslug)
    {
        $user = Auth::user();
        $subgroup = ProductGroups::where(['slug' => $subgroupslug])->first();
        if (!empty($subgroup)) {
            $group = ProductGroups::where(['id' => $subgroup->parent_id])->first();
            $videos = "";
            $user = Auth::user();
            if (isset($user)) {
                $products = ProductMedias::select('*', DB::raw('count(*) as total'))->where(['group_id' => $subgroup->id ])->groupby('category')->orderBy('created_at', 'desc')->get();
                $variationso = ProductMedias::where(['group_id' => $subgroup->id ])->orderBy('created_at', 'desc')->get();
            } else {
                $products = ProductMedias::select('*', DB::raw('count(*) as total'))->where(['group_id' => $subgroup->id])->groupby('category')->orderBy('created_at', 'desc')->get();
                $variationso = ProductMedias::where(['group_id' => $subgroup->id])->orderBy('created_at', 'desc')->get();
            }
            $variations=array();
            foreach ($variationso->toArray() as $variation) {
                $variations[$variation['category']][]=$variation;
            }
            return view('admin.products.index', compact('variations', 'group', 'subgroup', 'products', 'user'));
        } else {
            echo "Sorry, The page you are looking for was ot found";
        }
    }

    public function deleteproduct($id)
    {
        $story = ProductMedias::find($id);
        if (count($story)) {
            if ($story->imagepath) {
                @unlink(get_product_imge_path($story->imagepath));
            }
            $story->delete();
            Session::flash('alert-success', "Product delete successfully");
        } else {
            Session::flash('alert-warning', "Error occurred while deleting");
        }
        return redirect()->back();
    }

    public function deleteproductssubgroup($gid)
    {
        $story = ProductGroups::find($gid);
        if (count($story)) {
            $images=$story->get();


            foreach ($images as $image) {
                if ($image->imagepath) {
                    $gid=$image->id;
                    $imgdelete = ProductMedias::where('group_id', $gid)->delete();
                    (get_product_imge_path($image->imagepath));
                    @unlink(get_product_imge_path($image->imagepath));
                }


                $story->delete();
            }
            Session::flash('alert-success', "Product Sub Group delete successfully");
            return redirect()->back();
        } else {
            Session::flash('alert-warning', "Sub Group not found");
        }
    }

    public function searchusersonproducts($keyword)
    {
        $users=User::where('name', 'like', '%'.$keyword.'%')->get();
        ob_clean();
        return view('admin.products.searchuseronproducts', compact('users'));
    }

    public function createorder($userid, $productid)
    {


        $response=array();
        $productid=str_replace("p_", "", $productid);


        $product=ProductMedias::where('id', $productid)->first();
        if ($product->unlimited_stock==0 && $product->stock==0) {
            $message="No Stock available for the product, Click Edit <i class='fa fa edit'></i> to update stock and than add again";
            $response=array("status"=>"success","message"=>$message);
        } else {
            try {
                $userorder=UserOrders::
                where('userid', $userid)
                    ->where('status', "incomplete")
                    ->first();
                $invoiceamount=0;
                $balance=0;
                if (!empty($userorder)) {
                    $ispresent=UserHasProducts::where('userid', $userid)
                        ->where('orderid', $userorder->id)
                        ->where('productid', $productid)
                        ->first();

                    if (!empty($ispresent)) {
                        $qty=$ispresent->quantity+1;
                        UserHasProducts::where('userid', $userid)
                            ->where('userid', $userid)
                            ->where('orderid', $userorder->id)
                            ->where('productid', $productid)
                            ->update([
                                'quantity' => $qty,
                            ]);
                    } else {
                        $product=ProductMedias::where('id', $productid)->first();

                        UserHasProducts::create([
                            'userid' => $userid,
                            'productid' => $productid,
                            'quantity' => 1,
                            'orderid' => $userorder->id,
                            'price' => $product->price,
                            'name' => $product->name,
                            'tax' => $product->tax,

                        ]);
                    }
                    $userordersa=UserHasProducts::where('userid', $userid)
                        ->where('orderid', $userorder->id)
                        ->get();
                    $productids=array();
                    $orderid="";
                    $userproductswithqty=array();
                    foreach ($userordersa as $userp) {
                        $productids[]=$userp['productid'];
                        $orderid=$userp['orderid'];
                        $userproductswithqty[$userp['productid']]=$userp['quantity'];
                    }

                    $productobj=ProductMedias::wherein('id', $productids)->get();
                    foreach ($productobj->toArray() as $productob) {
                        $savedqty=$userproductswithqty[$productob['id']];
                        $amount = ($productob['price'] - ($productob['price'] * ($productob['tax'] * 0.01))) * $savedqty;
                        $invoiceamount+=$amount;
                        $balance =0;
                    }
                    $res=UserOrders::where('id', $orderid)->update([
                        'invoiceamount' => $invoiceamount,
                        'balance' => $balance

                    ]);



                    $response=array("status"=>"success","message"=>"Order Updated","orderid"=>$orderid);
                } else {
                    $product=ProductMedias::where('id', $productid)->first();
                    if ($product->unlimited_stock==0 && $product->stock == 0) {
                        $limitedStockalert=true;
                    } else {
                        $invoiceamount += $product->price + ($product->price*($product->tax*0.01))*1;
                        $balance =0;
                        $order=UserOrders::create([
                            'userid' => $userid,
                            'invoiceamount' => $invoiceamount,
                            'balance' => $balance,
                            'status' => "incomplete"

                        ]);
                        UserHasProducts::create([
                            'userid' => $userid,
                            'productid' => $productid,
                            'quantity' => 1,
                            'orderid' => $order->id,
                            'price' => $product->price,
                            'name' => $product->name,
                            'tax' => $product->tax,
                        ]);
                        $orderid=$order->id;
                    }



                    $response=array("status"=>"success","message"=>"Order Saved","orderid"=>$orderid);
                }
            } catch (Exception $exception) {
                $response=array("status"=>"success","message"=>"Exception: ".$exception->getMessage());
            }
        }

        echo json_encode($response);
        exit;
    }


    public function getorderdetails($userid)
    {


//
        $order=UserOrders::select('user_has_products.productid', 'user_has_products.userid', 'user_has_products.price', 'user_has_products.name')->leftjoin('user_has_products', 'user_has_products.orderid', 'user_orders.id')
            ->where('user_orders.userid', $userid)
            ->where('user_orders.status', "incomplete")
            ->get();
        $orderamount=UserOrders::select('invoiceamount')
            ->where('userid', $userid)
            ->where('status', "incomplete")
            ->first();
        return view('admin.products.updatecart', compact('order', 'orderamount'));
    }

    public function showpreviouslystoredorders($userid)
    {

        Session::put('userid_products', $userid);
        Session::save();

        $ordersdrop=UserOrders::select('user_has_products.orderid', 'user_has_products.productid', 'user_has_products.userid', 'user_has_products.price', 'user_has_products.name', 'user_has_products.quantity', 'user_has_products.tax')
            ->leftjoin('user_has_products', 'user_has_products.orderid', 'user_orders.id')
//            ->leftjoin('productmedia','productmedia.id','user_has_products.productid')
            ->where('user_orders.userid', $userid)
            ->whereNotNull('user_has_products.productid')
            ->where('user_orders.status', "incomplete")
            ->get();


//        echo "<pre>";
//        print_r($ordersdrop->toArray());
//        exit;


        return view('admin.products.updatecart_dragdropview', compact('ordersdrop'));
    }

    public function calculatetotalprice($userid)
    {
        $orderamount=UserOrders::select('invoiceamount', 'id')
            ->where('userid', $userid)
            ->where('status', "incomplete")
            ->first();

        return view('admin.products.updatecart_orderamount', compact('orderamount', 'userid'));
    }

    public function showPayPopup($userid)
    {
        $orderamount=UserOrders::select('invoiceamount', 'id')
            ->where('userid', $userid)
            ->where('status', "incomplete")
            ->first();

        return view('admin.products.paypopup', compact('orderamount', 'userid'));
    }

    public function savecart(Request $request)
    {

        foreach ($request->productid as $key => $product) {
            $price=$_REQUEST['price'][$key];
            $name=$_REQUEST['orderproductname'][$key];
            $response=UserHasProducts::where('productid', $product)
                ->where('userid', $_REQUEST['userid'][$key])
                ->update([
                    'price' => $price,
                    'name' => $name
                ]);
        }
        Session::flash('alert-success', 'Cart Successfully Saved');
        return redirect()->back();
    }


    public function editCartItem(Request $request, $pid = null)
    {

        $userid=$request->userid;
        $orderid=$request->orderid;
        $update=UserHasProducts::where('productid', $pid)->
        where('userid', $userid)
        ->where('orderid', $orderid)
            ->update([
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'name'=>$request->name
            ]);
        if ($update) {
            Session::flash('alert-success', 'Order Updated successfully');
        } else {
            Session::flash('alert-error', 'Some error occurred while updating order details');
        }
        return redirect()->back();
    }

    public function deleteCartItem(Request $request, $pid = null)
    {

        $userid=$request->userid;
        $orderid=$request->orderid;
        $delete=UserHasProducts::where('productid', $pid)
            ->where('orderid', $orderid)
            ->where('userid', $userid)->delete();
        if ($delete) {
            Session::flash('alert-success', 'Order item deleted successfully');
        } else {
            Session::flash('alert-error', 'Some error occurred while deleting order item');
        }
        return redirect()->back();
    }


    public function loadfromsessioncart()
    {

        $userid=Session::get('user_id');

        $ordersdrop=UserOrders::select('user_has_products.price', 'user_has_products.name', 'user_has_products.quantity', 'productmedia.tax')
            ->leftjoin('user_has_products', 'user_has_products.orderid', 'user_orders.id')
            ->leftjoin('productmedia', 'productmedia.id', 'user_has_products.productid')
            ->where('user_orders.userid', $userid)
            ->where('user_orders.status', "incomplete")
            ->get();



        return view('admin.products.updatecart_dragdropview', compact('ordersdrop'));
    }

    public function removeSessionUsers($userid)
    {


        Session::forget('userid_products');
        Session::save();
        echo "success";
        exit;
    }


    public function savetransaction(Request $request)
    {


        $parent_user_id=Auth::id();
        $orderid=$request->orderid;
        $payment_mode=$request->transaction_type;
        if ($payment_mode=="by_cash") {
            $amount = $request->answer;
        } else {
            $amount=$request->amountaccount;
        }
        $userorder=UserOrders::where('id', $orderid)->first();
        if (!empty($userorder)) {
           // exit($transaction_type);
            $amouremaining=$userorder->invoiceamount - $amount;
            if ($payment_mode=="by_cash") {
                $transaction=Transactions::create([
                    'date'=>Carbon::now(),
                    'amount_received'=>$amount,
                    'amount_debt'=>$amouremaining,
                    'note'=>"Transactions from products cart for Cash payment",
                    'payment_mode'=>$payment_mode,
                    'user_id'=>$userorder->userid,
                    'parent_user_id'=>$parent_user_id,
                    'transaction_type'=>"_products_",
                ]);


                UserOrders::where('id', $orderid)
                    ->update(['status'=>'paid','balance'=>$amouremaining]);
            } else {
                $transaction=Transactions::create([
                    'date'=>Carbon::now(),
                    'amount_received'=>$userorder->invoiceamount,
                    'amount_debt'=>$amouremaining,
                    'payment_mode'=>$payment_mode,
                    'note'=>"Transactions from products cart for Account payment",
                    'user_id'=>$userorder->userid,
                    'parent_user_id'=>$parent_user_id,
                    'transaction_type'=>"_products_",
                ]);

                $balance=0;
                UserOrders::where('id', $orderid)
                    ->update(['status'=>'paid','balance'=>$balance]);
            }
            Session::forget('userid_products');
            Session::save();
        }
        Session::flash('alert-success', 'Transactions for order  #'.$orderid.' Successfully Saved');
        return redirect()->back();
    }


    public function cancelorder(Request $request)
    {

        $orderid=$request->orderid;
        $userorder=UserOrders::where('id', $orderid)->delete();
        $userorder=UserHasProducts::where('orderid', $orderid)->delete();
        $userid=Session::forget(
            'userid_products'
        );
        Session::save();
        Session::flash('alert-success', "Order #".$orderid." Successfully Delete");
        return redirect()->back();
    }

    public function editprdouctgroup(Request $request, $id)
    {
        $name=$request->groupname;
        if (empty(ProductGroups::where('name', $name)->first())) {
            $edit=ProductGroups::where('id', $id)->update(['name'=>$name]);
            if ($edit) {
                Session::flash('alert-success', "Successfully Updated");
            } else {
                Session::flash('alert-warning', "Error occurred while updating");
            }
        } else {
            Session::flash('alert-warning', "Group Already exists");
        }

        return redirect()->back();
    }

//    public function editproducts(Request $request,$pid){
//        $name= $request->
//        $edit=ProductMedias::where('id',$pid)->update([
//            'name'=>$name
//        ]);
//        if($edit)
//            Session::flash('alert-success', "Successfully Updated");
//        else
//            Session::flash('alert-warning', "Error occurred while updating");
//        return redirect()->back();
//    }

    public function editproducts(Request $request, $pid)
    {

        $story=ProductMedias::where('id', $pid)->first();


        $image=$request->imagefile;
        if (!isset($image)) {
            $name=$story->path;
        } else {
            if ($story->imagepath) {
                @unlink(get_product_imge_path($story->imagepath));
            }

            $name = time().".".$image->getClientOriginalExtension();
            $destinationPath = public_path('/public/admin/images/groups/products/');
            $image->move($destinationPath, $name);
        }


        if (!isset($request->stock)) {
            $stock=0;
        } else {
            $stock=$request->stock;
        }

        $res=ProductMedias::where('id', $pid)->update([
                'name' => $request->productname,
                'price' => $request->price,
                'tax' => $request->tax,
                'stock' => $stock,
                'unlimited_stock' => $request->stocktype,
                'path' => $name,
            ]);

        Session::flash('alert-success', "Product  Updated Successfully");
        return redirect()->back();
    }


    function saveProductSetting(Request $request, $delflag)
    {

        if ($delflag) {
            $res=User::where('id', Auth::id())->where('products_default_setting', $request->group_path)->update(['products_default_setting'=>'null']);
        } else {
            $res=User::where('id', Auth::id())->update(['products_default_setting'=>$request->group_path]);
        }
        if ($res) {
            Session::flash('alert-success', "Setting saved successfully");
        } else {
            Session::flash('alert-error', "Some error occurred, please try again");
        }
    }
}
