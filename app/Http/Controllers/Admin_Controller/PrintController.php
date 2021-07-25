<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Admin_model\SupplierAccount;
use App\Admin_model\Supplierpayment;
use App\Http\Controllers\Controller;
use App\Order_model\Order;
use App\Product_model\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PrintController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   public function Product_Purchesh_print()
   {
       $showroomdata = Cache::get("showroom");
       $id = $showroomdata->id;
       $pdsearch = Cache::get("totalpurchesh_search");
       $formdate = $pdsearch[0];
       $todate = $pdsearch[1];

       $productdetails = $productstokedata = Purchase::where('purchase_date', '>=', $formdate)
           ->where('rest_qty', '>', 0)
           ->where('purchase_date', '<=', $todate)
           ->where('showroom_id', $id)
           ->get();

       return view('Printpage.purches_product_search_print',compact('productdetails'));

   }

   public function OrderInvoice_print($id)
   {
       $orderdetails = Order::where('invoice_no',$id)->get();
       return view('Printpage.orderinvoice_print',compact('orderdetails'));
   }

   public function PurcheshSingle_search_print()
   {
       $pdsearch = Cache::get("singlepurchesh_search");
       $formdate = $pdsearch[0];
       $todate = $pdsearch[1];
       $productid = $pdsearch[2];
       $singleProduct = Purchase::where('purchase_date', '>=', $formdate)
           ->where('rest_qty', '>', 0)
           ->where('purchase_date', '<=', $todate)
           ->where('product_id', $productid)
           ->get();

       return view('Printpage.singleproductdetails_print',compact('singleProduct'));
   }

   public function PurcheshInvoice_print($id)
   {
       $singlePurchase = Purchase::where('invoice_no',$id)->first();

       $InvoicePurchase = Purchase::where('invoice_no',$id)->get();

       $supllierpayment = Supplierpayment::where('invoice_no',$id)
           ->where('payment_date',$singlePurchase->purchase_date)
           ->first();

       $suplier_invoice = SupplierAccount::where('supplier_id',$singlePurchase->supplier_id)->get();

       for ($i = 1; $i < count($suplier_invoice); $i++){
           if ($suplier_invoice[$i]->invoice_id==$id){
               $pre_invoice = $suplier_invoice[$i-1]->invoice_id;
           }
       }
       $previus_invoice = SupplierAccount::where('invoice_id',$pre_invoice)->first();

       $last_invoice = SupplierAccount::where('invoice_id',$id)->orderBy('id','DESC')->first();


           return view('Printpage.Purchase_Invoice_print', compact('singlePurchase','previus_invoice','last_invoice','supllierpayment','InvoicePurchase'));
   }


   public function ShowroomExpense_print()
   {
       $record = Cache::get("expensedata_cash");

       return view('Printpage.Showroom_Cost_print', compact('record'));
   }


    public function ShowroomProfit_print()
    {
        $profit = Cache::get("Showroom_profit");

        return view('Printpage.Showroom_Profit_print', compact('profit'));
    }
    public function ShowroomReciveCash_print()
    {
        $recivecash = Cache::get("Showroom_Recive_Cash");

        return view('Printpage.Showroom_Receive_cash_print', compact('recivecash'));
    }

    public function StokeProduct_print()
    {
        $productstoke = Cache::get("Showroom_Stoke_product_search");

        return view('Printpage.StokeProduct_print', compact('productstoke'));
    }

    public function OrderReport_print()
    {
        $orderdata = Cache::get("OrderreportSearchdata");

        return view('Printpage.OrderReport_print', compact('orderdata'));
    }

    public function CustomerCalculation_print()
    {
        $customerdetails_qml = Cache::get("Customer_sum_Calculation");
        $customerData = $customerdetails_qml[0];
        $customerAccount = $customerdetails_qml[1];
        $totalsell = $customerdetails_qml[2];
        $totalpayment = $customerdetails_qml[3];
        $record = $customerdetails_qml[4];
        $customerFirstAccount = $customerdetails_qml[5];

        return view('Printpage.CustomerCalculationview_print', compact('customerData','customerAccount','totalsell','totalpayment','record','customerFirstAccount'));
    }

    public function SupplierCalculation_print()
    {
        $supplierdetails_qml = Cache::get("Supplier_sum_Calculation");
        $supplierData = $supplierdetails_qml[0];
        $supplierAccount = $supplierdetails_qml[1];
        $totalbuy = $supplierdetails_qml[2];
        $totalpayment = $supplierdetails_qml[3];
        $record = $supplierdetails_qml[4];
        $supplierFirstAccount = $supplierdetails_qml[5];

        return view('Printpage.SupplierCalculationview_print', compact('supplierData','supplierAccount','totalbuy','totalpayment','record','supplierFirstAccount'));
    }



    public function OderInvoiceDetails_print()
    {
        $invoiceorder = Cache::get("totalorderdata_search");
        return view('Printpage.Orderinvoicesearch_print', compact('invoiceorder'));
    }

    public function OderDetailssingle_print()
    {
        $orderdetails = Cache::get("totalorderDetails_search");
        return view('Printpage.OrderDetailssearch_print', compact('orderdetails'));
    }









    public static function convert_number_to_words($number) {

        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'Zero',
            1                   => 'One',
            2                   => 'Two',
            3                   => 'Three',
            4                   => 'Four',
            5                   => 'Five',
            6                   => 'Six',
            7                   => 'Seven',
            8                   => 'Eight',
            9                   => 'Nine',
            10                  => 'Ten',
            11                  => 'Eleven',
            12                  => 'Twelve',
            13                  => 'Thirteen',
            14                  => 'Fourteen',
            15                  => 'Fifteen',
            16                  => 'Sixteen',
            17                  => 'Seventeen',
            18                  => 'Eighteen',
            19                  => 'Nineteen',
            20                  => 'Twenty',
            30                  => 'Thirty',
            40                  => 'Forty',
            50                  => 'Fifty',
            60                  => 'Sixty',
            70                  => 'Seventy',
            80                  => 'Eighty',
            90                  => 'Ninety',
            100                 => 'Hundred',
            1000                => 'Thousand',
            1000000             => 'Million',
            1000000000          => 'Billion',
            1000000000000       => 'Trillion',
            1000000000000000    => 'Quadrillion',
            1000000000000000000 => 'Quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . Self::convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . Self::convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = Self::convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= Self::convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }


}
