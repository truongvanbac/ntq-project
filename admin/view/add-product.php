<div class="breadLine">

    <ul class="breadcrumb">
        <li><a href="<?php echo BASE_URL . '/admin/product'?>">List Products</a> <span class="divider">></span></li>
        <li class="active">Add</li>
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
                        <div class="span9"><input type="text" placeholder="some text value..." name="pd_name"/></div>
                        <div class="clear"></div>
                    </div> 
                    <div class="row-form">
                        <div class="span3">Price:</div>
                        <div class="span9"><input type="text" placeholder="some text value..." name="pd_price"/></div>
                        <div class="clear"></div>
                    </div> 
                    <div class="row-form">
                        <div class="span3">Description:</div>
                        <div class="span9">
                            <textarea name="pd_text" placeholder="Textarea field placeholder..."></textarea>
                        </div>
                        <div class="clear"></div>
                    </div> 
                    <div class="row-form">
                        <div class="span3">Upload Image:</div>
                        <div class="span9"><input type="file" name="fileToUpload"></div>
                        <div class="clear"></div>
                    </div> 
                    <div class="row-form">
                        <div class="span3">Activate:</div>
                        <div class="span9">
                            <select name="select">
                                <option value="1">Activate</option>
                                <option value="0">Deactivate</option>
                            </select>
                        </div>
                        <div class="clear"></div>
                    </div>                          
                    <div class="row-form">
                        <button class="btn btn-success" type="submit" name="btn-add-pd">Create</button>
                        <div class="clear"></div>
                    </div>
                </form>
                <div class="clear"></div>
            </div>
        </div>

    </div>
    <div class="dr"><span></span></div>

</div>