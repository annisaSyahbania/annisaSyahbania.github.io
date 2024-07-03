<?php
include("../../koneksibarang.php");

$query = "SELECT bk.id, bk.id_transaksi, bk.tanggal, g.kode_barang, g.nama_barang, bk.jumlah, g.satuan_id, s.satuan
          FROM barang_keluar bk
          JOIN gudang g ON bk.gudang_id = g.id
          JOIN satuan s ON g.satuan_id = s.id
          ORDER BY bk.id";

$result = $koneksi->query($query);

?>
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Barang Keluar</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>Id Transaksi</th>
							<th>Tanggal Keluar</th>
							<th>Kode Barang</th>
							<th>Nama Barang</th>
							<th>Jumlah Keluar</th>
							<th>Satuan Barang</th>
							<th>Pengaturan</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						while ($data = $result->fetch_assoc()) {
						?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $data['id_transaksi'] ?></td>
								<td><?php echo $data['tanggal'] ?></td>
								<td><?php echo $data['kode_barang'] ?></td>
								<td><?php echo $data['nama_barang'] ?></td>
								<td><?php echo $data['jumlah'] ?></td>
								<td><?php echo $data['satuan'] ?></td>
								<td>
									<a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=barangkeluar&aksi=hapusbarangkeluar&id_transaksi=<?php echo $data['id_transaksi'] ?>" class="btn btn-danger">Hapus</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<a href="?page=barangkeluar&aksi=tambahbarangkeluar" class="btn btn-primary">Tambah</a>
			</div>
		</div>
	</div>
</div>