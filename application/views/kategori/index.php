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
				<h1>Kategori Barang</h1>
			</section>
			<section class="invoice">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<button class="btn btn-primary" onclick='ViewData(0)'>
									<i class='fa fa-plus'></i> Add Kategori
								</button>
								<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="Form-add-bu" id="addModalLabel">Form Add kategori</h4>
											</div>
											<div class="modal-body">
												<input type="hidden" id="id_kategori" name="id_kategori" value='' />
												<div class="form-group">
													<label>Name</label>
													<input type="text" id="nm_kategori" name="nm_kategori" class="form-control" placeholder="Name">
												</div>
												<div class="form-group">
													<label>Jenis Kategori</label>
													<select class="form-control select2" style="width: 100%;" id="jns_kategori" name="jns_kategori">
														<option value="1">Habis Pakai</option>
														<option value="2">Tidak Habis Pakai</option>
													</select>
												</div>
												<div class="form-group">
													<label>Active</label>
													<select class="form-control" id="active" name="active">
														<option value="1" <?php echo set_select('myselect', '1', TRUE); ?> >Active</option>
														<option value="0" <?php echo set_select('myselect', '0'); ?> >Not Active</option>
													</select>
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
												<th>Jenis</th>
												<th>Status</th>
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
		var buTable = $('#buTable').DataTable({
			"ordering" : false,
			"scrollX": true,
			"processing": true,
			"serverSide": true,
			ajax: 
			{
				url: "<?= base_url()?>kategori/ax_data_kategori/",
				type: 'POST'
			},
			columns: 
			[
			{
				data: "id_kategori", render: function(data, type, full, meta){
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

			{ data: "id_kategori" },
			{ data: "nm_kategori" },
			{ data: "jns_kategori", render: function(data, type, full, meta){
				if(data == 1){
					return "Habis Pakai";
				}else if(data == 2){
					return "Tidak Habis Pakai";
				}else {
					return "";
				}
			}
		},

		{ data: "active", render: function(data, type, full, meta){
			if(data == 1)
				return "Active";
			else return "Not Active";
		}
	}
	]
});

		$('#btnSave').on('click', function () {
			if($('#nm_kategori').val() == '')
			{
				alertify.alert("Warning", "Please fill kategori Name.");
			}
			else
			{
				var url = '<?=base_url()?>kategori/ax_set_data';
				var data = {
					id_kategori: $('#id_kategori').val(),
					nm_kategori: $('#nm_kategori').val(),
					jns_kategori: $('#jns_kategori').val(),
					active: $('#active').val()
				};

				$.ajax({
					url: url,
					method: 'POST',
					data: data
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

		function ViewData(id_kategori)
		{
			if(id_kategori == 0)
			{
				$('#addModalLabel').html('Add kategori');
				$('#id_kategori').val('');
				$('#nm_kategori').val('');
				$('#jns_kategori').val('1').trigger('change');
				$('#active').val('1');
				$('#addModal').modal('show');
			}
			else
			{
				var url = '<?=base_url()?>kategori/ax_get_data_by_id';
				var data = {
					id_kategori: id_kategori
				};

				$.ajax({
					url: url,
					method: 'POST',
					data: data
				}).done(function(data, textStatus, jqXHR) {
					var data = JSON.parse(data);
					$('#addModalLabel').html('Edit kategori');
					$('#id_kategori').val(data['id_kategori']);
					$('#nm_kategori').val(data['nm_kategori']);
					$('#jns_kategori').val(data['jns_kategori']).trigger('change');
					$('#active').val(data['active']);
					$('#addModal').modal('show');
				});
			}
		}

		function DeleteData(id_kategori)
		{
			alertify.confirm(
				'Confirmation', 
				'Are you sure you want to delete this data?', 
				function(){
					var url = '<?=base_url()?>kategori/ax_unset_data';
					var data = {
						id_kategori: id_kategori
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
	</script>
</body>
</html>