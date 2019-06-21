<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin_Users_Roles;
use App\Models\Admin_Users;
use App\Models\Roles;
use Storage;
use Hash;
use DB;

class AdminuserController extends Controller 
{
    /**
     * 显示后台管理员页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 接收管理员搜索条件
        $search_uname = $request->input('search_uname');
        $admin_user = Admin_Users::where('uname','like','%'.$search_uname.'%')
                        ->paginate(5);
        // 获取管理员角色数据
        $adminuser_roles = Admin_Users_Roles::all();
        foreach ($adminuser_roles as $k => $v) {
            $data[$v->uid] = $v->rid;
        }  
        // 获取角色数据
        $roles = Roles::all();
        foreach ($roles as $k => $v) {
            $temp[$v->id] = $v->rname;
        }
       return view('admin/adminuser/index',['data'=>$data,'temp'=>$temp,'admin_user'=>$admin_user,'params'=>$request->all()]);
    }

    /**
     * 显示添加管理员页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 获取角色数据
        $roles = Roles::all();
        return view('admin/adminuser/create',['roles'=>$roles]);
    }

    /**
     * 执行添加管理员操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // 手动操作事务 [ 两个表都插入数据成功 ]
        DB::beginTransaction();

        // 编写验证逻辑
        $this->validate($request, [
            'uname' => 'required|unique:admin_users',
            'upwd' => 'required',
            'reupwd' => 'required|same:upwd',
            'profile' => 'required',
            'rid' => 'required',
        ],[
            'uname.required'=>'请填写管理员名称',
            'uname.unique'=>'此用户已存在',
            'upwd.required'=>'请填写密码',
            'reupwd.required'=>'请确认密码',
            'reupwd.same'=>'两次密码不一致',
            'profile.required'=>'请选择一张图片',
            'rid.required'=>'请选择管理员权限',
        ]);

        // 判断管理员头像是否上传
        if($request->hasFile('profile')){
            // 创建文件上传对象
            $file_path = $request->file('profile')->store(date('Ymd'));
        }else{
            $file_path = '';
        }

        // 接收数据
        $adminuser['uname'] = $request->input('uname');
        $adminuser['upwd']  = Hash::make($request->input('upwd'));
        $adminuser['profile']  = $file_path;

        // 返回插入数据的id
        $uid = DB::table('admin_users')->insertGetId($adminuser);
        
        // 获取角色id
        $rid = $request->input('rid');

        // 保存 后台--管理员--角色的关系表
        $res = DB::table('admin_users_roles')->insert(['uid'=>$uid,'rid'=>$rid]);

        if($uid && $res){
            // 提交事务
            DB::commit();
            return redirect('admin/adminuser')->with('success','添加管理员成功');
        }else{
            // 回滚事务
            DB::rollBack();
            return back()->with('error','添加管理员失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 显示修改管理员页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 获取角色数据
        $roles = Roles::all();

        // 获取管理员信息
        $adminuser = Admin_Users::find($id);

        // 查询管理员的角色
        $data = DB::table('admin_users_roles')->where('uid',$id)->first();
        
        if($data){
             $role = $data->rid;
         }else{
            $role = '';
         }
       
        return view('admin/adminuser/edit',['roles'=>$roles,'adminuser'=>$adminuser,'role'=>$role]);
    }

    /**
     * 执行修改管理员数据操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'uname' => 'required',
            'rid' => 'required',
        ],[
            'uname.required'=>'请填写管理员名称',
            'rid.required'=>'请选择管理员权限',
        ]);

        // 判断文件是否上传
        if( $request->hasFile('profile') ) {
            // 删除以前的旧图片
            Storage::delete($request->input('profile_path'));
            $profile = $request->file('profile')->store( date('Ymd') );         // 接收并上传    
        } else {
            // 如果没有新的上传文件 就设置为隐藏域的图片
            $profile = $request->input('profile_path','');
        }
        
        // 获取管理员数据
        $adminuser = Admin_Users::find($id);
        $adminuser->uname = $request->input('uname');
        $adminuser->profile  = $profile;
        $res1 = $adminuser->save(); 

        // 获取角色数据
        $rid = $request->input('rid');
        $adminuser_roles = Admin_Users_Roles::where('uid',$id)->first();
        if($adminuser_roles){
            $adminuser_roles->rid = $rid;
            $res2 = $adminuser_roles->save();
        }else{
            $res2 = DB::table('admin_users_roles')->insert(['uid'=>$id,'rid'=>$rid]);
        }
        DB::beginTransaction();
        if($res1 && $res2){
            // 提交事务
            DB::commit();
            return redirect('/admin/adminuser/'.$id.'/edit')->with('success','修改管理员信息成功');
        }else{
            // 回滚事务
            DB::rollBack();
            return back()->with('error','修改管理员信息失败');
        }
    }

    /**
     * 删除管理员数据
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 删除管理员数据
        $res1 = Admin_Users::destroy($id);
        // 删除管理员绑定的角色记录
        $res2 = Admin_Users_Roles::where('uid',$id)->delete();
        DB::beginTransaction();
        if($res1 && $res2){
            DB::commit();
            return redirect('admin/adminuser')->with('success','删除管理员成功');
        }else{
            DB::rollBack();
            return back()->with('error','删除管理员失败');
        }
    }
}
