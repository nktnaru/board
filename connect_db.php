<?php
class connet{
    const host = '1277.0.0.1';
    const dbname = 'board';
    const UTF = 'utf8';
    const user = 'test_user';
    const dbpass = 'Test_pass_2019' ;

    //DB接続(PDOの引数の変数化ができていない…)
    function pdo(){
        $dsn = "mysql:host=".self::host.";dbname=".self::dbname.";charset=".self::UTF;
        $user_name = self::user;
        $dbpass = self::dbpass;

        try{
            // $dbh = new PDO($dsn,'$user_name','$dbpass',array(PDO::ATTR_EMULATE_PREPARES => false));
            $dbh = new PDO("mysql:host=127.0.0.1; dbname=board; charset=utf8", 'test_user', 'Test_pass_2019',array(PDO::ATTR_EMULATE_PREPARES => false));

        }catch (Exception $e) {
            echo 'エラーが発生しました。:' . $e->getMessage();
        };
        return $dbh;
    }

    //index.phpとpage_login_afterでの値を持ってくる
    function select($sql){
        $dbh = $this->pdo();
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $result = 0;
        $result = $stmt->fetchall(PDO::FETCH_ASSOC); //staticメソッドへのアクセス
        return $result;
    }

    //ログイン機能で使用
    function select_log_judg($sql,$email){
        $dbh = $this->pdo();
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':email', $email,PDO::PARAM_STR);
        $stmt->execute();
        $result = 0;
        $result = $stmt->fetchall(PDO::FETCH_ASSOC); //staticメソッドへのアクセス
        return $result;
    }

    //新規登録機能で使用
    function incert_reg($sql,$name="",$email="",$hash_pass=""){
        $dbh = $this->pdo();
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':name', $name,PDO::PARAM_STR);
        $stmt->bindValue(':email', $email,PDO::PARAM_STR);
        $stmt->bindValue(':pass', $hash_pass,PDO::PARAM_STR);
        $stmt->execute();
        //接続を閉じる
        $dbh = null;
    }
    
    //投稿機能で使用
    function incert_msg($sql,$msg=""){
        $dbh = $this->pdo();
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':msg',$msg,PDO::PARAM_STR);
        $stmt->execute();
        //接続を閉じる
        $dbh = null;
    }

    //削除機能で使用
    function delete($sql,$id){
        $dbh = $this->pdo();
        $stmt = $dbh->prepare($sql);
        //sql文へ値のバインド
        $stmt->bindValue(':id',$id,PDO::PARAM_STR);
        //実効
        $stmt->execute();
        $dbh = null;
    }

}
?>