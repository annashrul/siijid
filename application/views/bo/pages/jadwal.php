<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <?=form_open(base_url("bo/jadwal") , array('role'=>"form", 'class'=>""))?>
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 noPadding">
                        <div class="col-ld-2 col-md-2 col-sm-12 col-xs-12" style="margin-bottom:10px">
                            <label>Periode</label>
                            <?php $field = 'field-date';?>
                            <div id="ymrange" style="cursor: pointer;">
                                <input type="text" name="periode" id="<?=$field?>" class="form-control" style="height: 40px;" value="<?=isset($this->session->search['periode'])?$this->session->search['periode']:(set_value('periode')?set_value('periode'):date("Y-m")." - ".date("Y-m"))?>">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Kegiatan</label>
                                <?php $field = 'kegiatan';
                                $option = null; $option[''] = 'Semua';
                                $data_option = $this->m_crud->read_data('kegiatan', 'id_kegiatan, nama_kegiatan', null, 'nama_kegiatan asc');
                                foreach($data_option as $row){ $option[$row['id_kegiatan']] = $row['nama_kegiatan']; }
                                echo form_dropdown($field, $option, isset($this->session->search[$field])?$this->session->search[$field]:set_value($field), array('class' => 'select2', 'id'=>$field));
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Cari</label>
                                <input type="text" name="any" class="form-control" id="any" value="<?=isset($this->session->search['any'])?$this->session->search['any']:''?>" placeholder="Nama">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-1 col-sm-12 col-xs-12 ">
                            <div class="form-group paddingLeft">
                                <button type="button" class="btn btn-primary bg-blue" onclick="cari()" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cari" style="margin-top: 25px;"><i class="fa fa-search"></i></button>
                                <button type="button" class="btn waves-effect waves-light btn-primary" onclick="showModal('add')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah" style="margin-top: 25px;"><i class="fa fa-plus"></i></button>
                                <button formtarget="_blank" type="submit" name="to_pdf" class="btn waves-effect waves-light btn-default" data-toggle="tooltip" data-placement="top" title="" data-original-title="export ke pdf" style="margin-top: 25px;"><i class="fa fa-file-pdf-o"></i></button>
                            </div>
                        </div>
                    </div>
                    <?=form_close()?>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 noPadding">
                        <div class="table-responsive" style="margin-top: 20px;">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th width="1%">No</th><th>#</th><th>Kode</th><th>Nama</th><th>Kegiatan</th><th>Uang Transport</th><th>Tanggal</th>
                                </tr>
                                </thead>
                                <tbody id="list_project"></tbody>
                            </table>
                        </div>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header noPadding">
                <button type="button" class="close" onclick="hideModal('tutupForm')">×</button>
                <h4 class="modal-title title-form">Modal Content is Responsive</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="form_input">
                        <input type="hidden" name="id_jadwal" class="form-control id_jadwal">
                        <input type="hidden" name="kd_jadwal" class="form-control kd_jadwal">
                        <p class="text-center" id="pesan" style="color: red;"></p>
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Nama</label>
                                <input type="text" name="nama_imam" class="form-control nama_imam">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Kegiatan</label>
                                <select name="id_kegiatan" class="form-control id_kegiatan"></select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Hari</label>
                                <input type="date" name="waktu" class="form-control waktu">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Pengurus</label>
                                <select name="id_pengurus" class="form-control id_pengurus"></select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Uang Transport</label>
                                <input type="text" name="uang_transport" class="form-control" id="uang_transport">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" onclick="hideModal('tutupForm')">Close</button>
                <button type="button" class="btn btn-primary waves-effect" id="btn-tambah">Simpan</button>
                <button type="button" class="btn btn-primary waves-effect" id="btn-update">Simpan</button>
            </div>
        </div>
    </div>
</div>
<style>
    .wrap{height:370px;}
    @page { size: auto;  margin: 0mm; }
    @media screen {#printSection {display: none;}}
    @media print {
        body,html * {visibility:hidden;}
        #printSection, #printSection * {visibility:visible;}
        #printSection{position:absolute;left:0;top:0;font-size: 20px;width:100%;}
        #printSection tr th{line-height: 30px;font-weight: normal; font-size: 20px;}
        #printSection tr td{line-height: 30px;font-weight: normal; font-size: 20px;}
        #printSection h1{line-height: 30px;font-weight: normal; font-size: 50px;}
        #printSection h2{line-height: 30px;font-weight: normal; font-size: 40px;}
    }
</style>
<div id="modal_detail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header noPadding">
                <button type="button" class="close" onclick="hideModal('tutupDetail')">×</button>
                <h4 class="modal-title title-detail" style="float:left;margin-right: 10px;"></h4>
                <button class="btn btn-primary" id="btnPrint"> <i class="fa fa-print"></i> </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="printThis">
                        <div class="table-responsive" style="margin-top: 20px;">
                            <h3 class="text-center" id="param-detail"></h3>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>No</th><th>Kode</th><th>Nama</th><th>Jenis Ibadah</th><th>Waktu</th>
                                </tr>
                                </thead>
                                <tbody id="result_detail"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var url = "<?=base_url('bo/jadwal/')?>"  //** url assets **//
    var img = "<?=base_url('assets/')?>"    //** url images **//
    $(document).ready(function() {
        //FUNCTION PRINT
        document.getElementById("btnPrint").onclick = function () {
            loader();
            setTimeout(function () {
                $('.first-loader').remove();
                printElement(
                    document.getElementById("printThis"),
                );
            }, 500);
        }

        function printElement(elem) {
            var domClone = elem.cloneNode(true);
            var $printSection = document.getElementById("printSection");
            if (!$printSection) {
                var $printSection = document.createElement("div");
                $printSection.id = "printSection";
                document.body.appendChild($printSection);
            }
            $printSection.innerHTML = "";
            $printSection.appendChild(domClone);
            window.print();
        }
    });
    $(document).ready(function(){
        // cari();
        load_data(1);
        getKegiatan();
        getPengurus("<?=base_url().'bo/get_pengurus'?>",$(".id_pengurus"));
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
                $('#list_project').html(data.result_project);
                $('#pagination_link').html(data.pagination_link);
                $("#page").val(data.page);
            }
        });
    }
    //************* PENCARIAN ***********************//

    $("#any").on("keyup keypress",function(e){
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
        }
    });

    function cari() {
        var any     = $("#any").val();
        var periode = $("#field-date").val();
        var kegiatan   = $("#kegiatan").val();
        console.log(periode);
        console.log(kegiatan);
        load_data(1, {search: true, any: any,periode: periode,kegiatan:kegiatan});

    }

    function getKegiatan(){
        $.ajax({
            url:url+"get_kegiatan",
            type:"POST",
            dataType:"JSON",
            success:function(data){
                var obj = data.getKegiatan;
                var html="";
                for(var i=0; i<obj.length;i++){
                    html +="<option value='"+obj[i].id_kegiatan+"'>"+obj[i].nama_kegiatan+"</option>"
                }
                $(".id_kegiatan").html(html);
            }
        });
    }

    //************* DETAIL JADWAL *******************//

    //************* SHOW MODAL **********************//
    function showModal(param){
        if(param == "add"){
            $("#modal_form").modal("show");
            $("#form_input")[0].reset();
            $("#btn-tambah").show();
            $("#btn-update").hide();
            $(".title-form").html("Form Tambah Data Jadwal")
        }else{
            $("#modal_form").modal("show");
            $("#form_input")[0].reset();
            $("#btn-tambah").hide();
            $("#btn-update").show();
            $("#ifNull").show();
            $(".title-form").html("Form Edit Data Jadwal");
            $.ajax({
                url     		: url+"get_param",
                type    		: "POST",
                dataType		: "JSON",
                data    		: {kd_jadwal:param},
                beforeSend	: function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg""></div>')},
                complete		: function() {$('.first-loader').remove()},
                success : function(data){
                    var obj = data.getId;
                    console.log(obj)
                    $(".kd_jadwal").val(obj.kd_jadwal);
                    $(".id_jadwal").val(obj.id_jadwal);
                    $(".nama_imam").val(obj.nama_imam);
                    $(".id_pengurus").val(obj.id_pengurus);
                    $(".id_kegiatan").val(obj.id_kegiatan);
                    $(".waktu").val(obj.waktu);
                    $("#uang_transport").val(obj.uang_transport)
                },error: function (jqXHR, textStatus, errorThrown){alert('Error');}
            })
        }
    }
    //************* HIDE MODAL **********************//
    function hideModal(param){
        if(param == "tutupForm"){
            $("#modal_form").modal("hide")
            $("#form_input")[0].reset()
            $("#pesan").html("")
        }else{
            $("#modal_detail").modal("hide");
        }
    }
    //************* TAMBAH && UPDATE ****************//
    $(document).ready(function(){
        $("#btn-tambah").click(function() {
            $.ajax({
                url     		: url+"tambah",
                type    		: "POST",
                data    		: $("#form_input").serialize(),
                dataType		: "JSON",
                beforeSend	: function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg""></div>')},
                complete		: function() {$('.first-loader').remove()},
                success 		: function(data){
                    $("#pesan").html(data.pesan)
                    if(data.pesan == ""){
                        $("#modal_form").modal("hide")
                        $("#form_input")[0].reset()
                        swal("Kerja Bagus!","Data Berhasil Disimpan!","success")
                        load_data($("#page").val());
                        get_saldo();
                        cari();
                    }
                },error: function (xhr, ajaxOptions, thrownError) {alert(xhr.responseText)}
            });
        })

        $("#btn-update").click(function() {
            $.ajax({
                url     		: url+"edit",
                type    		: "POST",
                data    		: $("#form_input").serialize(),
                dataType		: "JSON",
                beforeSend	: function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg""></div>')},
                complete		: function() {$('.first-loader').remove()},
                success 		: function(data){
                    $("#pesan").html(data.pesan)
                    if(data.pesan == ""){
                        $("#modal_form").modal("hide");
                        $("#form_input")[0].reset();
                        swal("Kerja Bagus!","Data Berhasil Disimpan!","success")
                        load_data($("#page").val());
                        get_saldo();
                    }
                },error: function (xhr, ajaxOptions, thrownError) {alert(xhr.responseText)}
            });
        })
    })
    //************* HAPUS DATA **********************//
    function hapus(param){
        swal({
            title: 'Anda Yakin?',
            text: "Anda Tidak Dapat Mengembalikan Data Ini!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yakin !',
            closeOnConfirm: false
        }).then(function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url : url+"hapus",
                    type: "POST",
                    dataType: "JSON",
                    data:{kd_jadwal:param},
                    success: function(data){
                        if(data.pesan==""){
                            swal('Success!','Data Anda Berhasil Dihapus.', 'success');
                            load_data($("#page").val());
                        }else{
                            console.log(data.pesan);
                        }

                    },error: function(xhr, status, error) {
                        alert("Data tidak bisa dihapus!");
                        console.log(xhr.responseText);
                    }
                });
            }
        })
    }
    //************* DATEPICKER **********************//
    function after_change(val) {
        $.ajax({
            url: "<?php echo base_url().'welcome/set_session_date/' ?>" + btoa('field-date') + '/' + btoa(val),
            type: "GET"
        });
    }
    $('#uang_transport').priceFormat({
        prefix: '',
        //centsSeparator: '',
        centsLimit: 0,
        thousandsSeparator: ','
    });

</script>