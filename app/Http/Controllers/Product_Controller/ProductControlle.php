<?php

namespace App\Http\Controllers\Product_Controller;

use App\Admin_model\Supplier;
use App\Http\Controllers\Controller;
use App\Product_model\Brand;
use App\Product_model\Categorie;
use App\Product_model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ProductControlle extends Controller
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
        $dashboardUrl = route('product_panel');
        $panelName = "product";
        return view('Purchase_layouts.Purchase_Dashboard', compact('panelName','dashboardUrl'));
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
            'product_name' => 'required|unique:products',
            'categorie_id' => 'required',
            'selltype' => 'required',
            'brand' => 'required',
        ]);

        $showroomdata = Cache::get("showroom");
        $showroom_id = $showroomdata->id;
        $userid = Auth::user()->id;
        $product = new Product();
        $product ->showroom_id=$showroom_id;
        $product ->product_name=$request->product_name;
        $product ->product_deatils=$request->product_deatils;
        $product ->categorie_id=$request->categorie_id;
        $product ->subcategorie_id=$request->subcategorie_id;
        $product ->brand_id=$request->brand;
        $product ->sell_type=$request->selltype;

        if ($request->has('Symbol')){
            $product ->attrebute=$request->Symbol;
        }
//        if ($request->has('tag')){
//            $attrary = $request->tag;
//            $attrebute = implode(', ',$attrary);
//            $product ->attrebute=$attrebute;
//        }

        if ($request->has('big_unit_relation')){
            $product ->big_unit_relation=$request->big_unit_relation;
        }
        if ($request->has('small_unit_relation')){
            $product ->small_unit_relation=$request->small_unit_relation;
        }
        $product ->makeby=$userid;
        $product->save();

        $notification=array(
            'messege'=>'Successfully Product Inserted',
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
        $showroomdata = Cache::get("showroom");
        $showroom = $showroomdata->id;

        $allcategories = Categorie::where('showroom_id', $showroom)->get();
        $allbrand = Brand::where('showroom_id', $showroom)->get();
        $productdata = Product::where('id', $id)->first();

        return view('Product.product_viewedit', compact('allcategories', 'allbrand', 'productdata'));
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
        $userid = Auth::user()->id;
        $product = Product::find($id);
        $product ->product_name=$request->product_name;
        $product ->product_deatils=$request->product_deatils;

        if ($request->categorie_id != null){
            $product ->categorie_id=$request->categorie_id;
        }
        if ($request->subcategorie_id != null){
            $product ->subcategorie_id=$request->subcategorie_id;
        }
        if ($request->brand != null){
            $product ->brand_id=$request->brand;
        }
        $product ->makeby=$userid;
        $product->save();

        $notification=array(
            'messege'=>'Successfully Product Inserted',
            'alert-type'=>'success'
        );

        return redirect()->route('Product.List')->with($notification);
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
