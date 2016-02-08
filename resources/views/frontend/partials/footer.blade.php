<footer class="footer">
	<div class="container">
		<div class="row">
			<div class="col-xs-9 bottom-menu">
				<ul>
				@if(isset($data['article']))
					@foreach( $data['article'] as $row )
					<li>
						<a href="{!! route('home.article.show',[urlencode($row->name)]) !!}">
							{!! $row->name !!}
						</a>
					</li>
					@endforeach
				@endif
				</ul>
					
			</div>
			<div class="col-xs-3 pull-right">
				<div >
					<ul class="list-inline list-social">
						<li>
							<a href="#"><i class="fa fa-facebook-square"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-google-plus-square"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-twitter-square"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-linkedin-square"></i></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<small>Jl. Raya ITS, No. 3 Surabaya | Telp. (085) 747 2121 68 | admin@dokternet.com</small>
			</div>
		</div>
	</div>
	
	<div class="footer-copyright">
		<p style="padding-bottom: 10px">
			<small>Copyright © 2015 PT. Dokternet Indonesia. All rights reserved. </small>
		</p>
	</div>
</footer>

<!-- scripts -->
{!! HTML::script('plugins/jQuery/jQuery-2.1.4.min.js') !!}
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
{!! HTML::script('js/bootstrap.min.js') !!}
@yield('custom-footer')