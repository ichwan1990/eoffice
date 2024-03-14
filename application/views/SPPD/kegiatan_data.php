<div class="page-title">
	<div class="title_left">
		<h3>Data Master Kegiatan DPA</h3>
	</div>
</div>
<div class="clearfix"></div>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title" align="right">
				<a href="<?=site_url('sppd/kegiatan/add')?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table class="table table-bordered" id="data">
					<thead>
						<tr>
							<th>#</th>
                            <th>Kode Rek. Kegiatan</th>
                            <th>Nama Kegiatan</th>
							<th>Nama PPTK</th>
                            <th>Nama Bendahara</th>
							<th>Jumlah Anggaran</th>
							<th><i class="fa fa-gear"></i></th>
						</tr>
					</thead>
					<tbody>
						<?php
                        $no = 1;
                        foreach ($row->result() as $r => $data) { ?>
                            <tr>
                                <td><?=$no++?>.</td>
                                <td><?=$data->kode_rek?></td>
                                <td><?=$data->nama_keg?></td>
                                <td><?=$data->nama1."<br><i>".$data->jabatan1."</i>"?></td>
								<td><?=$data->nama2."<br><i>".$data->jabatan2."</i>"?></td>
                                <td><?="Rp ".number_format($data->jumlah_anggaran,2,',','.')?></td>
                                <td class="text-center">
                                    <a href="<?=site_url('sppd/kegiatan/edit/'.$data->id_keg)?>" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="<?=site_url('sppd/kegiatan/del/'.$data->id_keg)?>" onclick="return confirm('Apakah Anda yakin?')"  class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
					</tbody>
				</table>
				<script type="text/javascript">
					$('#data').DataTable();
				</script>
			</div>
		</div>
	</div>
</div>