<script>
	function sum() {
		var stok = document.getElementById('stok').value;
		var jumlahkeluar = document.getElementById('jumlahkeluar').value;
		var result = parseInt(stok) - parseInt(jumlahkeluar);
		if (!isNaN(result)) {
			document.getElementById('total').value = result;
		}
	}
</script>

<?php
include("../../koneksibarang.php");

// Fungsi untuk mengambil gudang_id berdasarkan kode barang
function getGudangId($koneksi, $kode_barang)
{
	$sql = "SELECT id FROM gudang WHERE kode_barang = '$kode_barang'";
	$result = mysqli_query($koneksi, $sql);
	if ($result && mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		return $row['id'];
	} else {
		return null;
	}
}

// Koneksi database
$koneksi = new mysqli("localhost", "root", "", "coba");
if ($koneksi->connect_error) {
	die("Connection failed: " . $koneksi->connect_error);
}

// Mengambil format id_transaksi
$no = mysqli_query($koneksi, "SELECT id_transaksi FROM barang_keluar ORDER BY id_transaksi DESC");
$idtran = mysqli_fetch_array($no);
$kode = $idtran['id_transaksi'] ?? '';
$urut = substr($kode, 8, 3);
$tambah = (int) $urut + 1;
$bulan = date("m");
$tahun = date("y");
if (strlen($tambah) == 1) {
	$format = "TRK-" . $bulan . $tahun . "00" . $tambah;
} else if (strlen($tambah) == 2) {
	$format = "TRK-" . $bulan . $tahun . "0" . $tambah;
} else {
	$format = "TRK-" . $bulan . $tahun . $tambah;
}

$tanggal_keluar = date("Y-m-d");
?>

<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Tambah Barang Keluar</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<div class="body">
					<form method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
						<label for="">Id Transaksi</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="id_transaksi" class="form-control" id="id_transaksi" value="<?php echo $format; ?>" readonly />
							</div>
						</div>

						<label for="">Tanggal Keluar</label>
						<div class="form-group">
							<div class="form-line">
								<input type="date" name="tanggal_keluar" class="form-control" id="tanggal_keluar" value="<?php echo $tanggal_keluar; ?>" />
							</div>
						</div>

						<label for="">Barang</label>
						<div class="form-group">
							<div class="form-line">
								<select name="barang" id="cmb_barang" class="form-control">
									<option value="">-- Pilih Barang --</option>
									<?php
									$sql = $koneksi->query("SELECT * FROM gudang ORDER BY kode_barang");
									while ($data = $sql->fetch_assoc()) {
										echo "<option value='{$data['kode_barang']}.{$data['nama_barang']}'>{$data['kode_barang']} | {$data['nama_barang']}</option> ";
									}
									?>
								</select>
							</div>
						</div>

						<div class="tampung"></div>

						<label for="">Jumlah</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="jumlahkeluar" id="jumlahkeluar" onkeyup="sum()" class="form-control" />
							</div>
						</div>

						<label for="total">Total Stok</label>
						<div class="form-group">
							<div class="form-line">
								<input name="total" id="total" type="number" class="form-control" readonly>
							</div>
						</div>

						<div class="tampung1"></div>

						<label for="">Tujuan</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="tujuan" class="form-control" />
							</div>
						</div>

						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
					</form>

					<?php
					if (isset($_POST['simpan'])) {
						$id_transaksi = $_POST['id_transaksi'];
						$tanggal = $_POST['tanggal_keluar'];
						$barang = $_POST['barang'] ?? '';
						$jumlahkeluar = $_POST['jumlahkeluar'];
						$tujuan = $_POST['tujuan'] ?? '';

						if ($barang && $tujuan) {
							$pecah_barang = explode(".", $barang);
							$kode_barang = $pecah_barang[0];
							$nama_barang = $pecah_barang[1];
							$total = $_POST['total'];

							// Ambil gudang_id dari fungsi getGudangId
							$gudang_id = getGudangId($koneksi, $kode_barang);

							if ($total < 0) {
								echo "<script>alert('Stok Barang Habis, Transaksi Tidak Dapat Dilakukan'); window.location.href = '?page=barangkeluar&aksi=tambahbarangkeluar';</script>";
							} else {
								$sql = "INSERT INTO barang_keluar (id_transaksi, tanggal, gudang_id, jumlah, tujuan)
                                        VALUES ('$id_transaksi', '$tanggal', '$gudang_id', '$jumlahkeluar', '$tujuan')";
								$sql2 = "UPDATE gudang SET jumlah = jumlah - $jumlahkeluar WHERE kode_barang = '$kode_barang'";

								if ($koneksi->query($sql) === TRUE && $koneksi->query($sql2) === TRUE) {
									echo "<script>alert('Simpan Data Berhasil'); window.location.href = '?page=barangkeluar';</script>";
								} else {
									echo "Error: " . $sql . "<br>" . $koneksi->error;
								}
							}
						} else {
							echo "<script>alert('Barang dan tujuan tidak boleh kosong');</script>";
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>