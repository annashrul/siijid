<style>
    .middles{vertical-align:middle !important;}
</style>


<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<?=form_open(base_url("bo/zakat") , array('role'=>"form", 'class'=>""))?>
					<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 noPadding">
						<div class="col-ld-2 col-md-2 col-sm-3 col-xs-12" style="margin-bottom:10px">
							<label>Periode</label>
							<?php $field = 'field-date';?>
							<div id="daterange" style="cursor: pointer;">
								<input type="text" name="periode" id="<?=$field?>" class="form-control" style="height: 40px;" value="<?=isset($this->session->search['periode'])?$this->session->search['periode']:(set_value('periode')?set_value('periode'):date("Y-m-d")." - ".date("Y-m-d"))?>">
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Jenis</label>
								<?php $field = 'jenis';
								$option = null;
								$option[''] = 'Semua';
								$option['Fitrah']   = 'Fitrah';
								$option['Fidyah']   = 'Fidyah';
								$option['Mall']     = 'Maal';
								echo form_dropdown($field, $option, isset($this->session->search[$field])?$this->session->search[$field]:set_value($field), array('class' => 'select2', 'id'=>$field));
								?>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Bentuk</label>
								<?php $field = 'bentuk';
								$option = null;
								$option[''] = 'Semua';
								$option['Beras']   = 'Beras';
								$option['Uang']   = 'Uang';
								echo form_dropdown($field, $option, isset($this->session->search[$field])?$this->session->search[$field]:set_value($field), array('class' => 'select2', 'id'=>$field));
								?>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
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
									<th width="1%" rowspan="2" class="middles">No</th>
									<th width="1%" rowspan="2" class="middles">#</th>
									<th width="1%" rowspan="2" class="middles">Kd Trx</th>
									<th rowspan="2" class="middles">Penerima</th>
									<th width="1%"  rowspan="2" class="middles">RT</th>
									<th width="1%"  rowspan="2" class="middles">RW</th>
									<th width="1%"  rowspan="2" class="middles">Shodaqoh</th>
									<th width="1%"  rowspan="2" class="middles">Alamat</th>
									<th width="1%"  colspan="2" class="middles">Total</th>
									<th width="1%"  rowspan="2" class="middles">Tanggal</th>
								</tr>
								<tr>
									<th>Uang</th>
									<th>Beras</th>
								</tr>
								</thead>
								<tbody id="list_project"></tbody>
								<tbody id="res_per_page"></tbody>
								<tbody id="res_page"></tbody>
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

<div id="modal_form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header noPadding">
				<button type="button" class="close" onclick="hideModal('tutupForm')">×</button>
				<h4 class="modal-title title-form">Modal Content is Responsive</h4>
			</div>
			<form id="form_input">
				<div class="modal-body">
					<!-- FITRAH -->
					<div class="row">
						<div class="custom-control custom-switch mb-3">
							<input type="checkbox" class="custom-control-input theme-choice" id="checked_fitrah"/>
							<label class="custom-control-label" for="light-mode-switch">FITRAH</label>
						</div>
						<input type="hidden" name="colMuzaki" id="colMuzaki" value="0">
						<input type="hidden" name="kd_zakat" class="form-control kd_zakat" id="kd_zakat" value="<?=$this->m_crud->generate_kode("zakat",date("ym")).'-'.$this->nama_masjid['no_masjid'];?>">
						<input type="hidden" id="jns_fitrah" name="jns_fitrah">
						<input type="hidden" id="jns_maal" name="jns_maal">
						<input type="hidden" id="jns_fidyah" name="jns_fidyah">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="">Bentuk Zakat</label>
									<select name="bentuk_zakat" id="bentuk_zakat" class="form-control" onchange="changeBentukZakat($(this).val())">
										<option value="Uang">Uang</option>
										<option value="Beras">Beras</option>
									</select>
								</div>
							</div>
							<div class="col-md-9" id="container_jumlah_jiwa">
								<div class="row">
									<div class="col-md-3" id="container_hrg_beras">
										<div class="form-group">
											<label for="">Harga Beras</label>
											<input type="text" class="form-control" id="hrg_beras" name="hrg_beras" onkeyup="isMoney('hrg_beras', '+');">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="">Jumlah Jiwa</label>
											<input type="number" class="form-control" id="jumlah_jiwa" name="jumlah_jiwa" oninput="showMuzaki($(this).val())">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="" id="lbl">Persen</label>
											<input type="text" class="form-control" id="persen" name="persen" value="2.5" readonly>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="">Total</label>
											<input type="text" class="form-control" id="total" name="total" value="0">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row"  id="muzaki">
						</div>
					</div>
					<!-- MAAL -->
					<div class="row">
						<div class="custom-control custom-switch mb-3">
							<input type="checkbox" class="custom-control-input theme-choice" id="checked_maal"/>
							<label class="custom-control-label" for="light-mode-switch">MAAL</label>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<?php $field='nama_maal'; ?>
									<label for="">Nama</label>
									<input type="text" class="form-control" name="<?=$field?>" id="<?=$field?>">
								</div>

							</div>
							<div class="col-md-4">
								<div class="form-group">
									<?php $field='bentuk_zakat_maal'; ?>
									<label for="">Bentuk Zakat</label>
									<input type="text" class="form-control" name="<?=$field?>" id="<?=$field?>" value="Uang" readonly>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<?php $field='total_maal'; ?>
									<label for="">Total</label>
									<input type="text" class="form-control" name="<?=$field?>" id="<?=$field?>"  onkeyup="isMoney('<?=$field?>', '+');" value="0">
								</div>
							</div>
						</div>
					</div>
					<!-- FIDYAH -->
					<div class="row">
						<div class="custom-control custom-switch mb-3">
							<input type="checkbox" class="custom-control-input theme-choice" id="checked_fidyah"/>
							<label class="custom-control-label" for="light-mode-switch">FIDYAH</label>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<?php $field='nama_fidyah'; ?>
									<label for="">Nama</label>
									<input type="text" class="form-control" name="<?=$field?>" id="<?=$field?>">
								</div>

							</div>
							<div class="col-md-2">
								<div class="form-group">
									<?php $field='bentuk_zakat_fidyah'; ?>
									<label for="">Bentuk Zakat</label>
									<input type="text" class="form-control" name="<?=$field?>" id="<?=$field?>" value="Uang" readonly>
								</div>

							</div>
							<div class="col-md-2">
								<div class="form-group">
									<?php $field='nominal_fidyah'; ?>
									<label for="">Nominal Uang</label>
									<input type="text" class="form-control" name="<?=$field?>" id="<?=$field?>" onkeyup="isMoney('<?=$field?>', '+');" value="0">
								</div>

							</div>
							<div class="col-md-2">
								<div class="form-group">
									<?php $field='jumlah_hari'; ?>
									<label for="">Jumlah Hari</label>
									<input type="text" class="form-control" name="<?=$field?>" id="<?=$field?>">
								</div>

							</div>
							<div class="col-md-2">
								<div class="form-group">
									<?php $field='total_fidyah'; ?>
									<label for="">Total</label>
									<input type="text" class="form-control" name="<?=$field?>" id="<?=$field?>" value="0">
								</div>

							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label for="">Shodaqoh</label>
									<input type="text" name="shodaqoh" class="form-control" id="shodaqoh" onkeyup="isMoney('shodaqoh', '+');" value="0">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label for="">RT</label>
									<select name="rt" id="rt" class="select2">
										<option value="01">01</option>
										<option value="02">02</option>
										<option value="03">03</option>
										<option value="04">04</option>
										<option value="05">05</option>
										<option value="06">06</option>
										<option value="07">07</option>
										<option value="08">08</option>
										<option value="09">09</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
									</select>
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label for="">RW</label>
									<input type="text" name="rw" class="form-control" id="rw" value="08" readonly>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="">Alamat</label>
									<input type="text" name="alamat" class="form-control alamat" id="alamat" onkeyup="cektotal($('#total').val(),$('#total_maal').val(),$('#total_fidyah').val())">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="">Penerima</label>
									<select name="id_pengurus" class="form-control id_pengurus" id="id_pengurus"></select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="">Tanggal</label>
									<input type="text" name="tanggal" class="form-control" id="tanggal" value="<?=date('Y-m-d h:i:s')?>">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" id="subtotal" type="button" disabled>Total = 0</button>
					<button class="btn btn-primary" type="submit">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!--MODAL PRINT-->
<!--PRINT ASSETS-->
<style>
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
	.invoice-title h2, .invoice-title h3 {display: inline-block;}
	.table > tbody > tr > .no-line {border-top: none;}
	.table > thead > tr > .no-line {border-bottom: none;}
	.table > tbody > tr > .thick-line {border-top: 2px solid;}
</style>
<div class="modal fade" id="modal_print"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header noPadding">
				<button type="button" class="close" onclick="hideModal('tutup_print')">×</button>
				<h4 class="modal-titles title-detail" style="float:left;margin-right: 10px;"></h4>
				<button class="btn btn-primary" id="btnPrint"> <i class="fa fa-print"></i> </button>
			</div>
			<div class="modal-body">
				<div class="table-responsive result_print" id="printThis" style="padding:50px 30px 20px 30px;">


				</div>
			</div>

		</div>
	</div>
</div>
<style>
	.modal-dialog {
		width: 100%;
		height: 100%;
		margin: 0;
		padding: 0;
	}

	.modal-content {
		height: auto;
		min-height: 100%;
		border-radius: 0;
	}
</style>
<div class="modal fade" id="modal_laporan"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header noPadding">
				<button type="button" class="close" onclick="hideModal('tutup_laporan')">×</button>
				<button class="btn btn-primary" id="title_modal" disabled> </button>
			</div>
			<div class="modal-body">
				<div class="table-responsive" style="margin-top: 20px;">
					<table class="table table-bordered table-hover">
						<thead>
						<tr>
							<th width="15%" colspan="3"><center>Jumlah Jiwa</center></th>
							<th width="15%" colspan="3"><center>Anggota</center></th>
							<th width="15%" colspan="3"><center>Bentuk Zakat</center></th>
							<th width="15%" colspan="3"><center>Total</center></th>
						</tr>
						<tr>
							<th width="5%"><center>Fitrah</center></th>
							<th width="5%"><center>Maal</center></th>
							<th width="5%"><center>Fidyah</center></th>
							<th width="15%"><center>Fitrah</center></th>
							<th width="15%"><center>Maal</center></th>
							<th width="15%"><center>Fidyah</center></th>
							<th width="7.5%"><center>Fitrah</center></th>
							<th width="7.5%"><center>Maal</center></th>
							<th width="7.5%"><center>Fidyah</center></th>
							<th width="7.5%"><center>Fitrah</center></th>
							<th width="7.5%"><center>Maal</center></th>
							<th width="7.5%"><center>Fidyah</center></th>
						</tr>
						</thead>
						<tbody id="list_laporan">

						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
</div>
<input type="hidden" name="page" id="page">
<script type="text/javascript">
	var url = "<?=base_url('bo/zakat/')?>"  //** url assets **//
	var img = "<?=base_url('assets/')?>"    //** url images **//
	var form = $("#form_input"), form_modal = $("#modal_form"), notif = $("#pesan");
	var btn_tambah = $("#btn-tambah"), btn_update = $("#btn-update");
	var id=$(".id_zakat"),nama=$(".nama"),alamat=$(".alamat"),jenis=$(".jenis_zakat"),bentuk=$(".bentuk_zakat"),
		shodaqoh=$(".shodaqoh"),total_zakat=$(".total_zakat"),jumlah_jiwa=$(".jumlah_jiwa"),id_pengurus=$(".id_pengurus");
	var separator = $("#separator"), param_total=$("#paramTotal"), Total=$("#Total");




	$(document).ready(function(){
		load_data(1);
		getPengurus("<?=base_url().'bo/get_pengurus'?>",$(".id_pengurus"));
	}).on("click", ".pagination li a", function(event){
		event.preventDefault();
		var page = $(this).data("ci-pagination-page");
		load_data(page);

	});

	function cektotal(col1,col2,col3){
		totalFitrah=hapuskoma(col1);
		totalMaal=hapuskoma(col2);
		totalFidyah=hapuskoma(col3);
		totalShodaqoh=hapuskoma($("#shodaqoh").val());
		console.log(parseInt(totalFitrah)+parseInt(totalMaal)+parseInt(totalFidyah));
		var total=to_rp(parseInt(totalShodaqoh)+parseInt(totalFitrah)+parseInt(totalMaal)+parseInt(totalFidyah));
		$("#subtotal").text(total)
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
				$('#res_per_page').html(data.res_per_page);
				$('#res_page').html(data.res_page);
				$('#pagination_link').html(data.pagination_link);
				// $("#page").val(data.page);
			}
		});
	}
	//************* PENCARIAN ***********************//
	function cari() {
		var any     = $("#any").val();
		var periode = $("#field-date").val();
		var jenis   = $("#jenis").val();
		var bentuk  = $("#bentuk").val();
		console.log(periode);
		load_data(1, {search: true, any: any,periode: periode,jenis:jenis,bentuk:bentuk });

	}
	$("#any").on("keyup keypress",function(e){
		var keyCode = e.keyCode || e.which;
		if (keyCode === 13) {
			e.preventDefault();
		}
	});

	//************* SHOW MODAL **********************//
	function showModal(param){
		if(param === 'add'){
			$(".modal-title").html("Tambah Zakat");
			// $("#HargaBeras,#Persentase,#Total,#JumlahJiwa").hide();
			form[0].reset();
			btn_tambah.show();
			btn_update.hide();
			form_modal.modal("show");
			// setTimeout(function () {
			//     // $('.first-loader').remove();
			//     $(".nama").focus();
			// }, 500);
			// $("#modal_form").modal('show')
			$('#checked_fitrah').attr('checked',true);
			$("#hrg_beras").attr("readonly", false);
			$("#jumlah_jiwa").attr("readonly", false);
			$("#total").attr("readonly", false);
			$("#jns_fitrah").val('Fitrah');

			$("#nama_maal").attr("readonly", true);
			$("#bentuk_zakat_maal").attr("readonly", true);
			$("#total_maal").attr("readonly", true);

			$("#nama_fidyah").attr("readonly", true);
			$("#bentuk_zakat_fidyah").attr("readonly", true);
			$("#nominal_fidyah").attr("readonly", true);
			$("#jumlah_hari").attr("readonly", true);
			$("#total_fidyah").attr("readonly", true);
		}
		else{
			$.ajax({
				url 		: url+"get_param",
				type		: "POST",
				dataType 	: "JSON",
				data 		: {kd_zakat:param},
				beforeSend  : function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg""></div>')},
				complete	: function() {$('.first-loader').remove()},
				success		: function(res){
					console.log(res);
					btn_update.show();
					btn_tambah.hide();
					form_modal.modal("show");
					var total_zakat = res.res_data['total_zakat']; var jumlah_jiwa = res.res_data['jumlah_jiwa'];
					var harga_beras = total_zakat/jumlah_jiwa/25*100;
					$(".modal-title").html("Edit Zakat");
					$(".id_zakat").val(param);
					$(".nama").val(res.res_data['nama']);
					$(".alamat").val(res.res_data['alamat']);
					$(".jenis_zakat").val(res.res_data['jenis_zakat']);
					$(".bentuk_zakat").val(res.res_data['bentuk_zakat']);
					$(".shodaqoh").val(res.res_data['shodaqoh']);
					$("#id_pengurus").val(res.res_data['id_pengurus']);
					$(".total_zakat").val(res.res_data['total_zakat']);
					$(".kd_zakat").val(res.res_data['kd_zakat']);
					//wrap : HargaBeras,JumlahJiwa,Persentase,Total
					//class: harga_beras,jumlah_jiwa,sparator,total_zakat
					if($(".jenis_zakat").val()=='Fitrah' && $(".bentuk_zakat").val()=='Uang'){
						$("#HargaBeras,#JumlahJiwa,#Persentase,#Total").show();
						$(".harga_beras").val(harga_beras);
						$(".jumlah_jiwa").val(res.res_data['jumlah_jiwa']);
						$(".total_zakat").val(res.res_data['total_zakat']);
						$("#Total").removeClass("col-md-6 col-lg-6");
						$("#Total").addClass("col-md-3 col-lg-3");
					}
					if($(".jenis_zakat").val()=='Fitrah' && $(".bentuk_zakat").val()=='Beras'){
						$("#JumlahJiwa,#Persentase,#Total").show();
						$(".jumlah_jiwa").val(res.res_data['jumlah_jiwa']);
						$(".total_zakat").val(res.res_data['total_zakat']);
						$("#Total").removeClass("col-md-3 col-lg-3");
						$("#Total").addClass("col-md-6 col-lg-6");
					}
					if($(".jenis_zakat").val()=='Mall'){
						$("#Total").removeClass("col-md-3 col-lg-3");
						$("#Total").addClass("col-md-6 col-lg-6");
						$("#Total").show();
						$(".jumlah_jiwa").val("1");
						$(".total_zakat").val(res.res_data['total_zakat']);
					}
					if($(".jenis_zakat").val()=='Fidyah'){
						$("#Total").removeClass("col-md-3 col-lg-3");
						$("#Total").addClass("col-md-6 col-lg-6");
						$("#Total").show();
						$(".jumlah_jiwa").val("1");
						$(".total_zakat").val(res.res_data['total_zakat']);
					}
				}
			})
		}
	}
	// function showModal(){
	// 	$("#modal_form").modal('show')
	// 	$('#checked_fitrah').attr('checked',true);
	// 	$("#hrg_beras").attr("readonly", false);
	// 	$("#jumlah_jiwa").attr("readonly", false);
	// 	$("#total").attr("readonly", false);
	// 	$("#jns_fitrah").val('Fitrah');
	//
	// 	$("#nama_maal").attr("readonly", true);
	// 	$("#bentuk_zakat_maal").attr("readonly", true);
	// 	$("#total_maal").attr("readonly", true);
	//
	// 	$("#nama_fidyah").attr("readonly", true);
	// 	$("#bentuk_zakat_fidyah").attr("readonly", true);
	// 	$("#nominal_fidyah").attr("readonly", true);
	// 	$("#jumlah_hari").attr("readonly", true);
	// 	$("#total_fidyah").attr("readonly", true);
	// }
	$("#checked_fitrah").click(function(){
		if($('#checked_fitrah').prop('checked')===false){
			$("#hrg_beras").attr("readonly", true);
			$("#jumlah_jiwa").attr("readonly", true);
			$("#total").attr("readonly", true);
			$("#jns_fitrah").val('');
			$("#total").val('0');
			$("#hrg_beras").val("");
			$("#jumlah_jiwa").val("");
			$(".anggota").html('');
			cektotal('0','0','0')
		}else{
			$("#hrg_beras").attr("readonly", false);
			$("#jumlah_jiwa").attr("readonly", false);
			$("#total").attr("readonly", false);
			$("#jns_fitrah").val('Fitrah');
		}
	});
	$("#checked_maal").click(function(){
		if($('#checked_maal').prop('checked')===false){
			$("#nama_maal").attr("readonly", true);
			$("#bentuk_zakat_maal").attr("readonly", true);
			$("#total_maal").attr("readonly", true);
			$("#jns_maal").val('0');
			$("#nama_maal").val('');
			$("#total_maal").val('0');
			cektotal($("#total").val(),'0','0')
		}else{
			$("#nama_maal").attr("readonly", false);
			$("#bentuk_zakat_maal").attr("readonly", false);
			$("#total_maal").attr("readonly", false);
			$("#jns_maal").val('Maal');
		}
	});

	$("#checked_fidyah").click(function(){
		if($('#checked_fidyah').prop('checked')===false){
			$("#nama_fidyah").attr("readonly", true);
			$("#bentuk_zakat_fidyah").attr("readonly", true);
			$("#nominal_fidyah").attr("readonly", true);
			$("#jumlah_hari").attr("readonly", true);
			$("#total_fidyah").attr("readonly", true);
			$("#jns_fidyah").val('0');
			$("#nama_fidyah").val("");
			$("#nominal_fidyah").val('0');
			$("#jumlah_hari").val('');
			$("#total_fidyah").val('0');
			cektotal($("#total").val(),'0','0')
		}else{
			$("#nama_fidyah").attr("readonly", false);
			$("#bentuk_zakat_fidyah").attr("readonly", false);
			$("#nominal_fidyah").attr("readonly", false);
			$("#jumlah_hari").attr("readonly", false);
			$("#total_fidyah").attr("readonly", false);
			$("#jns_fidyah").val('Fidyah');
		}
	});

	function detail(id){
		// alert(id)
		$.ajax({
			url : "<?=base_url().'bo/zakat/detail'?>",
			type:"POST",
			dataType:"JSON",
			data:{id:id},
			success:function(res){
				console.log(res);
				$("#title_modal").text("Kode Zakat = "+id)
				$("#modal_laporan").modal('show');
				$("#list_laporan").html(res)
			}
		})
	}
	//************* HIDE ****************************//
	function hideModal(param){
		if(param === "tutupForm") {
			form_modal.modal("hide");
			form[0].reset();
			notif.html("");
			$("#HargaBeras,#Persentase,#Total,#JumlahJiwa").hide();
		}else if(param === "tutup_laporan"){
			$("#modal_laporan").modal("hide")
		}else{
			$("#modal_print").modal("hide")
		}
	}
	//************* JIKA JENIS ZAKAT DIPILIH ********//
	// $(".jenis_zakat").change(function(){
	//     if(this.value == "Fidyah" || this.value == "Mall"){
	//         // attr("style", "pointer-events: none;")
	//         $(".bentuk_zakat").val("Uang").attr("readonly", true);
	//         $("#Total").show();
	//         $("#JumlahJiwa,#HargaBeras,#JumlahJiwa,#Persentase").hide();
	//         $(".jumlah_jiwa").val("1").attr("readonly",true);
	//
	//         $("#paramTotal").html("Total");
	//         $(".total_zakat").val("");
	//         $("#Total").removeClass("col-md-3 col-lg-3");
	//         $("#Total").addClass("col-md-6 col-lg-6");
	//     }else if(this.value == "Fitrah"){
	//         $(".bentuk_zakat").attr("readonly", false);
	//         $(".bentuk_zakat")[0].selectedIndex = 0;
	//         $("#Total").hide();
	//         $("#JumlahJiwa").hide();
	//         $(".jumlah_jiwa").attr("readonly",false);
	//         $("#Total").removeClass("col-md-6 col-lg-6")
	//         $("#Total").addClass("col-md-3 col-lg-3")
	//     }
	// });
	// //************* JIKA BENTUK ZAKAT DIPILIH *******//
	// $(".bentuk_zakat").change(function () {
	//     if(this.value == "Uang") {
	//         $("#separator").html("Persen");
	//         $("#paramTotal").html("Total");
	//
	//         $(".harga_beras,.jumlah_jiwa,.total_zakat").val("");
	//         $("#HargaBeras,#JumlahJiwa,#Persentase,#Total").show();
	//         uang()
	//     }else if(this.value == "Beras"){
	//         $("#separator").html("Kg");
	//         $("#paramTotal").html("Total");
	//         $(".jumlah_jiwa,.total_zakat").val("");
	//         $("#JumlahJiwa,#Persentase,.total_zakat,#Total").show();
	//         $("#HargaBeras").hide();
	//         beras()
	//     }else if(this.value == "Default"){
	//         $("#HargaBeras,#JumlahJiwa,#Persentase,#Total").hide();
	//     }
	// });
	// //************* JIKA BENTUK ZAKAT UANG **********//
	// function uang(){
	//     $(".jumlah_jiwa").keyup(function(){
	//         var sparator 		= $(".sparator").val();
	//         var jumlah_jiwa = $(".jumlah_jiwa").val();
	//         var harga_beras = hapuskoma($(".harga_beras").val());
	//         var edc = jumlah_jiwa*sparator*harga_beras;
	//         var edc_rp = to_rp(edc);
	//         var s = edc_rp;
	//         var st = s.substr(0, s.length-3);
	//         $(".jumlah_jiwa").val()=="" ? $(".total_zakat").val("") : $(".total_zakat").val(st)
	//     });
	// }
	// //************* JIKA BENTUK ZAKAT BERAS *********//
	// function beras(){
	//     $(".jumlah_jiwa").keyup(function(){
	//         var sparator 		= $(".sparator").val();
	//         var jumlah_jiwa = $(".jumlah_jiwa").val();
	//         $(".jumlah_jiwa").val() == "" ? $(".total_zakat").val("") : parseFloat($(".total_zakat").val(jumlah_jiwa*sparator))
	//     });
	// }



	//************* TAMBAH && UPDATE ****************//
	$(document).ready(function(){
		btn_tambah.click(function() {
			if(validasi() === false){
				validasi()
			}else {
				$.ajax({
					url: url + "tambah",
					type: "POST",
					data: form.serialize(),
					dataType: "JSON",
					beforeSend: function () {$('body').append('<div class="first-loader"><img src="' + img + 'spin.svg""></div>')},
					complete: function () {$('.first-loader').remove()},
					success: function (data) {
						if(data.pesan===""){
							swal({
								title: "Transaksi Zakat Berhasil",
								type: 'success',
								showCancelButton: true,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								confirmButtonText: 'Print',
								cancelButtonText: 'Batal'
							}).then(function(result){
								if(result.value){
									$.ajax({
										url:"<?=base_url().'api/nota_zakat'?>",
										type:"POST",
										dataType:"JSON",
										data:{kd_zakat:$("#kd_zakat").val()},
										beforeSend: function () {$('body').append('<div class="first-loader"><img src="' + img + 'spin.svg""></div>')},
										complete: function () {$('.first-loader').remove()},
										success:function(res){
											if(res.kondisi===true){
												form_modal.modal("hide");
												$("#HargaBeras,#Persentase,#Total,#JumlahJiwa").hide();
												form[0].reset()
												swal("Kerja Bagus!", "Data Berhasil Disimpan!", "success");
												load_data($("#page").val());
												// goPrint('kas',res.result,false);
											}else{
												alert("error print");
											}

										}
									});
								}else if(result.dismiss === 'cancel'){
									alert('tidak jadi');
								}

							});
						}else{
							alert("gagal");
						}
					}, error: function (xhr, ajaxOptions, thrownError) {
						alert(xhr.responseText)
					}
				});
			}
		});

		btn_update.click(function() {
			$.ajax({
				url     		: url+"edit",
				type    		: "POST",
				data    		: form.serialize(),
				dataType		: "JSON",
				beforeSend	: function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg""></div>')},
				complete		: function() {$('.first-loader').remove()},
				success 		: function(data){
					notif.html(data.pesan);
					if(data.pesan === ""){
						form_modal.modal("hide");
						form[0].reset();
						swal("Kerja Bagus!","Data Berhasil Disimpan!","success");
						load_data($("#page").val());
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
					data:{kd_zakat:param},
					success: function(data){
						console.log(data.pesan)
						swal(
							'Success!',
							'Data Anda Berhasil Dihapus.',
							'success'
						);
						load_data($("#page").val());
					},error: function(xhr, status, error) {
						alert("Data tidak bisa dihapus!");
						console.log(xhr.responseText);
					}
				});
			}
		})
	}

	//************* SHOW MODAL PRINT ****************//
	function showPrint(id){
		$.ajax({
			url 				: url+"print",
			type 				: "POST",
			dataType 		: "JSON",
			data 				: {id:id},
			beforeSend	: function(){$('body').append('<div class="first-loader"><img src="<?=base_url().'/assets/spin.svg'?>"></div>')},
			complete		: function(){$('.first-loader').remove()},
			success:function(data){
				console.log(data.res_print);
				$("#modal_print").modal("show");
				$(".result_print").html(data.res_print);
			}
		})
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

		// document.getElementById("btnPrintLaporan").onclick = function () {
		//     loader();
		//     setTimeout(function () {
		//         $('.first-loader').remove();
		//         printElement(
		//             document.getElementById("printLaporan"),
		//         );
		//     }, 500);
		// }

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
	})

	function validasi(){
		if($(".nama").val()==""){
			notif.html("Silahkan Isi Field Nama")
			$(".nama").focus()
			return false
		}else if($(".alamat").val()==""){
			notif.html("Silahkan Isi Field Alamat")
			$(".alamat").focus()
			return false
		}

	}
	function after_change(val) {
		$.ajax({
			url: "<?php echo base_url().'welcome/set_session_date/' ?>" + btoa('field-date') + '/' + btoa(val),
			type: "GET"
		});
	}



	function showMuzaki(col){
		$.ajax({
			url : "<?=base_url().'api/showMuzaki'?>",
			type: "POST",
			dataType: "JSON",
			data:{col:col},
			success:function(res){
				$("#muzaki").html(res.result);
				$("#colMuzaki").val(res.countCol);
			}
		})
	}

	function changeBentukZakat(param){
		$("#jumlah_jiwa").val('');
		$("#hrg_beras").val('');
		$("#total").val('');
		$(".anggota").html('');
		if(param==='Beras'){
			$("#container_hrg_beras").hide();
			$("#lbl").text("Kg");
		}else{
			$("#container_hrg_beras").show();
			$("#lbl").text("Persen");
		}
	}

	$("#jumlah_jiwa").keyup(function(){
		var sparator 	= $("#persen").val();
		var jumlah_jiwa = $("#jumlah_jiwa").val();
		var harga_beras = hapuskoma($("#hrg_beras").val());
		if($("#bentuk_zakat").val()==='Uang'){
			var total = to_rp(jumlah_jiwa*sparator*harga_beras);
			var st = total.substr(0, total.length-3);
			$("#total").val(st);
			$("#subtotal").text(st);

			console.log(st);
		}else{
			parseFloat($("#total").val(jumlah_jiwa*sparator));
			console.log(jumlah_jiwa*sparator);
		}
	});

	$("#jumlah_hari").keyup(function(){
		var jumlah=hapuskoma($("#nominal_fidyah").val());
		var hari = $("#jumlah_hari").val();
		var total = to_rp(jumlah*hari);
		$("#total_fidyah").val(total.substr(0, total.length-3));

	});

	$("#form_input").on('submit',function(e){
		e.preventDefault();

		if($('#checked_fitrah').prop('checked')===true){
			if($("#hrg_beras").val()===''){$("#hrg_beras").focus();}
			else if($("#jumlah_jiwa").val()===''){$("#jumlah_jiwa").focus();}
			for(var i=0;i<$("#jumlah_jiwa").val();i++){
				if($("#anggota"+i).val()===''){
					$("#muzaki").css({"background-color": "yellow", "height": "100%"});
				}

			}
			simpan();
		}
		else if($('#checked_maal').prop('checked')===true){
			if($("#nama_maal").val()===''){$("#nama_maal").focus();}
			else if($("#total_maal").val()==='0'){$("#total_maal").focus()}
			else{simpan();}
		}
		else if($('#checked_fidyah').prop('checked')===true){
			if($("#nama_fidyah").val()===''){$("#nama_fidyah").focus();}
			else if($("#nominal_fidyah").val()==='0'){$("#nominal_fidyah").focus()}
			else if($("#jumlah_hari").val()===''){$("#jumlah_hari").focus()}
			else{simpan();}
		}

	});

	function simpan(){
		console.log('abu');
		if($(".alamat").val()===''){
			$(".alamat").focus();
		}else{
			$.ajax({
				url : "<?=base_url().'api/saveZakat'?>",
				type: "POST",
				dataType : "JSON",
				data:$("#form_input").serialize(),
				// beforeSend: function () {$('body').append('<div class="first-loader"><img src="' + img + 'spin.svg""></div>')},
				// complete: function () {$('.first-loader').remove()},
				success:function(res){
					if(res.status === 'success'){
						form_modal.modal("hide");
						form[0].reset()
						swal("Kerja Bagus!", "Data Berhasil Disimpan!", "success");
						load_data($("#page").val());
					}else{
						alert('terjadi kesalaha');
					}

				}
			})
		}

	}
</script>

