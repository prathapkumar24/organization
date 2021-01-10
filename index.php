<?php  
   session_start();  
   include_once 'crud_class.php';  
   $host = HOST; $db = DB; $user = USER; $pass = PASS;
   $pass = PASS;
   $conn = new DB($host, $db, $user, $pass);
   $class = new Crud($conn);  
  
   $reporting_persons = $class->getReportingPersons();

   if ($_SERVER["REQUEST_METHOD"] == "POST"){  
      if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['dob']) && isset($_POST['reporting_person'])){
         $firstName = $_POST['first_name'];
         $lastName = $_POST['last_name'];
         $email = $_POST['email'];
         $dob = date('Y-m-d', strtotime($_POST['dob']));
         $reportingPerson = $_POST['reporting_person'];
         $insertData = ['first_name' => $firstName, 'last_name' => $lastName, 'email' => $email, 'dob' => $dob, 'reporting_person' => $reportingPerson ];
         $addEmployedd = $class->createEmployee($insertData);  
          if($addEmployedd){  
              $success_message =  "Employee added Successfully!";   
              header("location:view_employees.php");  
          }
          else
          {  
              $error_message =  "Entered email already exist!";  
          }  
      } 
  }
?>  
<?php require_once('header.php'); ?>

<div class="container">
<?php
   if(isset($success_message)){
   echo '<div class="success_message text-success">'.$success_message.'</div>'; 
   }
   if(isset($error_message)){
   echo '<div class="error_message text-danger">'.$error_message.'</div>'; 
   }
?>
   <h4><a href="view_employees.php" >Employees list</a></h4>
   <h1>Add an Employee</h1>

   <form action="" method="post">
      <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
      </div>
      <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
      </div>
      <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email" required>
      </div>
      
      <div class="form-group">
            <label>Date Of Birth</label>
            <input type="text" name="dob" autocomplete="off" class="form-control" id="dob" placeholder="Date of Birth" required>
      </div>
      <div class="form-group">
         <label for="sel1">Select Reporting Person</label>
         
         <select name="reporting_person" class="form-control" required>
         <option value="">Select</option>
         <?php if(count($reporting_persons) > 0): 
                  foreach($reporting_persons as $person): ?>
                  <option value="<?=$person['id']; ?>"><?=$person['first_name'].' '.$person['last_name'] ?></option>
         <?php 
                  endforeach;
               endif;  ?>
         </select>
      </div>
      <input type="submit" class="btn btn-primary" value="Submit" />
   </form> 
</div>
<?php require_once('footer.php'); ?>