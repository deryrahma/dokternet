@extends( 'frontend.app' )

@section( 'content' )
  <div class="container">
    <div class="row" style="margin: 30px 0">
      <table border="1" width="100%">
        <tbody>
          @for( $i = 0; $i <= 7; $i++ )
            <tr height="75px">
              <td class="col-md-2 col-xs-2">{{ date( "Y-m-d", strtotime( "+".$i." day" ) ) }}</td>
              <td class="col-md-10 col-xs-10">
                @foreach( $data['schedule'][$i] as $row )
                  <a href="{{ route( 'reservation.book', ['id' => $row->id] ) }}" class="btn btn-default" {{ ( $row->status_batal == "1" || $row->quota == 0 ) ? "disabled=disabled style=text-decoration:line-through" : '' }}>
                    {{ $row->schedule_start }} - {{ $row->schedule_end }}<br>
                    <small>Kuota tersedia: {{ $row->quota }}</small><br>
                  </a>
                @endforeach
              </td>
            </tr>
          @endfor
        </tbody>
      </table>
    </div>
  </div>
@endsection
