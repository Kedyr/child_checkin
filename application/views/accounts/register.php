<?php $this->load->view('section/navbar'); ?>

<div style="display:none;" class="modal fade in" id="parentsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<div style="display:none;" class="modal fade in" id="siblingsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<div style="display:none;" class="modal fade in" id="childrenModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<div style="display:none;" class="modal fade in" id="attachHandlerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<div style="display:none;" class="modal fade in" id="attachSIblingsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<div id="bodyContent" class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 ">
                    <h3>Child Registration <small><?php print isset($action_title) ? $action_title : ''; ?></small></h3>            
                </div>
            </div>
        </div>
        <div id="contentArea">
             <span id="feedback"></span>
            <div class="row">
                <?php if ($action == 'edit'): ?>
                    <div class="col-md-5 pull-right">
                        <?php print anchor(current_url() . "#", 'siblings', array('class' => 'btn btn-md btn-success ', 'onClick' => 'showSiblings(' . $child_id . ');')); ?>
                        <?php print anchor(current_url() . "#", 'parents', array('class' => 'btn btn-md btn-success', 'onClick' => 'showParents(' . $child_id . ');')); ?>
                        <?php 
                          if(grant_access_to_role($this->config->item('role_admin')))
                              print anchor(current_url() . "#", 'delete', array('class' => 'btn btn-md btn-danger', 'onClick' => 'deleteChild(' . $child_id . ');'));
                        ?>
                    <?php endif; ?>
                </div>

                <div class="col-md-7">

                   
                    <div id="form_Details">
                        <?php
                        echo form_open(site_url('account/child_accounts/saveChildDetails/'), array('id' => 'create_child'));
                        $this->load->view('accounts/register_source');
                        print form_close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('accounts/register_scripts'); ?>
<?php $this->load->view('section/footer'); ?>




