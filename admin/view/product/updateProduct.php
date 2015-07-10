<div class="breadLine">

    <ul class="breadcrumb">
        <li><a href="<?php echo BASE_URL . LIST_PRODUCT; ?>">List Products</a> <span class="divider">></span></li>
        <li class="active"><?php echo $title;?></li>
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
                            <input type="text" placeholder="some text value..." name="name" value="<?php echo $product['pd_name'];?>"/>
                            <p id='notifyMessage'><?php echo $message['name']; ?></p>
                        </div>
                        <div class="clear"></div>
                    </div> 

                    <div class="row-form">
                        <div class="span3">Price:</div>
                        <div class="span9">
                            <input type="text" placeholder="some text value..." name="price" value="<?php echo $product['pd_price'];?>" />
                            <p id='notifyMessage'><?php echo $message['price']?></p>
                        </div>
                        <div class="clear"></div>
                    </div> 

                    <div class="row-form">
                        <div class="span3">Description:</div>
                        <div class="span9">
                            <textarea name="des" placeholder="Textarea field placeholder..." ><?php echo $product['pd_des'];?></textarea>
                            <p id='notifyMessage'><?php echo $message['des']?></p>
                        </div>
                        <div class="clear"></div>
                    </div> 

                    <div class="row-form">
                        <div class="span3">Upload Image:</div>
                        <div class="span9">

                            <?php 
                                for($i = 0; $i < NUM_IMG; $i++) {
                                    if($product["pd_img" . $i] != '') { ?>
                                        <img id="img-show" src="<?php getImage($product["pd_img" . $i])?>" alt="Old Image" width="50" height="50">
                                    <?php }
                                }

                                echo "<br>";
                            ?>

                            <?php for($i = 0; $i < NUM_IMG; $i++) { ?>
                                <input type="file" name="fileToUpload[]"><br>
                            <?php }?>
                                <p id='notifyMessage'><?php echo $message['img']?></p>
                        </div>
                        <div class="clear"></div>
                    </div> 

                    <div class="row-form">
                        <div class="span3">Activate:</div>
                        <div class="span9">
                            <select name="status">
                            <?php 
                                if($product['pd_status'] == ACTIVE_VALUE) {
                                    echo "<option value = '" . ACTIVE_VALUE . "' selected>Activate</option>";
                                    echo "<option value = '" . DEACTIVE_VALUE . "' >Deactivate</option>";
                                } else {
                                    echo "<option value = '" . ACTIVE_VALUE . "'>Activate</option>";
                                    echo "<option value = '" . DEACTIVE_VALUE . "' selected>Deactivate</option>";
                                }
                            ?>
                            </select>
                            <p id='notifyMessage'><?php echo $message['status']?></p>
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="row-form">
                        <button class="btn btn-success" type="submit" name="<?php echo $btnName?>"><?php echo $title;?></button>
                        <div class="clear"></div>
                    </div>
                </form>
                <div class="clear"></div>
            </div>
        </div>

    </div>
    <div class="dr"><span></span></div>

</div>