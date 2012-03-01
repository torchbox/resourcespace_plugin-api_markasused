<?php
include "../../include/db.php";
include "../../include/authenticate.php"; if (!checkperm("u")) {exit ("Permission denied.");}
include "../../include/general.php";

// commented out variables that either don't seem to work or I'm unsure how to test -tom

if (getval("submit","")!="")
	{
	$markasused_field = getvalescaped("markasused_field","");

	$config=array();
	$config['markasused_field'] = getvalescaped("markasused_field","");

	set_plugin_config("api_markasused",$config);

	redirect("pages/team/team_home.php");
	}
$existingconf = get_plugin_config('api_markasused');
include "../../include/header.php";
?>
<div class="BasicsBox">
  <h2>&nbsp;</h2>
  <h1>Mark as used field Configuration</h1>

<form id="form1" name="form1" method="post" action="">

<?php // echo config_text_field("cropper_default_target_format","Default Target Format",$cropper_default_target_format);?>
<?php echo config_field_select("markasused_field", "Field to save to", $existingconf['markasused_field']);?>

<div class="Question">
<label for="submit"></label>
<input type="submit" name="submit" value="<?php echo $lang["save"]?>">
</div><div class="clearerleft"></div>

</form>
</div>
<?php
include "../../include/footer.php";
