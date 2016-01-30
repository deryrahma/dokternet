@if(Session::has('success') || Session::has('danger') || Session::has('warning') || Session::has('info')|| Session::has('failed'))
<div class="alert 
	@if(Session::has('success'))
		alert-success
	@elseif(Session::has('danger'))
		alert-danger
	@elseif(Session::has('warning'))
		alert-warning
	@elseif(Session::has('info'))
		alert-info
	@elseif(Session::has('failed'))
		alert-danger
	@endif
	" role="alert">
	<p>
	@if(Session::has('success'))
		{!! Session::get('success') !!}
	@elseif(Session::has('failed'))
		{!! Session::get('failed') !!}
	@elseif(Session::has('danger'))
		{!! Session::get('danger') !!}
	@elseif(Session::has('warning'))
		{!! Session::get('warning') !!}
	@elseif(Session::has('info'))
		{!! Session::get('info') !!}
	@endif
	</p>
</div>
@endif