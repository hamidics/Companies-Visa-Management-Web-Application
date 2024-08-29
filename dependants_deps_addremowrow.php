<?php
		
		
		echo "<script language=\"javascript\">
		<!--
		var a=2;
		
    	function AddNew() {
	
		
        var appendTxt = \"<tr><td align='center'><input type=text  size='16'  name='depdepname[]'   /></td><td align='center'><input type=text  size='16'  name='deplastname[]'   /></td><td align='center'><input type=text  size='16'  name='depfather[]'   /></td><td align='center'><input type=text  size='16'  name='depbirthdate[]'   /></td><td align='center'><input type=text  size='16'  name='deprelation[]'   /></td><td align='center'><input type=text  size='16'  name='depeducation[]'   /></td><td align='center'><input type=text  size='16'  name='depjob[]'   /></td></tr>\";
        $(\"#deptable tr:last\").after(appendTxt);
        $(\"#deptable tr:last\").hide().fadeIn('slow');
	
      a+=1;  
	
    }
var a=2;
		
    	function AddNew2() {
	
		
        var appendTxt = \"<tr><td align='center'><input type=text  size='14'  name='depdepname[]'   /></td><td align='center'><input type=text  size='14'  name='deplastname[]'   /></td><td align='center'><input type=text  size='14'  name='depfather[]'   /></td><td align='center'><input type=text  size='14'  name='depbirthdate[]'   /></td><td align='center'><input type=text  size='14'  name='deprelation[]'   /></td><td align='center'><input type=text  size='14'  name='depeducation[]'   /></td><td align='center'><input type=text  size='14'  name='depjob[]'   /></td></tr>\";
        $(\"#deptable tr:last\").after(appendTxt);
        $(\"#deptable tr:last\").hide().fadeIn('slow');
	
      a+=1;  
	
    }
	
	// -->
	</script>";
	
	
		?>
		<script language="javascript">
		
		
	var p=2;
		
    	function AddNewfile() {
	
		attachid="attachdetail"+p;
		fileid="attach"+p;
        var appendTxt = "<tr><td align='center'><input type=text  class='validate[required]'  name='attachdetail[]' id='"+attachid+"'  /></td><td align='center'><input type=text   name='date[]'   /></td><td align='center'><input type='file' class='validate[required]'    name='attach[]' id='"+fileid+"'  /></td></tr>";
        $("#dtable tr:last").after(appendTxt);
        $("#dtable tr:last").hide().fadeIn('slow');
	
      p+=1;  
	
    }
	
				function removeRow()
     		{
     	     // grab the element again!
     	     var tbl = document.getElementById('deptable');
     	     // grab the length!
     	     var lastRow = tbl.rows.length;
      	    // delete the last row if there is more than one row!
      	    if (lastRow > 2){ tbl.deleteRow(lastRow - 1);
				a--;	}		

    	 }
		function removeRowfile()
     		{
     	     // grab the element again!
     	     var tbl = document.getElementById('dtable');
     	     // grab the length!
     	     var lastRow = tbl.rows.length;
      	    // delete the last row if there is more than one row!
      	    if (lastRow > 2){ tbl.deleteRow(lastRow - 1);
				p--;	}		

    	 }
		 
		 function removeRow3()
     		{
     	     // grab the element again!
     	     var tbl = document.getElementById('tblcc');
     	     // grab the length!
     	     var lastRow = tbl.rows.length;
      	    // delete the last row if there is more than one row!
      	    if (lastRow > 2){ tbl.deleteRow(lastRow - 1);
				d--;	}		

    	 }
		 </script>