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
    function send(){
          $.ajax({
                url: "/shopping/addCar",
                data: "pid="+document.getElementById("pid").value,
                type:"POST",
                dataType:'html',
                success: function(data){
                   alert(data);
                },
            });
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
    </style>
</head>

<body style="background:url('/images/enter.jpg');background-repeat">
    <!--Responsive Web Design UI-->
    <nav class="nav navbar-inverse">
        <div class="container-fluid" style="font-size:25px">
            <div class="collapse navbar-collapse" data-hover="dropdown" data-animations="fadeInDown fadeInRight fadeInUp fadeInLeft">
            <ul class="nav navbar-nav">
                <li><a href="/shopping/index">home</a></li>
                <li class="dropdown active">
                    <a class="dropdown-toggle" data-toggle="dropdown"role="button" href="#">產品分類<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php foreach ($class as $classes):?>
                         <li <?php if($product['class']==$classes['classID']):?> class="active" <?php endif;?>>
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
                <li><a><?=$product['pname']?></a></li>
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
    <!--RWSB UI-->
    <input type="hidden" value=<?=$pid?> id="pid">
    <div style="margin-top:10px" class="col-md-12" >
          <div class="row">
          <div  class="col-md-4">
          <img class="img-responsive" style="width:75%;height:60%" src="<?=$product['image']?>">
           <?php if($product['video']!=null):?>
          <video style="margin:0 auto;" align="center" width="75%" height="75%" controls>
          <source src="<?=$product['video']?>" type="video/mp4">
          </video>
          <?php endif;?>
          </div>
           <div  class="col-md-8">
           <h2 style="color:red"><?=$product['introduction'];?></h>
           <h1 style="color:red">價格:<?=$product['money']?>元</h></br></br>
           <button class="btn btn-primary btn-lg btn-block" onclick="send();">加入購物車</button>
          </div>
         
    </div>
     <?php if($product['introimage']!=null):?>
          <div align="center">
          <h1> 商品實物</h>
           <img class="img-responsive" style="width:60%;height:50%" src="<?=$product['introimage']?>">
           </div>
           <?php endif;?>
</body>

</html>