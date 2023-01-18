<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>収支リスト</title>
    
        <style>
            #list{
                display: flex;
                gap:100px;
            }
            h1 {
        color: #364e96;/*文字色*/
        padding: 0.5em 0;/*上下の余白*/
        border-top: solid 3px #364e96;/*上線*/
        border-bottom: solid 3px #364e96;/*下線*/
        }
            span{
                color: #364e96;/*文字色*/
                font:bold;
            }
            .btn {
        border: 8px double#364e96;
        background-color: #0786ed;
        color:white;
        margin:6px;
        }
        header{
        display: flex;
        }
        img{
        margin-top:30px;
        }
        .mon{
        border-color: rgba(73, 28, 237, 0.888);
        border-radius: 20px;
        padding: 3px;
        }
        .cate{
        border-color: rgba(73, 28, 237, 0.888);
        border-radius: 20px;
        padding: 3px;
        }
        </style>
</head>
<body>
    <header>
    <h1>家計簿リスト</h1>
    <a href="index.html"><img src="logo.jpeg" style="width:50px;height:50px;"></a>
    </header>
    <a href="index.html"><img src="setting/93634.png" style="width: 20px;hight:20px;">戻る</a>
    <br>
    <br>
    <?php
     require_once "setting/PDO_cun.php";
  
        $db = new PDO_cun();
        $paytotal =0;
        $incometotal =0;
        $pay = $db ->sql_exe_list($_POST['pay']);
        $income = $db ->sql_exe_list($_POST['income']);
        $paycategory = $db->sql_exe_list("select * from paycategory");
        $incomecategory = $db->sql_exe_list("select * from incomecategory");
        ?>
        <div id = "list">
            <div name="paylist">
        <span style="color:red; font-size: 30px">支出</span>
        <form action="setting/resarch.php" method="POST">
            <input type="hidden" value=1 name="flag">
        月:<select name="mon" class="mon">
        <option value=0>指定しない</option>
                <?php
                for($i =1;$i<=12;$i++){
                    echo "<option value=".$i.">".$i."月</option>";
                } 
                ?>
            </select>
            カテゴリー:<select name="category" class="cate">
                <option value="なし">指定しない</option>
            <?php
        while($paycate = $paycategory->fetch()){
            echo "<option value=".$paycate['id'].">".$paycate['category']."</option>";
        }
    ?>
            </select>
            <br>
        <input type="submit" value="絞り込み" class="btn">        


        </form>
        <table border="1">
            <tr>
                <th>日付</th><th>カテゴリー</th><th>金額</th><th>メモ</th>
            </tr>
            <?php
            while($paydata = $pay -> fetch()){
                echo "<tr><th>".$paydata['date']."</th><th>".$paydata['category'].
                "</th><th>".$paydata['price']."</th><th>".$paydata['memo']."</th></tr>";
                $paytotal += $paydata['price'];
            }
            ?>
             <tr><th colspan="2">合計</th><th><?php echo $paytotal ?></th><th></th></tr>
        
        </table>
        </div>
        <div id="incomelist">
        <span style="color:blue; font-size: 30px">収入</span>
        <form action="setting/resarch.php" method="POST">
        <input type="hidden" value=2 name="flag"> 
        月:<select name="mon" class="mon">
        <option value =0>指定しない</option>
                <?php
                for($i =1;$i<=12;$i++){
                    echo "<option value=".$i.">".$i."月</option>";
                } 
                ?>
            </select>
            カテゴリー:<select name="category" class="cate">
            <option value="なし">指定しない</option>
            <?php
        while($incomecate = $incomecategory->fetch()){
            echo "<option value=".$incomecate['id'].">".$incomecate['category']."</option>";
        }
    ?>
            </select>
            <br>
        <input type="submit" value="絞り込み" class="btn">
        <table border="1">
            <tr>
                <th>日付</th><th>カテゴリー</th><th>金額</th><th>メモ</th>
            </tr>
            <?php
            while($incomedata = $income -> fetch()){
                echo "<tr><th>".$incomedata['date']."</th><th>".$incomedata['category'].
                "</th><th>".$incomedata['price']."</th><th>".$incomedata['memo']."</th></tr>";
                $incometotal += $incomedata['price'];
            }
            ?>
            <tr><th colspan="2">合計</th><th><?php echo $incometotal ?></th><th></th></tr>
        </table>
        </div>
        </div>

</body>
</html>