<div class="breadLine">
    <ul class="breadcrumb">
        <li><a href="<?php echo BASE_URL . LIST_CATEGORY;?>">List Categories</a> <span class="divider">></span></li>
        <li class="active"><?php echo $title;?></li>
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

                <form action="" method="POST">

                    <div class="row-form">
                        <div class="span3">Category Name:</div>
                        <div class="span9">
                            <input type="text" placeholder="some text value..." name="name" 
                            value="<?php returnData($category['ct_name']); ?>"/>
                            <p id='notifyMessage'><?php returnData($message['name']); ?></p>
                        </div>

                        <div class="clear"></div>
                    </div> 

                    <div class="row-form">
                        <div class="span3">Activate:</div>
                        <div class="span9">
                            <select name="status">
                            <?php 
                                if(empty($category['ct_status'])) {
                                    $category['ct_status'] = ACTIVE_VALUE;
                                } 

                                if($category['ct_status'] == ACTIVE_VALUE) {
                                    echo "<option value = '" . ACTIVE_VALUE . "' selected>Activate</option>";
                                    echo "<option value = '" . DEACTIVE_VALUE . "' >Deactivate</option>";
                                } else {
                                    echo "<option value = '" . ACTIVE_VALUE . "'>Activate</option>";
                                    echo "<option value = '" . DEACTIVE_VALUE . "' selected>Deactivate</option>";
                                }
                            ?>
                            </select>
                            <p id='notifyMessage'><?php returnData($message['status']); ?></p>
                        </div>
                        <div class="clear"></div>
                    </div>


                    <div class="row-form">
                        <button class="btn btn-success" type="submit" name="<?php echo $btnName;?>"><?php echo $title;?></button>
                        <div class="clear"></div>
                    </div>
                    
                </form>

                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="dr"><span></span></div>
</div>