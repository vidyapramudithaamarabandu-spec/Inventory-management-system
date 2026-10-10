<?php
session_start();
session_destroy();
header("Location:LOGIN.php");
exit();
?>
<script>
finction confrimLogout(){
	if(confirm("Are you sure you want to leave?")){
		window.location.href="logout.php";
	}
}
</script>