<?php if(empty($_POST['name']) or empty($_POST['email']) or empty($_POST['pass'])): ?>

<?php
//エラー変数の初期化
$error_name = null;
$error_email = null;
$error_pass = null;
//エラーメッセージの変数への代入
if(empty($_POST['name'])){
    $error_name = 'ニックネームを入力してください';
};
if(empty($_POST['email'])){
    $error_email = 'アドレスを入力してください';
};
if(empty($_POST['pass'])){
    $error_pass = 'パスワードを入力してください';
};
?>


<!DOCTYPE html>
<html lang = “ja”>
<head>
    <meta charset = “UFT-8”>
    <title>メンバー登録</title>
    <link rel="stylesheet" href="../css/style_user_reg.css">
</head>

<body>
    <h1 class="title">メンバー登録</h1>
    <p class="descriot">以下の項目にご記入の上、「送信」ボタンを押してください</p>
    <form id="sub_form" action = "./user_registration.php" method = "post">
        <div class="name">
            <label>ニックネーム</label>
            <label class="test">必須</label>
            <input type = "text" name ='name' placeholder="ニックネーム">
            <?php if(!empty($error_name)):?>
            <p class="caution"><?php echo $error_name?></p>
            <?php endif ?>
        </div>
        <div class="mail">
            <label>mail-address</label>
            <label class="test">必須</label>
            <input type = "email" name ='email' placeholder="mail-address">
            <?php if(!empty($error_email)):?>
            <p class="caution"><?php echo $error_email?></p>
            <?php endif ?>
        </div>
        <div class="pass">
            <label>password</label>
            <label class="test">必須</label>
            <input type = "password" name ='pass' minlength="8" placeholder="パスワード">
            <?php if(!empty($error_pass)):?>
            <p class="caution"><?php echo $error_pass?></p>
            <?php endif ?>
        </div>
        <button type = "submit" class="sub_button">送信</button>
    </form>
    </body>
</html>
<?php  else: ?>
  <?php

      // 変数の初期化 & 日時の取得
      $sql = null;
      $res = null;
      $dbh = null;

      //変数の入れ込み
      $name = $_POST['name'];
      $email = $_POST['email'];
      $hash_pass = password_hash($_POST['pass'],PASSWORD_DEFAULT);

      //echo $name;
      //echo $email;
      //echo $hash_pass;

      try {
          // DBへ接続
          $dbh = new PDO("mysql:host=127.0.0.1; dbname=board; charset=utf8", 'test_user', 'Test_pass_2019');
          
          // SQL作成
          $sql = "INSERT INTO user (
              name, address, pass 
          ) VALUES (
              '$name', '$email', '$hash_pass'
          )";

          $dbh->query($sql);

          // SQL実行
          // db_connect($sql);
          echo "接続成功";
          // $res = $dbh->query($sql);

      } catch(PDOException $e) {
          echo "接続失敗";
          echo $e->getMessage();
          die();
      }

      // 接続を閉じる
      $dbh = null;

  ?>
  <!DOCTYPE html>
  <html>
  <head>
      <meta charset="utf-8">
      <title>登録完了</title>
  </head>
  <body>
  <P>登録完了</p>          
  <p>
      <a href="../index.php">投稿一覧へ</a>
  </p> 
  </body>
  </html>

<?php endif; ?>

