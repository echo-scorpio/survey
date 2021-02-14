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



?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/userCount.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div align='center'>
<p>问卷调查系统---导入用户信息<p>
<form name="form2" method="post" enctype="multipart/form-data" action="importCheck.php">
<input type="hidden" name="leadExcel" value="true">
<table align="center" width="90%" border="0">
<tr>
   <td style="width: 260px;">
    <input type="file" name="file"><input type="submit" name="import" value="导入数据">
   </td>
   <td><a href="../downTemplate.xlsx" download="用户数据导入模板">下载模板</a></td>
</tr>
<tr>
    <td style="width:200px;">学号</td>
    <td style="width:200px;">姓名</td>
    <td style="width:200px;">性别</td>
</tr>
<tr>
      <?php 
            $count=mysql_query("select uid,name,sex from tb_user_info");
            while($count_arr=mysql_fetch_array($count)){
                echo "<tr>";
                echo "<td style='width:200px;'>$count_arr[uid]</td>";
               echo "<td style='width:200px;'>$count_arr[name]</td>";
               echo "<td style='width:200px;'>$count_arr[sex]</td>";

               echo "</tr>";
            }
        
        ?>
    
  </tr>
</table>
</form>
</div>
</body></html>