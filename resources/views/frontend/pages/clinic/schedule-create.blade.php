@extends( 'frontend.pages.clinic.app' )

@section( 'custom-head' )
  {!! HTML::style('plugins/datepicker/bootstrap-datetimepicker.min.css') !!}
@endsection

@section( 'custom-footer' )
  {!! HTML::script('plugins/moment/moment.min.js') !!}
  {!! HTML::script('plugins/datepicker/bootstrap-datetimepicker.min.js') !!}
  <script type="text/javascript">
    $( '.time' ).datetimepicker( {
      format:'LT'
    } );
    $( '.date' ).datetimepicker( {
      format:'YYYY-MM-DD'
    } );
  </script>
@endsection

@section( 'sub-content' )
  <div class="box-body">
    <h3>Tambah Jadwal</h3>
    {!! BootstrapForm::open( ['model' => $data['content'], 'store' => 'clinic.schedule.store', 'update' => 'clinic.schedule.update'] ) !!}
      @include( 'frontend.pages.clinic.schedule-form', ['repeat' => true] )
    {!! BootstrapForm::close() !!}
  </div>
@endsection
