<html>
<head>
<title>xxx購物網後台系統</title>
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
    <h4> 欲進貨之商品：<?=$pname?></h4>
    <form action="/admin/stockadd" method="post">
    <input type="hidden" name="pid" value="<?=$pid?>">
    請輸入數量<input type="text" name="num">
    <input style="font-size:20px;width:80px;height:40px;" type="submit" value="送出">
    </form>
    </div>
</body>
</html>  