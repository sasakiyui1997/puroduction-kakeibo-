
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$pay ="";
$income="";
$mon =null;
$category=null;
$flag=0;
$first_date =0;
$last_date =0;

if(isset($_POST['mon'])){
    if($_POST['mon']==0){
       
    }else if($_POST['mon'] <=9){
        $mon = date('Y')."-0".$_POST['mon'];
    }else if($_POST['mon'] > 9){
        $mon = date('Y')."-".$_POST['mon'];
    }
   
    $first_date = date('Y-m-d', strtotime('first day of ' . $mon));
    $last_date = date('Y-m-d', strtotime('last day of ' . $mon));
}


if($_SERVER['HTTP_REFERER'] == null){
    header("location:http://localhost/training/kakeibo/index.html"); 
}else if($_SERVER['HTTP_REFERER'] == "http://localhost/training/kakeibo/index.html"){
    $uri = "http://localhost/training/kakeibo/list.php";
   
}else if($_SERVER['HTTP_REFERER'] == "http://localhost/training/kakeibo_code/list.php"){
    $uri =$_SERVER['HTTP_REFERER'];
    if(isset($_POST['flag']))$flag = $_POST['flag'];
    if(isset($_POST['category']))$category = $_POST['category'];
}


switch($flag){
    case 0:
        echo "まさか";
        $pay = "select date ,paycategory.category ,price ,memo from paylist
        join paycategory on paylist.category = paycategory.id order by date";
        $income= "select date ,incomecategory.category ,price ,memo from incomelist
        join incomecategory on incomelist.category = incomecategory.id order by date";
        
        break;
    case 1:
        $income = "select date ,incomecategory.category ,price ,memo from incomelist
        join incomecategory on incomelist.category = incomecategory.id order by date;";
        if($mon !=0&& $category!="なし"){
            echo "痛";
            $pay ="select date ,paycategory.category ,price ,memo from paylist
        join paycategory on paylist.category = paycategory.id where paylist.category = ".$category." and date BETWEEN '".$first_date."' and '".$last_date."'order by date;" ;

        }else if($mon != 0 && $category=="なし"){
            echo "階層";
            $pay ="select date ,paycategory.category ,price ,memo from paylist
            join paycategory on paylist.category = paycategory.id where date BETWEEN '".$first_date."' and '".$last_date."'order by date;";
        }else if($mon ==0&& $category!="なし"){
            echo "総会";
            $pay ="select date ,paycategory.category ,price ,memo from paylist
            join paycategory on paylist.category = paycategory.id where paylist.category =".$category." order by date;";
        }else{
            echo "新規一転";
            $pay = "select date ,paycategory.category ,price ,memo from paylist
        join paycategory on paylist.category = paycategory.id order by date;";
        }
        break;
    case 2:
        $pay = "select date ,paycategory.category ,price ,memo from paylist
        join paycategory on paylist.category = paycategory.id order by date;";
        if($_mon !=0&& $category!="なし"){
            $income ="select date ,incomecategory.category ,price ,memo from incomelist
            join incomecategory on incomelist.category = incomecategory.id where incomelist.category =".$category."  and date  BETWEEN '".$first_date."' and '".$last_date."'order by date;" ;
            
        }else if($mon != 0 && $category=="なし"){
            $income ="select date ,incomecategory.category ,price ,memo from incomelist
            join incomecategory on incomelist.category = incomecategory.id where date BETWEEN '".$first_date."' and '".$last_date."'order by date;";
        }else if($_POST['mon'] ==0&& $category!="なし"){
            $income ="select date ,incomecategory.category ,price ,memo from incomelist
            join incomecategory on incomelist.category = incomecategory.id where incomelist.category =".$category." order by date;";
        }else{
            $income = "select date ,incomecategory.category ,price ,memo from incomelist
        join incomecategory on incomelist.category = incomecategory.id order by date;";
        }
        break;
}
echo "月".$mon."カテゴリ".$category."フラグ".$flag.$pay;
 ?>
 <form action="../list.php" method="POST" name="search">
    <input type="hidden" name="pay" value="<?php echo $pay ?>">
    <input type="hidden" name="income" value="<?php echo $income ?>">
</form> 
    
</body>
<script>
    window.addEventListener('DOMContentLoaded',function(){
        document.search.submit();

    })
</script>  
</html>