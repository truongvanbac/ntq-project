<div class="breadLine">

    <ul class="breadcrumb">
        <li><a href="<?php echo BASE_URL . LIST_USER?>">List Users</a></li>
    </ul>

</div>

<div class="workplace">

    <div class="row-fluid">
        <div class="span12 search">
            <form method="GET" action="<?php echo BASE_URL . SHOW_USER; ?>">
                <input type="text" class="span11" placeholder="Some text for search..." name="search" value="<?php echo $valueSearch;?>"/>
                <button class="btn span1" type="submit" name = "btn-search-user" value="Search">Search</button>
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
                <a href="<?php echo BASE_URL . ADD_USER; ?>" class="btn btn-add">Add User</a>
                
                <center><p id='notifyMessage'>
                    <?php 
                        if(isset($_SESSION['checkBox'])) 
                            echo $_SESSION['checkBox']; 
                        unset($_SESSION['checkBox']);
                    ?>
                </p></center>

                <?php if($count != 0) {?>

                 <form action="<?php echo BASE_URL . ACTIVE_USER ?>" method="POST">
                <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable_2">
                    <thead>
                        <tr>
                            <?php 
                                if(empty($_GET['page'])) 
                                    $_GET['page'] = 1;
                                if(empty($_GET['search']))
                                    $_GET['search'] = '';
                            ?>
                            <th><input type="checkbox" id="checkAll"/></th>
                            <th width="15%" class="sorting"><a href="<?php pathShow(SHOW_USER, 'user_id', $order, $_GET['page'], $_GET['search']); ?>">ID</a></th>
                            <th width="35%" class="sorting"><a href="<?php pathShow(SHOW_USER, 'username', $order, $_GET['page'], $_GET['search']); ?>">Username</a></th>
                            <th width="20%" class="sorting"><a href="<?php pathShow(SHOW_USER, 'status', $order, $_GET['page'], $_GET['search']); ?>">Activate</a></th>
                            <th width="10%" class="sorting"><a href="<?php pathShow(SHOW_USER, 'user_time_created', $order, $_GET['page'], $_GET['search']); ?>">Time Created</a></th>
                            <th width="10%" class="sorting"><a href="<?php pathShow(SHOW_USER, 'user_time_updated', $order,  $_GET['page'], $_GET['search']); ?>">Time Updated</a></th>
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
                                        if ($list['status'] == ACTIVE_VALUE) {
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
                                    ?>
                                </td>

                                <td><a href="<?php echo BASE_URL . EDIT_USER . '/' . $list['user_id']; ?>" class="btn btn-info">Edit</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="bulk-action">
                    <input type="submit" class="btn btn-success" name="btn-ac" value="Activate">
                    <input type="submit" class="btn btn-danger" name="btn-dac" value="Deactive">
                </div><!-- /bulk-action-->
                 </form>

                 <?php } else {
                        echo "<p><center><i>No User</p></center></i>";
                    }
                 ?>
                <div class="dataTables_paginate">
                    <?php echo $page_links; ?>
                </div>
                <div class="clear"></div>
            </div>
        </div>

    </div>
    <div class="dr"><span></span></div>

</div>