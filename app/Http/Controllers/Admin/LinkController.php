<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Links;

class LinkController extends Controller
{
    /**
     * 显示友情链接列表页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 接收搜索条件
        $search_title = $request->input('search_title');
        $search_url = $request->input('search_url');

        $links = Links::where('title','like','%'.$search_title.'%')
                        ->where('url','like','%'.$search_url.'%')
                        ->paginate(5);
        return view('admin/link/index',['links'=>$links,'params'=>$request->all()]);
    }

    /**
     * 显示添加友情链接页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/link/create');
    }

    /**
     * 存储新友情链接
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 编写验证逻辑
        $this->validate($request, [
            'title' => 'required',
            'url' => 'required',
        ],[
            'title.required'=>'请填写链接标题',
            'url.required'=>'请填写链接地址',
        ]);
        // 获取数据
        $link = new Links;
        $link->title = $request->input('title');
        $link->url = $request->input('url');

        // 保存数据
        $res = $link->save();
        if($res){
            return redirect('admin/link')->with('success','添加友情链接成功');
        }else{
            return back()->with('error','添加友情链接失败');
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
     * 显示修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $link = Links::find($id);
        return view('admin/link/edit',['link'=>$link]);
    }

    /**
     * 保存修改
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 编写验证逻辑
        $this->validate($request, [
            'title' => 'required',
            'url' => 'required',
        ],[
            'title.required'=>'请填写链接标题',
            'url.required'=>'请填写链接地址',
        ]);
        // 获取数据
        $link = Links::find($id);
        $link->title = $request->input('title');
        $link->url = $request->input('url');

        // 保存数据
        $res = $link->save();
        if($res){
            return redirect('/admin/link/'.$id.'/edit')->with('success','修改友情链接成功');
        }else{
            return back()->with('error','修改友情链接失败');
        }
    }

    /**
     * 删除友情链接
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Links::destroy($id);
        if($res){
            return redirect('admin/link')->with('success','删除链接成功');
        }else{
            return back()->with('error','删除链接失败');
        }
    }

    /**
     * 快速激活链接
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function wakeUp()
    {
        // 获取要修改状态的轮播图的数据
        $id = $_GET['id'];
        $links = Links::where('id',$id)->first();
        // 获取状态
        $status = $_GET['status'];      
        // 改变状态
        if($status){
            $status = 0;
        }else{
            $status = 1;
        }
        // 保存数据
        $links->status = $status;
        $res = $links->save();
        if($res){
            echo 'ok';
        }else{
            return back()->with('error','激活轮播图失败');
        }
    }
}
