<div class="container my-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <div class="table-responsive">
                    <div class="col-12">
                        Filter Status:
                        <select name="filter" onchange="filterByStatus()" id="filter" class="border rounded-3 col-4">
                            <option value="" selected>Semua Editor</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                        </select>
                    </div>
                    <table id="tabel-editor">
                        <thead>
                            <tr>
                                <th class="text-end"><span>No.</span></th>
                                <th><span>Nama</span></th>
                                <th><span>Email</span></th>
                                <th><span>Jenis Kelamin</span></th>
                                <th><span>Nomor Telepon</span></th>
                                <th class="text-center"><span>Status Pengerjaan</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php   
                            foreach ($data as $row) {
                                ?>
                                <tr>
                                    <td class="text-end">
                                        
                                    </td>
                                    <td>
                                        <div class="fs-5 nama-editor"><?= $row['editor_nama'] ?></div>
                                    </td>
                                    <td>
                                        <?= $row['editor_email'] ?>
                                    </td>
                                    <td>
                                        <?= $row['editor_jk'] ?>
                                    </td>
                                    <td>
                                        <?= $row['editor_noTlp'] ?>
                                    </td>
                                    <td class="text-center">
                                        <span class="status-editor badge text-wrap <?php
                                        if ($row['editor_status_pengerjaan'] == 'Ada'){
                                            echo 'bg-danger';
                                        } else if($row['editor_status_pengerjaan'] == 'Tidak Ada'){
                                            echo 'bg-secondary';
                                        }
                                        ?>"><?= $row['editor_status_pengerjaan'] ?></span>
                                    </td>
                                </tr>
                                <?php 
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {
        const table = new DataTable('#tabel-editor');
        table
        .on('order.dt search.dt', function () {
            let i = 1;
            table
                .cells(null, 0, { search: 'applied', order: 'applied' })
                .every(function (cell) {
                    this.data(i++);
                });
        })
        .draw();
    });
    
    function filterByStatus() {
        const table = new DataTable('#tabel-editor');
        const filter = document.getElementById("filter")
        
        if(filter.value != ""){
            table
            .columns(5)
            .search('^' + filter.value + '$', true, false)
            .draw();
        }else{
            table
            .columns(5)
            .search("")
            .draw();
        }
    }

</script>