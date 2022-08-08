

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
					<?=form_open(base_url("bo/kas/cetak") , array('role'=>"form", 'class'=>""))?>
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 noPadding">
                        <div class="col-sm-3 col-xs-12" style="margin-bottom:10px">
                            <label>Periode</label>
							<?php $field = 'field-date';?>
                            <div id="daterange" style="cursor: pointer;">
                                <input type="text" name="periode" id="<?=$field?>" class="form-control" style="height: 40px;" value="<?=isset($this->session->search['periode'])?$this->session->search['periode']:(set_value('periode')?set_value('periode'):date("Y-m-d")." - ".date("Y-m-d"))?>">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Jenis</label>
								<?php $field = 'option_kas';
								$option = null;
								$option[''] = 'Semua';
								$option['Kas-Masuk'] = 'Kas Masuk';
								$option['Kas-Keluar'] = 'Kas Keluar';
								echo form_dropdown($field, $option, isset($this->session->search[$field])?$this->session->search[$field]:set_value($field), array('class' => 'select2', 'id'=>$field));
								?>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Cari</label>
                                <input type="text" name="any" class="form-control pull-right" id="any" value="<?=isset($this->session->search['any'])?$this->session->search['any']:''?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-1 col-sm-12 col-xs-12 ">
                            <div class="form-group paddingLeft">
                                <button type="button" class="btn btn-primary bg-blue" onclick="cari()" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cari" style="margin-top: 25px;"><i class="fa fa-search"></i></button>
                                <button type="button" class="btn waves-effect waves-light btn-primary" onclick="show_modal('add')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah" style="margin-top: 25px;"><i class="fa fa-plus"></i></button>
                                
                                <button formtarget="_blank" type="submit" name="to_pdf" class="btn waves-effect waves-light btn-default" data-toggle="tooltip" data-placement="top" title="" data-original-title="export ke pdf" style="margin-top: 25px;"><i class="fa fa-file-pdf-o"></i></button>
                                <button type="submit" name="to_excel" class="btn waves-effect waves-light btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="export ke excel" style="margin-top: 25px;"><i class="fa fa-file-excel-o"></i></button>

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
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>No</th><th>Kode Trx</th><th>Tanggal</th><th>Jenis</th><th>Keterangan</th><th>Kas Masuk</th><th>Kas Keluar</th><th>Saldo</th>
                                </tr>
                                </thead>
                                <tbody id="list_project"></tbody>
                                <tbody id="total_per_page"></tbody>
                                <tbody id="total"></tbody>
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

<!--*************** MODAL FORM ********************-->
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
                        <input type="hidden" name="id_kas" class="form-control id_kas">
<!--                        <input type="hi" name="kd_kas" id="kd_kas" value="">-->
                        <p class="text-center" id="pesan" style="color: red;"></p>
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Jenis</label>
                                <select name="jenis_kas" class="form-control jenis_kas">
                                    <option value="">Pilih Jenis Kas</option>
                                    <option value="Kas-Masuk">Kas-Masuk</option>
                                    <option value="Kas-Keluar">Kas-Keluar</option>
                                </select>
                            </div>
                        </div>
                        <input type="text" name="kas_in" id="kas_in">
                        <input type="text" name="kas_out" id="kas_out">
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Jumlah</label>
                                <input type="text" name="jumlah" class="form-control jumlah" onkeyup="valKas()">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control tanggal">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Pengurus</label>
                                <select name="id_pengurus" class="form-control id_pengurus"></select>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Keterangan</label>
                                <textarea name="keterangan" class="form-control keterangan"></textarea>
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
                <button class="btn btn-primary" id="btnPrint"> <i class="fa fa-print"></i> </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="printThis">
                        <div class="table-responsive" style="margin-top: 20px;">
                            <h3 class="text-center" id="param-detail">Laporan Kas</h3>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Jenis</th><th>Tanggal</th><th>Keterangan</th><th>Jumlah</th>
                                </tr>
                                </thead>
                                <tbody id="result_detail_kas"></tbody>
                                <tbody id="result_total_kas">
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    console.log($("#field-date").val());
    console.log($("#option_kas").val());
	var url = "<?=base_url('bo/kas/')?>"  //** url assets **//
	var img = "<?=base_url('assets/')?>"    //** url images **//
	var notif = $("#pesan"), btn_tambah = $("#btn-tambah"), btn_update = $("#btn-update")
	var form = $("#form_input"), modal_form = $("#modal_form"),modal_detail = $("#modal_detail")
	var id = $(".id_kas"), jenis = $(".jenis_kas"), jumlah=$(".jumlah"),tgl=$(".tanggal"), keterangan = $(".keterangan")
	var title = $(".title-form")
	jumlah.priceFormat({
		prefix: '',
		centsSeparator: '',
		centsLimit: 0,
		thousandsSeparator: ','
	});
    jenis.change(function(){
    	if(jenis.val()=='Kas-Masuk'){
    		$("#kas_out").val("0")
		    $("#kas_in").val("")
        }
	    if(jenis.val()=='Kas-Keluar'){
		    $("#kas_in").val("0")
		    $("#kas_out").val("")
	    }
    })
    
    function valKas(){
	    var myStr = jumlah.val();
	    var newStr = myStr.replace(/,/g, '');
	
	    console.log( newStr );
	    if(jenis.val()=='Kas-Masuk'){
			$("#kas_in").val(newStr)
        }
	    if(jenis.val()=='Kas-Keluar'){
		    $("#kas_out").val(newStr)
	    }
    }
    
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
		load_data(1);
        getPengurus("<?=base_url().'bo/get_pengurus'?>",$(".id_pengurus"));
	}).on("click", ".pagination li a", function(event){
		event.preventDefault();
		var page = $(this).data("ci-pagination-page");
		load_data(page);
		console.log(page);
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
			    // console.log(data);
				$('#list_project').html(data.result_project);
				$('#pagination_link').html(data.pagination_link);
				// $("#page").val(data.page);
                $("#total_per_page").html(data.total_per_page);
                $("#total").html(data.total);
			}
		});
	}
	//************* PENCARIAN ***********************//
	function cari() {
		var periode = $("#field-date").val();
		var option_kas  = $("#option_kas").val();
        var any = $("#any").val();
		load_data(1, {search: true, any: any, option_kas:option_kas, periode: periode});
	}
    $("#any").on("keyup keypress",function(e){
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
        }
    });
	//************* GET ID PENGURUS *****************//


	//************* SHOW MODAL **********************//
	function show_modal(param){
		if(param == "add"){

            btn_update.hide();
            btn_tambah.show();
            modal_form.modal("show");
            form[0].reset();
            notif.html("");
            title.html("Form Tambah Data Kas");
		}
		// else{
		// 	$.ajax({
		// 		url 			: url+"get_param",
		// 		type 			: "POST",
		// 		dataType 	: "JSON",
		// 		data 			: "id_kas="+param,
		// 		beforeSend: function(){$('body').append('<div class="first-loader"><img src="' + img + 'spin.svg""></div>')},
		// 		complete	: function(){$('.first-loader').remove()},
		// 		success		: function(data){
		// 			var obj = data.get_id
		// 			modal_form.modal("show")
		// 			title.html("Form Edit Data Kas")
		// 			btn_update.show()
		// 			btn_tambah.hide()
		// 			notif.html("")
		// 			id.val(obj.id_kas)
		// 			jenis.val(obj.jenis_kas)
		// 			jumlah.val(obj.jumlah)
		// 			tgl.val(obj.tanggal)
		// 			keterangan.val(obj.keterangan)
		// 			$(".id_pengurus").val(obj.id_pengurus);
		// 			$("#kas_in").val(obj.kas_in)
		// 			$("#kas_out").val(obj.kas_out)
		// 		}
		// 	})
		// }
	}
	//************* HIDE MODAL **********************//
	function hideModal(param){
		if(param == "tutupForm"){
            modal_form.modal("hide")
		}else{
            modal_detail.modal("hide")
		}
	}
	
	btn_tambah.click(function () {
		if(validasi() == false){
			validasi()
		}else {
			$.ajax({
				url			: url + "tambah",
				type		: "POST",
				data		: form.serialize(),
				dataType	: "JSON",
				beforeSend: function(){$('body').append('<div class="first-loader"><img src="' + img + 'spin.svg""></div>')},
				complete	: function(){$('.first-loader').remove()},
				success		: function(data){
					notif.html(data.pesan)
					if (data.pesan == "") {
						modal_form.modal("hide");
						swal("Kerja Bagus!", "Data Berhasil Disimpan!", "success");
						load_data($("#page").val());
					}
				}, error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.responseText)
				}
			});
		}
	})
	
	btn_update.click(function () {
		if(validasi() == false){
			validasi()
		}else {
			$.ajax({
				url				: url + "edit",
				type			: "POST",
				data			: form.serialize(),
				dataType	: "JSON",
				beforeSend: function(){$('body').append('<div class="first-loader"><img src="' + img + 'spin.svg""></div>')},
				complete	: function(){$('.first-loader').remove()},
				success		: function(data){
					notif.html(data.pesan)
					if (data.pesan == "") {
						modal_form.modal("hide");
						swal("Kerja Bagus!", "Data Berhasil Disimpan!", "success");
						load_data($("#page").val());
					}
				}, error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.responseText)
				}
			});
		}
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
					data:"id_kas="+param,
					success: function(data){
						swal(
							'Success!',
							'Data Anda Berhasil Dihapus.',
							'success'
						);
						get_pengurus()
						load_data($("#page").val())
					},error: function(xhr, status, error) {
						alert("Data tidak bisa dihapus!");
						console.log(xhr.responseText);
					}
				});
			}
		})
	}
	//************* VALIDASI ************************//
	function validasi(){
		if(jenis.val() == ""){
			notif.html("Silahkan Pilih Field Jenis Kas")
			jenis.focus()
			return false
		}else if(jumlah.val() == ""){
			notif.html("Silahkan Isi Field Jumlah Uang Kas")
			jumlah.focus()
			return false
		}else if(tgl.val() == ""){
			notif.html("Silahkan Isi Field Tanggal")
			tgl.focus()
			return false
		}else if(keterangan.val() == ""){
			notif.html("Silahkan Isi Field Keterangan")
			keterangan.focus()
			return false
		}
	}
	
//	in_out_come()
//	function in_out_come(){
//		$.ajax({
//			url: url + "get_param",
//			type: "POST",
//			dataType: "JSON",
//			success : function(data){
//				var kas_masuk = data.res_kas_masuk
//				var kas_keluar = data.res_kas_keluar
//				console.log(kas_keluar)
//				$("#Res_Kas_Masuk").html(kas_masuk)
//				$("#Res_Kas_keluar").html(kas_keluar)
//			}
//		})
//	}
// 	function CariBulan(){
// 		var option = $('[name="option_kas"]'), bulan = $('[name="per_bulan"]')
// 		var param = {
// 			"option_kas"  : option.val(),
// 			"per_bulan"   : bulan.val()
// 		}
// 		if(option.val() == ""){
// 			option.focus()
// 		}else {
// 			console.log(param)
// 			$.ajax({
// 				url: url + "get_param",
// 				type: "POST",
// 				dataType: "JSON",
// 				data: param,
// 				beforeSend: function () {
// 					$('body').append('<div class="first-loader"><img src="' + img + 'spin.svg""></div>')
// 				},
// 				complete: function () {
// 					$('.first-loader').remove()
// 				},
// 				success: function (data) {
// 					var obj = data.bln_thn, total = data.tot_bln_thn
// 					var opt = option.val().replace("-"," ")
// 					$("#param-detail").html("Laporan "+opt+ " Periode Bulan "+bulan.val())
// 					modal_detail.modal("show")
// 					$("#result_detail_kas").html(obj)
// 					$("#result_total_kas").html(total)
// 				}
// 			})
// 		}
// 	}
	
	// function CariTahun(){
	// 	var option = $('[name="option_kas"]'), tahun = $('[name="per_tahun"]')
	// 	var param = {
	// 		"option_kas"  : option.val(),
	// 		"per_tahun"   : tahun.val()
	// 	}
	// 	if(option.val() == ""){
	// 		option.focus()
	// 	}else {
	// 		$.ajax({
	// 			url: url + "get_param",
	// 			type: "POST",
	// 			dataType: "JSON",
	// 			data: param,
	// 			beforeSend: function () {
	// 				$('body').append('<div class="first-loader"><img src="' + img + 'spin.svg""></div>')
	// 			},
	// 			complete: function () {
	// 				$('.first-loader').remove()
	// 			},
	// 			success: function (data) {
	// 				var obj = data.tahun, total = data.tot_tahun
	// 				var opt = option.val().replace("-"," ")
	// 				$("#param-detail").html("Laporan "+opt+ " Periode Tahun "+tahun.val())
	// 				modal_detail.modal("show")
	// 				$("#result_detail_kas").html(obj)
	// 				$("#result_total_kas").html(total)
	// 			}
	// 		})
	// 	}
	// }
	
	//************* DATEPICKER **********************//
//	$(".waktu").change(function () {
//		if(this.value == "Bulan") {
//			$("#Per_Bulan,#Cari_Bulan").show()
//			$("#Per_Tahun,#Cari_Tahun").hide()
//			$(".per_bulan").focus()
//		}else if(this.value == "Tahun"){
//			$("#Per_Tahun,#Cari_Tahun").show()
//			$("#Per_Bulan,#Cari_Bulan").hide()
//			$(".per_tahun").focus()
//		}
//	})
//	$(function () {
//		$(".per_tahun").datepicker({
//			format: "yyyy",
//			viewMode: "years",
//			minViewMode: "years",
//			autoclose: true
//		});
//		$(".per_bulan").datepicker({
//			format: "mm/yyyy",
//			viewMode: "months",
//			minViewMode: "months",
//			autoclose: true
//		});
//	});
	
	function after_change(val) {
	    console.log(val);
		$.ajax({
			url: "<?php echo base_url().'welcome/set_session_date/' ?>" + btoa('field-date') + '/' + btoa(val),
			type: "GET"
		});
	}
</script>