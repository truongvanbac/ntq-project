<?php includeScript('jquery-2.1.3.min.js') ?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#checkAll").click(function() {
            if (this.checked) {
                $('.case').each(function() {
                    this.checked = true;
                    //alert('.case').val();
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
        <li><a href="list-categories.html">List Categories</a></li>
    </ul>

</div>

<div class="workplace">

    <div class="row-fluid">
        <div class="span12 search">
            <form>
                <input type="text" class="span11" placeholder="Some text for search..." name="search"/>
                <button class="btn span1" type="submit">Search</button>
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
                <a href="category/add" class="btn btn-add">Add Category</a>
                <form action="<?php echo BASE_URL ?>/admin/category/active" method="POST">
                    <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable_2">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll"/></th>
                                <th width="15%" class="sorting"><a href="<?php echo BASE_URL ?>/admin/category/sort/ct_id/<?php echo $order; ?>">ID</a></th>
                                <th width="35%" class="sorting"><a href="<?php echo BASE_URL ?>/admin/category/sort/ct_name/<?php echo $order; ?>">Category Name</a></th>
                                <th width="20%" class="sorting"><a href="<?php echo BASE_URL ?>/admin/category/sort/ct_status/<?php echo $order; ?>">Activate</a></th>
                                <th width="10%" class="sorting"><a href="<?php echo BASE_URL ?>/admin/category/sort/ct_time_created/<?php echo $order; ?>">Time Created</a></th>
                                <th width="10%" class="sorting"><a href="<?php echo BASE_URL ?>/admin/category/sort/ct_time_update/<?php echo $order; ?>">Time Updated</a></th>
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
                                        if ($list['ct_status'] == 1) {
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
                                        //echo $a;
                                        ?>
                                    </td>

                                    <td><a href="<?php echo BASE_URL ?>/admin/category/edit/<?php echo $list['ct_id'] ?>" class="btn btn-info">Edit</a></td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                    <div class="bulk-action">
                        <input type="submit" class="btn btn-success" name="btn-ac-ct" value="Activate">
                        <input type="submit" class="btn btn-danger" name="btn-dac-ct" value="Deactive">
                    </div><!-- /bulk-action-->
                </form>


                <div class="dataTables_paginate">
                    <?php echo $page_links;?>
                </div>
                <div class="clear"></div>
            </div>
        </div>

    </div>
    <div class="dr"><span></span></div>

</div>