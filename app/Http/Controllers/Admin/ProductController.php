<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\Image;
use App\Http\Requests\ProductValidate;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'images')->orderBy('id', 'desc')->paginate(5);
        return view('admin.products.index', compact('products'));
    }
    public function create()
    {
        $categories = Category::get();
        return view('admin.products.create', compact('categories'));
    }
    public function store(ProductValidate $request)
    {
        $dataProducts = $request->all();
        $product = Product::create($dataProducts);
        if($product){
            if ($request->file('images')) {
            foreach ($request->file('images') as $image) {
                $image_name = date('d-m-Y').$image->getClientOriginalName();
                $path = 'image';
                $image->move($path, $image_name);
                $dataImg = [
                    'name' => $path.'/'.$image_name,
                    'product_id' => $product->id
                ];
                Image::create($dataImg);
                }
            }
            return redirect()->route('products.index')->with("success" , "Thêm sản phẩm thành công");
        } else {
            return redirect()->route('products.index')->with("fails" , "Thêm sản phẩm thất bại");
        }
    }
    public function show(Product $product) {
        $images = Image::where('product_id', "=", $product->id)->get();
        return view('admin.products.show', compact('product', 'images'));
    }
    public  function edit(Product $product) {
        $categories = Category::get();
        $images = Image::where('product_id', "=", $product->id)->get();
        return view('admin.products.edit', compact('product', 'categories', 'images'));
    }
    public function destroy(Product $product){
        Image::where("product_id", $product->id)->delete();
        $product->delete();
        return redirect()->route('products.index');
    }
    public function update(Product $product, ProductValidate $request){
        $data = $request->all();
        $product->update($data);
        $dataImg = $request->get('images');
        //Image::update($dataImg);
        return redirect()->route('products.index');
    }

}
