<link rel="stylesheet" href="<?php echo PLUGINS_URL?>chartjs/Chart.min.css"/>
<script src="<?php echo PLUGINS_URL?>chartjs/Chart.min.js"></script>
<?php
    function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }

    function random_color() {
        return random_color_part() . random_color_part() . random_color_part();
    }
?>
<div class="card card-table">
	<div class="row">
		<div class="col-sm-9">
			<canvas id="myChart" style="width: 100%; height: 50vh;"></canvas>
		</div>
		<div class="col-sm-3">
            <div class="visitors">
                <div class="card">
                    <div class="card-body" style="background: #f53118; ">
                        <?php echo $minggu['total'];?>
                        <br><span style="font-size: 12px; line-height: 0; font-weight: normal; color:rgba(255,255,255,0.8);">Jumlah Pengajuan Berkas Minggu Ini</span>
                        <i class="fa fa-2x fa-chart-bar"></i>
                    </div>
                </div>
            </div>
			<div class="visitors">
				<div class="card">
					<div class="card-body" style="background: #316a77; ">
						<?php echo $total_data['total'];?>
						<br><span style="font-size: 12px; line-height: 0; font-weight: normal; color:rgba(255,255,255,0.8);">Total Pengajuan Berkas</span>
						<i class="fa fa-2x fa-globe"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
    <div class="row">
		<div class="col-sm-4 visitors">
			<div class="card">
				<div class="card-body" style="background: #699e30; ">
					<?php echo $member['total'];?>
					<br><span style="font-size: 12px; line-height: 0; font-weight: normal; color:rgba(255,255,255,0.8);">Jumlah Petugas</span>
					<i class="fa fa-2x fa-users"></i>
				</div>
			</div>
		</div>
        <div class="col-sm-4 visitors">
            <div class="card">
                <div class="card-body" style="background: #397933; ">
                    <?php echo $admin['total'];?>
                    <br><span style="font-size: 12px; line-height: 0; font-weight: normal; color:rgba(255,255,255,0.8);">Jumlah Admin SITENAR</span>
                    <i class="fa fa-2x fa-users"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-4 visitors">
            <div class="card">
                <div class="card-body" style="background: #34623d; ">
                    <?php echo $office['total'];?>
                    <br><span style="font-size: 12px; line-height: 0; font-weight: normal; color:rgba(255,255,255,0.8);">Jumlah Kantor Kepolisian</span>
                    <i class="fa fa-2x fa-warehouse"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Pengajuan', 'Diproses', 'Ditolak', 'Selesai'],
        datasets: [{
        	label: "Status Pengajuan Berkas",
            data: [<?php echo $pengajuan['total'].','.$diproses['total'].','.$ditolak['total'].','.$selesai['total'] ?>],
            backgroundColor: [
                'rgba(255, 206, 86, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255, 206, 86, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
    	legend: {
            labels: {
            	boxWidth : 0
            }
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>