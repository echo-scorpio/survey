<?php
@session_start();
include_once("../conn/config.php");//链接数据库
    header("Content-Type:text/html;charset:utf-8");
    $file_name=$_FILES["file"]["name"];
$filep1="../upFile";
$move_to_file=$filep1."/".time().rand(1,1000).substr($file_name,strrpos($file_name,".")); 
$result=move_uploaded_file($_FILES["file"]["tmp_name"],$move_to_file);

$str = "";
	require_once "../PHPExcel.php";
	require_once "../PHPExcel/IOFactory.php";
	require_once "../PHPExcel/Reader/Excel2007.php";//excel 2007

	if($result){
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');//use excel2003 和 2007 format
	   $objPHPExcel = PHPExcel_IOFactory::load($move_to_file);
       echo $result."---aaa";

	   $sheet = $objPHPExcel->getSheet(0); 
	   $highestRow = $sheet->getHighestRow(); // 取得总行数 
	   $highestColumn = $sheet->getHighestColumn(); // 取得总列数
    
		//循环读取excel文件,读取一条,插入一条
		for($j=2;$j<=$highestRow;$j++)
		{ 
			for($k='A';$k<=$highestColumn;$k++)
			{ 
				$str .= iconv('utf-8','utf-8',$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue()).'\\';//读取单元格
			} 
			//explode:函数把字符串分割为数组。
			$strs = explode("\\",$str);
		   $ok=mysql_query("INSERT INTO tb_userlogin(`userId`,`userPass`) VALUES('".$strs[0]."','".$strs[0]."');"); 
           if($ok){
            mysql_query("INSERT INTO tb_user_info(`uid`,`name`,`sex`) VALUES('".$strs[0]."','".$strs[1]."','".$strs[2]."');");         
           }
			//echo $sql;
		mysql_query("SET NAMES utf8");
		mysql_query("SET CHARACTER SET utf8");
		mysql_query("SET COLLATION_CONNECTION='utf8_general_ci'");
		
			$str = "";
	

	   } 
   
   	   //unlink($uploadfile); //删除上传的excel文件
       $msg = "导入成功！";
	   echo'<script type="text/javascript">alert("学生信息导入成功")</script>';
	echo'<script type="text/javascript">window.location.href="./addUser.php"</script>';
    }else{
       $msg = "导入失败！";
    }
    return $msg;

	

?>
</div>
</body></html>