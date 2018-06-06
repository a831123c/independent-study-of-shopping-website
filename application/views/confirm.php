<!DOCTYPE html>
<html>
<head>
    <title>xxx購物網</title>
    <meta charset="UTF-8">
   <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/bootstrap-dropdownhover.js"></script>
    <script src="/js/bootstrap-dropdownhover.min.js"></script>
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
    </style>
</head>

<body style="background:url('/images/enter.jpg');background-repeat">
    <!--Responsive Web Design UI-->
    <body  style="background:url('/images/enter.jpg');background-repeat">
     <!--Responsive Web Design UI-->
    <nav class="nav navbar-inverse">
        <div class="container-fluid" style="font-size:25px">
            <div class="collapse navbar-collapse" data-hover="dropdown" data-animations="fadeInDown fadeInRight fadeInUp fadeInLeft">
            <ul class="nav navbar-nav">
                <li ><a href="#">home</a></li>
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
                <li><a>確認結帳頁面</a></li>
            </ui>
            </span>
            <ui class="nav navbar-nav navbar-right">
            <li class="active"><a href="/shopping/car">購物車</a></li>
            <?php if(isset($name)):?>
                <li><a href="/shopping/orderlist">已下定訂單</a></li>
                <li><a href="#">歡迎<?=$name?></a></li>
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
    <!--RWSB UI-->
    <div class="container">
    <form action="/shopping/sendinfo" method="post">
    <table class="table" style="font-size: 18px;">
    <thead>
      <tr>
        <th></th>
        <th>商品</th>
        <th>單價</th>
        <th>數量</th>
        <th>小計</th>
      </tr>
      </thead>
      <input type="hidden"  value="<?=$sid?>" name="sid">
      <?php foreach ($detail as $tmp):?>
        <tr>
        <td style="width:150px"> <div>
          <img class="img-responsive" style="width:75%;height:30%" src="<?=$tmp['image']?>">
          </div></td>
        <div class="col-2">
        <td style="width:300px"><?=$tmp['pname']?></td>
        </div>
        <div class="col-1">
        <td style="width:150px"><?=$tmp['money']?></td>
        </div>
        <div class="col-2">
        <td><?=$tmp['num']?></td>
        </div>
        <div class="col-2">
        <td><?=$tmp['price']?></td>
         </div>
      </tr>
      <?php endforeach;?>
      <tr>
      <td></td>
      <td></td>
      <td></td>
      <td>總金額</td>
      <td><input style="background-color:transparent;border:0px" type="text" name="total" value="<?=$total?>" readonly="readonly"><td>
      </tr>
      </table>
       <input type="submit" class="btn btn-primary btn-lg btn-block" value="確認商品無誤 前往填寫資料">
      </form>  
    </div>
   
</body>

</html>