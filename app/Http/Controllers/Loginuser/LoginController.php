<?php

namespace App\Http\Controllers\Loginuser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManageUser;
use Illuminate\Support\Facades\Auth;
use App\Role;
use App\User;

class LoginController extends Controller
{
    public function login()
    {
    	return view('content.loginuser.login');
    }

    public function showLogin(Request $request)
    {
    	$email = $request['email'];
    	$password = $request['password'];
        // dd(Auth::attempt(['email' => $email, 'password' => $password]));
    	if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $request->session()->flash('status', 'Đăng nhập thành công!');
    		return redirect()->route('home.index');
    	} else {
            $request->session()->flash('error', 'Đăng nhập thất bại!');
    		return redirect()->route('users.login');
    	}
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect()->route('home.index');
    }

    public function register(){
        $role = Role::where('id', 2)->first();
        return view('content.loginuser.register', compact('role'));
    }

    public function showRegister(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'yourname' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
        ],
        [
            'username.required' => 'Tên đăng nhập không được để trống',
            'username.max' => 'Tên đăng nhập không được quá 255 ký tự',
            'email.required' => 'Email đăng nhập không được để trống',
            'email.email' => 'Email phải đúng định dạng',
            'email.unique' => 'Email đăng nhập không được trùng',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu không được nhỏ hơn 6 ký tự',
            'confirm_password.same' => 'Mật khẩu không trùng khớp',
            'yourname.required' => 'Họ và tên không được để trống',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.numeric' => 'Số điện thoại phải là ký tự số',
            'address.required' => 'Địa chỉ không được để trống',        
        ]
        );

        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'yourname' => $request->yourname,
            'phone' => $request->phone, 
            'address' => $request->address,
            'role_id' => 2
        ];
        User::create($data);
        $request->session()->flash('status', 'Đăng ký thành công!');
        return redirect()->route('home.index');
    }
}
