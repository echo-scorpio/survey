<?php   
        session_start();
        include_once("../conn/config.php");
        include_once("../conn/function.php");
        login_check($_SESSION[name],$_SESSION[data]);

        //获取参数
        $surid=$_GET[surid];
        $cvalue=$_GET[value];

        $submit=$_POST[submit];
        $title=$_POST[title];
        $optionValue=$_POST[optionValue];
        $answer1=$_POST[answer1];
        $answer2=$_POST[answer2];
        $answer3=$_POST[answer3];
        $answer4=$_POST[answer4];
        $answer5=$_POST[answer5];

            if($submit){
                    $answerId=mysql_query("select AnsId from tb_answer where QueId='$cvalue' ");
                    while($answerId_arr=mysql_fetch_array($answerId)){
                            $answerList []=$answerId_arr;
                          

                    }
                    if($title !=""){
                        $success = mysql_query("update tb_question set Title='$title' where QueId='$cvalue' ");                           
                    }

                    if($optionValue != ""){
                            if($optionValue==1){
                                    $success =mysql_query("update tb_question set Type='radio' where QueId='$cvalue' ");
                            }
                             if($optionValue==2){
                                    $success =mysql_query("update tb_question set Type='checkbox' where QueId='$cvalue' ");
                            }
                    }

                    if($answer1 != ""){
                        $success =mysql_query("update tb_answer set Content='$answer1' where AnsId=".$answerList[0][AnsId]);
                        
                    }
                    if($answer2 != ""){
                        $success =mysql_query("update tb_answer set Content='$answer2' where AnsId=".$answerList[1][AnsId]);
                        
                    }
                    if($answer3 != ""){
                        $success =mysql_query("update tb_answer set Content='$answer3' where AnsId=".$answerList[2][AnsId]);
                        
                    }
                    if($answer4 != ""){
                        $success =mysql_query("update tb_answer set Content='$answer4' where AnsId=".$answerList[3][AnsId]);
                        
                    }
                    if($answer5 != ""){
                        $success =mysql_query("update tb_answer set Content='$answer5' where AnsId=".$answerList[4][AnsId]);
                        
                    }

                    echo "<script>alert('修改成功')</script>";
                    echo "<script>window.location.href='changeQuestion.php?surid=$surid&value=$cvalue';</script>";

                    
            }


       // echo $cvalue;

       $question=mysql_query("select * from tb_question where QueId='$cvalue' ");
       $question_arr=mysql_fetch_array($question);
       $question_name=$question_arr[Title];
       $question_type=$question_arr[Type];

       $content .=<<<END
      <script language="javascript" type="text/javascript" src="../conn/jsquestion.js"></script>
END;

       $content .=<<<END
        <form class='changeQueForm' name='chooseAnswer' action ='changeQuestion.php?surid=$surid&value=$cvalue' method='POST'>
            <table class="tab2">
                <tr><td width=150px align=center>问题</td><td><input value="$question_name" name="title"></td></tr>

END;
$content .=<<<END
        <tr>
            <td width=150px align=center>当前题型:
            
END;
if($question_type=="radio"){
    $content .="<b>单选</b>";

}
if($question_type=="checkbox"){
    $content .="<b>复选</b>";

}
if($question_type=="textarea"){
    $content .="<b>开放题</b>";

}
$content .=<<<END
</td>
             <td>
             
END;


 if($question_type=="radio"){
    $content .=" <select name='chooseAnswer' onchange='qTypeCheck(this.value)'><option value='1' selected='selected'>单选题型</option><option value='2'>多选题型</option></select>";
 }
  if($question_type=="checkbox"){
    $content .=" <select name='chooseAnswer' onchange='qTypeCheck(this.value)'><option value='1'>单选题型</option><option value='2'  selected='selected'>多选题型</option></select>";
 }
             
        $content .=<<<END
        </td>
        </tr>
END;

$answer=mysql_query("select * from tb_answer where QueId='$cvalue' ");
$i='A';
$j=1;
while($answer_arr=mysql_fetch_array($answer)){
    $content .="<tr>
                    <td width=150px align=center>
                        $i.
                    </td>
                    <td><input value='$answer_arr[Content]' name='answer$j'></td>
                </tr>";

    $i++;
    $j++;
}
                
$content .=<<<END

<tr><td><input type=hidden name="optionValue" id="optionValue" value=""></td></tr>
<tr><td></td><td width=150px align=left><input type=submit name="submit" value="提交修改"></td></tr>

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