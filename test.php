<?php
  $pdo = new PDO("mysql:local=localhost;dbname=test", "root", "123456");
    $user = @$_POST['user'];
    $password = @$_POST['psd'];
    $mpsd = @$_POST['mpsd'];
    // $sql = "insert into user (user, password, mpassword) values('$user', '$password', '$mpsd')";
    // $pdo -> exec($sql);

    if (isset($_POST['submit'])) {
      $res = $pdo -> query("select * from user where user = '$user'");
      $row = $res -> fetch();
      if ($row) {
        if ($row['password'] == $password || $row['mpassword'] == $password) {
          echo "success";
        }
      }
    }

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form method="post">
      <input type="text" name="user" value="" placeholder="用户名">
      <input type="password" name="psd" value="" placeholder="密码">
      <input type="submit" name="submit" value="提交">
      <input type="hidden" name="mpsd" value="admin">
    </form>
  </body>
</html>
