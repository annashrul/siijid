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
                                <button type="button" class="btn waves-effect waves-light btn-primary" onclick="add(); validasi('add');" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah" style="margin-top: 25px;"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 noPadding" id="list_project"></div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <nav aria-label="..." id="pagination_link"></nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--********************************** MODAL FORM ******************************-->
<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" id="modal_form" style="display: none">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header noPadding">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_title">Tambah</h4>
            </div>
            <form id="form_input">
                <div class="modal-body">
                    <div class="row">
                        <p class="text-center" id="pesan" style="color: red;"></p>
                        <div class="row">
                            <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <?php $label="nama_pengurus";?>
                                    <label>Nama</label>
                                    <input type="text" name="<?=$label?>" id="<?=$label?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <?php $field = 'tgl_lahir_pengurus';?>
                                    <label>Tgl Lahir</label>
                                    <input type="date" name="<?=$field?>" id="<?=$field?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <?php $field = 'no_hp_pengurus';?>
                                    <label>No Handphone</label>
                                    <input type="number" name="<?=$field?>" id="<?=$field?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Bagian</label>
                                    <?php $field = 'bagian_pengurus';
                                    $option = null;
                                    $option['ketua'] = 'Ketua';
                                    $option['bendahara'] = 'Bendahara';
                                    $option['sekretaris'] = 'Sekretaris';
                                    $option['anggota'] = 'Anggota';
                                    echo form_dropdown($field, $option, isset($this->session->search[$field])?$this->session->search[$field]:set_value($field), array('class' => 'select2', 'id'=>$field));
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Pendidikan</label>
                                    <?php $field = 'pendidikan_pengurus';
                                    $option = null;
                                    $option['SD']       = 'SD';
                                    $option['SMP']      = 'SMP';
                                    $option['SMA/SMK']  = 'SMA/SMK';
                                    $option['DI']       = 'DI';
                                    $option['DII']      = 'DII';
                                    $option['DIII']     = 'DIII';
                                    $option['DIV']      = 'DIV';
                                    $option['S1']       = 'S1';
                                    $option['S2']       = 'S2';
                                    $option['S3']       = 'S3';
                                    echo form_dropdown($field, $option, isset($this->session->search[$field])?$this->session->search[$field]:set_value($field), array('class' => 'select2', 'id'=>$field));
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <?php $field = 'jk_pengurus';
                                    $option = null;
                                    $option['Laki-Laki'] = 'Laki-Laki';
                                    $option['Perempuan'] = 'Perempuan';
                                    echo form_dropdown($field, $option, isset($this->session->search[$field])?$this->session->search[$field]:set_value($field), array('class' => 'select2', 'id'=>$field));
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <?php $label = 'file_upload'; ?>
                                    <label>Thumbnail</label>
                                    <input type="hidden" id="<?=$label?>ed" name="<?=$label?>ed" />
                                    <input type="file" id="<?=$label?>" name="<?=$label?>" onchange="return ValidateFileUpload()" accept="image/*" class="form-control">
                                    <p class="error" id="alr_<?=$label?>"></p>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <img style="max-width:250px; max-height:250px;" src="<?=base_url().'assets/no_image.png'?>" id="result_image">
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary" id="simpan" name="simpan">Simpan</button></div>
                <input type="text" name="param" id="param" value="add">
                <input type="text" name="id" id="id">
            </form>
        </div>
    </div>
</div>

<input type="hidden" name="page" id="page">

<style>
    .snip1336 {
        font-family: 'Roboto', Arial, sans-serif;
        position: relative;
        overflow: hidden;
        margin: 10px;
        min-width: 230px;
        max-width: 315px;
        width: 100%;

        color: #ffffff;
        text-align: left;
        line-height: 1.4em;
        background-color: #141414;
    }
    .snip1336 * {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-transition: all 0.25s ease;
        transition: all 0.25s ease;
    }
    .snip1336 img {
        max-width: 100%;
        vertical-align: top;
        opacity: 0.85;
    }
    .snip1336 figcaption {
        width: 100%;
        background-color: #141414;
        padding: 25px;
        position: relative;
    }
    .snip1336 figcaption:before {
        position: absolute;
        content: '';
        bottom: 100%;
        left: 0;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 55px 0 0 400px;
        border-color: transparent transparent transparent #141414;
    }
    .snip1336 figcaption a {
        padding: 5px;
        border: 1px solid #ffffff;
        color: #ffffff;
        font-size: 0.7em;
        text-transform: uppercase;
        margin: 10px 0;
        display: inline-block;
        opacity: 0.65;
        width: 47%;
        text-align: center;
        text-decoration: none;
        font-weight: 600;
        letter-spacing: 1px;
    }
    .snip1336 figcaption a:hover {
        opacity: 1;
    }
    .snip1336 .profile {
        border-radius: 50%;
        position: absolute;
        bottom: 100%;
        left: 25px;
        z-index: 1;
        max-width: 90px;
        opacity: 1;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    }
    .snip1336 .follow {
        margin-right: 4%;
        border-color: #2980b9;
        color: #2980b9;
    }
    .snip1336 h2 {
        margin: 0 0 5px;
        font-weight: 300;
    }
    .snip1336 h2 span {
        display: block;
        font-size: 0.5em;
        color: #2980b9;
    }
    .snip1336 p {
        margin: 0 0 10px;
        font-size: 0.8em;
        letter-spacing: 1px;
        opacity: 0.8;
    }
</style>

<script type="text/javascript">
    var url = "<?=base_url('bo/pengurus/')?>"; //** url assets **//
    var img = "<?=base_url('assets/')?>";    //** url images **//
    $(document).ready(function(){
        load_data(1);
        logout();
    }).on("click", ".pagination li a", function(event){
        event.preventDefault();
        var page = $(this).data("ci-pagination-page");
        load_data(page);
    });
    function add() {
        $("#modal_title").text("Tambah Pengurus");
        $("#param").val("add");
        $("#modal_form").modal("show");
        setTimeout(function () {
            $("#nama_pengurus").focus();
            $('#result_image').attr('src', '<?= base_url() ?>' + ('assets/no_image.png'));
        }, 600);
    }
    function validasi(action=''){
        // if(action=='add'){
        //     $('#file_upload').rules('remove', 'required');
        //     $('#file_upload').rules('add', {required: true});
        // } else if(action=='edit'){
        //     $('#file_upload').rules('remove', 'required');
        //     $('#file_upload').rules('add', {required: false});
        // }
    }
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
    //************* SHOW MODAL **********************//
    function edit(id) {
        $.ajax({
            url: url+"edit",
            type: "POST",
            data: {id: id},
            dataType: "JSON",
            beforeSend: function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg"></div>')},
            complete  : function() {$('.first-loader').remove()},
            success: function (res) {
                if (res.status) {
                    console.log(res.res_data);
                    $("#modal_title").text("Edit Pengurus");
                    $("#param").val("edit");
                    $("#id").val(id);
                    $("#nama_pengurus").val(res.res_data['nama_pengurus']);
                    $("#tgl_lahir_pengurus").val(res.res_data['tgl_lahir_pengurus']);
                    $("#no_hp_pengurus").val(res.res_data['no_hp_pengurus']);
                    $("#jk_pengurus").select2("val",res.res_data['jk_pengurus']);
                    $("#pendidikan_pengurus").select2("val",res.res_data['pendidikan_pengurus']);
                    $("#bagian_pengurus").select2("val",res.res_data['hak_akses']);
                    $('#file_upload').val('');
                    $('#file_uploaded').val((res.res_data['photo_pengurus']!=''?res.res_data['photo_pengurus']:''));
                    $('#result_image').attr('src', '<?= base_url() ?>' + (res.res_data['photo_pengurus']!=''?res.res_data['photo_pengurus']:'assets/no_image.png'));
                    $("#modal_form").modal("show");
                    setTimeout(function () {
                        $("#nama_pengurus").focus();
                    }, 600);
                } else {
                    alert("Error getting data!")
                }
            }
        });
    }
    //************* HIDE ****************************//

    //************* DETAIL **************************//

    //************* TAMBAH && UPDATE ****************//
    $('#form_input').validate({
        rules: {
            nama_pengurus: {
                required: true
            },
            no_hp_pengurus: {
                required: true
            },
            tgl_lahir_pengurus: {
                required: true
            }

        },
        //For custom messages
        messages: {
            nama_pengurus:{
                required: "nama tidak boleh kosong!"
            },
            no_hp_pengurus:{
                required: "no handphone tidak boleh kosong!"
            },
            tgl_lahir_pengurus:{
                required: "tanggal lahir tidak boleh kosong!"
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
                        $("#modal_form").modal('hide');
                        load_data($("#page").val());
                        logout();
                    } else {
                        console.log(res.pesan);
                        alert("Data gagal disimpan!");
                    }
                }
            });
        }
    });


    //************* HAPUS DATA **********************//
    function hapus(id){

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
                    data:{id: id},
                    beforeSend: function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg"></div>')},
                    complete  : function() {$('.first-loader').remove()},
                    success:function(res){
                        if(res.error==false){
                            console.log(res.pesan);
                            swal(
                                'Success!',
                                'Data Anda Berhasil Dihapus.',
                                'success'
                            );
                            load_data($("#page").val());
                            imgNav()
                        }else{
                            console.log(res.pesan);
                        }
                    },error: function(xhr, status, error) {
                        alert("Data tidak bisa dihapus!");
                        console.log(xhr.responseText);
                    }
                });
            }else if(result.dismiss === 'cancel'){
                swal('Cancel','Data Tidak Jadi Dihapus.','success');
            }

        });

    }
    $("#modal_form").on("hide.bs.modal", function () {
        document.getElementById("form_input").reset();
        $( "#form_input" ).validate().resetForm();
        $('#result_image').attr('src', '<?= base_url() ?>' + 'assets/no_image.png');
    });


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
</script>