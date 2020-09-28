<?php
// include_once('sessaoControl.php');
class ConDb{
    private static $conn;
    private  function setConn(){
        return 
        is_null(self::$conn)?
                self::$conn=new PDO('mysql:host=localhost;dbname=mozsuperagente;','root','massuine@1234'):
                self::$conn;
    }
    public function  getConn(){
        return $this -> setConn();
    }
    
}
?>