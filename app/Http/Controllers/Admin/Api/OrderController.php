<?php

namespace App\Http\Controllers\Admin\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Order;
use App\Product;
use Cart;
class OrderController extends Controller
{
    public $cart = [];
    public function create_order(Request $request)
    {
    	$id = $request->get('id');
    	if ($id != null) {
    		$product = Product::find($id);
    		$data = [
    			"name" => $product->name,
    			"price" => $product->price
    		];
    	echo json_encode($data);
    	}
    }
    public function action(Request $request)
    {
        $total = 0;
        $qtt = $request->get('qtt');
        $data = [];

        if($request->get('action') == 'add') {
            $product = Product::find($request->get('id'));
            $total = $product->price * $qtt;
            $data = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 1,
                'total' => $total,
            ];
            echo json_encode($cart);
        }
        
    }
    public function remove(Request $request)
    {   
        $data = $request->get('id');
        $rowId = Cart::search(array('id' => $data));
        //Cart::remove($data);
        // $cart = Cart::content();
        echo json_encode($rowId);
    }
    public function checkqtt(Request $request)
    {
        $product = Product::find($request->id);
        $data = $product->quantity;
        echo json_encode($data);
    }
}
