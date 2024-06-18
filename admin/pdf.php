<?php 
	$conn = mysqli_connect("localhost","root","","task manager");
	ob_start();
	require("../FPDF/fpdf.php");
	$pdf = new FPDF('L','mm','A4');
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',11);
	$pdf->cell(10,10,'S.No',1,0,'C');
    $pdf->cell(10,10,'ID',1,0,'C');
	$pdf->cell(50,10,'From',1,0,'C');
	$pdf->cell(50,10,'To',1,0,'C');
	$pdf->cell(100,10,'Task',1,0,'C');
	$pdf->cell(23,10,'Begins',1,0,'C');
	$pdf->cell(23,10,'Deadline',1,1,'C');

    $sql="SELECT * FROM tasks";
    $res=$conn->query($sql);

    if($res->num_rows>0)
    {
        $ind=0;
        while($row=$res->fetch_assoc())
        {
            $F_date = date('d-m-Y',strtotime($row["Begins"]));
            $Dead_Line = date('d-m-Y',strtotime($row["Ends"]));
            $ind++;

            $pdf->cell(10,10,$ind,1,0);
            $pdf->cell(10,10,$row["ID"],1,0);
            $pdf->cell(50,10,$row["From1"],1,0);
            $pdf->cell(50,10,$row["To2"],1,0);
            $pdf->cell(100,10,$row["Task"],1,0);
            $pdf->cell(23,10,$F_date,1,0);
            $pdf->cell(23,10,$Dead_Line,1,1);
        }
    }
    else
    {
        $pdf->cell(10,6,'No Records Found',1,0,'C');
    }

	$pdf->Output();
	ob_end_flush();
	
	?>

<footer>

<input type="text" id="From_inp" onkeyup="From()" placeholder="Search by From Role" title="Who Assigns">
<input type="text" id="To_inp" onkeyup="To()" placeholder="Search by Assign to Role" title="Whos task">
<input type="text" id="Task_inp" onkeyup="Task()" placeholder="Search by Task" title="Task">
<input type="text" id="deadline_inp" onkeyup="deadline()" placeholder="Search by Deadline" title="When">

<script type="text/javascript">
    function From() 
    {
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("From_inp");
          filter = input.value.toUpperCase();
          table = document.getElementById("myTable");
          tr = table.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) 
          {
                td = tr[i].getElementsByTagName("td")[3];
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
                td = tr[i].getElementsByTagName("td")[5];
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
</script>

</footer>