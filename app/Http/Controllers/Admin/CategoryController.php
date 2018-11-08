<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Http\Model\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * 显示资源列表
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = (new Category)->tree();
        //dd($category);
        //$data = $this->getTree($category,'cate_name','cate_id','cate_pid');
        //dd($data);
        return view('admin.category.index')->with('data',$category);
    }

    /**
     * 异步修改排序
     * @return [type] [description]
     */
    public function changeOrder()
    {
        $input = Input::all();
        $cate = Category::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        $re = $cate->update();
        if ($re) {
            $data = [
                'status'=>0,
                'msg'=>'分类排序更新成功',
            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>'分类排序更新失败',
            ];
        }
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     * 显示用于创建新资源的表单
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Category::where('cate_pid',0)->get();
        return view('admin.category.add',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     * 在存储中存储新创建的资源
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($input = Input::all()) {
            $rules = [
                'cate_name' => 'required',
                'cate_pid' => 'required',
            ];
            $massages = [
                'cate_name.required' => '分类名称不能为空',
                'cate_pid.required' => ''
            ];
            $valid = Validator::make($input,$rules,$massages);
            if ($valid->passes()) {
                
            }else{
                return back()->withErrors($valid);
            }
        }else{
            
        }
        
    }

    /**
     * Display the specified resource.
     * 显示指定的资源
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * 显示用于编辑指定资源的窗体
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * 更新存储中的指定资源
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
     * 从存储中删除指定的资源
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
