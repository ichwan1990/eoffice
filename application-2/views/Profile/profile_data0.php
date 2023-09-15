<div class="page-title">
	<div class="title_left">
		<h3><?=$judul?> Profile</h3>
	</div>
</div>

<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title" align="right">
				<a href="<?=site_url('dashboard')?>" class="btn btn-sm btn-dark"><i class="fa fa-angle-left"></i> Kembali</a>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="col-sm-8 col-sm-offset-2 col-xs-12">
					<table class="table table-bordered">
						<body>
							<tr>
								<th>Nama Lengkap</th>
								<td><?=$row->nama_lengkap?></td>
							</tr>
							<?php if($this->session->userdata('level_user') != '0') { ?>
							<tr>
								<th>NIP</th>
								<td><?=$row->nip?></td>
							</tr>
							<tr>
								<th>Jabatan</th>
								<td><?=$row->nama_jabatan?></td>
							</tr>
							<!-- <tr>
								<th>Level Jabatan</th>
								<td><?=$row->level_jabatan?></td>
							</tr> -->
							<?php } ?>
							<tr>
								<th>Alamat</th>
								<td><?=$row->alamat?></td>
							</tr>
							<tr>
								<th>No. Telp</th>
								<td><?=$row->no_telp?></td>
							</tr>
							<tr>
								<th>Email</th>
								<td><?=$row->email?></td>
							</tr>
							<tr>
								<th>Username</th>
								<td><?=$row->username?></td>
							</tr>
							<tr>
								<th>Password</th>
								<td>*******</td>
							</tr>
						</body>
					</table>
					<!-- <div class="ln_solid"></div> -->
					<div class="pull-right">
						<a href="<?=site_url('profile/edit')?>" class="btn btn-success btn-sm">Edit Profile</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>