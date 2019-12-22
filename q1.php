<?php
$counter_file = 'counter.txt'; //ファイルを変数に格納
$counter_lenght = 10; //桁の変更が可能

$fp = fopen($counter_file, 'r+'); //ファイルをオープンにする。

if ($fp) {
    if (flock($fp, LOCK_EX)) { //＊＊floak関数＊＊複数人同時に読、書込み行うとエラーため処理前にファイルをロックする。
        $counter = fgets($fp, $counter_lenght); //ファイルポインタを取得する処理。
        $counter++; //+1する。
        rewind($fp); //ファイルポインタの位置を先頭に持ってくる。

        //エラー時のメッセージ処理。
        if (fwrite($fp, $counter) === FALSE) { //バイナリ処理で書き込む    .ps(調べが必要！！！)
            print('ファイル書き込みに失敗しました');
        }
        flock($fp, LOCK_UN);
    }
}
fclose($fp); //オープン中のファイルを閉じる合図
$format = '%0' . $counter_lenght . 'd';
$new_counter = sprintf($format, $counter); //フォーマットされた文字列を返す　　　.ps(調べが必要！！！)

//画像の処理
for ($i = 0; $i <= 9; $i++) {
    $num = (string) $i; //文字列処理
    $img_num = '<img src="img/' . $i . '.jpg">'; //画像表示
    $new_counter = str_replace($num, $img_num, $new_counter); //検索文字列に一致した物すべてを文字列を置き換える　　.ps(調べが必要！！！)
}

$size = ' width="16" height="18" border="0">';
$new_counter = str_replace('>', $size, $new_counter);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP課題</title>
</head>

<body>
    <p>あなたは<?php echo $new_counter; ?>人目の訪問者です</p>
</body>

</html>