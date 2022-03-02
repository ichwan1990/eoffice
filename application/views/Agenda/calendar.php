<link href="<?= base_url() ?>assets/vendors/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/vendors/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">
<link href="<?= base_url() ?>assets/build/css/custom.css" rel="stylesheet">

<script src="<?= base_url() ?>assets/vendors/moment/moment.js"></script>
<script src="<?= base_url() ?>assets/vendors/fullcalendar/dist/fullcalendar.js"></script>

<div class="page-title">
	<div class="title_left">
		<h3>Agenda Calendar</h3>
	</div>
</div>

<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title" align="right">
				<a href="<?= site_url('agenda') ?>" class="btn btn-sm btn-dark"><i class="fa fa-angle-left"></i> Kembali</a>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div id='calendar'></div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function init_calendar() {

		var date = new Date(),
			d = date.getDate(),
			m = date.getMonth(),
			y = date.getFullYear();

		var calendar = $('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listMonth'
			},
			defaultDate: '<?= date("Y-m-d") ?>',
			locale: 'id',
			eventLimit: true,
			events: [
				<?php foreach ($row as $r => $data) { ?> {
						title: '<?= $data->perihal_acara ?>',
						start: '<?= $data->tgl_start ?> <?= $data->jam_start ?>',
						end: '<?= $data->tgl_end ?> <?= $data->jam_end ?>'
					},
				<?php } ?>
			]
		});

	}

	$(document).ready(function() {
		init_calendar();
	});
</script>