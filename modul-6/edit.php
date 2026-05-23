<?php
include 'cek_login.php';
include 'koneksi.php';

if ($_SESSION['role'] != 'admin') {
    die("Akses ditolak");
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM produk WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

$error = "";

if (isset($_POST['update'])) {

    $nama = htmlspecialchars($_POST['nama_produk']);
    $kategori = htmlspecialchars($_POST['kategori']);

    // VALIDASI
    $harga = (int) $_POST['harga'];
    $stok = (int) $_POST['stok'];

    $deskripsi = htmlspecialchars($_POST['deskripsi']);

    // CEK ANGKA MINUS
    if ($harga < 0 || $stok < 0) {

        $error = "Harga dan stok tidak boleh minus!";

    } else {

        $update = $conn->prepare("UPDATE produk SET
                                nama_produk=?,
                                kategori=?,
                                harga=?,
                                stok=?,
                                deskripsi=?
                                WHERE id=?");

        $update->bind_param(
            "ssiisi",
            $nama,
            $kategori,
            $harga,
            $stok,
            $deskripsi,
            $id
        );

        $update->execute();

        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Edit Produk</title>

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

h2,h3{
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

.table{
    border-radius: 15px;
    overflow: hidden;
    background: white;
}

.table th{
    background-color: #4e73df;
    color: white;
}

.box{
    background: white;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

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

    <div class="card p-4">

        <h3>Edit Produk</h3>

       
        <?php if($error != "") : ?>

            <div class="alert alert-danger">
                <?= $error; ?>
            </div>

        <?php endif; ?>

        <form method="POST">

            <input type="text"
                   name="nama_produk"
                   value="<?= htmlspecialchars($row['nama_produk']) ?>"
                   class="form-control mb-3"
                   required>

            <input type="text"
                   name="kategori"
                   value="<?= htmlspecialchars($row['kategori']) ?>"
                   class="form-control mb-3"
                   required>

        
            <input type="number"
                   name="harga"
                   value="<?= htmlspecialchars($row['harga']) ?>"
                   class="form-control mb-3"
                   min="0"
                   required>

            
            <input type="number"
                   name="stok"
                   value="<?= htmlspecialchars($row['stok']) ?>"
                   class="form-control mb-3"
                   min="0"
                   required>

            <textarea name="deskripsi"
                      class="form-control mb-3"
                      required><?= htmlspecialchars($row['deskripsi']) ?></textarea>

            <button type="submit"
                    name="update"
                    class="btn btn-success">

                Update

            </button>

        </form>

    </div>

</div>

</body>
</html>