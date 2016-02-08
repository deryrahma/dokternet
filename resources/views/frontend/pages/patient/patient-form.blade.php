	<div class="box-body">
		<div class="row">
			<div class="col-md-6">
				{!! BootstrapForm::text('first_name','Nama Depan') !!}				
			</div>
			<div class="col-md-6">
				{!! BootstrapForm::text('last_name','Nama Belakang') !!}				
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				{!! BootstrapForm::text('email','Email') !!}
			</div>
			<div class="col-md-6">
				{!! BootstrapForm::text('birth_date','Tanggal Lahir') !!}
			</div>
		</div>
		<?php 
		$genders = [
		'L'   => 'Laki-laki',
		'P' => 'Perempuan'
		];
		?>
		{!! BootstrapForm::radios('gender', 'Jenis Kelamin', $genders, null, true) !!}
		<div class="row">
			<div class="col-md-6">
				{!! BootstrapForm::text('mobile','Handphone') !!}
			</div>
			<div class="col-md-6">
				{!! BootstrapForm::text('telephone','Telephone') !!}
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				{!! BootstrapForm::textarea('address','Alamat',null, ['rows' => 2]) !!}
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-md-offset-4">
				<button type="submit" class="btn btn-register btn-block">Simpan</button>
			</div>
		</div>
	</div>