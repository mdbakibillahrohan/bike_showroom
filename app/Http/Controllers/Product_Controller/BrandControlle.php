<?php

namespace App\Http\Controllers\Product_Controller;

use App\Http\Controllers\Controller;
use App\Product_model\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class BrandControlle extends Controller
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands',
        ]);

        $showroomdata = Cache::get("showroom");
        $showroom_id = $showroomdata->id;

        $userid = Auth::user()->id;
        $brandimage = $request->brandimage;

        $data = new Brand();
        $data['brand_name']=$request->brand_name;
        $data['showroom_id']=$showroom_id;
        $data['makeby']=$userid;

        if($request->hasFile('brandimage')){
            $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $x = str_shuffle($x);
            $x = substr($x, 0, 6) . '.PI_S.';
            $dataImageFilename = time() . $x . $brandimage->getClientOriginalExtension();
            Image::make($brandimage->getRealPath())->resize(450, 300)->save(public_path('/Media/brand/'.$dataImageFilename));
            $data['brand_image']=$dataImageFilename;
        }
        $data->save();

        $notification=array(
            'messege'=>'Successfully Brands Inserted!',
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $data = Brand::where('id',$id)->first();
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $userid = Auth::user()->id;
        $oldimage = $request->oldimage;
        $brandimage = $request->brandimage;

        $data = Brand::find($id);
        $data['brand_name']=$request->brand_name;
        $data['makeby']=$userid;
        if($request->hasFile('brandimage')){
            if($oldimage != null){
                $path = 'Media/brand/'.$oldimage;
                unlink($path);
            }
            $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $x = str_shuffle($x);
            $x = substr($x, 0, 6) . '.PI_S.';
            $dataImageFilename = time() . $x . $brandimage->getClientOriginalExtension();
            Image::make($brandimage->getRealPath())->resize(450, 300)->save(public_path('/Media/brand/'.$dataImageFilename));
            $data['brand_image']=$dataImageFilename;
        }
        $data->save();

        $notification=array(
            'messege'=>'Successfully Brands Updated!',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Brand::where('id', $id)->delete();

        $notification=array(
            'messege'=>'Successfully Brand Deleted',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
