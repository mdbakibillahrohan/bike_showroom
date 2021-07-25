<?php

namespace App\Admin_model;

use App\Bike_Model\Bikepurchase;
use App\Bike_Model\Bikesell;
use App\Order_model\Order;
use App\Order_model\Returnorder;
use App\Product_model\Purchase;
use Illuminate\Database\Eloquent\Model;

class CommonModel extends Model
{
    public function slagdata()
    {
        $x = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $x = str_shuffle($x);
        $slag = substr($x,0,5);
        return $slag;
    }

    public function invoicenoid()
    {
        $maxinvoice = Purchase::max('invoice_no');

        if ($maxinvoice == ''){
            $newinvoice = 1000;
        }else{
            $newinvoice = $maxinvoice +1;
        }
        return $newinvoice;
    }


    public function invoicenoid_order()
    {
        $maxinvoice = Order::max('invoice_no');

        if ($maxinvoice == ''){
            $newinvoice = 1000;
        }else{
            $newinvoice = $maxinvoice +1;
        }
        return $newinvoice;
    }


    public function buypricecheck($product_id,$showroomid,$quntityvalu,$symboledata)
    {
        if ($symboledata==null){
            $productbuyprice = Purchase::where('product_id',$product_id)->where('showroom_id',$showroomid)->whereNotIn('rest_qty',[0])->get();
        }else{
            $productbuyprice = Purchase::where('product_id',$product_id)->where('showroom_id',$showroomid)->where('attribute',$symboledata)->whereNotIn('rest_qty',[0])->get();
        }


        $qty = [];
        foreach ($productbuyprice as $quantity){
            $qty[] = [
                "qt_id" => $quantity->id,
                "rest_qty" => $quantity->rest_qty,
                "buy_price" => $quantity->buy_price,
            ];

        }

        $buyPrices = [];
        $x = $quntityvalu;
        $elseQty = $x;

        for ($i = 0; $i < count($qty) ; $i++){
            $elseQty = (intval($elseQty) - intval($qty[$i]['rest_qty']));
            if ($elseQty != 0){
                $buyPrices[] = [
                    'pd_id'=>$qty[$i]['qt_id'],
                    'tec_qty'=>$elseQty,
                    'tec_qtylast'=>$elseQty + $qty[$i]['rest_qty'],
                    'buy_price'=>$qty[$i]['buy_price'],
                    'rest'=>$qty[$i]['rest_qty']
                ];
            }

            if ($elseQty < 0){
                break;
            }

        }
        return  $buyPrices;
        //return  $elseQty;
    }


    public function returninvoiceproduct()
    {
        $maxinvoice = Returnorder::max('return_invoice');

        if ($maxinvoice == ''){
            $newinvoice = 101;
        }else{
            $newinvoice = $maxinvoice +1;
        }
        return $newinvoice;

    }

    public function Barcode_generate_insert($productBarcode,$productid,$showroomid,$purchase_id,$newinvoice)
    {
        if ($productBarcode == NULL) {

            $maxcode = Barcode::where('code_type',0)->max('barcode');

            if ($maxcode == ''){
                $code_gen = 200000;
            }else{
                $code_gen = $maxcode +1;
            }

            $barcode= new Barcode();
            $barcode['purchase_id']=$purchase_id;
            $barcode['product_id']=$productid;
            $barcode['invoice_no']=$newinvoice;
            $barcode['showroom_id']=$showroomid;
            $barcode['barcode']=$code_gen;
            $barcode['code_type']=0;
            $barcode->save();

        }else{
            foreach ($productBarcode as $value) {
                $barcode= new Barcode();
                $barcode['purchase_id']=$purchase_id;
                $barcode['product_id']=$productid;
                $barcode['invoice_no']=$newinvoice;
                $barcode['showroom_id']=$showroomid;
                $barcode['barcode']=$value;
                $barcode['code_type']=1;
                $barcode->save();
            }

        }

    }



    public function invoiceid_bike_purches()
    {
        $maxinvoice = Bikepurchase::max('invoice');

        if ($maxinvoice == ''){
            $newinvoice = 30000;
        }else{
            $newinvoice = $maxinvoice +1;
        }
        return $newinvoice;
    }


    public function invoiceid_bike_order()
    {
        $maxinvoice = Bikesell::max('invoice');


        if ($maxinvoice == ''){
            $bike = "BK-";
            $newinvoice = $bike."100";
        }else{
            $invoice = explode("-", $maxinvoice);
            $makeinvoice = $invoice[1];
            $newinv = $makeinvoice +1;
            $newinvoice = $invoice[0]."-".$newinv;
        }
        return $newinvoice;
    }




}
