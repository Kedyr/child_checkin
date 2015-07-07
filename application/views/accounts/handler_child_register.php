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
                    <h3>Child Registration <small><?php print anchor(site_url('account/handlers/edit/'.$handler_id), isset($handler_name) ? $handler_name.' children' : ''); ?></small></h3>            
                </div>
            </div>
        </div>
        <div id="contentArea">
            <div class="row">
                <?php if ($action == 'edit'): ?>
                    <div class="col-md-3 pull-right"><?php print anchor(current_url() . "#", 'siblings', array('class' => 'btn btn-md btn-success ', 'onClick' => 'showSiblings(' . $child_id . ');')); ?>
                        <?php print anchor(current_url() . "#", 'parents', array('class' => 'btn btn-md btn-success', 'onClick' => 'showParents(' . $child_id . ');')); ?>
                    <?php endif; ?>
                </div>

                <div class="col-md-7">

                    <span id="feedback"></span>
                    <div id="form_Details">
                        <?php
                        echo form_open(site_url('account/child_accounts/saveChildDetails/'), array('id' => 'create_child'));
                        if (isset($handler_id)): ?>
                            <label>Relationship with Child</label>
                            <?php
                            $relationship = array('Brother' => 'Brother', 'Sister' => 'Sister', 'Uncle' => 'Uncle', 'Mother' => 'Mother', 'Father' => 'Father', 'Neighbour' => 'Neighbour', 'Auntie' => 'Auntie', 'Other' => 'Other');
                            print form_dropdown('relationship', $relationship,null, 'class="form-control"');
                        endif;
                        $this->load->view('accounts/register_source');
                        print form_hidden('handler_id',isset($handler_id)?$handler_id:'');
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




