<?php $this->load->view('section/navbar_minus_require'); ?>


<div id="bodyContent" class="row">
    <div class="col-md-2">
        <h5 class="currentService">Current Service </h5> <?php print isset($service)?$service:''; ?>
    </div>
    <div class="col-md-8">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12">
                    <h3>Child Check-Out</h3>            
                </div>
            </div>
        </div>
        <div id="contentArea">
            <div style="position: relative; height: 80px;">
                <input placeholder="search card numbers" type="text" name="children" id="autocomplete-ajax" class="form-control searchForm"  style="position: absolute; z-index: 2; background: transparent;"/>
                <input type="text" name="children" id="autocomplete-ajax-x" disabled="disabled" style="display:none; color: #CCC; position: absolute; background: transparent; z-index: 1;"/>
            </div>
            <h4>Search results</h4>
            <div id="selction-ajax" class="searchResults" >


            </div>

        </div>

    </div>
</div>
<?php $this->load->view('section/footer'); ?>
<?php print js_asset('vendor/jquery/jquery.autocomplete.js'); ?>
<script type="text/javascript">
    var cardNumbers = '<?php print isset($cards) ? $cards : ''; ?>';
    cardNumbers = JSON.parse(cardNumbers);
    var checkinIds = Array();
    var cardNumber_count = 0;
    var cardNumberArray = $.map(cardNumbers, function(value, key) {
        checkinIds[key] = cardNumber_count++;
        return {value: value, data: key};
    });


    $('#autocomplete-ajax').autocomplete({
        // serviceUrl: '/autosuggest/service/url',
        lookup: cardNumberArray,
        lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
            var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
            return re.test(suggestion.value);
        },
        onSelect: function(suggestion) {
            //$('#selction-ajax').html('You selected: ' + suggestion.value + ', ' + suggestion.data);
            $.post("<?php print site_url('generic/checkout/getChildFamily') ?>", {'checkinId': suggestion.data}, function(response) {
                $('#selction-ajax').html(response);
                $('#autocomplete-ajax').val("");
            });
        },
        onHint: function(hint) {
            $('#autocomplete-ajax-x').val(hint);
        },
        onInvalidateSelection: function() {
            // $('#selction-ajax').html('You selected: none');
        }
    });
</script>


