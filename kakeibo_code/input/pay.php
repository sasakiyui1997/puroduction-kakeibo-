<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
   <title>出金入力</title>
   <link rel ="stylesheet" href="css.css">
</head>
<body>
    <?php 
    
    require_once "../setting/PDO_cun.php";
   

    $db = new PDO_cun();
    $catlist = $db->sql_exe_list("select * from paycategory");
    ?>
    <h1>出金入力</h1>
    <a href="../index.html"><img src="../setting/93634.png" style="width: 20px;hight: 20px;">戻る</a>
    <br>
    <br>

    <br>
    <form action="../setting/insert.php" method="POST" name = "pay">
    カテゴリー：
   
    <select name="cate" id ="cate">
        <?php
        while($paycate = $catlist->fetch()){
            echo "<option value=".$paycate['id'].">".$paycate['category']."</option>";
        }
    ?>
     </select>
    <br>
    日付:<input type="date" id="calender" name="date" ><br>
    <input type="number" name="price" id="price" placeholder="金額"><br>
    <input type="text" name="memo" id="memo" placeholder="メモ"><br>
    <button onclick="check()">追加</button>
  
    
</body>
<script>
    var kettei = false;
function check(){
    var obj = document.getElementById("cate");
    var idx = obj.selectedIndex;
    console.log(idx);
   var category=obj.options[idx].innerText;
    var price = document.getElementById("price").value;
    var date = document.getElementById("calender").value;
    var memo = document.getElementById("memo").value;
    if(price==""||price<=0){
    alert("金額が未入力又は無効な金額です！");
   }
   if(price>0&&price!=""){
     kettei = confirm('入力内容の確認\n入金カテゴリー:'+category+'\n金額:'+price+'\n日付:'+date+'\nメモ:'+memo);
   }
  
}
if(kettei){
    document.pay.submit();
   }
var today = new Date();
var yyyy = today.getFullYear();
    var mm = ("0" + (today.getMonth() + 1)).slice(-2);
    var dd = ("0" + today.getDate()).slice(-2);
    document.getElementById("calender").value = yyyy + '-' + mm + '-' + dd;
</script>
</html>