<style>
    /******************************************* MAIN CONTENT ASSETS ****************************************************/
    .wrapper{float:left;border-radius:.380rem;margin-bottom:10px;}
    .thumbnail-title {font-size: 20px;margin-top: 5px;}
    .img-thumb-bg #idetail{color: white;font-size:12px;}
    .img-thumb-bg #ihapus{color: white;font-size: 12px;margin-right:10px;}
    .img-thumb-bg {
        padding:0;overflow:hidden;min-height:200px;position:relative;border-radius:3px;background-position:center;
        background-color:transparent;background-repeat:no-repeat;background-size: cover;
    }
    .img-thumb-bg #expired{font-style:normal;text-transform:lowercase;color:white;font-weight:bold;font-size: 12px;}
    .img-thumb-bg p {color: #fff;margin-bottom: 0;line-height: 16px;}
    .img-thumb-bg .overlay {
        top: 0;left: 0;right: 0;bottom: 0;position: absolute;transition: all 0.3s ease-in-out;background: rgba(0, 0, 0, 0);
        background: -o-linear-gradient(top, rgba(0, 0, 0, 0) 50%, #000000 100%);
        background: -ms-linear-gradient(top, rgba(0, 0, 0, 0) 50%, #000000 100%);
        background: -moz-linear-gradient(top, rgba(0, 0, 0, 0) 50%, #000000 100%);
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 50%, #000000 100%);
        background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 50%, #000000 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(50%, rgba(0, 0, 0, 0)), color-stop(100%, #000000));
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#000000', endColorstr='#000000', GradientType=0);
    }
    .img-thumb-bg .caption {
        width:100%;bottom:-5px;height:100px;font-size:12px;position:absolute;padding:0 20px 20px;transition:all 0.3s ease-in-out;
    }
    .img-thumb-bg .caption .tag a {
        color:#fff;padding:0 5px;font-size:12px;border-radius:2px;display:inline-block;text-transform:uppercase;
        background-color: #2980B9;
    }
    .img-thumb-bg .caption .title { margin-top: 5px;font-size: 18px;line-height: 20px;}
    .img-thumb-bg .caption .title a {color: #fff;}
    .img-thumb-bg .caption .title a:hover {color: #2980B9;}
    .img-thumb-bg .caption .meta-data {color: #fff;font-size: 12px;line-height: 12px;margin-bottom: 15px;}
    .img-thumb-bg .caption .meta-data a {color: #fff;}
    .img-thumb-bg .caption .meta-data a .fa {color: #2980B9;}
    .img-thumb-bg .caption .meta-data a:hover {color: #2980B9;}
    .img-thumb-bg .caption .content {display: none;}
    .img-thumb-bg:hover .overlay {background: rgba(46, 49, 58, 0.8);}
    .img-thumb-bg:hover .caption {bottom: 60px;}
    .img-thumb-bg:hover .caption .content {display: block;}
    .curdet{cursor: pointer;}
    i.curdet{border-radius:50%;font-size:20px;color:#fff;border:1px solid white;padding:5px 5px 5px 5px;background:#5e72e4;}
    /******************************************* DETAIL ASSETS **********************************************************/
    /*.wrapper-detail{border:1px solid black;}*/
    /*.wrap-left-detail{border: 1px solid black;}*/
    .wrap-left-detail img.img-main{
        height: 120px;
        width: 100%;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 noPadding">
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Cari</label>
                                <input type="text" name="any" class="form-control pull-right" id="any" value="<?=isset($this->session->search['any'])?$this->session->search['any']:''?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-1 col-sm-12 col-xs-12 ">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary bg-blue" onclick="cari()" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cari" style="margin-top: 25px;"><i class="fa fa-search"></i></button>
                                <button type="button" class="btn waves-effect waves-light btn-primary" onclick="showModal('add')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah" style="margin-top: 25px;"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 noPadding" id="list_project">

                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <nav aria-label="..." id="pagination_link"></nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="page" id="page">
<div id="modal_form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="hideModal('tutupForm')">×</button>
                <h4 class="modal-title title-form">Modal Content is Responsive</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="form_input">
                        <input type="hidden" name="id_assets" id="id_assets" class="form-control id_assets">
                        <p class="text-center" id="pesan" style="color: red;"></p>
                        <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Nama</label>
                                <input type="text" name="nama_assets" class="form-control nama_assets">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Kel Assets</label>
                                <select name="id_kel_assets" id="idKelAssets" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Penanggung Jawab</label>
                                <select name="id_pengurus" class="form-control id_pengurus" id="id_pengurus"></select>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Qty</label>
                                <input type="number" name="qty_assets" class="form-control qty_assets">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Harga</label>
                                <input type="text" name="harga_assets" class="form-control harga_assets" id="harga_assets"  onkeyup="isMoney('harga_assets', '+');">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Supplier</label>
                                <input type="text" name="supplier" class="form-control supplier">
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Tgl Pembelian</label>
                                <input type="date" name="tgl_beli_assets" class="form-control tgl_beli_assets">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Expired</label>
                                <input type="date" name="umur_assets" class="form-control umur_assets">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Photo</label>
                                <input type="file" name="foto_assets" class="form-control foto_assets">
                                <div id="preview"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" onclick="hideModal('tutupForm')">Close</button>
                    <button type="button" class="btn btn-primary waves-effect" id="btn-tambah">Simpan</button>
                    <button type="button" class="btn btn-primary waves-effect" id="btn-update">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.modal -->
<!--************************************************* MODAL DETAIL ASSETS *******************************************-->
<div class="modal fade" id="modal_detail" role="dialog">
    <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content content-detail">
            <div class="modal-body">
                <div class="row wrapper-detail noPadding" id="result_detail">

                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-default" onclick="hideModal('tutupDetail')">tutup</button></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var url = "<?=base_url('bo/assets/')?>" //** url assets **//
    var img = "<?=base_url('assets/')?>"    //** url images **//

    $(document).ready(function(){
        load_data(1);
    }).on("click", ".pagination li a", function(event){
        event.preventDefault();
        var page = $(this).data("ci-pagination-page");
        load_data(page);
    });
    //************* LOAD DATA ***********************//
    function load_data(page,data={}) {
        $.ajax({
            url       : url+"get/"+page,
            method    : "POST",
            data      : data,
            dataType  : "JSON",
            beforeSend: function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg"></div>')},
            complete  : function() {$('.first-loader').remove()},
            success   : function(data) {
                console.log(data)
                $('#list_project').html(data.result_table);
                $('#pagination_link').html(data.pagination_link);
                $("#page").val(data.hal);

            }
        });
    }
    //************* PENCARIAN ***********************//

    function cari() {
        var any = $("#any").val();
        load_data(1, {search: true, any: any});
    }
    $("#any").on("keyup keypress",function(e){
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
        }
    });

    //************* GET ID KELOMPOK ASSETS **********//
    getKelAssets();
    function getKelAssets(){
        $.ajax({
            url:url+"get_param",
            type:"POST",
            dataType:"JSON",
            success:function(obj){
                var data = obj.getKelAssets;
                var html="";
                for(var i=0; i<data.length;i++){
                    html +=
                        "<option value='"+data[i].id_kel_assets+"'>"+data[i].nama_kel_assets+"</option>"
                }
                $("#idKelAssets").html(html);
            }
        });
    }
    //************* GET ID PENGURUS *****************//
    getPengurus();
    function getPengurus(){
        $.ajax({
            url:url+"get_param",
            type:"POST",
            dataType:"JSON",
            success:function(data){
                var obj = data.getPengurus;
                var html="";
                for(var i=0; i<obj.length;i++){
                    html +="<option value='"+obj[i].id_pengurus+"'>"+obj[i].nama_pengurus+"</option>"
                }
                $(".id_pengurus").html(html);
            }
        });
    }
    //************* SHOW MODAL FORM *****************//
    function showModal(param){
        if(param == "add") {
            loader();
            setTimeout(function () {
                $('.first-loader').remove()
                $("#modal_form").modal("show")
                $("#btn-tambah").show()
                $("#btn-update,#ketPhoto").hide()
                $(".title-form").html("Tambah Data Assets")
                getKelAssets()
                getPengurus()
                $("#preview").html('')
                $("#form_input")[0].reset()
            }, 500);
        }else{
            $("#btn-tambah").hide()
            $("#btn-update,#ketPhoto").show()
            $.ajax({
                url       : url+"get_param",
                type      : "POST",
                dataType  : "JSON",
                data      : "id_assets="+param,
                beforeSend: function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg"></div>')},
                complete  : function() {$('.first-loader').remove()},
                success   : function (data) {
                    var obj = data.getIdAssets;
                    $(".title-form").html("Edit Data Assets")
                    $("#modal_form").modal("show")
                    $("#param").val("Edit")
                    $(".nama_assets").val(obj.nama_assets)
                    $(".id_assets").val(obj.id_assets)
                    $(".id_kel_assets").val(obj.id_kel_assets)
                    $("#id_pengurus").val(obj.id_pengurus)
                    $(".supplier").val(obj.supplier)
                    $(".tgl_beli_assets").val(obj.tgl_beli_assets)
                    $(".umur_assets").val(obj.umur_assets)
                    $(".qty_assets").val(obj.qty_assets)
                    $(".harga_assets").val(obj.harga_assets)
                    $("#preview").html('<img src="'+img+'upload/assets/'+obj.foto_assets+'" class="img-responsive" style="height:50px;width:50px;">')
                }
            });

        }
    }
    //************* HIDE MODAL FORM *****************//
    function hideModal(param){
        if(param == "tutupForm"){
            loader()
            setTimeout(function() {
                $('.first-loader').remove()
                $("#modal_form").modal("hide")
                $("#form_input")[0].reset()
            },500)
        }else if(param == "tutupDetail"){
            loader()
            setTimeout(function() {
                $('.first-loader').remove()
                $("#modal_detail").modal("hide")
            },500)
        }
    }
    //************* TAMBAH && EDIT DATA *************//
    $("#btn-tambah").click(function(){
        var myForm = document.getElementById('form_input');
        $.ajax({
            url         : url+"tambah",
            type        : 'POST',
            data        : new FormData(myForm),
            dataType    :"JSON",
            processData : false,
            contentType : false,
            beforeSend  : function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg"></div>')},
            complete    : function() {$('.first-loader').remove()},
            success     : function(response){
                $("#pesan").html(response.pesan);
                if(response.pesan == "") {
                    $("#form_input")[0].reset();
                    $("#modal_form").modal('hide');
                    swal('Kerja Bagus!', 'Data Berhasil Disimpan!', 'success');
                    load_data($("#page").val());
                }
            },error: function(xhr, status, error) {
                alert("Data gagal disimpan!");
                console.log(xhr.responseText);
            }
        });
    });
    $("#btn-update").click(function(){
        var myForm = document.getElementById('form_input');
        $.ajax({
            url         : url+"edit",
            type        : 'POST',
            data        : new FormData(myForm),
            dataType    :"JSON",
            processData : false,
            contentType : false,
            beforeSend  : function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg"></div>')},
            complete    : function() {$('.first-loader').remove()},
            success     : function(response){
                $("#pesan").html(response.pesan);
                if(response.pesan == "") {
                    $("#form_input")[0].reset();
                    $("#modal_form").modal('hide');
                    swal('Kerja Bagus!', 'Data Berhasil Disimpan!', 'success');
                    load_data($("#page").val());
                }
            },error: function(xhr, status, error) {
                alert("Data gagal disimpan!");
                console.log(xhr.responseText);
            }
        });
    });
    //************* HAPUS DATA **********************//
    function hapus(param){
        swal({
            title             : 'Anda Yakin?',
            text              : "Anda Tidak Dapat Mengembalikan Data Ini!",
            type              : 'warning',
            showCancelButton  : true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor : '#d33',
            confirmButtonText : 'Yakin !',
            closeOnConfirm    : false,
            cancelButtonText: 'Batal'
        }).then(function(result){
            if(result.value){
                $.ajax({
                    url : url+"hapus",
                    type: "POST",
                    dataType: "JSON",
                    data:{id_assets:param},
                    beforeSend: function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg"></div>')},
                    complete  : function() {$('.first-loader').remove()},
                    success:function(res){
                        swal('Berhasil!','Data Berhasil Dihapus.','success');
                        load_data(1);
                    }
                });
            }else if(result.dismiss === 'cancel'){
                swal('Cancel','Data Tidak Jadi Dihapus.','success');
            }

        });
    }
    //************* DETAIL **************************//
    function detail(param){
        $.ajax({
            url       : url+"get_param",
            type      : "POST",
            dataType  : "JSON",
            data      : "id_assets="+param,
            beforeSend: function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg"></div>')},
            complete  : function() {$('.first-loader').remove()},
            success:function (data) {
                moment.locale("id");
                $("#modal_detail").modal("show")
                var obj = data.getIdAssets, html = ""
                html +=
                    '<div class="col-md-3 col-lg-3 col-sm-3 col-xs-4 wrap-left-detail">'+
                    '<img src="'+img+'upload/assets/'+obj.foto_assets +'" class="img-thumbnail img-main"><br/>'+
                    '<p class="text-center">Exp: '+obj.umur_assets+'</p>'+
                    '</div>'+
                    '<div class="col-md-9 col-lg-9 col-sm-9 col-xs-8 wrap-right-detail noPadding">'+
                    '<div class="col-md-12 noPadding">'+
                    '<h3 class="text-left noPadding">'+obj.nama_assets+
                    '<span class="badge badge-primary">'+obj.nama_kel_assets+'</span>'+
                    '</h3>'+
                    '<p class="text-left"><i class="md md-shop"></i> '+obj.supplier+'</p>'+
                    '</div>'+
                    '<div class="col-md-12 noPadding">'+
                    '<div class="table-responsive">'+
                    '<table class="table">'+
                    '<thead><tr><th>Qty</th><th>Harga</th><th>Total</th></tr></thead>'+
                    '<tbody><tr>'+
                    '<td>'+obj.qty_assets+'</td>'+
                    '<td>Rp. '+currency(obj.harga_assets)+'</td>'+
                    '<td>Rp. '+currency(obj.harga_assets * obj.qty_assets)+'</td>'+
                    '</tr></tbody>'+
                    '</table>'+
                    '</div>'+
                    '<p class="text-left">'+moment(obj.tgl_beli_assets).format("dddd, Do MMMM YYYY")+'</p>'+
                    '<p class="text-left">'+obj.nama_pengurus+'</p>'+
                    '</div>'+
                    '</div>';

                $("#result_detail").html(html)
            }
        });
    }

</script>