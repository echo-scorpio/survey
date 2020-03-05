<?php 
 include_once("conn/config.php");//链接数据库
 include_once("conn/function.php");//检查是否登录
 header("Content-Type:text/html;charest=utf-8");
 
 //获取参数
 $surid=$_GET[surid];
 //查找数据库，获取当前问卷名及描述
 $survey=mysql_query("select * from tb_survey where SurId='$surid'");
 $survey_arr=mysql_fetch_array($survey);
 $survey_name=$survey_arr[title];//问题名称
 $survey_desc=$survey_arr[description];//问题描述


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
		            当前位置：问卷首页>问卷填写
	            </div>
            <hr></hr>
           <!-- 问卷标题-->
           <div class="title">
                <!-- 问卷名-->
                
                <h1><?php echo $survey_name ?></h1>
                <p><?php echo $survey_desc ?></p>
           </div>
            <!-- 问卷内容-->
          <div class="content"><!--点击提交以后带值跳转到surveysave页面-->
                	<form action='surveysave.php?surid=<?php echo $surid; ?>' method='post' >
	
		<?php
			$question=mysql_query("SELECT * FROM tb_question WHERE SurId= '$surid' ORDER by QueId");
			$i=1;
			
			//遍历样式：<dl>  <dt>问题</dt>  <dd>答案</dd>  </dl>
			while($question_arr = mysql_fetch_array($question)){
				$j='A';
				echo "<dl id='tm{$i}'> <dt><b> {$i}、{$question_arr[Title]}</b></dt> ";
				
				$answer=mysql_query("SELECT * FROM tb_answer WHERE QueId= '$question_arr[QueId]' ORDER by AnsId");
				
				//单选样式
				if($question_arr[Type]=="radio"){	
					//遍历答案
					while($answer_arr=mysql_fetch_array($answer)){
						echo "<dd> <input id='atm{$i}' type='$question_arr[Type]' name='q$question_arr[QueId]' value='$answer_arr[Content]'> {$j}.{$answer_arr[Content]}  </dd> ";
						$j++;
					}
				}
				//多选样式----选项name为数组样式！！！
				if($question_arr[Type]=="checkbox"){
					//遍历答案
					while($answer_arr=mysql_fetch_array($answer)){
						echo "<dd> <input id='atm{$i}' type='$question_arr[Type]' name='q$question_arr[QueId][]' value='$answer_arr[Content]'> {$j}.{$answer_arr[Content]}  </dd> ";
						$j++;
					}
				}
				//文本框样式
				
				
				echo "</dl>";
				$i++;
			}

            //让文本框显示在最下方
            $question=mysql_query("SELECT * FROM tb_question WHERE SurId= '$surid' ORDER by QueId");
            while($question_arr = mysql_fetch_array($question)){
                    if($question_arr[Type]=="textarea"){
                        echo "<dl id='tm{$i}'> <dt><b> {$i}、{$question_arr[Title]}</b></dt> ";
					 echo "<dd><textarea name='note' class='notebook' cols='75' rows='5'>请输入留言</textarea></dd></dl>"; 
				}
            }

		?>
		
		<p style='border-top:#ccc solid 1px;padding-top:10px;'>非常感谢您的参与，请在此留下您的联系方式，以方便我们联系您。<br/></p>
		<p style='border-bottom:#ccc solid 1px;padding-bottom:10px;'>您的邮箱：<input type='note' name='mail' onblur='mailcheck()' id='mail'/></p>
		<div class='submit'><input type='submit' value='提交问卷' name='submit'/></div>	
			
		</form>
           </div>           
            </div>
    </div>
</body>
</html>