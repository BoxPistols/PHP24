<?php
// データベース接続情報
$servername = "db";
$username = "cruduser";
$password = "crudpassword";
$dbname = "crudapp";

// データベース接続（リトライロジック付き）
$retry_count = 0;
$max_retries = 10;
$conn = null;

while ($retry_count < $max_retries) {
  $conn = @new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    $retry_count++;
    sleep(1);
  } else {
    break;
  }
}

if ($conn->connect_error) {
  die("Connection failed after $max_retries attempts: " . $conn->connect_error);
}

// テーブル作成（存在しない場合）
$sql = "CREATE TABLE IF NOT EXISTS memos (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sql);

// メモの追加
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['content']) && !isset($_POST['update_id'])) {
  $content = $conn->real_escape_string($_POST['content']);
  $sql = "INSERT INTO memos (content) VALUES ('$content')";
  if ($conn->query($sql) === TRUE) {
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
  }
}

// メモの更新
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_id']) && isset($_POST['content'])) {
  $id = (int)$_POST['update_id'];
  $content = $conn->real_escape_string($_POST['content']);
  $sql = "UPDATE memos SET content = '$content' WHERE id = $id";
  if ($conn->query($sql) === TRUE) {
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
  }
}

// メモの削除
if (isset($_GET['delete'])) {
  $id = (int)$_GET['delete'];
  $sql = "DELETE FROM memos WHERE id = $id";
  $conn->query($sql);
  header("Location: " . $_SERVER['PHP_SELF']);
  exit();
}

// メモの取得
$result = $conn->query("SELECT * FROM memos ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/asagiri@0.1.1/css/main.min.css">
  <link rel="stylesheet" href="style.css">
  <title>Simple Memo</title>
</head>

<body>
  <h1>Simple Memo</h1>
  <form method="post" style="margin-bottom: 20px; display: grid; gap: 10px; grid-template-columns: 1fr auto; align-items: end;">
    <textarea name="content" required></textarea>
    <button type="submit">メモを追加</button>
  </form>

  <h2
    class="heading_2">メモ一覧</h2>
  <ul>
    <?php while ($row = $result->fetch_assoc()): ?>
      <li>
        <div class="memo-content">
          <?php echo nl2br(htmlspecialchars($row['content'])); ?>
        </div>
        <div class="memo-actions">
          <small><?php echo $row['created_at']; ?></small>
          <div>
            <button class="show-update-form" onclick="showUpdateForm(<?php echo $row['id']; ?>)">編集</button>
            <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('本当に削除しますか？');">削除</a>
          </div>
        </div>
        <form method="post" class="update-form" id="update-form-<?php echo $row['id']; ?>">
          <input type="hidden" name="update_id" value="<?php echo $row['id']; ?>">
          <textarea name="content" required><?php echo htmlspecialchars($row['content']); ?></textarea>
          <button type="submit">更新</button>
        </form>
      </li>
    <?php endwhile; ?>
  </ul>

  <script>
    function showUpdateForm(id) {
      var form = document.getElementById('update-form-' + id);
      form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
  </script>
</body>

</html>