<?php print css_asset('datatables/dataTables.bootstrap.css'); ?>

<style type="text/css">
    #childResults{padding-top: 10px;}
    .child_nme{padding-left: 10px;}
</style>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel">Attach already registered handlers to <?php print $child_name; ?><a class="anchorjs-link" href="#myModalLabel"><span class="anchorjs-icon"></span></a></h4>
        </div>
        <div class="modal-body">
            <div id="search_children">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <label>Search from amongst the registered handlers</label>
                        <input class="form-control" type="input" name="search" id="searchName">
                        <label>Select relationship with handler</label>
                        <?php
                        $relationship = array('0' => 'Select relationship with handler', 'Brother' => 'Brother', 'Sister' => 'Sister', 'Uncle' => 'Uncle', 'Mother' => 'Mother', 'Father' => 'Father', 'Neighbour' => 'Neighbour', 'Auntie' => 'Auntie', 'Other' => 'Other');
                        print form_dropdown('relationship', $relationship, null, 'class="form-control" id="relationship"');
                        ?>
                        <button type="button" onClick="searchHandlers(<?php print $child_id; ?>)" id="searchBtn" class="form-contrdol btn btn-md btn-success ">Search handlers</button>
                        
                        <div id="childResults"> </div>
                        <div id="feedback"></div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-md btn-success " data-dismiss="modal">Close</button>
        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script type = "text/Javascript" >
                            function searchHandlers(child_id) {
                                var search_name = $('#searchName').val();
                                if (search_name.length < 2) {
                                    alert("please input a valid handler's name");
                                    return;
                                }
                                $('#childResults').html('');
                                $.post("<?php print site_url('account/handlers/handlerSearch'); ?>", {'search': search_name}, function(response) {
                                    response = JSON.parse(response);
                                    if (response.length > 0) {
                                        $('#childResults').append("<h4>Click inside the checkboxes to select handler</h4><p><b>Note: To delete relationship, just unclick the checkbox</b></p>");
                                    }
                                    else {
                                        $('#childResults').append("There are no handlers matching the search values<br/>");
                                    }

                                    for (var c = 0; c < response.length; c++) {
                                        var id = response[c].handlerId;
                                        var chk_id = "chk_" + id;
                                        $('#childResults').append("<input id='" + chk_id + "' type='checkbox' onClick='addToChild(" + id + "," + child_id + ");' /><span class='child_nme'>" + response[c].handlerName + "</span> <br/>");
                                    }
                                });
                            }

                            function addToChild(handlerId, childId) {
                                var action = "";
                                var relationship = $('#relationship').val();
                                if (relationship == 0) {
                                    $("#chk_" + handlerId).removeAttr('checked');
                                    alert("please select a relationship");
                                    return;
                                }
                                if ($("#chk_" + handlerId).is(':checked'))
                                    action = "create";
                                else
                                    action = "delete";

                                $.post("<?php print site_url('account/child_accounts/togglerChildHandlerRelationship'); ?>", {"relationship": relationship, "handler_id": handlerId, "child_id": childId, "action": action}, function(response) {
                                    response = JSON.parse(response);
                                    if (response.success)
                                        $('#feedback').html("<span class='alert-success'>" + response.message + "</span>");
                                    else
                                        $('#feedback').html("<span class='alert alert-error error'>" + response.message + "</span>");
                                }
                                );
                            }

</script>