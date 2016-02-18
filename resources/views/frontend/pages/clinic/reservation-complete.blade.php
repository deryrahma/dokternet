@extends( 'frontend.pages.clinic.app' )

@section( 'sub-content' )
  <h3>Form Penyelesaian Reservasi</h3>
  {!! BootForm::open()->action( route( 'clinic.reservation.done' ) ) !!}
    <input type="hidden" name="id" class="form-control" value="{!! $data['reservation_id'] !!}">
    <div class="box-body">
      {!! BootstrapForm::textarea( 'diagnosis_in', 'Diagnosa Awal:', null, ['rows' => 3] ) !!}
      {!! BootstrapForm::textarea( 'diagnosis_out', 'Diagnosa Akhir:', null, ['rows' => 3] ) !!}
      {!! BootstrapForm::textarea( 'laboratory_result', 'Hasil lab:', null, ['rows' => 3] ) !!}
      {!! BootstrapForm::textarea( 'activity', 'Aktivitas:', null, ['rows' => 3] ) !!}
      {!! BootstrapForm::textarea( 'note', 'Catatan:', null, ['rows' => 3] ) !!}
    </div>
    <div class="box-footer">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  {!! BootForm::close() !!}
@endsection
