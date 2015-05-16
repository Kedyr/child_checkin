<?php $this->load->view('section/navbar_minus_require'); ?>
<?php print css_asset('datatables/dataTables.bootstrap.css'); ?>
<?php print css_asset('daterangepicker.css'); ?>

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
            <div class="row" >
                <div class="search_reports">
                     <?php echo form_open(site_url('reports/attendance/'.$form_action), array('id' => 'search')); ?>
                    <div class="col-md-3"><input  class="form-control"  readonly='readonly' value="<?php print isset($date_now)?$date_now:''; ?>" type="text" name="reservation" id="reservation" /></div>
                    <div class=" col-md-2"><?php print form_submit('submit', "Search by Date", "style='margin-top:-1px';  id='submi_btn' class='btn btn-md btn-success btn-block'"); ?></div>
                </div>
            </div>
            <div  class="table-responsive">
                <table id="report" class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <?php if ($registered): ?>
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
                                <?php if ($registered): ?>
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
<?php print js_asset("vendor/jquery/jquery.dataTables.js"); ?>
<?php print js_asset("vendor/jquery/dataTables.bootstrap.js"); ?>
<?php print js_asset('plugins/datepicker/date.js'); ?>
<?php print js_asset('plugins/datepicker/daterangepicker.js'); ?>
<script type = "text/Javascript" >
    $('#reservation').daterangepicker({});
    $('#report').dataTable({
        "bPaginate": true,
        "bSort": true,
        "bInfo": true,
        "scrollX": true,
        "bFilter": true,
    });
</script>