<!DOCTYPE html> 
<html>
<head>
	<?= $this->load->view('head'); ?>
</head>
<body class="sidebar-mini wysihtml5-supported <?= $this->config->item('color')?>">
	<div class="wrapper">
		<?= $this->load->view('nav'); ?>
		<?= $this->load->view('menu_groups'); ?>
		<div class="content-wrapper">
			<?php
			if($this->session->flashdata('msg')==TRUE):
				echo '<div class="alert alert-success" role="alert">';
			echo $this->session->flashdata('msg');
			echo '</div>';
			endif;
			?>
			<section class="content-header">
				<h1>Kendaraan Dinas</h1>
			</section>
			<section class="invoice">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<?php  ?>
								<button class="btn btn-primary" onclick='ViewData(0)'>
									<i class='fa fa-plus'></i> Add Kendaraan Dinas
								</button>
								<?php ?>
								<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="Form-add-bu" id="addModalLabel">Form Add Kendaraan Dinas</h4>
											</div>
											<div class="modal-body">
												<input type="hidden" id="id_armada" name="id_armada" value='0' />
												<div class="row">

													<div class="form-group col-lg-6">
														<label>Jenis Kendaraan Dinas</label>
														<select class="form-control select2 " style="width: 100%;" id="id_jenis_armada" name="id_jenis_armada">
															<option value="0">--Jenis Kendaraan Dinas--</option>
															<?php
															foreach ($combobox_jenis_armada->result() as $rowmenu) {
																?>
																<option value="<?= $rowmenu->id_jenis_armada?>"  ><?= $rowmenu->nm_jenis_armada?></option>
																<?php
															}
															?>
														</select>
													</div>

													<div class="form-group col-lg-6">
														<label>No. Rangka</label>
														<input type="text" id="no_rangka" name="no_rangka" class="form-control" placeholder="Rangka">
													</div>

													<div class="form-group col-lg-6">
														<label>No. Mesin</label>
														<input type="text" id="no_mesin" name="no_mesin" class="form-control" placeholder="Mesin">
													</div>

													<div class="form-group col-lg-6">
														<label>Plat</label>
														<input type="text" id="plat_armada" name="plat_armada" class="form-control" placeholder="Plat">
													</div>

													<div class="form-group col-lg-6">
														<label>Merek</label>
														<select class="form-control select2 " style="width: 100%;" id="id_merek" name="id_merek">
															<option value="0">--Merek--</option>
															<?php
															foreach ($combobox_merek->result() as $rowmenu) {
																?>
																<option value="<?= $rowmenu->id_merek?>"  ><?= $rowmenu->nm_merek?></option>
																<?php
															}
															?>
														</select>
													</div>

													<div class="form-group col-lg-6">
														<label>Tahun Pembuatan</label>
														<input type="text" id="tahun_pembuatan" name="tahun_pembuatan" class="form-control" placeholder="Tahun Pembuatan">
													</div>

													<div class="form-group col-lg-6">
														<label>Tahun Pembelian</label>
														<input type="text" id="tahun_pembelian" name="tahun_pembelian" class="form-control" placeholder="Tahun Pembelian">
													</div>

													<div class="form-group col-lg-6">
														<label>Bahan Bakar</label>
														<select class="form-control select2 " style="width: 100%;" id="id_bahan_bakar" name="id_bahan_bakar">
															<option value="0">--Bahan Bakar--</option>
															<?php
															foreach ($combobox_bahan_bakar->result() as $rowmenu) {
																?>
																<option value="<?= $rowmenu->id_bahan_bakar?>"  ><?= $rowmenu->nm_bahan_bakar?></option>
																<?php
															}
															?>
														</select>
													</div>

													<div class="form-group col-lg-6">
														<label>Warna</label>
														<input type="text" id="warna" name="warna" class="form-control" placeholder="Warna">
													</div>

													<div class="form-group col-lg-6">
														<label>Active</label>
														<select class="form-control" id="active" name="active">
															<option value="1" <?php echo set_select('myselect', '1', TRUE); ?> >Active</option>
															<option value="0" <?php echo set_select('myselect', '0'); ?> >Not Active</option>
														</select>
													</div>
													
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												<button type="button" class="btn btn-primary" id='btnSave'>Save</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel-body">
								<div class="form-group">
									<label>Cabang</label>
									<select class="form-control select2 " style="width: 100%;" id="id_bu_filter" name="id_bu_filter">
										<?php
										foreach ($combobox_bu->result() as $rowmenu) {
											?>
											<option value="<?= $rowmenu->id_bu?>"  ><?= $rowmenu->nm_bu?></option>
											<?php
										}
										?>
									</select>
								</div>
								<div class="dataTable_wrapper">
									<table class="table table-striped table-bordered table-hover" id="armadaTable">
										<thead>
											<tr>
												<th>Options</th>
												<th>#</th>
												<th>Cabang</th>
												<th>Jenis</th>
												<th>Rangka</th>
												<th>Mesin</th>
												<th>Plat</th>
												<th>Merek</th>
												<th>Tahun Pembuatan</th>
												<th>Tahun Pembelian</th>
												<th>BBM</th>
												<th>Warna</th>
												<th>Status</th>
												<th>CUser</th>
												<th>CDate</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- FOTO ARMADA -->
				<div class="row" >
					<div class="col-lg-12">
						<div class="modal fade" id="addModalfotoarmada" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="form-add" id="addModalLabel">Form List Foto Armada</h4>


									</div>
									<div class="modal-body">
										<div class="row">
											<form id="submit">
												<input type="hidden" id="id_armada_foto" name="id_armada_foto" class="form-control">
												<input type="hidden" id="id_armadafoto" name="id_armadafoto" class="form-control">
												<div class="form-group col-lg-3">

													<label>Sisi</label>
													<select class="form-control" id="nm_armada_foto" name="nm_armada_foto">
														<option value="DEPAN KANAN" >DEPAN KANAN</option>
														<option value="DEPAN KIRI" >DEPAN KIRI</option>
														<option value="BELAKANG" >BELAKANG</option>
														<option value="DALAM" >DALAM</option>
													</select>
												</div>
												<div class="form-group col-lg-6">
													<label>Nama Attachment</label>
													<input type="file" name="file" id="file_attachment" accept=".jpeg,.jpeg" class="form-control">
													<p class="help-block">Upload Foto Armada. Format File: Jpg.  Size Max: 150KB   </p>
												</div>
												<div class="form-group col-lg-3">
													<label>_</label>
													<button type="submit" class="form-control btn btn-success" id=''>Save</button>
												</div>
											</form>

										</div>

										<div class="dataTable_wrapper">
											<table class="table table-striped table-bordered table-hover" id="attachmentTable">
												<thead>
													<tr>
														<th>Aksi</th>
														<th>#</th>
														<th>Sisi</th>
														<th>Foto Armada</th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
									<div class="modal-footer">

										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


				<!-- FOTO STNK -->
				<div class="row" >
					<div class="col-lg-12">
						<div class="modal fade" id="addModalfotostnk" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="form-add" id="addModalLabel">Form List Foto STNK</h4>


									</div>
									<div class="modal-body">
										<div class="row">
											<form id="submit_stnk">
												<input type="hidden" id="id_armada_stnk" name="id_armada_stnk" class="form-control">
												<input type="hidden" id="id_armadastnk" name="id_armadastnk" class="form-control">
												<div class="form-group col-lg-4">

													<label>Nomor STNK</label>
													<input type="text" id="no_stnk" name="no_stnk" class="form-control" placeholder="Nomor STNK">
												</div>
												<div class="form-group col-lg-4">

													<label>Tanggal EXP</label>
													<input type="text" id="tgl_exp_stnk" name="tgl_exp_stnk" class="form-control" placeholder="yyyy-mm-dd">
												</div>
												<div class="form-group col-lg-4">
													<label>Masa</label>
													<select class="form-control " style="width: 100%;" id="masa" name="masa">
														<option value="1">1</option>
														<option value="5">5</option>
													</select>
												</div>
												<div class="form-group col-lg-4">
													<label>Nama Attachment</label>
													<input type="file" name="file" id="file_attachment_stnk" accept=".jpeg,.jpeg" class="form-control">
													<p class="help-block">Upload Foto STNK. Format File: Jpg.  Size Max: 150KB   </p>
												</div>
												<div class="form-group col-lg-3">
													<label>_</label>
													<button type="submit" class="form-control btn btn-success" id=''>Save</button>
												</div>
											</form>

										</div>

										<div class="dataTable_wrapper">
											<table class="table table-striped table-bordered table-hover" id="stnkTable">
												<thead>
													<tr>
														<th>Aksi</th>
														<th>#</th>
														<th>No.STNK</th>
														<th>Tanggal Kadaluarsa</th>
														<th>Masa</th>
														<th>Foto STNK</th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
									<div class="modal-footer">

										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


				<!-- FOTO BPKB -->
				<div class="row" >
					<div class="col-lg-12">
						<div class="modal fade" id="addModalfotobpkb" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="form-add" id="addModalLabel">Form List Foto BPKB</h4>


									</div>
									<div class="modal-body">
										<div class="row">
											<form id="submit_bpkb">
												<input type="hidden" id="id_armada_bpkb" name="id_armada_bpkb" class="form-control">
												<input type="hidden" id="id_armadabpkb" name="id_armadabpkb" class="form-control">
												<div class="form-group col-lg-3">

													<label>Nomor BPKB</label>
													<input type="text" id="no_bpkb" name="no_bpkb" class="form-control" placeholder="Nomor BPKB">
												</div>
												<div class="form-group col-lg-2">

													<label>Tanggal EXP</label>
													<input type="text" id="tgl_exp_bpkb" name="tgl_exp_bpkb" class="form-control" placeholder="yyyy-mm-dd">
												</div>
												<div class="form-group col-lg-4">
													<label>Nama Attachment</label>
													<input type="file" name="file" id="file_attachment_bpkb" accept=".jpeg,.jpeg" class="form-control">
													<p class="help-block">Upload Foto BPKB. Format File: Jpg.  Size Max: 150KB   </p>
												</div>
												<div class="form-group col-lg-3">
													<label>_</label>
													<button type="submit" class="form-control btn btn-success" id=''>Save</button>
												</div>
											</form>

										</div>

										<div class="dataTable_wrapper">
											<table class="table table-striped table-bordered table-hover" id="bpkbTable">
												<thead>
													<tr>
														<th>Aksi</th>
														<th>#</th>
														<th>No. BPKB</th>
														<th>Tanggal Kadaluarsa</th>
														<th>Foto BPKB</th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
									<div class="modal-footer">

										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</section>


		</div>
	</div>


	<?= $this->load->view('basic_js'); ?>
	<script type='text/javascript'>
		var armadaTable = $('#armadaTable').DataTable({
			"ordering" : false,
			"scrollX": true,
			"processing": true,
			"serverSide": true,

			dom: 'Bfrtip',
			lengthMenu: [
			[ 10, 25, 50, 100, 10000 ],
			[ '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
			],
			buttons: [
					'pageLength', 'copy', 'csv', 'excel', //'pdf', 'print'
					],

					ajax: 
					{
						url: "<?= base_url()?>armada/ax_data_armada/",
						type: 'POST',
						data: function ( d ) {
							return $.extend({}, d, { 

								"id_bu": $("#id_bu_filter").val()

							});
						}
					},
					columns: 
					[
					{
						data: "id_armada", render: function(data, type, full, meta){
							var str = '';
							str += '<div class="btn-group">';
							str += '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>';
							str += '<ul class="dropdown-menu">';
							str += '<li><a onclick="ViewData(' + data + ')"><i class="fa fa-pencil"></i> Edit</a></li>';
							var kd = "Foto('"+data+"')";
							str += '<li><a onclick="'+ kd +'"><i class="fa fa-truck"></i> Foto Armada</a></li>';
							str += '<li><a onclick="Stnk(' + data + ')"><i class="fa fa-truck"></i> Foto STNK</a></li>';
							str += '<li><a onclick="Bpkb(' + data + ')"><i class="fa fa-truck"></i> Foto BPKB</a></li>';
							str += '<li><a onClick="DeleteData(' + data + ')"><i class="fa fa-trash"></i> Delete</a></li>';
							str += '</ul>';
							str += '</div>';

							return str;
						}
					},
					
					{ class:'intro', data: "id_armada" },
					{ class:'intro', data: "nm_bu" },
					{ class:'intro', data: "nm_jenis_armada" },
					{ class:'intro', data: "no_rangka" },
					{ class:'intro', data: "no_mesin" },
					{ class:'intro', data: "plat_armada" },
					{ class:'intro', data: "nm_merek" },
					{ class:'intro', data: "tahun_pembuatan" },
					{ class:'intro', data: "tahun_pembelian" },
					{ class:'intro', data: "nm_bahan_bakar" },
					{ class:'intro', data: "warna" },
					{ data: "active", render: function(data, type, full, meta){
						if(data == 1)
							return "Active";
						else return "Not Active";
					}},
					{ class:'intro', data: "cuser" },
					{ class:'intro', data: "cdate" },
					
					]
				});



		$('#btnSave').on('click', function () {
			if($('#id_jenis_armada').val() == '0')
			{
				alertify.alert("Warning", "Pilih Jenis Armada.");
			}
			else
			{
				var url = '<?=base_url()?>armada/ax_set_data';
				var data = {
					id_armada 		: $('#id_armada').val(),
					id_bu 			: $('#id_bu_filter').val(),
					id_jenis_armada : $('#id_jenis_armada').val(),
					no_rangka 		: $('#no_rangka').val(),
					no_mesin 		: $('#no_mesin').val(),
					plat_armada 	: $('#plat_armada').val(),
					id_merek 		: $('#id_merek').val(),
					tahun_pembuatan 		: $('#tahun_pembuatan').val(),
					tahun_pembelian 	: $('#tahun_pembelian').val(),
					id_bahan_bakar 		: $('#id_bahan_bakar').val(),
					warna 	: $('#warna').val(),
					active 	: $('#active').val()
				};

				$.ajax({
					url: url,
					method: 'POST',
					data: data
				}).done(function(data, textStatus, jqXHR) {
					var data = JSON.parse(data);
					if(data['status'] == "success")
					{
						alertify.success("Data Armada Disimpan.");
						$('#addModal').modal('hide');
						armadaTable.ajax.reload();
					}
				});
			}
		});




		function ViewData(id_armada)
		{
			if(id_armada == 0)
			{
				$('#addModalLabel').html('Form Add Kendaraan Dinas');
				$('#select2-id_jenis_armada-container').html('--Jenis Armada--');
				$('#select2-id_merek-container').html('--Merek--');
				$('#select2-id_bahan_bakar-container').html('--Bahan Bakar--');
				$('#id_jenis_armada').val(0);
				$('#id_merek').val(0);
				$('#id_bahan_bakar').val(0);
				$('#id_armada').val(0);
				$('#no_rangka').val('');
				$('#no_mesin').val('');
				$('#plat_armada').val('');
				$('#tahun_pembuatan').val('');
				$('#tahun_pembelian').val('');
				$('#warna').val('');
				$('#active').val('1');
				$('#addModal').modal('show');
			}
			else
			{
				var url = '<?=base_url()?>armada/ax_get_data_by_id';
				var data = {
					id_armada: id_armada
				};

				$.ajax({
					url: url,
					method: 'POST',
					data: data
				}).done(function(data, textStatus, jqXHR) {
					var data = JSON.parse(data);
					$('#addModalLabel').html('Form Edit Kendaraan Dinas');
					$('#select2-id_jenis_armada-container').html(data['nm_jenis_armada']);
					$('#select2-id_merek-container').html(data['nm_merek']);
					$('#select2-id_bahan_bakar-container').html(data['nm_bahan_bakar']);
					$('#id_jenis_armada').val(data['id_jenis_armada']);
					$('#id_merek').val(data['id_merek']);
					$('#id_bahan_bakar').val(data['id_bahan_bakar']);
					
					$('#id_armada').val(data['id_armada']);
					$('#no_rangka').val(data['no_rangka']);
					$('#no_mesin').val(data['no_mesin']);
					$('#plat_armada').val(data['plat_armada']);
					$('#tahun_pembuatan').val(data['tahun_pembuatan']);
					$('#tahun_pembelian').val(data['tahun_pembelian']);
					$('#warna').val(data['warna']);

					$('#active').val(data['active']);
					$('#addModal').modal('show');
				});
			}
		}



		function DeleteData(id_armada)
		{
			alertify.confirm(
				'Confirmation', 
				'Are you sure you want to delete this data?', 
				function(){
					var url = '<?=base_url()?>armada/ax_unset_data';
					var data = {
						id_armada: id_armada
					};

					$.ajax({
						url: url,
						method: 'POST',
						data: data
					}).done(function(data, textStatus, jqXHR) {
						var data = JSON.parse(data);
						armadaTable.ajax.reload();
						alertify.error('Data Armada Dihapus.');
					});
				},
				function(){ }
				);
		}


		var attachmentTable = $('#attachmentTable').DataTable({
			"ordering" : false,
			"scrollX": true,
			"processing": true,
			"serverSide": true,
			ajax: 
			{
				url: "<?= base_url()?>armada/ax_data_foto/",
				type: 'POST',
				data: function ( d ) {
					return $.extend({}, d, { 

						"id_armada": $("#id_armadafoto").val(),

					});
				}
			},
			columns: 
			[
			{
				data: "id_armada_foto", render: function(data, type, full, meta){
					var str = '';
					str += '<div class="btn-group">';
					str += '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>';
					str += '<ul class="dropdown-menu">';
					var kd = "Foto('"+full['kd_armada']+"')";
							// str += '<li><a onclick="'+kd+'"><i class="fa fa-pencil"></i> Edit</a></li>';
							str += '<li><a onClick="DeleteFoto(' + data + ')"><i class="fa fa-trash"></i> Delete</a></li>';
							str += '</ul>';
							str += '</div>';
							return str;
						}
					},
					
					{ class:'intro', data: "id_armada_foto" },
					{ data: "nm_armada_foto" },
					// { data: "attachment" },
					{ data: "attachment", render: function(data, type, full, meta)
					{
						var url = "<?= base_url()?>"+"uploads/armada/foto/"+data;
						var op =  "window.open('"+url+"', '_blank');";
						return '<img width="200" height="100" class="attachment-img" onclick="'+op+'" src="'+url+'" alt="No Image">';

					}

				},




				],
			});



			/// attachment
			$('#submit').submit(function(e){
				e.preventDefault(); 

				if($('#nm_attachment').val() == '')
				{
					alertify.alert("Warning", "Please fill Name.");
				}
				else if($('#file_attachment').val() == ''){
					alertify.alert("Warning", "Please choose Attachment.");
				}
				else
				{
					$.ajax({
						url:'<?php echo base_url();?>armada/ax_upload_data_foto',
						type:"post",
						data:new FormData(this),
						processData:false,
						contentType:false,
						cache:false,
						async:false,
                   //    success: function(data){
                   //        alert("Attachment Uploaded.");
                   // }
                 // });
             }).done(function(data, textStatus, jqXHR) {
             	var data = JSON.parse(data);
             	attachmentTable.ajax.reload();
							// $('#addModalattach').modal('hide');
							alertify.success('Attachment Uploaded.');
						});
         }
     });

			function DeleteFoto(id_armada_foto)
			{
				alertify.confirm(
					'Confirmation', 
					'Are you sure you want to delete this data?', 
					function(){
						var url = '<?=base_url()?>armada/ax_unset_foto';
						var data = {
							id_armada_foto: id_armada_foto
						};

						$.ajax({
							url: url,
							method: 'POST',
							data: data
						}).done(function(data, textStatus, jqXHR) {
							var data = JSON.parse(data);
							if(data['status'] == "success")
							{
								attachmentTable.ajax.reload();
								alertify.error('Foto Armada Dihapus.');
							}
						});
					},
					function(){ }
					);
			}

			var stnkTable = $('#stnkTable').DataTable({
				"ordering" : false,
				"scrollX": true,
				"processing": true,
				"serverSide": true,
				ajax: 
				{
					url: "<?= base_url()?>armada/ax_data_stnk/",
					type: 'POST',
					data: function ( d ) {
						return $.extend({}, d, { 

							"id_armada": $("#id_armadastnk").val(),

						});
					}
				},
				columns: 
				[
				{
					data: "id_armada_stnk", render: function(data, type, full, meta){
						var str = '';
						str += '<div class="btn-group">';
						str += '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>';
						str += '<ul class="dropdown-menu">';
							// str += '<li><a onclick="'+kd+'"><i class="fa fa-pencil"></i> Edit</a></li>';
							str += '<li><a onClick="DeleteStnk(' + data + ')"><i class="fa fa-trash"></i> Delete</a></li>';
							str += '</ul>';
							str += '</div>';
							return str;
						}
					},
					
					{ class:'intro', data: "id_armada_stnk" },
					{ data: "no_stnk" },
					{ data: "tgl_exp_stnk" },
					{ data: "masa" },
					{ data: "attachment", render: function(data, type, full, meta)
					{
						var url = "<?= base_url()?>"+"uploads/armada/stnk/"+data;
						var op =  "window.open('"+url+"', '_blank');";
						return '<img width="200" height="100" class="attachment-img" onclick="'+op+'" src="'+url+'" alt="No Image">';

					}

				},




				],
			});



			/// attachment
			$('#submit_stnk').submit(function(e){
				e.preventDefault(); 

				if($('#tgl_exp_stnk').val() == '')
				{
					alertify.alert("Warning", "Please fill Expired Date.");
				}
				else if($('#file_attachment_stnk').val() == ''){
					alertify.alert("Warning", "Please choose Attachment.");
				}
				else
				{
					$.ajax({
						url:'<?php echo base_url();?>armada/ax_upload_data_stnk',
						type:"post",
						data:new FormData(this),
						processData:false,
						contentType:false,
						cache:false,
						async:false,
                   //    success: function(data){
                   //        alert("Attachment Uploaded.");
                   // }
                 // });
             }).done(function(data, textStatus, jqXHR) {
             	var data = JSON.parse(data);
             	stnkTable.ajax.reload();
							// $('#addModalattach').modal('hide');
							alertify.success('Attachment Uploaded.');
						});
         }
     });

			function DeleteStnk(id_armada_stnk)
			{
				alertify.confirm(
					'Confirmation', 
					'Are you sure you want to delete this data?', 
					function(){
						var url = '<?=base_url()?>armada/ax_unset_stnk';
						var data = {
							id_armada_stnk: id_armada_stnk
						};

						$.ajax({
							url: url,
							method: 'POST',
							data: data
						}).done(function(data, textStatus, jqXHR) {
							var data = JSON.parse(data);
							if(data['status'] == "success")
							{
								stnkTable.ajax.reload();
								alertify.error('STNK Armada Dihapus.');
							}
						});
					},
					function(){ }
					);
			}



			var bpkbTable = $('#bpkbTable').DataTable({
				"ordering" : false,
				"scrollX": true,
				"processing": true,
				"serverSide": true,
				ajax: 
				{
					url: "<?= base_url()?>armada/ax_data_bpkb/",
					type: 'POST',
					data: function ( d ) {
						return $.extend({}, d, { 

							"id_armada": $("#id_armadabpkb").val(),

						});
					}
				},
				columns: 
				[
				{
					data: "id_armada_bpkb", render: function(data, type, full, meta){
						var str = '';
						str += '<div class="btn-group">';
						str += '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>';
						str += '<ul class="dropdown-menu">';
							str += '<li><a onClick="DeleteBpkb(' + data + ')"><i class="fa fa-trash"></i> Delete</a></li>';
							str += '</ul>';
							str += '</div>';
							return str;
						}
					},
					
					{ class:'intro', data: "id_armada_bpkb" },
					{ data: "no_bpkb" },
					{ data: "tgl_exp_bpkb" },
					{ data: "attachment", render: function(data, type, full, meta)
					{
						var url = "<?= base_url()?>"+"uploads/armada/bpkb/"+data;
						var op =  "window.open('"+url+"', '_blank');";
						return '<img width="200" height="100" class="attachment-img" onclick="'+op+'" src="'+url+'" alt="No Image">';
					}
				},
				],
			});



			/// attachment
			$('#submit_bpkb').submit(function(e){
				e.preventDefault(); 

				if($('#tgl_exp_bpkb').val() == '')
				{
					alertify.alert("Warning", "Please fill Expired Date.");
				}
				else if($('#file_attachment_bpkb').val() == ''){
					alertify.alert("Warning", "Please choose Attachment.");
				}
				else
				{
					$.ajax({
						url:'<?php echo base_url();?>armada/ax_upload_data_bpkb',
						type:"post",
						data:new FormData(this),
						processData:false,
						contentType:false,
						cache:false,
						async:false,
                   //    success: function(data){
                   //        alert("Attachment Uploaded.");
                   // }
                 // });
             }).done(function(data, textStatus, jqXHR) {
             	var data = JSON.parse(data);
             	bpkbTable.ajax.reload();
							// $('#addModalattach').modal('hide');
							alertify.success('Attachment Uploaded.');
						});
         }
     });

			function DeleteBpkb(id_armada_bpkb)
			{
				alertify.confirm(
					'Confirmation', 
					'Are you sure you want to delete this data?', 
					function(){
						var url = '<?=base_url()?>armada/ax_unset_bpkb';
						var data = {
							id_armada_bpkb: id_armada_bpkb
						};

						$.ajax({
							url: url,
							method: 'POST',
							data: data
						}).done(function(data, textStatus, jqXHR) {
							var data = JSON.parse(data);
							if(data['status'] == "success")
							{
								bpkbTable.ajax.reload();
								alertify.error('STNK Armada Dihapus.');
							}
						});
					},
					function(){ }
					);
			}


			

			$(document).ready(function() {

				$("#tahun_pembuatan, #tahun_pembelian").keydown(function (e) {

					if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||

						(e.keyCode == 65 && e.ctrlKey === true) ||

						(e.keyCode == 67 && e.ctrlKey === true) ||

						(e.keyCode == 88 && e.ctrlKey === true) ||

						(e.keyCode >= 35 && e.keyCode <= 39)) {

						return;
				}

				if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
					e.preventDefault();
				}
			});
				

			});

			$('#id_bu_filter').select2({
				'allowClear': true
			}).on("change", function (e) {
				armadaTable.ajax.reload();
			});


			function Foto(id_armada)
			{
				$('#addModalfotoarmada').modal('show');
				$('#id_armadafoto').val(id_armada);
				attachmentTable.ajax.reload();
				setTimeout(function(){ attachmentTable.columns.adjust().draw(); }, 1000);
			}

			function Stnk(id_armada)
			{
				$('#addModalfotostnk').modal('show');
				$('#id_armadastnk').val(id_armada);
				stnkTable.ajax.reload();
				
				setTimeout(function(){ stnkTable.columns.adjust().draw(); }, 1000);
			}

			function Bpkb(id_armada)
			{
				$('#addModalfotobpkb').modal('show');
				$('#id_armadabpkb').val(id_armada);
				bpkbTable.ajax.reload();
				
				setTimeout(function(){ bpkbTable.columns.adjust().draw(); }, 1000);
			}

			$( "#tgl_exp_stnk,#tgl_exp_bpkb").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "yy-mm-dd"
			});

			$( "#tgl_exp_stnk,#tgl_exp_bpkb" ).inputmask("yyyy-mm-dd",{"placeholder": "yyyy-mm-dd"});

			
			
			
		</script>
	</body>
	</html>
