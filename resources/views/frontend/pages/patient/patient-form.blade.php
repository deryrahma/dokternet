	<div class="box-body">
		{!! BootstrapForm::text('first_name','Nama Depan') !!}
	    {!! BootstrapForm::text('last_name','Nama Belakang') !!}
	    {!! BootstrapForm::text('email','Email') !!}
	    {!! BootstrapForm::text('birth_date','Tanggal Lahir') !!}
	    <?php 
			$genders = [
			    'L'   => 'Laki-laki',
			    'P' => 'Perempuan'
			];
	    ?>
	    {!! BootstrapForm::radios('gender', null, $genders, null, true) !!}
	    {!! BootstrapForm::text('mobile','Handphone') !!}
	    {!! BootstrapForm::text('telephone','Telephone') !!}
	    {!! BootstrapForm::textarea('address','Alamat') !!}
    </div>

    <div class="box-footer">
    	<button type="submit" class="btn btn-primary">Simpan</button>
  	</div>