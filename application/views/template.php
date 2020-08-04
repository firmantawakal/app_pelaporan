<!DOCTYPE html>
<html>
<?php $this->load->view('template_item/head_css.php') ;
$sidebar = '';
if ($this->uri->segment(2)=='print_laporan') {
   $sidebar = 'sidebar-collapse';
}else{
  $sidebar = 'sidebar-fixed';
}
?>

<body class="hold-transition skin-blue-light sidebar-mini fixed <?= $sidebar ?>">
<div class="wrapper">

  

  <?php $this->load->view('template_item/header.php') ?>

  <?php $this->load->view('template_item/sidebar.php') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <?php echo $contents; ?>
    
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer no-print">
    <div class="pull-right hidden-xs">
    </div>
    <strong>Copyright &copy; 2020</strong> Unit Pemberantasan Pungli Provinsi Kepulauan Riau.
  </footer>

</div>
<!-- ./wrapper -->

<?php $this->load->view('template_item/foot_js.php') ?>

</body>
</html>
