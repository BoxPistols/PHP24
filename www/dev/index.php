<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Dev</title>
  <script src="http://localhost:35729/livereload.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }
  </style>
</head>

<body>
  <h1>
    <?php
    // echo "Hello! PHP";
    // 計算式の結果を表示する
    // echo 1 + 1;
    // 文字列と変数を結合して表示する
    $name = "PHP";
    echo "Hello! $name";
    ?>
  </h1>
  <div>
    <?php
    // 時刻
    echo "<br>";
    $today = new DateTime(); // 現在の日時を取得
    $today->setTimezone(new DateTimeZone("Asia/Tokyo")); // タイムゾーンを設定
    echo $today->format("Y-m-d H:i:s"); // 日時を表示
    echo "<br>";
    ?>
  </div>
</body>

</html>