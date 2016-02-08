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
				"dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
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
	@include( 'pages.admin.spec-cat.header' )
	<section class="content">
		@include( 'errors.session' )
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">
							Daftar Kategori Spesialisasi &nbsp;&nbsp;&nbsp;
							<a href="{!! route( 'admin.spec-cat.create' ) !!}" class="btn btn-primary btn-sm">Tambah Kategori Spesialisasi</a>
						</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-striped dataTable">
							<thead>
								<tr>
									<th>Nama</th>
									<th class="col-md-1"></th>
								</tr>
							</thead>
							<tbody>
								@foreach( $data['content'] as $row )
									<tr>
										<td>{{ $row->name }}</td>
										<td>
											<a href="{!! route( 'admin.spec-cat.edit', [$row->id] ) !!}" class="fa fa-pencil-square-o"></a>
											<a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'admin.spec-cat.delete', [$row->id] ) !!}" class="fa fa-trash-o"></a>
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