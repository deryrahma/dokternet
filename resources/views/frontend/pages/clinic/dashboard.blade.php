@extends( 'frontend.pages.clinic.app' )

@section( 'sub-content' )
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
@endsection
