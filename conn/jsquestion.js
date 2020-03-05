//选择不同的显示方式，用不同的样式
function TypeCheck(classValue)
{

    var table = document.getElementById('contentTable');//得到单选、复选、文本样式外部的table
    for(var rowIndex=0;rowIndex<table.rows.length;rowIndex++)//返回表格中行的数量值,表格有几行循环几次
    {
        table.rows[rowIndex].style.display = "none";//表格的每一行样式为display:none
    }
    table.rows[classValue-1].style.display = "";//表格传进来的行数减一的样式显示出来
	
	document.getElementById("option_value").value=classValue;
}




//编辑问题按钮
function chooseQuestion(surid){
         var cindex = document.choosequestion.choosequestion.selectedIndex;
	var cvalue = document.choosequestion.choosequestion.options[cindex].value;
	this.location = "changeQuestion.php?surid="+surid+"&value="+cvalue;
    //this.location = "question.php?cs="+cs+"&cq="+cvalue;
}

function qTypeCheck(){
    var cindex = document.chooseAnswer.chooseAnswer.selectedIndex;
	var cvalue = document.chooseAnswer.chooseAnswer.options[cindex].value;
    document.getElementById("optionValue").value=cvalue;
}

//删除问题
function DeleteQuestion(surid){
    
   var del = confirm("确认删除吗");
   if(del){
        var cindex = document.choosequestion.choosequestion.selectedIndex;
	var cvalue = document.choosequestion.choosequestion.options[cindex].value;
	this.location = "question.php?action=deleteQue&surid="+surid+"&value="+cvalue;
   }

   else{

   }
    
    
}