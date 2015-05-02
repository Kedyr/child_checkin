<?php $this->load->view('section/navbar_minus_require'); ?>


<div id="bodyContent" class="row">
    <div class="col-md-2">
        <h5 class="currentService">Current Service </h5> <?php print isset($service)?$service:''; ?>
    </div>
    <div class="col-md-8">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12">
                    <h3>Check-In/Out Report</h3>            
                </div>
            </div>
        </div>
        <div id="contentArea">
            <div style="position: relative; height: 80px;">
                <input placeholder="search for children names" type="text" name="children" id="autocomplete-ajax" class="form-control searchForm"  style="position: absolute; z-index: 2; background: transparent;"/>
                <input type="text" name="children" id="autocomplete-ajax-x" disabled="disabled" style="display:none; color: #CCC; position: absolute; background: transparent; z-index: 1;"/>
            </div>
            <h4>Search results</h4>
            <div id="selction-ajax" class="searchResults" >


            </div>

        </div>

    </div>
</div>
<?php $this->load->view('section/footer'); ?>