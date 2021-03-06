<?php print css_asset('datatables/dataTables.bootstrap.css'); ?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php print $child_name; ?> Siblings<a class="anchorjs-link" href="#myModalLabel"><span class="anchorjs-icon"></span></a></h4>
        </div>
        <div class="modal-body">
            <?php print anchor(site_url('account/child_accounts/addSibling/' . $child_id), 'Add siblings', array('class' => 'btn btn-md btn-success ')); ?>
            <?php $this->load->view('reports/children_source', array('children' => $siblings)); ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-md btn-success " data-dismiss="modal">Close</button>
        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script type = "text/Javascript" >
    function showParents(childId) {
        $("#parentsModal").load("<?php print site_url('reports/children/getChildHandlers'); ?>" + "/" + childId);
        $('#parentsModal').modal({'show': true});
        $('#siblingsModal').modal('hide');
    }
</script>