<footer class="footer">
	<div class="container">
		<div class="col-xs-9 bottom-menu">
			<ul>
				@foreach( $data['article'] as $row )
				<li>
					<a href="{!! route('home.article.show',[urlencode($row->name)]) !!}">
						{!! $row->name !!}
					</a>
				</li>
				@endforeach
			</ul>
				
		</div>
		<div class="col-xs-3 pull-right">
			<div >
				<ul class="list-inline">
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
		<div class="col-md-12">
			
				Jl. Raya ITS, No. 3 Surabaya
			
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