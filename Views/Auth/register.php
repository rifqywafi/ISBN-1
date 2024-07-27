<div id="register">
            <div class="d-flex divider flex-row align-items-center justify-content-center justify-content-lg-start">
               <p class="text-center fw-bold mx-3 mt-4">Daftar Akun</p>
            </div>
            
            <div class="row">
               <div data-mdb-input-init class="col-sm-12 col-lg-6 form-outline mb-4">
                  <label class="form-label" for="nama">Nama Lengkap</label>
                  <input name="nama" type="text" id="nama" value="<?= isset($data['nama']) ?  $data['nama'] : ""?>" class="form-control form-control-lg"
                  placeholder="Masukkan Nama Lengkap" <?= isset($data['nama']) ?  "readonly" : ""?> required/>
               </div>

               <div data-mdb-input-init class="col-sm-12 col-lg-6 form-outline mb-4">
                  <label class="form-label" for="email">Alamat Email</label>
                  <input name="email" type="email" value="<?= isset($data['email']) ?  $data['email'] : ""?>" id="email" class="form-control form-control-lg"
                  placeholder="Masukkan Alamat Email" <?= isset($data['email']) ?  "readonly" : ""?> required/>
               </div>
            </div>

            <div class="row">
               <div data-mdb-input-init class="col-sm-12 col-lg-6 form-outline mb-4">
                  <label class="form-label" for="no_telp">Nomor Telepon</label>
                  <input name="no_telp" type="text" id="no_telp" class="form-control form-control-lg"
                  placeholder="Masukkan Nomor Telepon" required/>
               </div>

               <div data-mdb-input-init class="col-sm-12 col-lg-6 form-outline mb-4">
                  <label class="form-label" for="jk">Jenis Kelamin</label>
                  <select name="jk" id="jk" class="form-control form-control-lg" required>
                     <option value="" disabled selected>Pilih Jenis Kelamin</option>
                     <option value="Laki-Laki" >Laki-Laki</option>
                     <option value="Perempuan">Perempuan</option>
                  </select>
               </div>
            </div>

            <div class="row">
               <div data-mdb-input-init class="col-sm-12 col-lg-6 form-outline mb-3">
               <label class="form-label" for="password">Password</label>
                  <input name="password" type="password" id="password" class="form-control form-control-lg"
                  placeholder="Masukkan Password" required/>
               </div>

               <div data-mdb-input-init class="col-sm-12 col-lg-6 form-outline mb-3">
               <label class="form-label" for="konfirmasi_password">Konfirmasi Password</label>
                  <input name="konfirmasi_password" type="password" id="konfirmasi_password" class="form-control form-control-lg"
                  placeholder="Masukkan Konfirmasi Password" required/>
               </div> 
            </div>

            <div data-mdb-input-init class="form-outline col-12 mb-4">
               <label class="form-label" for="role">Daftar Sebagai:</label>
               <select name="role" onchange="handleJenisPengaju()" id="role" class="form-control form-control-lg" required>
                  <option value="" disabled selected>Pilih Role Yang Anda Ingin Daftar</option>
                  <option value="pengaju">Pengaju</option>
                  <option value="staf">Staf Perpustakaan</option>
               </select>
            </div>

            <div id="jp" data-mdb-input-init class="form-outline col-12 mb-4" hidden>
               <label class="form-label" for="jp" >Jenis Pengaju</label>
               <select name="jp" id="jp-input" class="form-control form-control-lg">
                  <option value="" disabled selected>Pilih Jenis Pengaju</option>
                  <option value="Dosen">Dosen</option>
                  <option value="Mahasiswa">Mahasiswa</option>
                  <option value="Staf">Staf PCR</option>
               </select>
            </div>

         </div>

<script>
   function handleJenisPengaju(){
      const role = document.getElementById("role")
      const jenisPengaju = document.getElementById("jp")
      const jenisPengajuInput = document.getElementById("jp-input")
      console.log(role.value)
      if(role.value === "pengaju"){
         jenisPengaju.hidden = false
         jenisPengajuInput.required = true
      }else{
         jenisPengaju.hidden = true
      }
   }
</script>