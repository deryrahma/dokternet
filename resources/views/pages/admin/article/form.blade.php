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
			                <div class="box box-info">
				                <div class="box-header">
				                  <h3 class="box-title">Deskripsi</h3>
				                  <!-- tools box -->
				                  <div class="pull-right box-tools">
				                    <button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
				                    <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				                  </div><!-- /. tools -->
				                </div><!-- /.box-header -->
				                <div class="box-body pad">
				                  <form>
				                    <textarea id="description" name="description" rows="10" cols="80">
				                      Ini adalah teks berisi deskripsi
				                    </textarea>
				                  </form>
				                </div>
				            </div><!-- /.box -->
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