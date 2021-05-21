<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Order;
use App\User;
use App\OrderDetail;
use App\Promotion;
use App\Status;
use Illuminate\Support\Facades\Mail;
use App\Mail\Sendmail;
use App\Mail\CancelMail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('status')) {
            $orders = Order::with('user', 'orderDetails', 'products' ,'paymentstatus','status')
                ->where('status_id', $request->get('status') )->paginate(7); 
        } else {
            $orders = Order::with('user', 'orderDetails', 'products' ,'paymentstatus','status')
                    ->orderBy('id', 'desc')->paginate(7); 
        }
        //dd($orders);
        return view('admin.orders.index', compact('orders'));
    }
    public function create()
    {
        $products = Product::get();
        $users = User::where('role_id', '!=', 1)->get();
        //dd($users);
        $statuses = Status::get();
        return view('admin.orders.create', compact('products', 'users', 'promotions', 'statuses'));
    }
    public function store(Request $request)
    {
        $user = User::find($request->user_id);
        $product = Product::find($request->product_id);
        $total = $request->quantity * $product->price;
        // data lưu vào order
        $data = [
            'user_id' => $request->user_id,
            'yourname' => $user->yourname,
            'email' => $user->email,
            'phone' => $user->phone,
            'address' => $user->address,
            'status_id' => $request->status_id,
            'total' => $total,
            'payment_id' => 2,
        ];
        // data detail lưu vào order detail
        $data_detail = [
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ];
        // data product de gui mail
        $data_product = [
            'name' => $product->name,
            'quantity' => $request->quantity,
            'total' => $total
        ];
        Order::create($data);
        OrderDetail::create($data_detail);
        Mail::to($data['email'])->send(new Sendmail($data, $data_product));
        return redirect()->route('orders.index')->with('success', 'Tạo Order thành công');
    }
    public function active(Order $order) {
        $data = [
            "status_id" => 1
        ];
        $order->update($data);
        return redirect()->route('orders.index')->with('success', 'Active đơn hàng thành công');
    }
    public function payment(Order $order) {
        $data = [
            "payment_id" => 1
        ];
        $order->update($data);
        return redirect()->route('orders.index')->with('success', "Đơn hàng $order->id đả trả tiền");
    }

    public function edit(Order $order)
    {
        $products = Product::get();
        $users = User::where('role_id', '!=', 1)->get();
        $statuses = Status::get();
        return view('admin.orders.edit', compact('products', 'users', 'statuses','order'));
    }

    public function update(Order $order, Request $request)
    {
        $data = $request->all();
        $data_detail = $request->all();
        $order->update($data);
        return redirect()->route('orders.index')->with('success', 'Edit đơn hàng thành công');
    }

    public function destroy(Request $request)
    {
        $id = $request->get('id');
        $order = Order::find($id);
        $order_details = OrderDetail::where('order_id', $order->id)->get();
        $user = User::find($order->user_id);
        foreach ($order_details as $detail) {
            $product = Product::find($detail->product_id);
            $data_product[] = [
                'name' => $product->name,
                'quantity' => $detail->quantity,
                'subtotal' => $product->price * $detail->quantity,        
            ];
        }
        $data = [
            'user_id' => $order->user_id,
            'yourname' => $user->yourname,
            'email' => $user->email,
            'phone' => $user->phone,
            'address' => $user->address,
            'total' => $order->total,
        ];
        if ($order->payment_id == 1) {
           return redirect()->route('orders.index')->with('success', 'Xóa đơn hàng thất bại vì đơn hàng đả trả tiền'); 
        } else {
            foreach ($order_details as $detail) {
                $detail->delete();
            }
            $order->delete();
            Mail::to($data['email'])->send(new CancelMail($data, $data_product));
            return redirect()->route('orders.index')->with('success', 'Xóa đơn hàng thành công');
        }
        
    }
    public function show(Order $order)
    {
        $order_details = OrderDetail::with('product')->where('order_id', $order->id)->get();
        $user = User::find($order->user_id);
        return view('admin.orders.show', compact('order_details', 'order', 'user'));
    }
}
