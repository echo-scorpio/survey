//下拉菜单
function ChangeSurvey () {
	var cindex = document.choosesurvey.choosesurvey.selectedIndex;//返回下拉列表中被选选项的索引号。
	var cvalue = document.choosesurvey.choosesurvey.options[cindex].value;
	this.location = "index.php?surid="+cvalue;//首页的surid是从这里获得的
}
//删除问卷
function DeleteSurvey(deleteid){
	this.location="index.php?action=delete&surid="+deleteid;
	
}

//清空表单
function clearForm(){
	this.location = "index.php";
}

//添加问题
function EditSurvey(){
	var cindex = document.choosesurvey.choosesurvey.selectedIndex;//返回下拉列表中被选选项的索引号。
	var cvalue = document.choosesurvey.choosesurvey.options[cindex].value;
	this.location = "question.php?surid="+cvalue;//首页的surid是从这里获得的
}

//查看问卷
function ViewSurvey(surid){
	var previewwin = window.open("../surveyview.php?surid="+surid);
	previewwin.focus();
}

//统计结果
function ViewResult(surid){
	//alert("aaaaaaaaaaaaaaaa");
	var previewwin = window.open("../admin/result.php?surid="+surid);
	previewwin.focus();  
}	

//查看回收情况
function ResultCount(surid){
	var previewwin = window.open("../admin/resultCount.php?surid="+surid);
	previewwin.focus();  
}

function addUser(surid){
	var previewwin = window.open("../admin/addUser.php");
	previewwin.focus();  
}
//退出登录
function userLogOut(){
	window.open("../user_login.php")
}