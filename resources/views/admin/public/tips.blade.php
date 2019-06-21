<!-- 读取验证 提示信息 开始 -->
@if(session('error'))
<div class="alert alert-danger alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="关">
		<span aria-hidden="true">
			<font style="vertical-align: inherit;">
				<font style="vertical-align: inherit;">×</font>
			</font>
		</span>
	</button>
	<i class="fa fa-times-circle"></i>
	<font style="vertical-align: inherit;">
		<font style="vertical-align: inherit;">{{ session('error') }}</font>
	</font>
</div>
@endif

@if(session('success'))
<div class="alert alert-success alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="关">
		<span aria-hidden="true">
			<font style="vertical-align: inherit;">
				<font style="vertical-align: inherit;">×</font>
			</font>
		</span>
	</button>
	<i class="fa fa-check-circle"></i>
	<font style="vertical-align: inherit;">
		<font style="vertical-align: inherit;">{{ session('success') }}
		</font>
	</font>
</div>
@endif
<!-- 读取验证 提示信息 结束 -->