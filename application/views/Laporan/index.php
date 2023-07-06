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
                      <a href="<?= base_url('Laporan/cetak_pdf'); ?>" target="_BLANK" class="btn btn-info btn-border btn-round btn-sm mr-2">
                          <span class="btn-label">
                              <i class="fa fa-file-pdf"></i>
                          </span>
                          Export
                      </a>
                  </div>
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
                                  <th>Status</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                                $no = 1;
                                foreach ($laporan as $key => $value) { ?>
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

  <!-- Modal tambah satuan -->
  <div class="modal fade" id="Modal_satuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form>
                      <div class="form-group">
                          <input type="text" placeholder="Masukan satuan" class="form-control" id="satuan">
                          <span class="text-danger" id="satuan-error"></span>
                      </div>
              </div>
              </form>
              <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Kembali</button>
                  <button type="button" id="btn-tambah" class="btn btn-primary" onclick="simpan()">Simpan</button>
              </div>
          </div>
      </div>
  </div>

  <!-- Modal edit satuan -->
  <div class="modal fade" id="Modal_satuan_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                          <input type="hidden" id="id_satuan">
                          <input type="text" class="form-control" id="satuan_edit">
                          <span class="text-danger" id="satuan_edit-error"></span>
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

      function simpan() {

          var satuan = $("#satuan").val();

          $.ajax({
              type: 'POST',
              url: '<?= base_url('Satuan/tambah_satuan') ?>',
              data: {
                  satuan: satuan
              },
              dataType: 'json',
              success: function(data) {

                  if (data['status'] == 0) {
                      if (data['satuan'] != "") {
                          $("#satuan-error").html(data['satuan']);
                      } else {
                          $("#satuan-error").html('');
                      }



                  } else if (data['status'] == 1) {
                      $("#Modal_satuan").modal('hide');
                      $("#satuan").val('');
                      swall('satuan', 'Ditambahkan')


                  }

              }
          })

      }

      function ambil_id(x) {

          $.ajax({
              type: 'POST',
              url: '<?= base_url('Satuan/ambil_IdSatuan') ?>',
              data: {
                  id_satuan: x
              },
              dataType: 'json',
              success: function(data) {
                  $("#id_satuan").val(data.id_satuan);
                  $("#satuan_edit").val(data.satuan);
              }
          })

      }

      function ubah() {

          var id_satuan = $("#id_satuan").val();
          var satuan = $("#satuan_edit").val();

          $.ajax({
              type: 'POST',
              url: '<?= base_url('Satuan/ubah_data') ?>',
              data: {
                  id_satuan: id_satuan,
                  satuan: satuan
              },
              dataType: 'json',
              success: function(data) {

                  if (data['status'] == 0) {
                      if (data['satuan'] != "") {
                          $("#satuan_edit-error").html(data['satuan']);
                      } else {
                          $("#satuan_edit-error").html('');
                      }



                  } else if (data['status'] == 1) {
                      $("#Modal_satuan_edit").modal('hide');
                      $("#satuan_edit").val('');
                      swall('satuan', 'Diubah')


                  }

              }
          })

      }

      function hapus(x) {
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
                      url: '<?= base_url('Satuan/hapus_data') ?>',
                      data: {
                          id_satuan: x
                      },
                      dataType: 'json',
                      success: function(data) {}
                  })

                  swall('satuan', 'dihapus')

              }
          })
      }
  </script>