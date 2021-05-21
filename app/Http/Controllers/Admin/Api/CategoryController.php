<?php

namespace App\Http\Controllers\Admin\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use Validator;

class CategoryController extends Controller
{
    public function index()
    {
    	$categories = Category::get();
    	//dd($categories);
    	return response()->json($categories, 200);
    }
    // ajax search 
    public function search(Request $request)
    {
        $query = $request->get('query');
    	$cid = $request->get('cid');
        $categories = Category::get();
        if ($query != '') {
            $data = Category::where("name", 'like', '%'.$query.'%')->get();
            $total_row = $data->count();
            
            $output[] = "";
            if ($total_row > 0) {
                foreach ($data as $row) {
                    $output[] = '
                    <tr>
                        <td>'.$row->id.'</td>
                        <td>'.$row->name.'</td>
                        <td>'."<a href=\"".$row->id."/edit"."\" class='update' id=\"".$row->id."\">".'<i class="ace-icon fa fa-pencil bigger-120"></i>'.'</a>'.'</td>
                        <td>'."<button class=\"btn btn-danger\" data-id=\"".$row->id
                        ."\" id=\"remote".$row->id."\" title=\"Xóa sản phẩm\">".'<i class="fa fa-trash-o">'.'</i>'.'</button>'
                        .'</td>
                    </tr>
                    ';
                }
            }
            else
                {
                    $output = '
                    <tr>
                        <td align="center" colspan="5">No Data Found</td>
                    </tr>
                ';
                }
            $data = [
                'table_data' => $output,
                'total_row' => $total_row,
                'categories' => $categories,
            ];
        } else {
            $data = Category::orderBy('id', 'desc')->get();
            foreach ($data as $row) {
                $output[] = '
                <tr>
                    <td>'.$row->id.'</td>
                    <td>'."<a href=\"categories/".$row->id."/showcategory\">".$row->name.'</a>'.'</td>
                    <td>'."<a href=\"".$row->id."/edit"."\" class='update' id=\"".$row->id."\">".'<i class="ace-icon fa fa-pencil bigger-120"></i>'.'</a>'.'</td>
                    <td>'."<button class=\"btn btn-danger\" data-id=\"".$row->id
                    ."\" id=\"remote".$row->id."\" title=\"Xóa sản phẩm\">".'<i class="fa fa-trash-o">'.'</i>'.'</button>'
                    .'</td>
                </tr>
                ';
            }
            $data = [
            'table_data' => $output,
            'categories' => $categories,
            ];
        }
            
        echo json_encode($data);
    	   //return response()->json($data, 200);
    }
    // code ajax delete
    public function remote(Request $request)
    {
        $id = $request->get('id');
        $category = Category::find($id);
        $products = Product::where('category_id', $category->id)->get();
        if ($products->count() > 0) {
            $data = "Không được xóa danh mục này vì danh mục này đã có sản phẩm";
        }else {
            if ($category->delete()) {
                $data = 'Đã xóa danh mục thàng công';
            } else {
                $data = 'Xóa danh mục thất bại';
            }
        }
        
        echo json_encode($data);
    }
    // code ajax tạo danh mục
    public function createpost(Request $request)
    {
        $data = $request->get('name');

        $categories = Category::pluck('id')->toArray();
        $validation = Validator::make($request->all(), [
            'name' => 'required|min:3|max:20',
        ],
        [
            'required' => 'Không được để trống :attribute',
            'unique' => 'Không được để trùng :attribute',
        ]);
        $error_array = [];
        $update = "";
        $success_output = '';
        if ($validation->fails()) {
            foreach ($validation->errors()->all() as $value) {
                $error_array = $value;
            }
        } else {
            if ($request->get('button_action') == 'create') {
                $data = [
                    "name" => $request->get('name')
                ];
                Category::create($data);
                $success_output = '<div class="alert alert-success">Danh mục đã được tạo</div>';
            }
            if ($request->get('button_action') == 'update') {
                $category = Category::find($request->get('id'));
                $data = [
                    'name' => $request->get('name'),
                ];               
                $category->update($data);
                $success_output = '<div class="alert alert-success">Danh mục đã được sửa</div>';
                $update = "Sửa thành công";
            }
        }
        
        
         $output = [
            'success' => $success_output, 
            'errors' => $error_array, 
            'update' => $update         
        ];
        echo json_encode($output);        
    }
    // hiện khung khi edit
    public function printfe(Request $request)
    {
        $categories = Category::get();
        $category = Category::find($request->id);
        $data = [
            'cid' => $category->id,
            'name' => $category->name,
            'categories' => $categories
        ];
        echo json_encode($data);
    }
    public function showcategory(Request $request)
    {
        $query = $request->get('query');
        $cid = $request->get('cid');
        $categories = Category::get();
        if ($query != '') {
            $data = Category::where("name", 'like', '%'.$query.'%')->get();
        } else {
            $data = Category::orderBy('id', 'desc')->get();
        }
        $total_row = $data->count();
            
            $output[] = "";
            if ($total_row > 0) {
                foreach ($data as $row) {
                    $output[] = '
                    <tr>
                        <td>'.$row->id.'</td>
                        <td>'."<a href=\"/admin/categories/".$row->id."/showproducts\">".$row->name.'</a>'.'</td>
                        <td>'."<a href=\"".$row->id."/edit"."\" class='update' id=\"".$row->id."\">".'<i class="ace-icon fa fa-pencil bigger-120"></i>'.'</a>'.'</td>
                        <td>'."<button class=\"btn btn-danger\" data-id=\"".$row->id
                        ."\" id=\"remote".$row->id."\" title=\"Xóa sản phẩm\">".'<i class="fa fa-trash-o">'.'</i>'.'</button>'
                        .'</td>
                    </tr>
                    ';
                }
            }
            else
                {
                    $output = '
                    <tr>
                        <td align="center" colspan="5">No Data Found</td>
                    </tr>
                ';
                }
            $data = [
                'table_data' => $output,
                'total_row' => $total_row,
                'categories' => $categories,
            ];
            
        echo json_encode($data);
           //return response()->json($data, 200);
    }
}
