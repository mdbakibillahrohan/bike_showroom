<?php

namespace App\Http\Controllers\Product_Controller;

use App\Http\Controllers\Controller;
use App\Product_model\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class CategorieControlle extends Controller
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
            'category_name' => 'required|unique:categories',
        ]);

        $showroomdata = Cache::get("showroom");
        $showroom_id = $showroomdata->id;

        $userid = Auth::user()->id;
        $data= new Categorie();
        $data['category_name']=$request->category_name;
        $data['showroom_id']=$showroom_id;
        $data['makeby']=$userid;
        $categoryimage = $request->image;

        if($request->hasFile('image')){
            $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $x = str_shuffle($x);
            $x = substr($x, 0, 6) . '.PI_S.';
            $dataImageFilename = time() . $x . $categoryimage->getClientOriginalExtension();
            Image::make($categoryimage->getRealPath())->resize(450, 300)->save(public_path('/Media/category/'.$dataImageFilename));
            $data['category_image']=$dataImageFilename;
        }
        $data->save();

        $notification=array(
            'messege'=>'Successfully Categories Inserted!',
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
        $data = Categorie::where('id',$id)->first();
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
        $oldimage = $request->oldimage;
        $data=  Categorie::find($id);
        $data['category_name']=$request->category_name;
        $data['makeby']=$userid;
        $categoryimage = $request->image;

        if($request->hasFile('image')){

            if($oldimage != null){
                $path = 'Media/category/'.$oldimage;
                unlink($path);
            }
            $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $x = str_shuffle($x);
            $x = substr($x, 0, 6) . '.PI_S.';
            $dataImageFilename = time() . $x . $categoryimage->getClientOriginalExtension();
            Image::make($categoryimage->getRealPath())->resize(450, 300)->save(public_path  ('/Media/category/'.$dataImageFilename));
            $data['category_image']=$dataImageFilename;
        }
        $data->save();

        $notification=array(
            'messege'=>'Successfully Categories Updated!',
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

        Categorie::where('id', $id)->delete();

        $notification=array(
            'messege'=>'Successfully Category Deleted',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
