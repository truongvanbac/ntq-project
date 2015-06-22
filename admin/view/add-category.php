<div class="breadLine">

    <ul class="breadcrumb">
        <li><a href="<?php echo BASE_URL . '/admin/category'?>">List Categories</a> <span class="divider">></span></li>
        <li class="active">Add</li>
    </ul>

</div>

<div class="workplace">

    <div class="row-fluid">

        <div class="span12">
            <div class="head">
                <div class="isw-grid"></div>
                <h1>Categories Management</h1>

                <div class="clear"></div>
            </div>
            <div class="block-fluid">
                <form action="<?php echo BASE_URL . '/admin/category/add'?>" method="POST">
                    <div class="row-form">
                        <div class="span3">Category Name:</div>
                        <div class="span9"><input type="text" placeholder="some text value..." name="new-category" value="<?php echo $oldName; ?>"/></div>
                       
                        <div class="clear"></div>
                    </div> 
                    <div class="row-form">
                        <div class="span3">Activate:</div>
                        <div class="span9">
                            <select name="select">
                                <?php 
                                    if($oldStatus == '1') {
                                        echo "<option value='1' seleted>Activate</option>";
                                        echo "<option value='0'>Deactivate</option>";
                                    } else {
                                        echo "<option value='1'>Activate</option>";
                                        echo "<option value='0' seleted>Deactivate</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="clear"></div>
                    </div>                          
                    <div class="row-form">
                        <button class="btn btn-success" type="submit" name="btn-add-ct">Create</button>
                        <div class="clear"></div>
                    </div>
                </form>
                <div class="clear"></div>
            </div>
        </div>

    </div>
    <div class="dr"><span></span></div>

</div>