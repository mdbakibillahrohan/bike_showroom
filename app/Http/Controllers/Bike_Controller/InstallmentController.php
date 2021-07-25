<?php

namespace App\Http\Controllers\Bike_Controller;

use App\Accounts_model\Recivecash;
use App\Bike_Model\Bikecustomer;
use App\Bike_Model\Bikepayment;
use App\Bike_Model\Bikesell;
use App\Bike_Model\Installment;
use App\Bike_Model\Registration;
use App\Http\Controllers\Controller;
use App\Order_model\Profitorder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class InstallmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index($id)
    {
        $totalinstallment = Installment::where('bikecustomer_id',$id)->get();
        $customerdetails = Bikecustomer::where('id',$id)->first();
        $bikedetails = Bikesell::where('bikecustomer_id',$id)->first();

        $installment = Installment::where('bikecustomer_id', $id)
            ->select('bikecustomer_id', DB::raw('SUM(blanch) as blanch '))
            ->groupBy('bikecustomer_id')
            ->first();

        return view('Bike_Section.Bike_order.customer_installment_view',compact('totalinstallment','customerdetails','bikedetails','installment'));

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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $current = new Carbon();
        $crdate =  $current->format('d-m-Y');
        $userid = Auth::user()->id;

        $showroomdata = Cache::get("showroom");
        $showroomid = $showroomdata->id;

        $customerid = $request->customerid;
        $payment_inv = $request->payment_inv;

        $payment= new Bikepayment();
        $payment ->payment_date=$crdate;
        $payment ->payment_type="Installment";
        $payment ->bikecustomer_id=$customerid;
        $payment ->bike_id=$request->bikeid;
        $payment ->Pay_amount=$request->payment_inv;
        $payment ->user_id=$userid;
        $payment->save();

        $alldata = Installment::where('bikecustomer_id',$customerid)->where('status',0)->get();
        $selldata = Bikesell::where('bikecustomer_id',$customerid)->first();

        $interest = $selldata->interest;
        $emino = $selldata->installmentno;
        $interestcash = $interest / $emino;

        $amount = $payment_inv;
        for ($i=0; $i <= count($alldata); $i++){

            if($amount == $alldata[$i]->blanch){
                $status = "1";
                $blanch = "0";
                $saveid = $alldata[$i]->id;
                $install = Installment::find($saveid);
                $install->install_paydate = $crdate;
                $install->pay_amount = $amount;
                $install->interest = $interestcash;
                $install->blanch = 0;
                $install->status = $status;
                $install->save();
                break;
            }elseif ($amount < $alldata[$i]->blanch){
                $blanch = $alldata[$i]->blanch - $amount;
                $status = "1";
                $saveid = $alldata[$i]->id;
                $install = Installment::find($saveid);
                $install->install_paydate = $crdate;
                $install->pay_amount = $amount;
                $install->interest = $interestcash;
                $install->blanch = $blanch;
                $install->status = $status;
                $install->save();

                $d = $i + 1;
                $saveid =  $alldata[$d]->id;
                $install= Installment::find($saveid);
                $install ->blanch=$alldata[$i]->blanch + $blanch;
                $install->save();
                break;
            }elseif ($amount > $alldata[$i]->blanch){

                $status = "1";
                $saveid = $alldata[$i]->id;
                $install = Installment::find($saveid);
                $install->install_paydate = $crdate;
                $install->pay_amount = $amount;
                $install->interest = $interestcash;
                $install->blanch = 0;
                $install->status = $status;
                $install->save();

                $advance = $amount;
                for ($x=$i; $x < count($alldata); $x++){
                    if($advance == $alldata[$x]->blanch){
                        $saveid = $alldata[$x]->id;
                        $install = Installment::find($saveid);
                        $install->blanch = 0;
                        $install->install_paydate = $crdate;
                        $install->interest = $interestcash;
                        $install->status = $status;
                        $install->save();
                        break;
                    }elseif ($advance > $alldata[$x]->blanch){
                        $saveid = $alldata[$x]->id;
                        $install = Installment::find($saveid);
                        $install->blanch = 0;
                        $install->install_paydate = $crdate;
                        $install->interest = $interestcash;
                        $install->status = $status;
                        $install->save();
                    }else{
                        $saveid = $alldata[$x]->id;
                        $install = Installment::find($saveid);
                        $install->blanch = $alldata[$x]->blanch - $advance;
                        $install->status = 0;
//                        $install->install_paydate = $crdate;
//                        $install->interest = $interestcash;
                        $install->save();
                        break;
                    }

                    if (count($alldata) != $x) {
                        $advance = $advance - $alldata[$x]->blanch;
                    }

                }
                break;
            }


        }

        $cost= new Recivecash();
        $cost->invoice_no = $selldata->invoice;
        $cost->showroom_id = $showroomid;
        $cost->customer_id = $customerid;
        $cost->received = $payment_inv;
        $cost->received_date = $crdate;
        $cost->user_id = $userid;
        $cost->save();


        $restdata= new Profitorder();
        $restdata['invoice_no']=$selldata->invoice;
        $restdata['product_id']=$selldata->bike_id;
        $restdata['purchase_id']=$selldata->id;
        $restdata['showroom_id']=$showroomid;
        $restdata['buy_price']= 0;
        $restdata['sell_price']=$interestcash;
        $restdata['quantity']=1;
        $restdata['total_buy_amount']=0;
        $restdata['total_sell_amount']= $interestcash;
        $restdata['selldate']=$crdate;
        $restdata->save();

        $notification=array(
            'messege'=>'Successfully Payment Added !',
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

    public function installmentprint($id)
    {
        $totalinstallment = Installment::where('bikecustomer_id',$id)->get();
        $customerdetails = Bikecustomer::where('id',$id)->first();
        $bikedetails = Bikesell::where('bikecustomer_id',$id)->first();

        $installment = Installment::where('bikecustomer_id', $id)
            ->select('bikecustomer_id', DB::raw('SUM(blanch) as blanch '))
            ->groupBy('bikecustomer_id')
            ->first();

        return view('Bike_Section.Bike_order.installment_details_print',compact('totalinstallment','customerdetails','bikedetails','installment'));
    }

    public function CustomerViewDetails($id)
    {
        $customerdata = Bikecustomer::where('id',$id)->first();
        $purchesh = Bikesell::where('bikecustomer_id',$id)->first();
        $registration = Registration::where('bikecustomer_id',$id)->first();
        return view('Bike_Section.Bike_order.Bikecustomer_View_Details',compact('customerdata','purchesh','registration'));
    }


}
