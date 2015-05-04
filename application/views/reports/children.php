<?php $this->load->view('section/navbar'); ?>
<?php print css_asset('datatables/dataTables.bootstrap.css'); ?>

<div style="display:none;" class="modal fade in" id="parentsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            <div  class="table-responsive">
                <table id="report" class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Cell No</th>
                            <th>School</th>
                            <th>Residence</th>
                            <th>Parents</th>
                            <th>Class@School</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($children as $child) { ?>
                            <tr>
                                <td><?php print $child[COL_CHILD_NAME]; ?></td>
                                <td><?php print $child[COL_CHURCH_CLASS]; ?></td>
                                <td><?php print calculateAge($child[COL_DOB]); ?></td>
                                <td><?php print $child[COL_SEX]; ?></td>
                                <td><?php print $child[COL_CELL_NO]; ?></td>
                                <td><?php print $child[COL_SCHOOL]; ?></td>
                                <td><?php print $child[COL_RESIDENCE]; ?></td>
                                <th><?php print anchor(current_url()."#",'parents',array('onClick'=>'showParents('.$child[COL_CHILD_ID].');')); ?></th>
                                <td><?php print $child[COL_SCHOOL_CLASS]; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
        </div>
    </div>


    <?php $this->load->view('section/footer'); ?>
    <script type = "text/Javascript" >
        require.config({
            paths: {
                dataTables: "vendor/jquery/jquery.dataTables",
                bootstrapDataTables: "vendor/jquery/dataTables.bootstrap"
            },
            shim: {
                dataTables: {deps: ["jquery"]},
                bootstrapDataTables: {deps: ["jquery", "dataTables"]}
            }
        });
        require(["dataTables", "bootstrapDataTables"], function(dataTable) {
            $('#report').dataTable({
                "bPaginate": true,
                "bSort": true,
                "bInfo": true,
                "scrollX": true,
                "bFilter": true,
            });
        });
    function showParents(childId){
        $("#parentsModal").load("<?php print site_url('reports/children/getChildHandlers'); ?>" + "/" + childId);
        $('#parentsModal').modal({  'show': true });
    }
    </script>