<!DOCTYPE html>
<html>
<head>
	<?= $this->load->view('head'); ?>
</head>
<style>
	.margin-bottom {
		margin-bottom:-30px;
	}
	.select2 {
		margin-bottom:-30px;
	}
</style>
<body class="sidebar-mini wysihtml5-supported <?= $this->config->item('color')?>">
	<div class="wrapper">
		<?= $this->load->view('nav'); ?>
		<?= $this->load->view('menu_groups'); ?>
		<div class="content-wrapper">
			<section class="content-header">
				<h1>Surat - PBB (Pajak Bumi dan Bangunan)</h1>
			</section>
			<section class="invoice">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<button type="button" class="btn bg-purple btn-default" onClick='Kembali()'><i class="fa  fa-arrow-circle-left"></i> Kembali</button>

								<button class="btn btn-primary pull-right" onclick='ViewData(0)'>
									<i class='fa fa-plus'></i> Add Surat - PBB
								</button>
								<div class="modal fade" id="addModal" tabindex="" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="Form-add-bu" id="addModalLabel">Form Add Surat - PBB</h4>
											</div>

											<form action="#" id="form" role="form">
												<div class="modal-body">
													<input type="hidden" id="id_surat_pbb" name="id_surat_pbb" value='' />

													<input type="hidden" id="id_jenis_surat_filter" name="id_jenis_surat_filter" value='<?=$id_jenis_surat_filter;?>'/>

													<input type="hidden" id="id_bu_filter" name="id_bu_filter" value='<?=$id_bu_filter;?>'/>

													<div class="row">
														<div class="col-lg-6">
															<div class="form-group">
																<label>Tahun</label>
																<input type="number" id="tahun" name="tahun" class="form-control" placeholder="Tahun">
															</div>
															<div class="form-group">
																<label>Nama Wajib Pajak</label>
																<input type="text" id="nama_wp" name="nama_wp" class="form-control" placeholder="Nama Wajib Pajak">
															</div>
															<div class="form-group">
																<label>Alamat Wajib Pajak</label>
																<input type="text" id="alamat_wp" name="alamat_wp" class="form-control" placeholder="Alamat Wajib Pajak">
															</div>
															<div class="form-group">
																<label>Objek Pajak</label>
																<select class="form-control" id="objek_pajak" name="objek_pajak">
																	<option value="1">Bumi/Tanah</option>
																	<option value="2">Bumi/Tanah dan Bangunan</option>
																</select>
															</div>

															<div class="form-group">
																<label>Lokasi Objek Pajak</label>
																<input type="text" id="lokasi_objek_pajak" name="lokasi_objek_pajak" class="form-control" placeholder="Lokasi Objek Pajak">
															</div>

															<div class="form-group">
																<label>Luas Tanah</label>
																<input type="number" id="luas_tanah" name="luas_tanah" class="form-control" placeholder="Luas Tanah">
															</div>
															<div class="form-group">
																<label>Luas Bangunan</label>
																<input type="number" id="luas_bangunan" name="luas_bangunan" class="form-control" placeholder="Luas Bangunan">
															</div>

															
														</div>

														<div class="col-lg-6">
															<div class="form-group">
																<label>NJOP Tanah</label>
																<input type="number" id="njop_tanah" name="njop_tanah" class="form-control" placeholder="NJOP Tanah">
															</div>
															<div class="form-group">
																<label>NJOP Bangunan</label>
																<input type="number" id="njop_bangunan" name="njop_bangunan" class="form-control" placeholder="NJOP Bangunan">
															</div>
															<div class="form-group">
																<label>Total NJOP</label>
																<input type="number" id="total_njop" name="total_njop" class="form-control" placeholder="Total NJOP">
															</div>
															<div class="form-group">
																<label>NJOP Tidak Kena Pajak</label>
																<input type="number" id="njop_tidak_kena_pajak" name="njop_tidak_kena_pajak" class="form-control" placeholder="NJOP Tidak Kena Pajak">
															</div>
															<div class="form-group">
																<label>NJOP Perhitungan PBB</label>
																<input type="number" id="njop_pbb" name="njop_pbb" class="form-control" placeholder="NJOP PBB">
															</div>
															<div class="form-group">
																<label>PBB Terhutang</label>
																<input type="number" id="pbb_terhutang" name="pbb_terhutang" class="form-control" placeholder="PBB Terhutang">
															</div>
															<div class="form-group">
																<label>Tanggal Pembayaran</label>
																<input type="text" id="tgl_pembayaran" name="tgl_pembayaran" class="form-control" placeholder="Tanggal Pembayaran">
															</div>
															<div class="form-group">
																<label>Active</label>
																<select class="form-control" id="active" name="active">
																	<option value="1" <?php echo set_select('myselect', '1', TRUE); ?> >Active</option>
																	<option value="0" <?php echo set_select('myselect', '0'); ?> >Not Active</option>
																</select>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="box box-primary">
																<div class="box-header with-border">
																	<h3 class="box-title">Attachment</h3>
																	<div class="box-tools pull-right">
																		<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
																	</div>
																</div>
																<div class="box-body">
																	<div class="row attachment">
																		<div class="box-body" id="coba1">
																			<div class="form-group col-md-5" >
																				<input class="form-control margin-bottom"  id="nm_file1" placeholder="Nama Attachment:">
																			</div>
																			<div class="form-group col-md-3" >
																				<input type="file" id="file_attachment1" class="form-control">
																				<input type="hidden" id="nm_attachment1" class="form-control">
																			</div>
																			<div id="btnattachment">
																				<input type="button" class="btn btn-success " id="addattachment" value="+" />
																			</div>
																		</div>
																	</div>
																</div>
															</div><!-- /. box -->
														</div><!-- /.col -->
													</div><!-- /.row -->
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<button type="button" class="btn btn-primary" id='btnSave'>Save</button>
												</div>
											</form>

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
												<th>Cabang</th>
												<th>Tahun</th>
												<th>Nama WP</th>
												<th>Alamat WP</th>
												<th>Objek Pajak</th>
												<th>Lokasi Objek</th>
												<th>Luas Tanah</th>
												<th>Luas Bangunan</th>
												<th>NJOP Tanah</th>
												<th>NJOP Bangunan</th>
												<th>Total NJOP</th>
												<th>NJOP Tidak Kena Pajak</th>
												<th>NJOP Perhitungan PBB</th>
												<th>PBB Terhutang</th>
												<th>Tanggal Pembayaran</th>
												<th>Active</th> 
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


	<div class="modal fade" id="addModalEdit" tabindex="" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="Form-add-bu" id="addModalLabelEdit">Form Edit Surat - PBB</h4>
				</div>

				<form action="#" id="formEdit" role="form">
					<div class="modal-body">
						<input type="hidden" id="id_surat_pbb_" name="id_surat_pbb_" value='' />

						<input type="hidden" id="id_jenis_surat_filter_" name="id_jenis_surat_filter_" value='<?=$id_jenis_surat_filter;?>'/>

						<input type="hidden" id="id_bu_filter_" name="id_bu_filter_" value='<?=$id_bu_filter;?>'/>

						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label>Tahun</label>
									<input type="number" id="tahun_" name="tahun_" class="form-control" placeholder="Tahun">
								</div>
								<div class="form-group">
									<label>Nama Wajib Pajak</label>
									<input type="text" id="nama_wp_" name="nama_wp_" class="form-control" placeholder="Nama Wajib Pajak">
								</div>
								<div class="form-group">
									<label>Alamat Wajib Pajak</label>
									<input type="text" id="alamat_wp_" name="alamat_wp_" class="form-control" placeholder="Alamat Wajib Pajak">
								</div>
								<div class="form-group">
									<label>Objek Pajak</label>
									<select class="form-control" id="objek_pajak_" name="objek_pajak_">
										<option value="1">Bumi/Tanah</option>
										<option value="2">Bumi/Tanah dan Bangunan</option>
									</select>
								</div>

								<div class="form-group">
									<label>Lokasi Objek Pajak</label>
									<input type="text" id="lokasi_objek_pajak_" name="lokasi_objek_pajak_" class="form-control" placeholder="Lokasi Objek Pajak">
								</div>

								<div class="form-group">
									<label>Luas Tanah</label>
									<input type="number" id="luas_tanah_" name="luas_tanah_" class="form-control" placeholder="Luas Tanah">
								</div>
								<div class="form-group">
									<label>Luas Bangunan</label>
									<input type="number" id="luas_bangunan_" name="luas_bangunan_" class="form-control" placeholder="Luas Bangunan">
								</div>


							</div>

							<div class="col-lg-6">
								<div class="form-group">
									<label>NJOP Tanah</label>
									<input type="number" id="njop_tanah_" name="njop_tanah_" class="form-control" placeholder="NJOP Tanah">
								</div>
								<div class="form-group">
									<label>NJOP Bangunan</label>
									<input type="number" id="njop_bangunan_" name="njop_bangunan_" class="form-control" placeholder="NJOP Bangunan">
								</div>
								<div class="form-group">
									<label>Total NJOP</label>
									<input type="number" id="total_njop_" name="total_njop_" class="form-control" placeholder="Total NJOP">
								</div>
								<div class="form-group">
									<label>NJOP Tidak Kena Pajak</label>
									<input type="number" id="njop_tidak_kena_pajak_" name="njop_tidak_kena_pajak_" class="form-control" placeholder="NJOP Tidak Kena Pajak">
								</div>
								<div class="form-group">
									<label>NJOP Perhitungan PBB</label>
									<input type="number" id="njop_pbb_" name="njop_pbb_" class="form-control" placeholder="NJOP PBB">
								</div>
								<div class="form-group">
									<label>PBB Terhutang</label>
									<input type="number" id="pbb_terhutang_" name="pbb_terhutang_" class="form-control" placeholder="PBB Terhutang">
								</div>
								<div class="form-group">
									<label>Tanggal Pembayaran</label>
									<input type="text" id="tgl_pembayaran_" name="tgl_pembayaran_" class="form-control" placeholder="Tanggal Pembayaran">
								</div>
								<div class="form-group">
									<label>Active</label>
									<select class="form-control" id="active_" name="active_">
										<option value="1" <?php echo set_select('myselect', '1', TRUE); ?> >Active</option>
										<option value="0" <?php echo set_select('myselect', '0'); ?> >Not Active</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-success" id='btnSaveEdit'>Save</button>
					</div>
				</form>

				<div class="row">
					<div class="col-md-12">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Attachment</h3>
								<div class="box-tools pull-right">
									<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div class="col-lg-12">
									

									
									<div class="row">
										<form id="submit">
											<input type="hidden" id="id_surat_pbb_attachment" name="id_surat_pbb_attachment" value='' />
											<div class="form-group col-lg-3">
												<label>Nama Attachment</label>
												<input type="text" id="nm_Attachment_edit" name="nm_Attachment_edit" class="form-control" placeholder="Nama Attachment">
											</div>
											<div class="form-group col-lg-6">
												<label>Attachment</label>
												<input type="file" name="file" id="attachment_edit" class="form-control"
												accept=".jpg,.jpeg,.pdf,.docx,.doc,.xlsx,.xls,.pptx,.ppt,.png">
												<p class="help-block">Upload File. Size Max: 2MB </p>
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
													<th>Nama Attachment</th>
													<th>Attachment</th>
												</tr>
											</thead>
										</table>
									</div>

								</div>
							</div><!-- /. box -->
						</div><!-- /.col -->
					</div><!-- /.row -->

				</div>
			</div>
		</div>

		<div class="modal fade bs-modal-sm" id="loading" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<center>
						<img src="<?php echo base_url();?>assets/loader.gif"/>
						<p id="">Sedang Mengupload File</p>
					</center>
				</div>
			</div>
		</div>

		<?= $this->load->view('basic_js'); ?>
		<script type='text/javascript'>

			counteratt = 1;

			$(document).ready(function() {

				// $('#tahun,#tahun_').datepicker({
				// 	changeYear: true,
				// 	showButtonPanel: true,
				// 	dateFormat: 'yy',
				// 	onClose: function(dateText, inst) { 
				// 		var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
				// 		$(this).datepicker('setDate', new Date(year, 1));
				// 	}
				// });
				// $("#tahun,#tahun_").focus(function () {
				// 	$(".ui-datepicker-month").hide();
				// 	$(".ui-datepicker-calendar").hide();
				// });

				$( "#tgl_pembayaran,#tgl_pembayaran_").datepicker({
					changeMonth: true,
					changeYear: true,
					dateFormat: "yy-mm-dd"
				});

				$( "#tgl_pembayaran,#tgl_pembayaran_" ).inputmask("yyyy-mm-dd",{"placeholder": "yyyy-mm-dd"});



				$("#file_attachment"+counteratt).change(function (objEvent) {
					$('#loading').modal({backdrop: 'static'});
					$('#addattachment').attr('disabled',true);

					if($('#tahun').val() == ''){
						$('#btnSave').attr('disabled',true);
					}else{
						$('#btnSave').attr('disabled',false);
					}

					setTimeout(function(){ $('#addattachment').attr('disabled',false); }, 3000);
					var objFormData = new FormData();
					var objFile = $(this)[0].files[0];
					objFormData.append('file_attachment', objFile);
					$.ajax({
						url:'<?php echo base_url();?>surat/ax_upload_surat',
						type: 'POST',
						contentType: false,
						data: objFormData,
						processData: false,
						success: function (data) {
							var data = JSON.parse(data);
							if(data.status == "success"){
								var enkripname = data['data'].attachment
								$("#nm_attachment"+counteratt).val(enkripname);
								$('#addattachment').attr('disabled',false);
								setTimeout(function(){ $('#btnSave').attr('disabled',false); }, 5000);
								setTimeout(function(){$('#loading').modal('hide')},500);
							}else{
								setTimeout(function() { $('#loading').modal('hide'); alert("Gagal upload! Cek Ukuran file dan koneksi internet."); }, 5000);
								return false;
							}
						},
						error: function (xhr, ajaxOptions, thrownError) {
							alert("File gagal terupload!");
						}
					});
				});


				$("#addattachment").on("click", function () {
					counteratt++;

					var newRow = $("<div class='box-body' id='coba"+counteratt+"' >");
					var cols = "";
					cols += '';
					cols += "<div class='form-group col-md-5' ><input class='form-control margin-bottom' id='nm_file"+counteratt+"' placeholder='Nama Attachment:'></div><div class='form-group col-md-3' ><input type='file' id='file_attachment"+counteratt+"' class='form-control'><input type='hidden' id='nm_attachment"+counteratt+"' class='form-control'></div><input type='button' class='btndel btn btn-md btn-danger' value='-' />";
					newRow.append(cols);
					$(".attachment").append(newRow);

					$("#file_attachment"+counteratt).change(function (objEvent) {
						$('#loading').modal({backdrop: 'static'});
						var objFormData = new FormData();
						var objFile = $(this)[0].files[0];
						objFormData.append('file_attachment', objFile);
						$.ajax({
							url:'<?php echo base_url();?>surat/ax_upload_surat',
							type: 'POST',
							contentType: false,
							data: objFormData,
							processData: false,
							success: function (data) {
								var data = JSON.parse(data);
								var enkripname = data['data'].attachment;
								$("#nm_attachment"+counteratt).val(enkripname);
								setTimeout(function(){$('#loading').modal('hide')},500);
							},
							error: function (xhr, ajaxOptions, thrownError) {
								alert("File gagal terupload! cek ukuran file atau koneksi internet");
								setTimeout(function(){$('#loading').modal('hide')},500);
							}
						});
					});

					$(".btndel").on("click", function (event) {
						$(this).closest("div").remove();       
						counteratt--;
					});
				});


			});

			function removeOptions(selectbox){
				var i;
				for(i = selectbox.options.length - 1 ; i >= 0 ; i--)
				{
					selectbox.remove(i);
				}
			}


			var buTable = $('#buTable').DataTable({
				"ordering" : false,
				"scrollX": true,
				"processing": true,
				"serverSide": true,
				ajax: 
				{
					url: "<?= base_url()?>surat/ax_data_surat_pbb/",
					type: 'POST',
					data: function ( d ) {
						return $.extend({}, d, { 
							"id_jenis_surat": $("#id_jenis_surat_filter").val(),
							"id_bu": $("#id_bu_filter").val()
						});
					}
				},
				columns: 
				[
				{
					data: "id_surat_pbb", render: function(data, type, full, meta){
						var str = '';
						str += '<div class="btn-group">';
						str += '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>';
						str += '<ul class="dropdown-menu">';
						str += '<li><a onclick="ViewData(' + data + ')"><i class="fa fa-pencil"></i> Edit</a></li>';
						str += '<li><a onClick="DeleteData(' + data + ')"><i class="fa fa-trash"></i> Delete</a></li>';
						str += '</ul>';
						str += '</div>';
						return str;
					}
				},
				{ data: "id_surat_pbb" },
				{ data: "nm_bu" },
				{ data: "tahun" },
				{ data: "nama_wp" },
				{ data: "alamat_wp" },

				{ data: "objek_pajak", render: function(data, type, full, meta){
					if(data == 1)
						return "Bumi/Tanah";
					else return "Bumi/Tanah dan Bangunan";
				}},

				{ data: "lokasi_objek_pajak" },
				{ data: "luas_tanah" },
				{ data: "luas_bangunan" },
				{ data: "njop_tanah" },
				{ data: "njop_bangunan" },
				{ data: "total_njop" },
				{ data: "njop_tidak_kena_pajak" },
				{ data: "njop_pbb" },
				{ data: "pbb_terhutang" },
				{ data: "tgl_pembayaran" },
				{ data: "active", render: function(data, type, full, meta){
					if(data == 1)
						return "Active";
					else return "Not Active";
				}}
				]
			});


			var attachmentTable = $('#attachmentTable').DataTable({
				"ordering" : false,
				"scrollX": true,
				"processing": true,
				"serverSide": true,
				ajax: 
				{
					url: "<?= base_url()?>surat/ax_data_surat_pbb_attachment/",
					type: 'POST',
					data: function ( d ) {
						return $.extend({}, d, { 

							"id_surat_pbb": $("#id_surat_pbb_").val(),

						});
					}
				},
				columns: 
				[
				{
					data: "id_surat_attachment", render: function(data, type, full, meta){
						var str = '';
						var id1 = "'"+data+"','"+full['attachment']+"'";

						var str = '<div class="btn-group">';
						str += '<a type="button" class="btn btn-sm btn-danger" title="Delete Data" onClick="DeletePbb(' + id1 + ')"><i class="fa fa-trash"></i> </a>';
						str += '</div>';

						return str;
					}
				},

				{ class:'intro', data: "id_surat_attachment" },
				{ data: "nm_attachment" },
				{ data: "attachment", render: function(data, type, full, meta)
				{
					var str = '';
					str += '<div class="btn-group">';
					str += '<a href="<?= base_url()?>uploads/surat/'+data+'" target="_blank"><i class="fa fa-download"></i> '+full['nm_attachment']+'</a>';
					str += '</div>';
					return str;

				}

			},




			],
		});


			$('#btnSave').on('click', function () {

				if($('#tahun').val() == '')
				{
					alertify.alert("Warning", "Tahun tidak boleh kosong.");
				}else if($('#nama_wp').val() == '')
				{
					alertify.alert("Warning", "Nama Wajib Pajak tidak boleh kosong.");
				}else if($('#alamat_wp').val() == '')
				{
					alertify.alert("Warning", "Alamat Wajib Pajak tidak boleh kosong.");
				}else if($('#objek_pajak').val() == '0')
				{
					alertify.alert("Warning", "Pilih Objek Pajak.");
				}else if($('#lokasi_objek_pajak').val() == '')
				{
					alertify.alert("Warning", "Lokasi Objek Pajak tidak boleh kosong.");
				}else if($('#luas_tanah').val() == '')
				{
					alertify.alert("Warning", "Luas Tanah tidak boleh kosong.");
				}else if($('#luas_bangunan').val() == '')
				{
					alertify.alert("Warning", "Luas Bangunan tidak boleh kosong.");
				}else if($('#njop_tanah').val() == '')
				{
					alertify.alert("Warning", "NJOP Tanah tidak boleh kosong.");
				}else if($('#njop_bangunan').val() == '')
				{
					alertify.alert("Warning", "NJOP Bangunan tidak boleh kosong.");
				}else if($('#total_njop').val() == '')
				{
					alertify.alert("Warning", "Total NJOP tidak boleh kosong.");
				}else if($('#njop_tidak_kena_pajak').val() == '')
				{
					alertify.alert("Warning", "NJOP Tidak Kena Pajak tidak boleh kosong.");
				}else if($('#njop_pbb').val() == '')
				{
					alertify.alert("Warning", "NJOP Perhitungan PBB tidak boleh kosong.");
				}else if($('#pbb_terhutang').val() == '')
				{
					alertify.alert("Warning", "PBB terhutang tidak boleh kosong.");
				}else if($('#tgl_pembayaran').val() == '')
				{
					alertify.alert("Warning", "Tanggal Pembayaran tidak boleh kosong.");
				}
				else
				{
					var url = '<?=base_url()?>surat/ax_set_data_surat_pbb';

					var data_save = $('#form').serializeArray();

					totdoc = new Array();
					for (let indexdoc = 1; indexdoc <= counteratt; indexdoc++) {

						var tampdoc = [
						$("#nm_file"+indexdoc).val(),
						]
						totdoc.push(tampdoc);
					}

					totnmdoc = new Array();
					for (let indexdoc = 1; indexdoc <= counteratt; indexdoc++) {

						var tampnmdoc = [
						$("#nm_attachment"+indexdoc).val(),
						]
						totnmdoc.push(tampnmdoc);
					}

					data_save.push({ name: "jmlfile", value: counteratt });
					data_save.push({ name: "nm_file", value: totdoc });
					data_save.push({ name: "nm_attach", value: totnmdoc });

					$.ajax({
						url: url,
						method: 'POST',
						data: data_save
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


			$('#btnSaveEdit').on('click', function () {

				if($('#tahun_').val() == '')
				{
					alertify.alert("Warning", "Tahun tidak boleh kosong.");
				}else if($('#nama_wp_').val() == '')
				{
					alertify.alert("Warning", "Nama Wajib Pajak tidak boleh kosong.");
				}else if($('#alamat_wp_').val() == '')
				{
					alertify.alert("Warning", "Alamat Wajib Pajak tidak boleh kosong.");
				}else if($('#objek_pajak_').val() == '0')
				{
					alertify.alert("Warning", "Pilih Objek Pajak.");
				}else if($('#lokasi_objek_pajak_').val() == '')
				{
					alertify.alert("Warning", "Lokasi Objek Pajak tidak boleh kosong.");
				}else if($('#luas_tanah__').val() == '')
				{
					alertify.alert("Warning", "Luas Tanah tidak boleh kosong.");
				}else if($('#luas_bangunan__').val() == '')
				{
					alertify.alert("Warning", "Luas Bangunan tidak boleh kosong.");
				}else if($('#njop_tanah_').val() == '')
				{
					alertify.alert("Warning", "NJOP Tanah tidak boleh kosong.");
				}else if($('#njop_bangunan_').val() == '')
				{
					alertify.alert("Warning", "NJOP Bangunan tidak boleh kosong.");
				}else if($('#total_njop_').val() == '')
				{
					alertify.alert("Warning", "Total NJOP tidak boleh kosong.");
				}else if($('#njop_tidak_kena_pajak_').val() == '')
				{
					alertify.alert("Warning", "NJOP Tidak Kena Pajak tidak boleh kosong.");
				}else if($('#njop_pbb_').val() == '')
				{
					alertify.alert("Warning", "NJOP Perhitungan PBB tidak boleh kosong.");
				}else if($('#pbb_terhutang_').val() == '')
				{
					alertify.alert("Warning", "PBB terhutang tidak boleh kosong.");
				}else if($('#tgl_pembayaran_').val() == '')
				{
					alertify.alert("Warning", "Tanggal Pembayaran tidak boleh kosong.");
				}
				else
				{
					var url = '<?=base_url()?>surat/ax_set_data_surat_pbb_edit';

					var data_save = $('#formEdit').serializeArray();

					$.ajax({
						url: url,
						method: 'POST',
						data: data_save
					}).done(function(data, textStatus, jqXHR) {
						var data = JSON.parse(data);
						if(data['status'] == "success")
						{
							alertify.success("Data Saved.");
							$('#addModalEdit').modal('hide');
							buTable.ajax.reload();
						}
					});
				}
			});


			function ViewData(id_surat_pbb)
			{
				if(id_surat_pbb == 0)
				{

					for (var i = 2; i <= counteratt; i++) {
						$('#coba'+[i]+'').closest("div").remove();
					}

					counteratt = 1;

					$('#addModalLabel').html('Add Surat - PBB (Pajak Bumi dan Bangunan)');
					$('#form')[0].reset();
					$('#active').val('1');
					$('#addModal').modal('show');
				}
				else
				{
					var url = '<?=base_url()?>surat/ax_get_data_by_id_surat_pbb';
					var data = {
						id_surat_pbb: id_surat_pbb
					};

					$.ajax({
						url: url,
						method: 'POST',
						data: data
					}).done(function(data, textStatus, jqXHR) {
						var data = JSON.parse(data);
						$('#addModalLabelEdit').html('Edit Surat - PBB (Pajak Bumi dan Bangunan)');
						$('#id_surat_pbb_').val(data['id_surat_pbb']);

						$('#id_surat_pbb_attachment').val(data['id_surat_pbb']);
						
						$('#tahun_').val(data['tahun']);

						$('#nama_wp_').val(data['nama_wp']);
						$('#alamat_wp_').val(data['alamat_wp']);
						$('#objek_pajak_').val(data['objek_pajak']);
						$('#lokasi_objek_pajak_').val(data['lokasi_objek_pajak']);
						$('#luas_tanah_').val(data['luas_tanah']);
						$('#luas_bangunan_').val(data['luas_bangunan']);
						$('#njop_tanah_').val(data['njop_tanah']);

						$('#njop_bangunan_').val(data['njop_bangunan']);
						$('#total_njop_').val(data['total_njop']);
						$('#njop_tidak_kena_pajak_').val(data['njop_tidak_kena_pajak']);
						$('#njop_pbb_').val(data['njop_pbb']);
						$('#pbb_terhutang_').val(data['pbb_terhutang']);
						$('#tgl_pembayaran_').val(data['tgl_pembayaran']);
						$('#active_').val(data['active']);

						$('#addModalEdit').modal('show');
						attachmentTable.ajax.reload();
						setTimeout(function(){ attachmentTable.columns.adjust().draw(); }, 1000);
					});
				}
			}

			function DeleteData(id_surat_pbb)
			{
				alertify.confirm(
					'Confirmation', 
					'Are you sure you want to delete this data?', 
					function(){
						var url = '<?=base_url()?>surat/ax_unset_data_surat_pbb';
						var data = {
							id_surat_pbb: id_surat_pbb
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

			$('#submit').submit(function(e){
				e.preventDefault(); 

				if($('#nm_Attachment_edit').val() == '')
				{
					alertify.alert("Warning", "Please fill Nama Attachment.");
				}
				else if($('#attachment_edit').val() == ''){
					alertify.alert("Warning", "Please choose Attachment.");
				}
				else
				{
					$.ajax({
						url:'<?php echo base_url();?>surat/ax_upload_data_attachment_pbb',
						type:"post",
						data:new FormData(this),
						processData:false,
						contentType:false,
						cache:false,
						async:false,
					}).done(function(data, textStatus, jqXHR) {
						var data = JSON.parse(data);
						attachmentTable.ajax.reload();
						$('#nm_Attachment_edit').val('');
						$('#attachment').val('');
						alertify.success('Attachment Uploaded.');
					});
				}
			});

			function DeletePbb(id_surat_attachment,attachment)
			{
				alertify.confirm(
					'Confirmation', 
					'Are you sure you want to delete this data?', 
					function(){
						var url = '<?=base_url()?>surat/ax_unset_data_surat_pbb_attachment';
						var data = {
							id_surat_attachment: id_surat_attachment,
							attachment: attachment
						};

						$.ajax({
							url: url,
							method: 'POST',
							data: data
						}).done(function(data, textStatus, jqXHR) {
							var data = JSON.parse(data);
							attachmentTable.ajax.reload();
							alertify.error('Data deleted.');
						});
					},
					function(){ }
					);
			}

			function Kembali() {
				window.history.back();
			}

		</script>
	</body>
	</html>
