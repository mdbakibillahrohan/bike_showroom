<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Accounts_model\Purchasecost;
use App\Accounts_model\Recivecash;
use App\Admin_model\Customer;
use App\Admin_model\Submenu;
use App\Admin_model\Supplier;
use App\Admin_model\Supplierpayment;
use App\Http\Controllers\Controller;
use App\Order_model\Order;
use App\Order_model\Profitorder;
use App\Order_model\Returnorder;
use App\Product_model\Brand;
use App\Product_model\Categorie;
use App\Product_model\Product;
use App\Product_model\Purchase;
use App\Product_model\Subcategorie;
use App\Showroom_model\Expence;
use App\Showroom_model\Showroom;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class MainIndexController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware(['auth','menu']);
    }

    public function MenuPermission()
    {
        $allmenu = Submenu::select('mainmenu_id')
            ->groupBy('mainmenu_id')
            ->orderBy('id','ASC')
            ->get();
        $alluser = User::where('role_id','!=',1)->get();
        return view('User.menu_permission', compact('allmenu','alluser'));
    }


    public function ShowroomIndex()
    {
        $userid = Auth::user()->id;
        if (Auth::user()->role_id == 1) {
            $allshowroom = Showroom::all();
        } else {
            $allshowroom = DB::table('showroom_user')
                ->select('showrooms.*', 'showroom_user.user_id as usernewid')
                ->leftJoin('showrooms', 'showrooms.id', '=', 'showroom_user.showroom_id')
                ->where('showroom_user.user_id', $userid)
                ->get();
        }

        //$user = Auth::user();
        //$allshowroom = $user->showrooms();
        return view('Showroom.showroom_add', compact('allshowroom'));
    }

    public function UserIndex()
    {
        $alluser = User::where('role_id', '!=', 1)->get();
        $allshowroom = Showroom::all();
        $usertype = DB::table('roles')->where('id', '!=', 1)->get();
        return view('User.user_add', compact('alluser', 'allshowroom', 'usertype'));
    }

    public function SupplierIndex()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;
        $allsupplier = Supplier::where('showroom_id', $id)->get();

        return view('Supplier.supplier_add', compact('allsupplier'));
    }

    public function CustomerIndex()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;
        $allcustomer = Customer::where('showroom_id', $id)->get();

        return view('Customer.customer_add', compact('allcustomer'));
    }

    public function CategoriesIndex()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;
        $allcategories = Categorie::where('showroom_id', $id)->get();

        return view('categorie.categorie_view', compact('allcategories'));
    }

    public function SubcategoriesIndex()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;
        $allcategories = Categorie::where('showroom_id', $id)->get();
        $allsubcategories = Subcategorie::all();

        return view('categorie.subcategorie_view', compact('allsubcategories', 'allcategories'));
    }

    public function BrandIndex()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;
        $allbrand = Brand::where('showroom_id', $id)->get();

        return view('categorie.brand_view', compact('allbrand'));
    }

    public function ProductIndex()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;
        $allcategories = Categorie::where('showroom_id', $id)->get();
        $allbrand = Brand::where('showroom_id', $id)->get();
        $productdata = Product::where('showroom_id', $id)->paginate(15);
        return view('Product.product_view', compact('allcategories', 'allbrand', 'productdata'));
    }

    public function Productlist()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;
        $productdata = Product::where('showroom_id', $id)->paginate(15);
        return view('Product.product_list_view', compact('productdata'));
    }

    public function PurchaseIndex()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;
        $suplierdata = Supplier::where('showroom_id', $id)->get();
        $productdata = Product::where('showroom_id', $id)->get();

        $productstokedata = Purchase::where('showroom_id', $id)
            ->select('invoice_no', DB::raw('SUM(quantity) as quantity'), DB::raw('SUM(buy_cost) as buy_cost'), DB::raw('SUM(discount) as discount'), DB::raw('SUM(actual_buy) as actual_buy '), DB::raw('SUM(sub_total_buy) as sub_total_buy '))
            ->groupBy('invoice_no')
            ->orderBy('id','DESC')
            ->paginate(10);

        return view('Product.Product_Purchase', compact('productdata', 'suplierdata','productstokedata'));
    }

    public function ProductStokeIndex()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;

        $productstokedata = Purchase::where('showroom_id', $id)
            ->select('product_id', 'attribute', DB::raw('SUM(quantity) as totalqty'), DB::raw('SUM(actual_buy) as actual_buysum'), DB::raw('SUM(sub_total_buy) as sub_total_buy'), DB::raw('SUM(rest_qty) as rest_qty '), DB::raw('SUM(rest_buy_amount) as rest_buy_amount'))
            ->groupBy(['product_id', 'attribute'])
            ->orderBy('id','DESC')
            ->paginate(15);

        return view('Product.product_stoke_view', compact('productstokedata'));
    }

    public function ProductDetailsIndex()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;
        $productdetails = Purchase::where('showroom_id', $id)
            ->where('rest_qty', '>', 0)
            ->paginate(15);

        return view('Product.product_details_view', compact('productdetails'));
    }


    public function Order_Index()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;
        $customer = Customer::where('showroom_id',$id)->get();

        $neworderdata = Order::where('showroom_id', $id)
            ->orderBy('invoice_no','DESC')
            ->get()
            ->groupBy('invoice_no');

        return view('Order_page.Sell_Order_view', compact('customer','neworderdata'));
    }

    public function Order_invoicedetails()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;

        $neworderdata = Order::where('showroom_id', $id)
            ->select('invoice_no', DB::raw('SUM(total_sellprice) as total_sellprice'), DB::raw('SUM(sell_discount) as sell_discount'), DB::raw('SUM(sell_cost) as sell_cost'), DB::raw('SUM(lastsell_amount) as lastsell_amount '))
            ->groupBy('invoice_no')
            ->orderBy('invoice_no','DESC')
            ->paginate(15);

        return view('Order_page.OrderInvoiceDetails', compact('neworderdata'));
    }

    public function Details_order()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;
        $orderdetails = Order::where('showroom_id', $id)
            ->orderBy('invoice_no','DESC')
            ->paginate(15);
        return view('Order_page.DetailsOrder', compact('orderdetails'));
    }


    public function ShowroomExpense()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;
        $purchesh = DB::table('purchasecosts')->where('showroom_id', $id)->orderBy('created_at','DESC')->get()->toArray();
        $expense = DB::table('expences')->where('showroom_id', $id)->orderBy('created_at','DESC')->get()->toArray();

        $datam = array_merge($purchesh, $expense);


        if($datam!=NULL) {

            foreach ($datam as $datas) {

                $dateastime = strtotime($datas->created_at);

                if (@$datas->cost_reson) {
                    $particular = "purchase";
                } elseif (@$datas->expense_reason) {
                    $particular = "expense";
                } else {
                    $particular = "-";
                }

                $showroomexpense[] = array(
                    'id' => $dateastime,
                    'date' => $datas->date,
                    'showroom_id' => $datas->showroom_id,
                    'particular' => $particular,
                    'expense_amount' => @$datas->expense_amount,
                    'expense_reason' => @$datas->expense_reason,
                    'cost_reson' => @$datas->cost_reson,
                    'cost_amount' => @$datas->cost_amount,
                    'user_id' => @$datas->user_id
                );


            }//end of foreach

            rsort($showroomexpense);

            $ser = 	0;
            foreach($showroomexpense as $newdata){
                $particular = $newdata['particular'];

                if($particular=="expense"){
                    $amount = $newdata['expense_amount'] ;
                    $cost_reson = $newdata['expense_reason'] ;
                }elseif($particular=="purchase"){
                    $amount = $newdata['cost_amount'];
                    $cost_reson = $newdata['cost_reson'];
                }else{
                    $amount= "";
                    $cost_reson= "";
                }
                $particular = $newdata['particular'];
            $showroom = Showroom::where('id',$newdata['showroom_id'])->first();
            $userid = User::where('id',$newdata['user_id'])->first();
                $record[$ser] = array(
                    'invoice'=>$newdata['id'],
                    'showroom_id'=>$showroom->showroom_name,
                    'date'=>$newdata['date'],
                    'particular'=>$particular,
                    'reason'=>$cost_reson,
                    'serial'=>$ser ,
                    'amount'=>$amount,
                    'user_id'=>$userid->name
                );
                $ser++;
            }
           // dd($record);

        }

        return view('Showroom.Showroomexpence', compact('record'));
    }


    public function ShowroomProfit()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;

        $profit = Profitorder::where('showroom_id', $id)->orderBy('id','DESC')->paginate(15);
        return view('Showroom.Showroom_profit', compact('profit'));
    }

    public function ShowroomCashRecive()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;

        $recivecash = Recivecash::where('showroom_id', $id)->orderBy('id','DESC')->paginate(15);
        return view('Showroom.Showroom_Recive_cash', compact('recivecash'));
    }

    public function ShowroomProductStoke()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;

        $brand = Brand::where('showroom_id', $id)->get();
        $category = Categorie::where('showroom_id', $id)->get();
        $productstoke = Purchase::where('showroom_id', $id)->where('rest_qty','>',0)->paginate(15);

        return view('Report_page.Showroom_Product_stoke', compact('brand','category','productstoke'));
    }


    public function SellingDetails()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;
        $brand = Brand::where('showroom_id', $id)->get();
        $category = Categorie::where('showroom_id', $id)->get();

        $orderdata = Order::where('showroom_id', $id)->orderBy('id','DESC')->paginate(15);
        return view('Report_page.Selling_report', compact('brand','category','orderdata'));
    }


    public function ReturnOrder()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;
        $customer = Customer::where('showroom_id', $id)->get();
        $totalorder = Order::where('showroom_id', $id)->get();
        $returnorder = Returnorder::where('showroom_id', $id)->orderBy('id','DESC')->paginate(10);

        return view('Return_product.Return_product_view', compact('customer','totalorder','returnorder'));
    }


    public function DetailsReturnOrder()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;

        $returnorder = Returnorder::where('showroom_id', $id)->orderBy('id','DESC')->paginate(10);

        return view('Return_product.Return_order_details', compact('returnorder'));
    }


    public function ShowroomSummery()
    {
        return response()->json("ShowroomSummery Working");
    }





    public function VatSetting()
    {
        return response()->json("VatSetting Working");
    }

    public function PrintSetting()
    {
        return response()->json("PrintSetting Working");
    }

    public function BarcodeGenerate()
    {
        return response()->json("BarcodeGenerate Working");
    }


}
