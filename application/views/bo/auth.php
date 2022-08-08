
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
	<meta name="author" content="Coderthemes">
	<title><?=$title?></title>
	<link rel="shortcut icon" href="<?=base_url().'assets/bo/'?>images/favicon_1.ico">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,300,700">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
	<!-- Base Css Files -->
	<link href="<?=base_url().'assets/bo/'?>css/bootstrap.min.css" rel="stylesheet" />
	<!-- Font Icons -->
	<link href="<?=base_url().'assets/bo/'?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="<?=base_url().'assets/bo/'?>assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
	<link href="<?=base_url().'assets/bo/'?>css/material-design-iconic-font.min.css" rel="stylesheet">
	<!-- animate css -->
	<link href="<?=base_url().'assets/bo/'?>css/animate.css" rel="stylesheet" />
	<!-- Waves-effect -->
	<link href="<?=base_url().'assets/bo/'?>css/waves-effect.css" rel="stylesheet">
	<!-- Custom Files -->
	<link href="<?=base_url().'assets/bo/'?>css/helper.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url().'assets/bo/'?>css/style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/sweetalert2/1.3.3/sweetalert2.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/sweetalert2/0.4.5/sweetalert2.css">
	<script src="https://cdn.jsdelivr.net/sweetalert2/1.3.3/sweetalert2.min.js" type="text/javascript" ></script>
	<script src="<?=base_url().'assets/bo/'?>js/modernizr.min.js" type="text/javascript" ></script>

</head>
<style>
	body{font-family: 'Ubuntu Condensed', sans-serif;}
	h3{font-family: 'Ubuntu Condensed', sans-serif;color:white;}
	.alert{border-radius: 0px;}
	.alert-danger{background-color:red!important;color:white!important;}
	.form-control:focus{border:1px solid #0072ff;}
	.first-loader {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		z-index: 1050;
		background: rgba(168, 168, 168, .5)
	}
	.first-loader img {
		position: absolute;
		top: 50%;
		left: 50%;
		-webkit-transform: translate(-50%, -50%);
		-ms-transform: translate(-50%, -50%);
		transform: translate(-50%, -50%);
		width: 60px;
		height: 60px
	}
</style>
<body>
<div class="wrapper-page">
	<div class="panel panel-color panel-primary panel-pages">
		<div class="panel-heading">
			<h3 class="text-center">MASJID GBI RW 08</h3>
		</div>
		<div class="panel-body">
		 	<form id="logForm">
				<p class="text-center" id="notif" style="color:red;"></p>
				<hr style="display:none;" id="garisLogin">
        <div class="form-group" id="username-sukses">
					<input class="form-control input-lg " type="text" name="username" id="username" placeholder="Masukan Username Anda">
				</div>
        <div class="form-group">
          <div class="input-group">
            <input class="form-control input-lg " type="password" name="password" id="password"  placeholder="Masukan Password Anda">
            <span class="input-group-addon" onclick="show_pass()"><i class="fa cek fa-eye" id="rplc"></i></span>
          </div>
        </div>
      </form>
      <div class="col-xs-6 text-left" style="padding: 0px 0px 0px 0px;">
        <div class="form-group ">
          <button class="btn btn-primary btn-md w-md waves-effect waves-light" type="submit" id="login">Log In</button>
        </div>
      </div>
      <div class="col-xs-6 text-right" style="padding: 0px 0px 0px 0px;">
        <div class="form-group ">
          <div class="checkbox checkbox-primary">
            <a href="#" onclick="modal('show')"><i class="fa fa-lock m-r-5"></i>
              Lupa Password ?
            </a>
          </div>
        </div>
      </div>
		</div>
	</div>
</div>
<div id="modal_form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header noPadding">
        <button type="button" class="close" onclick="modal('hide')">×</button>
        <h4 class="modal-title title-form">Modal Content is Responsive</h4>
      </div>
      <div class="modal-body">
        <form id="form_input">
          <div class="form-group">
            <label for="field-1" class="control-label">Username</label>
            <input type="text" name="username" class="form-control username" placeholder="Masukan Username Anda">
          </div>
          <p class="text-center" id="box_notif"></p>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary waves-effect" id="forgot_passsword">Kirim</button>
      </div>
    </div>
  </div>
</div>

<!--REGISTRASI-->
<script>
  var resizefunc = [];
</script>
<script src="<?=base_url().'assets/bo/'?>js/jquery.min.js"></script>
<script src="<?=base_url().'assets/bo/'?>js/bootstrap.min.js"></script>
<script src="<?=base_url().'assets/bo/'?>js/waves.js"></script>
<script src="<?=base_url().'assets/bo/'?>js/wow.min.js"></script>
<script src="<?=base_url().'assets/bo/'?>js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?=base_url().'assets/bo/'?>js/jquery.scrollTo.min.js"></script>
<script src="<?=base_url().'assets/bo/'?>assets/jquery-detectmobile/detect.js"></script>
<script src="<?=base_url().'assets/bo/'?>assets/fastclick/fastclick.js"></script>
<script src="<?=base_url().'assets/bo/'?>assets/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="<?=base_url().'assets/bo/'?>assets/jquery-blockui/jquery.blockUI.js"></script>
<!-- CUSTOM JS -->
<script src="<?=base_url().'assets/bo/'?>js/jquery.app.js"></script>
<script type="text/javascript" charset="utf-8" async defer>
    $(document).ready(function(){
        $("#username").focus();
    });
    function modal(param) {
      if(param == "show"){
        $("#modal_form").modal("show");
        $("#form_input")[0].reset();
        $(".title-form").html("Lupa Password ?");
	      $("#box_notif").html("");
      }else{
	      $("#modal_form").modal("hide");
      }
    }
    $(document).ready(function() {
	    $("#forgot_passsword").click(function () {
		    var username = $(".username");
		    if(username.val() == ""){
		    	username.focus();
            }else{
                $.ajax({
                    url   : "<?=base_url('auth/forgot_password')?>",
                    type  : "POST",
                    dataType  : "JSON",
                    data: $("#form_input").serialize(),
                    success   : function(data){
                        console.log(data);
                        if(data != null) {
                            var password = data.password;
                            $("#box_notif").html("Password Anda : <b>"+ password+"</b>");
                        }else{
                            $("#box_notif").html("Username Tidak Terdaftar");
                        }

                    }
                });
            }


	    });
    });

  function show_pass() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
	    $(".cek").removeClass("fa-eye").addClass("fa-eye-slash");
    } else {
      x.type = "password";
	    $(".cek").removeClass("fa-eye-slash").addClass("fa-eye");
    }
  }
  $(document).ready(function(){
    $("#username").keyup(function(){
      var username  = $("#username").val();
      $.ajax({
        type		: "POST",
        url			: "<?=base_url('auth/isUsernameExists')?>",
        data		: "username=" + username,
        success	: function(data){
          if(data==0){
            $("#notif").html('Username tidak tidak terdaftar');
            $("#username-sukses").addClass("has-error")
            $("#username-sukses").removeClass("has-success")
          }else{
            $("#notif").html('');
            $("#username-sukses").removeClass("has-error")
//            $("#username-sukses").addClass("has-success")
            $("#username-sukses").removeClass("has-success")
          }
        }
      });
    })
  });
//  loader();
    function loader(){
      $('body').append('<div class="first-loader"><img src="<?=base_url() . '/assets/spin.svg'?>"></div>');
    }
  $("#login").click(function(){
  	var username = $("#username"); var password = $("#password");
  	if(username.val() == ""){
  		username.focus();
    }else if(password.val() == ""){
        password.focus();
    }else{
      $.ajax({
        url: "<?=base_url('auth/login')?>",
        type: "POST",
        dataType: "JSON",
        data: $("#logForm").serialize(),
        beforeSend: function () {
          $('body').append('<div class="first-loader"><img src="<?=base_url() . '/assets/spin.svg'?>"></div>')
        },
        complete: function () {$('.first-loader').remove()},
        success: function (response) {
          $("#notif").html(response.error);
          if (response.error == true) {
            $("#notif").html(response.message);
          } else {
              loader()
              setTimeout(function() {
                  $('.first-loader').remove()
              },500)
              window.location.replace("<?=base_url('bo/dashboard')?>");

          }
        }
      });
    }
  });

    var Base64={
	    _keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
	    encode:function(e){
		    var t="",n,r,i,s,o,u,a, f=0
		    e=Base64._utf8_encode(e);
		    while(f<e.length){
			    n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);
			    s=n>>2;
			    o=(n&3)<<4|r>>4;
			    u=(r&15)<<2|i>>6;
			    a=i&63;
			    if(isNaN(r)){
				    u=a=64
			    }else if(isNaN(i)){
				    a=64
			    }
			    t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)
		    }
		    return t
	    },decode:function(e){
		    var t="",n,r,i,s,o,u,a,f=0;
		    e=e.replace(/[^A-Za-z0-9+/=]/g,"");
		    while(f<e.length){
			    s=this._keyStr.indexOf(e.charAt(f++));
			    o=this._keyStr.indexOf(e.charAt(f++));
			    u=this._keyStr.indexOf(e.charAt(f++));
			    a=this._keyStr.indexOf(e.charAt(f++));
			    n=s<<2|o>>4;
			    r=(o&15)<<4|u>>2;i=(u&3)<<6|a;
			    t=t+String.fromCharCode(n);
			    if(u!=64){
				    t=t+String.fromCharCode(r)
			    }
			    if(a!=64){
				    t=t+String.fromCharCode(i)
			    }
		    }
		    t=Base64._utf8_decode(t);
		    return t
	    },_utf8_encode:function(e){
		    e=e.replace(/rn/g,"n");
		    var t="";
		    for(var n=0;n<e.length;n++){
			    var r=e.charCodeAt(n);
			    if(r<128){
				    t+=String.fromCharCode(r)
			    }else if(r>127&&r<2048){
				    t+=String.fromCharCode(r>>6|192);
				    t+=String.fromCharCode(r&63|128)
			    }else{
				    t+=String.fromCharCode(r>>12|224);
				    t+=String.fromCharCode(r>>6&63|128);
				    t+=String.fromCharCode(r&63|128)
			    }
		    }
		    return t
	    },_utf8_decode:function(e){
		    var t="";var n=0;var r=c1=c2=0;
		    while(n<e.length){
			    r=e.charCodeAt(n);
			    if(r<128){
				    t+=String.fromCharCode(r);n++
			    }else if(r>191&&r<224){
				    c2=e.charCodeAt(n+1);
				    t+=String.fromCharCode((r&31)<<6|c2&63);
				    n+=2
			    }else{
				    c2=e.charCodeAt(n+1);
				    c3=e.charCodeAt(n+2);
				    t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3
			    }
		    }
		    return t
	    }
    }
</script>
</body>
</html>