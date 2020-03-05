<?php 
session_start();
// 检测管理员是否登录
function login_check($name,$data){
    $admin=mysql_query("select * from tb_admin where name='$name'");
    $name_ok=is_array($admin_row=mysql_fetch_array($admin));
    if($name_ok){
        if($data==md5($admin_row[name].$admin_row[pass])){
            $data_ok=true;
        }
        else{
            $data_ok=false;
        }
    }

    if(!$data_ok){
        echo'<script type="text/javascript">alert("请先登陆！！")</script>';
	echo'<script type="text/javascript">window.location.href="login.php"</script>';
       
        exit();
        
    }
}


// 检测用户是否登录
function user_login_check($name1,$data1){
    $admin=mysql_query("select * from tb_userlogin where userID='$name1'");
    $name_ok=is_array($admin_row=mysql_fetch_array($admin));
    if($name_ok){
        if($data1==md5($admin_row[userId].$admin_row[userPass])){
            $data_ok=true;
        }
        else{
            $data_ok=false;
        }
    }

    if(!$data_ok){
        echo'<script type="text/javascript">alert("请先登陆！！")</script>';
	echo'<script type="text/javascript">window.location.href="user_login.php"</script>';
       
        exit();
        
    }
}

?>