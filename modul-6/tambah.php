<?php
include 'cek_login.php';
include 'koneksi.php';

if ($_SESSION['role'] != 'admin') {
    die("Akses ditolak");
}

$error = "";

if (isset($_POST['simpan'])) {

    $nama = htmlspecialchars($_POST['nama_produk']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $harga = (int) $_POST['harga'];
    $stok = (int) $_POST['stok'];
    $deskripsi = htmlspecialchars($_POST['deskripsi']);

    if ($harga < 0 || $stok < 0) {

        $error = "Harga dan stok tidak boleh minus!";

    } else {

        $stmt = $conn->prepare("INSERT INTO produk
                                (nama_produk,kategori,harga,stok,deskripsi)
                                VALUES(?,?,?,?,?)");

        $stmt->bind_param(
            "ssiis",
            $nama,
            $kategori,
            $harga,
            $stok,
            $deskripsi
        );

        $stmt->execute();

        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Tambah Produk</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

    body{
        background: linear-gradient(135deg, #667eea, #764ba2);
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
    }

    .card{
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        transition: 0.3s;
    }

    .card:hover{
        transform: translateY(-5px);
    }

    h3{
        font-weight: bold;
        color: #333;
    }

    .form-control{
        border-radius: 12px;
        padding: 12px;
    }

    .btn{
        border-radius: 12px;
        padding: 10px;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn:hover{
        transform: scale(1.03);
    }

    </style>

</head>

<body>

<div class="container mt-5">

    <div class="card p-4">

        <h3>Tambah Produk</h3>

        <?php if($error != "") : ?>

            <div class="alert alert-danger">
                <?= $error; ?>
            </div>

        <?php endif; ?>

        <form method="POST">

            <input type="text"
                   name="nama_produk"
                   class="form-control mb-3"
                   placeholder="Nama Produk"
                   required>

            <input type="text"
                   name="kategori"
                   class="form-control mb-3"
                   placeholder="Kategori"
                   required>

            <input type="number"
                   name="harga"
                   class="form-control mb-3"
                   placeholder="Harga"
                   min="0"
                   required>

            <input type="number"
                   name="stok"
                   class="form-control mb-3"
                   placeholder="Stok"
                   min="0"
                   required>

            <textarea name="deskripsi"
                      class="form-control mb-3"
                      placeholder="Deskripsi"
                      required></textarea>

            <button type="submit"
                    name="simpan"
                    class="btn btn-primary w-100">

                Simpan

            </button>

        </form>

    </div>

</div>

</body>
</html>