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
				<h1>Daftar Surat Perusahaan</h1>
			</section>
			<section class="invoice">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">

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
									<table class="table table-striped table-bordered table-hover" id="suratTable">
										<thead>
											<tr>
												<th>Options</th>
												<th>#</th>
												<th>Nama Surat</th>
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
	<?= $this->load->view('basic_js'); ?>
	<script type='text/javascript'>

		var suratTable = $('#suratTable').DataTable({
			"ordering" : false,
			"scrollX": true,
			"processing": true,
			"serverSide": true,
			ajax: 
			{
				url: "<?= base_url()?>surat/ax_data_surat/",
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
				data: "id_jenis_surat", render: function(data, type, full, meta){
					var str = '';
					str += '<div class="btn-group">';
					str += '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>';
					str += '<ul class="dropdown-menu">';
					str += '<li><a onClick="ViewData(' + data + ')"><i class="fa fa-list"></i> Detail Surat</a></li>';
					str += '</ul>';
					str += '</div>';
					return str;
				}
			},
			{
				data: "id_jenis_surat",
				render: function(data, type, row, meta) {
					return meta.row + meta.settings._iDisplayStart + 1;
				}
			},
			{ data: "nm_jenis_surat" }
			]
		});

		function ViewData(id_jenis_surat) {
			var id_bu = $("#id_bu_filter").val();
			
			if(id_jenis_surat==2){
				var url = '<?= base_url() ?>surat/pbb/' + id_jenis_surat + '/' + id_bu;
			}else if(id_jenis_surat==3){
				var url = '<?= base_url() ?>surat/hgb/' + id_jenis_surat + '/' + id_bu;
			}else if(id_jenis_surat==4){

			}
			window.location.href = url;
		}




		$( "#tgl_terbit,#tgl_berakhir,#tgl_jatuh_tempo").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd"
		});

		$( "#tgl_terbit,#tgl_berakhir,#tgl_jatuh_tempo" ).inputmask("yyyy-mm-dd",{"placeholder": "yyyy-mm-dd"});
	</script>
</body>
</html>
