<div class="page-title">
	<div class="title_left">
		<h3>Master Jabatan Pegawai</h3>
	</div>
</div>

<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title" align="right">
				<a href="<?=site_url('jabatan/add')?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Jabatan</a>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table class="table table-bordered" id="data">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama Jabatan</th>
							<th>Kode</th>
							<th>Level</th>
							<th>Atasan</th>
							<th><i class="fa fa-gear"></i></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($row as $r => $data) { ?>
							<tr>
								<td><?=$no++?>.</td>
								<td><?=$data->nama_jabatan?></td>
								<td><?=$data->kode_surat?></td>
								<td>
									<span class="label label-default">
										<?php if($data->level_jabatan == '1') {
											echo "Level 0";
										} else if($data->level_jabatan == '2') {
											echo "Level 1";
										} else if($data->level_jabatan == '3') {
											echo "Level 2";
										} else if($data->level_jabatan == '4') {
											echo "Level 3";
										} else if($data->level_jabatan == '5') {
											echo "Level 4";
										} ?>
									</span>
								</td>
								<td>
									<?php if($data->parent_jabatan != '0') {
										$jbt = $this->jabatan->get2($data->parent_jabatan)->row();
										echo $jbt->nama_jabatan;
									} ?>	
								</td>
								<td class="text-center">
										<a href="<?=site_url('jabatan/edit/'.$data->id_jabatan)?>" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
									<?php if($data->nama_jabatan != '-' && $data->uraian != '(tidak ada jabatan)') { ?>
										<a href="<?=site_url('jabatan/del/'.$data->id_jabatan)?>" onclick="return confirm('Apakah Anda yakin?')"  class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
									<?php } ?>
					            </td>
							</tr>
						<?php } ?>
					</tbody>
				</table> 
				<script type="text/javascript">
					$('#data').DataTable();
				</script>
			</div>
		</div>
	</div>
</div>