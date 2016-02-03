<div class="box-body">
    <div class="form-group">
        <label class="form-label" for="parent_id">Nama Klinik</label>
        {!! Form::text('name', $data['content']['name'], array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <label class="form-label" for="parent_id">Alamat Klinik</label>
        {!! Form::text('address', $data['content']['address'], array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <label class="form-label" for="parent_id">Provinsi</label>
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
        <label class="form-label" for="parent_id">Kota</label>
        <?php 
            $arr_City = array();

            foreach ($data['list_city'] as $key => $value) {
              $arr_City[$key] = $value;
            } 
        ?>
        {!! Form::select('city_id', $arr_City, null, array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <label class="form-label" for="parent_id">Latitude</label>
        {!! Form::text('latitude', $data['content']['latitude'], array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <label class="form-label" for="parent_id">Longitude</label>
        {!! Form::text('longitude', $data['content']['longitude'], array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <label class="form-label" for="parent_id">No. Telepon</label>
        {!! Form::text('telephone', $data['content']['telephone'], array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <label class="form-label" for="parent_id">Email</label>
        {!! Form::email('email', $data['content']['email'], array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <label class="form-label" for="parent_id">Password</label>
        {!! Form::input('password', 'password', $data['content']['password'], ['class' => 'form-control']) !!}
    </div>
</div><!-- /.box-body -->

  <div class="box-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>