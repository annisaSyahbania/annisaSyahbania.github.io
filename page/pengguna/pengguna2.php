<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Nim</th>
              <th>Username</th>
              <th>Level</th>
            </tr>
          </thead>


          <tbody>
            <?php

            $no = 1;
            $sql = $koneksi->query("select * from users");
            while ($data = $sql->fetch_assoc()) {

            ?>

              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['nama'] ?></td>
                <td><?php echo $data['nim'] ?></td>
                <td><?php echo $data['username'] ?></td>
                <td><?php echo $data['level'] ?></td>
              </tr>
            <?php } ?>

          </tbody>
        </table>
        <a href="?page=pengguna&aksi=tambahpengguna2" class="btn btn-primary">Tambah</a>
        <pre></pre>
        </tbody>
        </table>
      </div>
    </div>
  </div>

</div>