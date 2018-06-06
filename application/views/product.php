<!DOCTYPE html>
<html>

<head>
    <title>xxx購物網</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <nav class="nav navbar-inverse">
        <div class="container-fluid" style="font-size:25px">
            <div class="collapse navbar-collapse" data-hover="dropdown" data-animations="fadeInDown fadeInRight fadeInUp fadeInLeft">
            <ul class="nav navbar-nav">
                <li ><a href="/shopping/index">home</a></li>
                <li class="active dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown"role="button" href="#">產品分類<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php foreach ($class as $classes):?>
                        <li <?php if($classID == $classes['classID']):?><?php $className=$classes['className'];?> class="active"<?php endif;?>>
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
              <?php if($totalpage==0):?>
              <li><a>無商品</a></li>
              <?php else:?>
             <?php if($page!=1):?>
                 <li><a href="/shopping/cla?classID=<?=$classID?>&page=<?=$page-1?>">上一頁</a></li>
                 <?php endif;?>
                <li><a><?=$className?>類 第<?=$page?>/<?=$totalpage?>頁</a></li>
                 <?php if($page!=$totalpage):?>
                <li><a href="/shopping/cla?classID=<?=$classID?>&page=<?=$page+1?>">下一頁</a></li>
                <?php endif;?>
                 <?php endif;?>
            </ui>
            
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
    <!--RWSB UI-->
        <?php foreach($product as $tmp):?>
        <div  class="col-md-4" >
          <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8" >
          <a href="/shopping/product/<?=$tmp['pid']?>"><img class="img-responsive" style="width:75%;height:75%" src="<?=$tmp['image']?>"></a>
          </div>
          </div>
          <a href="/shopping/product/<?=$tmp['pid']?>" style="font-size:18px"><?=$tmp['pname']?>
          </div>
        <?php endforeach;?>
</body>

</html>