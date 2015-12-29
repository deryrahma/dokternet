@extends( 'layouts.master' )

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
                "dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
                "language": {
                    "emptyTable": "Data tidak ditemukan!",
                    "paginate": {
                        "next": ">",
                        "previous": "<",
                        "first": "<<",
                        "last": ">>"
                    }
                }
            } );
        } );
    </script>
@endsection

@section( 'content' )
    @include( 'pages.admin.patient.header' )
    <section class="content">
        @include( 'errors.session' )
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <div class="box-header">
                        <h3 class="box-title">Daftar Pasien &nbsp;&nbsp;&nbsp; <a class="btn btn-primary btn-sm" href="{!! route('admin.patient.create') !!}">Tambah Pasien</a></h3>                                    
                    </div>
                    <div class="box-body">
                        <form method="get" action="{!! route('admin.patient.index') !!}">
                            <div class="form-group">
                                <label class="form-label" for="gender_id">Gender</label>
                                {!! Form::select('gender', array('L' => 'Laki-laki', 'P' => 'Perempuan'), $data['gender'], array('class' => 'form-control')) !!}
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="parent_id">Status</label>
                                {!! Form::select('verified', array('0' => 'Belum diverifikasi', '1' => 'Sudah diverifikasi'), $data['verified'], array('class' => 'form-control')) !!}
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </form>
                        <table class="table table-bordered table-striped dataTable" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
                                    <th>No. HP</th>
                                    <th>No. Telepon</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                                <tbody>
                                    <?php $a=0; ?>
                                    @foreach($data['content'] as $row)
                                    <tr>
                                        <td>{!! $a+1 !!}</td>
                                        <td>{!! $row->last_name !!}, {!! $row->first_name !!}</td>
                                        <td>
                                            {!! $row->birth_date !!}
                                        </td>
                                        <td>
                                            {!! $row->mobile !!}
                                        </td>
                                        <td>
                                            {!! $row->telephone !!}
                                        </td>
                                        <td>
                                            
                                                <a href="{!! route('admin.patient.edit',[$row->id]) !!}" class="fa fa-pencil-square-o"></a>
                                            
                                                <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route('admin.patient.delete',[$row->id]) !!}" class="fa fa-trash-o"></a>
                                            
                                        </td>
                                    </tr>
                                    <?php $a++; ?>
                                    @endforeach
                                </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
    @include( 'scripts.delete-modal' )
@endsection