<?php
    //session開始
    session_start();

    //postで送られたメールアドレスを変数に格納
    $pass_sub = $_POST["pass"];
    $email = $_POST["email"];

    
    //データベースとの接続＆パスワードの抽出
    try {
    
        $dbh = new PDO("mysql:host=127.0.0.1; dbname=board; charset=utf8", 'test_user', 'Test_pass_2019');      
    
        $sql = "SELECT name,pass FROM user where address = :email";
    
        $stmt = $dbh->prepare($sql);
        //sqlの変数部分(:email)に値をバインド
        $stmt->bindValue(':email', $email,PDO::PARAM_STR);

        $stmt->execute();
    
        $result = 0;
    
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); //二重の配列になっている
    
    } catch (Exception $e) {
              echo 'エラーが発生しました。:' . $e->getMessage();
    }
    
    //ニックネーム・パスワードを変数に入れ込み
    $result_2 = $result[0];
    $name = $result_2["name"];
    $pass = $result_2["pass"];


    //ログイン判定
    if(password_verify($pass_sub, $pass)){
        //session変数の初期化
        unset($_SESSION["name"]);
        //session変数への代入
        $_SESSION["name"] = $name;
        //sessionのidを変更
        $_SESSION["id"] = $pass;
        //ログイン後ページへ遷移
        header("location:page_login_after.php");
        exit;
    }else{
        //session変数の初期化
        unset($_SESSION["email"]);
        unset($_SESSION["pass"]);
        //session変数への代入
        $_SESSION["pass"] = $pass_sub;
        $_SESSION["email"] = $email;
        //ログインページへ遷移
        header("location:login.php");
        exit;
    };

?>