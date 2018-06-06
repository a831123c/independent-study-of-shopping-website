<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>xxx購物網</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/bootstrap-dropdownhover.js"></script>
    <script src="/js/bootstrap-dropdownhover.min.js"></script>
    <script type="text/javascript">
      function check()
        {
            if(re.account.value=="") alert("會員資料不得為空");
            else if(re.password.value=="") alert("會員資料不得為空");
            else if(re.mname.value=="") alert("會員資料不得為空");
            else if(re.mtel.value=="") alert("會員資料不得為空");
            else if(re.mail.value=="") alert("會員資料不得為空");
            else if(re.maddress.value=="") alert("會員資料不得為空");
            else re.submit();
        }
    </script>
    <style>
        .navbar-center {
            display: inline-block;
            float: none;
            vertical-align: top;
        }
        
        .navbar-collapse-center {
            text-align: center;
        }
        .navbar-inverse .navbar-nav > li > a {
            color: 	#ADFF2F;
        }
    .text-info{
        color: #0000CC 
    }
    </style>
</head>
<body  style="background:url('/images/enter.jpg');background-repeat">
     <!--Responsive Web Design UI-->
    <nav class="nav navbar-inverse">
        <div class="container-fluid" style="font-size:25px">
            <div class="collapse navbar-collapse" data-hover="dropdown" data-animations="fadeInDown fadeInRight fadeInUp fadeInLeft">
            <ul class="nav navbar-nav">
                <li ><a href="/shopping/index">home</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown"role="button" href="#">產品分類<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php foreach ($class as $classes):?>
                        <li>
                            <a style="font-size:20px" href="/shopping/cla?classID=<?=$classes['classID']?>&page=1">
                                <?=$classes['className']?>
                            </a>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </li>
            </ul>
            <div class="collapse navbar-collapse navbar-collapse-center">
            <ui class="nav navbar-nav navbar-center">
                <li><a>xxx購物網註冊頁面</a></li>
            </ui>
            </span>
            <ui class="nav navbar-nav navbar-right">
            <li><a href="/shopping/car">購物車</a></li>
            <?php if(isset($name)):?>
                <li><a href="#">歡迎<?=$name?></a></li>
                <li><a href="/shopping/logout">登出</a></li>
            <?php else :?>
                <li ><a href="/shopping/login">登入</a></li>
                <li class="active"><a href="/shopping/register">註冊</a></li>
            </ui>
            <?php endif;?>
            </div>
            </div>
        </div>
    </nav>
    <!--RWSB UI-->
    <div style="margin-top:25px">
    <form name="re" action="Toregist" method="post">
        <div class="col-md-8">
            <div class="col-md-7"></div>
        <div class="col-md-4" style="margin-top:5px">
        <div class="form-group">
            <label for="account">帳號</label>
            <input name="account" type="text" class="form-control input-lg" id="account" placeholder="請輸入帳號">
        </div>
        <div class="form-group">
            <label for="password">密碼</label>
            <input name="password" type="text" class="form-control input-lg" id="password" placeholder="請輸入密碼">
        </div>
          <div class="form-group">
            <label for="mname">姓名</label>
            <input name="mname" type="text" class="form-control input-lg" id="mname" placeholder="請輸入姓名">
        </div>
          <div class="form-group">
            <label for="mtel">電話</label>
            <input name="mtel" type="text" class="form-control input-lg" id="mtel" placeholder="請輸入電話">
        </div>
          <div class="form-group">
            <label for="mail">電子信箱</label>
            <input name="mail" type="text" class="form-control input-lg" id="mail" placeholder="請輸入信箱">
        </div>
        <div class="form-group">
            <label for="maddress">地址(日後若寄件可選擇寄到此地)</label>
            <input name="maddress" type="text" class="form-control input-lg-5" id="maddress" placeholder="請輸入地址">
        </div>
        <input type="button" class="btn btn-primary" value="註冊" onclick="check();">
        </div>
        </div>
    </form>
    </div>
</body>
</html>