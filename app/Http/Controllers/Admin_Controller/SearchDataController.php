<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Accounts_model\Recivecash;
use App\Http\Controllers\Controller;
use App\Order_model\Order;
use App\Order_model\Profitorder;
use App\Product_model\Brand;
use App\Product_model\Categorie;
use App\Product_model\Product;
use App\Product_model\Purchase;
use App\Showroom_model\Expence;
use App\Showroom_model\Showroom;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SearchDataController extends Controller
{
    public function Allproductdata(Request $request)
    {
        $searchdata = $request->search;
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;

        if($request->ajax()) {
            $output="";

            $stokedata = Product::where('showroom_id',$id)
                ->where('product_name', 'LIKE', '%' . $searchdata . '%')
                ->orWhere('product_deatils', 'LIKE', '%' . $searchdata . '%')
                ->orWhere('id', 'LIKE', '%' . $searchdata . '%')
                ->orderBy('id','DESC')
                ->paginate(15);

            $i=1;
            foreach ($stokedata as $key => $product) {

                $output.='<tr>'.
                    '<td>'.$i.'</td>'.
                    '<td>'.$product->id.'</td>'.
                    '<td>'.$product->product_name.'</td>'.
                    '<td>'.$product->product_deatils.'</td>'.
                    '<td>'.$product->categorie->category_name.'</td>'.
                    '<td>'.@$product->brand->brand_name.'</td>'.
                    '<td>'.$product->sell_type.'</td>'.
                    '<td>'.'<button type="button" class="btn btn-success btn-sm productidedit">Edit</button>'.'</td>'.
                    '<td>'.'<button type="button" class="btn btn-warning btn-sm productidbuy">Buy</button>'.'</td>'.
                    '</tr>';
                $i++;
            }
            return Response($output);
        }
    }

    public function Allproduct_stokedata(Request $request)
    {
        $searchdata = $request->search;
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;

        if($request->ajax()) {
            $output="";

            $stokedata = Product::where('showroom_id',$id)
                ->where('product_name', 'LIKE', '%' . $searchdata . '%')
                ->orWhere('product_deatils', 'LIKE', '%' . $searchdata . '%')
                ->orWhere('id', 'LIKE', '%' . $searchdata . '%')
                ->orderBy('product_name','DESC')
                ->paginate(15);

            $i=1;
            foreach ($stokedata as $key => $product) {

                $productstokedata = Purchase::where('product_id',[$product->id])
                    ->select('product_id','attribute', DB::raw('SUM(quantity) as totalqty'), DB::raw('SUM(actual_buy) as actual_buysum'), DB::raw('SUM(rest_qty) as rest_qty '),DB::raw('SUM(sub_total_buy) as sub_total_buy'), DB::raw('SUM(rest_buy_amount) as rest_buy_amount'))
                    ->groupBy(['product_id', 'attribute'])
                    ->first();

                $productsdata = Purchase::where('product_id',$product->id)->first();

                $output.='<tr>'.
                    '<td>'.$i.'</td>'.
                    '<td>'.$product->id.'</td>'.
                    '<td>'.$product->product_name.'</td>'.
                    '<td>'.$productstokedata->attribute.'</td>'.
                    '<td>'.$productstokedata->totalqty.'</td>'.
                    '<td>'.$productsdata->buy_price.'</td>'.
                    '<td>'.$productstokedata->sub_total_buy.'</td>'.
                    '<td>'.$productstokedata->rest_qty.'</td>'.
                    '<td>'.$productstokedata->rest_buy_amount.'</td>'.
                    '<td>'.$productsdata->sell_price.'</td>'.
                    '<td>'.'<button type="button" class="btn btn-warning btn-sm product_view">View</button>'.'</td>'.
                    '</tr>';
                $i++;
            }
            return Response($output);
        }
    }

    public function Product_Purchesh_search(Request $request)
    {
        $formdate = date_format(date_create_from_format('Y-m-d', $request->startdate), 'd-m-Y');
        $todate = date_format(date_create_from_format('Y-m-d', $request->enddate), 'd-m-Y');
        $product_search = array($formdate, $todate);
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;

        if (empty($formdate)) {
            $productdetails = $productstokedata = Purchase::where('showroom_id',$id)
                ->where('rest_qty', '>', 0)
                ->paginate(15);
        }else{
            Cache::set("totalpurchesh_search", $product_search);
            $productdetails = $productstokedata = Purchase::where('purchase_date', '>=', $formdate)
                ->where('rest_qty', '>', 0)
                ->where('purchase_date', '<=', $todate)
                ->where('showroom_id', $id)
                ->paginate(15);
        }
        return view('Product.product_details_view',compact('productdetails'));

    }

    public function Product_Single_Purchesh_search(Request $request)
    {
        $formdate = date_format(date_create_from_format('Y-m-d', $request->startdate), 'd-m-Y');
        $todate = date_format(date_create_from_format('Y-m-d', $request->enddate), 'd-m-Y');
        $product_search = array($formdate, $todate, $request->productid);

        if (empty($formdate)) {
            $singleProduct = Purchase::where('product_id',$request->productid)
                ->where('rest_qty', '>', 0)
                ->paginate(15);
        }else{
            Cache::set("singlepurchesh_search", $product_search);

            $singleProduct = Purchase::where('purchase_date', '>=', $formdate)
                ->where('rest_qty', '>', 0)
                ->where('purchase_date', '<=', $todate)
                ->where('product_id', $request->productid)
                ->paginate(15);
        }
        return view('Product.Single_product_Purchase_details', compact('singleProduct'));


    }

    public function ExpenseOrPurchesh_search(Request $request)
    {
        if ($request->startdate !=null){

            $formdate = date_format(date_create_from_format('Y-m-d', $request->startdate), 'd-m-Y');
            $todate = date_format(date_create_from_format('Y-m-d', $request->enddate), 'd-m-Y');
            $product_search = array($formdate, $todate);

            $showroomdata = Cache::get("showroom");
            $id = $showroomdata->id;

            $purchesh = DB::table('purchasecosts')
                ->where('showroom_id', $id)
                ->where('date', '>=', $formdate)
                ->where('date', '<=', $todate)
                ->orderBy('created_at','DESC')
                ->get()->toArray();

            $expense = DB::table('expences')
                ->where('showroom_id', $id)
                ->where('date', '>=', $formdate)
                ->where('date', '<=', $todate)
                ->orderBy('created_at','DESC')
                ->get()->toArray();

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
            Cache::set("expensedata_cash", $record);
            return view('Showroom.Showroomexpence', compact('record'));
        }else{
            return redirect()->back();
        }
    }


    public function ShowroomProfit_search(Request $request)
    {
        if ($request->startdate !=null) {

            $formdate = date_format(date_create_from_format('Y-m-d', $request->startdate), 'd-m-Y');
            $todate = date_format(date_create_from_format('Y-m-d', $request->enddate), 'd-m-Y');
            $product_search = array($formdate, $todate);

            $showroomdata = Cache::get("showroom");
            $id = $showroomdata->id;
            $profit = Profitorder::where('showroom_id', $id)
                ->where('selldate', '>=', $formdate)
                ->where('selldate', '<=', $todate)
                ->orderBy('id','DESC')
                ->paginate(15);

            Cache::set("Showroom_profit", $profit);
            return view('Showroom.Showroom_profit', compact('profit'));

        }else{
            return redirect()->back();
        }
    }


    public function ShowroomReciveCash_search(Request $request)
    {
        if ($request->startdate !=null) {
            $formdate = date_format(date_create_from_format('Y-m-d', $request->startdate), 'd-m-Y');
            $todate = date_format(date_create_from_format('Y-m-d', $request->enddate), 'd-m-Y');
            $showroomdata = Cache::get("showroom");
            $id = $showroomdata->id;

            $recivecash = Recivecash::where('showroom_id', $id)
                ->where('received_date', '>=', $formdate)
                ->where('received_date', '<=', $todate)
                ->orderBy('id','DESC')
                ->paginate(15);

            Cache::set("Showroom_Recive_Cash", $recivecash);
            return view('Showroom.Showroom_Recive_cash', compact('recivecash'));

        }else{
            return redirect()->back();
        }
    }

    public function ProductStokeSearch(Request $request)
    {

            if ($request->startdate !=null){
                $formdate = date_format(date_create_from_format('Y-m-d', $request->startdate), 'd-m-Y');
                $todate = date_format(date_create_from_format('Y-m-d', $request->enddate), 'd-m-Y');
                if($formdate){
                    $startdate= $formdate;
                }else{
                    $startdate="";
                }
                if($todate){
                    $enddate= $todate;
                }else{
                    $enddate="";
                }
            }

            $showroomdata = Cache::get("showroom");
            $id = $showroomdata->id;

            $brand = Brand::where('showroom_id', $id)->get();
            $category = Categorie::where('showroom_id', $id)->get();

            if($request->categorie_id){
                $categorie_id= $request->categorie_id;
            }else{
                $categorie_id="";
            }
            if($request->brand_id){
                $brand_id= $request->brand_id;
            }else{
                $brand_id="";
            }

            if($request->categorie_id !=null) {
                $product = Product::where('categorie_id', $request->categorie_id)->get();
                $arr= 1;
                for ($i=0; $i < count($product); $i++ ){
                    $purchesh = Purchase::where('product_id', $product[$i]->id)->where('rest_qty','>',0)->get();

                    foreach ($purchesh as $newdata){
                        $productstoke[$arr] = array(
                            'id'=>$newdata['id'],
                            'invoice_no'=>$newdata['invoice_no'],
                            'product_id'=>$newdata['product_id'],
                            'attribute'=>$newdata['attribute'],
                            'product_type'=>$newdata['product_type'],
                            'purchase_date'=>$newdata['purchase_date'],
                            'rest_qty'=>$newdata['rest_qty'],
                            'buy_price'=>$newdata['buy_price'],
                            'sell_price'=>$newdata['sell_price'],
                            'product_name'=>$newdata->product->product_name,
                            'category_name'=>$newdata->product->categorie->category_name,
                            'brand_name'=>$newdata->product->brand->brand_name
                        );
                        $arr++;

                    }

                }

            }elseif ($brand_id !=null){

                $product = Product::where('brand_id', $brand_id)->get();
                $arr= 1;
                for ($i=0; $i < count($product); $i++ ){
                    $purchesh = Purchase::where('product_id', $product[$i]->id)->where('rest_qty','>',0)->get();

                    foreach ($purchesh as $newdata){
                        $productstoke[$arr] = array(
                            'id'=>$newdata['id'],
                            'invoice_no'=>$newdata['invoice_no'],
                            'product_id'=>$newdata['product_id'],
                            'product_type'=>$newdata['product_type'],
                            'attribute'=>$newdata['attribute'],
                            'purchase_date'=>$newdata['purchase_date'],
                            'rest_qty'=>$newdata['rest_qty'],
                            'buy_price'=>$newdata['buy_price'],
                            'sell_price'=>$newdata['sell_price'],
                            'product_name'=>$newdata->product->product_name,
                            'category_name'=>$newdata->product->categorie->category_name,
                            'brand_name'=>$newdata->product->brand->brand_name
                        );
                        $arr++;

                    }

                }

            }elseif ($categorie_id !=null && $brand_id !=null){

                $product = Product::where('brand_id', $brand_id)->where('categorie_id', $request->categorie_id)->get();
                $arr= 1;
                for ($i=0; $i < count($product); $i++ ){
                    $purchesh = Purchase::where('product_id', $product[$i]->id)->where('rest_qty','>',0)->get();

                    foreach ($purchesh as $newdata){
                        $productstoke[$arr] = array(
                            'id'=>$newdata['id'],
                            'invoice_no'=>$newdata['invoice_no'],
                            'product_id'=>$newdata['product_id'],
                            'product_type'=>$newdata['product_type'],
                            'attribute'=>$newdata['attribute'],
                            'purchase_date'=>$newdata['purchase_date'],
                            'rest_qty'=>$newdata['rest_qty'],
                            'buy_price'=>$newdata['buy_price'],
                            'sell_price'=>$newdata['sell_price'],
                            'product_name'=>$newdata->product->product_name,
                            'category_name'=>$newdata->product->categorie->category_name,
                            'brand_name'=>$newdata->product->brand->brand_name
                        );
                        $arr++;

                    }

                }

            }elseif ($startdate !=null && $enddate !=null){

                $purchesh = Purchase::where('purchase_date', '>=', $startdate)
                    ->where('purchase_date', '<=', $enddate)
                    ->where('rest_qty','>',0)
                    ->get();

                if (count($purchesh) !=0){
                    $arr= 1;
                    foreach ($purchesh as $newdata){
                        $productstoke[$arr] = array(
                            'id'=>$newdata['id'],
                            'invoice_no'=>$newdata['invoice_no'],
                            'product_id'=>$newdata['product_id'],
                            'product_type'=>$newdata['product_type'],
                            'attribute'=>$newdata['attribute'],
                            'purchase_date'=>$newdata['purchase_date'],
                            'rest_qty'=>$newdata['rest_qty'],
                            'buy_price'=>$newdata['buy_price'],
                            'sell_price'=>$newdata['sell_price'],
                            'product_name'=>$newdata->product->product_name,
                            'category_name'=>$newdata->product->categorie->category_name,
                            'brand_name'=>$newdata->product->brand->brand_name
                        );
                        $arr++;

                    }
                }else{
                    return redirect()->back();
                }


            }elseif ($categorie_id !=null && $brand_id ==null && $startdate !=null && $enddate !=null){

                $product = Product::where('categorie_id', $request->categorie_id)->get();
                $arr= 1;
                for ($i=0; $i < count($product); $i++ ){
                    $purchesh = Purchase::where('purchase_date', '>=', $startdate)
                        ->where('purchase_date', '<=', $enddate)
                        ->where('product_id', $product[$i]->id)
                        ->where('rest_qty','>',0)
                        ->get();

                    foreach ($purchesh as $newdata){
                        $productstoke[$arr] = array(
                            'id'=>$newdata['id'],
                            'invoice_no'=>$newdata['invoice_no'],
                            'product_id'=>$newdata['product_id'],
                            'product_type'=>$newdata['product_type'],
                            'attribute'=>$newdata['attribute'],
                            'purchase_date'=>$newdata['purchase_date'],
                            'rest_qty'=>$newdata['rest_qty'],
                            'buy_price'=>$newdata['buy_price'],
                            'sell_price'=>$newdata['sell_price'],
                            'product_name'=>$newdata->product->product_name,
                            'category_name'=>$newdata->product->categorie->category_name,
                            'brand_name'=>$newdata->product->brand->brand_name
                        );
                        $arr++;

                    }

                }

            }elseif ($categorie_id ==null && $brand_id !=null && $startdate !=null && $enddate !=null){

                $product = Product::where('brand_id', $brand_id)->get();
                $arr= 1;
                for ($i=0; $i < count($product); $i++ ){
                    $purchesh = Purchase::where('purchase_date', '>=', $startdate)
                        ->where('purchase_date', '<=', $enddate)
                        ->where('product_id', $product[$i]->id)
                        ->where('rest_qty','>',0)
                        ->get();

                    foreach ($purchesh as $newdata){
                        $productstoke[$arr] = array(
                            'id'=>$newdata['id'],
                            'invoice_no'=>$newdata['invoice_no'],
                            'product_id'=>$newdata['product_id'],
                            'product_type'=>$newdata['product_type'],
                            'attribute'=>$newdata['attribute'],
                            'purchase_date'=>$newdata['purchase_date'],
                            'rest_qty'=>$newdata['rest_qty'],
                            'buy_price'=>$newdata['buy_price'],
                            'sell_price'=>$newdata['sell_price'],
                            'product_name'=>$newdata->product->product_name,
                            'category_name'=>$newdata->product->categorie->category_name,
                            'brand_name'=>$newdata->product->brand->brand_name
                        );
                        $arr++;

                    }

                }

            }elseif ($categorie_id !=null && $brand_id !=null && $startdate !=null && $enddate !=null){
                $product = Product::where('brand_id', $brand_id)->where('categorie_id', $request->categorie_id)->get();
                $arr= 1;
                for ($i=0; $i < count($product); $i++ ){
                    $purchesh = Purchase::where('purchase_date', '>=', $startdate)
                        ->where('purchase_date', '<=', $enddate)
                        ->where('product_id', $product[$i]->id)
                        ->where('rest_qty','>',0)
                        ->get();

                    foreach ($purchesh as $newdata){
                        $productstoke[$arr] = array(
                            'id'=>$newdata['id'],
                            'invoice_no'=>$newdata['invoice_no'],
                            'product_id'=>$newdata['product_id'],
                            'product_type'=>$newdata['product_type'],
                            'attribute'=>$newdata['attribute'],
                            'purchase_date'=>$newdata['purchase_date'],
                            'rest_qty'=>$newdata['rest_qty'],
                            'buy_price'=>$newdata['buy_price'],
                            'sell_price'=>$newdata['sell_price'],
                            'product_name'=>$newdata->product->product_name,
                            'category_name'=>$newdata->product->categorie->category_name,
                            'brand_name'=>$newdata->product->brand->brand_name
                        );
                        $arr++;

                    }

                }


            }

            Cache::set("Showroom_Stoke_product_search", $productstoke);

            return view('Report_page.Showroom_Product_stoke_search', compact('brand','category','productstoke'));

    }


    public function SellingOrderSearch(Request $request)
    {

        if($request->categorie_id){
            $categorie_id= $request->categorie_id;
        }else{
            $categorie_id="";
        }
        if($request->brand_id){
            $brand_id= $request->brand_id;
        }else{
            $brand_id="";
        }
        if($request->startdate){
            $startdate= date_format(date_create_from_format('Y-m-d', $request->startdate), 'd-m-Y');;
        }else{
            $startdate="";
        }
        if($request->enddate){
            $enddate= date_format(date_create_from_format('Y-m-d', $request->enddate), 'd-m-Y');;
        }else{
            $enddate="";
        }

        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;
        $brand = Brand::where('showroom_id', $id)->get();
        $category = Categorie::where('showroom_id', $id)->get();

        if($categorie_id==null && $brand_id ==null && $startdate ==null && $enddate ==null){

            $orderdata = Order::where('showroom_id', $id)->orderBy('id','DESC')->paginate(15);

        }elseif($categorie_id!=null && $brand_id==null && $startdate==null && $enddate ==null){

            $orderdata = Order::where('category_id', $categorie_id)->orderBy('id','DESC')->paginate(15);

        }elseif ($categorie_id ==null && $brand_id !=null && $startdate ==null && $enddate ==null){

            $orderdata = Order::where('brand_id', $brand_id)->orderBy('id','DESC')->paginate(15);

        }elseif ($categorie_id !=null && $brand_id !=null && $startdate==null && $enddate ==null){

            $orderdata = Order::where('brand_id', $brand_id)->where('category_id', $categorie_id)->orderBy('id','DESC')->paginate(15);

        }elseif ($categorie_id ==null && $brand_id ==null && $startdate !=null && $enddate !=null){

            $orderdata = Order::where('selldate', '>=', $startdate)
                ->where('selldate', '<=', $enddate)
                ->where('showroom_id',$id)
                ->orderBy('id', 'DESC')
                ->paginate(15);

        }elseif ($categorie_id !=null && $brand_id ==null && $startdate !=null && $enddate !=null){

            $orderdata = Order::where('selldate', '>=', $startdate)
                ->where('selldate', '<=', $enddate)
                ->where('showroom_id',$id)
                ->where('category_id', $categorie_id)
                ->orderBy('id', 'DESC')
                ->paginate(15);

        }elseif ($categorie_id ==null && $brand_id !=null && $startdate !=null && $enddate !=null){

            $orderdata = Order::where('selldate', '>=', $startdate)
                ->where('selldate', '<=', $enddate)
                ->where('showroom_id',$id)
                ->where('brand_id', $brand_id)
                ->orderBy('id', 'DESC')
                ->paginate(15);

        }elseif ($categorie_id !=null && $brand_id !=null && $startdate !=null && $enddate !=null){

            $orderdata = Order::where('selldate', '>=', $startdate)
                ->where('selldate', '<=', $enddate)
                ->where('showroom_id',$id)
                ->where('brand_id', $brand_id)
                ->where('category_id', $categorie_id)
                ->orderBy('id', 'DESC')
                ->paginate(15);
        }
        Cache::set("OrderreportSearchdata", $orderdata);

        return view('Report_page.Selling_report', compact('brand','category','orderdata'));
    }



    public function SellingInvoiceOrderSearch(Request $request)
    {
        $formdate = date_format(date_create_from_format('Y-m-d', $request->startdate), 'd-m-Y');
        $todate = date_format(date_create_from_format('Y-m-d', $request->enddate), 'd-m-Y');

        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;

        $neworderdata = Order::where('selldate', '>=', $formdate)
            ->select('invoice_no', DB::raw('SUM(total_sellprice) as total_sellprice'), DB::raw('SUM(sell_discount) as sell_discount'), DB::raw('SUM(sell_cost) as sell_cost'), DB::raw('SUM(lastsell_amount) as lastsell_amount '))
            ->where('selldate', '<=', $todate)
            ->where('showroom_id', $id)
            ->groupBy('invoice_no')
            ->orderBy('invoice_no','DESC')
            ->paginate(15);

        Cache::set("totalorderdata_search", $neworderdata);

        return view('Order_page.OrderInvoiceDetails', compact('neworderdata'));

    }

    public function SellingDetailsOrderSearch(Request $request)
    {
        $formdate = date_format(date_create_from_format('Y-m-d', $request->startdate), 'd-m-Y');
        $todate = date_format(date_create_from_format('Y-m-d', $request->enddate), 'd-m-Y');

        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;

        $orderdetails = Order::where('selldate', '>=', $formdate)
            ->where('selldate', '<=', $todate)
            ->where('showroom_id', $id)
            ->orderBy('invoice_no','DESC')
            ->paginate(15);

        Cache::set("totalorderDetails_search", $orderdetails);

        return view('Order_page.DetailsOrder', compact('orderdetails'));

    }


    public function OrderdataBybarcode(Request $request)
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;
        $searchdata = $request->search;

        if($request->ajax()) {
            $output="";

            $orderdetails = Order::where('showroom_id', $id)
                ->where('product_code', 'LIKE', '%' . $searchdata . '%')
                ->orWhere('invoice_no', 'LIKE', '%' . $searchdata . '%')
                ->orderBy('invoice_no','DESC')
                ->paginate(15);

            $i=1;
            foreach ($orderdetails as $key => $order) {
                $output.='<tr>'.
                    '<td>'.$i.'</td>'.
                    '<td>'.$order->selldate.'</td>'.
                    '<td>'.$order->invoice_no.'</td>'.
                    '<td>'.$order->product->product_name.'</td>'.
                    '<td>'.$order->product_code.'</td>'.
                    '<td>'.$order->quantity.'</td>'.
                    '<td>'.$order->sellprice.'</td>'.
                    '<td>'.$order->total_sellprice.'</td>'.
                    '<td>'.$order->sell_cost.'</td>'.
                    '<td>'.$order->sell_discount.'</td>'.
                    '<td>'.$order->lastsell_amount.'</td>'.
                    '<td>'.'<button type="button" class="btn btn-success btn-sm ordrview">view</button>'.'</td>'.
                    '<td>'.'<button type="button" class="btn btn-warning btn-sm orderprint">Print</button>'.'</td>'.
                    '</tr>';
                $i++;
            }
            return Response($output);
        }

    }




}


