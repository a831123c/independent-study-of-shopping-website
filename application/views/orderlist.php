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
     function getdetail(x){
         var sid = document.getElementById("sid"+x).value;
         var detail = document.getElementById("detail"+x);
         $.ajax({
                url: "/shopping/orderdetail",
                data: "sid="+sid,
                type:"POST",
                dataType:'html',
                success: function(data){
                var list = JSON.parse(data);
                var count = list['count'];
                detail.innerHTML = "";
                var HTML = "<table border=1>"
                 +"<thead>"
                 +"<th>商品名</th>"
                 +"<th>單價</th>"
                 +"<th>數量</th>"
                 +"<th>小計</th>"
                 +"</thead>";
                for(var x=0;x<count;x++){
                      HTML+="<tbody>"+"<tr>"+
                      "<td>"+list[x]['pname']+"</td>"+
                      "<td>"+list[x]['money']+"</td>"+
                      "<td>"+list[x]['num']+"</td>"+
                      "<td>"+list[x]['price']+"</td>"+
                      "</tr>"+"</tbody>";
                  }
                  HTML+="</table>";
                 detail.innerHTML=HTML;
                },
            });
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
        table.table-hover th,td{
            border:2px solid transparent !important;
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
                <li><a>會員訂單</a></li>
            </ui>
            </span>
            <ui class="nav navbar-nav navbar-right">
            <li><a href="/shopping/car">購物車</a></li>
            <?php if(isset($name)):?>
                <li><a href="#">歡迎<?=$name?></a></li>
                <li class="active"><a href="/shopping/orderlist">已下訂訂單</a></li>
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
    <?php if(!isset($list)):?>
   <div class="container" style="text-align:center;">
    <h1>目前尚無訂單</h1>
    </div>
    <?php else:?>
    <table class="table table-hover" style="font-size: 18px;" style="border-color:blue">
    <thead>
      <tr>
        <th>訂單編號</th>
        <th>收件人</th>
        <th>收件地址</th>
        <th>總額</th>
        <th>送達日期</th>
        <th>送貨狀態</th>
        <th id="tde"></th>        
      </tr>
      </thead>
      <?php $x=0?>
      <?php foreach($list as $tmp):?>
        <tr>
        <td><?=$tmp['ordernum']?></td>
        <td><?=$tmp['sendpeople']?></td>
        <td><?=$tmp['address']?></td>
        <td><?=$tmp['total']?></td>
        <td><?=$tmp['sendate']?></td>
        <td><?=$tmp['status']?></td>
        <input type="hidden" id="sid<?=$x?>" value="<?=$tmp['sid']?>"> 
        <td><div id="detail<?=$x?>"><input class="btn btn-info" id="<?=$x?>" value="查看細項" onclick="getdetail(this.id);"></div></td>
      </tr>
      <?php $x++;?>
      
      <?php endforeach;?>
      </table>
      
      <?php endif;?>
    </div>
   
   
</body>
</html>