<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsers;
use App\Models\Users;
use App\Models\UsersInfos;
use Hash;
use DB;
use Storage;

class UserController extends Controller
{
    /**
     * 显示后台 用户列表页 主页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        // 接收搜索条件
        $search_uname = $request->input('search_uname');
        $search_email = $request->input('search_email');
        $search_phone = $request->input('search_phone');

        $users = Users::where('uname','like','%'.$search_uname.'%')
                        ->where('email','like','%'.$search_email.'%')
                        ->where('phone','like','%'.$search_phone.'%')
                        ->paginate(4);
        return view('admin/user/index',['users'=>$users,'params'=>$request->all()]);
    }

    /**
     * 显示 添加 页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/user/create');
    }

    /**
     * 执行 添加 操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsers $request)
    {
        $date = $request->all();
        // 接收上传头像
        if($request->hasFile('profile')){
            // 创建文件上传对象
            $file_path = $request->file('profile')->store(date('Ymd'));
        }else{
            $file_path = '';
        }
        // 接收数据
        $user = new Users;
        $user->uname = $date['uname'];
        $user->upwd  = Hash::make($date['upwd']);
        $user->email = $date['email'];
        $user->token = $date['_token'];
        $user->status = 0;
        $user->phone = $date['phone'];
        $res1 = $user->save();

        if($res1){
            // 获取uid
            $uid = $user->id;
        }
        // 压入头像 
        $usresinfos = new UsersInfos;
        $usresinfos->uid = $uid;
        $usresinfos->profile = $file_path;
        $res2 = $usresinfos->save();
        // 手动操作事务 [ 两个表都插入数据成功 ]
        DB::beginTransaction();
        if($res1 && $res2){
            DB::commit();
            return redirect('admin/user')->with('success','添加用户成功');
        }else{
            // 回滚
            DB::rollBack();
            return back()->with('error','添加用户失败');
        }
    }

    /**
     * 显示 详情 页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 显示 修改 页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_date = Users::find($id);

        return view('admin/user/edit',['user_date'=>$user_date]);
    }

    /**
     * 执行 修改 操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 编写验证逻辑
        $this->validate($request, [
            'uname' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^1{1}[3-9]{1}[\d]{9}$/',
        ],[
            'uname.required'=>'请填写用户名',
            'email.required'=>'请填写邮箱',
            'email.email'=>'邮箱格式错误',
            'phone.required'=>'请填写手机号',
            'phone.regex'=>'手机号格式为1+(3-9)+任意九位数',
        ]);

        // 判断是否上传图片
        if( $request->hasFile('profile') ) {
            // 删除以前的旧图片
            Storage::delete($request->input('profile_path'));
            $profile = $request->file('profile')->store( date('Ymd') );         // 接收并上传    
        } else {
            // 如果没有新的上传文件 就设置为隐藏域的图片
            $profile = $request->input('profile_path','');
        }

        // 修改用户数据
        $user = Users::find($id);
        $user->uname = $request->input('uname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $res1 = $user->save();
        // 修改用户数据
        $userinfo = UsersInfos::where('uid',$id)->first();
        $userinfo->profile = $profile;
        $res2 = $userinfo->save();
        DB::beginTransaction();
        if($res1 && $res2){
            DB::commit();
            return redirect('/admin/user/'.$id.'/edit')->with('success','修改用户信息成功');
        }else{
            // 回滚
            DB::rollBack();
            return back()->with('error','修改用户信息失败');
        }
    }

    /**
     * 删除 数据 操作
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res1 = Users::destroy($id);
        $res2 = UsersInfos::where('uid',$id)->delete();
        DB::beginTransaction();
        if($res1 && $res2){
            DB::commit();
            return redirect('admin/user')->with('success','删除用户成功');
        }else{
            // 回滚
            DB::rollBack();
            return back()->with('error','删除用户失败');
        }
    }

    
}
