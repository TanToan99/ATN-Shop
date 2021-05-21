<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManageUser;
use Illuminate\Support\Facades\DB;
use App\Role;
use App\User;
use App\Order;
use App\Comment;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(5);
        $roles = Role::all();
        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            'confirm_password.required' => 'Mật khẩu nhập lại không được để trống',
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
            'role_id' => $request->role_id
        ];
        User::create($data);
        $request->session()->flash('status', 'Thêm người dùng thành công!');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.view', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $data = $request->all();
        $data = $request->validate([
            'username' => 'required',
            'yourname' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
        ],
        [
            'username.required' => 'Tên đăng nhập không được để trống',
            'yourname.required' => 'Họ và tên không được để trống',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.numeric' => 'Số điện thoại phải là ký tự số',
            'address.required' => 'Địa chỉ không được để trống',        
        ]
        );
        $user->update($data);
        $request->session()->flash('status', 'Chỉnh sửa thành công!');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // $user->delete();
        // return redirect()->route('users.index');
        $order_id = Order::where('user_id', $request->user_id)->first();
        $comment = Comment::where('user_id', $request->user_id)->first();
        if($order_id || $comment) {
            $request->session()->flash('error', 'Không được xóa người dùng');
            return redirect()->route('users.index');
        } else {
            $user = User::findOrFail($request->user_id);
            $user->delete();
            $request->session()->flash('status', 'Xóa thành công!');
            return redirect()->route('users.index');
        }
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $users = User::where('username', 'LIKE', "%$search%")->orderBy('id', 'desc')->paginate(5);
        return view('admin.users.search', compact('users'));
    } 
}
