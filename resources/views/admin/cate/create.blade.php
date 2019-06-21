<!doctype html>
<html lang="en">

<head>
@include('admin/public/header')

<style>
	.panel-body	h4{color: #666;}
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
			<h1 style="vertical-align: inherit;margin:15px;">栏目添加</h1>

			<!-- 显示验证错误 开始 -->
			@include('admin/public/error')
			<!-- 显示验证错误 结束 -->

			<!-- 读取验证 提示信息 开始 -->
			@include('admin/public/tips')
			<!-- 读取验证 提示信息 结束 -->


			<form action="/admin/cate" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="panel">
					<div class="panel-body">
						<div>
							<h4><font style="vertical-align: inherit;">栏目名</font></h4>
							<input type="text" name="cname" class="form-control" placeholder="请输入栏目名" value="{{ old('cname') }}">
						</div>
						<br>
						<div>
							<h4><font style="vertical-align: inherit;">所属栏目</font></h4>
							<select name="pid" id="" class="form-control">
								<option value="0">--请选择--</option>
								@foreach($cates as $k=>$v)
									@if(substr_count($v->path,',') < 2)
									<option value="{{$v->id}}"  style="color:#000" {{ $v->id == $id ? 'selected' : '' }}>{{ $v->cname }} </option>
									@else
									<option value="{{ $v->id }}" disabled>{{ $v->cname }}</option>
									@endif
								@endforeach
							</select>
						</div>
						<div class="col-md-6">
							<button type="submit" class="btn btn-success" style="width:70px;float:left;margin:20px 5px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">添加</font></font></button>
							<button type="reset"  class="btn btn-danger" style="width:70px;float:left;margin:20px 5px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">重置</font></font></button>
						</div>
					</div>
				</div>
			</form>
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
