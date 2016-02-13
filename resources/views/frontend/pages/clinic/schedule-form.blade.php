<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label class="form-label" for="doctor_id">Dokter</label>
      <?php
        $arr_doctor = [];
        foreach ( $data['doctor'] as $doctor ) {
          $arr_doctor[ $doctor->id ] = $doctor->name;
        }
      ?>
      {!! Form::select( 'doctor_id', $arr_doctor, null, ['class' => 'form-control'] ) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-2">
    {!! BootstrapForm::text( 'schedule_start', 'Waktu Mulai', null, ['class' => 'time'] ) !!}
  </div>
  <div class="col-md-2">
    {!! BootstrapForm::text( 'schedule_end', 'Waktu Selesai', null, ['class' => 'time'] ) !!}
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    {!! BootstrapForm::text( 'date', 'Tanggal', null, ['class' => 'date'] ) !!}
  </div>
</div>
@if( $repeat )
  {!! BootstrapForm::radios( 'repeat', 'Perulangan', ['1' => 'Hanya sekali', '2' => 'Hingga waktu tertentu'] ) !!}
  <div class="row">
    <div class="col-md-3">
      <input type="text" name="max_date" class="date form-control" style="margin-bottom: 15px">
    </div>
  </div>
@endif
<div class="row">
  <div class="col-md-3">
    {!! BootstrapForm::text( 'quota', 'Kuota Pasien' ) !!}
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
  </div>
</div>
