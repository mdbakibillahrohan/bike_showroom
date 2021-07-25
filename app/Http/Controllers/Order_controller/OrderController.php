<?php

namespace App\Http\Controllers\Order_controller;

use App\Accounts_model\CashReciveDetails;
use App\Accounts_model\Recivecash;
use App\Admin_model\Barcode;
use App\Admin_model\CommonModel;
use App\Admin_model\CustomerAccount;
use App\Admin_model\Customerpayment;
use App\Http\Controllers\Controller;
use App\Order_model\Order;
use App\Order_model\Profitorder;
use App\Order_model\Returnorder;
use App\Product_model\Product;
use App\Product_model\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $userid = Auth::user()->id;
        $showroomdata = Cache::get("showroom");
        $showroomid = $showroomdata->id;

        $requested_data = $request->requested_data;
        $someArray = $requested_data;
        $order_array_count =  count($someArray);
        $sellingdate = date_format(date_create_from_format('Y-m-d', $request->sellingdate), 'd-m-Y');

        $customerid = $request->customerid;
        $sell_cost = $request->sell_cost;
        $discount_amount = $request->discount_amount;
        $paymentrecive = $request->cash_payment;
        $sell_amount_total = $request->totalsubtotal_data;
        $return_amount = $request->return_amount;
        $return_id = $request->return_id;

        $cash_payment = str_replace('-', '', $paymentrecive);

        if ($return_amount !=""){
            $returnamount = $return_amount / $order_array_count;
            $data=array();
            $data['return_status']="1";
            DB::table('returnorders')->where('return_invoice',$return_id)->update($data);
        }else{
            $returnamount =0;
        }

        if ($sell_cost !=""){
            $single_array_cost = $sell_cost / $order_array_count;
        }else{
            $single_array_cost = 0;
        }
        //round(520.34345, 2);
        if ($discount_amount !=""){
            $single_array_discount = $discount_amount / $order_array_count;
        }else{
            $single_array_discount = 0;
        }
        $model_common = new CommonModel();
        $newinvoice =  $model_common->invoicenoid_order();

        foreach ($someArray as $key => $value) {
            $product_id         = $value["product_id"];
            $singlesub_total    = $value["singlesub_total"];
            $sellprice          = $value["sellprice"];
            $quntity_valu       = $value["quntity_valu"];
            $productdetails     = $value["product_details"];
            $productbercode     = $value["bercode"];
            $symboledata        = @$value["symboledata"];

            $product_details = Product::where('id',$product_id)->first();

            $model_common = new CommonModel();
            $productbuyprice =  $model_common->buypricecheck($product_id, $showroomid,$quntity_valu,$symboledata);

            $buypricenew = [];
            $tacProduct = [];
            foreach ($productbuyprice as $buydata){
                $buypricenew[] = $buydata['buy_price'];
                $tacProduct[] = [
                    'data_id' => $buydata['pd_id'], // product id
                    'tac_qty' => $buydata['tec_qty'], // value minus korsy
                    'tac_buy_price' => $buydata['buy_price'], // product buy price
                    'restn' => $buydata['rest'], // update table product qty
                    'tec_qtylast' => $buydata['tec_qtylast'] // update table product qty
                ];


            }
           /// print_r($tacProduct);

            foreach ($tacProduct as $v1 =>$val) {
                $buypricepost =  $val['tac_buy_price'];
                $tac_qty =  $val['tac_qty'];
                $data_id =  $val['data_id'];
                $sell_qty_last =  $val['restn'];
                $qty_last =  $val['tec_qtylast'];

                if ( $tac_qty > 0){
                    $qt_val = $sell_qty_last;
                    $totalBuy = $buypricepost * $qt_val;
                    $totalSell = $sellprice * $qt_val;
                    $restqtydata = 0;
                    $status_perch = "0";
                }else{
                    $qt_val =  $qty_last;
                    $totalBuy = $buypricepost * $qt_val;
                    $totalSell = $sellprice * $qt_val;
                    $restqtydata = $sell_qty_last - $qty_last;
                    $status_perch = "1";
                }

                $restdata= new Profitorder();
                $restdata['invoice_no']=$newinvoice;
                $restdata['product_id']=$product_id;
                $restdata['purchase_id']=$data_id;
                $restdata['showroom_id']=$showroomid;
                $restdata['buy_price']= $buypricepost;
                $restdata['sell_price']=$sellprice;
                $restdata['quantity']=$qt_val;
                $restdata['total_buy_amount']=$totalBuy;
                $restdata['total_sell_amount']= $totalSell;
                $restdata['selldate']=$sellingdate;
                $restdata->save();

                $restbuy_amount = $restqtydata * $buypricepost;

                $data = Purchase::find($data_id);
                $data['rest_qty']=$restqtydata;
                $data['rest_buy_amount']=$restbuy_amount;
                $data['status']=$status_perch;
                $data->save();
            } // profit foreach
            $single_totalsell = $sellprice * $quntity_valu;
            $lastsell_amount = $single_totalsell - $single_array_discount + $single_array_cost;

            $data= new Order();
            $data['invoice_no']=$newinvoice;
            $data['customer_id']=$customerid;
            $data['showroom_id']=$showroomid;
            $data['product_id']=$product_id;
            $data['product_details']=$productdetails;
            $data['category_id']=$product_details->categorie_id;
            $data['sub_category']=$product_details->subcategorie_id;
            $data['brand_id']=$product_details->brand_id;
            $data['product_code']=$productbercode;
            $data['sellprice']=$sellprice;
            $data['quantity']=$quntity_valu;
            $data['total_sellprice']=$single_totalsell;
            $data['sell_discount']=$single_array_discount;
            $data['sell_cost']=$single_array_cost;
            $data['lastsell_amount']=$lastsell_amount;
            $data['attribute']=$symboledata;
            $data['vat']=0;
            $data['return_cash']=$returnamount;
            $data['return_invoice']=$return_id;
            $data['selldate']=$sellingdate;
            $data['user_id']=$userid;
            $data->save();

            $barcodedata = Barcode::where('barcode',$productbercode)->first();

            $productstoke = Purchase::where('id', $barcodedata->purchase_id)
                ->select('product_id','attribute', DB::raw('SUM(rest_qty) as restqty '))
                ->groupBy(['product_id','attribute'])
                ->first();

            $restqty_last = $productstoke->restqty;

            if ($barcodedata->code_type==1){
                Barcode::where('barcode',$productbercode)->delete();
            }else{
                if ($restqty_last==0){
                    Barcode::where('barcode',$productbercode)->delete();
                }
            }

            if ($restqty_last==0){
                $data = Product::find($product_id);
                $data['status']="0";
                $data->save();
            }



        } // end foreach

        $lastbalanch_customer = $request->pay_lase_lastbalanch;

        if ($lastbalanch_customer > 0){
            $status = 0;
        }else if($lastbalanch_customer < 0){
            $status = 1;
        }else{
            $status = 1;
        }

        if($paymentrecive > 0){

            $payment = new Customerpayment();
            $payment->invoice_no = $newinvoice;
            $payment->customer_id = $customerid;
            $payment->showroom_id = $showroomid;
            $payment->pay_amount = $cash_payment;
            $payment->payment_way = "Cash";
            $payment->money_receipt = 0;
            $payment->payment_date = $sellingdate;
            $payment->status = $status;
            $payment->make_by = $userid;
            $payment->save();

            $cost= new Recivecash();
            $cost->invoice_no = $newinvoice;
            $cost->showroom_id = $showroomid;
            $cost->customer_id = $customerid;
            $cost->received = $cash_payment;
            $cost->received_date = $sellingdate;
            $cost->user_id = $userid;
            $cost->save();

            $data = new CustomerAccount();
            $data['customer_id']=$customerid;
            $data['showroom_id']=$showroomid;
            $data['invoice_id']=$newinvoice;
            $data['accounts']=$request->pay_lase_lastbalanch;
            $data['status']=$status;
            $data->save();

        }else if ($paymentrecive < 0){

            $payment = new Customerpayment();
            $payment->invoice_no = $newinvoice;
            $payment->customer_id = $customerid;
            $payment->showroom_id = $showroomid;
            $payment->pay_amount = $returnamount;
            $payment->payment_way = "Return Order";
            $payment->money_receipt = 0;
            $payment->payment_date = $sellingdate;
            $payment->status = "1";
            $payment->make_by = $userid;
            $payment->save();

            $data = new CustomerAccount();
            $data['customer_id']=$customerid;
            $data['showroom_id']=$showroomid;
            $data['invoice_id']=$newinvoice;
            $data['accounts']=$request->pay_lase_lastbalanch;
            $data['status']=$status;
            $data->save();
        }else{
            $payment = new Customerpayment();
            $payment->invoice_no = $newinvoice;
            $payment->customer_id = $customerid;
            $payment->showroom_id = $showroomid;
            $payment->pay_amount = $returnamount;
            $payment->payment_way = "Return Order";
            $payment->money_receipt = 0;
            $payment->payment_date = $sellingdate;
            $payment->status = "1";
            $payment->make_by = $userid;
            $payment->save();

            $data = new CustomerAccount();
            $data['customer_id']=$customerid;
            $data['showroom_id']=$showroomid;
            $data['invoice_id']=$newinvoice;
            $data['accounts']=$request->pay_lase_lastbalanch;
            $data['status']=$status;
            $data->save();
        }



        if ($request->note_input !=""){
            $restdata= new CashReciveDetails();
            $restdata['invoice_id']=$newinvoice;
            $restdata['note_input']=$request->note_input;
            $restdata['return_show']=$request->return_show;
            $restdata['date']=$sellingdate;
            $restdata->save();
        }


        return response()->json(array("status"=>"success","invoice"=>$newinvoice));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $orderdata = Order::where('invoice_no',$id)->first();

        if ($orderdata !=null){
            $InvoicePurchase = Order::where('invoice_no',$id)->get();

            $customerpayment = Customerpayment::where('invoice_no',$id)
                ->where('payment_date',$orderdata->selldate)
                ->first();

            $customer_invoice = CustomerAccount::where('customer_id',$orderdata->customer_id)->get();

            for ($i = 1; $i < count($customer_invoice); $i++){
                if ($customer_invoice[$i]->invoice_id==$id){
                    $pre_invoice = $customer_invoice[$i-1]->invoice_id;
                }
            }
            $previus_invoice = CustomerAccount::where('invoice_id',$pre_invoice)->first();

            $last_invoice = CustomerAccount::where('invoice_id',$id)->orderBy('id','DESC')->first();


            return view('Order_page.SingleInvoiceDetails', compact('orderdata','previus_invoice','last_invoice','customerpayment','InvoicePurchase'));

        }else{
            return redirect()->back();
        }


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
        // id meen invoice id

        $orderdata = Order::where('invoice_no', $id)->get();

        foreach ($orderdata as $data){
            $order[] = array(
                'orderid' => $data['id'],
                'product_code' => $data['product_code'],
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
                'lastsell_amount' => $data['lastsell_amount'],
            );
            $purchesdata = Purchase::where('product_id', $data['product_id'])->get();
            foreach ($purchesdata as $pdata){
                $purches[] = array(
                    'product_id' => $pdata['product_id'],
                    'buy_price' => $pdata['buy_price'],
                    'rest_qty' => $pdata['rest_qty'],
                    'rest_buy_amount' => $pdata['rest_buy_amount'],
                );
            }
        }


        for ($i = 0; $i < count($order); $i++){
            $productid = $order[$i]['product_id'];
            $quantity = $order[$i]['quantity'];
            $orderid = $order[$i]['orderid'];
            $code = $order[$i]['product_code'];

            $barcodedat = Barcode::where('barcode',$code)->first();
            $purcheshdata = Purchase::where('product_id',$productid)->first();

            if ($barcodedat==null){
                $barcode= new Barcode();
                $barcode['purchase_id']=$purcheshdata->id;
                $barcode['product_id']=$productid;
                $barcode['invoice_no']=$id;
                $barcode['showroom_id']=$purcheshdata->showroom_id;
                $barcode['barcode']=$code;
                $barcode['code_type']=1;
                $barcode->save();
            }

            $buy_price = $purches[$i]['buy_price'];
            $rest_qty = $purches[$i]['rest_qty'];
            $rest_buy_amount = $purches[$i]['rest_buy_amount'];

            $totalbuyamount = $quantity * $buy_price;
            $lastrestbuyamount = $totalbuyamount + $rest_buy_amount;
            $lastrestquantity = $quantity + $rest_qty;
            $status = "1";

            $data = array();
            $data['rest_qty']=$lastrestquantity;
            $data['rest_buy_amount']=$lastrestbuyamount;
            $data['status']=$status;
            DB::table('purchases')->where('product_id',$productid)->update($data);

            Order::where('id', $orderid)->delete();
        }

        Recivecash::where('invoice_no',$id)->delete();
        Customerpayment::where('invoice_no',$id)->delete();
        CustomerAccount::where('invoice_id',$id)->delete();
        Profitorder::where('invoice_no',$id)->delete();


        $notification=array(
            'messege'=>'Successfully Sell Order Deleted',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
