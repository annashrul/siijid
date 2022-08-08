<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-6 col-xs-4">
						<button type="button" class="btn btn-primary waves-effect" onclick="show_modal('add')">Tambah</button>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
						<div class="input-group">
              <span class="input-group-btn">
                <button type="button" class="btn waves-effect waves-light btn-primary"><i class="fa fa-search"></i></button>
              </span>
							<input
								type="text" name="table_search" class="form-control pull-right search"
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
							<table class="table">
								<thead>
								<tr>
									<th>Jenis</th><th>Jumlah</th><th>Keterangan</th><th>Tanggal</th><th>#</th>
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