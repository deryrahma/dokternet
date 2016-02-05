@extends( 'frontend.app' )

@section( 'custom-head' )
  {!! HTML::style( 'css/wizard-form.css' ) !!}
  <style type="text/css">
    @media( min-width : 768px ) {
      .left-col {
        border-right: 1px solid rgb( 200, 200, 200 );
      }
    }
    .card-box {
      padding: 10px 100px;
    }
    .card-box .form-group input {
      text-align: center;
    }
    input.token-box {
      width: 40%;
    }
    .card-box .form-group input,
    input.token-box {
      font-size: 20px;
      height: auto;
    }
  </style>
@endsection

@section( 'custom-footer' )
  {!! HTML::script( 'js/wizard-form.js' ) !!}
  <script>
    var reservation_id = 0;
    function login() {
      $.ajax( {
        url: "{{ route( 'reservation.login', ['id'=>$data['schedule']->id] ) }}",
        type: 'POST',
        data: {
          _token: "{{ csrf_token() }}",
          email: $( "#login-email" )[0].value,
          pass: $( "#login-password" )[0].value
        },
        dataType: 'JSON',
        success: function ( data ) {
          if ( data.success ) {
            nextStep();
          }
          else {
            alert( data.message );
          }
        }
      } );
    }
    function confirm() {
      $.ajax( {
        url: "{{ route( 'reservation.confirm', ['id'=>$data['schedule']->id] ) }}",
        type: 'POST',
        data: {
          _token: "{{ csrf_token() }}",
          email: $( "#login-email" )[0].value,
          schedule_id: {{ $data['schedule']->id }}
        },
        dataType: 'JSON',
        success: function ( data ) {
          if ( data.success ) {
            reservation_id = data.reservation_id;
            nextStep();
          }
          else {
            alert( data.message );
          }
        }
      } );
    }
    function verify() {
      $.ajax( {
        url: "{{ route( 'reservation.verify', ['id'=>$data['schedule']->id] ) }}",
        type: 'POST',
        data: {
          _token: "{{ csrf_token() }}",
          reservation_id: reservation_id,
          verification: $( "#verification-token" )[0].value
        },
        dataType: 'JSON',
        success: function ( data ) {
          if ( data.success ) {
            nextStep();
          }
          else {
            alert( data.message );
          }
        }
      } );
    }
  </script>
@endsection

@section( 'content' )
  <div class="container">
    <div class="row" style="margin: 30px 0">
      <section>
        <div class="wizard">
          <div class="wizard-inner">
            <div class="connecting-line"></div>
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active">
                <a href="#login" data-toggle="tab" aria-controls="login" role="tab" title="Langkah #1: Login">
                  <span class="round-tab">
                    <i class="glyphicon glyphicon-log-in"></i>
                  </span>
                </a>
              </li>
              <li role="presentation" class="disabled">
                <a href="#book" data-toggle="tab" aria-controls="book" role="tab" title="Langkah #2: Konfirmasi Pertemuan">
                  <span class="round-tab">
                    <i class="glyphicon glyphicon-book"></i>
                  </span>
                </a>
              </li>
              <li role="presentation" class="disabled">
                <a href="#verification" data-toggle="tab" aria-controls="verification" role="tab" title="Langkah #3: Verifikasi Pertemuan">
                  <span class="round-tab">
                    <i class="glyphicon glyphicon-pencil"></i>
                  </span>
                </a>
              </li>
              <li role="presentation" class="disabled">
                <a href="#done" data-toggle="tab" aria-controls="done" role="tab" title="Langkah #4: Selesai">
                  <span class="round-tab">
                    <i class="glyphicon glyphicon-ok"></i>
                  </span>
                </a>
              </li>
            </ul>
          </div>
          <div class="tab-content">
            <div class="tab-pane active" role="tabpanel" id="login">
              <div class="row">
                <div class="col col-md-6 col-xs-12 left-col">
                  <h3 align="center">Sudah memiliki akun <strong>DokterNet</strong></h3>
                  <hr style="width: 75%">
                  <div class="card-box">
                    <div class="form-group">
                      <input type="text" id="login-email" class="form-control" placeholder="Masukkan email">
                    </div>
                    <div class="form-group">
                      <input type="password" id="login-password" class="form-control" placeholder="Masukkan kata sandi">
                    </div>
                    <a class="btn btn-block btn-primary" onclick="login()">Login</a>
                  </div>
                </div>
                <div class="col col-md-6 col-xs-12 right-col">
                  <h3 align="center">Belum memiliki akun <strong>DokterNet</strong></h3>
                  <p align="center">Silakan mendaftar dan login setelah melakukan pendaftaran</p>
                  <hr style="width: 75%">
                  <div class="card-box">
                    <a class="btn btn-block btn-primary" href="{{ route( 'patient.register' ) }}" target="_blank">Daftar</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" role="tabpanel" id="book">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Identitas Dokter</h3>
                </div>
                <div class="panel-body">
                  <p><strong>Nama:</strong> {{ $data['schedule']->doctor == null ? "" : $data['schedule']->doctor->name }}</p>
                  <p><strong>Email:</strong> {{ $data['schedule']->doctor == null ? "" : $data['schedule']->doctor->email }}</p>
                  <p><strong>No. HP:</strong> {{ $data['schedule']->doctor == null ? "" : $data['schedule']->doctor->mobile }}</p>
                  <p><strong>No. Telepon:</strong> {{ $data['schedule']->doctor == null ? "" : $data['schedule']->doctor->telephone }}</p>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Deskripsi Pemesanan</h3>
                </div>
                <div class="panel-body">
                  <p><strong>Nama Klinik:</strong> {{ $data['schedule']->clinic == null ? "" : $data['schedule']->clinic->name }}</p>
                  <p><strong>Lokasi Klinik:</strong> {{ $data['schedule']->clinic == null ? "" : $data['schedule']->clinic->address }}</p>
                  <p><strong>No. Telepon Klinik:</strong> {{ $data['schedule']->clinic == null ? "" : $data['schedule']->clinic->telephone }}</p>
                  <p><strong>Tanggal pertemuan:</strong> {{ $data['schedule']->date }}</p>
                  <p><strong>Waktu pertemuan:</strong> {{ $data['schedule']->schedule_start }} s/d {{ $data['schedule']->schedule_end }}</p>
                </div>
              </div>
              <a class="btn btn-primary" onclick="confirm()">Konfirmasi</a>
              <a class="btn btn-danger" href="{{ route( 'reservation.schedule', ['id'=>$data['schedule']->doctor_id] ) }}">Batal</a>
            </div>
            <div class="tab-pane" role="tabpanel" id="verification">
              <h3>Verifikasi Pertemuan</h3>
              <p>Masukkan token yang sudah dikirimkan pada email anda pada kotak di bawah ini</p>
              <div class="form-group">
                <input type="text" id="verification-token" class="token-box form-control" placeholder="Masukkan token">
              </div>
              <a class="btn btn-primary" onclick="verify()">Konfirmasi Token</a>
            </div>
            <div class="tab-pane" role="tabpanel" id="done">
              <div class="panel panel-default">
                <div class="panel-body">
                  <p><strong>Reservasi jadwal pertemuan sukses!</strong></p>
                  <p>Dimohon untuk datang tepat waktu pada jadwal yang sudah dipesan. Kami berharap Anda mendapatkan solusi terbaik dan kembali dalam kondisi prima.</p>
                  <p>Terima kasih dan sampai jumpa kembali</p>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </section>
    </div>
  </div>
@endsection
