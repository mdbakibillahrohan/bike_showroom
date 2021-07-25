<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Admin_model\Barcode;
use App\Admin_model\CustomerAccount;
use App\Admin_model\Customerpayment;
use App\Admin_model\Supplier;
use App\Admin_model\SupplierAccount;
use App\Admin_model\Supplierpayment;
use App\Bike_Model\Bike;
use App\Bike_Model\Bikecustomer;
use App\Bike_model\Bikeidentity;
use App\Bike_Model\Installment;
use App\Http\Controllers\Controller;
use App\Order_model\Order;
use App\Order_model\Returnorder;
use App\Product_model\Product;
use App\Product_model\Purchase;
use App\Product_model\Subcategorie;
use App\Showroom_model\Showroom;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function PermissionMenuUser(User $user)
    {
        $allmenu = DB::table('submenus')->where('submenu_name','!=',"Menu Permission")->get();

        $subMenu = [];
        foreach ($user->menudata as $menu) {

            $subMenu[]=[
                'id'=>$menu->id,
                'mainmenu'=>$menu->mainmenu_id,
                'name'=>$menu->submenu_name,
            ];
        }

        return response()->json([$subMenu,$allmenu]);
    }

    public function ShowroomEditdata($id){
        $data = Showroom::where('id',$id)->first();
        return response()->json($data);
    }

    public function UserEditdata($id){
        $data = User::where('id',$id)->first();
        return response()->json($data);
    }

    public function CategoryIddata($id)
    {
        $data = Subcategorie::where('categorie_id',$id)->get();
        return response()->json($data);
    }

    public function Purchesh_suplierdata($id)
    {
       // $supplier = Supplier::where('id',$id)->first();
        //$data = $supplier->supplieraccount;
        $data = DB::table('suppliers')
            ->select('suppliers.suplier_name','supplier_accounts.supplier_id','supplier_accounts.accounts','supplier_accounts.status')
            ->leftJoin('supplier_accounts','supplier_accounts.supplier_id','=','suppliers.id')
            ->where('suppliers.id',$id)
            ->orderBy('supplier_accounts.id','DESC')
            ->first();

        return response()->json($data);
    }


    public function CustomerAccountData($id)
    {
        $data = DB::table('customers')
            ->select('customers.customer_name','customer_accounts.customer_id','customer_accounts.accounts','customer_accounts.status')
            ->leftJoin('customer_accounts','customer_accounts.customer_id','=','customers.id')
            ->where('customers.id',$id)
            ->orderBy('customer_accounts.id','DESC')
            ->first();

        return response()->json($data);
    }


    public function Autocompleteproduct()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;

        $productdata = Product::where('showroom_id',$id)->get();

        return response()->json($productdata);
    }



    public function Autocompleteproduct_select($id)
    {
        $product = Product::where('id',$id)->first();
        return response()->json($product);
    }

    public function Searchproduct_order()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;

        $products = DB::table('purchases')
            ->select('purchases.product_id','purchases.attribute','products.product_name','barcodes.barcode')
            ->leftJoin('products','products.id','=','purchases.product_id')
            ->leftJoin('barcodes','barcodes.purchase_id','=','purchases.id')
            ->where('products.status','1')
            ->where('purchases.showroom_id',$id)
            ->get();

        return response()->json($products);
    }

    public function Autocompleteproduct_order($pdid,$code,$attr)
    {
        $barcodedata = Barcode::where('barcode',$code)->first();

        $productstoke = Purchase::where('id', $barcodedata->purchase_id)
            ->select('product_id','attribute', DB::raw('SUM(rest_qty) as rest_qty '))
            ->groupBy(['product_id','attribute'])
            ->first();
        $product = Product::where('id',$pdid)->first();

        $product_rate = Purchase::where('id', $barcodedata->purchase_id)->first();

        return json_encode(array('Product'=>$product,'Rest_qty'=>$productstoke,'Rate'=>$product_rate,'Barcode'=>$barcodedata));

    }

    public function Autocompleteproduct_order_code($code)
    {
        $barcodedata = Barcode::where('barcode',$code)->first();

        $productstoke = Purchase::where('id', $barcodedata->purchase_id)
            ->select('product_id','attribute', DB::raw('SUM(rest_qty) as rest_qty '))
            ->groupBy(['product_id','attribute'])
            ->first();
        $product = Product::where('id',$barcodedata->product_id)->first();

        $product_rate = Purchase::where('id', $barcodedata->purchase_id)->first();

        return json_encode(array('Product'=>$product,'Rest_qty'=>$productstoke,'Rate'=>$product_rate,'Barcode'=>$barcodedata));
    }


    public function SupplierpreviusAccount($id)
    {
        $supplier_account = SupplierAccount::where('supplier_id',$id)->orderBy('id','DESC')->first();
        $Supplierpayment = Supplierpayment::where('supplier_id',$id)
            ->where('status','0')
            ->orderBy('invoice_no','DESC')
            ->get();

        $arrycount = count($Supplierpayment);

        if($supplier_account->status==1 && $arrycount==0 ){

            $invoice = Purchase::where('supplier_id',$id)->orderBy('invoice_no','DESC')->get();

        }else if ($supplier_account->status==0 && $arrycount==0){

            $invoice = Purchase::where('supplier_id',$id)->orderBy('invoice_no','DESC')->get();

        }else if($arrycount !=0){

            $invoice = Supplierpayment::where('supplier_id',$id)
                ->where('status','0')
                ->orderBy('invoice_no','DESC')
                ->get();
        }else{
            $invoice = Purchase::where('supplier_id',$id)->orderBy('invoice_no','DESC')->get();
        }


        return json_encode(array('Accounts'=>$supplier_account,'Payment'=>$Supplierpayment,'invoicedata'=>$invoice));
    }


    public function CustomerpreviusAccount($id)
    {
        $customer_account = CustomerAccount::where('customer_id',$id)->orderBy('id','DESC')->first();

        $customerpayment = Customerpayment::where('customer_id',$id)
            ->where('status','0')
            ->orderBy('invoice_no','DESC')
            ->get();


        $arrycount = count($customerpayment);

        if($customer_account->status==0 && $arrycount==0 ){
            $invoice = Order::where('supplier_id',$id)->orderBy('invoice_no','DESC')->get();
        }else if($customer_account->status==1 && $arrycount==0){
            $invoice = Order::where('supplier_id',$id)->orderBy('invoice_no','DESC')->get();
        }else if($arrycount !=0){
            $invoice = Customerpayment::where('customer_id',$id)
                ->where('status','0')
                ->orderBy('invoice_no','DESC')
                ->get();
        }else{
            $invoice = Order::where('supplier_id',$id)->orderBy('invoice_no','DESC')->get();
        }

        return json_encode(array('Accounts'=>$customer_account,'Payment'=>$customerpayment,'invoicedata'=>$invoice));
    }


    public function DataReturnOrder($id)
    {
        $showroomdata = Cache::get("showroom");
        $showroomid = $showroomdata->id;

        $customer = DB::table('customers')
            ->select('customers.customer_name','customer_accounts.customer_id','customer_accounts.accounts','customer_accounts.status')
            ->leftJoin('customer_accounts','customer_accounts.customer_id','=','customers.id')
            ->where('customers.id',$id)
            ->where('customers.showroom_id',$showroomid)
            ->orderBy('customer_accounts.id','DESC')
            ->first();


        $orderdata = DB::table('orders')
            ->select('orders.*','products.product_name')
            ->join('products','products.id','=','orders.product_id')
            ->where('orders.status','1')
            ->where('orders.showroom_id',$id)
            ->where('orders.customer_id',$showroomid)
            ->orderBy('orders.id','DESC')
            ->get();


        return json_encode(array('customer'=>$customer,'orderdata'=>$orderdata));

    }

    public function sellingproductdetails($id)
    {
        $data = Order::where('id',$id)->first();

        return response()->json($data);
    }

    public function returninvoiceid($id)
    {
        $data = Returnorder::where('return_invoice',$id)->where('return_status',"0")->first();
        if ($data !=""){
            $return = Returnorder::where('return_invoice',$id)->where('return_status',"0")->first();
        }else{
            $return = "0";
        }

        return response()->json($return);
    }


    public function bikesearch_ajax()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;

        $data = Bike::where('showroom_id',$id)
            ->select('bikes.*','bikeidentities.engine_no','bikeidentities.chassis_no')
            ->join('bikeidentities','bikeidentities.bike_id','=','bikes.id')
            ->get();

        return response()->json($data);

    }

    public function bikesearchselect_ajax($id)
    {
        $data = Bike::where('bikes.id',$id)
            ->select('bikes.*','bikepurchases.*','bikeidentities.engine_no','bikeidentities.chassis_no','bikeidentities.id as identity_id')
            ->join('bikepurchases','bikepurchases.bike_id','=','bikes.id')
            ->join('bikeidentities','bikeidentities.bike_id','=','bikes.id')
            ->first();

        return response()->json($data);
    }

    public function bikedetails_selectengineno($enginno)
    {
        $data = Bikeidentity::where('bikeidentities.engine_no',$enginno)
            ->select('bikes.*','bikepurchases.*','bikeidentities.engine_no','bikeidentities.chassis_no','bikeidentities.id as identity_id')
            ->join('bikepurchases','bikepurchases.bike_id','=','bikeidentities.bike_id')
            ->join('bikes','bikes.id','=','bikeidentities.bike_id')
            ->first();

        return response()->json($data);
    }

    public function Installment_pay($id)
    {
        $investdata = Installment::where('bikecustomer_id',$id)->where('status',0)->get();

        $data = Bike::where('bikes.id',$investdata[0]->bike_id)
            ->select('bikes.name','bikes.id as bikeid','bikecustomers.customer_name')
            ->join('bikecustomers','bikecustomers.bikesell_id','=','bikes.id')
            ->first();

        return json_encode(array('bikename'=>$data,'orderdata'=>$investdata));

    }



}
