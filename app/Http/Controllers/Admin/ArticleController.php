<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Category;
use Illuminate\Support\Facades\Input;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     * 显示文章资源列表
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 112132;
    }

    /**
     * Show the form for creating a new resource.
     * 显示用于创建新资源的表单
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = (new Category)->tree();
        //dd($data);
        return view('admin.article.add',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
