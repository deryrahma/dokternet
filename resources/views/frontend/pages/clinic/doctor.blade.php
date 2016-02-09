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
  <h3>Daftar Dokter Klinik &nbsp;&nbsp;&nbsp; <a href="{{ route( 'clinic.doctor.create' ) }}" class="btn btn-default btn-sm">Tambah Dokter </a></h3>
  <table class="table table-bordered table-striped dataTable">
    <thead>
      <tr>
        <th>Spesialisasi</th>
        <th>Nama</th>
        <th>Email</th>
        <th>No. Telp/HP</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach( $data['content'] as $doctor )
        <tr>
          <td>{{ $doctor->specialization->name }}</td>
          <td>{{ $doctor->name }}</td>
          
          <td>{{ $doctor->user->email }}</td>
          <td>
            @if( $doctor->telephone && $doctor->mobile )
              {{ $doctor->telephone }} / {{ $doctor->mobile }}
            @elseif( $doctor->telephone )
              {{ $doctor->telephone }}
            @elseif( $doctor->mobile )
              {{ $doctor->mobile }}
            @endif
          </td>
          <td>
            <a  class="btn btn-default btn-xs" href="{!! route('clinic.doctor.edit', [$doctor->id]) !!}">
                <span class="glyphicon glyphicon-pencil"></span>
                &nbsp;edit
            </a>
            {!! Form::open( ['url' => route( 'clinic.doctor.destroy', ['id' => $doctor->id ] ) ] ) !!}
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
