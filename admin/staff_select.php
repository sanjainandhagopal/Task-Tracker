<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>

<script type="text/javascript">
function my_fun(str) {

	if(window.XMLHttpRequest)
	{
		xmlhttp = new XMLHttReguest();
	}
	else
	{
		xmlhttp = new ActiveCObject("Microsoft.XMLHTTP");
	}

	Xmlhttp.onreadystatechange = function()
	{
		if (this.radyState==4 && this.status==200) 
		{
			document.getElementById('poll').innerHTML = this.responseText;
		}
	}
	xmlhttp.open("GET","helper.php?value="+str,true);
	xmlhttp.send();
}
</script>

<body>

	<div>
		<select id="SelectA" onchange="my_fun(this.value);">
			<option>Select Department</option>
			<option value="it">IT</option>
			<option value="csbs">CSBS</option>
		</select>

		<br>

		<div id="poll">
			<select>
				<option>Select staff</option>
			</select>
		</div>
	</div>

</body>
</html>