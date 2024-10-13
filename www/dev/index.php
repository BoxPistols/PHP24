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
    $name = "PHP";
    echo "Hello! $name";
    ?>
  </h1>
  <div>
    <?php
    // 時刻
    // echo "<br>";
    // $today = new DateTime(); // 現在の日時を取得
    // $today->setTimezone(new DateTimeZone("Asia/Tokyo")); // タイムゾーンを設定
    // echo $today->format("Y-m-d H:i:s"); // 日時を表示
    ?>
  </div>
  <br>
  <div style="display: grid;">
    <?php
    // echo $i + 1 . "<br>";
    // $i = 1;

    // while ($i <= 10):
    //   echo "$i 日<br>";
    //   if ($i === 1) echo "Good Morning!<br>";
    //   $i++;
    // endwhile;

    // for
    // echo "<br>";
    // for ($i = 1; $i <= 10; $i++):
    //   if ($i % 2 == 0) {
    //     continue;
    //   }
    //   echo "$i Day<br>";
    // endfor;

    // 1年後の日付を表示
    $day = new DateTime();
    // $day->setTimezone(new DateTimeZone("Asia/Tokyo"));
    date_default_timezone_set("Asia/Tokyo");

    // for ($i = 0; $i <= 20; $i++):
    //   $time = strtotime("+$i day");
    //   $day = date('n/j(D)', $time);
    //   echo "$day<br>";
    // endfor;

    // week
    $week_name = ["日", "月", "火", "水", "木", "金", "土"];
    $week = date('w');
    // echo $week_name[$week];

    // 1年後の日付を表示
    $day = new DateTime();
    echo $day->format('Y-m-d H:i:s') . " (" . $week_name[$week] . ")<br>";
    ?>

    <dl>
      <?php
      // 連想配列
      // $fruits = ["apple", "banana", "orange"];
      // echo $fruits[1] . "<br>";

      // $data = [
      //   "name" => "PHP",
      //   "class" => "Aクラス",
      //   "apple" => "りんご",
      //   "melon" => "メロン",
      // ];
      // echo json_encode($data);
      // echo $data["class"] . "<br>";
      ?>
      <!-- <?php foreach ($data as $key => $dddddd): ?>
        <dt>
          <?php echo $key; ?>
        </dt>
        <dd>
          <?php echo $value; ?>
        </dd>
      <?php endforeach; ?> -->
    </dl>

    <!-- 営業時間の分岐 -->
    <?php
    $time = date('G');
    echo "{$time}時<br>";
    ?>
    <p>
      <?php
      if ($time < 10) :
        echo "準備中";
      elseif ($time < 18) :
        echo "営業中";
      else :
        echo "閉店中";
      endif;
      ?>
    </p>

    <?php
    $s = 'some';
    if ($s !== '') :
      echo "文字が入力されています";
    else :
      echo "文字が入力されていません";
    endif;
    ?>
  </div>
</body>

</html>