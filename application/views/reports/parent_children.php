<?php print css_asset('datatables/dataTables.bootstrap.css'); ?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php print $handler_name; ?> Children<a class="anchorjs-link" href="#myModalLabel"><span class="anchorjs-icon"></span></a></h4>
        </div>
        <div class="modal-body">
            <?php print anchor(site_url('account/handlers/registerChild/' . $handler_id), 'Add new children', array('class' => 'btn btn-md btn-success ')); ?>
            <a class="btn btn-md btn-success"  id="addSearchBtn" onClick="attachChildHandler(<?php print $handler_id; ?>)"  href="#" >Add from existing children</a>
            <div id="handlerChildren">
                <?php $this->load->view('reports/children_source', array('children' => $children)); ?>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-md btn-success " data-dismiss="modal">Close</button>
        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script type = "text/Javascript" >
    function attachChildHandler(handlerId) {
        $("#attachChildrenModal").load("<?php print site_url('account/child_accounts/attachHandler'); ?>" + "/" + handlerId);
        $('#attachChildrenModal').modal({'show': true});
        $('#childrenModal').modal('hide');
    }

</script>