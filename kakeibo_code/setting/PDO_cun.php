<?php
//コンストラクタで接続して、デストラクタで切断する
class PDO_cun{
    public $db;
    
    function __construct(){
       try{
        $this->db = new PDO('mysql:host=localhost;dbname=kakeibo;charset=utf8','root','admin');
        $this->db ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        throw new OriException($e);
    }
}
    public function sql_exe_list($sql){
        return $this->db->query($sql);
    }
    public function sql_exe_oneLine($sql){
        $stmt =  $this->db->query($sql);
        return $stmt->fetch();
    }
    public function sql_insert($sql){
        return $this->db->prepare($sql);
    }
    //特定のカラムを1行ずつよむ関数
    public function sql_exe_oneColumn($sql){
        $stmt =  $this->db->query($sql);
        return $stmt->fetchColumn();
    }

    function __destruct()
    {
        $this->db= null;
    }

}

?>