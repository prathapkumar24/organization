/*Custom javascript file*/

$(document).ready(function(){
	
	
	$('#employeeGrid').DataTable( {
		"processing": true,
		"serverSide": true,
		"ajax": "get_employees.php",
		"aaSorting": [[ 0, "asc" ]]
	} );

	$('#dob').datetimepicker({
		format:'d-m-Y',
		timepicker: false,
		maxDate: 0
	  });

});
