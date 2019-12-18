<!-- 投稿フォームに値が入っているかで条件分岐 -->
<?php if( empty($_POST['msg'])): ?>
	<?php
	//エラー変数の初期化
	$error_name = null;
	$error_text = null;

	//エラーメッセージの変数への代入
	if(empty($_POST['msg'])){
		$error_msg = '投稿文を入力してください';
	};
	?>


	<!DOCTYPE html>
	<html lang = “ja”>
	<head>
		<meta charset = “UFT-8”>
		<title>投稿作成</title>
		<link rel="stylesheet" href="../../css/style_post.css">
	</head>

	<body>
		<h1 class="title">投稿作成</h1>
		<p class="descriot">以下の項目にご記入の上、「送信」ボタンを押してください</p>
		<form id="sub_form" action = "./incert.php" method = "post" autocomplete="off">
			<div class="post">
				<label>投稿文</label>
				<label class="test">必須</label>
				<textarea class="post_area" name="msg" ></textarea>
				<?php if(!empty($error_msg)):?>
				<p class="caution"><?php echo $error_msg?></p>
				<?php endif ?>
			</div>
			<button type = "submit" class="sub_button">送信</button>
		</form>
		</body>
	</html>
<?php  else: ?>

	<?php
	session_start();
	// 変数の初期化 & 日時の取得
	date_default_timezone_set('Asia/Tokyo');
	$sql = null;
	$res = null;
	$dbh = null;
	$date = date('Y-m-d H:i:s');

	//$name = htmlspecialchars($_POST['name'],ENT_QUOTES,"UTF-8");
	$name = $_SESSION["name"];
	$msg = htmlspecialchars($_POST['msg'],ENT_QUOTES|ENT_HTML5, "UTF-8");
	try {
		// DBへ接続
		$dbh = new PDO("mysql:host=127.0.0.1; dbname=board; charset=utf8", 'test_user', 'Test_pass_2019',array(PDO::ATTR_EMULATE_PREPARES => false));
		
		// SQL作成
		$sql = "INSERT INTO contents (
			name, post_datetime, post_sentence
		) VALUES (
			'$name', '$date', :msg
		)";
		//クエリの準備
		$stmt = $dbh ->prepare($sql);
		//sql文への値のバインド
		$stmt->bindValue(':msg',$msg,PDO::PARAM_STR);
		//sqlの実効
		$stmt->execute();
		
		// $res = $dbh->query($sql);
		//echo "接続成功";

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
		<title>追加完了</title>
	</head>
	<body>
	<P>追加完了</p>          
	<p>
		<a href="../page_login_after.php">投稿一覧へ</a>
	</p> 
	</body>
	</html>

<?php endif; ?>