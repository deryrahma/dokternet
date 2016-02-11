@extends( 'layouts.master' )

@section( 'custom-head' )
	{!! HTML::style( 'plugins/datatables/dataTables.bootstrap.css' ) !!}
@endsection

@section( 'custom-footer' )
	{!! HTML::script( 'plugins/datatables/jquery.dataTables.min.js' ) !!}
	{!! HTML::script( 'plugins/datatables/dataTables.bootstrap.min.js' ) !!}
	<script>
		$( function() {
			$( '.dataTable' ).DataTable( {
				"info": false,
				"searching": false,
				"lengthChange": false,
				"language": {
					"emptyTable": "Data tidak ditemukan!",
					"paginate": {
						"next": ">",
						"previous": "<",
						"first": "<<",
						"last": ">>"
					}
				}
			} );
		} );
	</script>
@endsection

@section( 'content' )
	@include( 'pages.admin.article.header' )
	<section class="content">
		@include( 'errors.session' )
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">
							Daftar Pesan Masuk &nbsp;&nbsp;&nbsp;
						</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-striped dataTable">
							<thead>
								<tr>
									<th>Judul</th>
									<th>Nama</th>
									<th>Email</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
								@foreach( $data as $row )
									<tr>
										<td>{{ $row->title }}</td>
										<td>{{ $row->name }}</td>
										<td>{{ $row->email }}</td>
										<td>
											<a href="{!! route( 'admin.contact-us.show', [$row->id] ) !!}" class="fa fa-info-circle"></a>&nbsp;
											<a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'admin.contact-us.delete', [$row->id] ) !!}" class="fa fa-trash-o"></a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
	@include( 'scripts.delete-modal' )
@endsection