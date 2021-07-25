<?php

namespace App\Http\Controllers\Product_Controller;

use App\Http\Controllers\Controller;
use App\Product_model\Subcategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubcategorieControlle extends Controller
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
            'category_id'=>'required',
            'subcategory_name'=>'required',
        ]);
        $userid = Auth::user()->id;

        $subcat = new Subcategorie();
        $subcat ->categorie_id=$request->category_id;
        $subcat ->subcategory_name=$request->subcategory_name;
        $subcat ->makeby=$userid;
        $subcat->save();

        $notification=array(
            'messege'=>'Successfully Sub Category Inserted',
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
        $data = Subcategorie::where('id',$id)->first();
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
        $userid = Auth::user()->id;
        $data=  Subcategorie::find($id);
        $data ->categorie_id=$request->category_id;
        $data ->subcategory_name=$request->subcategory_name;
        $data ->makeby=$userid;
        $data->save();
        $notification=array(
            'messege'=>'Successfully Sub Category Updated',
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
        Subcategorie::where('id', $id)->delete();

        $notification=array(
            'messege'=>'Successfully Category Deleted',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
