<div  class="table-responsive">
    <table id="preport" class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Residence</th>
                <th>Work Place</th>
                <th>Phone-No</th>
                <th>Email Address</th>
                <th>Children</th>
                <?php if (!isset($relation)): ?>
                    <th>Relation</th>
                <?php endif; ?>
                <th>Other Church</th>
                <th>Cell No.</th>
                <th>Cell Leader</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($handlers as $handler) { ?>
                <tr>
                    <td><?php print anchor(site_url('account/handlers/edit/' . $handler[COL_HANDLER_ID]),(strlen($handler[COL_HANDLER_NAME]) < 2)? 'no name':$handler[COL_HANDLER_NAME]); ?></td>
                    <td><?php print $handler[COL_RESIDENCE]; ?></td>
                    <td><?php print $handler[COL_WORK_PLACE]; ?></td>
                    <td><?php print $handler[COL_PHONENO]; ?></td>
                    <td><?php print $handler[COL_EMAIL]; ?></td>
                    <th><a onClick="showChildren(<?php print $handler[COL_HANDLER_ID]; ?>)" href="#">children</a></th>
                    <?php if (!isset($relation)): ?>
                        <td><?php print isset($handler[COL_RELATIONSHIP])?$handler[COL_RELATIONSHIP]:''; ?></td>
                    <?php endif; ?>
                    <td><?php print $handler[COL_OTHER_CHURCH]; ?></td>
                    <th><?php print $handler[COL_CELL_NO]; ?></th>
                    <td><?php print $handler[COL_CELL_LEADER_NAME]; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>