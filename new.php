<?php
define( 'FILENAME','./message.csv');
date_default_timezone_set('Asia/Tokyo');

if(isset($_POST['name']) && isset($_POST['title']) &&isset($_POST['message']) ){
  saveAsCSV($_POST['name'], $_POST['title'], $_POST['message']);
  header('location:index.php');
}

 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>keijiban-toko</title>
</head>
<header>
  <h1>井戸端掲示板</h1>
</header>
<body>
 <form method="post" action=" ">
   <div>
    <label for="name">名前</label><br>
    <input type="text" id="name" name="name">
   </div>
   <div>
    <label for="title">タイトル</label><br>
    <input type="text" id="title" name="title">
   </div>
   <div>
    <label for="message">以下にメッセージをお書きください</label><br>
    <textarea rows="3" cols="50" maxlength="150" id=message name="message"></textarea><br>
   </div>
   <input type="submit" name="send"value="投稿する">
 </form>
  <button type="button" onclick="location.href='index.php'">キャンセル</button>
  <hr>
 
</body>
</html>

<?php
/////////////////////////////////
//CSVにセーブする関数
//$ message =>
//    $name：投稿者名
//    $title：投稿タイトル
//    $comment：投稿コメント
function saveAsCSV($name, $title, $message){
  // CSVに変換するarrayを作成
  $now_date = date("Y-m-d H:i:s");
  $data = $name.",".$title.",".$message.",".$now_date."\n";

  // CSVとして保存
  if($csv_file = fopen(FILENAME, "a")){
    fwrite($csv_file, $data);
    fclose($csv_file);
  }
}
?>