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
        //compact 向视图中传参
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
        //except：排除
        $input = Input::except('_token');
        $rules = [
            'cate_name' => 'required',
            'cate_order' => 'required',
        ];
        $massages = [
            'cate_name.required' => '分类名称不能为空',
            'cate_order.required' => '排序不能为空'
        ];
        $valid = Validator::make($input,$rules,$massages);
        if ($valid->passes()) {
            $re = Category::create($input);
            if($re){
                return redirect('category');
            }else{
                return back()->with('errors','数据添加失败，请重试！');
            }
        }else{
            return back()->withErrors($valid);
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
    public function edit($cate_id)
    {
        $field = Category::find($cate_id);
        $data = Category::where('cate_pid',0)->get();
        return view('admin.category.edit',compact('field','data'));
    }

    /**
     * Update the specified resource in storage.
     * 更新存储中的指定资源
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cate_id)
    {
        $input = Input::except('_token','_method');
        $rules = [
            'cate_name' => 'required',
            'cate_order' => 'required',
        ];
        $massages = [
            'cate_name.required' => '分类名称不能为空',
            'cate_order.required' => '排序不能为空',
        ];
        $valid = Validator::make($input,$rules,$massages);
        if ($valid->passes()) {
            $re = Category::where('cate_id',$cate_id)->update($input);
            if ($re) {
                return redirect('category');
            }else{
                return back()->with('errors','数据更新失败，请重试');
            }
        }else{
            return back()->withErrors($valid);
        }
    }

    /**
     * Remove the specified resource from storage.
     * 从存储中删除指定的资源
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cate_id)
    {
        $input = Input::except('_token','_method');
        $count = Category::where('cate_pid',$cate_id)->count();
        //dd($res);
        if ($count == 0) {
            $re = Category::where('cate_id',$cate_id)->delete();
            if($re){
                $data = [
                    'status' => 0,
                    'msg' => '分类删除成功'
                ];
            }else{
                $data = [
                    'status' => 1,
                    'msg' => '分类删除失败，请重试'
                ];
            }
        }else{
            $data = [
                'status' => 11,
                'msg' => '分类下有子分类，无法删除,请先删除子分类'
            ];
        }
        
        return $data;
    }
}
