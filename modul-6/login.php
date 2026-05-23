<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");

    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            $_SESSION['login'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            header("Location: index.php");
            exit;
        }
    }

    echo "<script>alert('Login gagal');</script>";
}
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

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card p-5 col-md-4">

        <h3 class="text-center mb-4">Login</h3>

        <form method="POST">

            <input type="text"
                   name="username"
                   class="form-control mb-3"
                   placeholder="Username"
                   required>

            <input type="password"
                   name="password"
                   class="form-control mb-3"
                   placeholder="Password"
                   required>

            <button type="submit"
                    name="login"
                    class="btn btn-success w-100">

                Login

            </button>

        </form>

        <a href="register.php" class="text-center mt-3">
            Belum punya akun?
        </a>

    </div>

</div>

</body>
</html>