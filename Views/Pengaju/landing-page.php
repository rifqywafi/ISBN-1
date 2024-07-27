    <!-- Header-->
      <header class="py-5">
        <div class="container px-5 pb-5">
          <div class="row gx-5 align-items-center">
            <div class="col-xxl-5">
              <!-- Header text content-->
              <div class="text-center text-xxl-start">
                <div
                  class="badge bg-gradient-primary-to-secondary text-white mb-4"
                >
                  <div class="text-uppercase">ISBN</div>
                </div>
                <!-- <div class="fs-3 fw-light text-muted">
                  I can help your business to
                </div> -->
                <h1 class="display-3 fw-bolder mb-5">
                  <span class="text-gradient d-inline"
                    >Ajukan ISBN untuk Buku Anda!</span
                  >
                </h1>
                <div
                  class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xxl-start mb-3"
                >
                  <a
                    class="btn btn-primary btn-lg px-5 py-3 me-sm-3 fs-6 fw-bolder"
                    href="index.php?page=buku&act=tambahData"
                    >Ajukan</a
                  >
                  <a
                    class="btn btn-outline-dark btn-lg px-5 py-3 fs-6 fw-bolder"
                    data-bs-toggle="modal"
                    data-bs-target="#modalSyarat"
                    >Syarat</a
                  >
                </div>
              </div>
            </div>
            <div class="col-xxl-7">
            <div id="slider" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner" style="max-width:900px; max-height:600px !important; border-radius:20px;">
              <div class="carousel-item active">
                <img src="assets/img/perpustakaan1.jpg" class="d-block w-100" alt="Wild Landscape">
              </div>
              <div class="carousel-item ">
                <img src="assets/img/perpustakaan2.jpg" class="d-block w-100" alt="Camera">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
            </div>
            </div>
          </div>
        </div>
      </header>
      <div
      class="modal fade"
      id="modalSyarat"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modalSyaratLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Syarat Mengajukan ISBN</h5>
          </div>
          <div class="modal-body">
            <ol>
              <p>1. Buku berupa karya ilmiah untuk komersil</p>
              <p>2. Ada dokumen buku</p>
              <p>3. Mengisi formulir yang ada di perpustakaan</p>
              <p>4. Menggunakan akun email kampus</p>
              <p>5. Mengikuti standar nasional</p>
            </ol>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-primary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>

    <section>
    <header>
    <h1 class="text-gradient "><center>Alur Pengajuan ISBN</h1></center>
    </header>

  <ul class="timeline">
    <!-- Item 1 -->
    <li>
      <div class="direction-r">
        <div class="flag-wrapper">
          <span class="hexa"></span>
          <span class="flag">Register</span>
          
        </div>
        <div class="desc">Daftarkan akun terlebih dahulu</div>
      </div>
    </li>

    <!-- Item 2 -->
    <li>
      <div class="direction-l">
        <div class="flag-wrapper">
          <span class="hexa"></span>
          <span class="flag">Login</span>
          
        </div>
        <div class="desc">Login menggunakan akun email PCR yang sudah didaftarkan sebelumnya</div>
      </div>
    </li>

    <!-- Item 3 -->
    <li>
      <div class="direction-r">
        <div class="flag-wrapper">
          <span class="hexa"></span>
          <span class="flag">Pengajuan Buku</span>
          
        </div>
        <div class="desc">Silahkan Melakukan pengajuan buku </div>
      </div>
    </li>

    <!-- Item 4 -->
    <li>
      <div class="direction-l">
        <div class="flag-wrapper">
          <span class="hexa"></span>
          <span class="flag">Penuhi Persyaratan</span>
          
        </div>
        <div class="desc">Wajib Memenuhi Persyaratan buku yang telah ditentukan</div>
      </div>
    </li>

    <!-- Item 5 -->
    <li>
      <div class="direction-r">
        <div class="flag-wrapper">
          <span class="hexa"></span>
          <span class="flag">Proses Verifikasi</span>
          
        </div>
        <div class="desc">Silahkan Menunggu Proses verifikasi </div>
      </div>
    </li>

    <!-- Item 6 -->
    <li>
      <div class="direction-l">
        <div class="flag-wrapper">
          <span class="hexa"></span>
          <span class="flag">Selesai</span>
          
        </div>
        <div class="desc">Buku yang diajukan telah diterbitkan</div>
      </div>
    </li>
  </ul>
      </section>


    
    </main>
    <script>
      $("#myModal").on("shown.bs.modal", function () {
        $("#myInput").trigger("focus");
      });
    </script>