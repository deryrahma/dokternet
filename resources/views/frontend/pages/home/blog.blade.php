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
					Blog
				</h3>
			</div>
		</div>
		<div class="col-md-12 blog-page">
			
			<ul>
				@foreach($data['content'] as $row)
				<li>
					<a href="{!! route('home.article.show', [urlencode($row->title)]) !!}">
						<h4 class="title">{!! $row->title !!}</h4>
					</a>
					<div class="detail-article">
						<i class="fa fa-calendar"></i> {!! date('l, d M Y', strtotime($row->created_at)) !!} &nbsp;&nbsp;&nbsp;
						<i class="fa fa-user"></i> Dokternet Jurnalis
					</div>
					<p>
						@if(count($row->description) > 150)
						{!! substr(strip_tags($row->description), 0, 150) !!}
						@else
						{!! strip_tags($row->description) !!}
						@endif
						<a href="{!! route('home.article.show', [urlencode($row->title)]) !!}">
						 Selengkapnya
						</a>
					</p>
				</li>
				@endforeach
			</ul>
			
		</div>
	</div>
@endsection