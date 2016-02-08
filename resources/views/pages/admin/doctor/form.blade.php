    <div class="box-body">
    <div class="form-group">
        <label class="form-label" for="registration_number">Nomor Registrasi</label>
        {!! Form::text('registration_number', $data['content']['registration_number'], array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <label class="form-label" for="registration_year">Tahun Registrasi</label>
        {!! Form::text('registration_year', $data['content']['registration_year'], array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <label class="form-label" for="name">Nama</label>
        {!! Form::text('name', $data['content']['name'], array('class' => 'form-control')) !!}
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
    <div class="form-group">
        <label class="form-label" for="address">Alamat</label>
        {!! Form::text('address', $data['content']['address'], array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <label class="form-label" for="practice_time">Jam Praktek</label>
        {!! Form::text('practice_time', $data['content']['practice_time'], array('class' => 'form-control')) !!}
    </div>
    @if(isset($data['content']))
    <?php 
    $checked_ar = $data['content']->day->toArray();
    $checked = array();
    foreach ($checked_ar as $row) {
        array_push($checked, $row['id']);
    }
    ?>
    {!! BootstrapForm::checkboxes('practice_day[]', 'Jadwal Praktek', $data['days'], $checked) !!}
    @else
    {!! BootstrapForm::checkboxes('practice_day[]', 'Jadwal Praktek', $data['days'], null) !!}
    @endif
    <div class="form-group">
        <label class="form-label" for="latitude">Latitude</label>
        {!! Form::text('latitude', $data['content']['latitude'], array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <label class="form-label" for="longitude">Longitude</label>
        {!! Form::text('longitude', $data['content']['longitude'], array('class' => 'form-control')) !!}
    </div>
    {!! BootstrapForm::radios('gender','Jenis Kelamin', ['L'   => 'Laki-laki','P' => 'Perempuan'],  $data['content']['gender'], true); !!}
    <div class="form-group">
        <label class="form-label" for="province_id">Provinsi</label>
        <?php 
            $arr_Province = array();
            //$arr_Parent['0'] = "Tidak Ada";

            foreach ($data['list_province'] as $key => $value) {
              $arr_Province[$key] = $value;
            } 
        ?>
        {!! Form::select('province_id', $arr_Province, null, array('class' => 'form-control')) !!}
    </div>
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
    <div class="form-group">
        <label class="form-label" for="email">Email</label>
        {!! Form::email('email', $data['content']['email'], array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <label class="form-label" for="password">Password</label>
        {!! Form::input('password', 'password', $data['content']['password'], ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label class="form-label" for="mobile">No. HP</label>
        {!! Form::text('mobile', $data['content']['mobile'], array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <label class="form-label" for="telephone">No. Telepon</label>
        {!! Form::text('telephone', $data['content']['telephone'], array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <label class="form-label" for="description">Profil Singkat</label>
        {!! Form::textarea('description', $data['content']['description'], array('class' => 'form-control')) !!}
    </div>
</div><!-- /.box-body -->

  <div class="box-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>