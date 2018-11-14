@extends('layouts.admin')
@section('content')

<div class="content-wrapper">
<section class="content-header">
  <h1>
    全部分类
    
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> 首页</a></li>
    <!-- <li><a href="#">Tables</a></li> -->
    <li class="active">全部分类</li>
  </ol>
</section>
<section class="content">
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
      	<a href="{{URL('category/create')}}"><h3 class="box-title"><i class="fa fa-plus"></i>新增分类</h3></a>

        <div class="box-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

            <div class="input-group-btn">
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tr>
          	<th><input type="checkbox"></th>
          	<th>排序</th>
            <th>ID</th>
            <th>分类名称</th>
            <th>标题</th>
            <th>查看次数</th>
            <th>操作</th>
          </tr>

          @foreach($data as $v)
          <tr>
          	<td><input type="checkbox"></td>
            <td><input style="width:25px;text-align:center" type="text" onchange="changeOrder(this,{{$v->cate_id}})" value="{{$v->cate_order}}"></td>
            <td>{{$v->cate_id}}</td>
            <td>{{$v->_cate_name}}</td>
            <td>{{$v->cate_title}}</td>
            <td>2</td>
            <td><a href="{{url('category/'.$v->cate_id.'/edit')}}"><span class="label label-warning">修改</span></a> <a href="javascript:;" onclick="delCate({{$v->cate_id}},{{$v->cate_pid}})"><span class="label label-danger">删除</span></a></td>
          </tr>
          @endforeach
          
        </table>
      </div>
      <!-- /.box-body -->
      <!-- <div class="box-footer clearfix">
        <ul class="pagination pagination-sm no-margin pull-right">
          <li><a href="#">&laquo;</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">&raquo;</a></li>
        </ul>
      </div> -->
    </div>
    <!-- /.box -->
  </div>
</div>
</section>
</div>

@endsection
@section('script')
<!-- Slimscroll -->
<script src="{{asset('static/admin')}}/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script>
//异步更新
	function changeOrder(obj,cate_id){
		var cate_order = $(obj).val();
		console.log(cate_order);
		console.log(cate_id);
		$.post("{{url('cate/changeorder')}}",{'_token':'{{csrf_token()}}','cate_order':cate_order,'cate_id':cate_id},function(data){
			if (data.status==0) {
				layer.msg(data.msg,{icon:6});
			}else{
				layer.msg(data.msg,{icon:5});
			}
		})
	}

  //删除分类
  function delCate(cate_id,cate_pid){
    //alert(cate_id)
    layer.confirm('您确定要删除这个分类吗?',{
      btn:['确定','取消']
    },function(){
      $.post("{{url('category')}}/"+cate_id,{'_token':'{{csrf_token()}}','_method':'delete'},function(data){
        if (data.status==0) {
          layer.msg(data.msg,{icon:6});
          location.href = location.href;
        }else if(data.status==11){
          layer.msg(data.msg,{icon:5});
        }else{
          layer.msg(data.msg,{icon:5});
        }
      })
    },function(){

    })
  }
</script>
@endsection