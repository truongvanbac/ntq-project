<?php includeScript('jquery-2.1.3.min.js')?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#checkAll").click(function() {
            $(".case").attr('checked', this.checked);
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
                <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable_2">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"/></th>
                            <th width="15%" class="sorting"><a href="#">ID</a></th>
                            <th width="35%" class="sorting"><a href="#">Category Name</a></th>
                            <th width="20%" class="sorting"><a href="#">Activate</a></th>
                            <th width="10%" class="sorting"><a href="#">Time Created</a></th>
                            <th width="10%" class="sorting"><a href="#">Time Updated</a></th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lists as $list) { ?>
                            <tr>
                                <td><input class="case" type="checkbox" name="checkbox"/></td>
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
                    <a href="#" class="btn btn-success">Activate</a>
                    <a href="#" class="btn btn-danger">Delete</a>
                </div><!-- /bulk-action-->
                <div class="dataTables_paginate">
                    <a class="first paginate_button paginate_button_disabled" href="#">First</a>
                    <a class="previous paginate_button paginate_button_disabled" href="#">Previous</a>
                    <span>
                        <a class="paginate_active" href="#">1</a>
                        <a class="paginate_button" href="#">2</a>
                    </span>
                    <a class="next paginate_button" href="#">Next</a>
                    <a class="last paginate_button" href="#">Last</a>
                </div>
                <div class="clear"></div>
            </div>
        </div>

    </div>
    <div class="dr"><span></span></div>

</div>