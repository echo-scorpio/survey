<?php 
  @session_start();
  include_once("../conn/config.php");
  include_once("../conn/function.php");//这里写的是判断是否登录的login_check函数
  
  header("Content-Type:text/html;charset=utf-8");
  //判断是否登录
  login_check($_SESSION[name],$_SESSION[data]);

  //获取参数
    $surid = $_GET[surid];
    $qvalue=$_GET[value];
    $option_value = $_POST[option_value];
    $submit = $_POST[submit];
    $questionname = $_POST[questionname];
    $action=$_GET[action];
    $answer1 = $_POST[answer1];
    $answer2 = $_POST[answer2];
    $answer3 = $_POST[answer3];
    $answer4 = $_POST[answer4];
    $answer5 = $_POST[answer5];
    $answer6 = $_POST[answer6];
    $answer7 = $_POST[answer7];
    $answer8 = $_POST[answer8];
    $answer9 = $_POST[answer9];
    $answer10 = $_POST[answer10];


	
	
	$source = '<div class="wzxx"><span>sd</span><div><div>sd<span>jjks</span></div></div></div>';
$catch = preg_replace('/^<div class="wzxx"\>(.*)<\/div>$/','$1',$source);
echo "<script>alert($catch)</script>";
  


    //删除问题
    if($action=="deleteQue"){
            if($surid){
                  echo $qvalue;
		$success = mysql_query("DELETE FROM tb_question WHERE QueId ='$qvalue' ");
		$success = ( mysql_query("DELETE FROM tb_answer WHERE  QueId ='$qvalue' ") ) ? $success : false;
		$message = ($success) ? "删除问题成功" : "删除问题失败";
		echo "<script>alert('$message')</script>";
		echo "<script>window.location.href='question.php?surid=$surid';</script>";
            }
    }


    //添加问题
    //当点击了添加问题以后
    if($submit){
        
            //获得了用户输入的问题名称以后
            if($questionname){
                // echo "<script>alert('aaaaaaaaaaaaaaaaaaaaaaaaa')</script>";
                    //单选情况
                    if($option_value==1){
                        //echo "<script>alert('aaaaaaaaaaaaaaaaaaaaaaaaa')</script>";
                            mysql_query("set sql_mode=''");
                            $success=mysql_query("insert into tb_question values ('','$surid','radio','$questionname')");
                            $queid=mysql_insert_id();//获得上次插入的surid;
                            if($answer1!=""){$success=(mysql_query("insert into tb_answer values('','$surid','$queid','$answer1','')"))?$success:false;  }
                            if($answer2!=""){$success=(mysql_query("insert into tb_answer values('','$surid','$queid','$answer2','')"))?$success:false;  }
                            if($answer3!=""){$success=(mysql_query("insert into tb_answer values('','$surid','$queid','$answer3','')"))?$success:false;  }
                            if($answer4!=""){$success=(mysql_query("insert into tb_answer values('','$surid','$queid','$answer4','')"))?$success:false;  }
                            if($answer5!=""){$success=(mysql_query("insert into tb_answer values('','$surid','$queid','$answer5','')"))?$success:false;  }

                            if($success){
                                echo '<script>alert("添加成功!")</script>';
                            }
                            else{
                                echo '<script>alert("添加失败!")</script>';
                            }
                    }
                    //复选情况
                    if($option_value==2){
                            mysql_query("set sql_mode=''");
                            $success=mysql_query("insert into tb_question values ('','$surid','checkbox','$questionname')");
                            $queid=mysql_insert_id();//获得上次插入的surid;
                            if($answer6!=""){$success=(mysql_query("insert into tb_answer values('','$surid','$queid','$answer6','')"))?$success:false;  }
                            if($answer7!=""){$success=(mysql_query("insert into tb_answer values('','$surid','$queid','$answer7','')"))?$success:false;  }
                            if($answer8!=""){$success=(mysql_query("insert into tb_answer values('','$surid','$queid','$answer8','')"))?$success:false;  }
                            if($answer9!=""){$success=(mysql_query("insert into tb_answer values('','$surid','$queid','$answer9','')"))?$success:false;  }
                            if($answer10!=""){$success=(mysql_query("insert into tb_answer values('','$surid','$queid','$answer10','')"))?$success:false;  }

                            if($success){
                                echo '<script>alert("添加成功!")</script>';
                                header(index.php);
                            }
                            else{
                                echo '<script>alert("添加失败!")</script>';
                            }
                    }
                    //文本框情况
                    if($option_value==3){
                            mysql_query("set sql_mode=''");
                            $success=mysql_query("insert into tb_question values('','$surid','textarea','$questionname')");
                            $queid=mysql_insert_id();
                            if($success){
                                echo '<script>alert("添加成功")</script>';
                            }
                            else{
                                echo '<script>alert("添加失败")</script>';
                            }
                    }
            }
    }

//页面部分

$content = <<<END
<script language="javascript" type="text/javascript" src="../conn/jsquestion.js"></script>
END;
if($surid){
    $survey=mysql_query("select * from tb_survey where SurId = '$surid' ");
    if($survey_arr=mysql_fetch_array($survey)){
        $surveyname=$survey_arr["title"];//定义变量等于查出来的问卷名
    }
    else{
        header("location : index.php");
        exit();
    }
}






//显示当前操作的问卷
$content .= <<<END
    <form name=choosequestion action=question.php method=post>
        <table class="tab2">
            <tr>
                <td><img src="../images/questionlist.gif" width=115 height=22></td>
            </tr>
            <tr>
            <td align="right"><b>当前问卷：</b></td>
            <td style="color:#EE3E3E"><b>$surveyname</b></td>
            </tr>
            <tr>
            <td align="right"><b>问题：</b></td>
            <td><select name=choosequestion  style="width:300px;" size=10>
           
           
            
END;

//向数据库查询问题
$question=mysql_query("select * from tb_question where SurId = '$surid' order by QueId ");
while($question_arr=mysql_fetch_array($question)){
    $questionlist[]=$question_arr;
}

//判断数据库中是否有问题，有的话显示到页面上
if(sizeof($questionlist)>0){
    for($i=0;$i<sizeof($questionlist);$i++){
       // $selected = ($questionlist[$i]["QueId"] == $surid) ? "selected" : "";
        $content .= "<option value=".$questionlist[$i]["QueId"].">".$questionlist[$i]["Title"]."</option>";

    }
}
else{
    $content .= "<option value=\"-1\">无问题</option>";
}
$content .= <<<END
    </select>
    </td>
    </tr>
END;
//操作问题按钮

$content .=<<<END
<tr>
	<td></td>
	<td>
	<input type=button onclick="chooseQuestion($surid)" value="编辑问题">
	<input type=button onclick="DeleteQuestion($surid)" value="删除问题">
	<input type=button onclick="PreviewQuestion($surid)" value="预览">
	</td>
</tr>
END;


$content .= <<<END
    </table>
</form>
<hr width=600px align=center>
END;

//问题名称
$content .= <<<END
    <form name=addquestion action=question.php?surid=$surid method=POST>
        <table class="tab2">
            <tr>
                <td width=135><img src="../images/addquestion.gif" width=115 height=22></td>
            </tr>
            <tr>
            <td align=right valign=top><b>问题名称：</b></td>
            <td><input type=text name=questionname value=""></td>
            </tr>
  
END;

//根据问题类型，分别布局
$content .= <<<END
        <tr>
        <td align=right><b>类型：</b></td>
        <td>
        <select onchange="TypeCheck(this.value)">
        <option value="0" >请选择类型</option>
        <option value="1" >单选类型</option>
        <option value="2" >复选类型</option>
        <option value="3" >文本类型</option>
        </select>
        </td>
        <input type=hidden name=option_value id=option_value value=""><!-- ??? -->
        </tr>
      </table>
<table class="tab2" id="contentTable">
    <!-- 单选样式-->
    <tr>
        <td align=right width=135 valign=top><b>问题选项：</b></td>
        <td>
        <input type=text name=answer1 value=""><br>
        <input type=text name=answer2 value=""><br>
        <input type=text name=answer3 value=""><br>
        <input type=text name=answer4 value=""><br>
        <input type=text name=answer5 value="">
        </td>
    </tr>

    <!-- 复选样式-->
    <tr style="display:none">
        <td align=right width=135 valign=top><b>问题选项：</b></td>
        <td>
        <input type=text name=answer6 value=""><br>
        <input type=text name=answer7 value=""><br>
        <input type=text name=answer8 value=""><br>
        <input type=text name=answer9 value=""><br>
        <input type=text name=answer10 value="">
        </td>
    </tr>

   <!--文本样式-->
    <tr style="display:none">
    <td></td>
  </tr> 
</table>

<!--底部submit样式-->
<table class="tab3">
<tr>
	<td width=135></td>
	<td>
	<input type=submit name=submit value="添加问题"> 
	<input type=button onclick="ClearForm($surid)" value="清空">
	</td>
</tr>
</table>
    </form>
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
            </div>
            <div class="main">
                <div class="blank"></div>
                <div class="location">
		            当前位置：<a href="index.php">问卷首页</a>>添加问题
	            </div>
            <hr></hr>
            <?php echo $content;?>
            </div>
    </div>
</body>
</html>