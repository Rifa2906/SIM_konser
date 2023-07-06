<!-- Login Content -->

<div class="container-login" style="margin-left: 100px;">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-12 col-md-2">
            <div class="card shadow-sm my-5 w-100">
                <div class="card-body p-0">
                    <div class="row justify-content-center">
                        <div class="col">
                            <div class="login-form">
                                <div class="text-center mb-5 font-weight-bold">
                                    Formulir Pemesanan Tiket Konser
                                </div>
                                <?= $this->session->flashdata('message'); ?>
                                <form class="user" method="POST">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Nama</label>
                                                <input type="text" name="nama" class="form-control">
                                                <small class="text-danger"> <?= form_error('nama') ?></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">No Telpon</label>
                                                <input type="text" name="no_telpon" class="form-control">
                                                <small class="text-danger"> <?= form_error('no_telpon') ?></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Jumlah Tiket</label>
                                                <input type="text" name="jumlah" class="form-control" id="jumlah">
                                                <small class="text-danger"> <?= form_error('jumlah') ?></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Alamat</label>
                                        <input type="text" name="alamat" class="form-control">
                                        <small class="text-danger"> <?= form_error('alamat') ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Total</label>
                                        <input type="text" name="total" id="total" readonly class="form-control">
                                    </div>
                                    <p>Harga Tiket : 500.000 ( per orang )</p>

                                    <div class="form-group">
                                        <button style="background-color: #00CC44; border: #00CC44;" type="submit" class="btn btn-primary btn-user btn-block">
                                            Pesan
                                        </button>
                                        <a href="<?= base_url('Autentikasi'); ?>" class="btn btn-primary mt-3">Login</a>
                                    </div>
                                    <hr>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Login Content -->

<script>
    $(document).ready(function() {
        $("#jumlah").keyup(function() {
            $jumlah = $(this).val();

            $total = $jumlah * 500000;

            $("#total").val($total)
        })


    });
</script>