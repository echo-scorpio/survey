<?php 
session_start();
include_once("../conn/config.php");//链接数据库
include_once("../conn/function.php");//判断是否登录js
header("Content-Type:text/html;charest:utf-8");

login_check($_SESSION[name],$_SESSION[data]);//判断是否登录函数

//获取参数
$surid=$_GET[surid];

//查询当前问卷名称及填写问卷调查的次数
$survey=mysql_query("select * from tb_survey where SurId = '$surid' ");
$survey_arr=mysql_fetch_array($survey);
//问卷名称
$survey_name=$survey_arr['title'];
//调查问卷被填写的次数
$survey_time=$survey_arr['times'];

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
		            当前位置：问卷首页>问卷列表
	            </div>
            <hr></hr>
            <!-- 标题、描述 -->
                <div class="title">
                    <h1><?php echo $survey_name?>——统计结果<h1>
                    <p>共收回问卷<?php echo $survey_time?>份</p>                
                </div>
            <!-- 问卷内容 -->
            <div class="content">
                <?php 
                    $question=mysql_query("select * from tb_question where SurId='$surid' ");
                    $i=1;//题号

                    //遍历问题
                    while($question_arr=mysql_fetch_array($question)){
                        $j='A';//选项ABCD
                        $times_sum=0;//投票的总次数

                        //求某一问题的总票数
                        $times=mysql_query("select Times from tb_answer where QueId='$question_arr[QueId]' order by AnsId ");
                        //循环求出总票数
                        while($times_arr=mysql_fetch_array($times)){
                                $times_sum+=$times_arr[Times];
                        }

                        //选择题题目样式、总票数
                        if($question_arr[Type]=='radio' || $question_arr[Type]=='checkbox'){
                                echo "<dl> <dt><b>{$i}、{$question_arr[Title]}</b> <span style='color:#f00;'>共计 $times_sum 票</span></dt>";
                               
                        }
                      

                        //单选、多选样式统计票数（百分比）
                        if($question_arr[Type]=='radio' || $question_arr[Type]=='checkbox'){
                                $answer = mysql_query("select * from tb_answer where QueId='$question_arr[QueId]' order by AnsId ");

                                //遍历答案
                                while($answer_arr=mysql_fetch_array($answer)){
                                       $persent= round(($answer_arr[Times]/$times_sum)*100,2);//round()把数值字段舍入为指定的小数位数。
                                       //输出ABCD、选项内容，被选票数，和所占百分比
                                       echo "<dd>{$j}.{$answer_arr[Content]}&nbsp;&nbsp;&nbsp;&nbsp;<span style='color:#f00'>$answer_arr[Times] 票 &nbsp;&nbsp;&nbsp;&nbsp;<progress max='100' value='$persent' class='jquery'></progress>&nbsp;&nbsp;&nbsp;&nbsp;$persent%
</span></dd>";
                                       $j++;
                                }
                        }

                      
                        echo "</dl>";
                        $i++;
                    }
                 $question=mysql_query("select * from tb_question where SurId='$surid' ");
                 while($question_arr=mysql_fetch_array($question)){
                        if($question_arr[Type]=='textarea'){
                            echo "<dl><dt><b>{$i}、{$question_arr[Title]}</b></dt>";
                                 echo "<dd style='margin:5px 0 20px;text-align:center;font-size:20px;'><a text-align='center' href='noteview.php?surid=$surid'>查看留言</a></dd></dl>";
                        }
                 }
                ?>
            </div>
            </div>
    </div>
</body>
</html>