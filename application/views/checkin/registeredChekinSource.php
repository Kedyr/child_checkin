<div id="childrenResults" class="row">
    <div class="col-md-3">
        <h4 class="result1 childResultstitle"><?php print isset($searchName) ? $searchName : ''; ?></h4>
        <table class="table ">
            <tbody>
                <tr> <td>Gender</td><td><?php print isset($searchGender) ? $searchGender : ''; ?></td> </tr>
                <tr> <td>Age</td><td><?php print isset($searchAge) ? $searchAge : ''; ?></td></tr>
                <tr class="checkDo" ><td >Check-in</td> <td><?php print isset($status) ? $status : ''; ?></td>
                </tr>
            </tbody>
        </table> 
    </div>
    <div class="col-md-5">
        <h4 class="result2 childResultstitle">Siblings </h4>
        <?php foreach ($siblings as $sibling) {
            $sibling_id = isset($sibling[COL_CHILD_ID]) ? $sibling[COL_CHILD_ID] : '';
            ?>
            <table class="table ">
                <tbody>
                    <tr> <td><span class="childName"><?php print isset($sibling[COL_CHILD_NAME]) ? $sibling[COL_CHILD_NAME] : ''; ?> </span></td> </tr>
                    <tr> <td>Gender</td><td><?php print isset($sibling[COL_SEX]) ? $sibling[COL_SEX] : ''; ?></td> </tr>
                    <tr> <td>Age</td><td><?php print isset($sibling[COL_DOB]) ? calculateAge($sibling[COL_DOB]) . ' years' : ''; ?></td></tr>
                    <tr class="checkDo" onClick="checkInOut(<?php print $checkin_id; ?>, 'c_<?php print $sibling_id; ?>');"><td>Check-In</td> <td><input id="c_<?php print $sibling_id; ?>" type="checkbox" /></td>
                    </tr>
                </tbody>
            </table>  
<?php } ?>
        Number of Siblings  <input type="text" value="0" name="siblings" id="siblings" />
    </div>
    <div class="col-md-4">
        <h4 class="result3 childResultstitle">Parents/Handlers</h4>
        <?php foreach ($handlers as $parent) {
            $handler_id = isset($parent[COL_HANDLER_ID]) ? $parent[COL_HANDLER_ID] : '';
            ?>
            <table class="table ">
                <tbody>
                    <tr> <td><span class="childName"><?php print isset($parent[COL_HANDLER_NAME]) ? $parent[COL_HANDLER_NAME] : ''; ?></span></td> </tr>
                    <tr> <td>Gender</td><td><?php print isset($parent[COL_SEX]) ? $parent[COL_SEX] : ''; ?></td> </tr>
                    <tr> <td>Relationship</td><td><?php print isset($parent[COL_RELATIONSHIP]) ? $parent[COL_RELATIONSHIP] : ''; ?></td></tr>
                    <tr class="checkDo" onClick="checkInOutHandler(<?php print $checkin_id; ?>, 'h_<?php print $handler_id; ?>');" > <td> Check-In </td> <td><input id="h_<?php print $handler_id; ?>"  type="checkbox" /></td>
                    </tr>
                </tbody>
            </table> 
<?php } ?>
        Name: <input type="text" name="handler" id="handler" />
    </div>
</div>
<div class="row" style="margin-top:10px">
    <div class="col-md-2"> <h4> Card-Number </h4></div>
    <div class="col-md-3"> <input type="text" style="height:45px; font-size:20px" class="form-control" id="cardNum" name="cardNum" /> </div>
    <div class="col-md-3"> <button type="button" id="completeCheckin" class="btn btn-lg btn-blac">Assign Card Number</button></div>
    <div class="col-md-4"></div>
</div>
<div class="row">
    <div id="feedback" class="col-md-12"></div>
</div>

<script type="text/javascript">
var checkin_id = '<?php print isset($checkin_id) ? $checkin_id : ''; ?>';
$('#completeCheckin').click(function() {
    var card_number = $('#cardNum').val();
    var siblingNumber = $('#siblings').val();
    var handlername = $('#handler').val();
    if (card_number.length < 1) {
        alert("Please fill in the card Number")
        return;
    }
    $.post('<?php print site_url('generic/checkin/completeCheckin'); ?>', {'handler': handlername, 'checkin_id': checkin_id, 'cardNo': card_number, 'siblingNo': siblingNumber}, function(response) {
        var responsMsg = JSON.parse(response);
        if (responsMsg.success)
            $('#selction-ajax').html(responsMsg.message);
        else
            $('#feedback').html(responsMsg.message);
    });
});

function checkInOut(checkinId, id) {
    if (document.getElementById(id).checked)
        document.getElementById(id).checked = false;
    else {
        document.getElementById(id).checked = true;
        $.post('<?php print site_url('generic/checkin/checkinSibling') ?>', {'checkin_id': checkinId, 'childId': id}, function(response) {
        });
    }
}

function checkInOutHandler(checkinId, id) {
    if (document.getElementById(id).checked)
        document.getElementById(id).checked = false;
    else {
        document.getElementById(id).checked = true;
        $.post('<?php print site_url('generic/checkin/checkinHandler') ?>', {'checkin_id': checkinId, 'handlerId': id}, function(response) {
        });
    }
}
</script>