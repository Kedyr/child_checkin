<?php print css_asset('datatables/dataTables.bootstrap.css'); ?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php print $child_name; ?> Handlers<a class="anchorjs-link" href="#myModalLabel"><span class="anchorjs-icon"></span></a></h4>
        </div>
        <div class="modal-body">
            <?php print anchor(site_url('account/handlers/registerWithChild/'.$child_id),'Add parents/guardians/handlers',array('class'=>'btn btn-md btn-success ')); ?>
             <a class="btn btn-md btn-success"  id="addSearchBtn" onClick="attachHandler(<?php print $child_id; ?>)"  href="#" >Add from existing parents/guardians/handlers</a>
           
            <?php $this->load->view('reports/parents_source',array('handlers'=>$handlers)); ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-md btn-success " data-dismiss="modal">Close</button>
        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script type = "text/Javascript" >
    function showChildren(handlerId) {
        $("#childrenModal").load("<?php print site_url('reports/children/getHandlerChildren'); ?>" + "/" + handlerId);
        $('#childrenModal').modal({'show': true});
        $('#parentsModal').modal('hide');
    }

    function attachHandler(child_id) {
       $("#attachHandlerModal").load("<?php print site_url('account/handlers/attachChild'); ?>" + "/" + child_id);
        $('#attachHandlerModal').modal({'show': true});
        $('#parentsModal').modal('hide');
    }
</script>