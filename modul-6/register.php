<?php
include 'koneksi.php';

if (isset($_POST['register'])) {

    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    
    if ($username == "admin") {
        $role = "admin";
    } else {
        $role = "user";
    }

    $stmt = $conn->prepare("INSERT INTO users(username,password,role)
                            VALUES(?,?,?)");

    $stmt->bind_param("sss", $username, $password, $role);

    if ($stmt->execute()) {
        echo "<script>
                alert('Register berhasil');
                window.location='login.php';
              </script>";
    } else {
        echo "Register gagal";
    }
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

        <h3 class="text-center mb-4">Register</h3>

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

            <!-- <select name="role"
                    class="form-control mb-3"
                    required>

                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>

            </select> -->

            <button type="submit"
                    name="register"
                    class="btn btn-primary w-100">

                Register

            </button>

        </form>

        <a href="login.php" class="text-center mt-3">
            Sudah punya akun?
        </a>

    </div>

</div>

</body>
</html>