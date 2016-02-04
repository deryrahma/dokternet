<footer class="footer">
			<div class="container">
				<div class="col-xs-9">
					<p class="text-muted credit" style="padding-top: 15px">
						@foreach( $data['article'] as $row )
							<div class="btn-group">
								<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
									{!! $row->name !!} <span class="caret caret-up"></span>
								</button>
								<ul class="dropdown-menu drop-up" role="menu">
									@foreach( $row->articles as $subrow )
										<li><a href="#">{!! $subrow->title !!}</a></li>
									@endforeach
								</ul>
							</div>
						@endforeach
					</p>
					<p style="padding-bottom: 10px">
					<small>Copyright © 2015 PT. Dokternet Indonesia. All rights reserved. </small></p>
				</div>
				<div class="col-xs-3 pull-right">
					<div style="display: flex; justify-content: center; flex-direction: column; height: 100px; font-size: 25px" align="right">
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
			</div>
		</footer>

		<!-- scripts -->
		{!! HTML::script('plugins/jQuery/jQuery-2.1.4.min.js') !!}
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		{!! HTML::script('js/bootstrap.min.js') !!}
		@yield('custom-footer')