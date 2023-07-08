<?php require_once('./config.php'); ?>


<?php
// require_once "inc/header_1.php"; 
?>
<?php $page = isset($_GET['page']) ? $_GET['page'] : 'home'; ?>


<?php
if (!file_exists($page . ".php") && !is_dir($page)) {
  // echo "ssssssssssssssssssssss";
  include '404.html';
} else {
  if (is_dir($page))
    include $page . '/index.php';
  else
    include $page . '.php';
}
?>
<?php if ($_settings->chk_flashdata('success')) : ?>
  <script>
    // alert("added!");
    alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
  </script>
<?php endif; ?>
