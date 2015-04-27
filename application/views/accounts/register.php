<?php $this->load->view('section/navbar'); ?>

<div id="bodyContent" class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12">
                    <h3>Child Registration</h3>            
                </div>
            </div>
        </div>
        <div id="contentArea">
            <div class="col-md-7">
                <span id="feedback"></span>
                <div id="form_Details">
                    <?php echo form_open(site_url('generic/register/childRegister/'), array('id' => 'create_child')); ?>
                    <label>Name</label>
                    <input class="form-control" required placeholder="child's name" name="name" type="text">
                    <label>Date of Birth</label>
                    <input class="form-control" id="dob"  placeholder="Date of birth" name="dob" type="text">
                    <label>Gender</label>
                    <?php print form_dropdown('gender', array('m' => 'Male', 'f' => 'Female'), array(), "class='form-control'"); ?>
                    <label>Church Class</label>
                    <input class="form-control" id="cclass"  placeholder="Church Class" name="cclass" type="text">
                    <label>Residence</label>
                    <input class="form-control" id="residence"  placeholder="Residence" name="residence" type="text">
                    <label>School</label>
                    <input class="form-control" id="school"  placeholder="School" name="school" type="text">
                    <label>School Class</label>
                    <input class="form-control" id="sclass"  placeholder="Class" name="sclass" type="text">
                    <label>Cell Number</label>
                    <input class="form-control" id="cellno"  placeholder="cell number" name="cellno" type="text">
                    <label>Cell Leader Name</label>
                    <input class="form-control" id="celllader"  placeholder="cell leader" name="cellleader" type="text">
                    <label>Church Membership</label>
                    <?php print form_dropdown('churchmembership', array('member' => 'Member', 'visiting' => 'Visiting', 'intend' => 'Intends to become member'), array(), "class='form-control'"); ?>

                    <?php print form_button('submit', 'Register', "id='submi_btn' class='btn btn-md btn-success btn-block'"); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php print js_asset('plugins/input-mask/jquery.inputmask.js'); ?>
<?php print js_asset('plugins/input-mask/jquery.inputmask.date.extensions.js'); ?>
<?php $this->load->view('section/footer'); ?>

<script type="text/javascript">
    $("#dob").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});  //Datemask dd/mm/yyyy
    require(["models/auto_load"], function(Auto_load) {
        $('#submi_btn').click(function() {
            $('#create_child').ajaxSubmit({
                success: function(response) {
                    Auto_load.drawServerResponse(response, true, 'create_child');
                    if (response.success)
                        $('#form_Details').html('');
                },
                dataType: 'json'
            });
        });
    });

</script>


