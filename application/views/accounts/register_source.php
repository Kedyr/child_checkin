<label>Name</label>
<input class="form-control" required="required" placeholder="child's name" value="<?php print isset($child_data[COL_CHILD_NAME]) ? $child_data[COL_CHILD_NAME] : ''  ?>" id="name" name="name" type="text">
<label>Date of Birth</label>
<input class="form-control" id="dob"  placeholder="Date of birth" value="<?php print isset($child_data[COL_DOB]) ? $child_data[COL_DOB] : ''  ?>" name="dob" type="text">
<label>Gender</label>
<?php
$sex = isset($child_data[COL_SEX]) ? $child_data[COL_SEX] : '';
$gender = (strpos($sex, 'm') == 0) ? 'm' : 'f';
?>
<?php print form_dropdown('gender', array('m' => 'Male', 'f' => 'Female'), $gender, "class='form-control'"); ?>
<label>Church Class</label>
<input class="form-control" id="cclass"  value="<?php print isset($child_data[COL_CHURCH_CLASS]) ? $child_data[COL_CHURCH_CLASS] : ''  ?>" placeholder="Church Class" name="cclass" type="text">
<label>Residence</label>
<input class="form-control" id="residence"  placeholder="Residence" value="<?php print isset($child_data[COL_RESIDENCE]) ? $child_data[COL_RESIDENCE] : ''  ?>" name="residence" type="text">
<label>School</label>
<input class="form-control" id="school"  placeholder="School" value="<?php print isset($child_data[COL_SCHOOL]) ? $child_data[COL_SCHOOL] : ''  ?>" name="school" type="text">
<label>School Class</label>
<input class="form-control" id="sclass"  placeholder="Class" name="sclass"value="<?php print isset($child_data[COL_SCHOOL_CLASS]) ? $child_data[COL_SCHOOL_CLASS] : ''  ?>"  type="text">
<label>Cell Number</label>
<input class="form-control" id="cellno"  placeholder="cell number" value="<?php print isset($child_data[COL_CELL_NO]) ? $child_data[COL_CELL_NO] : ''  ?>" name="cellno" type="text">
<label>Cell Leader Name</label>
<input class="form-control" id="celllader" value="<?php print isset($child_data[COL_CELL_LEADER_NAME]) ? $child_data[COL_CELL_LEADER_NAME] : ''  ?>"  placeholder="cell leader" name="cellleader" type="text">
<label>Church Membership</label>
<?php $membership = isset($child_data[COL_CHURCH_MEMBERSHIP]) ? $child_data[COL_CHURCH_MEMBERSHIP] : ''; ?>
<?php print form_dropdown('churchmembership', array('member' => 'Member', 'visiting' => 'Visiting', 'intend' => 'Intends to become member'), $membership, "class='form-control'"); ?>
<?php
print form_hidden('action', $action);
print form_hidden('olname', isset($child_data[COL_CHILD_NAME]) ? $child_data[COL_CHILD_NAME] : '');
print form_hidden('child_id', isset($child_data[COL_CHILD_ID]) ? $child_data[COL_CHILD_ID] : '');
if ($action == 'edit')
    $label = "save changes";
else
    $label = "Register";
print form_button('submit', $label, "id='submi_btn' class='btn btn-md btn-success btn-block'");