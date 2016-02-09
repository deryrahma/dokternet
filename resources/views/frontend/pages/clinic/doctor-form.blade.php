    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label class="form-label" for="specialiation_id">Spesialisasi</label>
          <?php 
              $arr_Specialization = array();

              foreach ($data['list_specialization'] as $key => $value) {
                $arr_Specialization[$key] = $value;
              } 
          ?>
          {!! Form::select('specialization_id', $arr_Specialization, null, array('class' => 'form-control')) !!}
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        {!! BootstrapForm::text('registration_number','Nomor Registrasi') !!}        
      </div>
      <div class="col-md-6">
        {!! BootstrapForm::text('registration_year','Tahun Registrasi') !!}        
      </div>
    </div>
    <div class="form-group">
    @if(isset($data['content']))
        @if(File::exists('data/doctor/'.$data['content']->photo) and !empty($data['content']->photo))
            <img src="{!! asset('data/doctor/'.$data['content']->photo) !!}" class="img-responsive img-thumbnail">
        @else
            <img src="{!! asset('img/doctor.png') !!}" class="img-responsive img-thumbnail">
        @endif
        <br>
        <small>Kosongkan kolom foto jika tidak ingin diganti.</small>
    @endif
    </div>
    <div class="form-group">
        <label class="form-label" for="name">Foto</label>
        {!! Form::file('photo', array('class' => 'form-control')) !!}
    </div>
    <div class="row">
      <div class="col-md-6">
        {!! BootstrapForm::text('name','Nama') !!}        
      </div>
      <div class="col-md-6">
      @if(isset($data['content']))
        {!! BootstrapForm::text('email','Email', $data['content']->user->email) !!}        
      @else
        {!! BootstrapForm::text('email','Email') !!}        
      @endif
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        {!! BootstrapForm::radios('gender','Jenis Kelamin', ['L'   => 'Laki-laki','P' => 'Perempuan'],  null, true); !!}
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        {!! BootstrapForm::text('telephone','Telephone') !!}        
      </div>
      <div class="col-md-6">
        {!! BootstrapForm::text('mobile','Handphone') !!}        
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="form-label" for="city_id">Kota</label>
          <?php 
              $arr_City = array();

              foreach ($data['list_city'] as $key => $value) {
                $arr_City[$key] = $value;
              } 
          ?>
          {!! Form::select('city_id', $arr_City, null, array('class' => 'form-control')) !!}
        </div>
      </div>
      <div class="col-md-6">
        {!! BootstrapForm::text('practice_time','Jam Praktek') !!}        
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        @if(isset($data['content']))
        <?php 
        $checked_ar = $data['content']->day->toArray();
        $checked = array();
        foreach ($checked_ar as $row) {
            array_push($checked, $row['id']);
        }
        ?>
        {!! BootstrapForm::checkboxes('practice_day[]', 'Jadwal Praktek', $data['days'], $checked,['class' => 'checkbox-inline' ]) !!}
        @else
        {!! BootstrapForm::checkboxes('practice_day[]', 'Jadwal Praktek', $data['days'], null,['class' => 'checkbox-inline' ]) !!}
        
        @endif
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        {!! BootstrapForm::textarea('address','Alamat', null, ['rows' => 2]) !!}        
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        {!! BootstrapForm::textarea('description','Profil Singkat', null, ['rows' => 2]) !!}        
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 col-md-offset-4">
        <button type="submit" class="btn btn-register btn-block">Simpan</button>
      </div>
    </div>