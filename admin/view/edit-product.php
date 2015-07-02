<div class="breadLine">

    <ul class="breadcrumb">
        <li><a href="<?php echo BASE_URL . '/admin/product'?>">List Products</a> <span class="divider">></span></li>
        <li class="active">Edit</li>
    </ul>

</div>

<div class="workplace">

    <div class="row-fluid">

        <div class="span12">
            <div class="head">
                <div class="isw-grid"></div>
                <h1>Products Management</h1>

                <div class="clear"></div>
            </div>
            <div class="block-fluid">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row-form">
                        <div class="span3">Product Name:</div>
                        <div class="span9">
                            <input type="text" placeholder="some text value..." name="edit-name" value="<?php echo $oldPd['pd_name'];?>"/>
                            <p id='notifyMessage'><?php echo $messageName; ?></p>
                        </div>
                        <div class="clear"></div>
                    </div> 
                    <div class="row-form">
                        <div class="span3">Price:</div>
                        <div class="span9">
                            <input type="text" placeholder="some text value..." name="edit-price" value="<?php echo $oldPd['pd_price'];?>" />
                            <p id='notifyMessage'><?php echo $messagePrice?></p>
                        </div>
                        <div class="clear"></div>
                    </div> 
                    <div class="row-form">
                        <div class="span3">Description:</div>
                        <div class="span9">
                            <textarea name="edit-des" placeholder="Textarea field placeholder..." ><?php echo $oldPd['pd_des'];?></textarea>
                            <p id='notifyMessage'><?php echo $messageDes?></p>
                        </div>
                        <div class="clear"></div>
                    </div> 
                    <div class="row-form">
                        <div class="span3">Upload Image:</div>
                        <div class="span9">

                            <?php 
                                for($i = 0; $i < NUM_IMG; $i++) {
                                    if($oldPd["pd_img" . $i] != '') { ?>
                                        <img id="img-show" src="<?php getImage($oldPd["pd_img" . $i])?>" alt="Old Image" width="50" height="50">
                                    <?php }
                                }
                            ?>
                            <br>

                            <?php for($i = 0; $i < NUM_IMG; $i++) { ?>
                                <input type="file" name="fileToUpload[]"><br>
                            <?php }?>
                            <p id='notifyMessage'><?php echo $messageImg?></p>
                        </div>
                        <div class="clear"></div>
                    </div> 
                    <div class="row-form">
                        <div class="span3">Activate:</div>
                        <div class="span9">
                            <select name="select">
                                <?php 
                                    if($oldPd['pd_status'] == '1') {
                                        echo "<option value='1' selected>Activate</option>";
                                        echo "<option value='0'>Deactivate</option>";
                                    } else {
                                        echo "<option value='1'>Activate</option>";
                                        echo "<option value='0' selected>Deactivate</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="clear"></div>
                    </div>                          
                    <div class="row-form">
                        <button class="btn btn-success" type="submit" name="btn-edit-pd">Update</button>
                        <div class="clear"></div>
                    </div>
                </form>
                <div class="clear"></div>
            </div>
        </div>

    </div>
    <div class="dr"><span></span></div>

</div>