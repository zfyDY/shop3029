<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Adves;
use Storage;

class AdveController extends Controller
{
    /**
     * 显示广告位列表页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        // 接收搜索条件
        $search_title = $request->input('search_title');
        $search_url = $request->input('search_url');

        $adves = Adves::where('title','like','%'.$search_title.'%')
                        ->where('url','like','%'.$search_url.'%')
                        ->paginate(5);
        return view('admin/adve/index',['adves'=>$adves,'params'=>$request->all()]);
    }

    /**
     *显示添加广告位页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/adve/create');
    }

    /**
     * 存储新广告位
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
            'profile' => 'required',
        ],[
            'title.required'=>'请填写链接标题',
            'url.required'=>'请填写链接地址',
            'profile.required'=>'请选择一张图片',
        ]);


        // 接收上传广告图
        if($request->hasFile('profile')){
            // 创建文件上传对象
            $file_path = $request->file('profile')->store(date('Ymd'));
        }else{
            $file_path = '';
        }

        // 获取数据
        $adve = new Adves;
        $adve->title = $request->input('title');
        $adve->url = $request->input('url');
        $adve->profile = $file_path;
        // 保存数据
        $res = $adve->save();
        if($res){
            return redirect('admin/adve')->with('success','添加广告成功');
        }else{
            return back()->with('error','添加广告失败');
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
        $adve = Adves::find($id);
        return view('admin/adve/edit',['adve'=>$adve]);
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

        // 检测新的广告图是否上传
        if( $request->hasFile('profile') ) {
            // 删除以前的旧图片
            Storage::delete($request->input('profile_path'));
            $profile = $request->file('profile')->store( date('Ymd') );         // 接收并上传    
        } else {
            // 如果没有新的上传文件 就设置为隐藏域的图片
            $profile = $request->input('profile_path','');
        }

        // 获取数据
        $adve = Adves::find($id);
        $adve->title = $request->input('title');
        $adve->url = $request->input('url');
        $adve->profile = $profile;
        $res = $adve->save();
        if($res){
            return redirect('/admin/adve/'.$id.'/edit')->with('success','修改广告信息成功');
        }else{
            return back()->with('error','修改广告信息失败');
        }

    }

    /**
     * 删除广告位
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $res = Adves::destroy($id);
        if($res){
            return redirect('admin/adve')->with('success','删除广告成功');
        }else{
            return back()->with('error','删除广告失败');
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
        $adve = Adves::where('id',$id)->first();
        // 获取状态
        $status = $_GET['status'];      
        // 改变状态
        if($status){
            $status = 0;
        }else{
            $status = 1;
        }
        // 保存数据
        $adve->status = $status;
        $res = $adve->save();
        if($res){
            echo 'ok';
        }else{
            return back()->with('error','激活轮播图失败');
        }  
    }
}
