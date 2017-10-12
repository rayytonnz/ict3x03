<?php if (isset($_SESSION['err'])) { ?>
    <div class="alert alert-danger alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a> 
        <div style="text-align: center;"><?php echo $_SESSION['err']; ?></div>
    </div>

    <?php
    unset($_SESSION['err']);
} elseif (isset($_SESSION['ok'])) {
    ?>
    <div class="alert alert-success alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a> 
        <div style="text-align: center;"><?php echo $_SESSION['ok']; ?></div>
    </div>

    <?php
    unset($_SESSION['ok']);
} elseif (isset($_SESSION['nth'])) {
    ?>
    <div class="alert alert-info alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a> 
        <div style="text-align: center;"><?php echo $_SESSION['nth']; ?></div>
    </div>

    <?php
    unset($_SESSION['nth']);
}
?>