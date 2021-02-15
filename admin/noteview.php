<?php 
/*结果统计页面*/

session_start();
include_once("../conn/config.php");//连接数据库
include_once("../conn/function.php");//判断是否登录js
header("Content-Type:text/html; charest:utf-8 ");
login_check($_SESSION[name],$_SESSION[data]);//判断是否登录函数

//获取参数
$surid=$_GET[surid];
$qid=$_GET[qid];
//查询当前问卷名称
$survey=mysql_query("select * from tb_survey where SurId = '$surid' ");
$survey_arr=mysql_fetch_array($survey);
$survey_name=$survey_arr[title];//查询当前问卷名称

$user=mysql_query("select * from tb_user where SurId = '$surid' and queId='$qid' order by Id desc ");//查询填写了当前问卷的用户有哪些

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>问卷调查系统后台</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container">
        <div class="blank"></div>
            <div class="header">
                <div class="logo"><img src="../images/logo.png" width="30px" height="30px"/></div>
                <div class="header-title">北京工业职业技术学院-问卷调查系统</div>
            </div>
            <div class="main">
                <div class="blank"></div>
                <div class="location">
		            当前位置：<a href='index.php'>管理首页</a>>问卷统计>查看留言
	            </div>
            <hr></hr>
                <!--问卷标题-->
                <div class="title">
                    <h1><?php echo $survey_name ?>——查看留言</h1>
                
                </div>

                <!--问卷内容-->
                <div class="content">
                    <?php 
                        echo "<table class='text_tab'> <tr><td><b>编号</b></td><td><b>用户邮箱</b></td><td><b>留言内容</b></td><td><b>时间</b></td></tr>";
                        $i=1;
                        while($user_arr=mysql_fetch_array($user)){
                                //获取回答问卷时间
                                $time=$user_arr[Time];
                                //时间格式转换
                                date_default_timezone_set('PRC');                  
                                $time = date('Y-m-d H:i:s',$time);
                                echo "<tr> <td>$i</td> <td>$user_arr[Mail]</td> <td><textarea  cols=30>$user_arr[Content]</textarea></td> <td>$time</td> </tr>";
				                $i++;
                        }

                        echo "</table>";
                    
                    ?>
                </div>
            </div>
    </div>
</body>
</html>