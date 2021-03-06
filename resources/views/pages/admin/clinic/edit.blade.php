@extends('layouts.master')

@section('content')

 
                <section class="content-header">
                    <h1>
                        Klinik
                        <small>Administrator panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Edit Klinik</li>
                    </ol>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Pasien</h3>                                    
                                </div>
                                <div class="box-body table-responsive">
                                    @if( $data['content'] == null )
                                        {!! BootForm::open()->action( route( 'admin.clinic.store' ) ) !!}
                                    @else
                                        {!! BootForm::open()->put()->action( route( 'admin.clinic.update', [$data['content']->id] ) ) !!}
                                        {!! BootForm::bind( $data['content'] ) !!}
                                    @endif
                                    @include('pages.admin.clinic.form')   
                                    {!! BootForm::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>          
                </section>

@endsection


@section('custom-head')

@endsection

@section('custom-footer')

@endsection