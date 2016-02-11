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
	    <div class="row">
	            <div class="col-md-12">
	              <div class="box box-primary">
	                <div class="box-body no-padding">
	                  <div class="mailbox-read-info">
	                    <h3>Subject : {!! $data->title !!}</h3>
	                    <h5>Name: {!! $data->name !!}</h5>
	                    <h5>Website: {!! $data->website !!}</h5>
	                  <h5>Email: {!! $data->email !!} <span class="mailbox-read-time pull-right">{!! $data->created_at !!}</span></h5>
	                  </div><!-- /.mailbox-read-info -->
	                  <div class="mailbox-read-message">
	                    <h4>Deskripsi :</h4>
	                    {!! $data->description !!}
	                  </div><!-- /.mailbox-read-message -->
	                </div><!-- /.box-body -->
	                <div class="box-footer">
	                <a class="btn btn-primary" href="{!! URL::previous() !!}">Back</a>
	                </div><!-- /.box-footer -->
	                <div class="box-footer">
	                </div><!-- /.box-footer -->
	              </div><!-- /. box -->
	            </div><!-- /.col -->
	    </div>
	</section>
@endsection