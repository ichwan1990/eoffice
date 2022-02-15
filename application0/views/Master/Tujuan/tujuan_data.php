<div class="page-title">
	<div class="title_left">
		<h3>Master Tujuan Surat Keluar</h3>
	</div>
</div>

<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title" align="right">
				<a href="<?=site_url('tujuan_surat/add')?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Tujuan</a>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table class="table table-bordered" id="data">
					<thead>
						<tr>
							<th>#</th>
							<th>Alamat Tujuan</th>
							<th>Uraian</th>
							<th><i class="fa fa-gear"></i></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($row as $r => $data) { ?>
							<tr>
								<td><?=$no++?>.</td>
								<td><?=$data->alamat_tujuan?></td>
								<td><?=$data->uraian?></td>
								<td class="text-center">
									<!-- <div> -->
										<a href="<?=site_url('tujuan_surat/edit/'.$data->id_tujuan)?>" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
									<!-- </div> -->
									<!-- <div> -->
										<a href="<?=site_url('tujuan_surat/del/'.$data->id_tujuan)?>" onclick="return confirm('Apakah Anda yakin?')"  class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
									<!-- </div> -->
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