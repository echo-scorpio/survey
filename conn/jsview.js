function mailcheck(){
    var temp=document.getElementById("mail");
    if(temp.value=""){
            alert("请输入您的邮箱账号");
    }
    else{
        var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
          if(!myreg.test(temp.value))
          {
                alert('请输入您有效的邮箱，以后方便我们联系！');
                myreg.focus();
               return false;           }
    }
}