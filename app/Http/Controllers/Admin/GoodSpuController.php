<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GoodSpus;
use App\Models\Cates;

class GoodSpuController extends Controller
{
    /**
     * 显示商品规格列表页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取商品三级分类和二级分类
         $cates = CateController::getCatesData();
         $spu_cate = [];
         $spu_cate_two = [];
         foreach ($cates as $key => $value) {
            // 二级
            if(substr_count($value->path,',') == 1 ){
                $spu_cate_two[$value->id] = $value->cname;
            }
            // 三级
            if(substr_count($value->path,',') == 2 ){
                $spu_cate[$value->id] = $value->cname;
            }
         }
        // 获取规格数据
        $goodspus = GoodSpus::all();
        return view('admin/goodspu/index',['goodspus'=>$goodspus,'spu_cate'=>$spu_cate,'spu_cate_two'=>$spu_cate_two]);
    }

    /**
     * 添加新的商品规格
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 获取商品分类信息
         $cates = CateController::getCatesData();
        return view('admin/goodspu/create',['cates'=>$cates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 编写验证逻辑
        $this->validate($request, [
            'spu_name' => 'required',
            'pid' => 'required',
        ],[
            'spu_name.required'=>'请填写规格',
            'pid.required'=>'请选择规格分类',
        ]);
        // 获取数据
        $spu = new GoodSpus;
        $spu->spu_name = $request->input('spu_name');

        // 获取所属三级分类信息
        $spu->spu_cate = $request->input('pid');

        // 获取所属二级
        $spu->spu_cate_two = Cates::find($spu->spu_cate)->pid;
        
        // 保存数据
        

        // dd($request->all());
        $res = $spu->save();
        if($res){
            return redirect('admin/goodspu')->with('success','添加商品成功');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
