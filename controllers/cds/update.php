<form action="update.php" method="post">

    <input class="" type="hidden" name="cdid_" value='<?php echo $_POST["id"] ?>' placeholder="CD azonosítója">
    <input class="" type="text" name="cdCime_" value='<?php echo $_POST["cdCime"] ?>' placeholder="CD címe">
    <input class="" type="text" name="cdAra_" value='<?php echo $_POST["cdAra"] ?>' placeholder="CD ára">
    <input class="" type="text" name="loginid_" value='<?php echo $_POST["loginid"] ?>' placeholder="Vásárló azonosítója">
    
    <button type="submit">Sor frissítése</button>
</form>

<?php
	require_once "../../db/config.php";
	if(!empty($_POST) && !empty($_POST['cdid_']) && !empty($_POST['cdCime_']) && !empty($_POST['cdAra_']) && !empty($_POST['loginid_'])) {

		$query = oci_parse($conn, "UPDATE CD SET cdCime='" . $_POST['cdCime_'] . "', cdAra='" . $_POST['cdAra_'] . "', loginid='" . $_POST['loginid_'] . "' WHERE cdid='" . $_POST['cdid_'] . "'");
		$result = oci_execute($query, OCI_DEFAULT);  
		if($result)  
		{  
			oci_commit($conn);
			echo "Data Updated Successfully !";
		}
		else{
			echo "Error.";
		}
		header("location:../../cds.php?update=1");
	}
?>