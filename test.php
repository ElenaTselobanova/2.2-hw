<?php
$fileList = glob('uploads/*.json');
$num = $_GET['test'];
$num = (int)$num;
$num++;
foreach ($fileList as $key => $file){
    if ($key == $_GET['test']){
        $fileTest = file_get_contents($fileList[$key]);
        $decodeFile = json_decode($fileTest, true);
    }
}
$answerTrue = 0;
$answerFalse = 0;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Обработка форм</title>
</head>
<body>
<h2>Тест: <?=$num;?></h2>
<?php
$i = 0;
foreach ($decodeFile as $key => $questions) {
    foreach ($questions as $answers) {
        if ($_POST["answer$i"] == $answers["true"]) {
            $answerTrue++;
        } else {
            $answerFalse++;
        }
        $i++;
    }
}
?>
<form method="POST">
    <?php
    $a = 0;
    foreach ($decodeFile as $key => $questions) {
        foreach ($questions as $answers) {
            ?>
            <fieldset>
                <legend><?=$answers['question']?></legend>
                <?php
                for ($i=0; $i < count($answers['answers']); $i++) {
                    ?>
                    <label><input type="radio" name="<?='answer'.$a ?>" value="<?=$answers['answers'][$i]; ?>"><?=$answers['answers'][$i]; ?></label><br>
                <?php }?>
            </fieldset>
            <?php
            $a++;
        }
    }
    ?>
    <input type="submit" value="Результат теста">
    <?php
    if (!empty($_POST)) {
        echo
            "<p> Правильных ответов: " . $answerTrue . "</p>" .
            "<p> Неправильных ответов: " . $answerFalse . "</p>";
    }
    ?>
</form>
<br><br>
<p><a href="list.php">Выбрать тест</a></p>
<p><a href="admin.php">Загрузить тест</a></p>
</body>
</html>