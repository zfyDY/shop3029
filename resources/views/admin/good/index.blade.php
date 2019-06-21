<!doctype html>
<html lang="en">
<head>
@include('admin/public/header')
<style>
	th{text-align:center;line-height: 50px;}
	.form-body{margin: 25px 30px;}
	.form-group label{font-size: 22px;font-family: 幼圆;position: relative;top: 3px;}
	#hidden{overflow:hidden;
    	text-overflow:ellipsis;
    	white-space:nowrap;}
</style>
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- 导航栏 开始 -->
		@include('admin/public/navber')
		<!-- 导航栏 结束 -->
		
		<!-- 后台 左侧边栏 开始 -->
		@include('admin/public/sidebar')
		<!-- 后台 左侧边栏 结束 -->


		<!-- 后台 首页 主体 开始 -->
		<div class="main">
			<h1 style="vertical-align: inherit;margin:15px;">商品列表</h1>

			<!-- 读取验证 提示信息 开始 -->
			@include('admin/public/tips')
			<!-- 读取验证 提示信息 结束 -->
			
			<!-- 搜索框开始 -->
				<div class="form-body" data-example-id="simple-form-inline">
					<form class="form-inline" action="/admin/good" method="get"> 
						<div class="form-group"> 
							<label for="title">标题&nbsp;</label> 
							<input type="text" class="form-control" name="search_title" value="{{ $params['search_title'] or '' }}" id="title" placeholder="标题"> &nbsp;&nbsp;&nbsp;&nbsp;
						</div> 
						<input type="submit" value="搜索" class="btn btn-info">
						<!-- <input type="reset"  value="重置" class="btn btn-primary"> -->
					</form> 
				</div>
			<!-- 搜索框结束 -->


			<!-- 显示 用户列表 开始 -->
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">显示商品信息</h3>
				</div>
				<table class="table table-bordered">
					<tr>
						<th>商品ID</th>
						<th>标题</th>
						<th>图片</th>
						<th>最低价</th>
						<th>库存</th>
						<th>浏览量</th>
						<th>所属栏目</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
					@foreach($goods as $k=>$v)
					<tr align="center">
						<th style="line-height:100px;">{{ $v->id }}</th>
						<td style="line-height:100px;">
							<p title="{{ $v->title }}" style="width:250px" id="hidden">{{ $v->title }}</p>
						</td>
						<td>
							<img src="/uploads/{{$v->pic}}" class="img-thumbnail" style="width:120px;" alt="">
						</td>
						<td style="line-height:100px;">{{ $v->price }}</td>
						<td style="line-height:100px;">{{ $v->number }}</td>
						<td style="line-height:100px;">{{ $v->store}}</td>
						<td style="line-height:100px;">{{ $v->cate_id }}</td>
						<td style="line-height:100px;">
							@if($v->status == 0)
						  	<a href="/admin/good/wakeUp/{{ $v->id }}" class="btn btn-warning">上架</a>
						  	@else
						  	<a href="/admin/good/wakeUp/{{ $v->id }}" class="btn btn-primary">下架</a>
						  	@endif
						</td>
						<td style="line-height:100px;width:185px;">
							<a href="/admin/good/{{ $v->id }}/edit" class="btn btn-success">修改</a>
							<form action="/admin/detail/index/{{$v->id}}" method="get" style="display:inline-block;">
								<input type="submit" value="详情" class="btn btn-info">
							</form>
						</td>
					</tr>
					@endforeach
				</table>

				<!-- 显示分页开始 -->
				<div style="margin:10px;"> 
					{{ $goods->appends($params)->links() }}
				</div>
				<!-- 显示分页结束 -->
			</div>
			<!-- 显示 用户列表 开始 -->
		</div>
		<!-- 后台 首页 主体 结束 -->

		<div class="clearfix"></div>
		
		<!-- 页脚 开始 -->
		@include('admin/public/footer')
		<!-- 页脚 结束 -->

	</div>
	<!-- END WRAPPER -->
	
	<!-- JavaScript 开始 -->
	@include('admin/public/script')
	<!-- JavaScript 结束 -->

</body>

</html>
