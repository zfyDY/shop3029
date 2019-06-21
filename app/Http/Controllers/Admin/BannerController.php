<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banners;
use App\Http\Requests\StoreBanners;
use Storage;

class BannerController extends Controller
{
    /**
     *显示轮播图列表页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_title = $request->input('search_title');
        $search_desc = $request->input('search_desc');
        $search_url = $request->input('search_url');

        $banners = Banners::where('title','like','%'.$search_title.'%')
                            ->where('desc','like','%'.$search_desc.'%')
                            ->where('url','like','%'.$search_url.'%')
                            ->paginate(5);

        return view('admin/banner/index',['banners'=>$banners,'params'=>$request->all()]);
    }

    /**
     * 显示添加轮播图页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/banner/create');
    }

    /**
     * 存储新轮播图
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBanners $request)
    {
        // 检测图片是否上传
        if($request->hasFile('profile')){
            $file_path = $request->file('profile')->store(date('Ymd'));
        }
        // 获取数据
        $banner = new Banners;
        $banner->title   = $request->input('title');
        $banner->desc    = $request->input('desc');
        $banner->url     = $request->input('url');
        $banner->profile = $file_path;
        $banner->status  = 0;
        $res = $banner->save();
        if($res) {
            return redirect('admin/banner')->with('success','添加轮播图成功');
        } else {
            return back()->with('error','添加轮播图失败');
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
        $banner_date = Banners::find($id);
        return view('admin/banner/edit',['banner_date'=>$banner_date]);
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
            'title'=>'required|max:15',               // 标题不能为空
            'desc'=>'required|max:30',                // 描述不能为空
            'url'=>'required',
        ],[
            'title.required'=>'请填写标题 ',  
            'title.max'=>'标题不能超过15个字符 ',  
            'desc.required'=>'请填写描述 ',  
            'desc.max'=>'描述不能超过30个字符 ',  
            'url.required'=>'请填写URL地址',  
        ]);
        // 检测图片是否上传
        if( $request->hasFile('profile') ) {
            // 删除以前的旧图片
            Storage::delete($request->input('profile_path'));
            $profile = $request->file('profile')->store( date('Ymd') );         // 接收并上传    
        } else {
            // 如果没有新的上传文件 就设置为隐藏域的图片
            $profile = $request->input('profile_path','');
        }
        // 修改轮播图数据
        $banner = Banners::where('id',$id)->first();
        $banner->title = $request->input('title');
        $banner->desc = $request->input('desc');
        $banner->url = $request->input('url');
        $banner->profile = $profile;
        $res = $banner->save();
        if($res){
            return redirect('/admin/banner/'.$id.'/edit')->with('success','修改轮播图信息成功');
        }else{
            return back()->with('error','修改轮播图信息失败');
        }
    }

    /**
     * 删除轮播图
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Banners::destroy($id);
        if($res){
            return redirect('admin/banner')->with('success','删除轮播图数据成功');
        }else{
            return back()->with('error','删除轮播图数据失败');
        }
    }

     /**
     * 激活轮播图
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function wakeUp()
    {
        // 获取要修改状态的轮播图的数据
        $id = $_GET['id'];
        $banner = Banners::where('id',$id)->first();

        // 获取状态
        $status = $_GET['status'];      

        // 改变状态
        if($status){
            $status = 0;
        }else{
            $status = 1;
        }

        // 保存数据
        $banner->status = $status;
        $res = $banner->save();
        if($res){
            echo 'ok';
            // 返回 修改后的状态
          // return redirect('admin/banner')->with('success','激活轮播图成功');
        }else{
            return back()->with('error','激活轮播图失败');
        }
    }
}
