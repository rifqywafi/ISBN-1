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
                                
                                    <td>
                                        
                                    </td>
                                    <td>
                                        <div class="fs-5 judul-buku" id="buku_judul_tabel"><?= $row['buku_judul'] ?></div>
                                        <div class="" id="buku_id_tabel" hidden><?= $row['buku_id']?></div>
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
                                        <a target="_blank" href="index.php?page=buku&act=preview&id=<?= $row['buku_id']?>&docs=<?= $row['buku_dokumen']?>" class="table-link">
                                            <span class="preview-dokumen badge text-wrap bg-primary"><i
                                                    class="me-1 bi bi-eye-fill"></i>Preview</span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        if ($row['buku_status'] == "Menunggu Diproses") {
                                            echo '							
                                        <a href="#"  class="table-link">
                                        <span 
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEdit"
                                        class="edit-buku badge text-wrap bg-success"><i class="me-1 bi bi-pencil-fill"></i>Edit</span>
                                        </a>
                                        <a href="javascript:void(0);" onclick="hapusData('.$row['buku_id'].')" class="table-link">
                                        <span class="cancel-buku badge text-wrap bg-danger"><i class="me-1 bi bi-trash-fill"></i>Cancel</span>
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
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Edit Buku</h5>
                </div>
                <div class="modal-body">
                    <form class="form mx-4" enctype="multipart/form-data" action="index.php?page=buku&act=updateDataBuku" method="POST">
                        </a>
                        <div class="row">
                        <input type="text" id="buku_id" value="" name="buku_id" hidden/>
                            <div class="col-12 p-1 my-2">
                                <label for="judul_buku">Judul Buku</label>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" id="judul_buku" class="shadow-none form-control"
                                        placeholder="Judul Buku" value="<?= $row['buku_judul'] ?>" name="judul_buku" required />
                                    <div class="form-control-icon">
                                        <i class="bi bi-alphabet"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 p-1 my-2">
                                <label for="tahun_buku">Tahun Terbit Buku</label>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" id="tahun_buku" class="shadow-none form-control"
                                        placeholder="Tahun Terbit Buku" value="<?= $row['buku_tahun'] ?>" name="tahun_buku" required />
                                    <div class="form-control-icon">
                                        <i class="bi bi-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 p-1 my-2">
                                <label for="penulis_buku">Penulis Buku</label>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" id="penulis_buku" class="shadow-none form-control"
                                        name="penulis_buku" placeholder="Penulis Buku" value="" />
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 p-1 my-2">
                                <label for="dokumen">Dokumen Buku</label>
                                <a target="_blank" href="#" id="prev-docs" class="ms-2 table-link">
                                <span class="preview-dokumen badge text-wrap bg-primary"><i
                                        class="me-1 bi bi-eye-fill"></i>Preview</span>
                                </a>
                                <br>
                                <input type="text" id="dokumenOld" class="mb-2 shadow-none form-control" name="dokumen_old" value="" readonly>
                                <input type="file" id="dokumenNew" class="shadow-none form-control" name="dokumen_new"
                                    placeholder="Dokumen" hidden accept="application/pdf"/>
                                <a href="#" class="" data-value="Ubah" id="ubahdocs">Ubah Dokumen</a>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary me-1 mb-1">
                        Edit
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

    $(document).ready( function () {
        $('#tabel-buku').DataTable();
    });

    function hapusData(id){
        if(confirm("Apakah yakin ingin menghapus data ini?")){
            window.location.href = `index.php?page=buku&act=hapus&buku_id=${id}`
        }
    }
    const ubahDocs = document.getElementById("ubahdocs")
    const dokumenNew = document.getElementById("dokumenNew")
    ubahDocs.addEventListener('click', function(event) {
        event.preventDefault();
        let statUbah = this.getAttribute('data-value');
        if(statUbah === "Ubah"){
            this.text = "Batalkan"
            dokumenNew.hidden = false
            dokumenNew.required = true
            this.setAttribute('data-value', 'Batal')
        }else if(statUbah === "Batal"){
            this.text = "Ubah Dokumen"
            dokumenNew.hidden = true
            dokumenNew.required = false
            this.setAttribute('data-value', 'Ubah')
        }
    });

    $(document).ready(function(){
        $('#tabel-buku').on('click', '.edit-buku', function(){
            // Ambil data dari baris yang diklik
            var currentRow = $(this).closest('tr');
            
            var bukuId = currentRow.find('#buku_id_tabel').text().trim();
            var judulBuku = currentRow.find('#buku_judul_tabel').text().trim();
            var penulisBuku = currentRow.find('td:eq(2)').text().trim();
            var tahunBuku = currentRow.find('td:eq(3)').text().trim();
            var dokumenBuku = currentRow.find('#buku_dokumen_tabel').text().trim()
            console.log(bukuId)
            console.log(dokumenBuku)
            // Isi data ke dalam modal
            $('#buku_id').val(bukuId);
            $('#judul_buku').val(judulBuku);
            $('#tahun_buku').val(tahunBuku);
            $('#penulis_buku').val(penulisBuku);
            $('#dokumenOld').val(dokumenBuku);
            $('#prev-docs').attr('href', `index.php?page=buku&act=preview&id=${bukuId}&docs=${dokumenBuku}`);
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