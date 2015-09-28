<?php
ini_set('display_errors', 0);
    require 'vendor/autoload.php';
    require '_ini_.php';
    require '_library_/_includes_/config.php';
    require '_library_/_includes_/app_config.inc';
    
    $help=new _classes_\helpers();
    $notify=new _classes_\Notifications();
    $security=new _classes_\cryptCls();
    $student=new _classes_\Student();
    $student = $_GET[student];
    $condition = $notify->getyear();
    $year = $condition->YEAR;
    $term = $condition->TERM;
     if(isset($_GET[sub])){
                 $_SESSION[amount]=$_POST[amount];
                 $_SESSION[receipt]=$_POST[receipt];
                         $pupil=$student->getStudent($_POST[student]);
                              
                 $amount=$_POST[amount];
                  if($type=='PTA'){
              $amount_pta=$amount;
                }
                elseif($type=='Academic'){
                    $amount_acadmic=$amount;
                }
                else{
                    $others=$amount;
                }
                  
                  $query=$sql->Prepare("INSERT INTO tbl_fee_ledger (RECEIPT,CLASS,`STUDENT`, `FEE_TYPE`,  `AMOUNT`, `DESCRIPTION`, `CHEQUE_NO`, `TERM`, `YEAR`,RECEIVED_BY)VALUES('".$help->getReceipt()."','$_POST[form]','$ward','$_POST[type]','$_POST[amount]','Fees Payment','$_POST[draft]','".$school->TERM."','".$school->YEAR."','".$teacher2->ID."')");
                  $trans1=$query=$sql->Execute($query);
                  $stmt=$sql->Prepare("UPDATE tbl_student SET BILLS_PAID=BILLS_PAID +'$_POST[amount]' , PTA_OWING=PTA_OWING-'$amount_pta',ACADEMIC_OWING=ACADEMIC_OWING-'$amount_acadmic',OTHER_BILLS=OTHER_BILLS-'$others',BILLS_OWING=BILLS-BILLS_PAID  WHERE INDEXNO='$_POST[student]'");
                 $trans2= $sql->Execute($stmt);
                 if($trans2 && $trans1){
                     // send sms to parents
                    $stmt= $sql->Prepare("select * from tbl_student where INDEXNO='$_POST[student]'") ;
                    $stmt2=$sql->Execute($stmt);
                     
                    while ($res=$stmt2->FetchRow())
                        {

                            $outstanding=$res[BILLS_OWING];
                            $type=$_POST[type];
                            $paid=$_POST['amount'];
                            $parentphone=$res['GUARDIAN_PHONE'];
                            $hassub=$res['sms'];
                            $student=$res[INDEXNO];
                            $sname=$res['SURNAME'].", ".$res['OTHERNAMES'];
                        }

                            if($parentphone){
                                $sms="Hi $sname ,you have just paid GHc $paid   as $type fees leaving a  Bal of GHc $outstanding  Thank You.";
                                         $_SESSION['connected']=$help->ping("www.google.com",80,20); 

                                //$help->sendtxt($sms,$parentphone,'feeAlert',$indexno);
                                                                 $_SESSION['connected']='';
                                                                  $_SESSION['student']='';
                                               //update receipt table after transaction
                                $help->UpdateReceipt();
                                header("location:printreceipt.php?student=$student&type=$type&paid=$paid&receipt=$_SESSION[receipt]&left=$outstanding");

                            }


                 }
                     
                 
                }
?>

<?php require '_library_/_includes_/header.inc'; ?>
 

<link rel="stylesheet" type="text/css" href="autocompletion/jquery.autocomplete.css"  /> 
<div>
    <?php require '_library_/_includes_/menu.inc'; ?>
   
   
      <style>
    .btn:not(.btn-link):not(.btn-float):not(.command-edit):not(.command-delete):not(.selectpicker) {
    box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.16), 0px 2px 10px 0px rgba(0, 0, 0, 0.12);
}
button, html input[type="button"], input[type="reset"], input[type="submit"] {
    cursor: pointer;
}
.btn {
    transition: all 300ms ease 0s;
    border: 0px none;
    text-transform: uppercase;
}
.btn-primary {
    color: #FFF;
    background-color: #2196F3;
    border-color: #0D8AEE;
}
.btn {
    display: inline-block;
    margin-bottom: 0px;
    font-weight: 400;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    background-image: none;
    border: 1px solid transparent;
    white-space: nowrap;
    padding: 6px 12px;
    font-size: 13px;
    line-height: 1.42857;
    border-radius: 2px;
    -moz-user-select: none;
}
</style>
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
					<div class="note note-success note-bordered">
						<p>
							Fee Payment
						</p>
                                                 
					  </div>
                                    
                                     
                                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet light">

    <div   style="margin-left: 15%">
                                                        <?php
        $STM = $sql->Prepare("SELECT * FROM tpoly_students WHERE INDEXNO='$student'");

        $STM = $sql->Execute($STM);

        $num = 0;
        while ($r = $STM->FetchRow()) {


            $_SESSION[student] = $r[INDEXNO];
            ?>

            <div class="block-header">

                     (NB:Use -(minus) to add an undercharge amount when student is pay his or her bill)           
                         
                    </div>
        <form action="fee_payment.php" method="POST">
            <table width="91%" border="0" class="table" id="bill">
              <tr>
                <th width="69%" height="105" align="center" valign="top" scope="row"><fieldset>
                  <div align="center">
                    <legend align=" " class="style1">Personal Records</legend>
                  </div>
                  <table width="741" border="0">
                    <tr>
                      <td width="495"><div class="divcurve" style="background-color:#D1E8D7">
                              
                       
 
                              <table   class="table">
                            
                          <tr>
                            <th scope="row" align=""> <div class="style6" align="" >Receipt No</div></th>
                            <td><div class="style6"><?php echo $help->getReceipt(); ?>
                                    <input type="hidden"  name="receipt" value="<?php echo $help->getReceipt(); ?>"/>
                            </div></td>
                          </tr>
                          <tr>
                            <th width="36%" scope="row"><div align="" class="style6">Name</div></th>
                            <td width="64%"><div align="left" class="style6"><?php echo "$r[SURNAME], $r[FIRSTNAME] $r[OTHERNAMES]";  ?>
                                    <input type="hidden" value="<?php echo $r[INDEXNO] ?>" name="student"/>
                            </div></td>
                            </tr>
                          <tr>
                            <th scope="row"><div align="" class="style6">Index Number</div></th>
                            <td><div align="left" class="style6"><?php echo $r[INDEXNO]; ?>
                              
                              </div></td>
                            </tr>
                          <tr>
                            <th scope="row"><div align="" class="style6">LEVEL</div></th>
                        <td><div align="left" class="style6"><?php echo $r["LEVEL"]; ?>
                              <input type="hidden" name="program" id="program" value="<?php echo $r["PROGRAMMENO"]; ?>" />
                              <input type="hidden" name="level" id="level" value="<?php echo $r["LEVEL"]; ?>" />
                            </div></td>
                            </tr>
                            
                          <tr>
                              <th scope="row"><div align="" class="style6">Bills B/F GH&cent;</div></th>
                        <td><div align="left" class="style6"><?php echo $r["BILLS"]; ?>
                               <input type="hidden" name="bill" id="bill" value="<?php echo $r["BILL"]; ?>" />
                            </div></td>
                            </tr>
                          <tr>
                            <th class="style6" scope="row" align=""><div class="style6" align="" >Total Owing GH&cent</div></th>
                            <td class="style6"><?php  
                           echo    $r[BILLS]-$r[BILLS_PAID];
                                        
                            ?>
                              <input type="hidden" name="bill" id="bill" onkeyup="recalculateSum();" value="<?php echo $r[BILLS] - $r[BILLS_PAID]; ?>" /></td>
                          </td>
                          </tr>
                          <tr>
                            <th scope="row"><div align="" class="style6">Bills Paid GH&cent</div></th>
                        <td><div align="left" class="style6"><?php echo $r["BILLS_PAID"]; ?>
                                <input  type="hidden" name="paid" value="<?php echo $r["BILLS_PAID"]; ?>"/>
                            </div></td>
                            </tr>
                           
                          <tr>
                            <th class="style6" scope="row"><div align=""><div class="style6" align="" >Amount Paying</div></div></th>
                            <td class="style6"><label>
                                    <input type="text"  class="form-control"  required="" name="amount" id="pay"  onkeyup="recalculateSum();" />
                              </label></td>
                          </tr>
                          
                          <tr>
                            <th class="style6" scope="row"><div align=""><div class="style6" align="" >Total Amount Left</div></div></th>
                            <td class="style6"><label>
                                    <input type="text"  class="form-control"   name="outstanding" id="amount_left" onkeyup="recalculateSum();" readonly="readonly" />
                              </label></td>
                            </tr>
                            <tr>
                            <th class="style6" scope="row"><div align="">Payin slip No</div></th>
                            <td class="style6"><label>
                              <input type="text" class="form-control" name="draft" id="draft" ondblclick="return printpage()" />
                              </label></td>
                            </tr>
                             
                          <tr>
                            <th class="style6" scope="row"><div align="">Bank</div></th>
                            <td class="style6"><label>
                                    <select class='form-control' name="bank" required="">
                               <option value=''>select Bank</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT * FROM tpoly_banks");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['ID']; ?>"        ><?php echo $row['NAME']; ?></option>

                                                    <?php }?>
                                    </select>
                              </label></td>
                            </tr>
                        </table>
                      </div></td>
                      <td width="236" valign="top"><div class="divcurve" style="background-color:#D1E8D7">
                        <table width="237" border="0" bordercolor="">
                          <tr>
                              <td width="202"> <div align="center"><img <?php $student=$r[INDEXNO]; echo $help->picture("photos/students/$student.jpg",200)?>  src="<?php echo file_exists("photos/students/$student.jpg") ? "photos/students/$student.jpg":"photos/students/user.jpg";?>" alt=" Picture of Student Here"   /></div>
                              <p align="center">&nbsp;</p></td>
                            </tr>
                        </table>
                      </div>
                      
                      </td>

                    </tr>
                  </table>
                  </fieldset>
                        <hr/></th>
                </tr>
               </table>
                 
           
            <div class="row" align='center'>
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="btn-toolbar">
                 
                <input type="submit" name="Update" id="Update" value="Update Records" class="btn btn-primary"  onclick="return confirm('ARE YOU SURE EVERY DATA IS ACCURATE?')"/>
               
                  </form>
                <input type="submit" name="button" id="button" value="Print" onclick="return printpage()"  class="btn btn-success"/>
               
               <?php }?> 
                 
                 
         
            </div>
                </div>
            </div>
           
             
          </div>
        <p align="center">&nbsp;</p></th>
      </tr>
    </table></th>
  </tr>
  <tr></tr>
</table>
 
                                            
                                              
                          
                           
                                
                                                <div>
                                               
                                                </div>
                                           
                                            
                                            </div>
                                    
                                     
                                
                                </div>
                                        <!-- END PAGE CONTENT INNER -->
                                </div>
                </div>
	</div>
	<!-- END PAGE CONTENT -->

  </div>
<div class="page-footer" style="margin-top: 20%">
	<div class="container">
            <center><?php echo $help->copy(); ?></center>
	</div>
</div>
       
        </div>
<!-- END PAGE CONTAINER -->
 
<!-- BEGIN FOOTER -->
</div>

<div class="scroll-to-top">
	<i class="icon-arrow-up"></i>
</div>
 
<?php include("_library_/_includes_/scripts.php");  ?>
<script type='text/javascript' src="autocompletion/jquery.js"></script>
<script type='text/javascript' src="autocompletion/jquery.autocomplete.js"></script>
<script type='text/javascript' src="autocompletion/localdata.js"></script>
<script type="text/javascript">

//var other_options =  ['Phone Numbers', 'Email', 'Address', 'Local Congregation','Males', 'Females' ];
 $().ready(function() {
		
	
	$("#student").autocomplete(student_names, {
		minChars: 0,
		max: 12,
		autoFill: true,
		mustMatch: true,
		matchContains: false,
		scrollHeight: 220,
	
	});
	
	
	
		$("#student_name").autocomplete(student_names, {
		minChars: 0,
		max: 12,
		autoFill: true,
		mustMatch: true,
		matchContains: false,
		scrollHeight: 220,
	
	});
	
 });
 </script> 
 
<?php include("_library_/_includes_/export.php");  ?>
 

</html>