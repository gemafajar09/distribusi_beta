<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        // var_dump($request->session()->has('id'));
        if ($request->session()->has('id')) 
        {
            return redirect("/");
        }
        else
        {
            return view ("pages.login");
        }
    }

    public function postLogin(Request $request){
        $this->validate($request,[
            'username' => 'required|alpha_num',
            'password' => 'required|alpha_num',
        ]);
        $username = $request->input('username');
        $password = $request->input('password');
        $data = DB::table('tbl_user')->where('username',$username)->where('password',$password)->first();

        if(empty($data))
        {
            return '<script type="text/javascript">alert("Username Atau Password Salah!");window.location="/login";</script>';
        }
        else
        {
        	$request->session()->put("id", $data->id_user);
			$request->session()->put("nama", $data->nama_user);
			$request->session()->put("level", $data->level);
			$request->session()->put("cabang", $data->id_cabang);
				if($data->level == "Owner")
		        {
		        	return redirect('/');
		        }elseif ($data->level == "Pimpinan")
		        {
		        	return redirect('/');
		        }elseif ($data->level == "Admin")
		        {
		        	return redirect('/');
		        }       
        }
    }

    public function postLogout(Request $request)
    {
    	$request->session()->forget('id');
    	$request->session()->forget('nama');
    	$request->session()->forget('level');
    	$request->session()->forget('cabang');
    	return redirect("/login");
    }
}
