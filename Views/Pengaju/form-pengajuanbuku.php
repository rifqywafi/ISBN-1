
<div class="d-flex justify-content-center align-items-center my-5 mx-4">
<div class="form-buku-container shadow p-4">
        <div class="row">
            <div class="col-12">
              <div class="d-flex justify-content-center ">
                    <h2 class="display-5 fw-bolder mb-5">
                        <span class="text-gradient d-inline">Form Pengajuan Buku</span>
                    </h2>
                </div>
                        <form class="form" enctype="multipart/form-data" action="index.php?page=buku&act=insertDataBuku" method="POST">
                            </a>
                                <div class="row">
                                    <div class="col-12 p-1 my-2">
                                        <input type="text" id="pengaju_id" value="<?= $_SESSION['id'] ?>"
                                        name="pengaju_id" hidden />
                                        <label for="nama_pengaju">
                                          Nama Pengaju</label>
                                        <div class="form-group position-relative has-icon-left">
                                            <input type="text" id="nama_pengaju" value="<?= $_SESSION['nama']?>" class="shadow-none form-control"
                                                placeholder="Nama Pengaju" name="nama_pengaju" required readonly/>
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 p-1 my-2">
                                        <label for="judul_buku">Judul Buku</label>
                                        <div class="form-group position-relative has-icon-left">
                                            <input type="text" id="judul_buku" class="shadow-none form-control" placeholder="Judul Buku"
                                                name="judul_buku" required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-alphabet"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 p-1 my-2">
                                        <label for="tahun_buku">Tahun Terbit Buku</label>
                                        <div class="form-group position-relative has-icon-left">
                                        <input type="text" id="tahun_buku" class="shadow-none form-control" placeholder="Tahun Terbit Buku"
                                                name="tahun_buku" required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 p-1 my-2">
                                        <label for="penulis_buku">Penulis Buku</label>
                                        <a href=""  class="ms-2 penulis-input" id="penulis-status" data-value="bukanPengaju">Apakah Penulisnya Bukan Pengaju?</a>
                                        <div class="form-group position-relative has-icon-left">
                                            <input type="text" id="penulis_buku" class="shadow-none form-control" name="penulis_buku"
                                                placeholder="Penulis Buku" readonly value="<?= $_SESSION['nama']?>"/>
                                            <div class="form-control-icon">
                                                <i class="bi bi-person" ></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 p-1 my-2">
                                        <label for="dokumen">Silahkan Masukkan Dokumen <span class="text-danger">*.pdf</span></label>
                                            <input type="file" id="dokumen" class="shadow-none form-control" accept="application/pdf" name="dokumen"
                                                placeholder="Dokumen" required />
                                    </div>
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">
                                            Submit
                                        </button>
                                        <button type="reset" onclick=""
                                            class="btn btn-primary me-1 mb-1">
                                            Reset
                                        </button>
                                    </div>
                                </div>
                        </form>
            </div>
        </div>
</div>
</div>
<script>
    const statPenulis = document.getElementById("penulis-status");
    const namaPenulis = '<?= $_SESSION['nama']?>';
    const inputPenulis = document.getElementById("penulis_buku");
    statPenulis.addEventListener('click', function(event) {
        event.preventDefault();
        let statValuePenulis = this.getAttribute('data-value');
        if(statValuePenulis === "bukanPengaju"){
            this.text = "Apakah Pengaju Merupakan Penulisnya?"
            inputPenulis.readOnly = false
            inputPenulis.value = ""
            this.setAttribute('data-value', 'pengaju')
        }else if(statValuePenulis === "pengaju"){
            this.text = "Apakah Penulisnya Bukan Pengaju?"
            inputPenulis.readOnly = true
            inputPenulis.value = namaPenulis;
            this.setAttribute('data-value', 'bukanPengaju')
        }
        console.log('Setelah berubah value:', statValuePenulis);
    });
</script>
