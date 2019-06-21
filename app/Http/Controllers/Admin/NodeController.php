<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Nodes;

class NodeController extends Controller
{
    /**
     * 显示权限列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 获取权限数据
        // $nodes = Nodes::all();

         // 接收搜索条件
        $search_desc = $request->input('search_desc');
        $search_cname = $request->input('search_cname');
        $search_aname = $request->input('search_aname');

        $nodes = Nodes::where('desc','like','%'.$search_desc.'%')
                        ->where('cname','like','%'.$search_cname.'%')
                        ->where('aname','like','%'.$search_aname.'%')
                        ->paginate(10);
        
        // 加载视图
        return view('admin/node/index',['nodes'=>$nodes,'params'=>$request->all()]);
    }

    /**
     * 显示添加权限的页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/node/create');
        
    }

    /**
     * 执行添加权限的操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // 编写验证逻辑
        $this->validate($request, [
            'desc' => 'required',
            'cname' => 'required',
            'aname' => 'required',
        ],[
            'desc.required'=>'请填写权限名称',
            'cname.required'=>'请填写控制器名称',
            'aname.required'=>'请填写方法名称',
        ]);

        // 获取数据
        $node = new Nodes;
        $cname = $request->input('cname');
        $node->cname = $cname.'Controller';
        $node->aname = $request->input('aname');
        $node->desc = $request->input('desc');
        $res = $node->save();
        if($res){
            return redirect('admin/node')->with('success','添加权限成功');
        }else{
            return back()->with('error','添加权限失败');
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
     * 显示修改权限的页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {
        // 获取权限数据
        $node = Nodes::find($id);

        $cname = $node->cname;
        $cname =str_replace('Controller', '', $cname);

        return view('admin/node/edit',['cname'=>$cname,'node'=>$node]);
    }

    /**
     * 执行修改权限的操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
         // 编写验证逻辑
        $this->validate($request, [
            'desc' => 'required',
            'cname' => 'required',
            'aname' => 'required',
        ],[
            'desc.required'=>'请填写权限名称',
            'cname.required'=>'请填写控制器名称',
            'aname.required'=>'请填写方法名称',
        ]);

        $node = Nodes::find($id);
        $cname = $request->input('cname');
        $node->cname = $cname.'Controller';
        $node->aname = $request->input('aname');
        $node->desc = $request->input('desc');

        // 保存数据
        $res = $node->save();
        if($res){
            return redirect('/admin/node/'.$id.'/edit')->with('success','修改权限成功');
        }else{
            return back()->with('error','修改权限失败');
        }
    }

    /**
     * 执行删除权限的操作
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return view('admin/node/destroy');
    }
}
