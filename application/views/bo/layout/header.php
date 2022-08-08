<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">
    <link rel="shortcut icon" href="<?=base_url('assets/logo-masjid.png')?>">
    <title id="titleLuhur">MasjiApp | <?=$user->nama_masjid?></title>
    <!-- Bootstrap 4 -->
    <!--    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" id="bootstrap-css">-->
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- <link href="https://fonts.googleapis.com/css?family=Basic|Concert+One" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,300,700">

    <!-- Base Css Files -->
    <link href="<?=base_url().'assets/assets/'?>css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Icons -->
    <link href="<?=base_url().'assets/assets/'?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?=base_url().'assets/assets/'?>assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
    <link href="<?=base_url().'assets/assets/'?>css/material-design-iconic-font.min.css" rel="stylesheet" />
    <!-- animate css -->
    <link href="<?=base_url().'assets/assets/'?>css/animate.css" rel="stylesheet" />
    <!-- Waves-effect -->
    <link href="<?=base_url().'assets/assets/'?>css/waves-effect.css" rel="stylesheet" />
    <!-- DataTables -->
    <link href="<?=base_url().'assets/assets/'?>assets/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive-table -->
    <link href="<?=base_url().'assets/assets/'?>assets/responsive-table/rwd-table.min.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- sweet alerts -->
    <link href="<?=base_url().'assets/assets/'?>assets/sweet-alert/sweet-alert.min.css" rel="stylesheet" />
    <!-- Plugins css-->
    <link href="<?=base_url().'assets/assets/'?>assets/tagsinput/jquery.tagsinput.css" rel="stylesheet" />
    <link href="<?=base_url().'assets/assets/'?>assets/toggles/toggles.css" rel="stylesheet" />
    <link href="<?=base_url().'assets/assets/'?>assets/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
    <link href="<?=base_url().'assets/assets/'?>assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" />
    <link href="<?=base_url().'assets/assets/'?>assets/colorpicker/colorpicker.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url().'assets/assets/'?>assets/jquery-multi-select/multi-select.css"  rel="stylesheet" type="text/css" />
    <link href="<?=base_url().'assets/assets/'?>assets/select2/select2.css" rel="stylesheet" type="text/css" />
    <!-- Custom Files -->
    <link href="<?=base_url().'assets/assets/'?>css/helper.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url().'assets/assets/'?>css/style.css" rel="stylesheet" type="text/css" />

    <!--<link href="<?/*=base_url().'assets/'*/?>css/bootstrap-datetimepicker.css" rel="stylesheet" />-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!--daterangepicker-->
    <link rel="stylesheet" type = "text/css" href="<?=base_url().'assets/assets/'?>assets/daterangepicker/daterangepicker.css" />
    <!--<script src="<?/*=base_url().'assets/'*/?>assets/daterangepicker/moment.js"></script>
    <script src="<?/*=base_url().'assets/'*/?>assets/daterangepicker/daterangepicker.js"></script>-->

    <script src="<?=base_url().'assets/assets/'?>js/jquery.min.js"></script>
    <script src="<?=base_url().'assets/assets/'?>js/bootstrap.min.js"></script>
    <script src="<?=base_url().'assets/assets/'?>js/modernizr.min.js"></script>

    <script src="<?=base_url().'assets/assets/'?>assets/jQuery-autocomplete/jquery.autocomplete.js" type="text/javascript"></script>
    <!--<link rel="stylesheet" type = "text/css" href="<?/*=base_url().'assets/'*/?>assets/auto-complete/jquery.autocomplete.css" />
	<script src="<?/*=base_url().'assets/'*/?>assets/auto-complete/jquery.autocomplete.js" type="text/javascript"></script>-->

    <!--Daterangepicker-->
    <script src="<?=base_url().'assets/assets/'?>assets/daterangepicker/moment.js" type="text/javascript"></script>
    <script src="<?=base_url().'assets/assets/'?>assets/daterangepicker/daterangepicker.js" type="text/javascript"></script>

    <!--Chart Js-->
    <script src="<?=base_url().'assets/assets/'?>assets/chartjs/Chart.js"></script>

    <link href="<?=base_url().'assets/assets/'?>assets/notifications/notification.css" rel="stylesheet" />

    <!-- Form Validation -->
    <script type="text/javascript" src="<?=base_url().'assets/assets/'?>assets/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?=base_url().'assets/assets/'?>assets/jquery-validation/additional-methods.min.js"></script>

    <!--Barcode-->
    <script src="<?=base_url().'assets/assets/js/'?>JsBarcode_all.js"></script>
    <script src="<?=base_url().'assets/plugin/jquery.price_format.min.js'?>"></script>

    <!-- jQuery  -->

</head>
<style>
    .pagination-fa {display: none;}
    
    html{font-family: 'Ubuntu Condensed', sans-serif;}
    body{
        font-family: 'Ubuntu Condensed', sans-serif;
        /*font-family: 'Concert One', cursive!important;*/
        /*font-family: 'Basic', sans-serif!important;*/
        /*font-size: 14px;*/
        /*font-weight: bold;*/
    }
    .text-custome{color:#0072ff;}
    h1,h2,h3,h4,h5,h6,p{font-family: 'Ubuntu Condensed', sans-serif;}
    .paddingRight{padding:0px 0px 0px 10px;}
    .paddingLeft{padding:0px 10px 0px 0px;}
    .noPadding{padding:0px 0px 0px 0px;}
    .paddingDropdown{padding:10px 10px 10px 10px!important;}
    .displayNone{display: none;}
    /*.btn, .form-control, .alert, .select2{border-radius:0px!important;}*/
    .form-control{border:1px solid #ccc}
    .btn{font-weight: bold;}
    .btn-custome{background: linear-gradient(to right, #00c6ff, #0072ff);color:white!important;}
    .btn-info{background: linear-gradient(to right,#0072ff, #00c6ff );color:white!important;}
    .btn-custome:focus{background: linear-gradient(to right, #00c6ff, #0072ff);color:white!important;}
    .form-control:focus{border:1px solid #0072ff;}
    /*.dropdown-toggle:focus{background: linear-gradient(to right, #00c6ff, #0072ff);color:white!important;}*/
    /*.select2{border-radius: 0px!important;border:1px solid rgba(49, 126, 235, 0.5);}*/
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
    ::-webkit-scrollbar {
        width: 10px;
    }
    
    /* Track */
    ::-webkit-scrollbar-track {
        box-shadow: #1e88e5;
        /*border-radius: 10px;*/
    }
    
    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #1e88e5;
        z-index: 1050;
        /*border-radius: 10px;*/
    }
    
    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #1e88e5;
    }
    
    
    .daterange { position: relative; text-align: center }
    .daterange i {
        position: absolute; bottom: 10px; right: 24px; top: auto; cursor: pointer;
    }
    
    .width-uang {
        width: 95px;
        text-align: right;
    }
    
    .width-diskon {
        width: 50px;
        text-align: center;
    }
    
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }
    
    input[type=number] {
        -moz-appearance:textfield;
    }
    
    .table_check {
        border-collapse:collapse;
    }
    .td_check {
        padding: -8px -8px -8px -8px;
    }
    .label_check {
        display:block;
        margin: -8px;
        padding: 8px 8px 8px 8px;
    }
    
    .datepicker table tr.week:hover{
        background: #eee;
    }
    
    .datepicker table tr.week-active,
    .datepicker table tr.week-active td,
    .datepicker table tr.week-active td:hover,
    .datepicker table tr.week-active.week td,
    .datepicker table tr.week-active.week td:hover,
    .datepicker table tr.week-active.week,
    .datepicker table tr.week-active:hover{
        background-color: #006dcc;
        background-image: -moz-linear-gradient(top, #0088cc, #0044cc);
        background-image: -ms-linear-gradient(top, #0088cc, #0044cc);
        background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#0088cc), to(#0044cc));
        background-image: -webkit-linear-gradient(top, #0088cc, #0044cc);
        background-image: -o-linear-gradient(top, #0088cc, #0044cc);
        background-image: linear-gradient(top, #0088cc, #0044cc);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#0088cc', endColorstr='#0044cc', GradientType=0);
        border-color: #0044cc #0044cc #002a80;
        border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
        filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
        color: #fff;
        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
    }
    .label_colom {
        position:  absolute;
        left: 0;
        top: 0; /* set these so Chrome doesn't return 'auto' from getComputedStyle */
        background: transparent;
        border: 0px  solid rgba(0,0,0,0.5);
    }

    /*Loading*/
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


    
    .autocomplete-suggestions { border: 1px solid #999; background: #fff; cursor: default; overflow: auto; }
    .autocomplete-suggestion { padding: 10px 5px; font-size: 1.2em; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #f0f0f0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399ff; }
    .autocomplete-loading { background:url('<?=base_url().'assets/images/spin.svg'?>') no-repeat right center }
    
    @media only screen and (max-width: 600px) {
        .logo-top-bar {
            margin-left: 300%;
        }
    }

	.pagination > li > a {
		padding: 6px 12px;
		color: #000000;
		font-size: 16px;
		font-weight: bold;
		background-color: #ffffff;
		border: 1px solid #dddddd;
		margin: 0 3px;
	}
	.pagination > .active > a {
		color: #000000;
		font-weight: bold;
		background-color: #ffffff;
		border: 1px solid #dddddd;
	}
	.pagination > li:first-child > a {
		border-bottom-left-radius: 0;
		border-top-left-radius: 0;
	}
	.pagination > li:last-child > a {
		border-bottom-right-radius: 0;
		border-top-right-radius: 0;
	}
	.pagination > li > a:hover,
	.pagination > li > a:focus {
		color: #ffffff;
		background-color: #0073b7 !important;
		border-color: #0073b7 !important;
	}
	.pagination > .active > a,
	.pagination > .active > a:hover,
	.pagination > .active > a:focus {
		color: #ffffff;
		background-color: #0073b7 !important;
		border-color: #0073b7 !important;
		z-index: -0!important;
	}
	.pagination > .disabled > a,
	.pagination > .disabled > a:hover,
	.pagination > .disabled > a:focus {
		color: #777777;
		background-color: #ffffff;
		border-color: #dddddd;

	}
</style>

<!--NodeJS-->
<!--<script src="http://--><?//=$_SERVER['SERVER_NAME']?><!--:3000/socket.io/socket.io.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"></script>-->


<script>

    //var hostname = '<?//=$this->config->item('hostname')?>//';
    //var socket;
    // socket = io.connect("http://<?//=$_SERVER['SERVER_NAME']?>//:3000");
    //// socket = io.connect('http://127.0.0.1:3000');
    //socket.on('new message', function(msg){
    //    //$.Notification.autoHideNotify('info', 'top right', 'New Message From '+msg.user, msg.message);
    //});
    //
    //
    //
    //
    //
    //var page_size=48;
    //var newLine="\n";
    //var titikdua="\u0020:\u0020";
    //var vid='0x04B8';
    //var pid='0x0E11';
</script>

<!--<script type="text/javascript" src="--><?//=base_url().'assets/'?><!--print/print.js"></script>-->


<script>

    function isMoney(field, tipe='-'){
        var value = $("#"+field).val();

        if(value != '' && value != '0' && value != 0){
            var min = value.split("-");
            var dec = value.split(".");
            var str;

            str = hapusmin(dec[0]);

            str = hapuskoma(str).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");

            if(tipe=='-' && min[0]=='' && min[1]!=undefined){
                str = '-' + hapusmin(str);
            }

            if(dec[1]!=undefined){
                str = str + '.' + hapusmin(hapuskoma(dec[1]));
            }

            $("#"+field).val(str);
        } else {
            $("#"+field).val('');
        }
    }
    function to_rp(angka, param=null){
        if(angka != '' || angka != 0){
            var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
            var rev2    = '';
            for(var i = 0; i < rev.length; i++){
                rev2  += rev[i];
                if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
                    rev2 += ',';
                }
            }

            var dec		= parseFloat(angka, 10).toString().split('.');
            if(dec[1] > 0){ dec = dec[1]; } else { dec = '00'; }

            //return 'IDR : ' + rev2.split('').reverse().join('') + ',-';
            return rev2.split('').reverse().join('') + (param==null?'.' + dec:'');
        } else {
            //return 'IDR : ';
            return '0';
        }
    }

    function hapuskoma(str) {
        str = str.toString();
        while (str.search(",") >= 0) {
            str = (str + "").replace(',', '');
        }
        return str;
    }
</script>

<body class="fixed-left">
<!-- Begin page -->
<div id="wrapper">

