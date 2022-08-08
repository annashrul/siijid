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
						<input type="hidden" name="colMuzaki" id="colMuzaki">
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
											<input type="text" class="form-control" id="total" name="total">
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
									<input type="text" class="form-control" name="<?=$field?>" id="<?=$field?>" value="Uang">
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
									<input type="text" class="form-control" name="<?=$field?>" id="<?=$field?>" value="Uang">
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
							<div class="col-md-4">
								<div class="form-group">
									<label for="">Shodaqoh</label>
									<input type="text" name="shodaqoh" class="form-control" id="shodaqoh" onkeyup="isMoney('shodaqoh', '+');">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="">Alamat</label>
									<input type="text" name="alamat" class="form-control" id="alamat">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="">Penerima</label>
									<select name="id_pengurus" class="form-control id_pengurus" id="id_pengurus"></select>
								</div>
							</div>

						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="submit">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">

				<div class="row">

					<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 noPadding">
						<div class="col-ld-2 col-md-2 col-sm-12 col-xs-12" style="margin-bottom:10px">
							<label>Periode</label>
							<?php $field = 'field-date';?>
							<div id="daterange" style="cursor: pointer;">
								<input type="text" name="periode" id="<?=$field?>" class="form-control" style="height: 40px;" value="<?=isset($this->session->search['periode'])?$this->session->search['periode']:(set_value('periode')?set_value('periode'):date("Y-m-d")." - ".date("Y-m-d"))?>">
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
								<button type="button" class="btn btn-primary bg-blue" onclick="showModal()" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cari" style="margin-top: 25px;"><i class="fa fa-plus"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 noPadding">
						<div class="table-responsive" style="margin-top: 20px;">
							<table class="table table-bordered table-hover">
								<thead>
								<tr>
									<th width="1%">No</th><th style="width: 12%!important;">Tanggal</th><th width="20%">Nama</th><th width="10%">Aksi</th><th width="65%">Menu</th>
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

<script type="text/javascript">
    var url = "<?=base_url('bo/log/')?>";  //** url assets **//
    var img = "<?=base_url('assets/')?>";   //** url images **//

	function showModal(){
		$("#modal_form").modal('show')
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
	$("#checked_fitrah").click(function(){
		if($('#checked_fitrah').prop('checked')===false){
			$("#hrg_beras").attr("readonly", true);
			$("#jumlah_jiwa").attr("readonly", true);
			$("#total").attr("readonly", true);
			$("#jns_fitrah").val('');
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
			$("#jns_maal").val('');
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
			$("#jns_fidyah").val('');
		}else{
			$("#nama_fidyah").attr("readonly", false);
			$("#bentuk_zakat_fidyah").attr("readonly", false);
			$("#nominal_fidyah").attr("readonly", false);
			$("#jumlah_hari").attr("readonly", false);
			$("#total_fidyah").attr("readonly", false);
			$("#jns_fidyah").val('Fidyah');
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
        load_data(1, {search: true, any: any,periode: periode});
    }


    //************* DATEPICKER **********************//
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

		$("#total_fidyah").val(total.substr(0, total.length-3))
	});

	$("#form_input").on('submit',function(e){
		e.preventDefault();
		$.ajax({
			url : "<?=base_url().'api/saveZakat'?>",
			type: "POST",
			dataType : "JSON",
			data:$("#form_input").serialize(),
			success:function(res){
				alert(res.pesan);
			}
		})
	})


</script>
