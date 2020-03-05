<?php

    include_once ("conn/config.php");
    include_once("./conn/function.php");
    //判断是否登录，在function中的login_check函数进行判断
    user_login_check($_SESSION[name1],$_SESSION[data1]);

    header("Content-Type:text/html;charset=utf-8");
    $survey=mysql_query("select * from tb_survey order by SurId");
    while($survey_arr=mysql_fetch_array($survey)){//循环显示出从数据库中查出的问卷
        $survey_id=$survey_arr[SurId];
        $survey_title=$survey_arr[title];
        $survey_desc=$survey_arr[description];
        $content .=<<<END
       <table class="tab4">
	<tr>
	<td style="width:100px;"><b>问卷名称</b></td>
	<td><b><a href="surveyview.php?surid=$survey_id">$survey_title</a></b></td><!--显示出问卷名称，用户点击以后进入surveeyview页面显示问卷的详情-->
	</tr>
	<tr>
	<td style="width:100px;"></td>
	<td>$survey_desc</td>
	</tr>
	</table>	

END;
    }
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>大学生问卷调查系统</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container">
        <div class="blank"></div>
            <div class="header">
                <div class="logo"><img src="images/logo.png"/></div>
                <div class="header-title">北京工业职业技术学院-问卷调查系统</div>
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
</html>