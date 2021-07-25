<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
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
       //dd($request);
        $validatedData = $request->validate([
            'email' => 'required|unique:users',
        ]);

        $data = new User();
        $data['name']=$request->name;
        $data['mobile']=$request->phone;
        $data['role_id']=$request->usertype;
        $data['email']=$request->email;
        $data['password']=Hash::make($request->password);
        $profileimage=$request->proficeimage;

        if($request->hasFile('proficeimage')){
            $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $x = str_shuffle($x);
            $x = substr($x, 0, 6) . '.PI_S.';
            $profileImageFilename = time() . $x . $profileimage->getClientOriginalExtension();
            Image::make($profileimage->getRealPath())->resize(250, 200)->save(public_path('/Media/user_profile/' . $profileImageFilename));
            $data['image']=$profileImageFilename;

        }
        $data->save();
        $saveid = $data->id;
        $showroomid = $request->showroomid;
        $user = User::find($saveid);
        $user->showrooms()->sync($showroomid,false);

        $notification=array(
            'messege'=>'Successfully Profile Updated!',
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
        $name_new = $request->user_name;
        $name_old = $request->nameold;

        if ($name_old != $name_new){
            $username = $request->user_name;
        }else{
            $username = $request->nameold;
        }
        $id = Auth::user()->id;
        $profile = Auth::user()->image;
        $data = User::find($id);

        $data['name']=$username;
        $data['mobile']=$request->mobile;
        $profileimage=$request->profileimage;

        if($request->hasFile('profileimage')){
            $profileUserImage = Auth::user()->image;
            if($profileUserImage != null){
                $image = Auth::user()->image;
                $path = 'Media/user_profile/' . $image;
                unlink($path);
            }
            $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $x = str_shuffle($x);
            $x = substr($x, 0, 6) . '.PI_S.';
            $profileImageFilename = time() . $x . $profileimage->getClientOriginalExtension();
            Image::make($profileimage->getRealPath())->resize(250, 200)->save(public_path('/Media/user_profile/' . $profileImageFilename));
            $data['image']=$profileImageFilename;

        }

        $data->save();

        $notification=array(
            'messege'=>'Successfully Profile Updated!',
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

    public function UserUpdate(Request $request)
    {
      // dd($request);

        $id=$request->userid;
        $oldimg = User::find($id);
        if($request->has('newpassword')){
            $password = Hash::make($request->newpassword);
        }else{
            $password =$oldimg->password;
        }

        $data = User::find($id);
        $data['name']=$request->name;
        $data['mobile']=$request->phone;
        $data['role_id']=$request->usertype;
        $data['email']=$request->email;
        $data['password']=$password;

        $userimage=$request->userimage;
        if($request->hasFile('userimage')){
            if($userimage != null){
                if ($oldimg->image != null){
                    $image = $request->oldimage;
                    $path = 'Media/user_profile/' . $image;
                    unlink($path);
                }
            }
            $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $x = str_shuffle($x);
            $x = substr($x, 0, 6) . '.PI_S.';
            $profileImageFilename = time() . $x . $userimage->getClientOriginalExtension();
            Image::make($userimage->getRealPath())->resize(250, 200)->save(public_path('/Media/user_profile/' . $profileImageFilename));
            $data['image']=$profileImageFilename;
        }
        $data->save();
        $saveid = $data->id;
        if($request->has('showroomid')){
            $showroomid = $request->showroomid;
            $user = User::find($saveid);
            $user->showrooms()->sync($showroomid);
        }

        $notification=array(
            'messege'=>'Successfully Profile Updated!',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
