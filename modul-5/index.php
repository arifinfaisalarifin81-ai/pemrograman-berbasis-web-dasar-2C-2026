<?php
function tampilData($data) {
    echo "<table class='hasil'>";
    foreach ($data as $key => $value) {
        echo "<tr><td><b>$key</b></td><td>$value</td></tr>";
    }
    echo "</table>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil Developer</title>
</head>
<body>

<div class="container">

<h2>Profil Interaktif Developer Pemula</h2>

<table>
<tr><td>Nama</td><td>Faisal</td></tr>
<tr><td>ID Developer</td><td>DEV001</td></tr>
<tr><td>Kota/Tgl Lahir</td><td>Bangkalan, 2006</td></tr>
<tr><td>Email</td><td>faisal@email.com</td></tr>
<tr><td>No WhatsApp</td><td>081230578406</td></tr>
</table>

<hr>

<h3>Form Developer</h3>

<form method="POST">
Framework/Tools:
<input type="text" name="framework">

Pengalaman:
<textarea name="pengalaman"></textarea>

Tools Penunjang:
<input type="checkbox" name="tools[]" value="VS Code"> VS Code
<input type="checkbox" name="tools[]" value="GitHub"> GitHub
<input type="checkbox" name="tools[]" value="Figma"> Figma
<input type="checkbox" name="tools[]" value="Postman"> Postman

<br><br>

Minat:
<input type="radio" name="minat" value="Frontend"> Frontend
<input type="radio" name="minat" value="Backend"> Backend
<input type="radio" name="minat" value="Fullstack"> Fullstack

<br><br>

Skill:
<select name="skill">
<option value="">--Pilih--</option>
<option>Dasar</option>
<option>Cukup</option>
<option>Profesional</option>
</select>

<button type="submit" name="submit">Kirim</button>
</form>

<hr>

<?php
if (isset($_POST['submit'])) {

    $framework = $_POST['framework'];
    $pengalaman = $_POST['pengalaman'];
    $tools = $_POST['tools'] ?? [];
    $minat = $_POST['minat'] ?? '';
    $skill = $_POST['skill'];

    if ($framework == "" || $pengalaman == "" || empty($tools) || $minat == "" || $skill == "") {
        echo "<p style='color:red;'>Semua data wajib diisi!</p>";
    } else {

        $fwArray = explode(",", $framework);

        if (count($fwArray) > 2) {
            echo "<p style='color:green;'>Skill Anda cukup luas di bidang development!</p>";
        }

        $data = [
            "Framework" => implode(", ", $fwArray),
            "Tools" => implode(", ", $tools),
            "Minat" => $minat,
            "Skill" => $skill
        ];

        tampilData($data);

        echo "<p><b>Pengalaman:</b><br>$pengalaman</p>";
    }
}
?>

<a href="timeline.php">Ke Timeline</a>

</div>

</body>
</html>