<!-- Content Wrapper -->
<div id="content-wrapper" class="mt-4 d-flex w-100 flex-column">

<!-- Main Content -->
<div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Buku Menunggu Diproses:</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=count($dataBukuMenungguDiproses)?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Buku Sedang Diproses:</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=count($dataBukuSedangDiproses)?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Buku Sedang Diajukan:</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=count($dataBukuSedangDiajukan)?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                    Total Buku:</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php 
                                        echo $jumlahBuku
                                        ?>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Buku Selesai:</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?=count($dataBukuSelesai)?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Buku Ditolak:</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?=count($dataBukuDitolak)?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
             <!-- Area Chart -->
            <div class="col-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Buku Berdasarkan Status</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="chartStatus" class="col-12" height="565"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-6">
                <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Data Buku Tahun <?= date("Y")?></h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="chartBulan" class="col-12" height="565"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

           



    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->
 <script>
    const dataBukuSelesai = <?=count($dataBukuSelesai)?>;
    const dataBukuMenungguDiproses = <?=count($dataBukuMenungguDiproses)?>;
    const dataBukuSedangDiproses = <?=count($dataBukuSedangDiproses)?>;
    const dataBukuSedangDiajukan = <?=count($dataBukuSedangDiajukan)?>;
    const dataBukuDitolak = <?=count($dataBukuDitolak)?>;

    const ctS = document.getElementById('chartStatus');
    const ctB = document.getElementById('chartBulan');

    const jumlahBukuByMonthArrayJS = <?= json_encode($jumlahBukuByMonthArray) ?>

	new Chart(ctS, {
		type: 'bar',
		data: {
			labels: ['Menunggu Diproses', 'Sedang Diproses', 'Sedang Diajukan', 'Selesai', 'Ditolak'],
			datasets: [{
				label: 'Jumlah Buku',
				data: [dataBukuMenungguDiproses, dataBukuSedangDiproses, dataBukuSedangDiajukan, dataBukuSelesai, dataBukuDitolak],
				backgroundColor: [
					'rgba(255, 99, 71, 1)',
					'rgba(9, 31, 242, 0.8)',
					'rgba(240, 255, 45, 0.8)',
					'rgba(17, 231, 42, 0.8)',
					'rgba(201, 30, 255, 0.8)'
                	],
				borderColor: [
					'rgba(255, 99, 71, 1)',
					'rgba(9, 31, 242, 0.8)',
					'rgba(240, 255, 45, 0.8)',
					'rgba(17, 231, 42, 0.8)',
					'rgba(201, 30, 255, 0.8)'
					],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
	});
	new Chart(ctB, {
		type: 'pie',
		data: {
			labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
			datasets: [{
				label: 'Jumlah Buku',
				data: [jumlahBukuByMonthArrayJS["Januari"], jumlahBukuByMonthArrayJS["Februari"], jumlahBukuByMonthArrayJS["Maret"], jumlahBukuByMonthArrayJS["April"],
                jumlahBukuByMonthArrayJS["Mei"], jumlahBukuByMonthArrayJS["Juni"], jumlahBukuByMonthArrayJS["Juli"], jumlahBukuByMonthArrayJS["Agustus"],
                jumlahBukuByMonthArrayJS["September"], jumlahBukuByMonthArrayJS["Oktober"], jumlahBukuByMonthArrayJS["November"], jumlahBukuByMonthArrayJS["Desember"]],
				backgroundColor: [
					'rgba(255, 99, 71, 1)',
					'rgba(9, 31, 242, 0.8)',
					'rgba(240, 255, 45, 0.8)',
					'rgba(17, 231, 42, 0.8)',
					'rgba(201, 30, 255, 0.8)',
					'rgba(255, 128, 6, 0.8)',
                    'rgba(255, 192, 203)',
                    'rgba(255, 0, 255)',
                    'rgba(192, 192, 192)',
                    'rgba(178, 215, 0)',
                    'rgba(219, 190, 2)',
                    'rgba(67, 89, 5)'
					],
				borderColor: [
					'rgba(255, 99, 71, 1)',
					'rgba(9, 31, 242, 0.8)',
					'rgba(240, 255, 45, 0.8)',
					'rgba(17, 231, 42, 0.8)',
					'rgba(201, 30, 255, 0.8)',
					'rgba(255, 128, 6, 0.8)',
                    'rgba(255, 192, 203)',
                    'rgba(255, 0, 255)',
                    'rgba(192, 192, 192)',
                    'rgba(178, 215, 0)',
                    'rgba(219, 190, 2)',
                    'rgba(67, 89, 5)'
					],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
	});
 </script>