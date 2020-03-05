

<?php
/*
*管理登陆页面，创建Session
*/

session_start();
include_once("../conn/config.php");
header("Content-Type:text/html;charset=utf-8");

//登陆判断，成功则保存session
	if($_POST[submit]){

		$admin=mysql_query("SELECT * FROM tb_admin WHERE name ='$_POST[name]'");
		$nameok=is_array($admin_row=mysql_fetch_array($admin));
		
		if($nameok){
			if($_POST[password]==$admin_row[pass]) $passwordok=ture;
			else $passwordok=false;	
		}
		
		if($passwordok){
            //保存session======
			$_SESSION[name]=$_POST[name];
			$_SESSION[data]=md5($admin_row[name].$admin_row[pass]);
			header("Location: index.php");
		}
		else{
			echo "<script> alert('用户名或密码错误')</script>";
            //密码错误，不保存session
			session_unset();
            session_destroy();	
		}
	}
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>管理员登陆</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body style="background:#93defe; background-size: cover;">
   <div class="login_box">
      <div class="login_l_img"><img src="../images/login-img.png" /></div>
      <div class="login">
          <div class="login_logo"><a href="#"><img src="../images/login_logo.png" /></a></div>
          <div class="login_name">
               <p>后台管理系统</p>
          </div>
          <form name="login" action="login.php" method="post">
              <input class="username" name="name" type="text" placeholder="用户名" >
              
            <input class="userpass" name="password" type="password" id="password" placeholder="密码" />
              <input  value="登录"  type="submit" name="submit" class="login_but">
          </form>
      </div>
      
</div>
</body>
</html>