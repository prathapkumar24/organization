<?php  
define('HOST', 'localhost');  
define('USER', 'root');  
define('PASS', '');  
define('DB', 'organization');  

/*
* class for dconnect database
*/
class DB extends PDO
{
    public function __construct($host, $db, $user, $pass)
    {
        parent::__construct('mysql:host='.$host.';dbname='.$db.'', $user, $pass);
        $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // always disable emulated prepared statement when using the MySQL driver
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
} 
  
?>