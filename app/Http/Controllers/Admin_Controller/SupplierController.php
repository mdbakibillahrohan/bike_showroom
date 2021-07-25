<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Accounts_model\Purchasecost;
use App\Admin_model\Supplier;
use App\Admin_model\SupplierAccount;
use App\Admin_model\Supplierpayment;
use App\Http\Controllers\Controller;
use App\Product_model\Product;
use App\Product_model\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
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
            'suplier_name' => 'required',
            'mobile' => 'required'
        ]);

        $path = Cache::get("showroom");
        $showroom_id = $path->id;

        $data= new Supplier();
        $data['suplier_name']=$request->suplier_name;
        $data['showroom_id']=$showroom_id;
        $data['address']=$request->address;
        $data['mobile']=$request->mobile;
        $data->save();
        $suplierid = $data->id;


        if ($request->previus_ledger > 0){
            $status = "1";
        }else{
            $status = "0";
        }

        $account = new SupplierAccount();
        $account['supplier_id']=$suplierid;
        $account['showroom_id']=$showroom_id;
        $account['invoice_id']=101;
        $account['accounts']=$request->previus_ledger;
        $account['status']= $status;
        $account->save();

        $notification=array(
            'messege'=>'Supplier Added Successfully',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $supplierData = Supplier::find($id);
        $supplierAccount = SupplierAccount::where('supplier_id',$id)->orderBy('id','DESC')->first();
        $supplierFirstAccount = SupplierAccount::where('supplier_id',$id)->first();
        $totalbuy = Purchase::where('supplier_id',$id)
            ->select('supplier_id', DB::raw('SUM(actual_buy) as actual_buy'))
            ->groupBy('supplier_id')
            ->first();
        $totalpayment = Supplierpayment::where('supplier_id',$id)
            ->select('supplier_id', DB::raw('SUM(pay_amount) as pay_amount'))
            ->groupBy('supplier_id')
            ->first();
        $purchasedata = Purchase::where('supplier_id',$id)->get()->toArray();
        $payment = Supplierpayment::where('supplier_id',$id)->get()->toArray();

        $datam = array_merge($purchasedata, $payment);

        if($datam!=NULL) {

            foreach ($datam as $datas) {

                $dateastime = strtotime($datas['created_at']);

                if (@$datas['actual_buy']) {
                    $particular = "Buy";
                } elseif (@$datas['pay_amount']) {
                    $particular = "Payment";
                }else {
                    $particular = "-";
                }

                $buypayrecord[] = array(
                    'id' => $dateastime,
                    'invoice_no' => $datas['invoice_no'],
                    'particular' => $particular,
                    'actual_buy' => @$datas['actual_buy'],
                    'pay_amount' => @$datas['pay_amount'],
                    'supplier_id' => @$datas['supplier_id'],
                    'product_id' => @$datas['product_id'],
                    'payment_date' => @$datas['payment_date'],
                );

            }//end of foreach

             asort($buypayrecord);

            $ser = 	0;
            foreach($buypayrecord as $newdata){
                $particular = $newdata['particular'];
                $payment_date = $newdata['payment_date'];

                if($particular=="Buy"){
                    $amount = $newdata['actual_buy'] ;

                }elseif($particular=="Payment"){
                    $amount = $newdata['pay_amount'];
                }else{
                    $amount= "";
                }
                $particular = $newdata['particular'];
                $supllier_id = $newdata['supplier_id'];

                $purchase_arry = Purchase::where('supplier_id',$supllier_id)->where('product_id',$newdata['product_id'])->first();

                $nameproduct = Product::where('id',$newdata['product_id'])->first();

                $record[$ser] = array(
                    'invoice_no'=>$newdata['invoice_no'],
                    'supplier_id'=>$newdata['supplier_id'],
                    'particular'=>$particular,
                    'payment_date'=>$payment_date,
                    'amount'=>$amount,
                    'serial'=>$ser,
                    'purchase_date'=>@$purchase_arry->purchase_date,
                    'product_id'=>@$nameproduct->product_name,
                    'quantity'=>@$purchase_arry->quantity,
                    'discount'=>@$purchase_arry->discount,
                    'buy_cost'=>@$purchase_arry->buy_cost,
                    'buy_price'=>@$purchase_arry->buy_price,
                );
                $ser++;
            }


        }
        $supplierdetails_qml = array($supplierData, $supplierAccount, $totalbuy, $totalpayment,$record, $supplierFirstAccount);
        Cache::set("Supplier_sum_Calculation", $supplierdetails_qml);

        return view('Supplier.SuppliersDetails', compact('supplierData','supplierAccount','totalbuy','totalpayment','record','supplierFirstAccount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('suppliers')
            ->select('suppliers.*','supplier_accounts.accounts','supplier_accounts.id as account_id')
            ->join('supplier_accounts','supplier_accounts.supplier_id','suppliers.id')
            ->where('suppliers.id',$id)
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

        $data= Supplier::find($id);
        $data['suplier_name']=$request->name;
        $data['address']=$request->address;
        $data['mobile']=$request->mobile;
        $data->save();

        if ($request->previus_ledger > 0){
            $status = "1";
        }else{
            $status = "0";
        }

        $account = SupplierAccount::find($request->account_id);
        $account['accounts']=$request->previus_ledger;
        $account['status']= $status;
        $account->save();

        $notification=array(
            'messege'=>'Supplier Update Successfully',
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

    public function supplierpayment(Request $request)
    {
//dd($request);
        $userid = Auth::user()->id;

        $paymentdata = Supplierpayment::where('id',$request->invoice_id)->first();
        $payment_date = date_format(date_create_from_format('Y-m-d', $request->paymentdate), 'd-m-Y');
        $recivecash = str_replace('-', '', $request->newpay);



        if ($request->lastbalanch > 0){
            $status = "1";
            $paymentstatus = "0";
        }else if($request->lastbalanch < 0){
            $status = "0";
            $paymentstatus = "1";
        }else{
            $status = "0";
            $paymentstatus = "1";
        }

        $account = new SupplierAccount();
        $account['supplier_id']=$request->suplier_id;
        $account['showroom_id']=$request->showroom_id;
        $account['invoice_id']=$paymentdata->invoice_no;
        $account['accounts']=$request->lastbalanch;
        $account['status']= $status;
        $account->save();

        $payment = new Supplierpayment();
        $payment->supplier_id=$request->suplier_id;
        $payment->invoice_no=$paymentdata->invoice_no;;
        $payment->payment_date=$payment_date;
        $payment->pay_amount=$recivecash;
        $payment->payment_details=$request->paymentway;
        $payment->money_receipt=$request->reciptno;
        $payment->make_by=$userid;
        $payment->status=$paymentstatus;
        $payment->showroom_id=$request->showroom_id;
        $payment->save();
        $paymentid = $payment->id;

        $cost= new Purchasecost();
        $cost['supplier_pay_id']=$paymentid;
        $cost['cost_reson']="Supplier Payment";
        $cost['cost_amount']=$recivecash;
        $cost['showroom_id']=$request->showroom_id;
        $cost['user_id']=$userid;
        $cost['date']=$payment_date;
        $cost->save();

        $update = Supplierpayment::find($request->invoice_id);
        $update->status=$status;
        $update->save();

        $notification=array(
            'messege'=>'Supplier Payment Added Successfully',
            'alert-type'=>'success'
        );
        return back()->with($notification);

    }
}
