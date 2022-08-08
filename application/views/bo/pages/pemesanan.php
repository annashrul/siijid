<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-4">
                        <button type="button" class="btn btn-primary waves-effect" onclick="add();">Tambah</button>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button type="button" class="btn waves-effect waves-light btn-primary"><i class="fa fa-search"></i></button>
                            </span>
                            <input
                                type="text" name="table_search" class="form-control pull-right search per_tahun"
                                onkeyup="return cari(event, $(this).val())"
                                value="<?=isset($this->session->search['any'])?$this->session->search['any']:''?>"
                                placeholder="Cari Berdasarkan Tgl Bayar Lulu Tekan Enter">
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 noPadding">
                        <div class="table-responsive" style="margin-top: 20px;">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>No</th><th>#</th><th>No Hewan</th><th>Nama</th><th>Alamat</th><th>Uang</th>
                                    <th>Infaq</th><th>Tanggal</th>
                                </tr>
                                </thead>
                                <tbody id="list_project"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <nav aria-label="..." id="pagination_link" style="float: right;"></nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--*************** MODAL FORM ********************-->
<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" id="modal_form" style="display: none">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header noPadding">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_title"></h4>
            </div>
            <form id="form_input">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama_pemesan" class="form-control nama_pemesan">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Jumlah Uang</label>
                                <input type="text" name="jumlah_uang" class="form-control jumlah_uang">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Jumlah Infaq</label>
                                <input type="text" name="jumlah_infaq" class="form-control jumlah_infaq">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Pengurus</label>
                                <select name="id_pengurus" class="form-control id_pengurus"></select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat_pemesan" class="form-control alamat_pemesan" style="height:74px;"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Catatan Khusus</label>
                                <textarea name="catatan_khusus" class="form-control catatan_khusus" style="height:74px;"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tgl_pemesanan" class="form-control tgl_pemesanan">
                            </div>
                        </div>
                     </div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary" id="simpan" name="simpan">Simpan</button></div>
                <input type="text" name="param" id="param" value="add">
                <input type="text" name="id" id="id">
                <input type="hidden" name="kd_pemesan" class="form-control kd_pemesan">
            </form>
        </div>
    </div>
</div>
<input type="hidden" name="page" id="page">



<script type="text/javascript">
    var url = "<?=base_url('bo/pemesanan/')?>"  //** url assets **//
    var img = "<?=base_url('assets/')?>"    //** url images **//

    $('#form_input').validate({
        rules: {
            nama_pemesan: {
                required: true
            },
            jumlah_uang: {
                required: true
            },
            alamat_pemesan: {
                required: true
            },
            tgl_pemesanan: {
                required: true
            }

        },
        //For custom messages
        messages: {
            nama_pemesan:{required: "nama tidak boleh kosong!"},
            jumlah_uang:{required: "no handphone tidak boleh kosong!"},
            alamat_pemesan:{required: "tanggal lahir tidak boleh kosong!"},
            tgl_pemesanan:{required: "Gambar tidak boleh kosong"}
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
                url: url+"simpan",
                type: "POST",
                dataType:"JSON",
                data: $("#form_input").serialize(),
                beforeSend: function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg"></div>')},
                complete  : function() {$('.first-loader').remove()},
                success: function (res) {
                    if (res.error===false) {
                        swal("Kerja Bagus!","Data Berhasil Disimpan!","success");
                        $("#modal_form").modal('hide');
                        load_data($("#page").val());
                        get_saldo();
                    } else {
                        swal("WARNING","Data Gagal Disimpan!","warning");
                    }
                }
            });
        }
    });

    function edit(id) {
        console.log(id);
        $.ajax({
            url: url+"edit",
            type: "POST",
            data: {kd_pemesan: id},
            dataType: "JSON",
            beforeSend: function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg"></div>')},
            complete  : function() {$('.first-loader').remove()},
            success: function (res) {
                if (res.status) {
                    $("#modal_form").modal("show");
                    setTimeout(function () {$(".nama_pemesan").focus();}, 600);
                    $("#modal_title").text("Edit Pemesanan");
                    $("#param").val("edit");
                    $(".kd_pemesan").val(res.res_data['kd_pemesan']);
                    $("#id").val(res.res_data['id_formulir_pemesanan']);
                    $(".nama_pemesan").val(res.res_data['nama_pemesan']);
                    $(".jumlah_uang").val(res.res_data['jumlah_uang']);
                    $(".alamat_pemesan").val(res.res_data['alamat_pemesan']);
                    $(".tgl_pemesanan").val(res.res_data['tgl_pemesanan']);
                    $(".jumlah_infaq").val(res.res_data['jumlah_infaq']);
                    $(".catatan_khusus").text(res.res_data['catatan_khusus']);
                    $(".id_pengurus").val(res.res_data['id_pengurus'])
                } else {
                    alert("Error getting data!")
                }
            }
        });
    }

    $(document).ready(function(){
        load_data(1);
        getPengurus("<?=base_url().'bo/get_pengurus'?>",$(".id_pengurus"));
    }).on("click", ".pagination li a", function(event){
        event.preventDefault();
        var page = $(this).data("ci-pagination-page");
        load_data(page);
    });
    function add() {
        $("#modal_title").text("Tambah Pemesanan");
        $("#param").val("add");
        $("#modal_form").modal("show");
        setTimeout(function () {
            $(".nama_pemesan").focus();
        }, 600);
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
    function cari(e, val) {
        if (e.keyCode == 13) {
            load_data(1, {search:true, any:val});
        }
    }
    function hapus(id){
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
                    data:{kd_pemesan: id},
                    success: function(res){
                        if(res.pesan==""){
                            swal('Success!','Data Anda Berhasil Dihapus.','success');
                            load_data($("#page").val());
                            get_saldo();
                        }else{
                            swal("WARNING","Data Gagal Disimpan!","warning")
                            console.log(res.pesan);
                        }

                    },error: function(xhr, status, error) {
                        alert("Data tidak bisa dihapus!");
                        console.log(xhr.responseText);
                    }
                });
            }
        })
    }


    //************* GET ID PENGURUS *****************//

    $("#modal_form").on("hide.bs.modal", function () {
        document.getElementById("form_input").reset();
        $( "#form_input" ).validate().resetForm();
    });

    $('.jumlah_uang,.jumlah_infaq').priceFormat({
        prefix: '',
        //centsSeparator: '',
        centsLimit: 0,
        thousandsSeparator: ','
    });
    // btn_tambah.click(function () {
    //     if(validasi() == false){
    //         validasi()
    //     }else {
    //         $.ajax({
    //             url				: url + "tambah",
    //             type			: "POST",
    //             data			: form.serialize(),
    //             dataType	: "JSON",
    //             beforeSend: function(){$('body').append('<div class="first-loader"><img src="' + img + 'spin.svg""></div>')},
    //             complete	: function(){$('.first-loader').remove()},
    //             success		: function(data){
    //                 notif.html(data.pesan)
    //                 if (data.pesan == "") {
    //                     modal_form.modal("hide")
    //                     swal("Kerja Bagus!", "Data Berhasil Disimpan!", "success")
    //                     load_data(1)
    //                     get_pengurus()
    //                     in_out_come()
    //                 }
    //             }, error: function (xhr, ajaxOptions, thrownError) {
    //                 alert(xhr.responseText)
    //             }
    //         });
    //     }
    // })
    //
    // function validasi(){
    //     if(nama.val() == ""){
    //         notif.html("Silahkan Isi Field Nama")
    //         nama.focus()
    //         return false
    //     }else if(jum_uang.val() == ""){
    //         notif.html("Silahkan Isi Field Jumlah Uang")
    //         jum_uang.focus()
    //         return false
    //     }else if(jum_infaq.val() == ""){
    //         notif.html("Silahkan Isi Field Jumlah Infaq")
    //         jum_infaq.focus()
    //         return false
    //     }else if(alamat.val() == ""){
    //         notif.html("Silahkan Isi Field Alamat")
    //         alamat.focus()
    //         return false
    //     }else if(tanggal.val() == ""){
    //         notif.html("Silahkan Isi Field Tanggal")
    //         tanggal.focus()
    //         return false
    //     }
    // }
</script>