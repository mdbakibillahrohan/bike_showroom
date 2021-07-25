<?php

namespace App\Http\Controllers\Product_Controller;

use App\Accounts_model\Purchasecost;
use App\Accounts_model\Showroomcost;
use App\Admin_model\Barcode;
use App\Admin_model\CommonModel;
use App\Admin_model\SupplierAccount;
use App\Admin_model\Supplierpayment;
use App\Http\Controllers\Controller;
use App\Product_model\Product;
use App\Product_model\Purchase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ProductPurcheshControlle extends Controller
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

        $userid = Auth::user()->id;
        $showroomdata = Cache::get("showroom");
        $showroomid = $showroomdata->id;

        $current = new Carbon();
        $crdate =  $current->format('d-m-Y');

        $requested_data = $request->requested_data;
        $suplier_id = $request->suplierid;
        $cost = $request->laber_cost;
        $suplier_payment = $request->suplier_payment;
        $buy_include = $request->checkval;
        $discount = $request->discountflat;

        $sellingdate = date_format(date_create_from_format('Y-m-d', $request->sellingdate), 'd-m-Y');


        $dataArray = $requested_data;
        $qtysum = 0;
        foreach($dataArray as $key=>$value){
            if(isset($value["quntity_valu"]))
                $qtysum += $value["quntity_valu"];
        }
        if ($buy_include==1){
            $costperQty = $cost / $qtysum;
        }else{
            $costperQty = 0;
        }

        $productcount =  count($dataArray);

        if ($cost==null){
            $labercost = 0;
        }else{
            $labercost = $cost / $productcount;
        }

        if ($discount > 0){
            $discountval = $discount / $productcount;
        }else{
            $discountval = 0;
        }




        $model_common = new CommonModel();
        $newinvoice =  $model_common->invoicenoid();

        foreach ($dataArray as $key => $value) {

            $selltype = $value["selltype"];
            $productid = $value["product_id"];
            $singlebuyprice = $value["singlebuyprice"];
            $quntity_valu = $value["quntity_valu"];
            $singlesubtotal = $value["singlesubtotal"];
            $sell_price = $value["singleprice"];
            $attrebute = $value["symboldata"];
            $productBarcode = $value["productBarcode"];

            if ($sell_price==""){
                $sellprice = 0;
            }else{
                $sellprice = $sell_price;
            }

            $calculateBuy = $singlesubtotal + $labercost;
            $actualBuy = $calculateBuy - $discountval;
            $buyprice=  $singlebuyprice + $costperQty;
            $sub_total_buy=  $buyprice * $quntity_valu;

            $data = new Purchase();
            $data['invoice_no']=$newinvoice;
            $data['product_id']=$productid;
            $data['product_type']=$selltype;
            $data['attribute']=$attrebute;
            $data['buy_price']=$buyprice;
            $data['quantity']=$quntity_valu;
            $data['sub_total_buy']=$sub_total_buy;
            $data['buy_cost']=$labercost;
            $data['discount']=$discountval;
            $data['actual_buy']=$actualBuy;
            $data['rest_qty']=$quntity_valu;
            $data['rest_buy_amount']=$actualBuy;
            $data['sell_price']=$sellprice;
            $data['showroom_id']=$showroomid;
            $data['supplier_id']=$suplier_id;
            $data['makeby']=$userid;
            $data['purchase_date']=$sellingdate;
            $data->save();

            $purchase_id =  $data->id;
            $model_common = new CommonModel();
            $model_common->Barcode_generate_insert($productBarcode,$productid,$showroomid,$purchase_id,$newinvoice);

            $data = array();
            $data['status']="1";
            DB::table('products')->where('id',$productid)->update($data);

        }

        if ($request->balanch_cash > 0){
            $status = "1";
            $paymentstatus = "0";
        }else if($request->balanch_cash < 0){
            $status = "0";
            $paymentstatus = "1";
        }else{
            $status = "0";
            $paymentstatus = "1";
        }


        $data = new SupplierAccount();
        $data['supplier_id']=$suplier_id;
        $data['showroom_id']=$showroomid;
        $data['invoice_id']=$newinvoice;
        $data['accounts']=$request->balanch_cash;
        $data['status']=$status;
        $data->save();

        $buycost = $suplier_payment + $cost;
        if($suplier_payment) {
            $paydata = new Supplierpayment();
            $paydata['supplier_id'] = $suplier_id;
            $paydata['invoice_no'] = $newinvoice;
            $paydata['payment_date'] = $sellingdate;
            $paydata['pay_amount'] = $suplier_payment;
            $paydata['payment_details'] = "Product Purchase";
            $paydata['money_receipt'] = "Cash";
            $paydata['showroom_id'] = $showroomid;
            $paydata['make_by'] = $userid;
            $paydata['status'] = $paymentstatus;
            $paydata->save();
            $paymentid = $paydata->id;

            $cost= new Purchasecost();
            $cost['supplier_pay_id']=$paymentid;
            $cost['cost_reson']="Product Purchase";
            $cost['cost_amount']=$buycost;
            $cost['showroom_id']=$showroomid;
            $cost['user_id']=$userid;
            $cost['date']=$sellingdate;
            $cost->save();

        }

        return response()->json(array("status"=>"success"));

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
        // id meen invoice id

        Purchase::where('invoice_no', $id)->delete();
        $payment = Supplierpayment::where('invoice_no', $id)->first();
        Purchasecost::where('supplier_pay_id',$payment->id)->delete();
        SupplierAccount::where('invoice_id', $id)->delete();
        Supplierpayment::where('invoice_no', $id)->delete();
        Barcode::where('invoice_no', $id)->delete();

        $notification=array(
            'messege'=>'Successfully Purchase Deleted',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function ProductPurchaseSingleDetails($id)
    {
        $barcodedata = Barcode::where('product_id',$id)->paginate(15);

        $singleProduct = Purchase::where('product_id',$id)
            ->where('rest_qty', '>', 0)
            ->paginate(15);

        return view('Product.Single_product_Purchase_details', compact('singleProduct','barcodedata'));
    }


    public function PurchaseInvoiceDetails($id)
    {
        $singlePurchaseall = Purchase::where('invoice_no',$id)->where('purchase_type',"1")->first();

        $singlePurchase = Purchase::where('invoice_no', $id)
            ->select('invoice_no', DB::raw('SUM(sub_total_buy) as sub_total_buy '), DB::raw('SUM(discount) as discount '), DB::raw('SUM(buy_cost) as buy_cost '), DB::raw('SUM(actual_buy) as actual_buy '))
            ->groupBy('invoice_no')
            ->where('purchase_type',"1")
            ->first();

        if ($singlePurchase !=null){
            $InvoicePurchase = Purchase::where('invoice_no',$id)->get();

            $supllierpayment = Supplierpayment::where('invoice_no',$id)
                ->where('payment_date',$singlePurchaseall->purchase_date)
                ->first();

            $suplier_invoice = SupplierAccount::where('supplier_id',$singlePurchaseall->supplier_id)->get();

            for ($i = 1; $i < count($suplier_invoice); $i++){
                if ($suplier_invoice[$i]->invoice_id==$id){
                    $pre_invoice = $suplier_invoice[$i-1]->invoice_id;
                }
            }
            $previus_invoice = SupplierAccount::where('invoice_id',$pre_invoice)->first();

            $last_invoice = SupplierAccount::where('invoice_id',$id)->orderBy('id','DESC')->first();


            return view('Product.Purchase_Invoice_details', compact('singlePurchase','previus_invoice','last_invoice','supllierpayment','InvoicePurchase','singlePurchaseall'));
        }else{
            return redirect()->back();
        }

    }



}
