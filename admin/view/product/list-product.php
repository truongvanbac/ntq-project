<div class="breadLine">

    <ul class="breadcrumb">
        <li><a href="<?php echo BASE_URL . LIST_PRODUCT; ?>">List Products</a></li>
    </ul>

</div>

<div class="workplace">

    <div class="row-fluid">
        <div class="span12 search">
            <form action="<?php echo BASE_URL . SHOW_PRODUCT; ?>" method="GET">
                <input type="text" class="span11" placeholder="Some text for search..." name="search" value="<?php echo $valueSearch;?>"/>
                <button class="btn span1" type="submit" name = "btn-search-pd" value="Search">Search</button>
            </form>
        </div>
    </div>
    <!-- /row-fluid-->

    <div class="row-fluid">

        <div class="span12">
            <div class="head">
                <div class="isw-grid"></div>
                <h1>Products Management</h1>

                <div class="clear"></div>
            </div>
            <div class="block-fluid table-sorting">
                <a href="<?php echo BASE_URL . ADD_PRODUCT; ?>" class="btn btn-add">Add Product</a>

                <center><p id='notifyMessage'>
                    <?php 
                        if(isset($_SESSION['checkBox'])) 
                            echo $_SESSION['checkBox']; 
                        unset($_SESSION['checkBox']);
                    ?>
                </p></center>

                <?php if($count != 0) {?>

                <form action="<?php echo BASE_URL . ACTIVE_PRODUCT; ?>" method="POST">
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
                            <th width="10%" class="sorting"><a href="<?php pathShow(SHOW_PRODUCT, 'pd_id', $order, $_GET['page'], $_GET['search']); ?>">ID</a></th>
                            <th width="30%" class="sorting"><a href="<?php pathShow(SHOW_PRODUCT, 'pd_name', $order, $_GET['page'], $_GET['search']); ?>">Product Name</a></th>
                            <th width="15%" class="sorting"><a href="<?php pathShow(SHOW_PRODUCT, 'pd_price', $order, $_GET['page'], $_GET['search']); ?>">Price</a></th>
                            <th width="15%" class="sorting"><a href="<?php pathShow(SHOW_PRODUCT, 'pd_status', $order, $_GET['page'], $_GET['search']); ?>">Activate</a></th>
                            <th width="10%" class="sorting"><a href="<?php pathShow(SHOW_PRODUCT, 'pd_time_created', $order, $_GET['page'], $_GET['search']); ?>">Time Created</a></th>
                            <th width="10%" class="sorting"><a href="<?php pathShow(SHOW_PRODUCT, 'pd_time_updated', $order, $_GET['page'], $_GET['search']); ?>">Time Updated</a></th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lists as $list) { ?>
                            <tr>
                                <td><input class="case" type="checkbox" value="<?php echo $list['pd_id']; ?>" name="checkbox[]"/></td>
                                <td><a href="<?php echo BASE_URL . EDIT_PRODUCT . '/' . $list['pd_id']; ?>"><?php echo $list['pd_id'] ?></a></td>
                                <td><?php echo $list['pd_name'] ?></td>
                                <td><?php echo moneyFormat($list['pd_price'])?> VND</td>
                                <td>
                                    <?php
                                    if ($list['pd_status'] == ACTIVE_VALUE) {
                                        echo "<span class='text-success'>Activated</span>";
                                    } else {
                                        echo "<span class='text-error'>Deactive</span>";
                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php
                                        $date1 = date_create($list['pd_time_created']);
                                        echo date_format($date1, "h:i:s d/m/Y");
                                    ?>
                                </td>


                                <td>
                                    <?php
                                        $a = $list['pd_time_updated'];
                                        if ($a == '') {
                                            echo $a;
                                        } else {
                                            echo date_format(date_create($a), "h:i:s d/m/Y");
                                        }
                                    ?>
                                </td>

                                <td><a href="<?php echo BASE_URL . EDIT_PRODUCT . '/' . $list['pd_id']; ?>" class="btn btn-info">Edit</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="bulk-action">
                    <input type="submit" class="btn btn-success" name="btn-ac" value="Activate">
                    <input type="submit" class="btn btn-danger" name="btn-dac" value="Deactive">
                </div>
                <form>

                <?php } else {
                        echo "<p><center><i>No Product</i></center></p>";
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