<?php print css_asset('datatables/dataTables.bootstrap.css'); ?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php print $child_name; ?> Handlers<a class="anchorjs-link" href="#myModalLabel"><span class="anchorjs-icon"></span></a></h4>
        </div>
        <div class="modal-body">
            <div  class="table-responsive">
                <table id="preport" class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Residence</th>
                            <th>Work Place</th>
                            <th>Phone-No</th>
                            <th>Email Address</th>
                            <th>Relation</th>
                            <th>Other Church</th>
                            <th>Cell No.</th>
                            <th>Cell Leader</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($handlers as $handler) { ?>
                            <tr>
                                <td><?php print $handler[COL_HANDLER_NAME]; ?></td>
                                <td><?php print $handler[COL_RESIDENCE]; ?></td>
                                <td><?php print $handler[COL_WORK_PLACE]; ?></td>
                                <td><?php print $handler[COL_PHONENO]; ?></td>
                                <td><?php print $handler[COL_EMAIL]; ?></td>
                                <td><?php print $handler[COL_RELATIONSHIP]; ?></td>
                                 <td><?php print $handler[COL_OTHER_CHURCH]; ?></td>
                                <th><?php print $handler[COL_CELL_NO]; ?></th>
                                <td><?php print $handler[COL_CELL_LEADER_NAME]; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-md btn-success " data-dismiss="modal">Close</button>
        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
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
        $('#preport').dataTable({
            "bPaginate": true,
            "bSort": true,
            "bInfo": true,
            "scrollX": true,
            "bFilter": true,
        });
    });
</script>