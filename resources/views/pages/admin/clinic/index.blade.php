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
    @include( 'pages.admin.clinic.header' )
    <section class="content">
        @include( 'errors.session' )
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <div class="box-header">
                        <h3 class="box-title">Daftar Klinik &nbsp;&nbsp;&nbsp; <a class="btn btn-primary btn-sm" href="{!! route('admin.clinic.create') !!}">Tambah Klinik</a></h3>                                    
                    </div>
                    <div class="box-body">
                        <form method="get" action="{!! route('admin.clinic.index') !!}">
                            <div class="form-group">
                                <label class="form-label" for="province_id">Provinsi</label>
                                <?php 
                                    $arr_Province = array();
                                    //$arr_Parent['0'] = "Tidak Ada";

                                    foreach ($data['list_province'] as $key => $value) {
                                      $arr_Province[$key] = $value;
                                    } 
                                ?>
                                {!! Form::select('province_id', $arr_Province, null, array('class' => 'form-control')) !!}
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="city_id">Kota</label>
                                <?php 
                                    $arr_City = array();
                                    //$arr_Parent['0'] = "Tidak Ada";

                                    foreach ($data['list_city'] as $key => $value) {
                                      $arr_City[$key] = $value;
                                    } 
                                ?>
                                {!! Form::select('city_id', $arr_City, null, array('class' => 'form-control')) !!}
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
                                    <th>Alamat</th>
                                    <th>No. Telepon</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                                <tbody>
                                    <?php $a=0; ?>
                                    @foreach($data['content'] as $row)
                                    <tr>
                                        <td>{!! $a+1 !!}</td>
                                        <td>{!! $row->name !!}</td>
                                        <td>
                                            {!! $row->address !!}
                                        </td>
                                        <td>
                                            {!! $row->telephone !!}
                                        </td>
                                        <td>
                                            {!! $row->email !!}
                                        </td>
                                        <td>
                                                <a href="{!! route('admin.clinic.show', [$row->id]) !!}" class="fa fa-eye"></a>
                                                <a href="{!! route('admin.clinic.edit',[$row->id]) !!}" class="fa fa-pencil-square-o"></a>
                                            
                                                <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route('admin.clinic.delete',[$row->id]) !!}" class="fa fa-trash-o"></a>
                                            
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