<?php
require __DIR__ . '/__connect_db.php';
$page_name = 'user_register';
?>

<form id="myform" action="/action_page.php">
<br>
  <p>電子信箱 user_email</p>
  <input type="text" name="user_email" value="">
  <br>
  <p>使用者名字 user_name</p>
  <input type="text" name="user_name" value="">
  <br>
  <p>電話 user_phone</p>
  <input type="text" name="user_phone" value="">
  <br>
  <p>密碼 user_password</p>
  <input type="text" name="user_password" value="">
  <br>
  <p>照片 user_photo</p>
  <input type="text" name="user_photo" value="">
  <br>



  <input type="submit" value="註冊">
  <script>
  let myform = $('#myform');
  let r_btn = $('.register_btn');
  let infos = {
    user_email $('#user_email');
    user_name $('#user_name');
    user_phone $('#user_phone');
    user_password $('#user_password');
    user_photo $('#user_photo');
  },
  </script>
</form>