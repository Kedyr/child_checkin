<?php $this->load->view('section/navbar'); ?>

<div id="bodyContent" class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="page-header">
            <h3 style="text-align: right;">Something went wrong!</h3>
        </div>
        <div id="contentArea">
            <h4><?php print $this->session->flashdata('error_head'); ?></h4>
             <div class='alert alert-error alert-danger'><?php print $this->session->flashdata('error_message'); ?></div>

	     <div style='margin:15px 0px 15px 0px;' ><a onclick='history.back(-1);' class='btn_link' href='#'>Go back to previous page</a></div>
        </div>
    </div>
</div>

<?php $this->load->view('section/footer'); ?>
