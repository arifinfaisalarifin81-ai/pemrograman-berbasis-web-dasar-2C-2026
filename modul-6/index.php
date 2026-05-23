<?php
include 'cek_login.php';
include 'koneksi.php';

$data = $conn->query("SELECT * FROM produk");
?>

<!DOCTYPE html>
<html>
<head>

    <title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background: linear-gradient(135deg, #667eea, #764ba2);
    min-height: 100vh;
    font-family: 'Poppins', sans-serif;
}

/* Card */
.card{
    border: none;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    transition: 0.3s;
}

.card:hover{
    transform: translateY(-5px);
}

/* Judul */
h2,h3{
    font-weight: bold;
    color: #333;
}

/* Input */
.form-control{
    border-radius: 12px;
    padding: 12px;
}

/* Tombol */
.btn{
    border-radius: 12px;
    padding: 10px;
    font-weight: 600;
    transition: 0.3s;
}

.btn:hover{
    transform: scale(1.03);
}

/* Table */
.table{
    border-radius: 15px;
    overflow: hidden;
    background: white;
}

.table th{
    background-color: #4e73df;
    color: white;
}

/* Container putih */
.box{
    background: white;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

/* Link */
a{
    text-decoration: none;
}

a:hover{
    color: #4e73df;
}

</style>

</head>

<body>

<div class="container mt-5">

    <div class="box">

    <h2>Toko Sembako</h2>

    <p>
        Login sebagai:
        <b><?= htmlspecialchars($_SESSION['username']) ?></b>
        (<?= htmlspecialchars($_SESSION['role']) ?>)
    </p>

    <a href="logout.php"
       class="btn btn-danger mb-3">

       Logout

    </a>

    <?php if($_SESSION['role'] == 'admin') : ?>

        <a href="tambah.php"
           class="btn btn-primary mb-3">

           Tambah Produk

        </a>

    <?php endif; ?>

    <table class="table table-bordered table-striped table-hover">

        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Deskripsi</th>

            <?php if($_SESSION['role'] == 'admin') : ?>
                <th>Aksi</th>
            <?php endif; ?>
        </tr>

        <?php
        $no = 1;

        while($row = $data->fetch_assoc()) :
        ?>

        <tr>

            <td><?= $no++ ?></td>

            <td><?= htmlspecialchars($row['nama_produk']) ?></td>

            <td><?= htmlspecialchars($row['kategori']) ?></td>

            <td>Rp <?= number_format($row['harga']) ?></td>

            <td><?= htmlspecialchars($row['stok']) ?></td>

            <td><?= htmlspecialchars($row['deskripsi']) ?></td>

            <?php if($_SESSION['role'] == 'admin') : ?>

            <td>

                <a href="edit.php?id=<?= $row['id'] ?>"
                   class="btn btn-warning btn-sm">

                   Edit

                </a>

                <a href="hapus.php?id=<?= $row['id'] ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Yakin hapus data?')">

                   Hapus

                </a>

            </td>

            <?php endif; ?>

        </tr>

        <?php endwhile; ?>

    </table>

</div>
</div>
</body>
</html>