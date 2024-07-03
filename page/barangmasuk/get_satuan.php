<?php
include("../../koneksibarang.php");

// Pastikan $_POST['tamp'] sudah ada dan tidak kosong
if (isset($_POST['tamp'])) {
  $tamp = $_POST['tamp'];

  // Pisahkan nilai $tamp menjadi kode_barang dan nama_barang
  $pecah_bar = explode(".", $tamp);
  $kode_bar = $pecah_bar[0];

  // Query untuk mendapatkan satuan berdasarkan kode_barang dari gudang
  $sql = "SELECT g.*, s.satuan
            FROM gudang g
            JOIN satuan s ON g.satuan_id = s.id
            WHERE g.kode_barang = '$kode_bar'";

  $result = mysqli_query($koneksi, $sql);

  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      // Output data of each row
      while ($row = mysqli_fetch_assoc($result)) {
?>
        <label for="satuan">Satuan</label>
        <div class="form-group">
          <div class="form-line">
            <input readonly="readonly" id="satuan" name="satuan" type="text" class="form-control" value="<?php echo $row["satuan"]; ?>">
          </div>
        </div>
<?php
      }
    } else {
      echo "0 results";
    }
  } else {
    echo "Error: " . mysqli_error($koneksi);
  }

  mysqli_close($koneksi);
} else {
  echo "Parameter 'tamp' tidak ditemukan";
}
?>