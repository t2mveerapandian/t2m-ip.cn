<script src="assets/js/jquery.2.1.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<?php
	require_once "db.php";
	if(isset($_POST['id']) && $_POST['id']!='')
	{
		$id = mysqli_real_escape_string($con, $_POST['id']);
		$sstate = mysqli_query($con, "select state_id, state_name, country_name from state where country_id='$id' and status='1'");
		echo "<option value=''>--Select State--</option>";
		while($fetch_sstate = mysqli_fetch_assoc($sstate))
		{?>
			<option value="<?php echo $fetch_sstate['state_name']?>"><?php echo $fetch_sstate['state_name']?></option>
        <?php }	
	}
	else
	{
		$sstate = mysqli_query($con, "select state_id, state_name, country_name from state where  status='1'");
		echo "<option value=''>--Select State--</option>";
		while($fetch_sstate = mysqli_fetch_assoc($sstate))
		{?>
			<option value="<?php echo $fetch_sstate['state_name']?>"><?php echo $fetch_sstate['state_name']?></option>
        <?php }	
	}		
?>
