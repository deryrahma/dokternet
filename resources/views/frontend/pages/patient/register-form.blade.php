<div class="box-body">
    {!! BootstrapForm::text('first_name','Nama Depan') !!}
    {!! BootstrapForm::text('last_name','Nama Belakang') !!}
    {!! BootstrapForm::text('email','Email') !!}
    {!! BootstrapForm::password('password','Password') !!}
    {!! BootstrapForm::password('cpassword','Konfirmasi Password') !!}
    <p>
        Dengan menekan Daftar, saya mengkonfirmasi telah menyetujui Syarat & Ketentuan dan Kebijakan Privasi Konsula 
    </p>
</div><!-- /.box-body -->
  <div class="box-footer">
    <button type="submit" class="btn btn-primary">Daftar</button>
  </div>