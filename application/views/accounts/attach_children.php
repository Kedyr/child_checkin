<?php print css_asset('datatables/dataTables.bootstrap.css'); ?>

<style type="text/css">
    #childResults{padding-top: 10px;}
    .child_nme{padding-left: 10px;}
</style>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel">Attach already registered children to <?php print $handler_name; ?><a class="anchorjs-link" href="#myModalLabel"><span class="anchorjs-icon"></span></a></h4>
        </div>
        <div class="modal-body">
            <div id="search_children">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <label>Search from amongst the registered children</label>
                        <input class="form-control" type="input" name="search" id="searchName">
                        <label>Select relationship with child</label>
                        <?php
                        $relationship = array('0' => 'Select relationship with child', 'Brother' => 'Brother', 'Sister' => 'Sister', 'Uncle' => 'Uncle', 'Mother' => 'Mother', 'Father' => 'Father', 'Neighbour' => 'Neighbour', 'Auntie' => 'Auntie', 'Other' => 'Other');
                        print form_dropdown('relationship', $relationship, null, 'class="form-control" id="relationship"');
                        ?>
                        <button type="button" onClick="searchChildren(<?php print $handler_id; ?>)" id="searchBtn" class="form-contrdol btn btn-md btn-success ">Search children</button>
                        
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
                            function searchChildren(handlerId) {
                                var search_name = $('#searchName').val();
                                if (search_name.length < 2) {
                                    alert("please input a valid child name");
                                    return;
                                }
                                $('#childResults').html('');
                                $.post("<?php print site_url('account/child_accounts/childSearch'); ?>", {'search': search_name}, function(response) {
                                    response = JSON.parse(response);
                                    if (response.length > 0) {
                                        $('#childResults').append("<h4>Click inside the checkboxes to select child</h4><p><b>Note: To delete relationship, just unclick the checkbox</b></p>");
                                    }
                                    else {
                                        $('#childResults').append("There are no children matching the search values<br/>");
                                    }

                                    for (var c = 0; c < response.length; c++) {
                                        var id = response[c].childId;
                                        var chk_id = "chk_" + id;
                                        $('#childResults').append("<input id='" + chk_id + "' type='checkbox' onClick='addToHandler(" + handlerId + "," + id + ");' /><span class='child_nme'>" + response[c].childName + "</span> <br/>");
                                    }
                                });
                            }

                            function addToHandler(handlerId, childId) {
                                var action = "";
                                var relationship = $('#relationship').val();
                                if (relationship == 0) {
                                    $("#chk_" + childId).removeAttr('checked');
                                    alert("please select a relationship");
                                    return;
                                }
                                if ($("#chk_" + childId).is(':checked'))
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