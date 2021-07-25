<?php

namespace App\Http\Controllers\Main_Controller;

use App\Http\Controllers\Controller;
use App\Showroom_model\Showroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AccessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AccessUser_index($id)
    {
        $user = Auth::user();
        $userid = Auth::user()->id;

        if (Auth::user()->role_id == 1){
            $showroomdata = Showroom::where('slag',$id)->first();
        }else{
            $showroomdata = DB::table('showroom_user')
                ->select('showrooms.*', 'showroom_user.user_id as usernewid')
                ->leftJoin('showrooms', 'showrooms.id', '=', 'showroom_user.showroom_id')
                ->where('showroom_user.user_id', $userid)
                ->where('showrooms.slag', $id)
                ->first();
        }
        Cache::set("showroom", $showroomdata);
        return view('Purchase_layouts.Purchase_Dashboard', compact('user','showroomdata'));
    }



    public function MenuUpdate(Request $request)
    {
        $userid = $request->userid;
        $menuid = $request->menuid;

        $user = DB::table('submenu_user')->where('user_id',$userid)->where('submenu_id', $menuid)->first();

        $data=array();
        $data['user_id']=$request->userid;
        $data['submenu_id']=$request->menuid;


        if ($user==NULL){
            $insert=DB::table('submenu_user')->insert($data);

            $notification=array(
                'messege'=>'Permission Successfully Added',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);

        }else{
            $delete = DB::table('submenu_user')->where('user_id',$userid)->where('submenu_id', $menuid)->delete();
            $notification=array(
                'messege'=>'Permission Unsuccessfull',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }

        $notification=array(
            'messege'=>'Sub Menu Successfully Added',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
        //return response()->json($request);
    }

}
