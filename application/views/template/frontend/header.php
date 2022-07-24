<!DOCTYPE html>
<html lang="en" dir="">

<head>

	<!-- Required Meta Tags Always Come First -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<!-- Meta Website -->
	<meta name="description" content="<?= $web_desc; ?>">
	<meta property="og:title"
		content="<?= ($this->uri->segment(1) ? ucwords(str_replace('-', ' ', $this->uri->segment(1)) . ' ' . ($this->uri->segment(2) ? str_replace('-', ' ', $this->uri->segment(2)) : "") . $web_title) : $web_title); ?>">
	<meta property="og:description" content="<?= $web_desc; ?>">
	<meta property="og:image" content="<?= base_url(); ?>assets/images/<?= $web_icon?>">
	<meta property="og:url" content="<?= base_url(uri_string()) ?>">

	<title>
		<?= ($this->uri->segment(1) ? ucwords(str_replace('-', ' ', $this->uri->segment(1)) . ' ' . ($this->uri->segment(2) ? str_replace('-', ' ', $this->uri->segment(2)) : "") . " - ".$web_title) : $web_title); ?>
	</title>

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?= base_url(); ?>assets/images/<?= $web_icon;?>">

	<!-- General CSS Files -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
		integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<!-- CSS Libraries -->

	<!-- Template CSS -->
	<link rel="stylesheet" href="<?= base_url();?>assets/css/style.css">
	<link rel="stylesheet" href="<?= base_url();?>assets/css/components.css">

	<!-- stylesheet -->
	<link href="<?= base_url();?>assets/plugins/dropify/css/dropify.min.css" rel="stylesheet">
	<!-- DataTables -->
	<link href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/datatables.min.css" rel="stylesheet" type="text/css" />

	<!-- plugin form -->
	<link rel="stylesheet" href="<?= base_url();?>assets/node_modules/bootstrap-daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="<?= base_url();?>assets/node_modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
	<link rel="stylesheet" href="<?= base_url();?>assets/node_modules/select2/dist/css/select2.min.css">
	<link rel="stylesheet" href="<?= base_url();?>assets/node_modules/selectric/public/selectric.css">
	<link rel="stylesheet" href="<?= base_url();?>assets/node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
	<link rel="stylesheet" href="<?= base_url();?>assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">

	<link href="<?= base_url();?>assets/css/icons.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?= base_url();?>assets/css/custom.css">

	<!-- javascript -->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

	<!-- datatables -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/datatables.min.js"></script>

	<!-- sweetalert2 -->
	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- tinyMCE -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugin/tinymce/jquery.tinymce.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugin/tinymce/tinymce.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugin/tinymce-textarea.js"></script>
	<!-- ckeditor -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugin/ckeditor/ckeditor.js"></script>
</head>
<body class="layout-3">
<?php $this->load->view('template/alert');?>
  <div id="app">
    <div class="main-wrapper container-fluid">
      <div class="navbar-bg"></div>