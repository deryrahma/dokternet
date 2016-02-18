@extends( 'frontend.pages.clinic.app' )

@section( 'custom-head' )
  {!! HTML::style( 'plugins/datatables/dataTables.bootstrap.css' ) !!}
@endsection

@section( 'custom-footer' )
  {!! HTML::script( 'plugins/datatables/jquery.dataTables.min.js' ) !!}
  {!! HTML::script( 'plugins/datatables/dataTables.bootstrap.min.js' ) !!}
  <script>
    $( function() {
      $( '.dataTable' ).DataTable( {
        "info": false,
        "searching": false,
        "lengthChange": false,
        "language": {
          "emptyTable": "Data tidak ditemukan!",
          "paginate": {
            "next": ">",
            "previous": "<",
            "first": "<<",
            "last": ">>"
          },
          "search": "Pencarian:"
        }
      } );
    } );
  </script>
@endsection

@section( 'sub-content' )
  <h3>Daftar Perjanjian Dokter Klinik</h3>
  <form method="get">
    <div class="form-group">
      <label for="data_content">Tampilkan data</label>
      <div class="radio">
        <label>
          <input type="radio" name="data_content" value="1" {!! ( Input::get( 'data_content' ) == '1' || Input::get( 'data_content' ) == null ) ? "checked" : "" !!} onchange="this.form.submit()">&nbsp;Semua
        </label>
      </div>
      <div class="radio">
        <label>
          <input type="radio" name="data_content" value="2" {!! Input::get( 'data_content' ) == '2' ? "checked" : "" !!} onchange="this.form.submit()">&nbsp;Belum dikonfirmasi
        </label>
      </div>
      <div class="radio">
        <label>
          <input type="radio" name="data_content" value="3" {!! Input::get( 'data_content' ) == '3' ? "checked" : "" !!} onchange="this.form.submit()">&nbsp;Diterima
        </label>
      </div>
      <div class="radio">
        <label>
          <input type="radio" name="data_content" value="4" {!! Input::get( 'data_content' ) == '4' ? "checked" : "" !!} onchange="this.form.submit()">&nbsp;Ditolak
        </label>
      </div>
      <div class="radio">
        <label>
          <input type="radio" name="data_content" value="5" {!! Input::get( 'data_content' ) == '5' ? "checked" : "" !!} onchange="this.form.submit()">&nbsp;Dibatalkan
        </label>
      </div>
      <div class="radio">
        <label>
          <input type="radio" name="data_content" value="6" {!! Input::get( 'data_content' ) == '6' ? "checked" : "" !!} onchange="this.form.submit()">&nbsp;Selesai
        </label>
      </div>
    </div>
  </form>
  <table class="table table-bordered table-striped dataTable">
    <thead>
      <tr>
        <th>Waktu</th>
        <th>Pasien</th>
        <th>Dokter</th>
        <th>Ket.</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach( $data['content'] as $reservation )
        <tr>
          <td>{{ $reservation->schedule->date }}<br>{{ $reservation->schedule->schedule_start }}&nbsp;-&nbsp;{{ $reservation->schedule->schedule_end }}</td>
          <td>{{ $reservation->patient->first_name }}&nbsp;{{ $reservation->patient->last_name }}</td>
          <td>{{ $reservation->schedule->doctor->name }}</td>
          <td>
            @if( $reservation->status == "" )
              <span class="label label-warning">Belum dikonfirmasi</span>
            @elseif( $reservation->status == '1' )
              <span class="label label-primary">Diterima</span>
            @elseif( $reservation->status == '2' )
              <span class="label label-danger">Ditolak</span>
            @elseif( $reservation->status == '3' )
              <span class="label label-primary">Dibatalkan</span>
            @elseif( $reservation->status == '4' )
              <span class="label label-success">Selesai</span>
            @endif
          </td>
          <td class="btn-group-vertical">
            @if( $reservation->status == "" )
              <a href="{!! route( 'clinic.reservation.accept', [$reservation->id] ) !!}" class="btn btn-primary btn-xs">
                <span class="glyphicon glyphicon-ok"></span>
                &nbsp;Terima
              </a>
              <a href="{!! route( 'clinic.reservation.decline', [$reservation->id] ) !!}" class="btn btn-danger btn-xs">
                <span class="glyphicon glyphicon-remove"></span>
                &nbsp;Tolak
              </a>
            @elseif( $reservation->status == '1' )
              <a href="{!! route( 'clinic.reservation.complete', [$reservation->id] ) !!}" class="btn btn-primary btn-xs">
                <span class="glyphicon glyphicon-ok"></span>
                &nbsp;Selesai
              </a>
              <a href="{!! route( 'clinic.reservation.cancel', [$reservation->id] ) !!}" class="btn btn-danger btn-xs">
                <span class="glyphicon glyphicon-remove"></span>
                &nbsp;Batal
              </a>
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
