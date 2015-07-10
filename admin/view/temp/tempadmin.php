<?php
startHeader();
setTitle($title);
includeStyle('bootstrap.css');
includeStyle('icons.css');
includeStyle('login.css');
includeStyle('stylesheet.css');
includeStyle('stylesheets.css');
includeStyle('pagination.css');
includeScript('jquery-2.1.3.min.js');
includeScript('checkBox.js');
endHeader();
?>

<div class="header">
    <a class="logo" href="<?php echo BASE_URL . LIST_CATEGORY; ?>">
        <img src="<?php echo includeImage('', 'logo.png') ?>" alt="NTQ Solution - Admin Control Panel" title="NTQ Solution - Admin Control Panel"/>
    </a>

</div>

<div class="menu">

    <div class="breadLine">
        <div class="arrow"></div>
        <div class="adminControl active">
            Hi, <?php echo $_SESSION['username']; ?>
        </div>
    </div>

    <div class="admin">
        <div class="image">
            <img src="<?php getImage($oldUser['user_img'])?>" class="img-polaroid"/>
        </div>
        <ul class="control">
            <li><span class="icon-cog"></span> <a href="<?php echo BASE_URL . EDIT_USER . '/' . User::getIdAdmin();?>">Update Profile</a></li>
            <li><span class="icon-share-alt"></span> <a href="<?php echo BASE_URL . LOGOUT; ?>">Logout</a></li>
        </ul>
    </div>

    <ul class="navigation">
        <li>
            <a href="<?php echo BASE_URL . LIST_CATEGORY; ?>">
                <span class="isw-grid"></span><span class="text">Categories</span>
            </a>
        </li>
        <li>
            <a href="<?php echo BASE_URL . LIST_PRODUCT; ?>">
                <span class="isw-list"></span><span class="text">Products</span>
            </a>
        </li>
        <li>
            <a href="<?php echo BASE_URL . LIST_USER; ?>">
                <span class="isw-user"></span><span class="text">Users</span>
            </a>
        </li>
    </ul>

</div>
<div class="content">
    <?php
    echo $content;
    ?>
</div>
<?php
getFooter();
?>