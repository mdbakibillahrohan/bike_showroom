<?php

namespace App\Http\Controllers\Order_controller;

use App\Accounts_model\Purchasecost;
use App\Accounts_model\Recivecash;
use App\Admin_model\CommonModel;
use App\Admin_model\CustomerAccount;
use App\Admin_model\Customerpayment;
use App\Http\Controllers\Controller;
use App\Order_model\Order;
use App\Order_model\Returnorder;
use App\Product_model\Product;
use App\Product_model\Purchase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ReturnController extends Controller
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $showroomdata = Cache::get("showroom");
        $showroomid = $showroomdata->id;

        $requesteddata = $request->requested_data;
        $checkvalue = $request->checkvalue;
        $returorder_amount = $request->subtotal_data;
        $deductpay = $request->deductpay;
        $returndate = date_format(date_create_from_format('Y-m-d', $request->returndate), 'd-m-Y');
        $customer_last_balanch = $request->lastbalanch;
        $customerid = $request->customerid;

        $return_amount_last = $returorder_amount - $deductpay;

        $userid = Auth::user()->id;

        if ($checkvalue==1){
            $status = 1;
        }else{
            $status = 0;
        }

        $model_common = new CommonModel();
        $invoice_return =  $model_common->returninvoiceproduct();

        $model_common = new CommonModel();
        $purchesh_invoice =  $model_common->invoicenoid();

        $array = count($requesteddata);
        if ($deductpay){
            $paylase = $deductpay / $array;
        }else{
            $paylase = 0;
        }

        $someArray = $requesteddata;
        foreach ($someArray as $key => $value) {
            $orderid = $value["orderid"];
            $sellinvoice = $value["sellinvoice"];
            $newprice = $value["newprice"];
            $qty = $value["qty"];
            $subtotal = $value["subtotal"];
            $product_id = $value["product_id"];
            $laseamount = $subtotal - $paylase;


            $data= new Returnorder();
            $data['order_id']=$orderid;
            $data['return_invoice']=$invoice_return;
            $data['sell_invoice']=$sellinvoice;
            $data['customer_id']=$customerid;
            $data['product_id']=$product_id;
            $data['showroom_id']= $showroomid;
            $data['sellprice']=$newprice;
            $data['quantity']=$qty;
            $data['amount']=$subtotal;
            $data['deducted']=$paylase;
            $data['return_cash']=$laseamount;
            $data['return_status']=$status;
            $data['date']=$returndate;
            $data['user_id']=$userid;
            $data->save();

            $purcheshdata = Purchase::where('product_id',$product_id)->first();
            $tupe = $purcheshdata->product_type;

            $data = new Purchase();
            $data['invoice_no']=$purchesh_invoice;
            $data['product_id']=$product_id;
            $data['product_type']=$tupe;
            $data['buy_price']=$newprice;
            $data['quantity']=$qty;
            $data['sub_total_buy']=$subtotal;
            $data['buy_cost']=0;
            $data['discount']=$paylase;
            $data['actual_buy']=$laseamount;
            $data['rest_qty']=$qty;
            $data['rest_buy_amount']=$laseamount;
            $data['sell_price']=$purcheshdata->sell_price;
            $data['showroom_id']=$showroomid;
            $data['supplier_id']=$purcheshdata->supplier_id;
            $data['makeby']=$userid;
            $data['purchase_date']=$returndate;
            $data['purchase_type']="0";
            $data->save();
        }


        if ($checkvalue==1) {
            $customerpayment = Customerpayment::where('customer_id',$customerid)
                ->where('status','0')
                ->orderBy('invoice_no','DESC')
                ->first();

            if ($return_amount_last > 0){
                $status = 0;
            }else if($return_amount_last < 0){
                $status = 1;
            }else{
                $status = 1;
            }

            $payment = new Customerpayment();
            $payment->invoice_no = $customerpayment->invoice_no;
            $payment->customer_id = $customerid;
            $payment->showroom_id = $showroomid;
            $payment->pay_amount = $return_amount_last;
            $payment->payment_way = "Return Order";
            $payment->money_receipt = 0;
            $payment->payment_date = $returndate;
            $payment->status = $status;
            $payment->make_by = $userid;
            $payment->save();

            if ($customer_last_balanch > 0){
                $status = 0;
            }else if($return_amount_last < 0){
                $status = 1;
            }else{
                $status = 1;
            }

            $data = new CustomerAccount();
            $data['customer_id'] = $customerid;
            $data['showroom_id'] = $showroomid;
            $data['invoice_id'] = $customerpayment->invoice_no;
            $data['accounts'] = $customer_last_balanch;
            $data['status'] = $status;
            $data->save();
        }

        return response()->json(array("status"=>"success","invoice"=>$invoice_return));
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
        $showroomdata = Cache::get("showroom");
        $showroomid = $showroomdata->id;
        $userid = Auth::user()->id;
        $returntype = $request->returntype;
        $current = new Carbon();
        $orderdate =  $current->format('d-m-Y');

        $returnorderdata = Returnorder::where('id',$id)->first();

        if ($returntype==1){
            $cost= new Purchasecost();
            $cost['supplier_pay_id']=$id;
            $cost['cost_reson']="Product Return";
            $cost['cost_amount']=$returnorderdata->return_cash;
            $cost['showroom_id']=$showroomid;
            $cost['user_id']=$userid;
            $cost['date']=$orderdate;
            $cost->save();

            $data= Returnorder::find($id);
            $data['return_status']="1";
            $data->save();
        }else{
            $data= Returnorder::find($id);
            $data['return_status']="1";
            $data->save();
        }
        $notification=array(
            'messege'=>'Successfully Return Order Update!',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);


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
