<html>

<head>
    <meta charset="UTF-8">
    <script src="<?=base_url("/js/jquery.min.js")?>"></script>
    <script "text/javascript">
          function loadXMLDoc(){
             $.ajax({
                url: "/shopping/test2",
                data: "pid="+document.getElementById("pid").value,
                type:"POST",
                dataType:'html',

                success: function(msg){
                  alert(msg);
                },
           })
          }
    </script>
    <head>
    <body>
    <input type="hidden" value=2 id="pid">
    <button onclick="loadXMLDoc()">點我</button>
    </body>
</html>