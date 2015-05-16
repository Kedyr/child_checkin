<?php print js_asset('plugins/input-mask/jquery.inputmask.js'); ?>
<?php print js_asset('plugins/input-mask/jquery.inputmask.date.extensions.js'); ?>
<script type="text/javascript">
    $("#dob").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});  //Datemask dd/mm/yyyy
    require(["models/auto_load"], function(Auto_load) {
        $('#submi_btn').click(function() {
            if($('#name').val().length < 2){
                alert("please input the child's name");
                $('#name').focus();
                return;
            }
            $('#create_child').ajaxSubmit({
                success: function(response) {
                    Auto_load.drawServerResponse(response, true, 'create_child');
                    if (response.success)
                        $('#form_Details').html('');
                },
                dataType: 'json'
            });
        });
    });
    function showParents(childId) {
        $("#parentsModal").load("<?php print site_url('reports/children/getChildHandlers'); ?>" + "/" + childId);
        $('#parentsModal').modal({'show': true});
        $('#childrenModal').modal('hide');
    }
    function showSiblings(childId) {
        $("#siblingsModal").load("<?php print site_url('reports/children/getChildSiblings'); ?>" + "/" + childId);
        $('#siblingsModal').modal({'show': true});
    }
</script>