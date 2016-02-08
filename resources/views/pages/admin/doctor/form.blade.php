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
        <label class="form-label" for="address">Alamat</label>
        {!! Form::text('address', $data['content']['address'], array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <label class="form-label" for="latitude">Latitude</label>
        {!! Form::text('latitude', $data['content']['latitude'], array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <label class="form-label" for="longitude">Longitude</label>
        {!! Form::text('longitude', $data['content']['longitude'], array('class' => 'form-control')) !!}
    </div>
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