<?php
$kode_barang = $_GET['kode_barang'];
$sql2 = $koneksi->query("SELECT * FROM gudang WHERE kode_barang = '$kode_barang'");
$tampil = $sql2->fetch_assoc();

$jenis_barang_id = $tampil['jenis_barang_id'];
$satuan_id = $tampil['satuan_id'];
?>

<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Ubah Stok Gudang</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<div class="body">
					<form method="POST" enctype="multipart/form-data">
						<label for="">Kode Barang</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="kode_barang" class="form-control" id="kode_barang" value="<?php echo $tampil['kode_barang']; ?>" readonly />
							</div>
						</div>

						<label for="">Nama Barang</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="nama_barang" value="<?php echo $tampil['nama_barang']; ?>" class="form-control" />
							</div>
						</div>

						<label for="">Jenis Barang</label>
						<div class="form-group">
							<div class="form-line">
								<select name="jenis_barang" class="form-control">
									<option value="">-- Pilih Jenis Barang --</option>
									<?php
									$sql = $koneksi->query("SELECT * FROM jenis_barang ORDER BY id");
									while ($data = $sql->fetch_assoc()) {
										$selected = ($data['id'] == $jenis_barang_id) ? 'selected' : '';
										echo "<option value='$data[id].$data[jenis_barang]' $selected>$data[jenis_barang]</option>";
									}
									?>
								</select>
							</div>
						</div>

						<label for="">Satuan Barang</label>
						<div class="form-group">
							<div class="form-line">
								<select name="satuan" class="form-control">
									<option value="">-- Pilih Satuan Barang --</option>
									<?php
									$sql = $koneksi->query("SELECT * FROM satuan ORDER BY id");
									while ($data = $sql->fetch_assoc()) {
										$selected = ($data['id'] == $satuan_id) ? 'selected' : '';
										echo "<option value='$data[id].$data[satuan]' $selected>$data[satuan]</option>";
									}
									?>
								</select>
							</div>
						</div>

						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
					</form>

					<?php
					if (isset($_POST['simpan'])) {
						$kode_barang = $_POST['kode_barang'];
						$nama_barang = $_POST['nama_barang'];

						$jenis_barang = $_POST['jenis_barang'];
						$pecah_jenis = explode(".", $jenis_barang);
						$jenis_barang_id = $pecah_jenis[0];

						$satuan = $_POST['satuan'];
						$pecah_satuan = explode(".", $satuan);
						$satuan_id = $pecah_satuan[0];

						// Debugging
						echo "Kode Barang: $kode_barang<br>";
						echo "Nama Barang: $nama_barang<br>";
						echo "Jenis Barang ID: $jenis_barang_id<br>";
						echo "Satuan ID: $satuan_id<br>";

						// Pastikan nilai yang diambil dari form valid
						$sql = $koneksi->query("UPDATE gudang SET nama_barang='$nama_barang', jenis_barang_id='$jenis_barang_id', satuan_id='$satuan_id' WHERE kode_barang='$kode_barang'");

						if ($sql) {
							echo "<script type='text/javascript'>
                                alert('Data Berhasil Diubah');
                                window.location.href='?page=gudang';
                            </script>";
						} else {
							printf("Error: %s\n", $koneksi->error);
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>