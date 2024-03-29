<?php
    session_start();
    //session変数をすべて解除する 
    $_SESSION = array();

    // セッションを切断するにはセッションクッキーも削除する。
    // Note: セッション情報だけでなくセッションを破壊する。
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    };

    // 最終的に、セッションを破壊する
    session_destroy();

    header("location:../../index.php");
?>