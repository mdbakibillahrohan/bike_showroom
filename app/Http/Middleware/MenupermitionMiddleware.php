<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;
use App\User;

use Illuminate\Support\Facades\DB;
use Iluminate\Routing\Router;


class MenupermitionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user()->id;

        $menuUser =DB::table('submenus')
            ->leftjoin('submenu_user','submenu_user.submenu_id','=','submenus.id')
            ->select('submenus.submenu_route')
            ->where('submenu_user.user_id','=',$user)
            ->get();

        $allmenuUser =DB::table('submenus')
            ->select('submenus.submenu_route')
            ->get();

        if(Auth::user()->role_id != 1){
            $path = $request->route()->getName();
            //$path=$request->getPathInfo();

            if (count($menuUser) > 0) {

                for ($i=0;  $i < count($menuUser) ; $i++) {

                    if ($menuUser[$i]->submenu_route==$path){

                        if ($menuUser[$i]) {
                            return $next($request);
                        }else{
                            return redirect()->back();
                        }
                    }

                }
            }

            $notification=array(
                'messege'=>'Not Permission This menu Contact Admin !',
                'alert-type'=>'warning'
            );
            return back()->with($notification);
        }else{
            $path = $request->route()->getName();

            if (count($allmenuUser) > 0) {

                for ($i=0;  $i < count($allmenuUser) ; $i++) {
                    if ($allmenuUser[$i]->submenu_route==$path){
                        if ($allmenuUser[$i]) {
                            return $next($request);
                        }else{
                            return redirect()->back();
                        }

                    }

                }


            }
        }

    }
}
