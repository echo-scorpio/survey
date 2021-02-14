<?php 
    session_start();
    include_once("../conn/config.php");
    include_once("../conn/function.php");
    //判断是否登录，在function中的login_check函数进行判断
    login_check($_SESSION[name],$_SESSION[data]);

    //获取参数
 $surid=$_GET[surid];//从地址栏获得的
$submit=$_POST[submit];//从底部的添加问卷的input框获得
$surveyname=$_POST[surveyname];//添加问卷的问卷名称
$description=$_POST[description];//添加问卷对问卷的描述
$action=$_GET[action];
if($submit){
    
	if($surveyname){
       
		mysql_query("set sql_mode=''");
		$success = mysql_query("INSERT INTO tb_survey VALUES ('', '$surveyname', '0', '$description')");
		if($success){
			$surid = mysql_insert_id(); //函数返回上一步 INSERT 操作产生的 ID。$surid=上次插入的id
			// header("Location: index.php?surid=$surid");
            // echo "<script>alert('添加问卷成功')</script>";      
            echo "<script> alert('添加问卷成功');parent.location.href='index.php?surid=$surid'; </script>";  
                
			
            echo "<script>alert('$surid')</script>";    
		}
		else{
			echo "<script>alert('添加问卷失败')</script>";
		}
	}
}	
//删除问卷
if($action=="delete"){
	if ($surid){
		$success =  mysql_query("DELETE FROM tb_survey WHERE SurId =' $surid'");
		$success = ( mysql_query("DELETE FROM tb_question WHERE SurId ='$surid'") ) ? $success : false;
		$success = ( mysql_query("DELETE FROM tb_answer WHERE SurId = '$surid'") ) ? $success : false;
		$message = ($success) ? "删除问卷成功" : "删除问卷失败";
		echo "<script>alert('$message')</script>";
		echo "<script>window.location.href='index.php';</script>";
	}
}

//添加问卷



$content .=  <<<END
<!-- 页面跳转动作写在了这个js里-->
    <script language="javascript" type="text/javascript" src="../conn/jssurvey.js"></script>
END;
    //内容部分
    $content .= <<<END
    <table class="tab1">
    <form name="choosesurvey" action="index.php" method="post">
    <tr>
    <td>
    <img src="../images/choosesurvey.gif" width=109 height=22 />
    </td>
    </tr>
    <tr>
    <td align=right width=120><b>问卷列表：</b></td>
	<td><select name=choosesurvey onchange="ChangeSurvey()">
END;

    //像数据库查询问卷
    $survey=mysql_query("select * from tb_survey");
    while($survey_arr = mysql_fetch_array($survey)){
        $survey_list[]=$survey_arr;
    }

    if(sizeof($survey_list)>0){
        $content .= "<option value=0>请选择问卷</option>";
        
        for($i=0;$i<sizeof($survey_list);$i++){
            $selected=($survey_list[$i]["SurId"]==$surid)?"selected":"";
            $content .= "<option $selected value=".$survey_list[$i]["SurId"].">".$survey_list[$i]["title"]."</option>";
        }

    }
    else{
        $content .= "<option>无问卷</option>";
    }

    //操作问卷按钮
    $content .= <<<END
    </select></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
        <input type=button  onclick="EditSurvey()" value="添加问题">
        <input type=button onclick="ViewSurvey($surid)" value="查看问卷">
         <input type=button onclick="DeleteSurvey($surid)" value="删除问卷">
        <input type=button onclick="ViewResult($surid)" value="统计结果">
         <input type=button onclick="ResultCount($surid)" value="回收情况">
         <input type=button onclick="addUser()" value="批量导入用户">
        </td>
    </tr>

    </form>
    </table>
    <hr width=700px align=center>
END;

//问卷名称
$content .= <<<END
    <table class="tab1">
    <form name=addsurvey action=index.php method=POST>
        <tr>
        <td><img src="../images/addsurvey.gif" width=109 height=22></td>
        </tr>
        <tr>
       <td align=right width=120><b>问卷名称：</b></td>
	<td><input type=text name=surveyname  value=""></TD>
    
    </table>
END;


//问卷描述
$content .= <<<END
    <tr>
       <td align=right valign=top><b>问卷描述：</b></td>
	<td><textarea name=description wrap=physical></textarea></td>
    </tr>
END;

//操作按钮
$content .= <<<END
    <tr>
    <td></td>
    <td>
    <input type=submit name=submit value="添加问卷">
    <input type=button onclick="clearForm()" value="清空">
  
    </td>
    </tr>
    </form></table>
END;
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
                <div class="log-out" onclick="logout()">退出</div>
            </div>
            <div class="main">
                <div class="blank"></div>
                <div class="location">
		            当前位置：问卷首页>问卷列表
	            </div>
            <hr></hr>
            <?php echo $content;?>
            </div>
    </div>
</body>
<script>
    function logout() {
        window.open('./login.php');
    }
</script>
</html>