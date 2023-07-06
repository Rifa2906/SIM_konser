  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
      </div>



      <div class="row">
          <!-- Datatables -->
          <div class="col-lg-12">
              <div class="card mb-4">
                  <div class="table-responsive p-3">
                      <table class="table align-items-center table-flush" id="dataTable">
                          <thead class="thead-light">
                              <tr>
                                  <th>No</th>
                                  <th>Nomer Id</th>
                                  <th>Nama</th>
                                  <th>Alamat</th>
                                  <th>No Telpon</th>
                                  <th>Jumlah Tiket</th>
                                  <th>Harga Tiket (Rp)</th>
                                  <th>Total (Rp)</th>
                                  <th>Aksi</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                                $no = 1;
                                foreach ($pesanan as $key => $value) { ?>
                                  <tr>
                                      <td><?= $no++; ?></td>
                                      <td><?= $value['no_id']; ?></td>
                                      <td><?= $value['nama']; ?></td>
                                      <td><?= $value['alamat']; ?></td>
                                      <td><?= $value['no_telpon']; ?></td>
                                      <td><?= $value['jumlah_tiket']; ?></td>
                                      <td><?= number_format($value['harga'], 0, ',', '.'); ?></td>
                                      <td><?= number_format($value['total'], 0, ',', '.'); ?></td>
                                      <td>

                                          <a data-toggle="tooltip" data-placement="top" title="Ubah">
                                              <button data-toggle="modal" data-target="#Modal_pemesan_edit" id="#exampleModal" onclick="ambil_id(<?= $value['id_pemesan'] ?>)" class="btn btn-warning btn-sm">
                                                  <i class="fas fa-pencil-alt"></i>
                                              </button>
                                          </a>

                                          <a data-toggle="tooltip" data-placement="top" title="Hapus">
                                              <button class="btn btn-danger btn-sm" onclick="hapus(<?= $value['id_pemesan'] ?>,<?= $value['no_telpon'] ?>)">
                                                  <i class="fas fa-trash"></i>
                                              </button>
                                          </a>
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





  </div>
  <!---Container Fluid-->



  <!-- Modal edit pemesan -->
  <div class="modal fade" id="Modal_pemesan_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form>
                      <div class="row">
                          <div class="col-12">
                              <div class="form-group">
                                  <input type="hidden" id="id_pemesan">
                                  <label for="">Nama</label>
                                  <input type="text" class="form-control" id="nama_pemesan_edit">
                                  <span class="text-danger" id="nama_pemesan_edit-error"></span>
                              </div>
                          </div>
                          <div class="col-6">
                              <div class="form-group">
                                  <label for="">No Telpon</label>
                                  <input type="text" class="form-control" id="no_telpon_edit">
                                  <span class="text-danger" id="no_telpon_edit-error"></span>
                              </div>
                          </div>
                          <div class="col-6">
                              <div class="form-group">
                                  <label for="">Jumlah Tiket</label>
                                  <input type="text" class="form-control" id="jumlah_edit">
                                  <span class="text-danger" id="jumlah_edit-error"></span>
                              </div>
                          </div>
                          <div class="col-6">
                              <div class="form-group">
                                  <label for="">Harga</label>
                                  <input type="text" class="form-control" id="harga_edit" readonly>
                              </div>
                          </div>
                          <div class="col-6">
                              <div class="form-group">
                                  <label for="">Total</label>
                                  <input type="text" class="form-control" id="total_edit" readonly>
                              </div>
                          </div>
                          <div class="col-12">
                              <div class="form-group">
                                  <label for="">Konser</label>
                                  <input type="text" class="form-control" id="konser_edit">
                                  <span class="text-danger" id="konser_edit-error"></span>
                              </div>
                          </div>
                          <div class="col-12">
                              <div class="form-group">
                                  <label for="">Alamat</label>
                                  <input type="text" class="form-control" id="alamat_edit">
                                  <span class="text-danger" id="alamat_edit-error"></span>
                              </div>
                          </div>
                      </div>

              </div>
              </form>
              <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Kembali</button>
                  <button type="button" id="btn-tambah" class="btn btn-primary" onclick="ubah()">Ubah</button>
              </div>
          </div>
      </div>
  </div>

  <script>
      $(document).ready(function() {
          $("#jumlah_edit").keyup(function() {
              $jumlah = $(this).val();

              $total = $jumlah * 500000;

              $("#total_edit").val($total)
          })


      });

      function swall(params1, params2) {
          Swal.fire({
              title: 'Data ' + params1,
              text: 'Berhasil  ' + params2,
              icon: 'success',
              showConfirmButton: false,
              timer: 1500
          }).then((result) => {
              location.reload();
          })

      }



      function ambil_id(x) {

          $.ajax({
              type: 'POST',
              url: '<?= base_url('Pesanan_tiket/ambilNo_id') ?>',
              data: {
                  id_pemesan: x
              },
              dataType: 'json',
              success: function(data) {
                  $("#id_pemesan").val(data.id_pemesan);
                  $("#nama_pemesan_edit").val(data.nama);
                  $("#no_telpon_edit").val(data.no_telpon);
                  $("#alamat_edit").val(data.alamat);
                  $("#jumlah_edit").val(data.jumlah_tiket);
                  $("#konser_edit").val(data.konser);
                  $("#harga_edit").val(data.harga);
                  $("#total_edit").val(data.total);
              }
          })

      }

      function ubah() {

          var id_pemesan = $("#id_pemesan").val();
          var nama = $("#nama_pemesan_edit").val();
          var alamat = $("#alamat_edit").val();
          var no_telpon = $("#no_telpon_edit").val();
          var jumlah_tiket = $("#jumlah_edit").val();
          var konser = $("#konser_edit").val();

          $.ajax({
              type: 'POST',
              url: '<?= base_url('Pesanan_tiket/ubah_data') ?>',
              data: {
                  id_pemesan: id_pemesan,
                  nama: nama,
                  alamat: alamat,
                  no_telpon: no_telpon,
                  jumlah_tiket: jumlah_tiket,
                  konser: konser
              },
              dataType: 'json',
              success: function(data) {

                  if (data['status'] == 0) {
                      $("#nama_pemesan_edit-error").html(data['nama']);
                      $("#no_telpon_edit-error").html(data['no_telpon']);
                      $("#alamat_edit-error").html(data['alamat']);
                      $("#jumlah_edit-error").html(data['jumlah_tiket']);
                      $("#konser_edit-error").html(data['konser']);
                  } else if (data['status'] == 1) {
                      $("#Modal_pemesan_edit").modal('hide');
                      swall('Pemesan ', 'Diubah')


                  }

              }
          })

      }

      function hapus(x, no_telpon) {
          Swal.fire({
              title: 'Apakah anda yakin ingin menghapusnya?',
              showCancelButton: true,
              confirmButtonText: 'Hapus',
              icon: 'warning'
          }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {

                  $.ajax({
                      type: 'POST',
                      url: '<?= base_url('Pesanan_tiket/hapus_data') ?>',
                      data: {
                          id_pemesan: x,
                          no_telpon: no_telpon
                      },
                      dataType: 'json',
                      success: function(data) {}
                  })

                  swall('pemesan', 'dihapus')

              }
          })
      }
  </script>