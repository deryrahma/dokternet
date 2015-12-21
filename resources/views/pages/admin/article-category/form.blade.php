@include( 'pages.admin.article-category.header' )
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ $title }} Kategori Artikel</h3>
				</div>
				<div class="box-body table-responsive">
					@if( $data['content'] == null )
						{!! BootForm::open()->action( route( 'admin.article-category.store' ) ) !!}
					@else
						{!! BootForm::open()->put()->action( route( 'admin.article-category.update', [$data['content']->id] ) ) !!}
						{!! BootForm::bind( $data['content'] ) !!}
					@endif
						<div class="box-body">
							{!! BootForm::text( 'Nama Kategori:', 'name' ) !!}
							{!! BootForm::submit( 'Simpan' ) !!}
						</div>
					{!! BootForm::close() !!}
				</div>
			</div>
		</div>
	</div>
</section>