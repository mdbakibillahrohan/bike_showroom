<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Accounts_model\Recivecash;
use App\Admin_model\Customer;
use App\Admin_model\CustomerAccount;
use App\Admin_model\Customerpayment;
use App\Http\Controllers\Controller;
use App\Order_model\Order;
use App\Product_model\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
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
        $validatedData = $request->validate([
            'customer_name' => 'required',
            'mobile' => 'required'
        ]);


        $path = Cache::get("showroom");
        $showroom_id = $path->id;

        $data= new Customer();
        $data['customer_name']=$request->customer_name;
        $data['showroom_id']=$showroom_id;
        $data['address']=$request->address;
        $data['mobile']=$request->mobile;
        $data->save();
        $customerid = $data->id;

        if ($request->previus_ledger > 0){
            $status = "0";
        }else{
            $status = "1";
        }

        $account = new CustomerAccount();
        $account['customer_id']=$customerid;
        $account['showroom_id']=$showroom_id;
        $account['invoice_id']=101;
        $account['accounts']=$request->previus_ledger;
        $account['status']= $status;
        $account->save();

        $notification=array(
            'messege'=>'Customer Added Successfully',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customerData = Customer::find($id);
        $customerAccount = CustomerAccount::where('customer_id',$id)->orderBy('id','DESC')->first();
        $customerFirstAccount = CustomerAccount::where('customer_id',$id)->first();
        $totalsell = Order::where('customer_id',$id)
        ->select('customer_id', DB::raw('SUM(lastsell_amount) as lastsell_amount'))
        ->groupBy('customer_id')
        ->first();

        if($totalsell==null){
            return redirect()->back();
        }
        $totalpayment = Customerpayment::where('customer_id',$id)
            ->select('customer_id', DB::raw('SUM(pay_amount) as pay_amount'))
            ->groupBy('customer_id')
            ->first();
        $orderdata = Order::where('customer_id',$id)->get()->toArray();
        $payment = Customerpayment::where('customer_id',$id)->get()->toArray();

        $datam = array_merge($orderdata, $payment);

        if($datam!=NULL) {

            foreach ($datam as $datas) {

                $dateastime = strtotime($datas['created_at']);

                if (@$datas['total_sellprice']) {
                    $particular = "Buy";
                } elseif (@$datas['pay_amount']) {
                    $particular = "Payment";
                }else {
                    $particular = "-";
                }

                $sellpayrecord[] = array(
                    'id' => $dateastime,
                    'invoice_no' => $datas['invoice_no'],
                    'particular' => $particular,
                    'lastsell_amount' => @$datas['lastsell_amount'],
                    'pay_amount' => @$datas['pay_amount'],
                    'customer_id' => @$datas['customer_id'],
                    'product_id' => @$datas['product_id'],
                    'payment_date' => @$datas['payment_date'],
                );

            }//end of foreach
            asort($sellpayrecord);

            $ser = 	0;
            foreach($sellpayrecord as $newdata){
                $particular = $newdata['particular'];
                $payment_date = $newdata['payment_date'];

                if($particular=="Buy"){
                    $amount = $newdata['lastsell_amount'] ;

                }elseif($particular=="Payment"){
                    $amount = $newdata['pay_amount'];
                }else{
                    $amount= "";
                }
                $particular = $newdata['particular'];


                $orderarry = Order::where('customer_id',$newdata['customer_id'])->where('product_id',$newdata['product_id'])->first();

                $nameproduct = Product::where('id',$newdata['product_id'])->first();

                $record[$ser] = array(
                    'invoice_no'=>$newdata['invoice_no'],
                    'customer_id'=>$newdata['customer_id'],
                    'particular'=>$particular,
                    'amount'=>$amount,
                    'payment_date'=>$payment_date,
                    'serial'=>$ser,
                    'selldate'=>@$orderarry->selldate,
                    'product_id'=>@$nameproduct->product_name,
                    'quantity'=>@$orderarry->quantity,
                    'sell_discount'=>@$orderarry->sell_discount,
                    'sell_cost'=>@$orderarry->sell_cost,
                    'lastsell_amount'=>@$orderarry->lastsell_amount,
                    'sellprice'=>@$orderarry->sellprice,
                );
                $ser++;
            }

        }
        $customerdetails_qml = array($customerData, $customerAccount, $totalsell, $totalpayment,$record, $customerFirstAccount);
        Cache::set("Customer_sum_Calculation", $customerdetails_qml);

            return view('Customer.CustomerDetails', compact('customerData','customerAccount','totalsell','totalpayment','record','customerFirstAccount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('customers')
            ->select('customers.*','customer_accounts.accounts','customer_accounts.id as account_id')
            ->join('customer_accounts','customer_accounts.customer_id','customers.id')
            ->where('customers.id',$id)
            ->first();
        return response()->json($data);
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
        $data= Customer::find($id);
        $data['customer_name']=$request->name;
        $data['address']=$request->address;
        $data['mobile']=$request->mobile;
        $data->save();

        if ($request->previus_ledger > 0){
            $status = "0";
        }else{
            $status = "1";
        }

        $account = CustomerAccount::find($request->account_id);
        $account['accounts']=$request->previus_ledger;
        $account['status']= $status;
        $account->save();

        $notification=array(
            'messege'=>'Customer Update Successfully',
            'alert-type'=>'success'
        );
        return back()->with($notification);
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

    public function CustomerPaymentSubmit(Request $request)
    {
        $userid = Auth::user()->id;

        $paymentdata = Customerpayment::where('id',$request->invoice_id)->first();
        $payment_date = date_format(date_create_from_format('Y-m-d', $request->paymentdate), 'd-m-Y');
        $recivecash = str_replace('-', '', $request->newpay);

        if ($request->lastbalanch > 0){
            $status = "0";
        }else{
            $status = "1";
        }

        $account = new CustomerAccount();
        $account['customer_id']=$request->customer_id;
        $account['showroom_id']=$request->showroom_id;
        $account['invoice_id']=$paymentdata->invoice_no;
        $account['accounts']=$request->lastbalanch;
        $account['status']= $status;
        $account->save();

        $payment = new Customerpayment();
        $payment->invoice_no = $paymentdata->invoice_no;
        $payment->customer_id = $request->customer_id;
        $payment->showroom_id = $request->showroom_id;
        $payment->pay_amount = $recivecash;
        $payment->payment_way = $request->paymentway;
        $payment->money_receipt = $request->reciptno;
        $payment->payment_date = $payment_date;
        $payment->status = $status;
        $payment->make_by = $userid;
        $payment->save();



        $cost= new Recivecash();
        $cost->invoice_no = $paymentdata->invoice_no;
        $cost->showroom_id = $request->showroom_id;
        $cost->customer_id = $request->customer_id;
        $cost->received = $recivecash;
        $cost->received_date = $payment_date;
        $cost->user_id = $userid;
        $cost->save();

        $update = Customerpayment::find($request->invoice_id);
        $update->status=$status;
        $update->save();

        $notification=array(
            'messege'=>'Customer Payment Added Successfully',
            'alert-type'=>'success'
        );
        return back()->with($notification);



    }
}
