<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Nodes;
use App\Models\Roles;
use App\Models\Roles_Nodes;
use DB;

class RoleController extends Controller
{
    // 封装控制器的名称
    public static function controller()
    {
        return [
            'AdminuserController'=>'后台管理员',
            'AdveController'=>'广告位管理',
            'BannerController'=>'轮播图管理',
            'CateController'=>'栏目管理',
            'DetailController'=>'商品详情',
            'GoodController'=>'商品管理',
            'GoodSpuController'=>'商品规格管理',
            'IndexController'=>'后台首页',
            'LinkController'=>'友情链接管理',
            'LoginController'=>'登录管理',
            'NodeController'=>'权限管理',
            'RoleController'=>'角色管理',
            'UserController'=>'用户管理',
        ];
    }

    // 封装权限的添加遍历
    public static function auth()
    {
        // 获取所有权限的信息
        $nodes_data = Nodes::all();
        $list = [];
        foreach($nodes_data as $k=>$v){
            // 遍历值重新放到空数组中
            $temp['id'] = $v->id;
            $temp['aname'] = $v->aname;
            $temp['desc'] = $v->desc;
            $list[$v->cname][] = $temp;
        }
        return $list;
    }

    /**
     * 显示角色列表页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 接收搜索条件
        $search_rname = $request->input('search_rname');

        $roles = Roles::where('rname','like','%'.$search_rname.'%')
                        ->paginate(4);

        return view('admin/role/index',['roles'=>$roles,'params'=>$request->all()]);
    }

    /**
     * 显示角色添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/role/create',['list'=>self::auth(),'controller'=>self::controller()]);
    }

    /**
     * 执行角色修改操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // dd($request->all());

        // 手动操作事务 [ 两个表都插入数据成功 ]
        DB::beginTransaction();

        // 编写验证逻辑
        $this->validate($request, [
            'rname' => 'required',
            'nids' => 'required',
        ],[
            'rname.required'=>'请填写角色名称',
            'nids.required'=>'请选择权限',
        ]);

        // 获取数据
        $rname = $request->input('rname');

        // 返回插入的角色id
        $rid = DB::table('roles')->insertGetId(['rname'=>$rname]);

        // 遍历记录并保存 权限和角色的关系 
        $nids  = $request->input('nids');
        foreach ($nids as $k => $v) {
            $res = DB::table('roles_nodes')->insert(['rid'=>$rid,'nid'=>$v]);
        }

        if($rid && $res){
            // 提交事务
            DB::commit();
            return redirect('admin/role')->with('success','添加角色成功');
        }else{
            // 回滚事务
            DB::rollBack();
            return back()->with('error','添加角色失败');
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
     * 显示 修改角色权限的页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {
        // 获取权限数据
        $list = self::auth();

        // 获取角色名称
        $role = DB::table('roles')->where('id',$id)->first();

        // 获取角色权限
        $node = DB::table('roles_nodes')->where('rid',$id)->get();
        foreach ($node as $k => $v) {
           $temp[$v->rid][] = $v->nid;
        }

        // 设置多选框遍历时默认被选中的值[数组]
        if(!empty($temp)){
            $temp = $temp[$id];
        }else{
            $temp = ['1'];
        }
        

        // 加载视图
        return view('admin/role/edit',['list'=>$list,'role'=>$role,'temp'=>$temp,'controller'=>self::controller()]);
    }

    /**
     * 执行修改角色的操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        // 编写验证逻辑
        $this->validate($request, [
            'rname' => 'required',
            'nids' => 'required',
        ],[
            'rname.required'=>'请填写角色名称',
            'nids.required'=>'请选择权限',
        ]);

        // 获取角色名称
        $role = Roles::find($id);
        $role->rname = $request->input('rname','');
        $res1 = $role->save();

        // 如果角色名称修改成功
        if($res1){
            // 获取修改的权限id
            $nids  = $request->input('nids');    

            // 找出数据库表的原来数据,全部删掉
            $delete = Roles_Nodes::where('rid',$id)->delete();

            // 插入新的权限
            foreach ($nids as $k => $v) {
                $res2 = DB::table('roles_nodes')->insert(['rid'=>$id,'nid'=>$v]);
            }
            if($res2){
                return redirect('/admin/role/'.$id.'/edit')->with('success','修改角色详情成功');
            }else{
                return back()->with('error','修改角色详情失败3');
            }
        }else{
            return back()->with('error','修改角色详情失败1');
        }     
    }

    /**
     * 执行删除角色的操作
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 删除角色数据
        $res1 = Roles::destroy($id);
        // 删除 角色记录的权限
        $res2 = Roles_Nodes::where('rid',$id)->delete();
        DB::beginTransaction();
        if($res1 && $res2){
            DB::commit();
            return redirect('admin/role')->with('success','删除角色成功');
        }else{
            // 回滚
            DB::rollBack();
            return back()->with('error','删除角色失败');
        }
    }
}
