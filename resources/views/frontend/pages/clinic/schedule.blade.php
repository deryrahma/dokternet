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
        "searching": true,
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
  <h3>Jadwal Dokter Klinik &nbsp;&nbsp;&nbsp; <a href="{{ route( 'clinic.schedule.create' ) }}" class="btn btn-default btn-sm">Tambah Jadwal </a></h3>
  <table class="table table-bordered table-striped dataTable">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Tanggal</th>
        <th>Waktu</th>
        <th>Kuota</th>
        <th>NB</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach( $data['content'] as $schedule )
        <tr>
          <td>{{ $schedule->doctor->name }}</td>
          <td>{{ $schedule->date }}</td>
          <td>{{ $schedule->schedule_start }} - {{ $schedule->schedule_end }}</td>
          <td>{{ $schedule->quota }}</td>
          <td>
            @if( $schedule->status_batal )
              Batal
            @else
              Aktif
            @endif
          </td>
          <td class="btn-group-vertical">
            <a class="btn btn-default btn-xs" href="{!! route('clinic.schedule.edit', [$schedule->id]) !!}">
                <span class="glyphicon glyphicon-pencil"></span>
                &nbsp;Ubah
            </a>
            <a class="btn {!! $schedule->status_batal == '0' ? 'btn-warning' : 'btn-success' !!} btn-xs" href="{!! route('clinic.schedule.cancel', [$schedule->id]) !!}">
              <span class="glyphicon glyphicon-{!! $schedule->status_batal == '0' ? 'remove' : 'ok' !!}"></span>
              &nbsp;{!! $schedule->status_batal == '0' ? 'Batal': 'Aktifkan' !!}
            </a>
            {!! Form::open( ['url' => route( 'clinic.schedule.destroy', ['id' => $schedule->id ] ) ] ) !!}
              {!! Form::hidden( '_method', 'DELETE' ) !!}
              <button type="submit" class="btn btn-danger btn-xs">
                <span class="glyphicon glyphicon-trash"></span>
                &nbsp;Hapus
              </button>
            {!! Form::close() !!}
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
