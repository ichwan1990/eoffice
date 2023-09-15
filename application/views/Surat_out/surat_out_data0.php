<div class="page-title">
	<div class="title_left">
		<h3>Data Surat Keluar</h3>
	</div>
</div>

<div class="clearfix"></div>

<div class="x_panel">
	<div class="x_title" align="right">
		<a href="<?=site_url('surat_keluar/add')?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Surat Keluar</a>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<table class="table table-bordered" id="data">
			<thead>
				<tr>
					<th>#</th>
					<th>No. Surat<br>Tgl Surat</th>
					<th>Tujuan</th>
					<th>Perihal</th>
					<th>Isi Ringkas<br>File</th>
					<th>Pengolah</th>
					<th>Ket.</th>
					<th><i class="fa fa-gear"></i></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				foreach ($row as $r => $data) { ?>
					<tr>
						<td><?=$no++?>.</td>
						<td><?=$data->no_surat."<hr>".tgl_bln_indo($data->tgl_surat)?></td>
						<td><?=$data->alamat_tujuan?></td>
						<td><?=$data->perihal?></td>
						<td>
							<?php echo $data->isi_ringkas."<hr>";
							if($data->file_surat == '') {
								echo '<b>File</b> : <i>Tidak ada file yang diupload</i>';
							} else {
								echo '<b>File</b> : <a href="./uploads/surat_keluar/'.$data->file_surat.'" target="_blank">Download</a>';
							} ?>
						</td>
						<td>
							<?=$data->pengolah."<br>(".$data->nama_jabatan.")"?>
						</td>
						<td><?=$data->keterangan?></td>
						<td class="text-center">
							<!-- <div> -->
								<a href="<?=site_url('surat_keluar/edit/'.$data->id_surat_out)?>" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
							<!-- </div> -->
							<!-- <div> -->
								<a href="<?=site_url('surat_keluar/del/'.$data->id_surat_out)?>" onclick="return confirm('Apakah Anda yakin?')"  class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
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