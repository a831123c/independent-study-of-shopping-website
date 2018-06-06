<html>
<head>
<title>xxx購物網後台系統</title>
 <script type="text/javascript">
      function check()
        {
            var num = <?php echo $num?>;
            if(delete1.num.value>num) alert("銷貨數量不得超過存貨!");
            else delete1.submit();
        }
    </script>
</head>
<body style="background:url('/images/enter.jpg');background-repeat">
 <div style="margin-top:20px;text-align:center;">
   <h2> 員工<?=$name?></h2>
   <div>
<span style="font-size:25px"><a href="/admin/stock">存貨</a>&nbsp;&nbsp;&nbsp;&nbsp;</span>
</div>
<div style="margin-top:20px">
<span style="font-size:25px"><a href="/admin/orderlist">未出貨訂單</a>&nbsp;&nbsp;</span>
<span style="font-size:25px"><a href="/admin/transport"> 運送中訂單</a>&nbsp;&nbsp;</span>
<span style="font-size:25px"><a href="/admin/getfinish">已完結訂單</a>&nbsp;&nbsp;</span>
</div>
</div> 
</div>
    <div style="margin-top:80px;text-align:center;font-size:25px">
    <h4> 欲銷貨之商品：<?=$pname?></h4>
    <form action="/admin/stockminus" method="post" name="delete1">
    <input type="hidden" name="pid" value="<?=$pid?>">
    請輸入銷貨數量<input type="text" name="num"><br><br>
    <input style="font-size:20px;width:80px;height:40px;" type="button" value="送出" onclick="check();">
    </form>
    </div>
</body>
</html>  
<!--<select name="num">
    <?php //for ($x=1; $x <=$num ; $x++):?>
      <option value="<?//=$x?>"><?//=$x?></option>
    <?php //endfor;?>
    </select>>