<?php
ini_set('display_errors', 0);
    require 'vendor/autoload.php';
    require '_ini_.php';
    require '_library_/_includes_/config.php';
    require '_library_/_includes_/app_config.inc';
    $help=new _classes_\helpers();
     $notify=new _classes_\Notifications();
      $worker=new _classes_\Users();
      if($_GET[user]){
        $_SESSION[user]=$_GET[user];
        }
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
                                    <div><?php $notify->Message(); ?></div>
					<div class="note note-success note-bordered">
						<p>
							System Access Log
						</p>
                                                <div style="margin-top:-2.2%;float:right">
                                                    
                                                      
                                                 <button   class="btn btn-success waves-effect waves-button dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                                                        <ul class="dropdown-menu">
                                            
                                                            <li><a href="#" onClick ="$('#data-table-command').tableExport({type:'csv',escape:'false'});"><img src='assets/icons/csv.png' width="24"/> CSV</a></li>
                                                <li><a href="#" onClick ="$('#data-table-command').tableExport({type:'txt',escape:'false'});"><img src='assets/icons/txt.png' width="24"/> TXT</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#" onClick ="$('#data-table-command').tableExport({type:'excel',escape:'false'});"><img src='assets/icons/xls.png' width="24"/> XLS</a></li>
                                                <li><a href="#" onClick ="$('#data-table-command').tableExport({type:'doc',escape:'false'});"><img src='assets/icons/word.png' width="24"/> Word</a></li>
                                                <li><a href="#" onClick ="$('#data-table-command').tableExport({type:'powerpoint',escape:'false'});"><img src='assets/icons/ppt.png' width="24"/> PowerPoint</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#" onClick ="$('#data-table-command').tableExport({type:'png',escape:'false'});"><img src='assets/icons/png.png' width="24"/> PNG</a></li>
                                                <li><a href="#" onClick ="$('#data-table-command').tableExport({type:'pdf',escape:'false'});"><img src='assets/icons/pdf.png' width="24"/> PDF</a></li>
                                              </ul>
                                                   
                                              </div>
                            
					</div>
                                    <div>
                                        
                                  <table  width=" " border="0">
                    <tr>
                    <form action="" method="post">
                     
                	    <td width="20%">

                                    <select class='form-control'  name='subject'  style="margin-left:-54%; width:160% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?user='+escape(this.value);" >
                                <option value=''>Filter by users</option>
                                        <option value='All user'>All users</option>
                                    <?php 
                                      global $sql;

                                          $query2=$sql->Prepare("SELECT ID,USER,USERNAME FROM tpoly_auth");


                                          $query=$sql->Execute( $query2);


                                       while( $row = $query->FetchRow())
                                         {

                                         ?>
                                         <option <?php if($_SESSION[user]==$row['USER']){echo 'selected="selected"'; }?> value="<?php echo $row['USER']; ?>"        ><?php echo $row['USERNAME']; ?></option>

                                  <?php }?>
                                      </select>

                            </td>
                             <td>&nbsp;</td>
                             <form action="access_log.php" method="post" >
				 <td width="25%">
                                     
                                     <input style="margin-left:94%;  " type="text" class="form-control datepicker" placeholder="date from" name="to"/>
                                    </td>
                                  <td>&nbsp;</td>
                                <td width="25%">
                                    <input placeholder="date to" style="margin-left:93%;  " type="text" class="form-control datepicker" name="to"/>

                               </td>
                               <td width="25%">
                            <button type="submit" name="go" style="margin-left:105%;width: 81px " class="btn btn-primary">Go</button>
                      </td>
                             
                   
                </table>
                                    </div>
                                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet light">
						<div class="portlet-title">
							 
							<div class="tools">
							</div>
						</div>
			<div class="portlet-body table-responsive basic-table" >
                                            <?php 
                                            $user=$_SESSION[user];                                       
                                             
                                            
                                            if($user=="All user" or $user==""){ $user=""; }else {$user_=" and USERNAME = '$user' "  ;}
                                            

                                            $query="SELECT  * FROM tpoly_system_log  WHERE 1  $user_ $date_   ORDER BY INPUTEDDATE DESC ";
                                             
                                               $_SESSION[last_query]=$query; 
                                                 $rs = $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                                                 $recordsFound = $rs->_maxRecordCount;    // total record found
                                                if (!$rs->EOF) 
                                                {
                                             ?>
                           
                    <div class="table-responsive">
                        <table   id="data-table-command" class="table table-striped table-vmiddle"  >
                            <thead>
                                <tr>
                                    
                                     <th  data-order="asc">NO</th>
                                     <th  data-order="asc">DATE</th>
                                     <th data-column-id="Course" data-type=" " data-toggle="tooltip">WORKER</th>
                                     <th data-column-id="Course Code" data-type=" " data-toggle="tooltip">EVENT</th>
                                      <th data-column-id="Programme" data-type=" " data-toggle="tooltip">ACTIVITIES</th> 
                                    <th style=" " data-type="string" data-column-id="Class" style="text-align:center">HOSTNAME</th>
                                   
                                    <th data-column-id="Level" data-order="asc" style="text-align:center">IP</th>
                                    <th data-column-id="Semester" style="text-align:">PAGES VISTED</th>
                                    <th data-column-id="Semester" style="text-align: ">USER AGENT</th>
                                      
                                   
                                      
                                      
                                </tr>
                            </thead>
                            <p align="center"style="color:red">  <?php echo $recordsFound ?> Records </p>
                            <tbody>
                                <?php
                                
                                   $count=0;
                                    while($rtmt=$rs->FetchRow()){
                                                            $count++;
                                                       $user=$worker->getUser($rtmt[USERNAME]);
                                                       
                                       ?>
                                    <tr>
                                    
                                     <td><?php echo $count ?></td>
                                     <td ><?php  echo date("g:ia \o\n l jS F Y",strtotime($rtmt[INPUTEDDATE])) ; ?></td>
                                     <td style="text-align:left; "><?php echo    $user->SURNAME." ".$user->NAME; ?></td>
                                    <td ><?php  echo $rtmt[EVENT_TYPE] ; ?></td>
                                  <td style="text-transform: capitalize"><?php echo $rtmt[ACTIVITIES]; ?></td> 
                                    <td style="text-align: center"><?php echo $rtmt["HOSTNAME"] ?></td>
                                    <td style="text-align: center"><?php echo $rtmt["IP"] ?></td>
                                    <td style="text-align: center"><?php echo $rtmt["PAGES_VISITED"] ?></td>
                                    <td style="text-align:"><?php echo $rtmt["BROWSER_VERSION"] ?></td>
                                    
                                     
                                    </tr>
                                    <?php }?>
                                     
                            </tbody>
                          </table>  
                            <br/>
                        <center><?php
                         $GenericEasyPagination->setTotalRecords($recordsFound);
	  
                        echo $GenericEasyPagination->getNavigation();
                        echo "<br>";
                        echo $GenericEasyPagination->getCurrentPages();
                      ?></center>
</div>
                                    <?php }else{
                  echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                Oh snap! Something went wrong. No record to display! Please 
                            </div>";
             }?>
						</div>
					 
					<!-- END EXAMPLE TABLE PORTLET-->

					 
				</div>
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

<script>
jQuery(document).ready(function() {       
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
   TableAdvanced.init();
});
</script>
<?php include("_library_/_includes_/export.php");  ?>
 

</html>