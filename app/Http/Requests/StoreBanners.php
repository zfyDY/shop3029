<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBanners extends FormRequest
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
            'title'=>'required|max:15',               // 标题不能为空
            'desc'=>'required|max:30',                // 描述不能为空
            'url'=>'required',
            'profile'=>'required',
        ];
    }

    /**
     * 获取已定义验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required'=>'请填写标题 ',  
            'title.max'=>'标题不能超过15个字符 ',  
            'desc.required'=>'请填写描述 ',  
            'desc.max'=>'描述不能超过30个字符 ',  
            'url.required'=>'请填写URL地址',  
            'profile.required'=>'请选择一张图片',  
        ];
    }
}
