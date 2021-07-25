<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Admin_model\CommonModel;
use App\Http\Controllers\Controller;
use App\Showroom_model\Expence;
use App\Showroom_model\Showroom;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ShowroomController extends Controller
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
            'showroom_name' => 'required|unique:showrooms',
        ]);

        $lastyear = date('d-m-Y', strtotime('+1 years'));

        $showroomimage = $request->Showroomlogo;
        $model_common = new CommonModel();
        $x =  $model_common->slagdata();
        $slag = time().",".str_replace(' ','_', $request->showroom_name).",".$x;

        $data = new Showroom();
        $data ['showroom_name']=$request->showroom_name;
        $data ['address']=$request->address;
        $data ['mobile']=$request->phone;
        $data ['showroom_details']=$request->showroomdetails;
        $data ['expired_date']=$lastyear;
        $data ['slag']=$slag;

        if($request->hasFile('Showroomlogo')){
            $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $x = str_shuffle($x);
            $x = substr($x, 0, 6) . '.PI_S.';
            $profileImageFilename = time() . $x . $showroomimage->getClientOriginalExtension();
            Image::make($showroomimage->getRealPath())->resize(250, 200)->save(public_path('/Media/showroom/' . $profileImageFilename));
            $data['showroom_image']=$profileImageFilename;
        }

        $data->save();
        $notification=array(
            'messege'=>'Successfully Showroom Insert!',
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
    public function update(Request $request)
    {

        $showroomimage = $request->Showroom_logo;
        $old_image = $request->old_image;

        $id = $request->old_id;
        $data = Showroom::find($id);
        $data ['showroom_name']=$request->name;
        $data ['address']=$request->address_edit;
        $data ['mobile']=$request->phone_no;
        $data ['showroom_details']=$request->details;

        if($request->hasFile('Showroom_logo')){

            if($showroomimage != null){
                if($data->showroom_image !=null){
                    $image = $request->old_image;
                    $path = 'Media/showroom/' . $image;
                    unlink($path);
                }
            }

            $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $x = str_shuffle($x);
            $x = substr($x, 0, 6) . '.PI_S.';
            $profileImageFilename = time() . $x . $showroomimage->getClientOriginalExtension();
            Image::make($showroomimage->getRealPath())->resize(250, 200)->save(public_path('/Media/showroom/' . $profileImageFilename));
            $data['showroom_image']=$profileImageFilename;
        }
        $data->save();

        $notification=array(
            'messege'=>'Successfully Showroom Update!',
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


    public function showroomExpense(Request $request)
    {
        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;
        $userid = Auth::user()->id;
        $current = new Carbon();
        $crdate =  $current->format('d-m-Y');

        $data = new Expence();
        $data->date = $crdate;
        $data->showroom_id = $id;
        $data->expense_reason = $request->cost_reason;
        $data->expense_details = $request->expense_details;
        $data->expense_amount = $request->amount;
        $data->user_id = $userid;
        $data->save();

        $notification=array(
            'messege'=>'Successfully Showroom Expanse Added!',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }



}
