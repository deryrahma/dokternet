@extends( 'frontend.pages.clinic.app' )

@section( 'sub-content' )
  <h3>Ganti Password Akun</h3>
  {!! BootForm::open()->action( route( 'clinic.change-password' ) ) !!}
    <div class="box-body">
      {!! BootstrapForm::password( 'old', 'Password lama' ) !!}
      {!! BootstrapForm::password( 'new', 'Password baru' ) !!}
      {!! BootstrapForm::password( 'confirm', 'Masukkan kembali password baru' ) !!}
    </div>
    <div class="box-footer">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  {!! BootForm::close() !!}
@endsection
