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
        "info": true,
        "searching": true,
        "lengthChange": false,
        "dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
        "language": {
          "emptyTable": "Data tidak ditemukan!",
          "infoEmpty": "Total dokter: _TOTAL_",
          "paginate": {
            "next": ">",
            "previous": "<",
            "first": "<<",
            "last": ">>"
          },
          "info": "Total dokter: _TOTAL_",
          "search": "Pencarian:"
        }
      } );
    } );
  </script>
@endsection

@section( 'sub-content' )
  <h3>Daftar Dokter Klinik</h3>
  <a href="{{ route( 'clinic.doctor.create' ) }}" class="btn btn-primary">Tambah Dokter</a>
  <br><br>
  <table class="table table-bordered table-striped dataTable">
    <thead>
      <tr>
        <th>Name</th>
        <th>Kota</th>
        <th>Alamat</th>
        <th>Spesialisasi</th>
        <th>Email</th>
        <th>No. Telp/HP</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach( $data['content'] as $doctor )
        <tr>
          <td>{{ $doctor->doctor->name }}</td>
          <td>{{ $doctor->doctor->city->name }}</td>
          <td>{{ $doctor->doctor->address }}</td>
          <td>{{ $doctor->doctor->specialization->name }}</td>
          <td>{{ $doctor->doctor->email }}</td>
          <td>
            @if( $doctor->doctor->telephone && $doctor->doctor->mobile )
              {{ $doctor->doctor->telephone }} / {{ $doctor->doctor->mobile }}
            @elseif( $doctor->doctor->telephone )
              {{ $doctor->doctor->telephone }}
            @elseif( $doctor->doctor->mobile )
              {{ $doctor->doctor->mobile }}
            @endif
          </td>
          <td>
            {!! Form::open( ['url' => route( 'clinic.doctor.destroy', ['id' => $doctor->doctor->id ] ) ] ) !!}
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
