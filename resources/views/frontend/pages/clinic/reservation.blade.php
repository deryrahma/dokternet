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
            @if( $reservation->status == "" || $reservation->status == '0' )
              <span class="label label-warning">Belum dikonfirmasi</span>
            @elseif( $reservation->status == '1' )
              <span class="label label-success">Diterima</span>
            @elseif( $reservation->status == '2' )
              <span class="label label-danger">Ditolak</span>
            @endif
          </td>
          <td class="btn-group-vertical">
            <a href="{!! route( 'clinic.reservation.accept', [$reservation->id] ) !!}" class="btn btn-primary btn-xs">
              <span class="glyphicon glyphicon-ok"></span>
              &nbsp;Terima
            </a>
            <a href="{!! route( 'clinic.reservation.decline', [$reservation->id] ) !!}" class="btn btn-danger btn-xs">
              <span class="glyphicon glyphicon-remove"></span>
              &nbsp;Tolak
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
