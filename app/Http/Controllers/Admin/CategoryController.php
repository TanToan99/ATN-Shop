<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use Validator;
use App\Http\Requests\CategoryValidate;

class CategoryController extends Controller
{
    // Vào trang index
    public function index()
    {
        $categories = Category::get();
        return view('admin.categories.index', compact('categories'));
    }
    // View tới trang create
    public function create()
    {
        $categories = Category::get();
        return view('admin.categories.create', compact('categories'));
    }
    // Tạo 1 danh mục 
    public function store(CategoryValidate $request)
    {
        $data = [
          'name' => $request->name,
        ];
        if (Category::create($data)) {
            return redirect()->route('categories.index')->with("success" , "Add success");
        } else {
            return redirect()->route('categories.index')->with("fails" , "Fail");
        }
        
    }
    // View tới trang edit
    public function edit(Category $category)
    {
        //dd($category);
        $categories = Category::get();
        return view('admin.categories.edit', compact('categories', 'category'));
    }
    // Chỉnh sửa danh mục
    public function update(Category $category, CategoryValidate $request)
    {
        $data = $request->all();
        if ($category->update($data)) {
            return redirect()->route('categories.index')->with("success" , "Chỉnh sủa thành công");
        } else {
            return redirect()->route('categories.index')->with("fails" , "Chỉnh sủa thất bại");
        }
    }
    // Xóa 1 danh mục
    public function destroy(Category $category)
    {
        
        if ($category->parent_id == 0) {
            if (Category::where("parent_id" ,"=", $category->id)->count()) {
               return redirect()->route('categories.index')->with("fails" , "Xóa Danh mục thất bại vì danh mục này đã có các trường con"); 
            } else {
                $category->delete();
                return redirect()->route('categories.index')->with("success" , "Xóa Danh mục thành công");
            }
        } else {
            if (Product::where("category_id", "=", $category->id)->count()) {
                return redirect()->route('categories.index')->with("fails" , "Xóa Danh mục thất bại vì danh mục này đã có sản phẩm");
            } else {
                        $category->delete();
                        return redirect()->route('categories.index')->with("success" , "Xóa Danh mục thành công");

            }
        }
    }
    // Show danh mục con của Danh mục đó
    public function showcategory($id)
    {
        $categories = Category::where('parent_id', $id)->get();
        return view('admin.categories.show', compact('categories', 'id'));
    }
    public function showproducts($id)
    {
        $products = Product::with('images', 'category')->where('category_id', $id)->get();
        return view('admin.categories.showproduct', compact('products'));
    }
}
