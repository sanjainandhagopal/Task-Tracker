function id() 
		{
  			var input, filter, table, tr, td, i, txtValue;
  			input = document.getElementById("id_inp");
  			filter = input.value.toUpperCase();
  			table = document.getElementById("myTable");
  			tr = table.getElementsByTagName("tr");
  			for (i = 0; i < tr.length; i++) 
  			{
    				td = tr[i].getElementsByTagName("td")[2];
    				if (td) 
    				{
      					txtValue = td.textContent || td.innerText;
      					if (txtValue.toUpperCase().indexOf(filter) > -1) 
      					{
        					tr[i].style.display = "";
      					} 
      					else 
      					{
        					tr[i].style.display = "none";
      					}
    				}       
  			}
		}
		function From() 
		{
  			var input, filter, table, tr, td, i, txtValue;
  			input = document.getElementById("From_inp");
  			filter = input.value.toUpperCase();
  			table = document.getElementById("myTable");
  			tr = table.getElementsByTagName("tr");
  			for (i = 0; i < tr.length; i++) 
  			{
    				td = tr[i].getElementsByTagName("td")[2];
    				if (td) 
    				{
      					txtValue = td.textContent || td.innerText;
      					if (txtValue.toUpperCase().indexOf(filter) > -1) 
      					{
        					tr[i].style.display = "";
      					} 
      					else 
      					{
        					tr[i].style.display = "none";
      					}
    				}       
  			}
		}

		function To() 
		{
  			var input, filter, table, tr, td, i, txtValue;
  			input = document.getElementById("To_inp");
  			filter = input.value.toUpperCase();
  			table = document.getElementById("myTable");
  			tr = table.getElementsByTagName("tr");
  			for (i = 0; i < tr.length; i++) 
  			{
    				td = tr[i].getElementsByTagName("td")[4];
    				if (td) 
    				{
      					txtValue = td.textContent || td.innerText;
      					if (txtValue.toUpperCase().indexOf(filter) > -1) 
      					{
        					tr[i].style.display = "";
      					} 
      					else 
      					{
        					tr[i].style.display = "none";
      					}
    				}       
  			}
		}

		function Task() 
		{
  			var input, filter, table, tr, td, i, txtValue;
  			input = document.getElementById("Task_inp");
  			filter = input.value.toUpperCase();
  			table = document.getElementById("myTable");
  			tr = table.getElementsByTagName("tr");
  			for (i = 0; i < tr.length; i++) 
  			{
    				td = tr[i].getElementsByTagName("td")[6];
    				if (td) 
    				{
      					txtValue = td.textContent || td.innerText;
      					if (txtValue.toUpperCase().indexOf(filter) > -1) 
      					{
        					tr[i].style.display = "";
      					} 
      					else 
      					{
        					tr[i].style.display = "none";
      					}
    				}       
  			}
		}

		function deadline() 
		{
  			var input, filter, table, tr, td, i, txtValue;
  			input = document.getElementById("deadline_inp");
  			filter = input.value.toUpperCase();
  			table = document.getElementById("myTable");
  			tr = table.getElementsByTagName("tr");
  			for (i = 0; i < tr.length; i++) 
  			{
    				td = tr[i].getElementsByTagName("td")[8];
    				if (td) 
    				{
      					txtValue = td.textContent || td.innerText;
      					if (txtValue.toUpperCase().indexOf(filter) > -1) 
      					{
        					tr[i].style.display = "";
      					} 
      					else 
      					{
        					tr[i].style.display = "none";
      					}
    				}       
  			}
		}

		function status() 
		{
  			var input, filter, table, tr, td, i, txtValue;
  			input = document.getElementById("Stat_inp");
  			filter = input.value.toUpperCase();
  			table = document.getElementById("myTable");
  			tr = table.getElementsByTagName("tr");
  			for (i = 0; i < tr.length; i++) 
  			{
    				td = tr[i].getElementsByTagName("td")[9];
    				if (td) 
    				{
      					txtValue = td.textContent || td.innerText;
      					if (txtValue.toUpperCase().indexOf(filter) > -1) 
      					{
        					tr[i].style.display = "";
      					} 
      					else 
      					{
        					tr[i].style.display = "none";
      					}
    				}       
  			}
		}