<?php includeScript('jquery-2.1.3.min.js') ?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#checkAll").click(function() {
            if (this.checked) {
                $('.case').each(function() {
                    this.checked = true;
                });
            } else {
                $('.case').each(function() {
                    this.checked = false;
                });
            }
        });

    });
</script>

<div class="breadLine">

    <ul class="breadcrumb">
        <li><a href="<?php echo BASE_URL . '/admin/user'?>">List Users</a></li>
    </ul>

</div>

<div class="workplace">

    <div class="row-fluid">
        <div class="span12 search">
            <form method="post" action="<?php echo BASE_URL . '/admin/user/getDataSearched'?>">
                <input type="text" class="span11" placeholder="Some text for search..." name="search"/>
                <button class="btn span1" type="submit" name = "btn-search-user">Search</button>
            </form>
        </div>
    </div>
    <!-- /row-fluid-->

    <div class="row-fluid">

        <div class="span12">
            <div class="head">
                <div class="isw-grid"></div>
                <h1>Users Management</h1>

                <div class="clear"></div>
            </div>
            <div class="block-fluid table-sorting">
                <a href="<?php echo BASE_URL . '/admin/user/add'?>" class="btn btn-add">Add User</a>
                 <form action="<?php echo BASE_URL ?>/admin/user/active" method="POST">
                <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable_2">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"/></th>
                            <th width="15%" class="sorting"><a href="<?php echo BASE_URL ?>/admin/user/sort/user_id/<?php echo $order; ?>">ID</a></th>
                            <th width="35%" class="sorting"><a href="<?php echo BASE_URL ?>/admin/user/sort/username/<?php echo $order; ?>">Username</a></th>
                            <th width="20%" class="sorting"><a href="<?php echo BASE_URL ?>/admin/user/sort/status/<?php echo $order; ?>">Activate</a></th>
                            <th width="10%" class="sorting"><a href="<?php echo BASE_URL ?>/admin/user/sort/user_time_created/<?php echo $order; ?>">Time Created</a></th>
                            <th width="10%" class="sorting"><a href="<?php echo BASE_URL ?>/admin/user/sort/user_time_updated/<?php echo $order; ?>">Time Updated</a></th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lists as $list) { ?>
                            <tr>
                                <td><input class="case" type="checkbox" value="<?php echo $list['user_id']; ?>" name="checkbox[]"/></td>
                                <td><?php echo $list['user_id'] ?></td>
                                <td><?php echo $list['username'] ?></td>
                                <td>
                                    <?php
                                    if ($list['status'] == 1) {
                                        echo "<span class='text-success'>Activated</span>";
                                    } else {
                                        echo "<span class='text-error'>Deactive</span>";
                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    $date1 = date_create($list['user_time_created']);
                                    echo date_format($date1, "h:i:s d/m/Y");
                                    ?>
                                </td>


                                <td>
                                    <?php
                                    $a = $list['user_time_updated'];
                                    if ($a == '') {
                                        echo $a;
                                    } else {
                                        echo date_format(date_create($a), "h:i:s d/m/Y");
                                    }
                                    //echo $a;
                                    ?>
                                </td>

                                <td><a href="<?php echo BASE_URL ?>/admin/user/edit/<?php echo $list['user_id'] ?>" class="btn btn-info">Edit</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="bulk-action">
                    <input type="submit" class="btn btn-success" name="btn-ac-user" value="Activate">
                    <input type="submit" class="btn btn-danger" name="btn-dac-user" value="Deactive">
                </div><!-- /bulk-action-->
                 </form>
                <div class="dataTables_paginate">
                    <?php echo $page_links; ?>
                </div>
                <div class="clear"></div>
            </div>
        </div>

    </div>
    <div class="dr"><span></span></div>

</div>