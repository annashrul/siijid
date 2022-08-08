

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
                                <button type="button" class="btn waves-effect waves-light btn-primary" onclick="add()" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah" style="margin-top: 25px;"><i class="fa fa-plus"></i></button>
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
<input type="hidden" name="page" id="hal">
<!--********************************** MODAL FORM ******************************-->
<div id="modal_form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header noPadding">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modal_title"></h4>
			</div>
            <form id="form_input">
                <div class="modal-body">
                    <div class="row">
                        <p class="text-center" id="pesan" style="color: red;"></p>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Nama Kegiatan</label>
                                <input type="text" name="nama_kegiatan" class="form-control" id="nama_kegiatan">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary bg-blue pull-right" id="simpan" name="simpan">Simpan</button>
                    <input type="hidden" name="param" id="param" value="add">
                    <input type="hidden" name="id" id="id">
                </div>
            </form>
		</div>
	</div>
</div>
<script type="text/javascript">
	var url = "<?=base_url('bo/kegiatan/')?>" //** url assets **//
	var img = "<?=base_url('assets/')?>"    //** url images **//
	
	$('#form_input').validate({
		rules: {
			nama_kegiatan: {
				required: true,
				remote: {
					url: url+"isExist",
					type: "post",
					data: {
						param: function() {
							return $("#param").val();
						}
					}
				}
			},
		},
		//For custom messages
		messages: {
			nama_kegiatan:{
				required: "Nama Kegiatan Tidak Boleh Kosong!",
				remote : "Kegiatan Sudah Ada"
			},
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
				url			: url+"simpan",
				type		: "POST",
				dataType 	: "JSON",
				data    	: $("#form_input").serialize(),
				dataType	: "JSON",
				beforeSend: function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg"></div>')},
				complete  : function() {$('.first-loader').remove()},
				success   : function(res){
					console.log(res.pesan);
					if(res.pesan == ""){
						$("#modal_form").modal('hide');
						swal({
							type: 'success',
							title: 'Success!',
							text: 'Data Has Been Saved'
						});
						load_data($("#hal").val());
					}else{
						swal({
							title: 'Error',
							text: res.pesan,
							type: 'warning',
							confirmButtonColor: '#ff0000',
							confirmButtonText: 'Oke',
						})
					}
				}, error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.responseText)
				}
			});
		}
	});
	
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
			url       : url+"get/"+page,
			method    : "POST",
			data      : data,
			dataType  : "JSON",
			beforeSend: function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg"></div>')},
			complete  : function() {$('.first-loader').remove()},
			success   : function(data) {
				$('#list_project').html(data.result_project);
				$('#pagination_link').html(data.pagination_link);
				$("#hal").val(data.page);
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
	function add() {
		$("#modal_title").text("Tambah Kegiatan");
		$("#param").val("add");
		$("#modal_form").modal("show");
		setTimeout(function () {
			$("#nama_kegiatan").focus();
		}, 600);
	}
	$("#modal_form").on("hide.bs.modal", function () {
		document.getElementById("form_input").reset();
		$( "#form_input" ).validate().resetForm();
	});
	//************* HAPUS DATA **********************//
	function edit(id) {
		$.ajax({
			url: url+"edit",
			type: "POST",
			data: {id: id},
			dataType: "JSON",
			beforeSend: function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg"></div>')},
			complete  : function() {$('.first-loader').remove()},
			success: function (res) {
				console.log(res.res_data)
				if (res.status) {
					$("#modal_title").text("Edit <?=$page?>");
					$("#param").val("edit");
					$("#id").val(id);
					$("#nama_kegiatan").val(res.res_data['nama_kegiatan']);
					$("#modal_form").modal("show");
				} else {
					alert("Error getting data!")
				}
			}
		});
	}
	
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
                    data:{id:id},
                    beforeSend: function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg"></div>')},
                    complete  : function() {$('.first-loader').remove()},
                    success:function(res){
                        swal('Berhasil!','Data Berhasil Dihapus.','success');
                        load_data($("#hal").val());
                    }
                });
            }else if(result.dismiss === 'cancel'){
                swal('Cancel','Data Tidak Jadi Dihapus.','success');
            }

        });




		// swal({
		// 	title             : 'Anda Yakin?',
		// 	text              : "Anda Tidak Dapat Mengembalikan Data Ini!",
		// 	type              : 'warning',
		// 	showCancelButton  : true,
		// 	confirmButtonColor: '#3085d6',
		// 	cancelButtonColor : '#d33',
		// 	confirmButtonText : 'Yakin !',
		// 	closeOnConfirm    : false
		// }).then(function(isConfirm){
		// 	if (isConfirm) {
		// 		$.ajax({
		// 			url : url+"hapus",
		// 			type: "POST",
		// 			dataType: "JSON",
		// 			data:{id:id},
		// 			beforeSend: function() {$('body').append('<div class="first-loader"><img src="'+img+'spin.svg"></div>')},
		// 			complete  : function() {$('.first-loader').remove()},
		// 			success: function(data){
		// 				swal('Berhasil!','Data Berhasil Dihapus.','success');
		// 				load_data($("#hal").val());
		// 			},error: function(xhr, status, error) {
		// 				swal({
		// 					title: 'Error',
		// 					text: "Data Already Used",
		// 					type: 'warning',
		// 					confirmButtonColor: '#ff0000',
		// 					confirmButtonText: 'Oke',
		// 				})
		// 				console.log(xhr.responseText);
		// 			}
		// 		});
		// 	}
		// })
	}

</script>