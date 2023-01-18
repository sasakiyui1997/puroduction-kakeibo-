<?php 
 try{
    require_once "../setting/PDO_cun.php";
   
   $db = new PDO_cun();
   $input = array(null);
if(isset($_POST['cate']))$category = $_POST['cate'];
if(isset($_POST['price'])&&$_POST['price']>0)$price = $_POST['price'];
if(isset($_POST['date']))$date = $_POST['date'];
if(isset($_POST['memo']))$memo = $_POST['memo'];
if($_SERVER['HTTP_REFERER'] == null){
    $uri = "http://localhost/training/kakeibo/index.html";
}else{
    $uri = $_SERVER['HTTP_REFERER'];
}
 
if($price>0&&$price!=null&&$_SERVER['REQUEST_METHOD'] === 'POST'){
    if($uri =="http://localhost/training/kakeibo_code/input/income.php"){
        $sql="insert into incomelist values(?,?,?,?,?)";
    }else if($uri=="http://localhost/training/kakeibo_code/input/pay.php"){
        $sql="insert into paylist values(?,?,?,?,?)";
    }else{
        header("location:../setting/error.php");
    }
    array_push($input,$date,$category,$price,$memo);
    $stmt = $db->sql_insert($sql);
    $stmt -> execute($input);
    header('Location:'.$uri,true,303);
    echo $uri;
}else{
    header('Location:'.$uri,true,303);
}



}catch(PDOException $e){
    throw new  OriException($e);
   }catch(Exception $e){
       echo $e->getMessage();
   }
?>