<?php
ini_set('display_errors', 0);
    require 'vendor/autoload.php';
    require '_ini_.php';
    require '_library_/_includes_/config.php';
    require '_library_/_includes_/app_config.inc';
    $skeleton=new _classes_\skeleton();
    $help=new _classes_\helpers();
?>

<?php require '_library_/_includes_/header.inc'; ?>
<div>
    <?php require '_library_/_includes_/menu.inc'; ?>
</div>
<!-- END HEADER -->
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<div class="container">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h4>Welcome <small>Start here</small></h4>
			</div>
			<!-- END PAGE TITLE -->
			<!-- BEGIN PAGE TOOLBAR -->
			<div class="page-toolbar">
				 
			</div>
			<!-- END PAGE TOOLBAR -->
		</div>
	</div>
	<!-- END PAGE HEAD -->
	<!-- BEGIN PAGE CONTENT -->
	<div class="page-content">
		<div class="container">
			 
			 
			<!-- END PAGE BREADCRUMB -->
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="row">
				<div class="col-md-12">
					<div class="note note-success note-bordered">
						<p>
							 Please try to re-size your browser window in order to see the tables in responsive mode.
						</p>
					</div>
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase">Responsive Flip Scroll Tables</span>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="javascript:;" class="reload">
								</a>
								<a href="javascript:;" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body flip-scroll">
							<table class="table table-bordered table-striped table-condensed flip-content">
							<thead class="flip-content">
							<tr>
								<th width="20%">
									 Code
								</th>
								<th>
									 Company
								</th>
								<th class="numeric">
									 Price
								</th>
								<th class="numeric">
									 Change
								</th>
								<th class="numeric">
									 Change %
								</th>
								<th class="numeric">
									 Open
								</th>
								<th class="numeric">
									 High
								</th>
								<th class="numeric">
									 Low
								</th>
								<th class="numeric">
									 Volume
								</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>
									 AAC
								</td>
								<td>
									 AUSTRALIAN AGRICULTURAL COMPANY LIMITED.
								</td>
								<td class="numeric">
									 &nbsp;
								</td>
								<td class="numeric">
									 -0.01
								</td>
								<td class="numeric">
									 -0.36%
								</td>
								<td class="numeric">
									 $1.39
								</td>
								<td class="numeric">
									 $1.39
								</td>
								<td class="numeric">
									 &nbsp;
								</td>
								<td class="numeric">
									 9,395
								</td>
							</tr>
							<tr>
								<td>
									 AAD
								</td>
								<td>
									 ARDENT LEISURE GROUP
								</td>
								<td class="numeric">
									 $1.15
								</td>
								<td class="numeric">
									 +0.02
								</td>
								<td class="numeric">
									 1.32%
								</td>
								<td class="numeric">
									 $1.14
								</td>
								<td class="numeric">
									 $1.15
								</td>
								<td class="numeric">
									 $1.13
								</td>
								<td class="numeric">
									 56,431
								</td>
							</tr>
							<tr>
								<td>
									 AAX
								</td>
								<td>
									 AUSENCO LIMITED
								</td>
								<td class="numeric">
									 $4.00
								</td>
								<td class="numeric">
									 -0.04
								</td>
								<td class="numeric">
									 -0.99%
								</td>
								<td class="numeric">
									 $4.01
								</td>
								<td class="numeric">
									 $4.05
								</td>
								<td class="numeric">
									 $4.00
								</td>
								<td class="numeric">
									 90,641
								</td>
							</tr>
							<tr>
								<td>
									 ABC
								</td>
								<td>
									 ADELAIDE BRIGHTON LIMITED
								</td>
								<td class="numeric">
									 $3.00
								</td>
								<td class="numeric">
									 +0.06
								</td>
								<td class="numeric">
									 2.04%
								</td>
								<td class="numeric">
									 $2.98
								</td>
								<td class="numeric">
									 $3.00
								</td>
								<td class="numeric">
									 $2.96
								</td>
								<td class="numeric">
									 862,518
								</td>
							</tr>
							<tr>
								<td>
									 ABP
								</td>
								<td>
									 ABACUS PROPERTY GROUP
								</td>
								<td class="numeric">
									 $1.91
								</td>
								<td class="numeric">
									 0.00
								</td>
								<td class="numeric">
									 0.00%
								</td>
								<td class="numeric">
									 $1.92
								</td>
								<td class="numeric">
									 $1.93
								</td>
								<td class="numeric">
									 $1.90
								</td>
								<td class="numeric">
									 595,701
								</td>
							</tr>
							<tr>
								<td>
									 ABY
								</td>
								<td>
									 ADITYA BIRLA MINERALS LIMITED
								</td>
								<td class="numeric">
									 $0.77
								</td>
								<td class="numeric">
									 +0.02
								</td>
								<td class="numeric">
									 2.00%
								</td>
								<td class="numeric">
									 $0.76
								</td>
								<td class="numeric">
									 $0.77
								</td>
								<td class="numeric">
									 $0.76
								</td>
								<td class="numeric">
									 54,567
								</td>
							</tr>
							<tr>
								<td>
									 ACR
								</td>
								<td>
									 ACRUX LIMITED
								</td>
								<td class="numeric">
									 $3.71
								</td>
								<td class="numeric">
									 +0.01
								</td>
								<td class="numeric">
									 0.14%
								</td>
								<td class="numeric">
									 $3.70
								</td>
								<td class="numeric">
									 $3.72
								</td>
								<td class="numeric">
									 $3.68
								</td>
								<td class="numeric">
									 191,373
								</td>
							</tr>
							<tr>
								<td>
									 ADU
								</td>
								<td>
									 ADAMUS RESOURCES LIMITED
								</td>
								<td class="numeric">
									 $0.72
								</td>
								<td class="numeric">
									 0.00
								</td>
								<td class="numeric">
									 0.00%
								</td>
								<td class="numeric">
									 $0.73
								</td>
								<td class="numeric">
									 $0.74
								</td>
								<td class="numeric">
									 $0.72
								</td>
								<td class="numeric">
									 8,602,291
								</td>
							</tr>
							<tr>
								<td>
									 AGG
								</td>
								<td>
									 ANGLOGOLD ASHANTI LIMITED
								</td>
								<td class="numeric">
									 $7.81
								</td>
								<td class="numeric">
									 -0.22
								</td>
								<td class="numeric">
									 -2.74%
								</td>
								<td class="numeric">
									 $7.82
								</td>
								<td class="numeric">
									 $7.82
								</td>
								<td class="numeric">
									 $7.81
								</td>
								<td class="numeric">
									 148
								</td>
							</tr>
							<tr>
								<td>
									 AGK
								</td>
								<td>
									 AGL ENERGY LIMITED
								</td>
								<td class="numeric">
									 $13.82
								</td>
								<td class="numeric">
									 +0.02
								</td>
								<td class="numeric">
									 0.14%
								</td>
								<td class="numeric">
									 $13.83
								</td>
								<td class="numeric">
									 $13.83
								</td>
								<td class="numeric">
									 $13.67
								</td>
								<td class="numeric">
									 846,403
								</td>
							</tr>
							<tr>
								<td>
									 AGO
								</td>
								<td>
									 ATLAS IRON LIMITED
								</td>
								<td class="numeric">
									 $3.17
								</td>
								<td class="numeric">
									 -0.02
								</td>
								<td class="numeric">
									 -0.47%
								</td>
								<td class="numeric">
									 $3.11
								</td>
								<td class="numeric">
									 $3.22
								</td>
								<td class="numeric">
									 $3.10
								</td>
								<td class="numeric">
									 5,416,303
								</td>
							</tr>
							</tbody>
							</table>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase">Basic Bootstrap 3.0 Responsive Table</span>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="javascript:;" class="reload">
								</a>
								<a href="javascript:;" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-responsive">
								<table class="table">
								<thead>
								<tr>
									<th>
										 #
									</th>
									<th>
										 Table heading
									</th>
									<th>
										 Table heading
									</th>
									<th>
										 Table heading
									</th>
									<th>
										 Table heading
									</th>
									<th>
										 Table heading
									</th>
									<th>
										 Table heading
									</th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<td>
										 1
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
								</tr>
								<tr>
									<td>
										 2
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
								</tr>
								<tr>
									<td>
										 3
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
								</tr>
								</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase">Bordered Bootstrap 3.0 Responsive Table</span>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="javascript:;" class="reload">
								</a>
								<a href="javascript:;" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-responsive">
								<table class="table table-bordered">
								<thead>
								<tr>
									<th>
										 #
									</th>
									<th>
										 Table heading
									</th>
									<th>
										 Table heading
									</th>
									<th>
										 Table heading
									</th>
									<th>
										 Table heading
									</th>
									<th>
										 Table heading
									</th>
									<th>
										 Table heading
									</th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<td>
										 1
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
								</tr>
								<tr>
									<td>
										 2
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
								</tr>
								<tr>
									<td>
										 3
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
								</tr>
								</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase">All in One Bootstrap 3.0 Responsive Table</span>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="javascript:;" class="reload">
								</a>
								<a href="javascript:;" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th>
										 #
									</th>
									<th>
										 Table heading
									</th>
									<th>
										 Table heading
									</th>
									<th>
										 Table heading
									</th>
									<th>
										 Table heading
									</th>
									<th>
										 Table heading
									</th>
									<th>
										 Table heading
									</th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<td>
										 1
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
								</tr>
								<tr>
									<td>
										 2
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
								</tr>
								<tr>
									<td>
										 3
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
									<td>
										 Table cell
									</td>
								</tr>
								</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase">Horizontal Scrollable Responsive Table</span>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="javascript:;" class="reload">
								</a>
								<a href="javascript:;" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-scrollable">
								<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th scope="col" style="width:450px !important">
										 Column header 1
									</th>
									<th scope="col">
										 Column header 2
									</th>
									<th scope="col">
										 Column header 3
									</th>
									<th scope="col">
										 Column header 4
									</th>
									<th scope="col">
										 Column header 5
									</th>
									<th scope="col">
										 Column header 6
									</th>
									<th scope="col">
										 Column header 7
									</th>
									<th scope="col">
										 Column header 8
									</th>
									<th scope="col">
										 Column header 9
									</th>
									<th scope="col">
										 Column header 10
									</th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
								</tr>
								<tr>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
								</tr>
								<tr>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
								</tr>
								<tr>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
								</tr>
								<tr>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
								</tr>
								<tr>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
									<td>
										 Table data
									</td>
								</tr>
								</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT INNER -->
		</div>
	</div>
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->
 
<!-- BEGIN FOOTER -->
<div class="page-footer" style="">
	<div class="container">
            <center><?php echo $help->copyright(); ?></center>
	</div>
</div>
<div class="scroll-to-top">
	<i class="icon-arrow-up"></i>
</div>

 <?php include("_library_/_includes_/scripts.php");  ?>

</html>