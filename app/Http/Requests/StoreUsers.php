<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsers extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // 开启验证
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
            'uname' => 'required|unique:users',
            'upwd' => 'required|regex:/^[\w]{6,18}$/',
            'reupwd' => 'required|same:upwd',
            'email' => 'required|email',
            'phone' => 'required|regex:/^1{1}[3-9]{1}[\d]{9}$/',
            'profile' => 'required',
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
            'uname.required'=>'请填写用户名',
            'uname.unique'=>'用户名已存在',
            'upwd.required'=>'请填写密码',
            'upwd.regex'=>'密码格式错误:6~18位数',
            'reupwd.required'=>'请确认密码',
            'reupwd.same'=>'两次密码不一致',
            'email.required'=>'请填写邮箱',
            'email.email'=>'邮箱格式错误',
            'phone.required'=>'请填写手机号',
            'phone.regex'=>'手机号格式为1+(3-9)+任意九位数',
            'profile.required'=>'请选择图片',
        ];
    }
}
