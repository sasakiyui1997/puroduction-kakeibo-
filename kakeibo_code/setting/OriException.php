<?php
class OriException extends Exception{
    //コンストラクタ（newされた時点で行う)
    function __construct(Exception $e){
        $msg = "SQLエラー";
        switch($e->getCode()){
            case'1045':
                $msg='DB接続エラー（ユーザ名エラー）';
                break;
                case'2002':
                case'2003':
                $msg='DB接続エラー（サーバ停止）';
                break;
                case'2005':
                $msg='DB接続エラー（ホストエラー）';
                break;
        }
        switch(get_class($e)){
            case 'PDOException':
                exit($msg.'メンテナンスに連絡してください<br>');
                break;
            case'Exception':
                exit('エラー：メンテナンスに連絡してください<br>');
            break;
            default:
            echo('想定外のエラーが発生しました');
        }
    }
} ?>