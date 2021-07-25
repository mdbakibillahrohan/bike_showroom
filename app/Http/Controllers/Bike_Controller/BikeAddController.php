<?php

namespace App\Http\Controllers\Bike_Controller;

use App\Bike_Model\Bike;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class BikeAddController extends Controller
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
            'bike_name' => 'required',
            'bikemodel' => 'required',
            'categorie_id' => 'required',
            'subcategorie_id' => 'required',
            'brand' => 'required',
        ]);

        $showroomdata = Cache::get("showroom");
        $id = $showroomdata->id;

        $userid = Auth::user()->id;

        $data = new Bike();
        $data ->name=$request->bike_name;
        $data ->model=$request->bikemodel;
        $data ->details=$request->product_deatils;
        $data ->categorie_id=$request->categorie_id;
        $data ->subcategorie_id=$request->subcategorie_id;
        $data ->brand_id=$request->brand;
        $data ->user_id=$userid;
        $data ->showroom_id=$id;
        $data->save();

        $notification=array(
            'messege'=>'Successfully Bike Name Added!',
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
