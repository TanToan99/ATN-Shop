<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Category;
use App\Order;
use App\OrderDetail;
use App\Comment;
use App\Slide;

use Cart;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailOrder;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::where('active', '1')->get();

        $categories = Category::get();
        $new_products = Product::with('images')->orderBy('id','desc')->paginate(4);
        $highLights_products = Product::with('images')->orderBy('id','asc')->paginate(4);
        return view('content.index', compact('categories', 'new_products', 'highLights_products','comments'));

    }

    public function product($id)
    {
       $product = Product::with('images')->find($id);
        $products = Product::where('id', '<>', $id)->orderBy('id', 'desc')->paginate(4);
        $categories = Category::get();
        $comments = Comment::where('product_id', '=', $id)
                            ->where('active', '1')
                            ->get();
        return view('content.product', compact('product','categories', 'comments', 'products'));
    }
    public function showAllProduct()
    {
        $products = Product::orderBy('id','desc')->paginate(12);
        $categories = Category::get();
        return view('content.showproduct', compact('categories', 'products'));
    }
    public function autocomplete(Request $request)
    {
        if ($request->get('query')) 
        {
            $query =  $request->get('query');
            $products = Product::where('name', 'like', '%'.$query.'%')->get();
        } 
        echo json_encode($products);
    }
    public function checkorder()
    {
        $cart = Cart::content();
        return view('content.order', compact('cart'));
    }

    public function contact()
    {
        return view('content.contact');
    }

    public function sendContact(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|email',
            'content' => 'required',
        ],
        [
            'name.required' => 'Tên đăng nhập không được để trống',
            'name.max' => 'Tên đăng nhập không được quá 20 ký tự',
            'email.required' => 'Email đăng nhập không được để trống',
            'email.email' => 'Email phải đúng định dạng',
            'content.required' => 'Mật khẩu không được để trống',  
        ]
        );

        $input = $request->all();
        // send mail admin
        Mail::send('content.email.email-admin', array('name'=>$input["name"],'email'=>$input["email"], 'content'=>$input['content']), function($message){
            $message->to('hienlt@cloudzone.vn', 'Visitor')->subject('Thông tin phản hồi!');
        });

        //send mail user
        $data = [
            'name' =>$request->name,
            'email' =>$request->email,
            'content' =>$request->content
        ];

        // dd($data['email']);
        Mail::send('content.email.email-user', $data, function($message) use ($data){
            $message->from('hienlt@cloudzone.vn', 'Admin Selling phone');
            $message->to($data['email']);
            $message->subject('Thông tin phản hồi!');
        });
        $request->session()->flash('status', 'Bạn đã gửi thông tin contact thành công!');
        return redirect()->route('home.contact');
    }
    
    
    public function cart($id)
    {
        $user = User::find($id);
        return view('content.cart', compact('user'));
    }
    public function orderdetail(Request $request)
    {
        
        $data_order = [
            'user_id' => $request->user_id,
            'yourname' => $request->yourname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'status_id' => 2,
            'total' => $request->total,
            'payment_id' => 2,
        ];
        foreach ($request->name as $key => $pname) {
            $data_product[] = [
                'name' => $pname,
                'quantity' => $request->qtt[$key],
                'subtotal' => $request->subtotal[$key],        
            ];
        }
        $order = Order::create($data_order);
        foreach ($request->pid as $key => $pid) {
            $data_order_detail = [
                'product_id' => $pid,
                'quantity' => $request->qtt[$key],  
                'order_id' => $order->id     
            ]; 
            OrderDetail::create($data_order_detail);
            $product = Product::find($pid);
            $qtt = [
                'quantity' => $product->quantity - $request->qtt[$key]
            ];
            $product->update($qtt);
        }
        Mail::to($data_order['email'])->send(new SendMailOrder($data_order, $data_product));
        return redirect()->route('home.showorder', $request->user_id)->with('success', 'Tạo Order thành công');
    }
    public function showorder($id)
    {
        
        $orders = Order::with('orderDetails', 'status', 'paymentstatus')
                        ->where('user_id', $id)->paginate(10);
        return view('content.showorder', compact('orders'));
    }
    public function action($id)
    {
        $cancer = [
            'status_id' => 3
        ];
        Order::where('id', $id)->update($cancer);
        $order = Order::find($id);
        return redirect()->route('home.showorder', $order->user_id)->with('success', 'Xóa order thành công');
    }
    public function kiemtraorder($id)
    {
        $orders = Order::where('user_id', $id)->orderBy('id', 'desc')->get();
        return redirect()->route('home.showorder', compact($orders));
    }
}
