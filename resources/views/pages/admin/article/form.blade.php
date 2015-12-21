@include( 'pages.admin.article.header' )
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ $title }} Kiriman Artikel</h3>
				</div>
				<div class="box-body table-responsive">
					@include( 'errors.session' )
					@if( $data['content'] == null )
						{!! BootForm::open()
									->multipart()
									->action( route( 'admin.article.store' ) ) !!}
					@else
						{!! BootForm::open()
									->put()
									->multipart()
									->action( route( 'admin.article.update', [$data['content']->id] ) ) !!}
						{!! BootForm::bind( $data['content'] ) !!}
					@endif
						<div class="box-body">
							{!! BootForm::text( 'Judul:', 'title' ) !!}
							{!! BootForm::textarea( 'Deskripsi:', 'description' ) !!}
							{!! BootForm::file( 'Gambar:', 'image' ) !!}
							@if( $data['content'] != null )
								<img src="{!! url( 'img/article/'.$data['content']->image ) !!}" style="max-height: 300px; max-width: 300px">
								<br><br>
							@endif
							{!! BootForm::select( 'Kategori:', 'article_category_id', $data['article_category'] ) !!}
							{!! BootForm::submit( 'Simpan' ) !!}
						</div>
					{!! BootForm::close() !!}
				</div>
			</div>
		</div>
	</div>
</section>