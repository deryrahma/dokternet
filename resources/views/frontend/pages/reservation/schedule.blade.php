@extends( 'frontend.app' )

@section( 'content' )
  <div class="container">
    <div class="row" style="margin: 30px 0">
      <table border="1" width="100%">
        <tbody>
          @for( $i = 0; $i <= 7; $i++ )
            <tr height="50px">
              <td class="col-md-2 col-xs-2">{{ date( "Y-m-d", strtotime( "+".$i." day" ) ) }}</td>
              <td class="col-md-10 col-xs-10">
                @foreach( $data['schedule'][$i] as $row )
                  <a href="#" class="btn btn-default">{{ $row->schedule_start }} - {{ $row->schedule_end }}</a>
                @endforeach
              </td>
            </tr>
          @endfor
        </tbody>
      </table>
    </div>
  </div>
@endsection
