<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title_pdf; ?></title>
    <style>
        #table {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #table tr:hover {
            background-color: #ddd;
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            background-color: #177dff;
            color: white;
        }
    </style>
</head>

<body>

    <div style="text-align:center">
        <h3> Laporan Pemesanan Tiket Konser</h3>
    </div>
    <table id="table">
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
</body>

</html>