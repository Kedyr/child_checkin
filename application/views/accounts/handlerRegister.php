<?php $this->load->view('section/navbar'); ?>

<div style="display:none;" class="modal fade in" id="parentsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<div style="display:none;" class="modal fade in" id="siblingsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<div style="display:none;" class="modal fade in" id="childrenModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<div id="bodyContent" class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12">
                    <h3>Parent/Handler Registration<small>
                            <?php if (isset($child_id)): ?>
                                for  <span class="colorHeadings"><?php print anchor(site_url('account/child_accounts/edit/' . $child_id), isset($child_name) ? $child_name : ''); ?> </span>
                            <?php endif; ?>
                        </small></h3>            
                </div>
            </div>
        </div>
        <div id="contentArea">
             <div class="row">
                <?php if ($action == 'edit'): ?>
                    <div class="col-md-5 pull-right">
                        <?php $handler_id = isset($handler_id) ? $handler_id : ''; print anchor(current_url() . "#", 'children', array('class' => 'btn btn-md btn-success ', 'onClick' => 'showChildren(' . $handler_id . ');'));?> 
                        <?php 
                          if(grant_access_to_role($this->config->item('role_admin')))
                              print anchor(current_url() . "#", 'delete', array('class' => 'btn btn-md btn-danger', 'onClick' => 'deleteHandler(' . $handler_id . ');'));
                        ?>
                    </div>
                    <?php endif; ?>
            <div class="col-md-7">
                <span id="feedback"></span>
                <div id="form_Details">
                    <?php echo form_open(site_url('account/handlers/saveHandlerDetails/'), array('id' => 'create_handler')); ?>
                    <label>Name</label>
                    <input class="form-control" required="required" placeholder="Name" value="<?php print isset($handler_data[COL_HANDLER_NAME]) ? $handler_data[COL_HANDLER_NAME] : ''  ?>" id="name" name="name" type="text">
                    <?php if (isset($child_id)): ?>
                        <label>Relationship with Child</label>
                        <?php
                        print form_hidden('child_id', $child_id);
                        $relationship = array('Brother' => 'Brother', 'Sister' => 'Sister', 'Uncle' => 'Uncle', 'Mother' => 'Mother', 'Father' => 'Father', 'Neighbour' => 'Neighbour', 'Auntie' => 'Auntie', 'Other' => 'Other');
                        print form_dropdown('relationship', $relationship, isset($handler_data[COL_RELATIONSHIP]) ? $handler_data[COL_RELATIONSHIP] : '', 'class="form-control"');
                    endif;
                    ?>
                    <label>Phone Contacts</label>
                    <input class="form-control" id="phone"  value="<?php print isset($handler_data[COL_PHONENO]) ? $handler_data[COL_PHONENO] : ''  ?>" placeholder="Phone Contacts" name="phone" type="text">
                    <label>Residence</label>
                    <input class="form-control" id="residence" value="<?php print isset($handler_data[COL_RESIDENCE]) ? $handler_data[COL_RESIDENCE] : ''  ?>"  placeholder="Residence" name="residence" type="text">
                    <label>Place of Work</label>
                    <input class="form-control" id="work"  placeholder="Work place" value="<?php print isset($handler_data[COL_WORK_PLACE]) ? $handler_data[COL_WORK_PLACE] : ''  ?>" name="work" type="text">
                    <label>Email Address</label>
                    <input class="form-control" id="email"  placeholder="Email Address" value="<?php print isset($handler_data[COL_EMAIL]) ? $handler_data[COL_EMAIL] : ''  ?>" name="email" type="email">
                    <label>Cell Number</label>
                    <input class="form-control" id="cellno"  placeholder="cell number" name="cellno" value="<?php print isset($handler_data[COL_CELL_NO]) ? $handler_data[COL_CELL_NO] : ''  ?>" type="text">
                    <label>Cell Leader Name</label>
                    <input class="form-control" id="celllader"  placeholder="cell leader" value="<?php print isset($handler_data[COL_CELL_LEADER_NAME]) ? $handler_data[COL_CELL_LEADER_NAME] : ''  ?>" name="cellleader" type="text">
                    <label>Cell Leader Contact</label>
                    <input class="form-control" id="celllader_contact"  placeholder="cell leader contact" name="celllader_contact"  value="<?php print isset($handler_data[COL_CELL_LEADER_CONTACT]) ? $handler_data[COL_CELL_LEADER_CONTACT] : ''  ?>" type="text">
                    <label>Church Membership</label>
                    <?php print form_dropdown('churchmembership', array('member' => 'Member', 'visiting' => 'Visiting', 'intend' => 'Intends to become member'), isset($handler_data[COL_CHURCH_MEMBERSHIP]) ? $handler_data[COL_CHURCH_MEMBERSHIP] : '', "class='form-control'"); ?> 
                    <label>Other Church</label>
                    <input class="form-control" id="church"  placeholder=""  value="<?php print isset($handler_data[COL_OTHER_CHURCH]) ? $handler_data[COL_OTHER_CHURCH] : ''  ?>"   name="church" type="text">
                    <?php
                    if ($action == 'edit')
                        $label = "save changes";
                    else
                        $label = "Register";
                    print form_hidden('handler_id', isset($handler_id) ? $handler_id : '');
                    print form_hidden('olname', isset($handler_data[COL_HANDLER_NAME]) ? $handler_data[COL_HANDLER_NAME] : '');
                    print form_button('submit', $label, "id='submi_btn' class='btn btn-md btn-success btn-block'");
                    print form_close();
                    ?>
                </div>
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
            if ($('#name').val().length < 2) {
                alert("please input the handler's name");
                $('#name').focus();
                return;
            }
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
    function showChildren(handlerId) {
        $("#childrenModal").load("<?php print site_url('reports/children/getHandlerChildren'); ?>" + "/" + handlerId);
        $('#childrenModal').modal({'show': true});
        $('#parentsModal').modal('hide');
    }
    function showParents(childId) {
        $("#parentsModal").load("<?php print site_url('reports/children/getChildHandlers'); ?>" + "/" + childId);
        $('#parentsModal').modal({'show': true});
        $('#childrenModal').modal('hide');
    }

    function deleteHandler(handlerId){
        if(confirm("Are you sure you want to delete this handler")){
            $.post("<?php print site_url('account/handlers/delete'); ?>",{'handlerId':handlerId},function(response){
                response = JSON.parse(response);
                $('#form_Details').html(response.message);
            });
        }
    }
</script>


