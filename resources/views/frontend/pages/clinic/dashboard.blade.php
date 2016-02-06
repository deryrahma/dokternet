@extends( 'frontend.app' )

@section( 'content' )
  <div class="row" style="margin-top: 30px; margin-bottom: 30px">
    <div class="col-md-3">
      @include( 'frontend.pages.clinic.sidebar' )
    </div>
    <div class="col-md-9">
      @include( 'frontend.errors.session' )
      <h3>Profil Klinik</h3>
      {!! BootstrapForm::open(['model' => $data['content'], 'update' => 'clinic.update']) !!}
        <div class="box-body">
          {!! BootstrapForm::text( 'name', 'Nama' ) !!}
          {!! BootstrapForm::textarea( 'address', 'Alamat' ) !!}
          {!! BootstrapForm::text( 'telephone', 'No. Telepon' ) !!}
          {!! BootstrapForm::text( 'email', 'Email' ) !!}
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Simpan perubahan</button>
        </div>
      {!! BootstrapForm::close() !!}
    </div>
  </div>
@endsection
