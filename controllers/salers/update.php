<form action="update.php" method="post">

    <input class="" type="hidden" name='eladoid_' value='<?php echo $_POST["id"] ?>' placeholder="Eladó azonosítója">
    <input class="" type="text" name='teljesNevElado_' value='<?php echo $_POST["teljesNevElado"] ?>' placeholder="Eladó teljes neve">
    
    <button type="submit">Sor frissítése</button>
</form>

<?php
	require_once "../../db/config.php";
	if(!empty($_POST) && !empty($_POST['eladoid_']) && !empty($_POST['teljesNevElado_'])) {

		$query = oci_parse($conn, "UPDATE ELADO SET teljesNevElado='" . $_POST['teljesNevElado_'] . "' WHERE eladoid='" . $_POST['eladoid_'] . "'");
		$result = oci_execute($query, OCI_DEFAULT);  
		if($result)  
		{  
			oci_commit($conn);
			echo "Data Updated Successfully !";
		}
		else{
			echo "Error.";
		}
		header("location:../../salers.php?update=1");
	}
?>