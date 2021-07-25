<?php

namespace App\Http\Controllers\Bike_Controller;

use App\Accounts_model\Recivecash;
use App\Admin_model\CommonModel;
use App\Bike_Model\Bikecustomer;
use App\Bike_model\Bikeidentity;
use App\Bike_Model\Bikepayment;
use App\Bike_Model\Bikepurchase;
use App\Bike_Model\Bikesell;
use App\Bike_Model\Installment;
use App\Bike_Model\Registration;
use App\Http\Controllers\Controller;
use App\Order_model\Profitorder;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class BikeOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
//dd($request);
        $validatedData = $request->validate([
            'customer_name' => 'required',
            'mobile' => 'required',
            'EngineNO' => 'required',
            'ChassisNo' => 'required',
            'cashpayment' => 'required',
            'vatamount' => 'required',
        ]);

        $model_common = new CommonModel();
        $sellinvoice =  $model_common->invoiceid_bike_order();
//dd($sellinvoice);
    $current = new Carbon();
    $crdate =  $current->format('d-m-Y');
    $userid = Auth::user()->id;
    $showroomdata = Cache::get("showroom");
    $showroomid = $showroomdata->id;

    $customer= new Bikecustomer();
    $customer ->bikesell_id=$request->bike_id;
    $customer ->customer_name=$request->customer_name;
    $customer ->guardian_name=$request->guardian_name;
    $customer ->address=$request->address;
    $customer ->mobile=$request->mobile;
    if ($request->has('guarantorname')){
        $customer ->guarantorname=$request->guarantorname;
    }
    if ($request->has('guarantor_address')){
        $customer ->guarantor_address=$request->guarantor_address;
    }
    if ($request->has('guarantor_mobile')){
        $customer ->guarantor_mobile=$request->guarantor_mobile;
    }

    $customer ->payment_type=$request->bikeselltype;

    $customer_image = $request->customer_image;

    if($request->hasFile('customer_image')){
        $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $x = str_shuffle($x);
        $x = substr($x, 0, 6) . '.PI_S.';
        $ImageFilename = time() . $x . $customer_image->getClientOriginalExtension();
        Image::make($customer_image->getRealPath())->resize(350, 400)->save(public_path('/Media/Registration_document/' . $ImageFilename));
        $customer ->customer_image=$ImageFilename;
    }

    $national_id = $request->national_id;

    if($request->hasFile('national_id')){
        $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $x = str_shuffle($x);
        $x = substr($x, 0, 6) . '.PI_S.';
        $ImageFilename = time() . $x . $national_id->getClientOriginalExtension();
        Image::make($national_id->getRealPath())->resize(600, 800)->save(public_path('/Media/Registration_document/' . $ImageFilename));
        $customer ->national_id=$ImageFilename;
    }
    $electric_bill = $request->electric_bill;

    if($request->hasFile('electric_bill')){
        $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $x = str_shuffle($x);
        $x = substr($x, 0, 6) . '.PI_S.';
        $ImageFilename = time() . $x . $electric_bill->getClientOriginalExtension();
        Image::make($electric_bill->getRealPath())->resize(600, 800)->save(public_path('/Media/Registration_document/' . $ImageFilename));
        $customer ->electric_bill=$ImageFilename;
    }

    $other_image = $request->other_image;

    if($request->hasFile('other_image')){
        $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $x = str_shuffle($x);
        $x = substr($x, 0, 6) . '.PI_S.';
        $ImageFilename = time() . $x . $other_image->getClientOriginalExtension();
        Image::make($other_image->getRealPath())->resize(600, 800)->save(public_path('/Media/Registration_document/' . $ImageFilename));
        $customer ->other_image=$ImageFilename;
    }
        $customer->save();

        $customer_id = $customer->id;


        $bikesell= new Bikesell();
        $bikesell ->invoice=$sellinvoice;
        $bikesell ->date=$crdate;
        $bikesell ->bikecustomer_id=$customer_id;
        $bikesell ->bike_id=$request->bike_id;
        $bikesell ->engine_no=$request->EngineNO;
        $bikesell ->ChassisNo=$request->ChassisNo;
        $bikesell ->paymentway=$request->paymentway;
        $bikesell ->bikedetails=$request->bikedetails;
        $bikesell ->bikesell_type=$request->bikeselltype;
        $bikesell ->sell_price=$request->bikesellprice;
        $bikesell ->discount=$request->discount;
        $bikesell ->last_total_amount=$request->bikelast_sell_amount;
        $bikesell ->cashpayment=$request->cashpayment;
        $bikesell ->interest=$request->interest_cash;
        $bikesell ->last_due_amount=$request->Interest_include_duelast;


        if ($request->has('ontimepay_date')){
            $ontimepay_date = date_format(date_create_from_format('Y-m-d', $request->ontimepay_date), 'd-m-Y');
            $bikesell ->onetime_payment_date=$ontimepay_date;
            $bikesell ->installmentno=1;
            $bikesell ->installmentamount=$request->Interest_include_duelast;
        }
        if ($request->has('installmentno')){
            $bikesell ->installmentno=$request->installmentno;
        }
        if ($request->has('installment_amount')){
            $bikesell ->installmentamount=$request->installment_amount;
        }
        if ($request->has('installment_payment_date')){
            $installment_payment_date = date_format(date_create_from_format('Y-m-d', $request->installment_payment_date), 'd-m-Y');
            $bikesell ->installment_start_date=$installment_payment_date;
        }
        $bikesell ->user_id=$userid;
        $bikesell->save();



        $payment= new Bikepayment();
        $payment ->payment_date=$crdate;
        $payment ->payment_type="Cash Payment";
        $payment ->bikecustomer_id=$customer_id;
        $payment ->bike_id=$request->bike_id;
        $payment ->Pay_amount=$request->cashpayment;
        $payment ->bankdetails=$request->bankdetails;
        $payment ->carddetails=$request->carddetails;
        $payment ->mobilebankdetails=$request->mobilebankdetails;
        $payment ->user_id=$userid;
        $payment->save();



        $totalamountvat = $request->vatamount + @$request->registrationamount;


        $regist= new Registration();

        if ($request->DeliveryDate !=null){
            $DeliveryDate = date_format(date_create_from_format('Y-m-d', $request->DeliveryDate), 'd-m-Y');
            $regist ->delivery_date=$DeliveryDate;
            $regist ->due_amount=$request->registrationdue;
        }
        $regist ->registrationamount=$request->registrationamount;
        $regist ->registrationtype=$request->registrationtype;
        $regist ->bikecustomer_id=$customer_id;
        $regist ->bike_id=$request->bike_id;
        $regist ->vatamount=$request->vatamount;
        $regist ->total_amount=$totalamountvat;
        $regist ->payment=$request->payment;
        $regist ->status=0;
        $regist->save();

        $totalrecive = $request->cashpayment +$totalamountvat;

        $cost= new Recivecash();
        $cost->invoice_no = $sellinvoice;
        $cost->showroom_id = $showroomid;
        $cost->customer_id = $customer_id;
        $cost->received = $totalrecive;
        $cost->received_date = $crdate;
        $cost->user_id = $userid;
        $cost->save();


        if ($request->bikeselltype =="Onetime"){
            $ontimepaydate = date_format(date_create_from_format('Y-m-d', $request->ontimepay_date), 'd-m-Y');
            $install= new Installment();
            $install ->payment_date=$ontimepaydate;
            $install ->bikecustomer_id=$customer_id;
            $install ->bike_id=$request->bike_id;
            $install ->installment_no=1;
            $install ->installment_amount=$request->Interest_include_duelast;
            $install ->pay_amount=0;
            $install ->interest=0;
            $install ->blanch=$request->Interest_include_duelast;
            $install ->status=0;
            $install->save();
        }else if ($request->bikeselltype =="Installment"){
            $installmentno = $request->installmentno;

            for ($i = 1; $i <= $installmentno; $i++){
                $time = strtotime($request->installment_payment_date);
                $final = date("Y-m-d", strtotime("+$i month", $time));
                $installment_date = date_format(date_create_from_format('Y-m-d', $final), 'd-m-Y');
              // dd($installment_date);

                $install= new Installment();
                $install ->payment_date=$installment_date;
                $install ->bikecustomer_id=$customer_id;
                $install ->bike_id=$request->bike_id;
                $install ->installment_no=$i;
                $install ->installment_amount=$request->installment_amount;
                $install ->pay_amount=0;
                $install ->interest=0;
                $install ->blanch=$request->installment_amount;
                $install ->status=0;
                $install->save();
            }

        }

        $identity_id = $request->identity_id;
        Bikeidentity::where('id', $identity_id)->delete();


        $bikepurchesdata = Bikepurchase::where('bike_id',$request->bike_id)->first();
        $buyprice = $bikepurchesdata->buy_price;
        $commision = $bikepurchesdata->commission;
        $actual_buy = $buyprice - $commision;
        $sellprice = $request->bikelast_sell_amount;

        $restdata= new Profitorder();
        $restdata['invoice_no']=$sellinvoice;
        $restdata['product_id']=$request->bike_id;
        $restdata['purchase_id']=$sellinvoice;
        $restdata['showroom_id']=$showroomid;
        $restdata['buy_price']= $actual_buy;
        $restdata['sell_price']=$sellprice;
        $restdata['quantity']=1;
        $restdata['total_buy_amount']=$actual_buy;
        $restdata['total_sell_amount']= $sellprice;
        $restdata['selldate']=$crdate;
        $restdata->save();


        $stoke = $bikepurchesdata->rest_qty;
        $data_id = $bikepurchesdata->id;
        $lastqty = $stoke - 1;

        $data = Bikepurchase::find($data_id);
        $data['rest_qty']=$lastqty;
        $data->save();

        $notification=array(
            'messege'=>'Successfully Bike Sell!',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
