<?php
 
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'employee';
 
// Table's primary key
$primaryKey = 'id';

include_once 'crud_class.php';  
$host = HOST; $db = DB; $user = USER; $pass = PASS;
$pass = PASS;
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'first_name', 'dt' => 0 ),
    array( 'db' => 'last_name',  'dt' => 1 ),
    array( 'db' => 'email',  'dt' => 2 ),
    array(
        'db'        => 'dob',
        'dt'        => 3,
        'formatter' => function( $d, $row ) {
            return date( 'd-m-Y', strtotime($d));
        }
    ),
    array(
        'db'        => 'reporting_person',
        'dt'        => 4,
        'formatter' => function( $d, $row ) {
            $conn = new DB(HOST, DB, USER, PASS);
            $class = new Crud($conn);  
            return $class->getReportingPersonName($d);
        }
    )
);
 
// SQL server connection information


$sql_details = array(
    'user' => USER,
    'pass' => PASS,
    'db'   => DB,
    'host' => HOST
);


 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);