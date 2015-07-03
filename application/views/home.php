<?php $this->load->view('section/navbar_minus_require'); ?>
<?php print css_asset('daterangepicker-bs3.css'); ?>
<div id="bodyContent" class="row">
    <div class="col-md-12">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12">
                    <h3>Summaries</h3>            
                </div>
            </div>
        </div>
        <div id="contentArea">
            <div class="row" >
                <div class="search_reports">
                    <?php echo form_open(site_url('generic/home/index'), array('id' => 'search')); ?>
                    <div class="col-md-3"><input  class="form-control" value="<?php print isset($date_now) ? $date_now : ''; ?>"  readonly='readonly'  type="text" name="reservation" id="reservation" /></div>
                    <div class=" col-md-2"><?php print form_submit('submit', "Search by Date", "style='margin-top:-1px';  id='submi_btn' class='btn btn-md btn-success btn-block'"); ?></div>
                </div>
            </div>
            <table id="report" class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>Checked In</th>
                        <th>Checked-Out</th>
                        <th>Not Checked-Out</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>First Service</td>
                        <td><?php print isset($first_total_in) ? $first_total_in : ''; ?></td>
                        <td><?php print isset($first_total_out) ? $first_total_out : ''; ?></td>
                        <td><?php print $first_total_in - $first_total_out; ?></td>
                    </tr>
                    <tr>
                        <td>Second Service</td>
                        <td><?php print isset($second_total_in) ? $second_total_in : ''; ?></td>
                        <td><?php print isset($second_total_out) ? $second_total_out : ''; ?></td>
                        <td><?php print $second_total_in - $second_total_out; ?></td>
                    </tr>
                    <tr>
                        <td>Third  Service</td>
                        <td><?php print isset($third_total_in) ? $third_total_in : ''; ?></td>
                        <td><?php print isset($third_total_out) ? $third_total_out : ''; ?></td>
                        <td><?php print $third_total_in - $third_total_out; ?></td>
                    </tr>
                    <tr>
                        <td>Day Totals</td>
                        <td><?php print isset($total_in) ? $total_in : ''; ?></td>
                        <td><?php print isset($total_out) ? $total_out : ''; ?></td>
                        <td><?php print $total_in - $total_out; ?></td>
                    </tr>
                </tbody>
            </table>
            <p>
                <b>Note : </b>
                The service times have been defines as: </p>
            <p>
                First service: Start-<?php print $this->config->item('checkin_startime_first_service'); ?> End-<?php print $this->config->item('checkin_endtime_first_service'); ?>
            </p>
            <p>
                Second service: Start-<?php print $this->config->item('checkin_startime_second_service'); ?> End-<?php print $this->config->item('checkin_endtime_second_service'); ?>
            </p>
            <p>
                Third service: Start-<?php print $this->config->item('checkin_startime_third_service'); ?> End-<?php print $this->config->item('checkin_endtime_third_service'); ?>
            </p>
        </div>
    </div>
</div>

<?php $this->load->view('section/footer'); ?>
<?php print js_asset('plugins/daterangepicker/moment.min.js'); ?>
<?php print js_asset('plugins/daterangepicker/daterangepicker.js'); ?>
<script type = "text/Javascript" >
    $('#reservation').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    });
</script>



