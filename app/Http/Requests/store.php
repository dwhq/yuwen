<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class store extends FormRequest
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
        return [
            'name'=>'required',//required不能为空
            'image'=>'required',
            'qq'=>'required',
            'email'=>'required',
            'bottom_info'=>'required'
        ];
    }

    /**
     * 定义字段名中文
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name'=>'网站名称',
            'qq'=>'QQ',
            'email'=>'邮箱',
            'image'=>'网站logo',
            'bottom_info'=>'网站底部版权信息',
        ];
    }

    /**
     * 定义字段名中文
     *
     * @return array
     */
    public function messages()
    {
        return [
            //'tag_ids.required'=>'必须选择标签',
            'qq.required'=>'qq不能为空',
            'email.required'=>'邮箱不能为空'
        ];
    }
}
