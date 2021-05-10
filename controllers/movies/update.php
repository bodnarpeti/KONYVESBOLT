<form action="update.php" method="post">

    <input class="" type="hidden" name="filmid_" value='<?php echo $_POST["id"] ?>' placeholder="Film azonosítója">
    <input class="" type="text" name="filmCime_" value='<?php echo $_POST["filmCime"] ?>' placeholder="Film címe">
    <input class="" type="text" name="filmAra_" value='<?php echo $_POST["filmAra"] ?>' placeholder="Film ára">
    <input class="" type="text" name="loginid_" value='<?php echo $_POST["loginid"] ?>' placeholder="Vásárló azonosítója">
    
    <button type="submit">Sor frissítése</button>
</form>

<?php
	require_once "../../db/config.php";
	if(!empty($_POST) && !empty($_POST['filmid_']) && !empty($_POST['filmCime_']) && !empty($_POST['filmAra_']) && !empty($_POST['loginid_'])) {

		$query = oci_parse($conn, "UPDATE FILM SET filmCime='" . $_POST['filmCime_'] . "', filmAra='" . $_POST['filmAra_'] . "', loginid='" . $_POST['loginid_'] . "' WHERE filmid='" . $_POST['filmid_'] . "'");
		$result = oci_execute($query, OCI_DEFAULT);  
		if($result)  
		{  
			oci_commit($conn);
			echo "Data Updated Successfully !";
		}
		else{
			echo "Error.";
		}
		header("location:../../movies.php?update=1");
	}
?>