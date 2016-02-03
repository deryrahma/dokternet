@extends('layouts.master')

@section('content')

 
                <section class="content-header">
                    <h1>
                        Dokter
                        <small>Administrator panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Edit Dokter</li>
                    </ol>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Dokter</h3>                                    
                                </div>
                                <div class="box-body table-responsive">
                                    @if( $data['content'] == null )
                                        {!! BootForm::open()->action( route( 'admin.doctor.store' ) ) !!}
                                    @else
                                        {!! BootForm::open()->put()->action( route( 'admin.doctor.update', [$data['content']->id] ) ) !!}
                                        {!! BootForm::bind( $data['content'] ) !!}
                                    @endif
                                    @include('pages.admin.doctor.form')   
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