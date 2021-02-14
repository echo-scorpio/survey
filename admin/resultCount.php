<?php 
session_start();
include_once("../conn/config.php");
include_once("../conn/function.php");
header("Content-Type:text/html;charest:utf-8");
login_check($_SESSION[name],$_SESSION[data]);
$surid=$_GET[surid];
//查询当前问卷名称及填写问卷调查的次数
$survey=mysql_query("select * from tb_survey where SurId = '$surid' ");
$survey_arr=mysql_fetch_array($survey);
//问卷名称
$survey_name=$survey_arr['title'];


$userCount=$count_arr['userId'];



?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查看问卷回收情况</title>
<link href="../css/userCount.css" rel="stylesheet" type="text/css" />

</head>
<body>
    <p><?php echo "$survey_name"?>---回收情况<p>
    <ul><li>已参与</li><li>未参与</li></ul>
    <div class="container">
    <div class="part">
        <table class="tab">
  <tr>
    <td align="center" style="color:red">学号</td>
    <td align="center" style="color:red">姓名</td>
  </tr>
  <tr>
      <?php 
            $count=mysql_query("select uid,name from tb_user_info where uid in(select uid from tb_user_answered where sid = '$surid' order by id)");
            while($count_arr=mysql_fetch_array($count)){
                echo "<tr>";
                echo "<td>$count_arr[uid]</td>";
               echo "<td>$count_arr[name]</td>";
               echo "</tr>";
            }
        
        ?>
    
  </tr>
</table>
 
  </div>
    <div class="yetPart">

         <table class="tab">
  <tr>
    <td align="center" style="color:red">学号</td>
    <td align="center" style="color:red">姓名</td>
  </tr>
  <tr>
      <?php 
             $no=mysql_query("select uid,name from tb_user_info where uid in(select userId from tb_userlogin where userId not in(select uid from tb_user_answered where sid='$surid'))");
              while($no_arr=mysql_fetch_array($no)){
                  echo "<tr>";
                echo "<td>$no_arr[uid]</td>";             
                 echo "<td>$no_arr[name]</td>";
                echo "</tr>";              
               

            }
        ?>
    
  </tr>
</table>
        
        <div>

    </div>
</body>
</html>