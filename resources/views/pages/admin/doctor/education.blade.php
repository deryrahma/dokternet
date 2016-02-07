@extends('layouts.master')

@section('content')

 
                <section class="content-header">
                    <h1>
                        Dokter
                        <small>Administrator panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Tambah Pendidikan</li>
                    </ol>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Tambah Pendidikan</h3>                                    
                                </div>
                                <div class="box-body table-responsive">
                                    {!! BootForm::open()->action(route('admin.doctor.education.store',[$doctor->id])) !!}
                                    {!! BootstrapForm::text('year') !!}
                                    {!! BootstrapForm::text('name') !!}
                                    {!! BootstrapForm::submit('Tambah') !!}
                                    {!! BootForm::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>          
                </section>

@endsection


@section('custom-head')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false&amp;libraries=places"></script>
<script type="text/javascript">
    //Autocomplete variables
    var input = document.getElementById('location');
    var searchform = document.getElementById('form1');
    var place;
    var autocomplete = new google.maps.places.Autocomplete(input);
 
    //Google Map variables
    var map;
    var marker;
 
    //Add listener to detect autocomplete selection
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        place = autocomplete.getPlace();
        //console.log(place);
    });
 
    //Add listener to search
    searchform.addEventListener("submit", function() {
        var newlatlong = new google.maps.LatLng(place.geometry.location.lat(),place.geometry.location.lng());
        map.setCenter(newlatlong);
        marker.setPosition(newlatlong);
        map.setZoom(12);
 
    });
     
    //Reset the inpout box on click
    input.addEventListener('click', function(){
        input.value = "";
    });
 
 
 
    function initialize() {
      var myLatlng = new google.maps.LatLng(51.517503,-0.133896);
      var mapOptions = {
        zoom: 1,
        center: myLatlng
      }
      map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
 
      marker = new google.maps.Marker({
          position: myLatlng,
          map: map,
          title: 'Main map'
      });
    }
 
    google.maps.event.addDomListener(window, 'load', initialize);
 
</script>
@endsection

@section('custom-footer')

@endsection