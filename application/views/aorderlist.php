<html>
<head>
<script src="/js/jquery.min.js"></script>
<script "text/javascript">
 function change(x){
     var sid = document.getElementById("sid"+x).value;
       $.ajax({
                url: "/admin/out",
                data: "sid="+sid,
                type:"POST",
                dataType:'html',
                success: function(data){
                    window.location.reload(); 
                }
       });
 }
</script>
<title>xxx購物網後台系統</title>

</head>
<body style="background:url('/images/enter.jpg');background-repeat">
<div style="text-align:center;">
<h2> 員工<?=$name?></h2>
<div>
<span style="font-size:25px"><a href="/admin/stock">存貨</a>&nbsp;&nbsp;&nbsp;&nbsp;</span>
</div>
<div style="margin-top:20px">
<span style="font-size:25px"><a>未出貨訂單</a>&nbsp;&nbsp;</span>
<span style="font-size:25px"><a href="/admin/transport">運送中訂單</a>&nbsp;&nbsp;</span>
<span style="font-size:25px"><a href="/admin/getfinish">已完結訂單</a>&nbsp;&nbsp;</span>
</div>
</div> 
 <div style="margin-top:50px;text-align:center;">
    <?php if($orderlist==null):?>
    <h2>目前無未出貨訂單</h>
    <?php else:?>
    <table align="center" border="1" cellpadding="10" style="width:64%;height:auto;text-align:center">
    <tr>
     <th></th>
    <th>訂單編號</th>
    <th>收件人</th>
    <th>寄送地址</th>
    <th>到貨日</th>
    <th>訂單狀態</th>
   <th>商品名</th>
    <th>數量</th>
    </tr>
    <?php $x=0;?>
    <?php foreach($orderlist as $tmp):?>
    <?php $y=0;?>
    <tr>
     <td rowspan="<?=$tmp['count']?>"><button id="<?=$x?>" onclick="change(this.id);">點我出貨</button></td>
    <input type="hidden" id="sid<?=$x?>" value="<?=$tmp['sid']?>"> 
    <td rowspan="<?=$tmp['count']?>"><?=$tmp['ordernum']?></td>
    <td rowspan="<?=$tmp['count']?>"><?=$tmp['sendpeople']?></td>
    <td rowspan="<?=$tmp['count']?>"><?=$tmp['address']?></td>
    <td rowspan="<?=$tmp['count']?>"><?=$tmp['sendate']?></td>
    <td rowspan="<?=$tmp['count']?>"><?=$tmp['status']?></td>
    <?php foreach($tmp['detail'] as $detail):?>
    <?php if($y!=0):?><tr> <?php endif;?>
    <td style="font-size:15px;width:32%;"><?=$detail['name']?></td>
    <td><?=$detail['num']?></td>
    <?php if($y==0):?> </tr> 
    <?php else:?> <tr> 
    <?php endif;?>
    <?php endforeach;?>
   
    
     <?php $x++;?>
    <?php endforeach;?>
    </table>
    <?php endif;?>
    </div> 
</body>
</html>  