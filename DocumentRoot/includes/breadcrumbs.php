<?php
session_start();
$page = $_SESSION['page']
?>
<ol class="breadcrumb mb-3">
<li class="breadcrumb-item"><a href="index.php">PHPify</a></li>
<?php if ($page !== ""): ?>
<li class="breadcrumb-item"><?php echo $page ?></li>
<?php endif;?>
</ol>
</div>