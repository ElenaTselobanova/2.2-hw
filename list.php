<?php
$fileList = glob('uploads/*.json');
$num = 0;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список тестов</title>
</head>
<body>
<?php
foreach ($fileList as $key => $file)
{
    $num++;
    $fileTest = file_get_contents($file);
    $decodeFile = json_decode($fileTest, true);
    echo "<ul><li><a href=\"test.php?test=$key\">Тест №: $num</a></li></ul>";
}
?>
<ul>
    <li>
        <a href="admin.php">Загрузить тест</a>
    </li>
    <li>
        <a href="list.php">Список тестов</a>
    </li>
</ul>
</body>
</html>