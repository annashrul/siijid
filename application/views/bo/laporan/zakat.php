
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
								<style>.middles{vertical-align:middle;}</style>
								<tr>
									<th width="1%" rowspan="2">No</th>
									<th width="5%" rowspan="2" class="middle"><center>#</center></th>
									<th width="10%" rowspan="2" class="middle"><center>Kd Trx</center></th>
									<th width="10%" rowspan="2" class="middle"><center>Penerima</center></th>
									<th width="5%" rowspan="2" class="middle"><center>RT</center></th>
									<th width="5%" rowspan="2" class="middle"><center>RW</center></th>
									<th width="10%" rowspan="2" class="middle"><center>Shodaqoh</center></th>
									<th width="10%" rowspan="2" class="middle"><center>Alamat</center></th>
									<th width="15%" colspan="2"><center>Total </center></th>
									<th width="10%" rowspan="2" class="middle"><center>Tanggal</center></th>
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
