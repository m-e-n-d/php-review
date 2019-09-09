<?php
define( 'FILENAME','./message.txt');
date_default_timezone_set('Asia/Tokyo');
$now_date = null;
$data = null;
$file_handle = null;
$split_data = null;
$message = array();
$message_array = array();
if( !empty($_POST['send'])) {
  if( $file_handle = fopen( FILENAME,"a")) {
    $now_date = date("Y-m-d H:i:s");
    $data = "'".$_POST['name']."','".$_POST['message']."','".$now_date."'\n";
    fwrite( $file_handle, $data);
    fclose( $file_handle);
  }
  if( $file_handle = fopen( FILENAME,'r') ) {
    while( $data = fgets($file_handle) ){
      $split_data = preg_split( '/\'/', $data);
        $message = array(
            'name' => $split_data[1],
            'message' => $split_data[3],
            'post_date' => $split_data[5]
        );
        array_unshift( $message_array, $message);
        echo $data . "<br>";
    }
    fclose( $file_handle);
}
var_dump($_POST);
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
 <form method="post">
   <div>
    <label for="name">名前</label><br>
    <input type="text" id="name" name="name">
   </div>
   <div>
    <label for="title">タイトル</label><br>
    <input type="text" id="title" name="title">
   </div>
   <div>
    <label for="message">以下にコメントをお書きください</label><br>
    <textarea rows="3" cols="50" maxlength="150" id=message name="message"></textarea><br>
   </div>
   <input type="submit" name="send" value="投稿する">
 </form>
  <button type="button" onclick="location.href='index.php'">キャンセル</button>
  <hr>
 <section>
 <?php if( !empty($message_array) ): ?>
 <?php foreach( $message_array as $value ): ?>
 <article>
     <div class="info">
         <h2><?php echo $value['name']; ?></h2>
         <time><?php echo date('Y年m月d日 H:i', strtotime($value['post_date'])); ?></time>
     </div>
     <p><?php echo $value['message']; ?></p>
 </article>
 <?php endforeach; ?>
 <?php endif; ?>
 </section>
</body>
</html>

