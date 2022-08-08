<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">

          <form id="form_input">
            <p id="pesan" class="text-center" style="color: red;"></p>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 noPadding">
              <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label for="field-1" class="control-label">No Handphone</label>
                  <input type="number" class="form-control no_hp" name="no_hp" placeholder="Masukan No Handphone Yang Dituju">
                </div>
              </div>
              <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label for="field-1" class="control-label">Pesan</label>
                  <textarea name="pesan" id="" cols="30" rows="10" class="form-control pesan"></textarea>
                </div>
              </div>
            </div>
          </form>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 noPadding">
            <div class="col-md-12 col-lg-12 col-sm-6 col-xs-12">
              <div class="form-group">
                <button type="button" class="btn btn-primary waves-effect" id="btn-tambah">Simpan</button>
              </div>
            </div>
          </div>
					
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
  var img = "<?=base_url('assets/')?>"    //** url images **//
	$(".option_send").change(function(){
	  if(this.value == "Perorangan"){
	    $("#No_HP").show()
//			$.ajax({
//				url : "<?//=base_url('bo/undangan/get_param')?>//",
//				type: "POST",
//				dataType : ""
//			})
		}else if(this.value == "Kepala-Keluarga"){
      $("#No_HP").hide()
		}else{
      $("#No_HP").hide()
		}
	})
  var no = $(".no_hp"), pesan = $(".pesan");
  $(document).ready(function() {
    $("#btn-tambah").click(function () {
      if(no.val()==""){
        no.focus();
      }else {
        $.ajax({
          url: "<?=base_url('bo/send')?>",
          type: "POST",
          data: $("#form_input").serialize(),
          dataType: "JSON",
          beforeSend: function () {
            $('body').append('<div class="first-loader"><img src="' + img + 'spin.svg""></div>')
          },
          complete: function () {
            $('.first-loader').remove()
          },
          success: function (data) {
            console.log(data.sukses);
//            $("#pesan").html(data.pesan)
            if (data.status == true) {
              $("#form_input")[0].reset()
              $("#pesan").html(data.sukses)
              swal("Kerja Bagus!", "Data Berhasil Disimpan!", "success");
            } else {
              $("#pesan").html(data.gagal)
              swal("Pesan Tidak Terkirim");
            }
          }, error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.responseText)
          }
        });
      }
    })
  });
</script>