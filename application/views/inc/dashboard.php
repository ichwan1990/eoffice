<div class="row">
	<?php
	$CI = &get_instance();
	$CI->load->model('surat_in_m');
	$CI->load->model('disposisi_m');
	if ($this->session->userdata('level_user') == '2') {
		$in = $CI->surat_in_m->get();
	} else {
		$in = $CI->surat_in_m->get2();
	}
	$jml = 0;
	foreach ($in->result() as $r => $d) {
		if ($CI->disposisi_m->cek_ada_disposisi($d->id_surat_in)->num_rows() == 0) {
			$jml = $jml + 1;
			echo $jml;
		}
	}
	?>

	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="tile-stats">
			<div class="icon"><i class="fa fa-inbox"></i></div>
			<?php
			if ($this->session->userdata('level_user') == '0' || $this->session->userdata('level_user') == '1' || $this->session->userdata('level_user') == '2') {
				$count_surat = $surat_masuk;
			} else {
				$count_surat = $this->surat_in->get3()->num_rows();
			} ?>
			<div class="count"><?= $count_surat ?></div>
			<h3><a href="<?= site_url('surat_masuk') ?>">Surat Masuk</a></h3>
			<p>Total</p>
		</div>
	</div>
	<?php if ($this->session->userdata('level_user') != '0') { ?>
		<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="tile-stats">
				<div class="icon"><i class="fa fa-download"></i></div>
				<?php $count_bln_ini = $this->surat_in->get4()->num_rows(); ?>
				<div class="count"><?= $count_bln_ini ?></div>
				<h3><a href="<?= site_url('surat_masuk?s=b') ?>">Surat Masuk</a></h3>
				<p>Bulan Ini</p>
			</div>
		</div>
	<?php } ?>
	<?php if ($this->session->userdata('level_user') != '0') { ?>
		<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="tile-stats">
				<div class="icon"><i class="fa fa-envelope"></i></div>
				<div class="count"><?= $jml ?></div>
				<h3><a href="<?= site_url('surat_masuk?s=n') ?>">Surat Masuk</a></h3>
				<p>Belum Disposisi</p>
			</div>
		</div>
	<?php } ?>
	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden">
		<div class="tile-stats">
			<div class="icon"><i class="fa fa-envelope-o"></i></div>
			<div class="count"><?= $surat_keluar ?></div>
			<h3>Surat Keluar</h3>
			<p>Total</p>
		</div>
	</div>
	<?php
	if ($this->session->userdata('level_user') == '0' || $this->session->userdata('level_user') == '1' || $this->session->userdata('level_user') == '2') {
	?>
		<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="tile-stats">
				<div class="icon"><i class="fa fa-calendar"></i></div>
				<div class="count"><?= $agenda ?></div>
				<h3><a href="<?= site_url('agenda') ?>">Agenda</a></h3>
				<p>Total</p>
			</div>
		</div>
	<?php } ?>

	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden">
		<div class="tile-stats">
			<div class="icon"><i class="fa fa-briefcase"></i></div>
			<div class="count"><?= $sppd ?></div>
			<h3>SPPD</h3>
			<p>Total</p>
		</div>
	</div>
</div>
<br />
<div>
	Selamat datang di aplikasi <b>Surat Menyurat dan Disposisi</b> - RSU Muslimat Ponorogo
</div>

<div class="panel panel-primary">
	<div class="panel-heading">Panel heading without title</div>
	<div class="panel-body">

		<div style="width: 75%;">
			<canvas id="canvas"></canvas>
		</div>
		<button id="randomizeData">Randomize Data</button>
		<button id="addDataset">Add Dataset</button>
		<button id="removeDataset">Remove Dataset</button>
		<button id="addData">Add Data</button>
		<button id="removeData">Remove Data</button>

	</div>
</div>
<script>
	var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
	var color = Chart.helpers.color;
	var barChartData = {
		labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
		datasets: [{
			label: 'Dataset 1',
			backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
			borderColor: window.chartColors.red,
			borderWidth: 1,
			data: [
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor()
			]
		}, {
			label: 'Dataset 2',
			backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
			borderColor: window.chartColors.blue,
			borderWidth: 1,
			data: [
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor()
			]
		}]

	};

	window.onload = function() {
		var ctx = document.getElementById('canvas').getContext('2d');
		window.myBar = new Chart(ctx, {
			type: 'bar',
			data: barChartData,
			options: {
				responsive: true,
				legend: {
					position: 'top',
				},
				title: {
					display: true,
					text: 'Chart.js Bar Chart'
				}
			}
		});

	};

	document.getElementById('randomizeData').addEventListener('click', function() {
		var zero = Math.random() < 0.2 ? true : false;
		barChartData.datasets.forEach(function(dataset) {
			dataset.data = dataset.data.map(function() {
				return zero ? 0.0 : randomScalingFactor();
			});

		});
		window.myBar.update();
	});

	var colorNames = Object.keys(window.chartColors);
	document.getElementById('addDataset').addEventListener('click', function() {
		var colorName = colorNames[barChartData.datasets.length % colorNames.length];
		var dsColor = window.chartColors[colorName];
		var newDataset = {
			label: 'Dataset ' + barChartData.datasets.length,
			backgroundColor: color(dsColor).alpha(0.5).rgbString(),
			borderColor: dsColor,
			borderWidth: 1,
			data: []
		};

		for (var index = 0; index < barChartData.labels.length; ++index) {
			newDataset.data.push(randomScalingFactor());
		}

		barChartData.datasets.push(newDataset);
		window.myBar.update();
	});

	document.getElementById('addData').addEventListener('click', function() {
		if (barChartData.datasets.length > 0) {
			var month = MONTHS[barChartData.labels.length % MONTHS.length];
			barChartData.labels.push(month);

			for (var index = 0; index < barChartData.datasets.length; ++index) {
				// window.myBar.addData(randomScalingFactor(), index);
				barChartData.datasets[index].data.push(randomScalingFactor());
			}

			window.myBar.update();
		}
	});

	document.getElementById('removeDataset').addEventListener('click', function() {
		barChartData.datasets.splice(0, 1);
		window.myBar.update();
	});

	document.getElementById('removeData').addEventListener('click', function() {
		barChartData.labels.splice(-1, 1); // remove the label first

		barChartData.datasets.forEach(function(dataset) {
			dataset.data.pop();
		});

		window.myBar.update();
	});
</script>