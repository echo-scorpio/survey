<?php 
session_start();
include_once("./conn/config.php");
header("Content-Type:text/html;charest=utf-8");
if($_POST[submit]){
    echo "$_POST[name]<br>$_POST[password]";
    $admin=mysql_query("SELECT * FROM tb_userlogin WHERE userId ='$_POST[name]'");
		$nameok=is_array($admin_row=mysql_fetch_array($admin));
        	if($nameok){
			if($_POST[password]==$admin_row[userPass]) $passwordok=ture;
			else $passwordok=false;	
		}
		
		if($passwordok){
            //保存session======
			$_SESSION[name1]=$_POST[name];
			$_SESSION[data1]=md5($admin_row[userId].$admin_row[userPass]);
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
    <title>用户登陆</title>
</head>
<body>
<div>
    <form name="login" action="user_login.php" method="post">
              <input class="username" name="name" type="text" placeholder="用户名" >
              
            <input class="userpass" name="password" type="password" id="password" placeholder="密码" />
              <input  value="登录"  type="submit" name="submit" class="login_but">
          </form>

</div>

</body>


</html>