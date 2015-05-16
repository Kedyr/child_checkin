 <div  class="table-responsive">
                <table id="report" class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Cell No</th>
                            <th>School</th>
                            <th>Residence</th>
                            <th>Parents</th>
                            <th>Class@School</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($children as $child) { ?>
                            <tr>
                                <td><?php print anchor(site_url('account/childaccounts/edit/'.$child[COL_CHILD_ID]),(strlen($child[COL_CHILD_NAME]) < 2)? 'no name':$child[COL_CHILD_NAME]); ?></td>
                                <td><?php print $child[COL_CHURCH_CLASS]; ?></td>
                                <td><?php print calculateAge($child[COL_DOB]); ?></td>
                                <td><?php print $child[COL_SEX]; ?></td>
                                <td><?php print $child[COL_CELL_NO]; ?></td>
                                <td><?php print $child[COL_SCHOOL]; ?></td>
                                <td><?php print $child[COL_RESIDENCE]; ?></td>
                                <th><a onClick="showParents(<?php print $child[COL_CHILD_ID]; ?>)" href="#">parents</a></th>
                                <td><?php print $child[COL_SCHOOL_CLASS]; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>