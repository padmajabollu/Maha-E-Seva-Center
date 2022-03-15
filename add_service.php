<?php
	session_start();
	if(!(isset($_SESSION['admin'])))
	{
		header('Location:admin_login.php');
	}
?>

<?php
include 'conn.php';
$flag=0;
if(isset($_POST['add_service']))
{
	$service_name=strtoupper($_POST['service_name']);
	$service_count=$_POST['service_count'];
	$service_img=$_POST['img'];
	$service_cost=$_POST['service_cost'];
	echo "$service_cost<br>";
	echo "$service_img<br>";
	echo "$service_count<br>";
	echo "$service_name<br>";

	$select="SELECT * FROM services where service_name='$service_name' ";
	$result = mysqli_query($conn,$select);
	$resultcount=mysqli_num_rows($result);
	if($resultcount==0)
	{
		$name=$_FILES['service_img']['name'];

		$tmpname=$_FILES['service_img']['tmp_name'];

		$target_dir = "uploads/"; //folder name where your files will be stored. create this folder inside "file_upload_api" folder
		$target_file = $target_dir.$name ;
		if(move_uploaded_file($tmpname,$target_file))
		{
			$insert="INSERT INTO service_image(service_name,service_img,service_cost) 
			VALUES('$service_name','$service_img','$service_cost')";
			$flag+=1;
			mysqli_query($conn,$insert);
		
		}
		
		$flag+=1;
		$len_doc=(int)$service_count;
		for ($i=0; $i < $len_doc; $i++) { 
			$index=strval($i);
			$document_name=strtoupper($_POST[$index]);
			$insert1="INSERT INTO services(service_name,document_name) 
			VALUES('$service_name','$document_name')";

			mysqli_query($conn,$insert1);

			
		}
	}
	if($flag==2)
	{
		header('Location:alert.php?add=yes');
	}
	else
	{
		header('Location:alert.php?add=no');
	}
	
	

}
include 'conn_close.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Service</title>
	<script type="text/javascript">
		var docs_cnt=0;

		function add(cnt)
		{
			docs_cnt=cnt;
			var add_text=document.getElementById("text_boxes");

			for (var i=0;i<cnt;i++) {
				
				var element=document.createElement('input');
				var br=document.createElement('br');
				var br1=document.createElement('br');
				var str="Enter Document Name "+(i+1);
				element.setAttribute("type","text");
				element.setAttribute("name",i);
				element.setAttribute("id",i);
				
				element.setAttribute("placeholder",str);
				add_text.appendChild(element);
				add_text.appendChild(br);
				add_text.appendChild(br1);

			}
			document.getElementById('doc_cnt').value=docs_cnt;

			}
			function field_validation()
			{
				var service_name=document.forms['add_service']['service_name'].value;
				var service_count=document.forms['add_service']['service_count'].value;
				var service_cost=document.forms['add_service']['service_cost'].value;
				var service_img1=document.getElementById('service_img').value;
				var img_name="";
				var i=0;
				var chars=0;
				var fname1=service_name.toLowerCase();
				for(i=0;i<fname1.length;i++)
				{
					var ch=fname1.charAt(i);
					if(ch=='a' || ch=='b' || ch=='c' || ch=='d' || ch=='e' || ch=='f' || ch=='g' || ch=='h'
						 || ch=='i' || ch=='j' || ch=='k' || ch=='l' || ch=='m' || ch=='n' || ch=='o' || ch=='p'
						 || ch=='q' || ch=='r' || ch=='s' || ch=='t' || ch=='u' || ch=='v' || ch=='w' || ch=='x'
						   || ch=='y' || ch=='z' || ch==" ")
					{
						chars=chars+1;
					}
				}
				
				if(!(service_name != "" && chars === service_name.length && service_name.length >= 4))
				{
					alert("\nEnter Valid Service Name");	
					return false;
                    
                }
				var no=0;
				var i=0;
				var phno1=service_cost.toString();
				for(i=0;i<phno1.length;i++)
				{
					var ch=phno1.charAt(i);
					
					if(ch=='0' || ch=='1' || ch=='2' || ch=='3' || ch=='4' || ch=='5' || ch=='6' || ch=='7'
					|| ch=='8' || ch=='9')
					{
						no=no+1;
					}
					
				}
				
				if(!(Number.isInteger(parseInt(service_cost))==true && service_cost!=""))
				{
					alert("\nEnter Valid Cost")
                    return false;
                }
				
				if ((service_img1!=""))
				{
					img_name=service_img1.split('\\').pop();
					document.getElementById("img").value=img_name;

					var FileSize = service_img.files[0].size; // in Bytes
				    if (FileSize > 1000000) {

		                alert("File size must under 1 KB!");
		                return false;
		            }
				}
				else
				{
					alert("\nSelect Document Image")
					return false;
				}
                
                var no=0;
				var i=0;
				var phno1=service_count.toString();
				for(i=0;i<phno1.length;i++)
				{
					var ch=phno1.charAt(i);
					
					if(ch=='0' || ch=='1' || ch=='2' || ch=='3' || ch=='4' || ch=='5' || ch=='6' || ch=='7'
					|| ch=='8' || ch=='9')
					{
						no=no+1;
					}
					
				}
				
				if(!(Number.isInteger(parseInt(service_count))==true && service_count!=""))
				{
					alert("\nEnter Valid Document Count")
                    return false;
                }
				
				

				for(var i=0;i<parseInt(service_count);i++)
				{
					var name=document.getElementById(i).value;

					var i=0;
					var chars=0;
					var fname1=name.toLowerCase();
					for(i=0;i<fname1.length;i++)
					{
						var ch=fname1.charAt(i);
						if(ch=='a' || ch=='b' || ch=='c' || ch=='d' || ch=='e' || ch=='f' || ch=='g' || ch=='h'
							 || ch=='i' || ch=='j' || ch=='k' || ch=='l' || ch=='m' || ch=='n' || ch=='o' || ch=='p'
							 || ch=='q' || ch=='r' || ch=='s' || ch=='t' || ch=='u' || ch=='v' || ch=='w' || ch=='x'
							   || ch=='y' || ch=='z' || ch==" ")
						{
							chars=chars+1;
						}
					}
					
					if(!(name != "" && chars === name.length && name.length >= 4))
					{
						alert("\nEnter Valid Document Name");	
						return false;
	                    
	                }
				
				}
				
				return true;
			}
		
		
	</script>
	<style>
		.dropbtn {
  			padding: 14px;
  			font-size:14px;
  			background-color:#26267d;
  			border: none;
 			color:white;
		}
	</style>
</head>
<body>
<?php
	include 'logo_page.html';
	echo "<br>";
	include 'admin_nav.php';
?>
	<br>
	<div class="container-fluid" style="width:50%; height:85%;">

	<center><h2 style="color:black; text-align:center; font-size:180%; font-weight:bold;">Add Service</h2></center>
	<br><br>
	<form name="add_service" action="add_service.php" method="post" enctype="multipart/form-data" onsubmit="return field_validation()">
		<center>
		<table>
			<tr>
				<td><h3 style="text-align:left; font-family:Helvetica; color:black;">Service Name:</h3><br><br></td>
				<td><br><input type="text" class="form-control" id="service_name" name="service_name"><br><br></td>
			</tr>
			<tr>
				<td><h3 style="text-align:left; font-family:Helvetica; color:black;">Service Cost:</h3><br><br><br></td>
				<td><input type="text" id="service_cost" class="form-control" name="service_cost"><br><br></td>
			</tr>
			<tr>
				<td><h3 style="text-align:left; font-family:Helvetica; color:black;">Service Image:</h3><br><br><br></td>
				<td><input type="file" accept="image/*" id="service_img" name="service_img">
				<input type="hidden" name="img" id="img" value="0">
				<br><br></td>
			</tr>
			<tr>
				<td><h3 style="text-align:left; font-family:Helvetica; color:black;">Documnet Count:</h3><br><br><br><br></td>
				<td><input type="text" class="form-control" name="service_count" id="service_count">
				&nbsp;&nbsp;<br>
				<input type="button" name="count" class="btn btn-default" id="count" value="Add Document" onclick="add(document.forms['add_service']['service_count'].value)"><br><br></td>
			</tr>
			<tr>
				<td></td>
				<td><span id="text_boxes"></span></td>
			</tr>
			
			<tr>
				<td colspan="2"><br><br>
				<center><input type="submit" class="dropbtn" name="add_service" value="Add Service"></center></td>
			</tr>

		</table>
		</center>
		
		
		
	</form>
		</div>
			<br>
		<?php include 'footer.html'; ?>
</body>
</html>