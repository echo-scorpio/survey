<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
</html>
<?php
    error_reporting(0);//关闭错误报告
    $db_host='localhost';
    $db_user='root';
    $db_pass='root';
    $db_name='db_survey';
    $db_ok=mysql_connect($db_host,$db_user,$db_pass);
    mysql_select_db($db_name);
    mysql_query('set names utf8');
    //测试数据库是否连接成功
    // if($db_ok){
    //     echo "success";
    // }
    // else{
    //     echo"can not connect to database";
    // }
    
?>