

var a=2;
// for requests  from factory
    	function AddNew() {
	


        var appendTxt ="<tr><td>"+a+"</td><td><select style='width:220px'><option>موتور تکمیل سی جی 125</option></select></td><td><input id='n\"+a+\"' type='text' name='name[]' onchange='change1()'  /></td></td><td><input id='p1' type='text'   name='price[]' onchange='change1()' /></td><td><input id='t1' type='text' name='total[]' /></td></tr>";
        $("#tb tr:last").after(appendTxt);
        $("#tb tr:last").hide().fadeIn('slow');
	
      a+=1;  
	
    }
			function removeRow()
     		{
     	     // grab the element again!
     	     var tbl = document.getElementById('tb');
     	     // grab the length!
     	     var lastRow = tbl.rows.length;
      	    // delete the last row if there is more than one row!
      	    if (lastRow > 2){ 
						var tt='t'+a;
			//document.getElementById('total').value=parseInt(document.getElementById('total').value)-parseInt(document.getElementById('t1').value);
			tbl.deleteRow(lastRow - 1);

				a--;	}		
			
    	 }
		 
		 
		 
	function change1()
	{
	var t='t'+a;
	var p='p'+a;
	var aa='a'+a;
	document.getElementById(t).value=parseInt(document.getElementById(p).value)*parseInt(document.getElementById(aa).value);
	document.getElementById('total').value=parseInt(document.getElementById('total').value)+parseInt(document.getElementById(t).value);
	
	}
	
	
	// For new proforms
	var a=2;
    	function AddNeww() {
		var id1='c'+a;
		var id2='a'+a;
		var id3='b'+a;
        var appendTxt ="<tr><td align='center'>"+a+"</td><td align='center'><select style='width:220px' id='c[]' class='validate[required]'><option value=''>انتخاب</option><option value='1'>موتور تکمیل سی جی 125</option></select></td><td align='center'><input id='a[]' type='text' class='validate[required]' name='name[]' onchange='change1()'  /></td><td align='center'><input id='b[]' type='text' class='validate[required]' name='name[]' onchange='change1()'  /></td><td></td></tr>";
        $("#tb tr:last").after(appendTxt);
        $("#tb tr:last").hide().fadeIn('slow');
	
      a+=1;  
	
    }
	
			function removeRoww()
     		{
     	     // grab the element again!
     	     var tbl = document.getElementById('tb');
     	     // grab the length!
     	     var lastRow = tbl.rows.length;
      	    // delete the last row if there is more than one row!
      	    if (lastRow > 2){ 
						var tt='t'+a;
			//document.getElementById('total').value=parseInt(document.getElementById('total').value)-parseInt(document.getElementById('t1').value);
			tbl.deleteRow(lastRow - 1);

				a--;	}		
			
    	 }
		 
	// For new Factor Parchon
	var a=2;
    	function AddNewww() {
		var id1='c'+a;
		var id2='a'+a;
		var id3='b'+a;
        var appendTxt ="<tr><td align='center'>"+a+"</td><td align='center'><select style='width:220px' id='c[]' class='validate[required]'><option value=''>انتخاب</option><option value='1'>موتور تکمیل سی جی 125</option></select></td><td ><select style='width:220px' id='c[]' class='validate[required]'><option value=''>انتخاب</option><option value='1'>67772-8888776</option></select></td><td align='center'><input id='a[]' type='text' class='validate[required]' size='8' name='name[]' onchange='change1()'  /></td><td align='center'><input id='b[]' type='text' class='validate[required]' size='8' name='name[]' onchange='change1()'  /></td><td align='center'><input id='b[]' type='text' size='8' class='validate[required]' name='name[]' onchange='change1()'  /></td></tr>";
        $("#tb tr:last").after(appendTxt);
        $("#tb tr:last").hide().fadeIn('slow');
	
      a+=1;  
	
    }
	
			function removeRowww()
     		{
     	     // grab the element again!
     	     var tbl = document.getElementById('tb');
     	     // grab the length!
     	     var lastRow = tbl.rows.length;
      	    // delete the last row if there is more than one row!
      	    if (lastRow > 2){ 
						var tt='t'+a;
			//document.getElementById('total').value=parseInt(document.getElementById('total').value)-parseInt(document.getElementById('t1').value);
			tbl.deleteRow(lastRow - 1);

				a--;	}		
			
    	 }