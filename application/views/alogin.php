<html>
<head>
<title>員工登入頁面</title>
</head>
<body style="background:url('/images/enter.jpg');background-repeat">
 <div style="margin-top:100px;text-align:center;">
    <h2>請輸入員工帳密</h2>
</div>
    <div style="margin-top:80px;text-align:center;font-size:25px">
    <form action="/admin/checkStaff" method="post">
    帳號 <input type="text" style="padding:5px;font-size:20px" name="account"></br></br>
    密碼 <input type="text" style="padding:5px;font-size:20px" name="password"></br></br>
    <input style="font-size:20px;width:80px;height:40px;" type="submit" value="登入">
    </form>
    <?php if($wrong==1):?>
        <font color="red">登入失敗</font></br>
        <font color="red">帳號或密碼輸入錯誤</font></a>
    <?php endif;?>
    </div>
</body>
</html>  