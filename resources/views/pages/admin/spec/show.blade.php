@extends( 'layouts.master' )

@section( 'content' )
	<section class="content-header">
		<h1>
			Detail Spesialisasi
			<small>Administrator</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Manajemen Spesialisasi</a></li>
			<li class="active">Detail Spesialisasi</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box" align="center">
					<div class="box-header with-border">
						<h3 class="box-title">
							{!! $data['content']->title !!}
							<br>
							<small>{!! $data['content']->article_category->name !!}</small>
						</h3>
					</div>
					<div class="box-body">
						@if( $data['content']->image != null )
							<img src="{!! asset( 'img/article/'.$data['content']->image ) !!}" style="max-height: 300px; max-width: 300px">
							<br><br>
						@endif
						{!! $data['content']->description !!}
						<br><br>
						<button type="button" class="btn btn-block btn-warning"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Sunting Artikel</button>
						<button type="button" href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'admin.article.delete', [$data['content']->id] ) !!}" class="btn btn-block btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus Artikel</button>
					</div>
				</div>
			</div>
		</div>
	</section>
	@include( 'scripts.delete-modal' )
@endsection