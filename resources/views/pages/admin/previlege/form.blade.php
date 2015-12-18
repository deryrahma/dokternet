@include( 'pages.admin.previlege.header' )
<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">{{ $title }} Hak Akses</h3>
					</div>
					<div class="box-body table-responsive">
						{!! BootForm::open(['model' => $data['content'], 'store' => 'admin.previlege.store', 'update' => 'admin.previlege.update']) !!}
							<div class="box-body">
								{!! BootForm::email( 'Email:', 'email' ) !!}
								{!! BootForm::text( 'Nama Depan:', 'first_name' ) !!}
								{!! BootForm::text( 'Nama Belakang:', 'last_name' ) !!}
								{!! BootForm::submit( 'Simpan' ) !!}
							</div>
						{!! BootForm::close() !!}
					</div>
				</div>
			</div>
		</div>
	</section>