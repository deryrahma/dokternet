@include( 'pages.admin.spec-cat.header' )
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ $title }} Kategori Spesialisasi</h3>
				</div>
				<div class="box-body table-responsive">
					@if( $data['content'] == null )
						{!! BootForm::open()->action( route( 'admin.spec-cat.store' ) ) !!}
					@else
						{!! BootForm::open()->put()->action( route( 'admin.spec-cat.update', [$data['content']->id] ) ) !!}
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