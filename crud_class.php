<?php  
require_once('config.php');
  
/*
* class for employee crud functionalities
* author: Prathap kumar M
*/
class Crud  
{  
    private $conn;
    public function __construct(DB $db) {  
        $this->conn = $db;  
    }  

    /*
    * @param array $data the array data of inserting items
    * @return int inserted employee id
    */
    public function createEmployee($data){
        try {
            $check_email = $this->conn->prepare("SELECT `email` FROM `employee` WHERE email = :email");
            $check_email->bindParam("email", $data['email'], PDO::PARAM_STR);
            $check_email->execute();
            $row = $check_email->fetch(PDO::FETCH_ASSOC);
            if(!$row){    
                $employeeRole = 'employee';
                $activeStatus = 1;
                $createdAt = 'NOW()';
                $query =  $this->conn->prepare("INSERT INTO employee (first_name, last_name, email, dob, role, status, created_at, reporting_person) VALUES (:first_name, :last_name, :email, :dob, :role, :status, :created_at, :reporting_person)");
                $query->bindParam("first_name", $data['first_name'], PDO::PARAM_STR);
                $query->bindParam("last_name", $data['last_name'], PDO::PARAM_STR);
                $query->bindParam("email", $data['email'], PDO::PARAM_STR);
                $query->bindParam("dob", $data['dob'], PDO::PARAM_STR);
                $query->bindParam("role", $employeeRole, PDO::PARAM_STR);
                $query->bindParam("status", $activeStatus, PDO::PARAM_STR);
                $query->bindParam("created_at", $createdAt, PDO::PARAM_STR);
                $query->bindParam("reporting_person", $data['reporting_person'], PDO::PARAM_STR); 
                $query->execute();
                return $this->conn->lastInsertId();
            }else{
                return false;
            }
            
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    /*
    * get reporting persons list for show in create employee form
    * @return array reporting persons details 
    */
    public function getReportingPersons(){
        $query =  $this->conn->prepare("SELECT * FROM `employee` WHERE (`role` = 'pm' OR `role`  ='lead' ) AND `status` = 1");
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    /*
    * get reporting persons name to show in datatable
    *
    * @param array $id the integer id of reportting person
    * @return string the full name of the reporting person
    */
    public function getReportingPersonName($id){
        $query =  $this->conn->prepare("SELECT CONCAT(e.first_name, ' ', e.last_name) as full_name FROM `employee` INNER JOIN employee e on employee.reporting_person = e.id WHERE employee.reporting_person =:id");
        $query->bindParam("id", $id, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch();
        if($result){
            return $result['full_name'];
        }
        return '-';
    }
  
}  
  
?>  