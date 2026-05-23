<?php
$artikel = [
    "html" => ["judul" => "Belajar HTML Pertama", "tanggal" => "2023", "isi" => "Saya mulai belajar HTML dari nol."],
    "error" => ["judul" => "Error Pertama", "tanggal" => "2023", "isi" => "Saya mengalami banyak error pertama kali coding."]
];

$quotes = [
    "Jangan menyerah!",
    "Error adalah guru terbaik.",
    "Ngoding itu latihan logika.",
    "Terus belajar!"
];

$randomQuote = $quotes[array_rand($quotes)];
?>

<!DOCTYPE html>
<html>
<head>
<title>Blog</title>
</head>

<body>

<h2>Blog Developer</h2>

<ul>
<?php foreach ($artikel as $key => $a): ?>
    <li><a href="?post=<?= $key ?>"><?= $a['judul']; ?></a></li>
<?php endforeach; ?>
</ul>

<hr>

<?php
if (isset($_GET['post'])) {
    $p = $_GET['post'];

    if (isset($artikel[$p])) {
        echo "<h3>".$artikel[$p]['judul']."</h3>";
        echo "<small>".$artikel[$p]['tanggal']."</small>";
        echo "<p>".$artikel[$p]['isi']."</p>";

        echo "<img src='img/sample.jpg' width='200'><br>";

        echo "<blockquote>$randomQuote</blockquote>";

        echo "<a href='https://www.w3schools.com'>Referensi</a>";
    }
}
?>

<br>
<a href="index.php">Kembali ke Profil</a> |
<a href="timeline.php">Kembali ke Timeline</a>

</body>
</html>