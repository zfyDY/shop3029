<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cates;
use DB;

class CateController extends Controller
{
    // 封装静态函数 栏目分级显示
    public static function getCatesData()
    {
        // 将栏目进行排序
        $cates = Cates::select('*',DB::raw("concat(path,',',id) as paths"))->orderBy('paths','asc')->get();
        foreach ($cates as $key => $value) {
            // 计算路径中逗号的数量
            $num = substr_count($value->path, ',');
            // 重复使用字符串
            $cates[$key]->cname = str_repeat('|-----', $num).$value->cname;
        }  
        return $cates;
    }

    /**
     * 显示分类列表页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         // 接收搜索条件
        // $search_cname = $request->input('search_cname');
        // $cates = Cates::where('cname','like','%'.$search_cname.'%');

        return view('admin/cate/index',['cates'=>self::getCatesData()]);
    }

    /**
     * 显示添加分类页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $id = $request->input('id');
        // $a = self::getCatesData();
        // foreach($a as $k=>$v){
        //     $b = ;
        //     $n = ;
        //     echo $b.'-----------'.$n,'<br>';
        // }
        // die;
       
        return view('admin/cate/create',['id'=>$id,'cates'=>self::getCatesData()]);
    }

    /**
     * 存储新分类
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // 编写验证逻辑
        $this->validate($request, [
            'cname' => 'required|unique:cates|max:5',
        ],[
            'cname.required'=>'请填写栏目名称',
            'cname.unique'=>'此栏目名称已存在',
            'cname.max'=>'栏目名称不能超过5个字符',
        ]);

        // 获取pid
        $pid = $request->input('pid',0);
        // 设置栏目的路径
        if($pid == 0){
            $path = 0; 
        }else{
            // 获取父级数据
            $parent_date = Cates::find($pid);      // 栏目的pid为父级的id
            $path = $parent_date->path.','.$parent_date->id;    // 栏目的路径为父级的路径+父级的id
        }
        // 压入数据到数据库
        $cate = new Cates;
        $cate->cname = $request->input('cname','');
        $cate->pid = $pid;
        $cate->path = $path;
        $res = $cate->save();
        if($res){
            return redirect('/admin/cate')->with('success','添加栏目成功');
        }else{
            return back()->with('error','添加栏目失败');
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
     *显示修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
