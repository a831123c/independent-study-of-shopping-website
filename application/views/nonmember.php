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
    <style>
      .btn.btn-info {
            background: black  ;
            color: white      ;
            border: 1px solid black  ;
        }
        .btn.btn-info:hover {
            background:orange   ;
            color: blueviolet      ;
            border: 1px solid orange   ;
        }
        table.table-hover th,td{
            border-bottom:2px solid transparent !important;
        }
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
                <li><a>購物車(欲結帳及修改數量 請加入會員)</a></li>
            </ui>
            </span>
            <ui class="nav navbar-nav navbar-right">
            <li class="active"><a href="/shopping/car">購物車</a></li>
            <?php if(isset($name)):?>
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
    <div class="container" style="text-align:center;margin-top:30px">
    <?php if($count==0):?>
    <h1 font>購物車尚無商品</h1>
    <?php else:?>
    <table class="table table-hover" style="font-size: 20px;">
    <thead>
      <tr>
        <th>商品</th>
        <th>單價</th>
        <th>數量</th>
        <th>小計</th>
      </tr>
      </thead>
      <?php for($x=0;$x<$count;$x++):?>
      <?php $total += $pid[$x]['money']*$num[$x];?>
      <tr class="span2">
        <td><?=$pid[$x]['pname']?></td>
        </div>
        <div class="col-xs-4">
        <td><input style="background-color:transparent;border:0px" type="text" id="money<?=$x?>" value="<?=$pid[$x]['money']?>" readonly="readonly"></td>
        </div>
        <div class="col-xs-4">
        <td><input type="text" id="<?=$x?>" value="<?=$num[$x]?>" readonly="readonly"></td>
        </div>
        <div class="col-xs-4">
        <td><input style="background-color:transparent;border:0px" id="total<?=$x?>" type="text" name="total" value="<?=$pid[$x]['money']*$num[$x]?>" readonly="readonly"><td>
        </div>
      </tr>
      <?php endfor;?>
      <tr>
      <td></td>
      <td></td>
      <td>總金額</td>
      <td><input style="background-color:transparent;border:0px" id="total" type="text" name="total" value="<?=$total?>" readonly="readonly"><td>
      </tr>
    </table>
     <input class="btn btn-info btn-lg btn-block" value="前往註冊" onclick="javascript:location.href='/shopping/register'">
    <?php endif;?>
    </div>
</body>

</html>