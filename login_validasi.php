<?php
require_once "library/koneksi.php";
require_once "library/library.php";
opendb();

	$usr	= $_POST['usr'];
	$pwrd	= $_POST['pwrd'];
if(isset($_POST['checkUser']))
{
	$userName = secure(trim($_POST['usr']));
	$pwd = secure(trim($_POST['pwrd']));
	$pwd2 = md5($pwd);
	$stmt = $mysqli->prepare("SELECT kd_user, nm_user, password, level FROM tbluser WHERE nm_user=?");
	$stmt->bind_param('s',$userName);
	$stmt->execute();
	$stmt->store_result();
	$row = $stmt->num_rows;



	if($row<1)
	{
	$userName = secure(trim($_POST['usr']));
	$pwd = secure(trim($_POST['pwrd']));
	$stmt = $mysqli->prepare("SELECT nrp FROM tblpersonil WHERE nrp=?");
	$stmt->bind_param('s',$userName);
	$stmt->execute();
	$stmt->store_result();
	$row = $stmt->num_rows;
		if($row<1)
			{
		
			echo "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">";
			echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
			echo "Nama user tidak ada !";
			echo "</div>";
			}
				else
					{
				$stmt->bind_result($nrp);
				$rek = $stmt->fetch();
			
					if ($nrp!==$pwd)
						{
							echo "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">";
					echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
					echo "Password salah ! ";
					echo "</div>";
						}
							else
									{	
				
										session_start();
										$_SESSION['SES_LOGIN'] = $usr;
										$_SESSION['USER_LEVEL'] = 'personil';
				
										echo "<script>document.location.href='page.php?open=personil'</script>";
				//header('location : page.php');
									}
			
				
	}	
	}
	else
	{
			$stmt->bind_result($usr,$name, $pw,$level);
			$rek = $stmt->fetch();
			
			if ($pw!==$pwd2)
			{
				echo "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">";
				echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
				echo "Password salah ! ";
				echo "</div>";
			}
				else
				{	
				
				session_start();
				$_SESSION['SES_LOGIN'] = $usr;
				$_SESSION['USER_LEVEL'] = $level;
				
				echo "<script>document.location.href='page.php?open=home'</script>";
				//header('location : page.php');
				}
			
				
	}	
	
}	
	else
	{
	echo "<script>document.location.href='index.php'</script>";
	}	
?>