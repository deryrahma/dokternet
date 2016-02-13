@extends( 'frontend.app' )

@section( 'content' )
  <div class="row" style="margin-top: 30px; margin-bottom: 30px">
    <div class="col-md-3">
      <ul class="list-group">
        <li class="list-group-item">
          <a href="{!! route('clinic.dashboard') !!}">Profil klinik</a>
        </li>
        <li class="list-group-item">
          <a href="{!! route('clinic.change-password') !!}">Ganti Password</a>
        </li>
        <li class="list-group-item">
          <a href="{!! route('clinic.doctor.index') !!}">Manajemen Dokter</a>
        </li>
        <li class="list-group-item">
          <a href="{!! route('clinic.schedule.index') !!}">Manajemen Jadwal Dokter</a>
        </li>
        <li class="list-group-item">
          <a href="{!! route('clinic.appointment') !!}">Manajemen Perjanjian Dokter</a>
        </li>
        <li class="list-group-item">
          <a href="{!! route('clinic.report') !!}">Rekapitulasi Data</a>
        </li>
      </ul>
    </div>
    <div class="col-md-9">
      @include( 'frontend.errors.session' )
      @yield( 'sub-content' )
    </div>
  </div>
@endsection
