<form action="update.php" method="post">

	<input type="hidden" name="id_" value='<?php echo $_POST["id"] ?>' >
    <input class="" type="text" name="teljesNevVasarlo_" value='<?php echo $_POST["teljesNevVasarlo"] ?>' placeholder="Teljes név">
    <input class="" type="text" name="szuletesiDatum_" value='<?php echo $_POST["szuletesiDatum"] ?>' placeholder="Születési dátum">
    <input class="" type="text" name="lakcim_" value='<?php echo $_POST["lakcim"] ?>' placeholder="Lakcím">
    
    <button type="submit">Sor frissítése</button>
</form>

<?php
	require_once "../../db/config.php";
	if(!empty($_POST) && !empty($_POST['teljesNevVasarlo_']) && !empty($_POST['id_']) && !empty($_POST['szuletesiDatum_']) && !empty($_POST['lakcim_'])) {

		$query = oci_parse($conn, "UPDATE VASARLO SET teljesNevVasarlo='" . $_POST['teljesNevVasarlo_'] . "', szuletesiDatum='" . $_POST['szuletesiDatum_'] . "', lakcim='" . $_POST['lakcim_'] . "' WHERE loginid='" . $_POST['id_'] . "'");
		$result = oci_execute($query, OCI_DEFAULT);  
		if($result)  
		{  
			oci_commit($conn);
			echo "Data Updated Successfully !";
		}
		else{
			echo "Error.";
		}
		header("location:../../vasarlo.php?update=1");
	}
?>