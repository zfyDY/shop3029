<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Cates;
use Storage;

class GoodController extends Controller
{
    /**
     * 显示商品列表页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 接收搜索条件
        $search_title = $request->input('search_title');
        // $search_cate = $request->input('search_cate');

        $goods = Goods::where('title','like','%'.$search_title.'%')
                        // ->where('phone','like','%'.$search_cate.'%')
                        ->paginate(4);

        return view('admin/good/index',['goods'=>$goods,'params'=>$request->all()]);
    }

    /**
     * 显示添加商品页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 获取商品分类信息
        $cates = CateController::getCatesData();
        return view('admin/good/create',['cates'=>$cates]);
    }

    /**
     * 添加并保存新的商品
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 编写验证逻辑
        $this->validate($request, [
            'gname' => 'required',
            'title' => 'required',
            'id' => 'required',
            'price_min' => 'required',
            'profile' => 'required',
        ],[
            'gname.required'=>'请填写商品名称',
            'title.required'=>'请填写商品标题',
            'id.required'=>'请选择商品分类',
            'price_min.required'=>'请填写商品价格',
            'profile.required'=>'请选择一张图片',
        ]);
        // 获取图片数据
        if($request->hasFile('profile')){
            // 创建文件上传对象
            $file_path = $request->file('profile')->store(date('Ymd'));
        }else{
            $file_path = '';
        }
        // 获取数据
        $good = new Goods;
        $good->gname = $request->input('gname');            // 商品名称
        $good->title = $request->input('title');            // 商品标题
        $good->price_min = $request->input('price_min');    // 商品最低价格
        $good->pic = $file_path;                            // 商品图片
        $good->number = mt_rand(123,4321);

        // 获取所属三级栏目的id
        $good->cate_id = $request->input('id');             

        // 获取所属三级栏目信息
        $cate = Cates::find($good->cate_id);
        // 获取pid,通过pid查找二级栏目的信息
        $cate_pid = $cate->pid;

        // 获取所属二级栏目的id
        $good->cate_two_id = $cate_pid;           
        $good->status = 0;

        // 保存数据
        $res = $good->save();
        if($res){
            return redirect('admin/good')->with('success','添加商品成功');
        }else{
            return back()->with('error','添加商品失败');
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
     * 显示修改商品页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 获取 商品分类 信息
        $cates = CateController::getCatesData();

        // 获取传递id的商品信息
        $good_date = Goods::find($id);

        return view('admin/good/edit',['cates'=>$cates,'good_date'=>$good_date]);
    }

    /**
     * 保存修改商品
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         // 编写验证逻辑
        $this->validate($request, [
            'gname' => 'required',
            'title' => 'required',
            'cate_id' => 'required',
            'price_min' => 'required',
        ],[
            'gname.required'=>'请填写商品名称',
            'title.required'=>'请填写商品标题',
            'cate_id.required'=>'请选择商品分类',
            'price_min.required'=>'请填写商品价格',
        ]);
        // 获取图片数据
        if( $request->hasFile('profile') ) {
            // 删除旧图片
            // Storage::delete($request->input('pic_path'));
            $profile = $request->file('profile')->store( date('Ymd') );         // 接收并上传    
        } else {
            // 如果没有新的上传文件 就设置为隐藏域的图片
            $profile = $request->input('pic_path','');
        }
        // 修改商品数据
        $good = Goods::find($id);
        $good->gname = $request->input('gname');
        $good->title = $request->input('title');
        $good->cate_id = $request->input('cate_id');
        $good->price_min = $request->input('price_min');
        $good->pic = $profile;

        // 获取所属三级栏目信息
        $cate = Cates::find($good->cate_id);
        // 获取pid,通过pid查找二级栏目的信息
        $cate_pid = $cate->pid;
        // 获取所属二级栏目的id
        $good->cate_two_id = $cate_pid;

        // 保存修改后的数据
        $res = $good->save();
        if($res){
            return redirect('/admin/good/'.$id.'/edit')->with('success','修改商品信息成功');
        }else{
            return back()->with('error','修改商品信息失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 执行并保存激活商品的状态
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function wakeUp($id)
    {
        // 获取要修改状态的轮播图的数据
        $banner = Goods::where('id',$id)->first();
        $status = $banner->status;      // 获取状态

        // 改变状态
        if($status){
            $status = 0;
        }else{
            $status = 1;
        }
        $banner->status = $status;
        $res = $banner->save();
        if($res){
            return redirect('/admin/good');
        }else{
            return back()->with('error','激活失败');
        }
    }
}
