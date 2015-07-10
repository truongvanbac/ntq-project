<div class="breadLine">

    <ul class="breadcrumb">
        <li><a href="<?php echo BASE_URL . LIST_CATEGORY;?>">List Categories</a></li>
    </ul>

</div>

<div class="workplace">

    <div class="row-fluid">
        <div class="span12 search">
            <form action="<?php echo BASE_URL . SEARCH_CATEGORY;?>" method="GET">
                <input type="text" class="span11" placeholder="Some text for search..." name="search" value="<?php echo $valueSearch;?>"/>
                <button class="btn span1" type="submit" name="btn-search-ct">Search</button>
            </form>
        </div>
    </div>
    <!-- /row-fluid-->

    <div class="row-fluid">

        <div class="span12">
            <div class="head">
                <div class="isw-grid"></div>
                <h1>Categories Management</h1>

                <div class="clear"></div>
            </div>
            <div class="block-fluid table-sorting">
                <a href="<?php echo BASE_URL . ADD_CATEGORY;?>" class="btn btn-add">Add Category</a>
                <center><p id='notifyMessage'>
                    <?php 
                        if(isset($_SESSION['checkBox'])) 
                            echo $_SESSION['checkBox']; 
                        unset($_SESSION['checkBox']);
                    ?>
                </p></center>

                <?php if($count != 0) {?>

                <form action="<?php echo BASE_URL . ACTIVE_CATEGORY?>" method="POST">
                    <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable_2">
                        <thead>
                            <tr>
                                <?php if(empty($_GET['page'])) $_GET['page'] = 1;?>
                                <th><input type="checkbox" id="checkAll"/></th>
                                <th width="15%" class="sorting"><a href="<?php echo BASE_URL . SORT_CATEGORY ?>?field=ct_id&type=<?php echo $order ?>&page=<?php echo $_GET['page'];?>">ID</a></th>
                                <th width="35%" class="sorting"><a href="<?php echo BASE_URL . SORT_CATEGORY ?>?field=ct_name&type=<?php echo $order; ?>&page=<?php echo $_GET['page'];?>">Category Name</a></th>
                                <th width="20%" class="sorting"><a href="<?php echo BASE_URL . SORT_CATEGORY ?>?field=ct_status&type=<?php echo $order; ?>&page=<?php echo $_GET['page'];?>">Activate</a></th>
                                <th width="10%" class="sorting"><a href="<?php echo BASE_URL . SORT_CATEGORY ?>?field=ct_time_created&type=<?php echo $order; ?>&page=<?php echo $_GET['page'];?>">Time Created</a></th>
                                <th width="10%" class="sorting"><a href="<?php echo BASE_URL . SORT_CATEGORY ?>?field=ct_time_update&type=<?php echo $order; ?>&page=<?php echo $_GET['page'];?>">Time Updated</a></th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lists as $list) { ?>
                                <tr>
                                    <td><input class="case" type="checkbox" value="<?php echo $list['ct_id']; ?>" name="checkbox[]"/></td>
                                    <td><?php echo $list['ct_id'] ?></td>
                                    <td><?php echo $list['ct_name'] ?></td>
                                    <td>
                                        <?php
                                            if ($list['ct_status'] == ACTIVE_VALUE) {
                                                echo "<span class='text-success'>Activated</span>";
                                            } else {
                                                echo "<span class='text-error'>Deactive</span>";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            $date1 = date_create($list['ct_time_created']);
                                            echo date_format($date1, "h:i:s d/m/Y");
                                        ?>
                                    </td>


                                    <td>
                                        <?php
                                        $a = $list['ct_time_update'];
                                            if ($a == '') {
                                                echo $a;
                                            } else {
                                                echo date_format(date_create($a), "h:i:s d/m/Y");
                                            }
                                        ?>
                                    </td>

                                    <td><a href="<?php echo BASE_URL . EDIT_CATEGORY . '/' .$list['ct_id']?>" class="btn btn-info">Edit</a></td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                    <div class="bulk-action">
                        <input type="submit" class="btn btn-success" name="btn-ac" value="Activate">
                        <input type="submit" class="btn btn-danger" name="btn-dac" value="Deactive">
                    </div>
                </form>
                <?php } else {
                        echo "<p><center><i>No Category</i></center></p>";
                    }
                ?>

                <div class="dataTables_paginate">
                    <?php echo $page_links;?>
                </div>
                <div class="clear"></div>
            </div>
        </div>

    </div>
    <div class="dr"><span></span></div>

</div>