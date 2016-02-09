@extends( 'frontend.pages.clinic.app' )

@section( 'custom-head' )
  
@endsection

@section( 'custom-footer' )
  
@endsection

@section( 'sub-content' )
  <div class="box-body">
    <h3>Tambah Dokter</h3>
    {!! BootstrapForm::open(['model' => $data['content'], 'store' => 'clinic.doctor.store', 'update' => 'clinic.doctor.update','files' => true]) !!}
    @include('frontend.pages.clinic.doctor-form')
    {!! BootstrapForm::close() !!}
  </div>
@endsection
