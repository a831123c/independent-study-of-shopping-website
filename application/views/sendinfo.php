<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>xxx購物網</title>
  <link rel="stylesheet" href="/css/bootstrap.min.css">
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/bootstrap-dropdownhover.js"></script>
    <script src="/js/bootstrap-dropdownhover.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script "text/javascript">
    function equlaMember(){
        if(document.getElementById("member").checked){
             $.ajax({
                url: "/shopping/getmember",
                data: "uid="+document.getElementById("uid").value,
                type:"POST",
                dataType:'html',
                success: function(data){
                   document.getElementById("people").value=data;
                },
            });
        }
        else document.getElementById("people").value = null;
    }
    function equlaMemberaddr(){
        if(document.getElementById("memberaddr").checked){
             $.ajax({
                url: "/shopping/getmemberaddr",
                data: "uid="+document.getElementById("uid").value,
                type:"POST",
                dataType:'html',
                success: function(data){
                   document.getElementById("address").value=data;
                },
            });
        }
        else document.getElementById("address").value = null;
    }
    </script>
    <script>
      $( function() {
    $( "#date" ).datepicker({changeYear: true, changeMonth: true,  dafaultDate: Date(),minDate: +1,dateFormat:"yy-mm-dd",yearRange: "+0:+1"});
    } );
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
        input[type=checkbox] {
            transform: scale(1.2);
        }
    </style>
    <style>
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
                <li><a>寄送相關資料</a></li>
            </ui>
            </span>
            <ui class="nav navbar-nav navbar-right">
            <li><a href="/shopping/car">購物車</a></li>
            <?php if(isset($name)):?>
                <li><a href="#">歡迎<?=$name?></a></li>
                <li><a href="/shopping/orderlist">已下訂訂單</a></li>
                <li><a href="/shopping/logout">登出</a></li>
            <?php else :?>
                <li><a href="/shopping/login">登入</a></li>
                <li><a href="/shopping/register">註冊</a></li>
            </ui>
            <?php endif;?>
            </div>
            </div>
        </div>
    </nav>
    <input type="hidden" value="<?=$uid?>" id="uid">
    <!--RWSB UI-->
    <div style="margin-top:30px">
   
    <form action="/shopping/info" method="post">
        <input type="hidden" value="<?=$sid?>" name="sid">
        <div class="col-md-8">
            <div class="col-md-7"></div>
        <div class="col-md-4" style="margin-top:100px">
        <div class="form-group">
            <label style="font-size: 25px;" class="control-label" for="people">收件人</label><br>
            <input type="checkbox" class="big-checkbox-primary" id="member" onclick="equlaMember();"><a style="font-size:20px;text-decoration:none;color:black">&nbsp;與會員相同</a><br>
            <input name="people" id="people" type="text" class="form-control input-lg" placeholder="請輸入收件人">
        </div>
        <div class="form-group">
            <label style="font-size: 25px;" class="control-label" for="address">地址</label><br>
            <input type="checkbox" class="big-checkbox-primary" id="memberaddr" onclick="equlaMemberaddr();"><a style="font-size:20px;text-decoration:none;color:black">&nbsp;與會員相同</a><br>
            <input name="address" type="text" class="form-control input-lg" id="address" placeholder="請輸入寄件地址">
        </div>
         <div class="form-group">
            <label style="font-size: 25px;" class="control-label" for="date">送達日期</label><br>
            <input name="date" type="text" class="form-control input-lg" id="date" placeholder="請選擇寄送日期">
        </div>
        <input type="submit" class="btn btn-primary" value="確定送出">
        <br><br>
    </form>
    </div>
</body>
</html>