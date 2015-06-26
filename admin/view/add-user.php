<div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="<?php echo BASE_URL . '/admin/user'?>">List Users</a> <span class="divider">></span></li>
            <li class="active">Add</li>
        </ul>

    </div>

    <div class="workplace">

        <div class="row-fluid">

            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>Users Management</h1>

                    <div class="clear"></div>
                </div>
                <div class="block-fluid">
                    <form method="POST" enctype="multipart/form-data">
                    	<div class="row-form">
                            <div class="span3">Username:</div>
                            <div class="span9">
                                <input type="text" placeholder="some text value..." name="username" value="<?php echo $oldName;?>"/>
                                <p id='notifyMessage'><?php echo $messageName; ?></p>
                            </div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Email:</div>
                            <div class="span9">
                                <input type="text" placeholder="some text value..." name="email" value="<?php echo $oldEmail;?>"/>
                                <p id='notifyMessage'><?php echo $messageEmail; ?></p>
                            </div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Password:</div>
                            <div class="span9">
                                <input type="password" placeholder="some text value..." name="pass"/>
                                <p id='notifyMessage'><?php echo $messagePass; ?></p>
                            </div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Upload Avatar:</div>
                            <div class="span9">
                                <input type="file" name="fileToUpload">
                                <p id='notifyMessage'><?php echo $messageImg; ?></p>
                            </div>
                            <div class="clear"></div>
                        </div> 
                        <div class="row-form">
                            <div class="span3">Activate:</div>
                            <div class="span9">
                                <select name="select">
                                    <?php 
                                        if($oldStatus == '1') {
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
                            <button class="btn btn-success" type="submit" name="btn-add-user">Create</button>
							<div class="clear"></div>
                        </div>
                    </form>
                    <div class="clear"></div>
                </div>
            </div>

        </div>
        <div class="dr"><span></span></div>

    </div>