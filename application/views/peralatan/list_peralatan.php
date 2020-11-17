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
			<section class="content-header">
				<h1>Daftar Peralatan</h1>
			</section>
			<section class="invoice">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<button class="btn btn-primary" onclick='ViewData(0)'>
									<i class='fa fa-plus'></i> Add Daftar Peralatan
								</button>
								<div class="modal fade" id="addModal" tabindex="" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="Form-add-bu" id="addModalLabel">Form Add Daftar Peralatan</h4>
											</div>
											<div class="modal-body">
												<input type="hidden" id="id_peralatan" name="id_peralatan" value='' />

												<div class="col-lg-6">
													<div class="form-group">
														<label>Kategori</label>
														<select class="form-control select2 " style="width: 100%;" id="id_kategori" name="id_kategori">
															<option value="0">--Kategori--</option>
															<?php
															$arr=1;
															foreach ($combobox_kategori->result() as $rowmenu) {
																?>
																<option value="<?= $rowmenu->id_kategori?>"  ><?=($arr++).". ".$rowmenu->nm_kategori?></option>
																<?php
															}
															?>
														</select>
													</div>
													<div class="form-group">
														<label>Barang</label>
														<select class="form-control select2 " style="width: 100%;" id="id_kategori_sub" name="id_kategori_sub">
															<option value="0">--Barang--</option>
														</select>
													</div>
													<div class="form-group">
														<label>Tgl Pembelian</label>
														<input type="text" id="tgl_pembelian" name="tgl_pembelian" class="form-control" placeholder="yyyy-mm-dd">
													</div>
													<div class="form-group">
														<label>Harga Pembelian</label>
														<input type="number" id="harga_pembelian" name="harga_pembelian" class="form-control" placeholder="Harga Pembelian">
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label>Kuantitas</label>
														<input type="number" id="kuantitas_barang" name="kuantitas_barang" class="form-control" placeholder="Kuantitas">
													</div>
													<div class="form-group">
														<label>Ijin Prinsip</label>
														<input type="text" id="ijin_prinsip" name="ijin_prinsip" class="form-control" placeholder="Ijin Prinsip">
													</div>
													<div class="form-group">
														<label>Purchase Order</label>
														<input type="text" id="purchase_order" name="purchase_order" class="form-control" placeholder="Purchase Order">
													</div>
													<div class="form-group">
														<label>Invoice</label>
														<input type="text" id="invoice" name="invoice" class="form-control" placeholder="Invoice">
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label>Posisi Barang</label>
														<select class="form-control select2 " style="width: 100%;" id="id_posisi_barang" name="id_posisi_barang">
															<option value="0">--Posisi Barang--</option>
															<?php
															$arr=1;
															foreach ($combobox_posisi_barang->result() as $rowmenu) {
																?>
																<option value="<?= $rowmenu->id_posisi_barang?>"  ><?=($arr++).". ".$rowmenu->nm_posisi_barang?></option>
																<?php
															}
															?>
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
								<div class="dataTable_wrapper">
									<table class="table table-striped table-bordered table-hover" id="buTable">
										<thead>
											<tr>
												<th>Options</th>
												<th>#</th>
												<th>Kategori</th>
												<th>Barang</th>
												<th>Tgl Pembelian</th>
												<th>Harga</th>
												<th>Kuantitas</th>
												<th>Ijin Prinsip</th>
												<th>Purchase Order</th>
												<th>Invoice</th>
												<th>Posisi Barang</th>
												<th>cdate</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>



	<!-- FOTO STNK -->
	<div class="row" >
		<div class="col-lg-12">
			<div class="modal fade" id="addModalfoto" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="form-add" id="addModalLabel">Form List Foto Barang</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<form id="submit_peralatan_foto">
									<input type="hidden" id="id_peralatan_foto" name="id_peralatan_foto" class="form-control">
									<input type="hidden" id="id_peralatanfoto" name="id_peralatanfoto" class="form-control">

									<div class="form-group col-lg-5">
										<label>Nama Attachment</label>
										<input type="text" id="nm_peralatan_foto" name="nm_peralatan_foto" class="form-control" placeholder="Nama Attachment">
									</div>

									<div class="form-group col-lg-4">
										<label>Attachment</label>
										<input type="file" name="file" id="file_attachment_stnk" accept=".jpeg,.jpeg" class="form-control">
										<p class="help-block">Upload Foto Barang. Format File: Jpg.  Size Max: 150KB   </p>
									</div>
									<div class="form-group col-lg-3">
										<label>_</label>
										<button type="submit" class="form-control btn btn-success" id=''>Save</button>
									</div>
								</form>

							</div>

							<div class="dataTable_wrapper">
								<table class="table table-striped table-bordered table-hover" id="peralatanfotoTable">
									<thead>
										<tr>
											<th>Aksi</th>
											<th>#</th>
											<th>Nama Barang</th>
											<th>Foto Barang</th>
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

	<?= $this->load->view('basic_js'); ?>
	<script type='text/javascript'>

		counteratt = 1;

		var buTable = $('#buTable').DataTable({
			"ordering" : false,
			"scrollX": true,
			"processing": true,
			"serverSide": true,
			ajax: 
			{
				url: "<?= base_url()?>peralatan/list_peralatan/ax_data_list_peralatan/",
				type: 'POST'
			},
			columns: 
			[
			{

				data: "id_peralatan", render: function(data, type, full, meta){
					var str = '';
					str += '<div class="btn-group">';
					str += '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>';
					str += '<ul class="dropdown-menu">';
					str += '<li><a onclick="FotoBarang(' + data + ')"><i class="fa fa-list"></i> Foto</a></li>';
					str += '<li><a onclick="ViewData(' + data + ')"><i class="fa fa-pencil"></i> Edit</a></li>';
					str += '<li><a onClick="DeleteData(' + data + ')"><i class="fa fa-trash"></i> Delete</a></li>';
					str += '</ul>';
					str += '</div>';
					return str;
				}
			},
			{ data: "id_peralatan" },
			{ data: "nm_kategori" },
			{ data: "nm_kategori_sub" },
			{ data: "tgl_pembelian" },
			{ data: "harga_pembelian" },
			{ data: "kuantitas_barang" },
			{ data: "ijin_prinsip" },
			{ data: "purchase_order" },
			{ data: "invoice" },
			{ data: "nm_posisi_barang" },
			{ data: "cdate" },
			]
		});

		$('#btnSave').on('click', function () {
			if($('#id_kategori').val() == '0')
			{
				alertify.alert("Warning", "Pilih Kategori.");
			} else if($('#id_kategori_sub').val() == '0')
			{
				alertify.alert("Warning", "Pilih Barang.");
			} else if($('#tgl_pembelian').val() == '')
			{
				alertify.alert("Warning", "Tgl Pembelian tidak boleh kosong.");
			} else if($('#harga_pembelian').val() == '')
			{
				alertify.alert("Warning", "Harga Pembelian tidak boleh kosong.");
			} else if($('#kuantitas_barang').val() == '')
			{
				alertify.alert("Warning", "Kuantitas tidak boleh kosong.");
			} else if($('#ijin_prinsip').val() == '')
			{
				alertify.alert("Warning", "Ijin Prinsip tidak boleh kosong.");
			} else if($('#purchase_order').val() == '')
			{
				alertify.alert("Warning", "Purchase Order tidak boleh kosong.");
			} else if($('#invoice').val() == '')
			{
				alertify.alert("Warning", "Invoice tidak boleh kosong.");
			}
			else if($('#id_posisi_barang').val() == '0')
			{
				alertify.alert("Warning", "Pilih Posisi Barang.");
			}
			else
			{
				var url = '<?=base_url()?>peralatan/list_peralatan/ax_set_data';
				var data = {
					id_peralatan 		: $('#id_peralatan').val(),
					id_kategori 		: $('#id_kategori').val(),
					id_kategori_sub 	: $('#id_kategori_sub').val(),
					tgl_pembelian 		: $('#tgl_pembelian').val(),
					harga_pembelian 	: $('#harga_pembelian').val(),
					kuantitas_barang 	: $('#kuantitas_barang').val(),
					ijin_prinsip 		: $('#ijin_prinsip').val(),
					purchase_order 		: $('#purchase_order').val(),
					invoice 			: $('#invoice').val(),
					id_posisi_barang 	: $('#id_posisi_barang').val()
				};

				$.ajax({
					url: url,
					method: 'POST',
					data: data,
					statusCode: {
						500: function() {
							alertify.alert("Warning","Kode Jenis Surat sudah ada di database");
						}
					}
				}).done(function(data, textStatus, jqXHR) {
					var data = JSON.parse(data);
					if(data['status'] == "success")
					{
						alertify.success("Data Saved.");
						$('#addModal').modal('hide');
						buTable.ajax.reload();
					}
				});
			}
		});

		function ViewData(id_peralatan)
		{
			if(id_peralatan == 0)
			{

				$('#addModalLabel').html('Add Peralatan');
				$('#select2-id_kategori-container').html('--Kategori--');
				$('#select2-id_kategori_sub-container').html('--Barang--');
				$('#id_peralatan').val(0);
				$('#id_kategori').val(0);
				$('#id_kategori_sub').val(0);
				$('#id_posisi_barang').val(0);
				$('#tgl_pembelian').val('');
				$('#harga_pembelian').val('');
				$('#kuantitas_barang').val('');
				$('#ijin_prinsip').val('');
				$('#purchase_order').val('');
				$('#invoice').val('');
				$('#addModal').modal('show');
			}
			else
			{
				var url = '<?=base_url()?>peralatan/list_peralatan/ax_get_data_by_id';
				var data = {
					id_peralatan: id_peralatan
				};

				$.ajax({
					url: url,
					method: 'POST',
					data: data
				}).done(function(data, textStatus, jqXHR) {
					var data = JSON.parse(data);
					$('#addModalLabel').html('Edit Peralatan');

					$('#select2-id_kategori-container').html(data['nm_kategori']);
					$('#select2-id_kategori_sub-container').html(data['nm_kategori_sub']);
					$('#select2-id_posisi_barang-container').html(data['nm_posisi_barang']);
					$('#id_kategori').val(data['id_kategori']);
					$('#id_kategori_sub').val(data['id_kategori_sub']);
					$('#id_posisi_barang').val(data['id_posisi_barang']);
					$('#id_peralatan').val(data['id_peralatan']);
					$('#tgl_pembelian').val(data['tgl_pembelian']);
					$('#harga_pembelian').val(data['harga_pembelian']);
					$('#kuantitas_barang').val(data['kuantitas_barang']);

					$('#ijin_prinsip').val(data['ijin_prinsip']);
					$('#purchase_order').val(data['purchase_order']);
					$('#invoice').val(data['invoice']);
					$('#addModal').modal('show');
				});
			}
		}

		function DeleteData(id_peralatan)
		{
			alertify.confirm(
				'Confirmation', 
				'Are you sure you want to delete this data?', 
				function(){
					var url = '<?=base_url()?>peralatan/list_peralatan/ax_unset_data';
					var data = {
						id_peralatan: id_peralatan
					};

					$.ajax({
						url: url,
						method: 'POST',
						data: data
					}).done(function(data, textStatus, jqXHR) {
						var data = JSON.parse(data);
						buTable.ajax.reload();
						alertify.error('Data deleted.');
					});
				},
				function(){ }
				);
		}

		$('#id_kategori').select2({
			'placeholder': "-- Kategori --",
			'allowClear': true
		}).on("change", function (e) {
			kategorisublist();
		});

		function kategorisublist(){
			$.ajax({
				type: "POST", 
				url: "<?= base_url() ?>peralatan/list_peralatan/ax_get_kategori_sub", 
				data: {id_kategori : $("#id_kategori").val()}, 
				dataType: "json",
				beforeSend: function(e) {
					if(e && e.overrideMimeType) {
						e.overrideMimeType("application/json;charset=UTF-8");
					}
				},
				success: function(response){ 

					$("#id_kategori_sub").html(response.data_kategori_sub).show();
					$('#select2-id_kategori_sub-container').html('--Barang--');
					$('#id_kategori_sub').val('0');
				},
				error: function (xhr, ajaxOptions, thrownError) { 
					alert(thrownError); 
				}
			});
		}

		$( "#tgl_pembelian").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
		});

		$( "#tgl_pembelian" ).inputmask("yyyy-mm-dd",{"placeholder": "yyyy-mm-dd"});


		function FotoBarang(id_peralatan)
		{
			$('#addModalfoto').modal('show');
			$('#id_peralatanfoto').val(id_peralatan);
			peralatanfotoTable.ajax.reload();
			setTimeout(function(){ peralatanfotoTable.columns.adjust().draw(); }, 1000);
		}

		var peralatanfotoTable = $('#peralatanfotoTable').DataTable({
			"ordering" : false,
			"scrollX": true,
			"processing": true,
			"serverSide": true,
			ajax: 
			{
				url: "<?= base_url()?>peralatan/list_peralatan/ax_data_list_peralatan_foto/",
				type: 'POST',
				data: function ( d ) {
					return $.extend({}, d, { 
						"id_peralatan": $("#id_peralatanfoto").val(),
					});
				}
			},
			columns: 
			[
			{
				data: "id_peralatan_foto", render: function(data, type, full, meta){
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
					
					{ class:'intro', data: "id_peralatan_foto" },
					{ class:'intro', data: "nm_peralatan_foto" },
					{ data: "attachment", render: function(data, type, full, meta)
					{
						var url = "<?= base_url()?>"+"uploads/peralatan/"+data;
						var op =  "window.open('"+url+"', '_blank');";
						return '<img width="200" height="100" class="attachment-img" onclick="'+op+'" src="'+url+'" alt="No Image">';

					}

				},




				],
			});



			/// attachment
			$('#submit_peralatan_foto').submit(function(e){
				e.preventDefault(); 

				if($('#file_attachment_stnk').val() == ''){
					alertify.alert("Warning", "Please choose Attachment.");
				}
				else
				{
					$.ajax({
						url:'<?php echo base_url();?>peralatan/list_peralatan/ax_upload_data_peralatan_foto',
						type:"post",
						data:new FormData(this),
						processData:false,
						contentType:false,
						cache:false,
						async:false,
					}).done(function(data, textStatus, jqXHR) {
						var data = JSON.parse(data);
						peralatanfotoTable.ajax.reload();
						alertify.success('Attachment Uploaded.');
					});
				}
			});

			function DeleteStnk(id_peralatan_foto)
			{
				alertify.confirm(
					'Confirmation', 
					'Are you sure you want to delete this data?', 
					function(){
						var url = '<?=base_url()?>peralatan/list_peralatan/ax_unset_peralatan_foto';
						var data = {
							id_peralatan_foto: id_peralatan_foto
						};

						$.ajax({
							url: url,
							method: 'POST',
							data: data
						}).done(function(data, textStatus, jqXHR) {
							var data = JSON.parse(data);
							if(data['status'] == "success")
							{
								peralatanfotoTable.ajax.reload();
								alertify.error('STNK Armada Dihapus.');
							}
						});
					},
					function(){ }
					);
			}

		</script>
	</body>
	</html>
