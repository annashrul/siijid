<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="col-sm-12" id="printStruktur">
        <style>
          #ketua{border:1px solid blue;height:auto;text-align: center;padding:10px 10px 10px 10px;margin-bottom: 10px;}
          #box_sekretaris{margin-bottom: 10px;}
          #sekretaris{border:1px solid green;text-align: center;padding: 10px}
          #box_bendahara{margin-bottom: 10px;}
          #bendahara{border:1px solid green;text-align: center;padding: 10px}
          #anggota{border:1px solid darkred;text-align: center;padding: 10px}
        </style>
        <div class="col-sm-4 col-sm-offset-4" id="ketua">
          Ketua DKM <br> Andri Sani Awaludin
        </div>
        <div class="col-sm-6" id="box_sekretaris">
          <div class="col-sm-6 col-sm-offset-6" id="sekretaris">
            Sekretaris<br> Andri Sani Awaludin
          </div>
        </div>
        <div class="col-sm-6" id="box_bendahara">
          <div class="col-sm-6" id="bendahara">bendahara<br> Andri Sani Awaludin</div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="col-sm-2" id="anggota">Anggota<br> Andri Sani Awaludin</div>
              <div class="col-sm-2" id="anggota">Anggota<br> Andri Sani Awaludin</div>
              <div class="col-sm-2" id="anggota">Anggota<br> Andri Sani Awaludin</div>
              <div class="col-sm-2" id="anggota">Anggota<br> Andri Sani Awaludin</div>
              <div class="col-sm-2" id="anggota">Anggota<br> Andri Sani Awaludin</div>
              <div class="col-sm-2" id="anggota">Anggota<br> Andri Sani Awaludin</div>
            </div>
          </div>
  
        </div>
      </div>
      
      <button class="btn btn-primary" id="btnPrintStruktur"> <i class="fa fa-print"></i> </button>
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
            <button class="btn btn-primary" onclick="broadcast()">Broadcast</button>
            <button class="btn btn-primary" onclick="perorang()">Perorang</button>
            <button class="btn btn-primary" onclick="email()">Email</button>
          </div>
        </div>
      </div>
      <div class="panel-body" id="Gateway">
        <div class="row">
          <div class="col-md-12" id="cari_kontak" style="display: none">
            <div class="input-group">
                <span class="input-group-btn">
                  <button type="button" class="btn waves-effect waves-light btn-primary"><i class="fa fa-search"></i></button>
                </span>
              <input
                type="text" name="nama_kontak" class="form-control pull-right search" id="cari"
                placeholder="Cari Kontak">
            </div>
          </div>
          <div class="col-md-12" id="result_kontak">
          
          </div>
            <form action="<?=base_url('bo/debug/send')?>" method="post">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 noPadding">
                <p class="text-center" id="pesan" style="color: red;"></p>
                
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12" id="No_HP" style="display: none;">
                
                </div>
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12" id="param">
                  <div class="form-group">
                    <label for="field-1" class="control-label">Nama</label>
                    <select name="option_send" id="" class="form-control option_send">
                      <option value="">Pilih Pengiriman</option>
      
                    </select>
                  </div>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label for="field-1" class="control-label">Dummy</label>
                    <textarea name="" class="form-control dummy"></textarea>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 noPadding" style="display: none;">
                <?php foreach ($filter as $row):?>
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label for="field-1" class="control-label">Pesan</label>
                    <textarea name="pesan[]" class="form-control pesan"></textarea>
                  </div>
                </div>
                <?php endforeach; ?>
                
              </div>
              <div class="col-md-12 col-lg-12 col-sm-6 col-xs-12">
                <div class="form-group">
                  <input type="submit" name="submit" value="Submit" class="form-control"/>
                </div>
              </div>
            </form>
        </div>
      </div>
      <div class="panel-body" id="Email" style="display: none;">
        <div class="row">
          <p class="text-center" id="pesan"></p>
          <form id="form_input">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 noPadding">
              <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label for="field-1" class="control-label">Email</label>
                  <input type="email" class="form-control email" name="email" placeholder="Masukan Alamat Email">
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
<script>
  $(document).ready(function() {
    //FUNCTION PRINT
    document.getElementById("btnPrintStruktur").onclick = function () {
      loader();
      setTimeout(function () {
        $('.first-loader').remove();
        printElement(
          document.getElementById("printStruktur"),
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
  })
</script>
<script type="text/javascript">
  get_api();
  function get_api(){
    $.ajax({
      url: "https://masjid.anasrulysf.com/api/get_api/get",
      type: "POST",
      dataType: "JSON",
      success: function (data) {
        console.log(data);
//        var obj = data.admin;
//        var obj = data.admin;
//        var html = "";
//        for(var i=0;i<obj.length;i++){
//          html += "<p>"+obj[i].nama_pengurus+"</p>";
//        }
//        console.log(html);
      }
    });
  }
  function pilih(param){
    $.ajax({
      url: "<?=base_url('bo/debug/get_param')?>",
      type: "POST",
      dataType: "JSON",
      data: "id_jamaah="+param,
      success: function (data) {
        var obj = data.get_personal;
        $("#result_kontak").hide();
        $(".no_hp").val(obj.no_telepon_jamaah);
      }
    });
  }
  
  $("#cari").keyup(function () {
    var option = $('[name="nama_kontak"]');
    var param = {
      "nama_kontak"  : option.val(),
    }
    $.ajax({
      url : "<?=base_url('bo/debug/get_param')?>",
      type : "POST",
      dataType : "JSON",
      data : param,
      success:function(data){
       
        var obj = data.get_jamaah;
        var html = "";
        if(obj.length > 0 && option.val() != "") {
          $("#result_kontak").show();
          for (var i = 0; i < obj.length; i++) {
            html +=
            '<div class="col-md-4 noPadding" onclick="pilih('+obj[i].id_jamaah+')" style="border:1px solid black;cursor: pointer;">' +
            "<div class='col-md-6'>" +
            "<p class='text-left'>" + obj[i].nama_jamaah + "</p>" +
            "</div>" +
            "<div class='col-md-6'>" +
            "<p class='text-right'>" + obj[i].no_telepon_jamaah + "</p>" +
            "</div>" +
            "</div>";
          }
          $("#result_kontak").html(html);
        }else{
          $("#result_kontak").hide();
        }
      }
    });
  });
  function email() {
    $("#Gateway").hide();
    $("#Email").show();
  }
  function broadcast(){
    $("#Email").hide();
    $("#Gateway").show();
    $("#cari_kontak").hide();
    $("#param").show();
    var html = "";
    html+='<option value="">Pilih Pengiriman</option>';
    html+='<option value="Kepala-Keluarga">Kepala-Keluarga</option>';
    html+='<option value="Pengurus">Pengurus</option>';
    $(".option_send").html(html);
  }
  function perorang(){
    $("#Email").hide();
    $("#Gateway").show();
    $("#cari_kontak").show();
    $("#param").hide();
    $("#No_HP").show();
    var html = "";
    html +=
    '<div class="form-group">'+
      '<label for="field-1" class="control-label">No Hp</label>'+
      '<input type="number" name="no_hp[]" class="form-control no_hp">'+
    '</div>';
    
    
    $("#No_HP").html(html);
    
  }

  var img = "<?=base_url('assets/')?>"    //** url images **//
  $(document).ready(function() {
    $(".dummy").keyup(function () {
      var dum = $(".dummy").val();
      $(".pesan").val(dum);
    });
  });
  
  $(".option_send").change(function(){
    if(this.value == "Perorangan"){
      $("#No_HP").show();
      var html ="";
      html +=
        '<div class="form-group">'+
      '<label for="field-1" class="control-label">No Hp</label>'+
      '<input type="number" name="no_hp[]" class="form-control no_hp">'+
      '</div>';
			$("#No_HP").append(html);
    }else if(this.value == "Kepala-Keluarga"){
      $("#No_HP").hide()
      var option = $('[name="option_send"]');
      var param = {
        "option_send"  : option.val(),
      }
      $.ajax({
        url       : "<?=base_url('bo/debug/get_param')?>",
        type      : "POST",
        dataType  : "JSON",
        data      : param,
        success : function(data){
          $("#Pesan").show();
          var obj = data.cek;
          console.log(obj);
          var html = "";
          for(var i=0; i<obj.length;i++){
              console.log(obj.NO)
            html +=
              '<div class="form-group">'+
            '<label for="field-1" class="control-label">No Hp</label>'+
            '<input type="number" name="no_hp[]" class="form-control no_hp" value="'+obj[i].no_telepon_jamaah+'">'+
              '</div>';
          }
          $("#No_HP").html(html)
        }
      })
    }else{
      $("#No_HP").hide()
    }
  });

  $(document).ready(function() {
    $("#btn-tambah").click(function () {
      if($(".email").val()==""){
        $(".email").focus();
      }else {
        $.ajax({
          url: "<?=base_url('bo/send_email')?>",
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
            $("#pesan").html(data.pesan)
            if (data.pesan == "") {
              $("#form_input")[0].reset()
              swal("Kerja Bagus!", "Data Berhasil Dikirim!", "success");
            } else {
              swal("Pesan Tidak Terkirim");
            }
          }, error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.responseText)
          }
        });
      }
    })
  });
  
  $.ajax({
    url : "<?=base_url('bo/kas/get_param')?>",
    type: "POST",
    dataType : "JSON",
    success : function(data){
      console.log(data.total_per_tahun);
    }
  });
  
</script>