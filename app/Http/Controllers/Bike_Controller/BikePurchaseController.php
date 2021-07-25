<?php

namespace App\Http\Controllers\Bike_Controller;

use App\Accounts_model\Purchasecost;
use App\Admin_model\CommonModel;
use App\Admin_model\SupplierAccount;
use App\Bike_model\Bikeidentity;
use App\Bike_Model\Bikepurchase;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class BikePurchaseController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'suplier_id' => 'required',
            'bike_id' => 'required',
            'quantity' => 'required',
            'buyprice' => 'required',
            'sellprice' => 'required',
            'engine_no' => 'required',
            'chassis_no' => 'required',
        ]);

        $current = new Carbon();
        $crdate =  $current->format('d-m-Y');

        $model_common = new CommonModel();
        $newinvoice =  $model_common->invoiceid_bike_purches();


        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;

        $userid = Auth::user()->id;

        $data = new Bikepurchase();
        $data ->invoice=$newinvoice;
        $data ->date=$crdate;
        $data ->bike_id=$request->bike_id;
        $data ->supplier_id=$request->suplier_id;
        $data ->quantity=$request->quantity;
        $data ->rest_qty=$request->quantity;
        $data ->buy_price=$request->buyprice;
        $data ->commission=$request->buycommission;
        $data ->sell_price=$request->sellprice;
        $data ->user_id=$userid;
        $data ->showroom_id=$id;
        $data->save();

        $data = array();
        $data['status']="1";
        DB::table('bikes')->where('id',$request->bike_id)->update($data);

        foreach ($request->engine_no as $engines){
            $engine[] = array(
                'engine_no' => $engines,
            );
        }
        foreach ($request->chassis_no as $chassis){
            $chassisn[] = array(
                'chassis_no' => $chassis,
            );
        }

        for ($i = 0; $i < count($engine); $i++) {
            $engine_no = $engine[$i]['engine_no'];
            $chassis_no = $chassisn[$i]['chassis_no'];
            $data = new Bikeidentity();
            $data ->bike_id=$request->bike_id;
            $data ->engine_no=$engine_no;
            $data ->chassis_no=$chassis_no;
            $data->save();
        }

        $supplierac = SupplierAccount::where('supplier_id',$request->suplier_id)->orderBy('id','DESC')->first();
        $buyamount = $request->buyprice * $request->quantity;
        $supplierbalanch = $supplierac->accounts + $buyamount;



        if ($supplierbalanch > 0){
            $status = "1";
            $paymentstatus = "0";
        }else if($supplierbalanch < 0){
            $status = "0";
            $paymentstatus = "1";
        }else{
            $status = "0";
            $paymentstatus = "1";
        }

        $data = new SupplierAccount();
        $data['supplier_id']=$request->suplier_id;
        $data['showroom_id']=$id;
        $data['invoice_id']=$newinvoice;
        $data['accounts']=$supplierbalanch;
        $data['status']=$status;
        $data->save();


        $notification=array(
            'messege'=>'Successfully Bike Purchase!',
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
