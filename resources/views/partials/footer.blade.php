<!-- jQuery 2.0.2 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script> -->
{!! HTML::script('plugins/jQuery/jQuery-2.1.4.min.js') !!}
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Bootstrap -->
{!! HTML::script('js/bootstrap.min.js') !!}


<!-- CK Editor -->
{!! HTML::script('plugins/ckeditor/ckeditor.js') !!}
<!-- Bootstrap WYSIHTML5 -->
{!! HTML::script('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') !!}

<!-- AdminLTE App -->
{!! HTML::script('js/app.min.js') !!}


<script>
	$(function () {
	// Replace the <textarea id="editor1"> with a CKEditor
	// instance, using default configuration.
	CKEDITOR.replace('description');
	//bootstrap WYSIHTML5 - text editor
	$(".textarea").wysihtml5();
	});
</script>

@yield('custom-footer')