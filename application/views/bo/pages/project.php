<style>
    .text-title-project{font-weight: bold;}
    .text-project{color:#0072ff;}
    .sizes{font-size: 40px;}
    .border{border-bottom:1px solid #F1F1F1;margin-bottom:10px;}
    .main-secction{/*box-shadow: 10px 10px 10px;*/}
    .image-section{padding: 0px;cursor: pointer;}
    .image-section img{width: 100%;height:399px;position: relative;}
    .user-image{position: absolute;margin-top:-50px;}
    .user-left-part{margin: 0px;}
    .user-image img{width:100px;height:100px;}
    .user-profil-part{padding-bottom:30px;background-color:#FFFFFF;}
    .follow{margin-top:70px;}
    .user-detail-row{margin:0px;}
    .user-detail-section2 p{font-size:12px;padding: 0px;margin: 0px;}
    .user-detail-section2{margin-top:10px;}
    .user-detail-section2 span{color:#7CBBC3;font-size: 20px;}
    .user-detail-section2 small{font-size:12px;color:#D3A86A;}
    .profile-right-section{padding: 20px 0px 10px 15px;background-color: #FFFFFF;}
    .profile-right-section-row{margin: 0px;}
    .profile-header-section1 h1{font-size: 25px;margin: 0px;}
    .profile-header-section1 h5{color: #0062cc;}
    .req-btn{height:30px;font-size:12px;}
    .profile-tag{padding: 10px;border:1px solid #F6F6F6;}
    .profile-tag p{font-size: 12px;color:black;}
    .profile-tag i{color:#ADADAD;font-size: 20px;}
    .image-right-part{background-color: #FCFCFC;margin: 0px;padding: 5px;}
    .img-main-rightPart{background-color: #FCFCFC;margin-top: auto;}
    .image-right-detail{padding: 0px;}
    .image-right-detail p{font-size: 12px;}
    .image-right-detail a:hover{text-decoration: none;}
    .image-right img{width: 100%;}
    .image-right-detail-section2{margin: 0px;}
    .image-right-detail-section2 p{color:#38ACDF;margin:0px;}
    .image-right-detail-section2 span{color:#7F7F7F;}
    .nav-link{font-size: 1.2em;}
    .bs-wizard {margin-top: 40px;}
    /*Form Wizard*/
    .bs-wizard {border-bottom: solid 1px #e0e0e0; padding: 0 0 10px 0;}
    .bs-wizard > .bs-wizard-step {padding: 0; position: relative;}
    .bs-wizard > .bs-wizard-step + .bs-wizard-step {}
    .bs-wizard > .bs-wizard-step .bs-wizard-stepnum {color: #595959; font-size: 16px; margin-bottom: 5px;}
    .bs-wizard > .bs-wizard-step .bs-wizard-info {color: #999; font-size: 14px;}
    .bs-wizard > .bs-wizard-step > .bs-wizard-dot {position: absolute; width: 30px; height: 30px; display: block; background: #0072ff; top: 45px; left: 50%; margin-top: -15px; margin-left: -15px; border-radius: 50%;}
    .bs-wizard > .bs-wizard-step > .bs-wizard-dot:after {content: ' '; width: 14px; height: 14px; background: white; border-radius: 50px; position: absolute; top: 8px; left: 8px; }
    .bs-wizard > .bs-wizard-step > .progress {position: relative; border-radius: 0px; height: 8px; box-shadow: none; margin: 20px 0;}
    .bs-wizard > .bs-wizard-step > .progress > .progress-bar {width:0px; box-shadow: none; background: #0072ff;}
    .bs-wizard > .bs-wizard-step.complete > .progress > .progress-bar {width:100%;}
    .bs-wizard > .bs-wizard-step.active > .progress > .progress-bar {width:50%;}
    .bs-wizard > .bs-wizard-step:first-child.active > .progress > .progress-bar {width:0%;}
    .bs-wizard > .bs-wizard-step:last-child.active > .progress > .progress-bar {width: 100%;}
    .bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot {background-color: #f5f5f5;}
    .bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot:after {opacity: 0;}
    .bs-wizard > .bs-wizard-step:first-child  > .progress {left: 50%; width: 50%;}
    .bs-wizard > .bs-wizard-step:last-child  > .progress {width: 50%;}
    .bs-wizard > .bs-wizard-step.disabled a.bs-wizard-dot{ pointer-events: none; }
    .rounded-circle{border-radius: 50%}
    @media(max-width:767px){
        #image-section{
            width: 100%;
            height: auto;
        }
    }
    @media(min-width:768px){}
    @media(min-width:992px){}
    @media(min-width:1200px){}
</style>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">

                    <?=form_open(base_url("bo/project") , array('role'=>"form", 'class'=>""))?>
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 noPadding">
                        <div class="col-ld-2 col-md-2 col-sm-3 col-xs-12" style="margin-bottom:10px">
                            <label>Periode</label>
                            <?php $field = 'field-date';?>
                            <div id="ymrange" style="cursor: pointer;">
                                <input type="text" name="periode" id="<?=$field?>" class="form-control" style="height: 40px;" value="<?=isset($this->session->search['periode'])?$this->session->search['periode']:(set_value('periode')?set_value('periode'):date("Y-m")." - ".date("Y-m"))?>">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Status</label>
                                <?php $field = 'status';
                                $option = null;
                                $option[''] = 'Semua';
                                $option['Perencanaan'] = 'Perencanaan';
                                $option['Disetujui']   = 'Disetujui';
                                $option['Dimulai']     = 'Dimulai';
                                $option['Selesai']     = 'Selesai';
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
                                <button type="button" class="btn waves-effect waves-light btn-primary" onclick="add();validasi('add')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah" style="margin-top: 25px;"><i class="fa fa-plus"></i></button>
                                <button formtarget="_blank" type="submit" name="to_pdf" class="btn waves-effect waves-light btn-default" data-toggle="tooltip" data-placement="top" title="" data-original-title="export ke pdf" style="margin-top: 25px;"><i class="fa fa-file-pdf-o"></i></button>
                            </div>
                        </div>
                    </div>
                    <?=form_close()?>
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
<!--********************************** MODAL FORM ******************************-->
<div id="modal_form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header noPadding">
                <button type="button" class="close" onclick="hideModal('tutupForm')">×</button>
                <h4 class="modal-title title-form">Modal Content is Responsive</h4>
            </div>
            <form id="form_input">
                <div class="modal-body">
                    <div class="row">
                        <p class="text-center" id="pesan" style="color: red;"></p>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Project</label>
                                <input type="text" name="nama_project" class="form-control nama_project">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Mulai</label>
                                <input type="date" name="tgl_mulai" class="form-control tgl_mulai">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Akhir</label>
                                <input type="date" name="tgl_akhir" class="form-control tgl_akhir">
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" style="padding: 0px;">
                                    <?php $label = 'file_upload'; ?>
                                    <label>Thumbnail</label>
                                    <input type="hidden" id="<?=$label?>ed" name="<?=$label?>ed" />
                                    <input type="file" id="<?=$label?>" name="<?=$label?>" onchange="return ValidateFileUpload()" accept="image/*" class="form-control">
                                    <p class="error" id="alr_<?=$label?>"></p>
                                </div>
                                <div class="col-sm-12" style="padding: 0px;">
                                    <img style="max-width:250px; max-height:250px;" src="<?=base_url().'assets/no_image.png'?>" id="result_image">
                                </div>
                            </div>



                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Penanggun Jawab</label>
                                <select name="id_pengurus" class="form-control id_pengurus"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status Perencanaan</label>
                                <select name="status_project" class="form-control status_project">
                                    <option value="Perencanaan">Perencanaan</option>
                                    <option value="Disetujui">Disetujui</option>
                                    <option value="Dimulai">Dimulai</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Anggaran Project</label>
                                <input type="text" name="biaya_anggaran" class="form-control biaya_anggaran" id="biaya_anggaran"  onkeyup="isMoney('biaya_anggaran', '+');">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sumber Dana</label><br/>
                                <div class="checkbox checkbox-primary checkbox-inline">
                                    <input type="checkbox" id="cKas" value="Kas" name="cKas">
                                    <label for="kas"> Kas </label>
                                </div>
                                <div class="checkbox checkbox-primary checkbox-inline">
                                    <input type="checkbox" id="cDon" value="Donatur">
                                    <label for="inlineCheckbox2"> Donatur </label>
                                </div>
                                <div class="checkbox checkbox-primary checkbox-inline">
                                    <input type="checkbox" id="cSum" value="Sumbangan">
                                    <label for="inlineCheckbox2"> Sumbangan </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!--SUMBER DANA-->
                            <div class="col-md-12 noPadding">
                                <div class="col-md-4 noPadding" id="uangKas" style="display:none;">
                                    <div class="form-group">
                                        <input type="text" name="kas" class="form-control kas qty" placeholder="Kas" id="kas"  onkeyup="isMoney('kas', '+'); cek_qty();">
                                    </div>
                                </div>
                                <div class="col-md-4 noPadding" id="uangDonatur" style="display:none;">
                                    <div class="form-group">
                                        <input type="text" name="donatur" class="form-control donatur qty" placeholder="Donatur" id="donatur"  onkeyup="isMoney('donatur', '+');cek_qty();">
                                    </div>
                                </div>
                                <div class="col-md-4 noPadding" id="uangSumbangan" style="display:none;">
                                    <div class="form-group">
                                        <input type="text" name="sumbangan" class="form-control sumbangan qty" placeholder="Sumbangan" id="sumbangan"  onkeyup="isMoney('sumbangan', '+');cek_qty();">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 noPadding" id="TotalDana">
                                <div class="form-group">
                                    <label>Total Sumber Dana</label>
                                    <input type="text" name="total_sumber_dana" class="form-control total_sumber_dana"  id="total_sumber_dana" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 noPadding">
                                <div class="form-group">
                                    <label>Total Realisasi</label>
                                    <input type="text" name="total_realisasi" class="form-control total_realisasi" id="total_realisasi" onkeyup="isMoney('total_realisasi', '+');">
                                </div>
                            </div>
                        </div>
                        <!--SUMBER DANA-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Total Biaya</label>
                                <input type="text" name="total_biaya_project" class="form-control total_biaya_project" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="keterangan_project" class="form-control keterangan_project" style="height:83px;"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary" id="simpan" name="simpan">Simpan</button></div>
                <input type="text" name="param" id="param" value="add">
                <input type="hidden" name="id_project" class="form-control id_project">
                <input type="hidden" name="kd_project" class="form-control kd_project">
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    var base                = "<?=base_url()?>";
    var url 				= "<?=base_url('bo/project/')?>";  //** url assets **//
    var img 				= "<?=base_url('assets/')?>";    //** url images **//
    var notif         		= $("#pesan")
    var btn_tambah    		= $("#btn-tambah"), btn_update = $("#btn-update")
    var form 				= $("#form_input"), modal_form = $("#modal_form")
    var id_pengurus     	= $(".id_pengurus")
    var id            		= $(".id_project")
    var nama            	= $(".nama_project")
    var keterangan      	= $(".keterangan_project")
    var stat_pro      		= $(".status_project")
    var foto            	= $(".foto")
    var tgl_mulai       	= $(".tgl_mulai")
    var tgl_akhir       	= $(".tgl_akhir")
    var biaya_anggaran  	= $(".biaya_anggaran")
    var total_realisasi 	= $(".total_realisasi")
    var total_sumber_dana   = $(".total_sumber_dana")
    var total_biaya 		= $(".total_biaya_project")
    var kas 				= $(".kas"), cKas = $('#cKas')
    var don 				= $(".donatur"),cDon = $('#cDon')
    var sum 				= $(".sumbangan"), cSum = $('#cSum')
    var uang_kas 			= $("#uangKas")
    var uang_don 			= $("#uangDonatur")
    var uang_sum 			= $("#uangSumbangan")
    var qty 				= $(".qty")



    $('#form_input').validate({
        rules: {
            nama_project: {required: true},
            keterangan_project: {required: true},
            status_project: {required: true},
            tgl_mulai: {required: true},
            tgl_akhir: {required: true},
            biaya_anggaran: {required: true},
            total_realisasi: {required: true},
            total_sumber_dana: {required: true},
            total_biaya_project: {required: true},
            file_upload: {required: true, accept: "png|jpeg|jpg"}
        },
        //For custom messages
        messages: {
            nama_project:{required: "nama tidak boleh kosong!"},
            keterangan_project:{required: "keterangan tidak boleh kosong!"},
            status_project:{required: "status tidak boleh kosong!"},
            tgl_mulai:{required: "tanggal mulai tidak boleh kosong!"},
            tgl_akhir:{required: "tanggal akhir tidak boleh kosong!"},
            biaya_anggaran:{required: "biaya anggaran tidak boleh kosong!"},
            total_realisasi:{required: "total realisasi tidak boleh kosong!"},
            total_sumber_dana:{required: "sumber dana tidak boleh kosong!"},
            total_biaya_project:{required: "total biaya tidak boleh kosong!"},
            file_upload:{
                required: "Gambar tidak boleh kosong",
                accept: "Tipe file yang hanya boleh PNG, JPG, dan JPEG!"
            }
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
            var myForm = document.getElementById('form_input');
            $.ajax({
                url: url+"simpan",
                type: "POST",
                dataType:"JSON",
                data: new FormData(myForm),
                mimeType: "multipart/form-data",
                contentType: false,
                processData: false,
                beforeSend: function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg"></div>')},
                complete  : function() {$('.first-loader').remove()},
                success: function (res) {
                    if (res.error===false) {
                        console.log(res.pesan);
                        swal("Kerja Bagus!","Data Berhasil Disimpan!","success")
                        modal_form.modal("hide");
                        load_data($("#page").val());
                    } else {
                        console.log(res.pesan);
                        alert("Data gagal disimpan!");
                    }
                }
            });
        }
    });


    $(document).ready(function(){
        load_data(1);
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
        var status  = $("#status").val();

        load_data(1, {search: true, any: any,periode: periode,status:status});

    }
    //************* GET ID PENGURUS *****************//

    //************* SHOW MODAL **********************//
    function showModal(param){
        $.ajax({
            url 		: url+"get_param",
            type		: "POST",
            dataType 	: "JSON",
            data 		: {kd_project:param},
            beforeSend  : function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg""></div>')},
            complete	: function() {$('.first-loader').remove()},
            success		: function(data){
                var obj = data.get_id
                $(".title-form").html("Edit Project");
                $("#param").val("edit");
                btn_update.show();
                btn_tambah.hide();
                modal_form.modal("show");
                id.val(obj.id_project);
                $(".kd_project").val(param);
                nama.val(obj.nama_project);
                keterangan.val(obj.keterangan_project);
                tgl_mulai.val(obj.tgl_mulai);
                tgl_akhir.val(obj.tgl_akhir);
                id_pengurus.val(obj.id_pengurus);
                stat_pro.val(obj.status_project);
                biaya_anggaran.val(obj.biaya_anggaran);
                total_sumber_dana.val(obj.total_sumber_dana);
                total_realisasi.val(obj.total_realisasi);
                total_biaya.val(obj.total_biaya_project);
                if(obj.kas.length > 0){
                    cKas.prop('checked', true);
                    uang_kas.show();
                    kas.val(obj.kas);
                }
                else{
                    cKas.prop('checked', false);
                    uang_kas.show();
                }
                if(obj.donatur.length > 0){
                    cDon.prop('checked', true);
                    uang_don.show();
                    don.val(obj.donatur);
                }
                else{
                    cDon.prop('checked', false);
                    uang_don.show();
                }
                if(obj.sumbangan.length > 0){
                    cSum.prop('checked', true);
                    uang_sum.show();
                    sum.val(obj.sumbangan);
                }
                else{
                    cSum.prop('checked', false);
                    uang_sum.hide();
                }
                $('#file_upload').val('');
                $('#file_uploaded').val((obj.foto!=''?obj.foto:''));
                $('#result_image').attr('src', '<?= base_url() ?>' + (obj.foto!=''?obj.foto:'assets/no_image.png'));
            }
        })
    }
    //************* HIDE ****************************//
    function hideModal(param){
        if(param == "tutupForm"){
            modal_form.modal("hide")
            form[0].reset();
            notif.html("")
        }else{
            $("#modal_print").modal("hide")
        }
    }
    function add() {
        $(".title-form").html("Tambah Project");
        $("#param").val("add");
        $("#modal_form").modal("show");
        setTimeout(function () {
            $(".nama_project").focus();
            $('#result_image').attr('src', '<?= base_url() ?>' + ('assets/no_image.png'));
        }, 600);
    }
    function validasi(action=''){
        if(action=='add'){
            $('#file_upload').rules('remove', 'required');
            $('#file_upload').rules('add', {required: true});
        } else if(action=='edit'){
            $('#file_upload').rules('remove', 'required');
            $('#file_upload').rules('add', {required: false});
        }
    }


    function ValidateFileUpload() {
        var fuData = document.getElementById('file_upload');
        var FileUploadPath = fuData.value;
        var valid = 1;
        $("#alr_file_upload").text("");
        if (FileUploadPath == '') {
        } else {
            var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
            if (Extension == "gif" || Extension == "png" || Extension == "bmp" || Extension == "jpeg" || Extension == "jpg") {
                if (fuData.files && fuData.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#result_image').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(fuData.files[0]);
                }
            } else {
            }
        }
        return valid;
    }
    total_realisasi.keyup(function(){
        var TotDan = hapuskoma(total_sumber_dana.val());
        var TotRea = hapuskoma(total_realisasi.val());
        if(TotDan - TotRea == null || TotDan - TotRea == ""){
            total_biaya.val('0');
        }else{
            total_biaya.val(hapus_decimal(TotDan-TotRea));

        }
    });

    function cek_qty(){
        var num1 = document.getElementById('kas').value;
        var num2 = document.getElementById('donatur').value;
        var num3 = document.getElementById('sumbangan').value;

        var kas = parseFloat(hapuskoma(num1));
        var don = parseFloat(hapuskoma(num1)) + parseFloat(hapuskoma(num2)) ;
        var sum = parseFloat(hapuskoma(num1)) + parseFloat(hapuskoma(num2)) + parseFloat(hapuskoma(num3)) ;
        if (!isNaN(kas)) {
            document.getElementById('total_sumber_dana').value = hapus_decimal(kas);
        }
        if (!isNaN(kas) && !isNaN(don)) {
            document.getElementById('total_sumber_dana').value = hapus_decimal(don);
        }
        if (!isNaN(kas) && !isNaN(don)  && !isNaN(sum)) {
            document.getElementById('total_sumber_dana').value = hapus_decimal(sum);
        }
    }

    function hapus_decimal(field){
        var edc_rp = to_rp(field);
        var s = edc_rp;
        var st = s.substr(0, s.length-3);
        return st;
    }

    //END HITUNG TOTAL DANA
    cKas.change(function(){this.checked ? uang_kas.fadeIn('slow') : uang_kas.fadeOut('slow');});
    cDon.change(function(){this.checked ? uang_don.fadeIn('slow') : uang_don.fadeOut('slow');});
    cSum.change(function(){this.checked ? uang_sum.fadeIn('slow') : uang_sum.fadeOut('slow');});

    // btn_tambah.click(function(){
    //     if(validasi() == false){
    //         validasi()
    //     }else{
    //         var myForm = document.getElementById('form_input');
    //         $.ajax({
    //             url					: url+"tambah",
    //             type				: 'POST',
    //             dataType		: "JSON",
    //             data				: new FormData(myForm),
    //             processData	: false,
    //             contentType	: false,
    //             beforeSend	: function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg"></div>')},
    //             complete  	: function() {$('.first-loader').remove()},
    //             success			: function(response){
    //                 if(response.pesan == "") {
    //                     notif.html("");
    //                     modal_form.modal('hide');
    //                     swal('Kerja Bagus!', 'Data Berhasil Disimpan!', 'success');
    //                     load_data($("#page").val());
    //                     get_saldo();
    //                 }
    //             },
    //             error: function (xhr, ajaxOptions, thrownError) {alert(xhr.responseText);}
    //         });
    //     }
    // });
    //
    // btn_update.click(function(){
    //     var myForm = document.getElementById('form_input');
    //     $.ajax({
    //         url					: url+"edit",
    //         type				: 'POST',
    //         dataType		: "JSON",
    //         data				: new FormData(myForm),
    //         processData	: false,
    //         contentType	: false,
    //         beforeSend	: function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg"></div>')},
    //         complete  	: function() {$('.first-loader').remove()},
    //         success			: function(response){
    //             if(response.pesan == "") {
    //                 notif.html("");
    //                 modal_form.modal('hide');
    //                 swal('Kerja Bagus!', 'Data Berhasil Disimpan!', 'success');
    //                 load_data($("#page").val());
    //                 get_saldo();
    //             }
    //         },
    //         error: function (xhr, ajaxOptions, thrownError) {alert(xhr.responseText);}
    //     });
    // });


    // function validasi(){
    //     if(nama.val() == ""){
    //         notif.html("Nama Project Tidak Boleh Kosong");
    //         nama.focus();
    //         return false;
    //     }else if(tgl_mulai.val() == ""){
    //         notif.html("Tanggal Mulai Tidak Boleh Kosong");
    //         tgl_mulai.focus();
    //         return false;
    //     }else if(tgl_akhir.val() == ""){
    //         notif.html("Tanggal Akhir Tidak Boleh Kosong");
    //         tgl_akhir.focus();
    //         return false;
    //     }else if (foto.val() == "") {
    //         notif.html("Foto Tidak Boleh Kosong");
    //         foto.focus();
    //         return false;
    //     }else if(keterangan.val() == ""){
    //         notif.html("Deskripsi Project Tidak Boleh Kosong");
    //         keterangan.focus();
    //         return false;
    //     }else if(biaya_anggaran.val() == ""){
    //         notif.html("Anggaran Biaya Project Tidak Boleh Kosong");
    //         biaya_anggaran.focus();
    //         return false;
    //     }else if(!cKas.is(":checked") && !cDon.is(":checked") && !cSum.is(":checked")){
    //         alert("none checked");
    //         return false;
    //     }else if(cKas.is(":checked") && kas.val() == ""){
    //         notif.html("Silahkan Masukan Jumlah Uang Kasnya");
    //         kas.focus();
    //         return false;
    //     }else if(cDon.is(":checked") && don.val() == ""){
    //         notif.html("Silahkan Masukan Jumlah Uang Donaturnya");
    //         don.focus();
    //         return false;
    //     }else if(cSum.is(":checked") && sum.val() == ""){
    //         notif.html("Silahkan Masukan Jumlah Uang Sumbangannya");
    //         sum.focus();
    //         return false;
    //     }else if(total_realisasi.val() == ""){
    //         notif.html("Total Realisasi Project Tidak Boleh Kosong");
    //         total_realisasi.focus();
    //         return false;
    //     }
    // }

    function after_change(val) {
        $.ajax({
            url: "<?php echo base_url().'welcome/set_session_date/' ?>" + btoa('field-date') + '/' + btoa(val),
            type: "GET"
        });
    }
</script>