<?php
function highlight($tahun, $target) {
    if ($tahun == $target) {
        return "<b style='color:red;'>$tahun</b>";
    }
    return $tahun;
}

$timeline = [
    "2025" => "Masuk Kuliah",
    "2026" => "Belajar HTML",
    "2026" => "Belajar CSS & JS",
    "2026" => "Proyek Website Pertama",
    "2026" => "Belajar PHP"
];
?>

<!DOCTYPE html>
<html>
<head>
<title>Timeline</title>
<style>
.timeline {
    border-left: 3px solid black;
    padding-left: 20px;
}
.item {
    margin-bottom: 15px;
}
</style>
</head>

<body>

<h2>Timeline Belajar Coding</h2>

<div class="timeline">
<?php foreach ($timeline as $tahun => $kegiatan): ?>
    <div class="item">
        <?= highlight($tahun, "2023"); ?> - <?= $kegiatan; ?>
    </div>
<?php endforeach; ?>
</div>

<br>
<a href="index.php">Kembali ke Profil</a> |
<a href="blog.php">Menuju Blog</a>

</body>
</html>