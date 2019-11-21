<?php 
$loc = $_GET['q'];

include('include/config.php');
$query  = "SELECT * FROM  tbl_ward WHERE location_id='$loc'";
$result = mysql_query($query);
?>
<select id="form-field-1" name="ward" class="col-xs-10 col-sm-5" required onchange="getWard(this.value)(<?php echo $loc ?>,this.value)">
<option>Select Ward</option>
<?php while ($row=mysql_fetch_array($result)) { ?>
<option value=<?php echo $row['ward_id'];?>><?php echo $row['ward_name'];?></option>
<?php } ?>
</select>