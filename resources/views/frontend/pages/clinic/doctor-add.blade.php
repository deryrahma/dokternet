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
    function addDoctor( id ) {
      $.ajax( {
        url: "{{ route( 'clinic.doctor.store' ) }}",
        type: "POST",
        data: {
          _token: "{{ csrf_token() }}",
          doctor_id: id
        },
        dataType: "json",
        success: function( data ) {
          alert( "Penambahan dokter pada klinik disimpan." );
        }
      } );
    }
  </script>
@endsection

@section( 'sub-content' )
  <h3>Tambah Dokter Klinik</h3>
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
          <td>{{ $doctor->name }}</td>
          <td>{{ $doctor->city->name }}</td>
          <td>{{ $doctor->address }}</td>
          <td>{{ $doctor->specialization->name }}</td>
          <td>{{ $doctor->email }}</td>
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
            <a class="btn btn-primary btn-xs" onclick="addDoctor( {{ $doctor->id }} )">
              <span class="glyphicon glyphicon-plus"></span>
              &nbsp;Tambah
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
