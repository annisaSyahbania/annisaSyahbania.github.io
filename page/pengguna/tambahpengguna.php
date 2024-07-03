  <div class="container-fluid">

  	<!-- DataTales Example -->
  	<div class="card shadow mb-4">
  		<div class="card-header py-3">
  			<h6 class="m-0 font-weight-bold text-primary">Tambah User</h6>
  		</div>
  		<div class="card-body">
  			<div class="table-responsive">
  				<div class="body">
  					<form method="POST" enctype="multipart/form-data">
  						<label for="">Nama</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="text" name="nama" class="form-control" />
  							</div>
  						</div>
  						<label for="">Nim</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="text" name="nim" class="form-control" />
  							</div>
  						</div>
  						<label for="">Username</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="text" name="username" class="form-control" />

  							</div>
  						</div>

  						<label for="">Masukan Password</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="password" name="password" class="form-control" />
  							</div>
  						</div>

  						<label for="">Posisi</label>
  						<div class="form-group">
  							<div class="form-line">
  								<select name="level" class="form-control show-tick">
  									<option value="">-- Pilih Posisi --</option>

  									<option value="Ketua">Ketua</option>
  									<option value="Staff">Staff</option>
  								</select>
  							</div>
  						</div>
  						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

  					</form>



  					<?php

						if (isset($_POST['simpan'])) {
							$nama = $_POST['nama'];
							$telepon = $_POST['nim'];
							$username = $_POST['username'];
							$password = md5($_POST['password']);
							$level = $_POST['level'];

							if ($upload) {

								$sql = $koneksi->query("insert into users ( nama, nim, username, password, level) values('$nama','$nim','$username','$password','$level')");

								if ($sql) {
						?>

  								<script type="text/javascript">
  									alert("Data Berhasil Disimpan");
  									window.location.href = "?page=pengguna";
  								</script>

  					<?php
								}
							}
						}
						?>