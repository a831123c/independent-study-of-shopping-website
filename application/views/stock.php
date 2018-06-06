<html>
<head>
<title>xxx購物網後台系統</title>
</head>
<body style="background:url('/images/enter.jpg');background-repeat">
<div style="text-align:center;">
<h2> 員工<?=$name?></h2>
<div>
<span style="font-size:25px"><a>存貨</a>&nbsp;&nbsp;&nbsp;&nbsp;</span>
</div>
<div style="margin-top:20px">
<span style="font-size:25px"><a href="/admin/orderlist">未出貨訂單</a>&nbsp;&nbsp;</span>
<span style="font-size:25px"><a href="/admin/transport"> 運送中訂單</a>&nbsp;&nbsp;</span>
<span style="font-size:25px"><a href="/admin/getfinish">已完結訂單</a>&nbsp;&nbsp;</span>
</div>
<?php if($totalpage>1):?>
<div>
<?php if($page>1):?>
<span style="font-size:25px"><a href="/admin/stock?page=<?=$page-1?>">上一頁</a>
<?php endif;?>
<?php if($page<$totalpage):?>
<span style="font-size:25px"><a href="/admin/stock?page=<?=$page+1?>">下一頁</a>
<?php endif;?>
</div> 
<?php endif;?>
</div> 
 <div style="margin-top:20px;text-align:center;">
    <?php if($stock==null):?>
    <h2>目前無商品</h>
    <?php else:?>
    <table align="center" border="1"  style="width:80%;text-align:center">
    <tr>
    <th>商品名</th>
    <th>存貨數量</th>
    <th></th>
    <th></th>
    </tr>
    <?php foreach($stock as $tmp):?>
    <tr>
    <td ><?=$tmp['pname']?></td>
    <td ><?=$tmp['stock_num']?></td>
    <td><button onclick="window.location.href='/admin/deletestock?pid=<?=$tmp['pid']?>'">銷貨</button></td>
    <td><button onclick="window.location.href='/admin/addstock?pid=<?=$tmp['pid']?>'">進貨</button></td>
    </tr>
    <?php endforeach;?>
    </table>
    <?php endif;?>
    </div> 
</body>
</html>  