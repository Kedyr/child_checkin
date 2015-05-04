<?php $this->load->view('section/navbar'); ?>
<?php print css_asset('datatables/dataTables.bootstrap.css'); ?>


<div id="bodyContent" class="row">
    <div class="col-md-1">
        
    </div>
    <div class="col-md-10">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12">
                    <h3><?php print $attendace_type; ?> Check-In/Out Report</h3>            
                </div>
            </div>
        </div>
        <div id="contentArea">
            <div  class="table-responsive">
                <table id="report" class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <?php if($registered): ?>
                            <th>Name</th>
                            <th>Class</th>
                            <?php endif; ?>
                            <th>Card-No</th>
                            <th>Sibling Count</th>
                            <th>Handler</th>
                            <th>Time-In</th>
                            <th>Time-Out</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($children as $child) { ?>
                            <tr>
                                 <?php if($registered): ?>
                                <td><?php print $child[COL_CHILD_NAME]; ?></td>
                                <td><?php print $child[COL_CHURCH_CLASS]; ?></td>
                                 <?php endif; ?>
                                <td><?php print $child[COL_CHECK_IN_NUMBER]; ?></td>
                                <td><?php print $child[COL_SIBLING_COUNT]; ?></td>
                                <td><?php print $child[COL_HANDLER_NAME]; ?></td>
                                <td><?php print $child[COL_TIME_IN]; ?></td>
                                <td><?php print $child[COL_TIME_OUT]; ?></td>
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
    </script>