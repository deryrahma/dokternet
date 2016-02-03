@extends( 'frontend.app' )

@section( 'custom-head' )
  {!! HTML::style( 'css/wizard-form.css' ) !!}
@endsection

@section( 'custom-footer' )
  {!! HTML::script( 'js/wizard-form.js' ) !!}
@endsection

@section( 'content' )
  <div class="container">
    <div class="row" style="margin: 30px 0">
      <section>
        <div class="wizard">
          <div class="wizard-inner">
            <div class="connecting-line"></div>
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active">
                <a href="#login" data-toggle="tab" aria-controls="login" role="tab" title="Login Step">
                  <span class="round-tab">
                    <i class="glyphicon glyphicon-log-in"></i>
                  </span>
                </a>
              </li>
              <li role="presentation" class="disabled">
                <a href="#book" data-toggle="tab" aria-controls="book" role="tab" title="Booking Step">
                  <span class="round-tab">
                    <i class="glyphicon glyphicon-book"></i>
                  </span>
                </a>
              </li>
              <li role="presentation" class="disabled">
                <a href="#verification" data-toggle="tab" aria-controls="verification" role="tab" title="Verification Step">
                  <span class="round-tab">
                    <i class="glyphicon glyphicon-pencil"></i>
                  </span>
                </a>
              </li>
              <li role="presentation" class="disabled">
                <a href="#done" data-toggle="tab" aria-controls="done" role="tab" title="Final Step">
                  <span class="round-tab">
                    <i class="glyphicon glyphicon-ok"></i>
                  </span>
                </a>
              </li>
            </ul>
          </div>
          <div class="tab-content">
            <div class="tab-pane active" role="tabpanel" id="login">
              <h3>Login Step</h3>
              <p>This is login step</p>
              <ul class="list-inline pull-right">
                <li><button type="button" class="btn btn-primary next-step">Login and continue</button></li>
              </ul>
            </div>
            <div class="tab-pane" role="tabpanel" id="book">
              <h3>Booking Step</h3>
              <p>This is booking step</p>
              <ul class="list-inline pull-right">
                <li><button type="button" class="btn btn-primary prev-step">Go back</button></li>
                <li><button type="button" class="btn btn-primary next-step">Book and continue</button></li>
              </ul>
            </div>
            <div class="tab-pane" role="tabpanel" id="verification">
              <h3>Verification Step</h3>
              <p>This is verification step</p>
              <ul class="list-inline pull-right">
                <li><button type="button" class="btn btn-primary prev-step">Go back</button></li>
                <li><button type="button" class="btn btn-primary next-step">Verify and continue</button></li>
              </ul>
            </div>
            <div class="tab-pane" role="tabpanel" id="done">
              <h3>Complete</h3>
              <p>Reservation is complete</p>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </section>
    </div>
  </div>
@endsection
