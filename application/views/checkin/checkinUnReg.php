<?php $this->load->view('section/navbar'); ?>

<style>
    .big_form{height:45px; font-size:20px;}
</style>

<div id="bodyContent" class="row">
    <div class="col-md-2">
        <h5 class="currentService">Current Service </h5> <?php print isset($service) ? $service : ''; ?>
    </div>
    <div class="col-md-8">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12">
                    <h3>Un-Registered Child Check-In</h3>            
                </div>
            </div>
        </div>
        <div id="contentArea">
            <?php echo form_open(site_url('generic/checkin/checkinUnreg/'), array('id' => 'check_in')); ?>
            <div id="childrenResults" class="row">
                <div class="col-md-4">
                    <h4 class="result1 childResultstitle">Card Number</h4>
                    <input required="required" type="text" class="form-control big_form" id="cardNum" name="cardNum" /> 
                </div>
                <div class="col-md-4">
                    <h4 class="result2 childResultstitle">No. of Children </h4> 
                    <input required="required" class="form-control big_form" type="number" value="" name="siblings" id="siblings" />
                </div>
                <div class="col-md-4">
                    <h4 class="result3 childResultstitle">Handlers Name</h4>
                    <input class="form-control big_form" type="text" name="handler" id="handler" />
                </div>
            </div>
            <div class="row" style="margin-top:10px">
                <div class="col-md-3"> <button type="button" id="completeCheckin" class="btn btn-lg btn-blac">Assign Card Number</button></div>
                <div class="col-md-4"></div>
            </div>
            </form>
            <div style="margin-top:10px;" id="feedback"></div>
        </div>

    </div>
</div>

<?php $this->load->view('section/footer'); ?>

<script type="text/javascript">
    require(["models/auto_load"], function(Auto_load) {
        $('#completeCheckin').click(function() {
            var card_number = $('#cardNum').val();
            var siblingNumber = $('#siblings').val();
            var handlername = $('#handler').val();
            if (card_number.length < 1) {
                alert("Please fill in the card Number");
                $('#cardNum').focus();
                return;
            }
            if (siblingNumber < 1) {
                alert("Please fill in the children Number count");
                $('#siblings').focus();
                return;
            }
            $('#check_in').ajaxSubmit({
                success: function(response) {
                    Auto_load.drawServerResponse(response, true, 'check_in');
                        $('#feedback').fadeTo(3000, 0.5);
                        $('#feedback').fadeTo("fast", 0);
                        $('#siblings').val(0);
                },
                dataType: 'json'
            });
        });
    });
</script>