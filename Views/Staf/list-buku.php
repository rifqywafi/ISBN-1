<div class="container my-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <div class="table-responsive">
                    <div class="col-12">
                        Filter Status:
                        <select name="filter" onchange="filterByStatus()" id="filter" class="border rounded-3 col-4">
                            <option value="" selected>Semua Buku</option>
                            <option value="Menunggu Diproses">Menunggu Diproses</option>
                            <option value="Sedang Diproses">Sedang Diproses</option>
                            <option value="Sedang Diajukan">Sedang Diajukan</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                    </div>
                    <table id="tabel-buku">
                        <thead>
                            <tr>
                                <th><span>No.</span></th>
                                <th><span>Buku</span></th>
                                <th><span>Penulis</span></th>
                                <th><span>Tahun Terbit</span></th>
                                <th><span>Tanggal Pengajuan</span></th>
                                <th><span>Pengurus</span></th>
                                <th class="text-center"><span>Status</span></th>
                                <th class="text-center"><span>Dokumen</span></th>
                                <th>&nbsp;</th>
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
                                        <div class="" id="buku_id_tabel" hidden><?= $row['buku_id']?></div>
                                        <div class="fs-5 judul-buku"><?= $row['buku_judul'] ?></div>
                                    </td>
                                    <td>
                                        <div><?= $row['buku_penulis'] ?></div>
                                    </td>
                                    <td>
                                        <?= $row['buku_tahun'] ?>
                                    </td>
                                    <td>
                                        <?php 
                                            $date = new DateTime($row['buku_tanggal_pengajuan']);
                                            $tahun = $date->format('Y');
                                            $bulan = $date->format('M');
                                            $hari = $date->format('d');
                                    
                                            echo $hari." ".$bulan." ".$tahun;
                                        ?>
                                    </td>
                                    <td>
                                        <?php if($row['buku_status'] != "Menunggu Diproses" && $row['buku_status'] != "Ditolak"){
                                            echo '<p class="my-1">Staf: '.$row['staf_nama'].'</p>
                                            <p class="my-1">Editor: '.$row['editor_nama'].'</p>';
                                        }else{
                                            echo '<p class="my-1 fst-italic">Belum Diproses</p>';
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <span class="status-buku badge <?php
                                        if ($row['buku_status'] == 'Menunggu Diproses'){
                                            echo 'bg-warning text-dark';
                                        } else if($row['buku_status'] == 'Sedang Diproses'){
                                            echo 'bg-info text-dark';
                                        } else if($row['buku_status'] == 'Sedang Diajukan') {
                                            echo 'bg-primary';
                                        } else if ($row['buku_status'] == 'Selesai') {
                                            echo 'bg-success';
                                        } else if ($row['buku_status'] == 'Ditolak') {
                                            echo 'bg-danger';
                                        }
                                        ?>"><?= $row['buku_status'] ?></span>
                                    </td>
                                    <td class="text-center">
                                    <div class="" id="buku_dokumen_tabel" hidden><?= $row['buku_dokumen']?></div>
                                        <a target="_blank" href="index.php?page=listBuku&act=preview&id=<?= $row['buku_id']?>&docs=<?= $row['buku_dokumen']?>" class="table-link">

                                            <span class="preview-dokumen badge text-wrap bg-dark"><i
                                                    class="me-1 bi bi-eye-fill"></i>Preview</span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        if ($row['buku_status'] == "Menunggu Diproses") {
                                            echo '			
                                            <a href="#"  class="table-link ubah-status">
                                            <span 
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalPilihEditor"
                                            class="edit-buku badge text-wrap bg-warning"><i class="me-1 bi bi-clipboard-fill"></i>Proses</span>
                                            </a>
                                            <a href="javascript:void(0);" onclick="tolakBuku('.$row['buku_id'].')" class="table-link">
                                            <span 
                                            class="edit-buku badge text-wrap bg-danger"><i class="me-1 bi bi-x-circle"></i>Tolak</span>
                                            </a>
                                        ';
                                        }
                                        else if ($row['buku_status'] == "Sedang Diproses") {
                                            echo '							
                                            <a href="#" class="table-link ubah-status">
                                            <span 
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalDokumenRevisi"
                                            class="edit-buku badge text-wrap bg-info"><i class="me-1 bi bi-pencil-fill"></i>Upload Dokumen Revisi</span>
                                            </a>
                                        ';
                                        }
                                        else if ($row['buku_status'] == "Sedang Diajukan") {
                                            echo '							
                                            <a href="#" class="table-link ubah-status" >
                                            <span 
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalSelesai"
                                            class="edit-buku badge text-wrap bg-success"><i class="me-1 bi bi-check"></i>Selesaikan</span>
                                            </a>
                                        ';
                                        }else if ($row['buku_status'] == "Selesai") {
                                            echo '							
                                            <a href="database/isbn/'.$row['buku_isbn'].'" class="table-link" download>
                                            <span 
                                            class="edit-buku badge text-wrap bg-success"><i class="me-1 bi bi-download"></i>Download ISBN</span>
                                            </a>
                                        ';
                                        }
                                        ?>
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
    <div class="modal fade modal-status" id="modalPilihEditor" tabindex="-1" role="dialog" aria-labelledby="modalPilihEditorLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPilihEditorLabel">Proses Buku</h5>
                </div>
                <div class="modal-body">
                    <form class="form mx-4" onsubmit="prosesBuku()" enctype="multipart/form-data" action="index.php?page=listBuku&act=proses" method="POST">
                        <div class="row">
                            <div class="col-12 p-1 my-2">
                                <select id="editor" class="shadow-none form-control" name="editor_id" required>
                                    <option value="" disabled selected>Pilih Editor</option>
                                    <?php foreach($dataEditorTidakAda as $d) {?>
                                    <option value="<?= $d['editor_id'] ?>"><?= $d['editor_nama'] ?></option>
                                    <?php }?>
                                </select>
                                <input type="text" name="buku_id" id="buku_id" class="buku_id" value="" hidden>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary me-1 mb-1">
                        Proses
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade modal-status" id="modalSelesai" tabindex="-1" role="dialog" aria-labelledby="modalSelesaiLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSelesaiLabel">Upload ISBN Buku</h5>
                </div>
                <div class="modal-body">
                    <form class="form mx-4" onsubmit="selesaiBuku()" enctype="multipart/form-data" action="index.php?page=listBuku&act=selesai" method="POST">
                        <div class="row">
                            <div class="col-12 p-1 my-2">
                                <input type="file" id="isbn" class="shadow-none form-control mt-5" name="buku_isbn"
                                    placeholder="ISBN Buku" required/>
                                <input type="text" name="buku_id" class="buku_id" value="" hidden>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary me-1 mb-1">
                        Selesaikan
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade modal-status" id="modalDokumenRevisi" tabindex="-1" role="dialog" aria-labelledby="modalDokumenRevisiLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDokumenRevisiLabel">Upload Dokumen Revisi</h5>
                </div>
                <div class="modal-body">
                    <form class="form mx-4" onsubmit="ajukanBuku()" enctype="multipart/form-data" action="index.php?page=listBuku&act=aju" method="POST">
                        <div class="row">
                            <div class="col-12 p-1 my-2">
                            <input type="text" name="buku_id" class="buku_id" value="" hidden>
                                <label for="prev-dokumen">Dokumen Buku Lama  : </label>
                                <input type="text" id="old-dokumen" class="form-control fw-bold fst-italic" value="" name="old-dokumen" required/>
                                <a id="" target="_blank" href="#" class="" id="prev-dokumen">
                                <span class="preview-dokumen badge text-wrap bg-primary"><i
                                        class="me-1 bi bi-eye-fill"></i>Preview</span>
                                </a>
                                <input type="file" id="dokumenNew" class="shadow-none form-control mt-5" name="dokumen_new"
                                    placeholder="Dokumen" accept="application/pdf" required/>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary me-1 mb-1">
                        Ajukan
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {
        const table = new DataTable('#tabel-buku');
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

    function tolakBuku(id){
        if(confirm("Apakah yakin ingin menolak buku ini?")){
            window.location.href = `index.php?page=listBuku&act=tolak&id=${id}`
        }
    }
    function selesaiBuku(){
        if(confirm("Apakah yakin ingin menyelesaikan ISBN buku ini?")){
            return true
        }else{
            return false
        }
    }
    function prosesBuku(){
    
        if(confirm("Apakah yakin ingin memproses buku ini?")){
            return true
        }else{
            return false
        }
        
    }
    function ajukanBuku(){
        if(confirm("Apakah yakin ingin mengajukan buku ini?")){
            return true
        }else{
            return false
        }
    }

    $(document).ready(function(){
        $('#tabel-buku').on('click', '.ubah-status', function(){
            // Ambil data dari baris yang diklik
            var currentRow = $(this).closest('tr');
            
            var bukuId = currentRow.find('#buku_id_tabel').text().trim();
            var dokumenBuku = currentRow.find('#buku_dokumen_tabel').text().trim()
            console.log(bukuId)
            // Isi data ke dalam modal
            $('.buku_id').val(bukuId);
            $('#prev-dokumen').attr('href', `index.php?page=listBuku&act=preview&id${bukuId}=&docs=${dokumenBuku}`);
            $('#old-dokumen').val(dokumenBuku);
        });
    });
    
    function filterByStatus() {
        const table = new DataTable('#tabel-buku');
        const filter = document.getElementById("filter")
        table
            .columns(6)
            .search(filter.value)
            .draw();
    }

</script>