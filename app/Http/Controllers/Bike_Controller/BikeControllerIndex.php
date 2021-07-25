<?php

namespace App\Http\Controllers\Bike_controller;

use App\Admin_model\Supplier;
use App\Bike_Model\Bike;
use App\Bike_Model\Bikecustomer;
use App\Bike_Model\Bikepayment;
use App\Bike_Model\Bikepurchase;
use App\Bike_Model\Bikesell;
use App\Bike_Model\Installment;
use App\Bike_Model\Registration;
use App\Http\Controllers\Controller;
use App\Product_model\Brand;
use App\Product_model\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class BikeControllerIndex extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dashboardUrl = route('bike_panel');
        $panelName = "bike";
        return view('Purchase_layouts.Purchase_Dashboard', compact('panelName', 'dashboardUrl'));
    }

    public function AddBike()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;
        $category = Categorie::where('showroom_id',$id)->orderBy('id','DESC')->get();
        $brand = Brand::where('showroom_id',$id)->orderBy('id','DESC')->get();
        $allbike = Bike::where('showroom_id',$id)->orderBy('id','DESC')->get();
        return view('Bike_Section.bike_purchase.bike_add_view',compact('category','brand','allbike'));

    }




    public function Bike_Purchase_Index()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;
        $allbike = Bike::where('showroom_id',$id)->orderBy('id','DESC')->get();

        $bikepurches = Bikepurchase::where('showroom_id',$id)->orderBy('id','DESC')->get();

        $supplier = Supplier::where('showroom_id',$id)->orderBy('id','DESC')->get();
        return view('Bike_Section.bike_purchase.bike_purchase_view',compact('allbike','supplier','bikepurches'));
    }


    public function Bike_Sell_index()
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;
        $allbike = Bike::where('showroom_id',$id)->orderBy('id','DESC')->get();

        $bikepurches = Bikepurchase::where('showroom_id',$id)->orderBy('id','DESC')->get();

        $supplier = Supplier::where('showroom_id',$id)->orderBy('id','DESC')->get();
        return view('Bike_Section.Bike_order.bike_order_view');
    }


    public function Bike_Sell_Detail()
    {
        $totalorder = Bikesell::orderBy('id','DESC')->paginate(15);
        return view('Bike_Section.Bike_order.bike_order_detail',compact('totalorder'));
    }

    public function Installment_Detail()
    {
        $installment = Installment::where('status', 0)
            ->select('bikecustomer_id', DB::raw('SUM(blanch) as blanch '))
            ->groupBy('bikecustomer_id')
            ->paginate(15);
        //dd($installment);

        return view('Bike_Section.Bike_order.bike_order_installment',compact('installment'));
    }

    public function Paymentrecived()
    {
        $payment = Bikepayment::orderBy('id','DESC')->paginate(15);
        return view('Bike_Section.Bike_order.totalpayment_recived',compact('payment'));
    }

    public function RegistrationIndex()
    {
        $registratin = Registration::where('registrationtype','!=',"null")->orderBy('id','DESC')->paginate(15);
        return view('Bike_Section.Bike_order.registratin_document',compact('registratin'));
    }

    public function AccountCustomer()
    {
        $accounts = Bikecustomer::orderBy('id','DESC')->paginate(15);
        return view('Bike_Section.Bike_order.Bikecustomer_Accounts',compact('accounts'));
    }

    public function BikeStoke_Detail()
    {
       // $purchesh = Bikepurchase::orderBy('id','DESC')->paginate(15);
        $purchesh = Bikepurchase::select('bike_id', DB::raw('SUM(quantity) as quantity '), DB::raw('SUM(rest_qty) as rest_qty '))
            ->groupBy('bike_id')
            ->paginate(15);

        return view('Bike_Section.bike_purchase.bike_stokedetails_view',compact('purchesh'));

    }

}
