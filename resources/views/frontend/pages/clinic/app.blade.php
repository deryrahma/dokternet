@extends( 'frontend.app' )

@section( 'content' )
  <div class="row" style="margin: 30px">
    <div class="col-md-3 list-group">
      <a class="list-group-item" href="{!! route('clinic.dashboard') !!}">Profil klinik</a>
      <a class="list-group-item" href="{!! route('clinic.change-password') !!}">Ganti Password</a>
      <a class="list-group-item" href="{!! route('clinic.doctor.index') !!}">Manajemen Dokter</a>
      <a class="list-group-item" href="{!! route('clinic.schedule.index') !!}">Manajemen Jadwal Dokter</a>
      <a class="list-group-item" href="{!! route('clinic.reservation') !!}">Manajemen Perjanjian Dokter</a>
      <a class="list-group-item" href="{!! route('clinic.report') !!}">Rekapitulasi Data</a>
    </div>
    <div class="col-md-9">
      @include( 'frontend.errors.session' )
      @yield( 'sub-content' )
    </div>
  </div>
@endsection
