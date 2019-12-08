<?php
//ページ内の表示数
define('MAX','4');
//データベースとの接続＆投稿コンテントの取り出し
try {
    //データベースへの接続
    $dbh = new PDO("mysql:host=127.0.0.1; dbname=board; charset=utf8", 'test_user', 'Test_pass_2019');      
    //sql
    $sql = "SELECT * FROM contents";
    //queryの実効
    $stmt = $dbh->query($sql);

    $result = 0;

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
          echo 'エラーが発生しました。:' . $e->getMessage();
}

//resultの配列数(contentの数)を取得
$contents_num = count($result);
//最大ページ数の取得
$max_page = ceil($contents_num / MAX);
if(!isset($_GET['page_id'])){ // $_GET['page_id'] はURLに渡された現在のページ数
    $now = 1; // 設定されてない場合は1ページ目にする
}else{
    $now = $_GET['page_id'];
}
$start_no = ($now - 1) * MAX;
//result配列のstart_noからMax個取得
$disp_data = array_slice($result, $start_no, MAX, true);
?>

<!-- 以下表示html -->
<!DOCTYPE html>
    <html lang = “ja”>
        <head>
            <meta charset = “UFT-8”>
            <title>掲示板</title>
            <link rel="stylesheet" href="css/style.css">
        </head>

    <body>
        <div class="absolute">
            <h1 class="title">掲示板</h1>
            <a href="./folder_second/login.php" class="login">ログイン</a>
            <a href="submit_user.html" class="reg">user登録</a>
        </div>

        <?php foreach($disp_data as $row): ?>
            <table>
                <tbody class="table_type">
                    <tr class="table_name">
                        <th>名前</th>
                        <td><?php echo $row["name"] ?></td>
                    </tr>
                    <tr class="table_time">
                        <th>時間</th>
                        <td><?php echo $row["post_datetime"] ?></td>
                    </tr>
                    <tr class="table_post">
                        <td><?php echo $row["post_sentence"] ?></td>
                    </tr>  
                </tbody>
            </table>
            <?php endforeach; ?>
            <div class="page">
                <?php for($i = 1; $i <= $max_page; $i++): ?> <!--最大ページ数分リンクを作成 -->
                    <a class="pagging" href="./index.php?page_id=<?php echo $i ?>"><?php echo $i ?></a>    
                <?php endfor; ?>
            </div>
    </body>
</html>
