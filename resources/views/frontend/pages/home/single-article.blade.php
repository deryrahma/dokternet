@extends( 'frontend.app' )

@section( 'custom-head' )
	
@endsection

@section( 'custom-footer' )
@endsection

@section( 'content' )
	<div class="row">
		<div class="col-md-12 blog-head">
			<div class="blog-head-content">
				<h3 class="text-center">
					{!! $data['content']->title !!}
				</h3>
			</div>
		</div>
		<div class="col-md-12 blog-page">
			<div class="row">
				<div class="col-md-12">
					<div class="detail-article">
						<i class="fa fa-calendar"></i> {!! date('l, d M Y', strtotime($data['content']->created_at)) !!} &nbsp;&nbsp;&nbsp;
						<i class="fa fa-user"></i> Dokternet Jurnalis
					</div>
				</div>
				<div class="col-md-6 col-md-offset-3">
					@if(File::exists('img/article/'.$data['content']->image) and !empty($data['content']->image))
					<img src="{!! asset('img/article/'.$data['content']->image) !!}" class="img-responsive img-thumbnail">
					@endif
				</div>
				<div class="col-md-12">
					{!! $data['content']->description !!}
				</div>
			</div>
		</div>
	</div>
@endsection