<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Product;
use Validator;
use Illuminate\Http\Request;

class ProductValidate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        $products = Product::pluck('id')->toArray();
        return [
            "name" => "bail|required|min:6|max:50|unique:products,name,".$this->id,
            "quantity" => "bail|required|numeric",
            "price" => "bail|required|numeric",
            "description" => "bail|required|min:20",
            "category_id" => "bail|required|numeric",
        ];
    }
    public function messages()
    {
        return [
            "name.required" => "Tên của sản phẩm không được để trống",
            "name.alpha_dash" => "Tên của sản phẩm phải là chữ và số",
            "name.min" => "Tên sản phẩm không có độ dài nhỏ hơn :min",
            "name.max" => "Tên sản phẩm không có độ dài lớn hơn :max",
            "name.unique" => "Tên sản phẩm không được trùng",
            "category_id.required" => "Trường Danh mục không được để trống",
            "category_id.numeric" => "Trường Danh mục phải là hình ảnh",
            "images" => "Hình ảnh không được để trống",
        ];
    }
}
