<?php $this->load->view('section/navbar_minus_require'); ?>
<?php print css_asset('datatables/dataTables.bootstrap.css'); ?>

<div style="display:none;" class="modal fade in" id="parentsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<div style="display:none;" class="modal fade in" id="childrenModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<div id="bodyContent" class="row">
    <div class="col-md-12">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12">
                    <h3>Children Report</h3>            
                </div>
            </div>
        </div>
        <div id="contentArea">
            <?php $this->load->view('reports/children_source', array('children' => $children)); ?>
        </div>
    </div>
</div>


<?php $this->load->view('section/footer'); ?>
<?php print js_asset("vendor/jquery/jquery.dataTables.js"); ?>
<?php print js_asset("vendor/jquery/dataTables.bootstrap.js"); ?>
<script type = "text/Javascript" >
    $('#report').dataTable({
        "bPaginate": true,
        "bSort": true,
        "bInfo": true,
        "scrollX": true,
        "bFilter": true,
    });
    function showParents(childId) {
        $("#parentsModal").load("<?php print site_url('reports/children/getChildHandlers'); ?>" + "/" + childId);
        $('#parentsModal').modal({'show': true});
        $('#childrenModal').modal('hide');
    }
</script>