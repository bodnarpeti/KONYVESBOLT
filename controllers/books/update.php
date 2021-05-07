<form action="update.php" method="post">

    <input class="" type="hidden" name="konyvid_" value='<?php echo $_POST["id"] ?>' placeholder="Könyv azonosítója">
    <input class="" type="text" name="konyvCime_" value='<?php echo $_POST["konyvCime"] ?>' placeholder="Könyv címe">
    <input class="" type="text" name="ar_" value='<?php echo $_POST["ar"] ?>' placeholder="Könyv ára">
    <input class="" type="text" name="loginid_" value='<?php echo $_POST["loginid"] ?>' placeholder="Vásárló azonosítója">
    
    <button type="submit">Sor frissítése</button>
</form>

<?php
	require_once "../../db/config.php";
	if(!empty($_POST) && !empty($_POST['konyvid_']) && !empty($_POST['konyvCime_']) && !empty($_POST['ar_']) && !empty($_POST['loginid_'])) {

		$query = oci_parse($conn, "UPDATE KONYV SET konyvCime='" . $_POST['konyvCime_'] . "', ar='" . $_POST['ar_'] . "', loginid='" . $_POST['loginid_'] . "' WHERE konyvid='" . $_POST['konyvid_'] . "'");
		$result = oci_execute($query, OCI_DEFAULT);  
		if($result)  
		{  
			oci_commit($conn);
			echo "Data Updated Successfully !";
		}
		else{
			echo "Error.";
		}
		header("location:../../books.php?update=1");
	}
?>