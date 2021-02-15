<?php 
    session_start();
    // 问卷提交保存页面
    include_once("conn/config.php");//链接数据库
    include_once("conn/function.php");//检测是否登录
    header("Content-Type:text/html;charset:utf-8");

    //获取参数
    $surid=$_GET[surid];
    $submit=$_POST[submit];
    $note=$_POST[note];
    $mail=$_POST[mail];

    $user_name=$_SESSION['name1'];
   
    $answered=mysql_query("select * from tb_user_answered where uid=$user_name and sid=$surid");
    $whether_answered=mysql_num_rows($answered);
    if($whether_answered!=0){//已经答过题，不能再提交
        echo "<script>alert('您已经参与此问卷调查，请不要重复参与，谢谢!');window.location.href='index.php';</script>";
    }

    else{
        if($submit){
            //跟新问卷提交数量
            $times=mysql_query("select times from tb_survey where SurId='$surid'");
            $times_arr=mysql_fetch_array($times);
            $timesupdate=$times_arr[times]+1;
            

            //查询当前问卷调查 总题数
            $totalNum=mysql_query("select * from tb_question where SurId = '$surid' and Type!='textarea'");
            $totalRows=mysql_num_rows($totalNum);
                  $i=1;
            foreach($_POST as $name=>$value){
                if($name!='submit' && $name!='note' &&$name!='mail'){
                    $i++;
                }
            }
            //当答题数小于总题数+2时（开放题可以不回答），证明题没有答完，不能提交
             if($i<=$totalRows){
                   echo "<script>alert('请完整填写选择题！');window.history.go(-1);</script>";
 
            }
            //题答完以后进行下面的操作
            else{
                //跟新问卷提交的次数
            mysql_query("update tb_survey set times='$timesupdate' where SurId='$surid' ");
            
            //保存TXT留言及联系方式
            mysql_query("set sql_mode='' ");
            $time=time();//获取当前时间
            //将数据插入到记录邮箱及留言的表中
                //遍历选项，更新次数
                //$name是QueId,$value是选择的选项：问题选项
                 foreach($_POST as $name=>$value){
                     if(substr($name,0,4)=='note' && $value!=''){
                        $qid=substr($name,4);
                        $a=mysql_query("insert into tb_user values ('','$surid','$qid','$mail','$value','$time') ");
                     }
                $queid = substr($name,1);//截取$name使其只剩下id，去掉之前设置的q
               
                //单选次数更新
                //is_array是判断是否是数组，当传进来的value值只有一个时，证明他是一个单选
                if(!is_array($value)){
                        $times=mysql_query("select Times from tb_answer where QueId = '$queid' and Content='$value' ");
                        $times_arr=mysql_fetch_array($times);
                        $timesupdate=$times_arr[Times]+1;
                        mysql_query("update tb_answer set Times='$timesupdate' where QueId='$queid' and Content='$value' ");
                }
                //复选选项次数更新
                //如果传进来的选项是复选的话，证明$value是数组，再将$value分解
                else{
                        foreach($value as $cvalue){
                            $times=mysql_query("select Times from tb_answer where QueId='$queid' and Content='$cvalue' ");
                            $times_arr=mysql_fetch_array($times);
                            $timesupdate=$times_arr[Times]+1;
                            mysql_query("update tb_answer set Times='$timesupdate' where QueId='$queid' and Content='$cvalue' ");

                        }
                }
            
            }
                      echo "<script>alert('问卷提交成功，感谢您的参与');this.location='index.php'</script>";

                      //echo $user_name;
                      //向用户完成统计表中插入用户ID和问卷ID
                     mysql_query("insert into tb_user_answered values ('','$user_name','$surid')");

            
                

            
        }
           

          

        }
    }

?>