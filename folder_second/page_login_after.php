<!-- session変数のIDに値が入っているかいないかで条件分岐 -->
<?php session_start();?>
<?php if(empty($_SESSION["id"])):?>
    <?php 
        header("location:login.php");
        exit;
    ?>

<?php elseif(!empty($_SESSION["id"])):?>
    <?php
        define('MAX','4');
        $name = $_SESSION["name"];
        //データベース接続&掲示板のコンテンツの取り出し
        try {
    
            $dbh = new PDO("mysql:host=127.0.0.1; dbname=board; charset=utf8", 'test_user', 'Test_pass_2019');      
    
            // echo '接続完了';
            $sql = "SELECT * FROM contents";
            $stmt = $dbh->query($sql);
            $result = 0;
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        } catch (Exception $e) {
                echo 'エラーが発生しました。:' . $e->getMessage();
        };

        $contents_num = count($result);
        $max_page = ceil($contents_num / MAX);
        if(!isset($_GET['page_id'])){ // $_GET['page_id'] はURLに渡された現在のページ数
            $now = 1; // 設定されてない場合は1ページ目にする
        }else{
            $now = $_GET['page_id'];
        }
        $start_no = ($now - 1) * MAX;
        $disp_data = array_slice($result, $start_no, MAX, true);
    ?>

    <!DOCTYPE html>
        <html lang = “ja”>
            <head>
                <meta charset = “UFT-8”>
                <title>掲示板</title>
                <link rel="stylesheet" href="../css/style_login_after.css">
            </head>

        <body>
            <div class="absolute">
                <h1 class="title">掲示板</h1>
                <a href="./folder_third/post_incert.html" class="post">新規投稿</a>
                <a href="./logout.php" class="logout">ログアウト</a>
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
                        <!-- 「データベースのニックネーム」と「セッションのネーム」が一緒の時実効 -->
                        <?php if($row["name"] == $_SESSION["name"]):?>
                            <tr class="table_delete">
                            <td><a class="table_delete" href="./delete.php?id=<?php echo $row["id"] ?>">削除</td>
                            </tr>
                        <?php endif;?>
                    </tbody>
                </table>
                <?php endforeach; ?>
                <div class="page">
                    <?php for($i = 1; $i <= $max_page; $i++): ?> <!--最大ページ数分リンクを作成 -->
                        <a class="pagging" href="./page_login_after.php?page_id=<?php echo $i ?>"><?php echo $i ?></a>    
                    <?php endfor; ?>
                </div>
        </body>
    </html>


<?php endif;?>
