<div class="box-body">
    <div class="form-group">
        <label class="form-label" for="first_name">Nama Depan</label>
        {!! Form::text('first_name', $data['content']['first_name'], array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <label class="form-label" for="last_name">Nama Belakang</label>
        {!! Form::text('last_name', $data['content']['last_name'], array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <label class="form-label" for="gender_id">Jenis Kelamin</label>
        <?php 

        $arr_Gender = array();
        //$arr_Parent['0'] = "Tidak Ada";

        foreach ($data['list_gender'] as $key => $value) {
          $arr_Gender[$value] = $value;
        }                                            ?>
        {!! Form::select('gender', $arr_Gender, $data['content']['gender'], array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <label class="form-label" for="birth_date">Tanggal Lahir</label>
        {!! Form::input('date', 'birth_date', $data['content']['birth_date'], ['class' => 'form-control', 'placeholder' => 'Date']) !!}
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
</div><!-- /.box-body -->

  <div class="box-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>