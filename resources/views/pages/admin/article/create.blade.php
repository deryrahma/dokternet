@extends( 'layouts.master' )

@section( 'content' )
	@include( 'pages.admin.article.form', [ 'title' => "Tambah" ] )
@endsection

@section('custom-footer')

	<!-- CK Editor -->
{!! HTML::script('plugins/ckeditor/ckeditor.js') !!}
<script>
	$(function () {
	// Replace the <textarea id="editor1"> with a CKEditor
	// instance, using default configuration.
	CKEDITOR.replace('description');
	//bootstrap WYSIHTML5 - text editor
	$(".textarea").wysihtml5();
	});
</script>
@endsection