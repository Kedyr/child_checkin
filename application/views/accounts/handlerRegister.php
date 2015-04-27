<?php $this->load->view('section/navbar'); ?>

<div id="bodyContent" class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12">
                    <h3>Parent/Handler Registration</h3>            
                </div>
            </div>
        </div>
        <div id="contentArea">
            <div class="col-md-7">
                <span id="feedback"></span>
                <div id="form_Details">
                    <?php echo form_open(site_url('generic/register/saveHandlerDetails/'), array('id' => 'create_handler')); ?>
                    <label>Name</label>
                    <input class="form-control" required placeholder="Name" name="name" type="text">
                    <label>Relationship with Child</label>
                    <?php 
                    $relationship = array('Brother'=>'Brother','Sister'=>'Sister','Uncle'=>'Uncle','Mother'=>'Mother','Father'=>'Father','Neighbour'=>'Neighbour','Auntie'=>'Auntie','Other'=>'Other');
                    print form_dropdown('relationship',$relationship,array(),'class="form-control"');
                    ?>
                    <label>Phone Contacts</label>
                    <input class="form-control" id="phone"  placeholder="Phone Contacts" name="phone" type="text">
                    <label>Residence</label>
                    <input class="form-control" id="residence"  placeholder="Residence" name="residence" type="text">
                    <label>Place of Work</label>
                    <input class="form-control" id="work"  placeholder="Work place" name="work" type="text">
                    <?php $child_id = isset($child_id)?$child_id:$child_id;
                     print form_hidden('child_id',$child_id); ?>
                    <label>Email Address</label>
                    <input class="form-control" id="email"  placeholder="Email Address" name="email" type="email">
                 <!--   <label>Cell Number</label>
                    <input class="form-control" id="cellno"  placeholder="cell number" name="cellno" type="text">
                    <label>Cell Leader Name</label>
                    <input class="form-control" id="celllader"  placeholder="cell leader" name="cellleader" type="text">
                    <label>Church Membership</label>
                    <?php print form_dropdown('churchmembership', array('member' => 'Member', 'visiting' => 'Visiting', 'intend' => 'Intends to become member'), array(), "class='form-control'"); ?> -->
                     <label>Other Church</label>
                      <input class="form-control" id="church"  placeholder="" name="church" type="text">
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
            $('#create_handler').ajaxSubmit({
                success: function(response) {
                    Auto_load.drawServerResponse(response, true, 'create_handler');
                    if (response.success)
                        $('#form_Details').html('');
                },
                dataType: 'json'
            });
        });
    });

</script>


