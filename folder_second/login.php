<?php session_start(); ?>
<?php if(empty($_SESSION["email"]) and empty($_SESSION["pass"])):?>
    <!DOCTYPE html>
    <html lang = “ja”>
    <head>
        <meta charset = “UFT-8”>
        <title>ログイン画面</title>
        <link rel="stylesheet" href="../css/style_user_reg.css">
    </head>

    <body>
        <h1 class="title">ログイン画面</h1>
        <p class="descriot">以下の項目にご記入の上、「送信」ボタンを押してください</p>
        <form id="sub_form" action = "login_judgment.php" method = "post" autocomplete="off">
            <div class="mail">
                <label>mail-address</label>
                <label class="test">必須</label>
                <input type = "email" name ='email' placeholder="メールアドレス">
            </div>
            <div class="pass">
                <label>password</label>
                <label class="test">必須</label>
                <input type = "password" name ='pass' minlength="8" placeholder="パスワード">
            </div>
            <button type = "submit" class="sub_button">login</button>
        </form>
        </body>
    </html>
<?php elseif(!empty($_SESSION["email"]) and !empty($_SESSION["pass"])):?>
    <!DOCTYPE html>
    <html lang = “ja”>
    <head>
        <meta charset = “UFT-8”>
        <title>ログイン画面</title>
        <link rel="stylesheet" href="../css/style_user_reg.css">
    </head>

    <body>
        <h1 class="title">ログイン画面</h1>
        <p class="descriot">以下の項目にご記入の上、「送信」ボタンを押してください</p>
        <form id="sub_form" action = "login_judgment.php" method = "post" autocomplete="off">
            <div class="mail">
                <label>mail-address</label>
                <label class="test">再度入力して下さい</label>
                <input type = "email" name ='email' value="<?php echo $_SESSION["email"] ?>">
            </div>
            <div class="pass">
                <label>password</label>
                <label class="test">再度入力して下さい</label>
                <input type = "password" name ='pass' minlength="8" value="<?php echo $_SESSION["pass"] ?>">
            </div>
            <button type = "submit" class="sub_button">login</button>
        </form>
        </body>
    </html>
<?php endif; ?>