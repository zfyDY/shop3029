123<!doctype html>
<html lang="en">
<head>
@include('admin/public/header')
<style>
	th{text-align:center;line-height: 50px;}
	.form-body{margin: 25px 30px;}
	.form-group label{font-size: 22px;font-family: 幼圆;position: relative;top: 3px;}
	#setCate{position: relative;top: 2px;}
	#search{position: relative;top: -9px;}
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
			<h1 style="vertical-align: inherit;margin:15px;">这里是栏目列表</h1>

			<!-- 读取验证 提示信息 开始 -->
			@include('admin/public/tips')
			<!-- 读取验证 提示信息 结束 -->

			<!-- 搜索框开始 -->
			<div class="form-body" data-example-id="simple-form-inline">
				<form class="form-inline" action="/admin/cate" method="get"> 
					<div class="form-group"> 
						<label for="cname">栏目名称&nbsp;</label> 
						<input type="text" class="form-control" name="search_cname" id="cname" placeholder="栏目名称">&nbsp;&nbsp;&nbsp;&nbsp;
					</div> 
					<input type="submit" value="搜索" class="btn btn-info" id="search">
					<!-- <input type="reset"  value="重置" class="btn btn-primary"> -->
				</form> 
			</div>
			<!-- 搜索框结束 -->

			<!-- 显示 用户列表 开始 -->
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">显示栏目级别</h3>
				</div>
				<table class="table table-bordered">
					<tr>
						<th>栏目ID</th>
						<th>栏目名</th>
						<th>父级栏目</th>
						<th>分类路径</th>
						<th>操作</th>
					</tr>
					@foreach($cates as $k=>$v)
					<tr align="center">
						<th style="line-height:30px;">{{ $v->id }}</th>
						<td><p style="line-height:30px;position:relative;left:180px;" class="text-left">{{ $v->cname }}</p></td>
						<td style="line-height:30px;">{{ $v->pid }}</td>
						<td style="line-height:30px;">{{ $v->path }}</td>
						<td style="line-height:30px;width:200px;">
							@if(substr_count($v->path,',')<2)
							<a href="/admin/cate/create?id={{$v->id}}" id="setCate" class="btn btn-info">添加子栏目</a>
							@endif
						</td>
					</tr>
					@endforeach

				<!-- 显示分页开始 -->
				<div style="margin:10px;"> 
					
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
