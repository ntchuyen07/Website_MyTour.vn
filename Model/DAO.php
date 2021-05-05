<?php
class DAO {

    private $hostname = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "mytour";

    public $conn;

    function __construct()
    {
        $this->conn = new mysqli($this->hostname, $this->user, $this->pass, $this->db) or die("Connetion false"); 
    }

    public function checkAccount($user, $pass)
    {
        $sql = "SELECT * FROM account WHERE username = '".$user."' AND password = '".$pass."'";
        $result = $this->conn->query($sql);
        $role = -1;
        if($result->num_rows > 0) {
            while($row = mysqli_fetch_assoc($result)){
                $role = $row["role"];
            }
        };
        return $role;
    }

    public function getData($sql)
    {
        //Create array to store data
        $array = array();
        $result = $this->conn->query($sql);

        while($row = mysqli_fetch_array($result, $resulttype = MYSQLI_ASSOC)){
            $array[] = $row;
        }

        return  $array;
    }

    public function insertToDB($sql){
        if($this->conn->query($sql) === TRUE){
           
        }
       
    }

}
?>