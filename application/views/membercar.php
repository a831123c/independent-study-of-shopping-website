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
    <script "text/javascript">
    function money(id,num){
       var count = <?=$count?>;
       var total = 0;
       num = parseInt(num);
       document.getElementById("total"+id).value = (parseInt(document.getElementById("money"+id).value))*num;
       for(var x=0;x<count;x++){
            total += parseInt(document.getElementById("total"+x).value);
       }
       document.getElementById("total").value=total;
    }
    </script>
    <style>
       .btn.btn-info {
            background: purple  ;
            color: gold  ;
            border: 1px solid purple  ;
        }
        .btn.btn-info:hover {
            background:darkviolet   ;
            color: gold  ;
            border: 1px solid darkviolet   ;
        }
        .btn.btn-primary {
            background: black  ;
            color: white      ;
            border: 1px solid black  ;
        }
        .btn.btn-primary:hover {
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
                <li><a>購物車</a></li>
            </ui>
            </span>
            <ui class="nav navbar-nav navbar-right">
            <li class="active"><a href="/shopping/car">購物車</a></li>
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
    <!--RWSB UI-->
    <div class="container" style="text-align:center;">
    <?php if($car==false||count($detail)==0):?>
    <h1>購物車尚無商品</h1>
    <?php else:?>
    <form action="/shopping/purchase" method="post">
    <table class="table table-hover" style="font-size: 18px;">
    <thead>
      <tr>
        <th></th>
        <th>商品</th>
        <th>單價</th>
        <th>數量</th>
        <th>小計</th>
      </tr>
      </thead>
      <input type="hidden" value="<?=$count?>" name="count">
      <input type="hidden" id="sid" value="<?=$car['sid']?>" name="sid">
      <?php for($x=0;$x<$count;$x++):?>
      <?php $total += $money[$x]*$detail[$x]['num'];?>
        <tr>
        <input type="hidden" value="<?=$detail[$x]['productID']?>" name="pid<?=$x?>">
       <td style="width:100px"><input class="btn btn-info" id="remove<?=$x?>" value="移除購物車" onclick="javascript:location.href='/shopping/remove?pid=<?=$detail[$x]['productID']?>&sid=<?=$car['sid']?>'"></td>
        <td style="width:200px"><?=$pname[$x]?></td>
        </div>
        <div class="col-2">
        <td><input style="background-color:transparent;border:0px" type="text" id="money<?=$x?>" name="money<?=$x?>" value="<?=$money[$x]?>" readonly="readonly"></td>
        </div>
        <div class="col-2">
        <td><input type="text" id="<?=$x?>" name="num<?=$x?>" value="<?=$detail[$x]['num']?>" onchange="money(this.id,this.value)"></td>
        </div>
        <div class="col-2">
        <td><input style="background-color:transparent;border:0px" id="total<?=$x?>" type="text" name="total<?=$x?>" value="<?=$money[$x]*$detail[$x]['num']?>" readonly="readonly"></td>
         </div>
      </tr>
      <?php endfor;?>
      <tr>
      <td></td>
      <td></td>
      <td></td>
      <td>總金額</td>
      <td><input style="background-color:transparent;border:0px" id="total" type="text" name="total" value="<?=$total?>" readonly="readonly"><td>
      </tr>
      </table>
       <input type="submit" class="btn btn-primary btn-lg btn-block" value="前往結帳">
      <?php endif;?>
      </form>  
    </div>
   
</body>

</html>