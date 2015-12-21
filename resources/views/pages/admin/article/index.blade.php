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
	@include( 'pages.admin.article.header' )
	<section class="content">
		@include( 'errors.session' )
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">
							Daftar Kiriman Artikel &nbsp;&nbsp;&nbsp;
							<a href="{!! route( 'admin.article.create' ) !!}" class="btn btn-primary btn-sm">Tambah Kiriman Artikel</a>
						</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-striped dataTable">
							<thead>
								<tr>
									<th>Judul</th>
									<th>Kategori</th>
									<th class="col-md-1"></th>
								</tr>
							</thead>
							<tbody>
								@foreach( $data as $row )
									<tr>
										<td>{{ $row->title }}</td>
										<td>{{ $row->article_category->name }}</td>
										<td>
											<a href="{!! route( 'admin.article.show', [$row->id] ) !!}" class="fa fa-info-circle"></a>&nbsp;
											<a href="{!! route( 'admin.article.edit', [$row->id] ) !!}" class="fa fa-pencil-square-o"></a>
											<a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'admin.article.delete', [$row->id] ) !!}" class="fa fa-trash-o"></a>
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