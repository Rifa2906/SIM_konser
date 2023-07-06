  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
      </div>



      <div class="row">
          <!-- Datatables -->
          <div class="col-lg-12">
              <div class="card mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <a data-toggle="tooltip" data-placement="top" title="Ubah">
                          <button data-toggle="modal" data-target="#Modal_checkin" id="#exampleModal" class="btn btn-primary btn-sm">
                              Cek
                          </button>
                      </a>
                  </div>
                  <div class="table-responsive p-3">
                      <table class="table align-items-center table-flush" id="dataTable">
                          <thead class="thead-light">
                              <tr>
                                  <th>No</th>
                                  <th>Nomor Id</th>
                                  <th>Nama</th>
                                  <th>Alamat</th>
                                  <th>No Telpon</th>
                                  <th>Jumlah Tiket</th>
                                  <th>Harga Tiket (Rp)</th>
                                  <th>Total (Rp)</th>
                                  <th>Status</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                                $no = 1;
                                foreach ($checkin as $key => $value) { ?>
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
                                          <?php
                                            if ($value['status'] == 'Belum Checkin') { ?>
                                              <span class="badge badge-danger"><?= $value['status']; ?></span>
                                          <?php
                                            } else if ($value['status'] == 'Sudah Checkin') { ?>
                                              <span class="badge badge-success"><?= $value['status']; ?></span>
                                          <?php
                                            }

                                            ?>

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



  <!-- Modal checkin -->
  <div class="modal fade" id="Modal_checkin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                      <div class="form-group">
                          <label for="">Masukan Nomor Id</label>
                          <input type="text" class="form-control" id="no_id">
                          <span class="text-danger" id="no_id-error"></span>
                      </div>
              </div>
              </form>
              <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Kembali</button>
                  <button type="button" id="btn-tambah" class="btn btn-primary" onclick="proses()">Cari</button>
              </div>
          </div>
      </div>
  </div>

  <script>
      function swall(params1) {
          Swal.fire({
              text: 'Berhasil  ' + params1,
              icon: 'success',
              showConfirmButton: false,
              timer: 1500
          }).then((result) => {
              location.reload();
          })

      }





      function proses() {
          no_id = $("#no_id").val();
          $.ajax({
              type: 'POST',
              url: '<?= base_url('Checkin/cek_noID') ?>',
              data: {
                  no_id: no_id
              },
              dataType: 'json',
              success: function(data) {
                  if (data['status'] == 0) {
                      $("#no_id-error").html(data['no_id']);

                  } else if (data['status'] == 'berhasil') {
                      $("#Modal_checkin").modal('hide');
                      swall('Checkin')

                  } else if (data['status'] == 'tidak ada') {
                      Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Data Tidak valid',
                      })
                      $("#Modal_checkin").modal('hide');
                  } else if (data['status'] == 'sudah digunakan') {
                      Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'No Id sudah checkin',
                      })
                      $("#Modal_checkin").modal('hide');
                  }
              }
          })
      }
  </script>