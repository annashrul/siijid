
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 noPadding">
            <div class="col-md-1 col-lg-1 col-sm-1 col-xs-2" style="margin-bottom: 10px;">
              <span class="input-group-btn">
                <button type="button" class="btn btn-primary waves-effect" onclick="showModal('add')">
                  <i class="fa fa-plus"></i>
                </button>
              </span>
            </div>
            <div class="col-md-8 col-lg-6 col-sm-2 col-xs-10">
              <div class="input-group">
                <input type="text" name="kepala_keluarga" class="form-control kepala_keluarga" placeholder="Masukan No Unik Untuk Melihat Detail Keluarga">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-primary waves-effect" onclick="detail()">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
            </div>
            
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<div class="input-group">
              <span class="input-group-btn">
                <button type="button" class="btn waves-effect waves-light btn-primary"><i class="fa fa-search"></i></button>
              </span>
							<input
								type="text" name="table_search" class="form-control pull-right search"
								onkeyup="return cari(event, $(this).val())"
								value="<?=isset($this->session->search['any'])?$this->session->search['any']:''?>"
								placeholder="Cari Nama Lulu Tekan Enter">
						</div>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 noPadding">
						<div class="table-responsive" style="margin-top: 20px;">
							<table class="table">
								<thead>
								<tr>
									<th>Nama</th><th>Jenis Kelamin</th><th>Pekerjaan</th><th>Pendidikan</th>
									<th>Status</th><th>Tgl Lahir</th><th>No Telp</th><th>No Unik</th><th>#</th>
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
<!-- FORM MODAL -->
<div id="modal_form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg" style="width: 100%;">
		<div class="modal-content">
			<div class="modal-header noPadding">
				<button type="button" class="close" onclick="hideModal('tutupForm')">×</button>
				<div class="row">
					<div class="col-md-1 col-lg-1 col-sm-1 col-xs-4" id="control-row">
						<button class="btn btn-primary" id="hps_row"><i class="fa fa-close"></i></button>
						<button class="btn btn-primary" id="add_row"><i class="fa fa-plus"></i></button>
					</div>
					<div class="col-md-2 col-lg-2 col-sm-2 col-xs-6">
						<div class="input-group">
							<input type="text" class="form-control" value="Lihat Kepala Keluarga" disabled>
							<span class="input-group-btn">
								<button type="submit" class="btn btn-primary" onclick="showModal('BrowseKKInForm')"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="table-responsive">
						<form id="form_input" class="form-horizontal">
							<p class="text-center" id="pesan" style="color: red;"></p>
							<table class="table table-bordered table-striped fixed_headers" id="table">
								<thead>
								<tr>
									<th>Nama</th>
									<th>Alamat</th>
									<th>Pekerjaan</th>
									<th>Pendidikan</th>
									<th>Status</th>
									<th>Jenis Kelamin</th>
									<th>Tanggal Lahir</th>
									<th>No Telepon</th>
									<th>No Unik
										<span id="n" class="btn btn-primary btn-xs">on</span>
										<span id="ff" class="btn btn-danger btn-xs" style="display: none;">off</span>
									</th>
								</tr>
								</thead>
								<tbody id="table_details">
								<tr id="idtr">
                  <input type="hidden" name="id_jamaah" class="id_jamaah">
									<td><input type="text" class="form-control nama_jamaah" name="nama_jamaah[]"></td>
									<td><textarea class="form-control alamat_jamaah" name="alamat_jamaah[]"></textarea></td>
									<td><input type="text" class="form-control pekerjaan_jamaah" name="pekerjaan_jamaah[]"></td>
									<td>
										<select name="pendidikan_jamaah[]" class="form-control pendidikan_jamaah">
											<option value="Belum-Sekolah">Belum-Sekolah</option>
											<option value="SD">SD</option>
											<option value="SMP">SMP</option>
											<option value="SMA / SMK">SMA / SMK</option>
											<option value="D-I">D-I</option>
											<option value="D-II">D-II</option>
											<option value="D-III">D-III</option>
											<option value="D-IV">D-IV</option>
											<option value="S1">S1</option>
											<option value="S2">S2</option>
											<option value="S3">S3</option>
										</select>
									</td>
									<td>
										<select name="status_jamaah[]" class="form-control status_jamaah">
											<option value="Kepala-Keluarga">Kepala Keluarga</option>
											<option value="Istri">Istri</option>
											<option value="Anak">Anak</option>
										</select>
									</td>
									<td>
										<select name="jenis_kelamin_jamaah[]" class="form-control jenis_kelamin_jamaah" autocomplete="off">
											<option value="Laki-Laki">Laki-Laki</option>
											<option value="Perempuan">Perempuan</option>
										</select>
									</td>
									<td><input type="date" class="form-control tgl_lahir_jamaah" name="tgl_lahir_jamaah[]"></td>
									<td><input type="number" class="form-control no_telepon_jamaah" name="no_telepon_jamaah[]"></td>
									<td><input type="text" class="form-control no_jamaah" name="no_jamaah[]"></td>
								</tr>
								</tbody>
							</table>
						</form>
					</div>
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
<!-- DETAIL KELUARGA -->
<div id="modal_detail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg" style="width: 100%;">
    <div class="modal-content">
      <div class="modal-header noPadding">
        <button type="button" class="close" onclick="hideModal('tutupDetail')">×</button>
        <h4 class="modal-title title_detail">Modal Content is Responsive</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12 noPadding">
            <div class="table-responsive" style="margin-top: 20px;">
              <table class="table">
                <thead>
                <tr>
                  <th>Nama</th><th>Jenis Kelamin</th><th>Pekerjaan</th><th>Pendidikan</th>
                  <th>Status</th><th>Tanggal Lahir</th><th>Alamat</th><th>No Telp</th><th>No Unik</th>
                </tr>
                </thead>
                <tbody id="list_detail"></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var url 			= "<?=base_url('bo/')?>"      //** url assets **//
  var img 			= "<?=base_url('assets/')?>"  //** url images **//
  var form      = $("#form_input"), form_modal= $("#modal_form")
  var notif     = $("#pesan"), btn_tambah= $("#btn-tambah"), btn_update= $("#btn-update")
  var id        = $(".id_jamaah"), nama = $('.nama_jamaah'), alamat = $('.alamat_jamaah'), no_telp = $(".no_telepon_jamaah")
  var no_uniq   = $('.no_jamaah'), tgl  = $('.tgl_lahir_jamaah'), pekerjaan = $('.pekerjaan_jamaah');
  var pendidikan= $('.pendidikan_jamaah'),stat_jam  = $('.status_jamaah'), jen_kel   = $('.jenis_kelamin_jamaah')
  
  var nama_arr  = [],alamat_arr=[],no_arr=[],tgl_arr=[],pekerjaan_arr=[],pendidikan_arr=[],status_arr=[],jen_kel_arr=[],no_telp_arr=[];
  
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
      url       : url+"jamaah/get/"+page,
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
  //************* SHOW MODAL **********************//
  function showModal(param){
    if(param == "add"){
      loader();
      setTimeout(function() {
        $('.first-loader').remove()
        $("#control-row").show()
        form_modal.modal("show")
        form[0].reset()
        btn_tambah.show()
        btn_update.hide()
        no_jamaah()
      },500)
    }else{
      $("#control-row").hide();
      form_modal.modal("show")
      form[0].reset()
      btn_tambah.hide()
      btn_update.show();
      $.ajax({
        url     		: url+"jamaah/get_param",
        type    		: "POST",
        dataType		: "JSON",
        data    		: "id_jamaah="+param,
        beforeSend	: function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg""></div>')},
        complete		: function() {$('.first-loader').remove()},
        success : function(data){
          var obj = data.get_id;
          id.val(obj.id_jamaah);
          nama.val(obj.nama_jamaah);
          alamat.val(obj.alamat_jamaah);
          pekerjaan.val(obj.pekerjaan_jamaah);
          pendidikan.val(obj.pendidikan_jamaah);
          stat_jam.val(obj.status_jamaah);
          jen_kel.val(obj.jenis_kelamin_jamaah);
          tgl.val(obj.tgl_lahir_jamaah);
          no_uniq.val(obj.no_jamaah);
          no_telp.val(obj.no_telepon_jamaah);
        },error: function (jqXHR, textStatus, errorThrown){alert('Error');}
      })
    }
  }
  //************* HIDE MODAL **********************//
  function hideModal(param){
    if(param == "tutupForm"){
      loader()
      setTimeout(function() {
        $('.first-loader').remove()
        $(".duplikatTr").remove();
        form_modal.modal("hide")
        form[0].reset()
        notif.html("")
        no_jamaah();
      },500)
    }else{
      loader()
      setTimeout(function() {
        $('.first-loader').remove()
        $("#modal_detail").modal("hide")
      },500)
    }
  }
  //************* ADD ROW *************************//
  $("body").on('click', '#hps_row', function (e) {
    e.preventDefault();
    if($("#table_details tr:last-child").attr('id') != 'idtr'){
      $("#table_details tr:last-child").remove();
    }
  });
  var count = 1;
  $('#add_row').click(function(){
    count = count + 1;
    var html = "<tr id='row"+count+"' class='duplikatTr'>";
    html += "<td><input type='text' class='form-control nama_jamaah' name='nama_jamaah[]'></td>";
    html += "<td><textarea class='form-control alamat_jamaah' name='alamat_jamaah[]'></textarea></td>";
    html += "<td><input type='text' class='form-control pekerjaan_jamaah' name='pekerjaan_jamaah[]'></td>";
    html +=
      "<td>"+
      "<select name='pendidikan_jamaah[]' class='form-control pendidikan_jamaah'>"+
      "<option value='Belum-Sekolah'>Belum-Sekolah</option>"+
      "<option value='SD'>SD</option>"+
      "<option value='SMP'>SMP</option>"+
      "<option value='SMA / SMK'>SMA / SMK</option>"+
      "<option value='D-I'>D-I</option>"+
      "<option value='D-II'>D-II</option>"+
      "<option value='D-III'>D-III</option>"+
      "<option value='D-IV'>D-IV</option>"+
      "<option value='S1'>S1</option>"+
      "<option value='S2'>S2</option>"+
      "<option value='S3'>S3</option>"+
      "</select>"+
      "</td>";
    html +=
      "<td>"+
      "<select name='status_jamaah[]' class='form-control status_jamaah'>"+
      "<option value='Kepala-Keluarga'>Kepala Keluarga</option>"+
      "<option value='Istri'>Istri</option>"+
      "<option value='Anak'>Anak</option>"+
      "</select>"+
      "</td>";
    html +=
      "<td>"+
      "<select name='jenis_kelamin_jamaah[]' class='form-control jenis_kelamin_jamaah'>"+
      "<option value='Laki-Laki'>Laki-Laki</option>"+
      "<option value='Perempuan'>Perempuan</option>"+
      "</select>"+
      "</td>";
    html += "<td><input type='date' class='form-control tgl_lahir_jamaah' name='tgl_lahir_jamaah[]'></td>";
    html += "<td><input type='number' class='form-control no_telepon_jamaah' name='no_telepon_jamaah[]'></td>";
    html += "<td><input type='text' class='form-control no_jamaah' name='no_jamaah[]' value='"+no_jamaah()+"'></td>";
    html += "</tr>";
    $('#table').append(html);
  });
  //************* ON OFF NO JAMAAH ****************//
  var on = $("#on"), off = $("#off")
  on.click(function(e) {
    e.preventDefault();
    on.hide();
    off.show();
    no_uniq.prop("readonly",false);
  });
  off.click(function(e) {
    e.preventDefault();
    on.show();
    off.hide();
    no_uniq.prop("readonly",true);
  });

  //************* GET NO JAMAAH *******************//
  function no_jamaah(){
    $.ajax({
      url			: url+"jamaah/get_param",
      type		: "POST",
      dataType: "JSON",
      success	: function(data){
        $(".no_jamaah").val(data.no_jamaah)
      }
    });
  }
  //************* TAMBAH **************************//
  btn_tambah.click(function(){
    if(validasi() == false){
      validasi()
    }else {
      $.ajax({
        url       : url + "jamaah/tambah",
        method    : "POST",
        dataType  : "JSON",
        data      : form.serialize(),
        beforeSend: function(){$('body').append('<div class="first-loader"><img src="' + img + 'spin.svg"></div>')},
        complete  : function(){$('.first-loader').remove()},
        success   : function(data){
          notif.html(data.pesan);
          if (data.pesan == "") {
            form[0].reset();
            form_modal.modal("hide");
            $(".duplikatTr").remove()
            swal("Kerja Bagus!", "Data Berhasil Disimpan!", "success");
            no_jamaah()
            load_data($("#page").val());
          }
        }, error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.responseText)
        }
      })
    }
  })
  //************* UPDATE **************************//
  btn_update.click(function(){
    if(validasi() == false){
      validasi()
    }else {
      $.ajax({
        url       : url + "jamaah/edit",
        method    : "POST",
        dataType  : "JSON",
        data      : form.serialize(),
        beforeSend: function(){$('body').append('<div class="first-loader"><img src="' + img + 'spin.svg"></div>')},
        complete  : function(){$('.first-loader').remove()},
        success   : function(data){
          notif.html(data.pesan);
          if (data.pesan == "") {
            form[0].reset();
            form_modal.modal("hide");
            swal("Kerja Bagus!", "Data Berhasil Disimpan!", "success");
            $(".duplikatTr").remove()
            no_jamaah()
            load_data($("#page").val());
          }
        }, error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.responseText)
        }
      })
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
          url : url+"jamaah/hapus",
          type: "POST",
          dataType: "JSON",
          data:"id_jamaah="+param,
          success: function(data){
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
  //************* DETAIL **************************//
  function detail(){
    var kk = $(".kepala_keluarga").val()
    if(kk!="") {
      var param = {"kepala_keluarga": kk}
      $.ajax({
        url       : url + "jamaah/get_param",
        type      : "POST",
        dataType  : "JSON",
        data      : param,
        beforeSend: function(){$('body').append('<div class="first-loader"><img src="' + img + 'spin.svg"></div>')},
        complete  : function(){$('.first-loader').remove()},
        success   : function(data){
          moment.locale("id")
          var obj = data.detail_kk, title = data.detail_title, html = ""
          if(obj.length > 0) {
            $("#modal_detail").modal("show")
            $(".title_detail").html("Keluarga " + title.nama_jamaah + "( "+title.no_jamaah+ ")")
            for (var i = 0; i < obj.length; i++) {
              html +=
                "<tr>" +
                "<td>" + obj[i].nama_jamaah + "</td>" +
                "<td>" + obj[i].jenis_kelamin_jamaah + "</td>" +
                "<td>" + obj[i].pekerjaan_jamaah + "</td>" +
                "<td>" + obj[i].pendidikan_jamaah + "</td>" +
                "<td>" + obj[i].status_jamaah + "</td>" +
                "<td>" + moment(obj[i].tgl_lahir_jamaah).format("dddd, Do MMMM YYYY") + "</td>" +
                "<td>" + obj[i].alamat_jamaah + "</td>" +
                "<td>" + obj[i].no_telepon_jamaah + "</td>" +
                "<td>" + obj[i].no_jamaah + "</td>" +
                "</tr>";
            }
            $("#list_detail").html(html)
          }else{
            swal("Opps Data Tidak Ada!")
          }
        }
      })
    }else{
      $(".kepala_keluarga").focus();
    }
  }
  
  function validasi(){
    nama.each(function(){nama_arr.push($(this).val())});
    alamat.each(function(){alamat_arr.push($(this).val())});
    no_uniq.each(function(){no_arr.push($(this).val())});
    tgl.each(function(){tgl_arr.push($(this).val())});
    pekerjaan.each(function(){pekerjaan_arr.push($(this).val())});
    pendidikan.each(function(){pendidikan_arr.push($(this).val())});
    stat_jam.each(function(){status_arr.push($(this).val())});
    jen_kel.each(function(){jen_kel_arr.push($(this).val())});
    no_telp.each(function(){no_telp_arr.push($(this).val())});
  
    var valid_nama 			= $('[name="nama_jamaah[]"]')
    var valid_alamat 		= $('[name="alamat_jamaah[]"]')
    var valid_pekerjaan = $('[name="pekerjaan_jamaah[]"]')
    var valid_tgl_lahir = $('[name="tgl_lahir_jamaah[]"]')
  
    for(i=0; i<valid_nama.length;i++){
      if (valid_nama[i].value == "") {
        notif.html("Silahkan Isi Field Nama")
        nama.focus()
        return false
      }else if(valid_alamat[i].value == ""){
        notif.html("Silahkan Isi Field Alamat")
        alamat.focus()
        return false
      }else if(valid_pekerjaan[i].value == ""){
        notif.html("Silahkan Isi Field Pekerjaan")
        pekerjaan.focus()
        return false
      }else if(valid_tgl_lahir[i].value == ""){
        notif.html("Silahkan Isi Field Tanggal Lahir")
        tgl.focus()
        return false
      }
    }
  }
</script>