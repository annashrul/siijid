<!-- ========== Left Sidebar Start ========== -->
<style>
    .slimScrollBar{background: #1e88e5!important;border-radius: 0px!important;}
</style>
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div class="user-details">
            <div class="pull-left" id="img-left">
                <img src="<?=base_url().'assets/logo-masjid.png'?>" alt="" class="thumb-md img-circle">
            </div>
            <div class="user-info">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle name-left" data-toggle="dropdown" aria-expanded="false"><?=$this->session->id_pengurus=='0'?$user->nama_masjid:$user->nama_pengurus?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=base_url('auth/logout')?>"><i class="md md-settings-power"></i> Logout</a></li>
                        <li><a href="#!" onclick="setting()"><i class="md md-settings"></i> Profile</a></li>
                    </ul>
                </div>
                <p class="text-muted m-0" id="role-left"><?=$user->hak_akses?></p>
            </div>
        </div>
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="<?=base_url().'bo/dashboard'?>" class="waves-effect <?=($page=='dashboard')?'active':null?>">
                        <i class="md md-dashboard"></i><span>Dashboard</span>
                    </a>
                </li>
                <?php $akses = $this->session->hak_akses; ?>
                <li class="has_sub" style="font-weight: bold;" >
                    <?php $side_menu=null; $side_menu=array('0','pengurus','zakat','jadwal','jamaah','project','kas','kegiatan'); ?>
                    <a href="#" class="waves-effect <?=array_search($page, $side_menu)?'active':null?>">
                        <i class="md md-list"></i><span>Master Data</span><span class="pull-right"><i class="md md-add"></i></span>
                    </a>
                    <ul class="list-unstyled">
                        <li style="<?=$akses=='bendahara'?'display:none;':'display:block;'?>" class="<?=($page=='pengurus')?'active':null?>"><a href="<?=base_url().'bo/pengurus'?>">Pengurus</a></li>
                        <li style="<?=$akses=='bendahara'?'display:none;':'display:block;'?>" class="<?=($page=='zakat')?'active':null?>"><a href="<?=base_url().'bo/zakat'?>">Zakat</a></li>
                        <li style="<?=$akses=='bendahara'?'display:none;':'display:block;'?>" class="<?=($page=='jadwal')?'active':null?>"><a href="<?=base_url().'bo/jadwal'?>">Jadwal</a></li>
                        <li style="<?=$akses=='sekretaris'?'display:none;':'display:block;'?>" class="<?=($page=='project')?'active':null?>"><a href="<?=base_url().'bo/project'?>">Project</a></li>
                        <li style="<?=$akses=='sekretaris'?'display:none;':'display:block;'?>" class="<?=($page=='kas')?'active':null?>"><a href="<?=base_url().'bo/kas'?>">Kas</a></li>
                        <li style="<?=$akses=='bendahara'?'display:none;':'display:block;'?>" class="<?=($page=='kegiatan')?'active':null?>"><a href="<?=base_url().'bo/kegiatan'?>">Kegiatan</a></li>
                    </ul>
                </li>
                <li class="has_sub" style="font-weight: bold;<?=$akses=='bendahara'?'display:none;':'display:block;'?>">
                    <?php $side_menu=null; $side_menu=array('0','assets','kel_assets'); ?>
                    <a href="#" class="waves-effect <?=array_search($page, $side_menu)?'active':null?>">
                        <i class="md md-list"></i><span>Assets</span><span class="pull-right"><i class="md md-add"></i></span>
                    </a>
                    <ul class="list-unstyled">
                        <li class="<?=($page=='assets')?'active':null?>"><a href="<?=base_url().'bo/assets'?>">Assets</a></li>
                        <li class="<?=($page=='kel_assets')?'active':null?>"><a href="<?=base_url().'bo/kel_assets'?>">Kel Assets</a></li>
                    </ul>
                </li>
				<li class="has_sub" style="font-weight: bold;<?=$akses=='bendahara'?'display:none;':'display:block;'?>">
					<?php $side_menu=null; $side_menu=array('0','l_zakat'); ?>
					<a href="#" class="waves-effect <?=array_search($page, $side_menu)?'active':null?>">
						<i class="md md-list"></i><span>Laporan</span><span class="pull-right"><i class="md md-add"></i></span>
					</a>
					<ul class="list-unstyled">
						<li class="<?=($page=='l_zakat')?'active':null?>"><a href="<?=base_url().'laporan/zakat'?>">Zakat</a></li>
					</ul>
				</li>
                <li style="font-weight: bold;<?=$akses=='ketua' || 'super' ? 'display:block;':'display:none;'?>">
                    <a href="<?=base_url().'bo/log'?>" class="waves-effect <?=($page=='log')?'active':null?>">
                        <i class="fa fa-eye"></i><span>Log</span>
                    </a>
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<style>
    #map {
        height: 400px;
        width: 100%;
    }

    #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
    }

    #infowindow-content .title {
        font-weight: bold;
    }

    #infowindow-content {
        display: none;
    }

    #map #infowindow-content {
        display: inline;
    }

    .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
    }

    #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
    }

    .pac-controls {
        display: inline-block;
        padding: 5px 11px;
    }

    .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }

    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 100%;
    }

    #pac-input:focus {
        border-color: #4d90fe;
    }

    #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
    }
    #target {
        width: 345px;
    }
    .pac-container {
        background-color: #FFF;
        z-index: 1050;
        position: fixed;
        display: inline-block;
        float: left;
    }
</style>
<div id="modal_setting" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header noPadding">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_title"></h4>
            </div>
            <form id="form_setting">
                <div class="modal-body">
                    <div class="row">
                        <p class="text-center" id="pesan" style="color: red;"></p>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Nama Masjid</label>
                                <input type="text" name="nama_masjid" class="form-control" id="nama_masjid" readonly>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="control-label">Tahun Berdiri</label>
                                <input type="date" name="thn_berdiri" class="form-control" id="thn_berdiri">
                            </div>
                            <div class="form-group">
                                <label>Cari Lokasi</label>
                                <input id="pac-input" class="controls form-control" type="text" placeholder="Cari Lokasi">
                            </div>
                            <div id="map"></div>
                            <div class="form-group">
                                <?php $label = 'alamat'; ?>
                                <label>Alamat</label>
                                <textarea name="<?=$label?>" class="form-control" id="<?=$label?>" rows="4" readonly></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary bg-blue pull-right" id="simpan" name="simpan">Simpan</button>
                    <input type="hidden" name="lng" id="lng">
                    <input type="hidden" name="lat" id="lat">
                    <input type="hidden" name="param_" id="param_" value="add">
                    <input type="hidden" name="id" id="id_">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var img = "<?=base_url('assets/')?>"
    function setting() {
        $.ajax({
           url : "<?=base_url().'bo/setting/get_data'?>",
           type:"POST",
           dataType:"JSON",
           success:function(res){
               console.log(res.res_data['thn_berdiri']);
               $("#modal_setting").modal("show");
               $("#param_").val("edit");
               $("#id_").val(res.res_data['id_masjid']);
               $("#nama_masjid").val(res.res_data['nama_masjid']);
               $("#thn_berdiri").val(res.res_data['thn_berdiri']);
               $("#alamat").val(res.res_data['alamat_masjid']);
               initMap(18, parseFloat(res.res_data['latitude']), parseFloat(res.res_data['longitude']), 'map', 'edit');
               setTimeout(function () {
                   $("#nama_masjid").focus();
               }, 600);
           }
        });
    }
    $('#form_setting').validate({
        rules: {
            nama_masjid: {required: true},
            thn_berdiri: {required: true},
            alamat: {required: true}
        },
        //For custom messages
        messages: {
            nama_masjid:{required: "Nama Masjid Tidak Boleh Kosong!"},
            thn_berdiri:{required: "Tahun Beridiri Masjid Tidak Boleh Kosong!"},
            alamat:{required: "Alamat Masjid Tidak Boleh Kosong!"},
        },
        errorElement : 'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            $.ajax({
                url			: "<?=base_url().'bo/setting/simpan'?>",
                type		: "POST",
                dataType 	: "JSON",
                data    	: $("#form_setting").serialize(),
                beforeSend: function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg"></div>')},
                complete  : function() {$('.first-loader').remove()},
                success   : function(res){
                    if(res.pesan == ""){
                        $("#modal_setting").modal('hide');
                        swal({
                            type: 'success',
                            title: 'Success!',
                            text: 'Data Has Been Saved'
                        });
                        logout();
                    }else{
                        swal({
                            title: 'Error',
                            text: res.pesan,
                            type: 'warning',
                            confirmButtonColor: '#ff0000',
                            confirmButtonText: 'Oke'
                        })
                    }
                }, error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText)
                }
            });
        }
    });
</script>

<script>
    $("#pac-input").keypress(function (e) {
        if (e.keyCode == 13) {
            return false;
        }
    });

    $('#result_table').on('show.bs.dropdown', function () {
        document.querySelector('style').textContent += "@media only screen and (max-width: 500px) {.dropdown-position {position: relative}} @media only screen and (min-width: 500px) {.table-responsive {overflow: inherit !important}}";
    }).on('hide.bs.dropdown', function () {
        document.querySelector('style').textContent += "@media only screen and (min-width: 500px) {.table-responsive {overflow: auto}}";
    });

    function initMap(zoom_=14, lat_=-6.9228583, lng_=107.6058134, id_='map', param_='edit') {
        var uluru = {lat: lat_, lng: lng_};
        var map = new google.maps.Map(document.getElementById(id_), {
            zoom: zoom_,
            center: uluru
        });

        var geocoder = new google.maps.Geocoder;

        var marker = new google.maps.Marker({
            map: map
        });

        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();
            if (places.length == 0) {
                return;
            }

            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];

            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }

                markers.push(new google.maps.Marker({
                    map: map,
                    title: place.name,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    bounds.union(place.geometry.viewport);
                    $("#alamat").val(place.formatted_address);
                    $("#lat").val(place.geometry.location.lat());
                    $("#lng").val(place.geometry.location.lng());
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });

        if (param_ == 'set' || $("#param").val()=='edit') {
            marker.setPosition(uluru);
        }

        google.maps.event.addListener(map, 'click', function(e) {
            if (param_ == 'edit') {
                var latLng = e.latLng;
                marker.setPosition(latLng);
                $("#lat").val(latLng.lat());
                $("#lng").val(latLng.lng());
                markers.forEach(function(marker) {
                    marker.setMap(null);
                });
                geocoder.geocode({
                    'latLng': latLng
                }, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            $("#alamat").val(results[0].formatted_address);
                            $("#pac-input").val('');
                        }
                    }
                });
            }
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqD1Z03FoLnIGJTbpAgRvjcchrR-NiICk&libraries=places" async defer></script>

<!-- Left Sidebar End -->
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">

                    <ol class="breadcrumb pull-right">
                        <li><a href="#" id="titlemasjid">NETINDO</a></li>
                        <li class="active"><?=str_replace('_', ' ', $page) ?></li>
                    </ol>
                </div>
            </div>



