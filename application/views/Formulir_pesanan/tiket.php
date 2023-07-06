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
        <tbody>
            <tr>
                <td>Nama : </td>
                <td><?= $tiket['nama']; ?></td>
            </tr>
            <tr>
                <td>Alamat : </td>
                <td><?= $tiket['alamat']; ?></td>
            </tr>
            <tr>
                <td>No Telpon : </td>
                <td><?= $tiket['no_telpon']; ?></td>
            </tr>
            <tr>
                <td>Jumlah Tiket : </td>
                <td><?= $tiket['jumlah_tiket']; ?></td>
            </tr>
            <tr>
                <td>Total Pembayaran : </td>
                <td><?= $tiket['total']; ?></td>
            </tr>
        </tbody>
    </table>
</body>

</html>