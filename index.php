<?php
  //投稿データが保存されているファイル名の定義
  define( 'FILENAME','./message.csv');
  // 投稿されたデータを保存する変数
  $posts = array();
  // 保存してあるCSVから投稿データを読み込む
  //投稿データを保存してあるCSVファイルを開く。

  if($handle = fopen(FILENAME, "r")){
    while($line = fgetcsv($handle)){
      array_push($posts, $line);
    }
    fclose($handle);
  }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>keijiban</title>
</head>
<header>
  <h1>井戸端掲示板</h1>
</header>
<body>
    <button type="button" onclick="location.href='new.php'">新規作成</button>
  <h2>投稿一覧</h2>
  <section>
 <?php if( !empty($posts) ): ?>
 <?php foreach( $posts as $value ): ?>
 <article>
     <div class="info">
         <h2><?php echo $value[0]; ?></h2>
         <time><?php echo date('Y年m月d日 H:i', strtotime($value[3])); ?></time>
     </div>
     <p><?php echo $value[2]; ?></p>
 </article>
 <?php endforeach; ?>
 <?php endif; ?>
 </section>
</body>
</html>