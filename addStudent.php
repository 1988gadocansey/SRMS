<?php
ini_set('display_errors', 0);
require 'vendor/autoload.php';
require '_ini_.php';
require '_library_/_includes_/config.php';
require '_library_/_includes_/app_config.inc';
 
$help = new _classes_\helpers();
$notify = new _classes_\Notifications();
$security = new _classes_\cryptCls();
if (isset($_GET[indexno]) != "") {
    $_SESSION[indexno] = $_GET[indexno]; // he is an old student for update
} else {
    //$_SESSION[indexno]=$help->getindexno(); // he is a new student so new indexno to be generated
}

if (isset($_GET['upload'])) {


    if (!$_FILES["photo"]["name"]) {
        echo " <font color='red' style='text-decoration:blink'>Please choose a file to upload</font>";
        $error = 1;
    }
    //check if file type is jpeg 
    elseif ($_FILES["photo"]["type"]!="image/jpeg" and $_FILES["file"]["type"]!="image/pjpeg"  ){echo " <font color='red' style='text-decoration:blink'>Only jpeg formats accepted </font>";   		$error=2;  }
    elseif (($_FILES["photo"]["size"] ) > 2097152) {
        echo " <font color='red'> File size must be less than 2 MB</font>";
        $error = 3;
    }



    if ($error > 0) {
        
    } else {
        $destination = "photos/students/$_SESSION[indexno].jpg";
        move_uploaded_file($_FILES["photo"]["tmp_name"], $destination);

        if (move_uploaded_file) {//echo "<font color='red' style='text-decoration:blink'> Picture uploaded  successfully </font>" ;
            header("location:students.php");
        }
    }
}
// submitting form

    if(isset($_POST[submit])){
        $age=$help->age($_POST[dob], "gh");
        $year_sem=$help->getYear();
        $data="INDEXNO='$_POST[indexno]',FIRSTNAME='$_POST[fname]',SURNAME='$_POST[sname]',OTHERNAMES='$_POST[oname]',LEVEL='$_POST[level]',PROGRAMMECODE='$_POST[program]',SEX='$_POST[gender]',DATEOFBIRTH='$_POST[dob]',AGE='$age',GRADUATING_GROUP='$_POST[yeargroup]',FINANCE_TYPE='$_POST[finance]',HALL='$_POST[hall]',ADDRESS='$_POST[contact_address]',RESIDENTIAL_ADDRESS='$_POST[resident_address]',EMAIL='$_POST[email]',TELEPHONENO='$_POST[phone]',SSN='$_POST[ssn]',COUNTRY='$_POST[nationality]',REGION='$_POST[region]',RELIGION='$_POST[religion]',HOMETOWN='$_POST[hometown]',GUARDIAN_NAME='$_POST[gname]',GUARDIAN_ADDRESS='$_POST[gaddress]',GUARDIAN_PHONE='$_POST[gphone]',GUARDIAN_OCCUPATION='$_POST[goccupation]',DISABILITY='$_POST[disability]',STATUS='$_POST[status]',STUDENT_TYPE='$_POST[student_type]',LEVEL_ADMITTED='$_POST[level_admitted]',SESSION_PREFERENCE='$_POST[session_preference]',FEE_PAYING='$_POST[fee_paying]',LAST_SEEN='$year_sem'";
       print_r( trim($data));
        $query=$sql->Prepare("UPDATE tpoly_students SET $data WHERE INDEXNO='$_SESSION[indexno]'");
        if($sql->Execute($query)){
             header("location:students.php?success=1");
        }
        else{
            header("location:addStudent.php?indexno=$_SESSION[indexno]");
        }
        
    }
?>

<?php require '_library_/_includes_/header.inc'; ?>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>


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
                            Add / Edit Students here
                        </p>
                        <div style="margin-top:-2.2%;float:right">
                            <form action="addStudent.php" method="post">

                                <button type="submit" style="margin-left: -145px;"name="sync" class="btn btn-primary waves-effect">Import students from csv<i class="fa fa-upload"></i></button>
                            </form>

                        </div>

                    </div>
                    <div>


                    </div>
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light">
                        <div class="portlet-title">

                            <div class="tools">
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div align="center">

                                <div style="float: right;margin-top: -6%">
                                    <span class="label label-default">Only jpg file accept and maximum should be 2MB</span>
                                    <p></p>
                                    <div class="col-md-9" style="margin-left: 12%">
                                        <form action="addStudent.php?upload=1" method="POST" enctype="multipart/form-data">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                    <img <?php $person = $_SESSION[indexno];
echo $help->picture("photos/students/$person.jpg", 199) ?>  src="<?php echo file_exists("photos/students/$person.jpg") ? "photos/students/$person.jpg" : "photos/students/user.jpg"; ?>" alt=" Picture of Student Here" data-toggle="modal" href="#modalWider"/>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                                </div>
                                                <div>
                                                    <span class="btn default btn-file">
                                                        <span class="fileinput-new">
                                                            Select image </span>
                                                        <span class="fileinput-exists">
                                                            Change </span>
                                                        <input type="file" name="photo" required="">
                                                    </span>
                                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">
                                                        Remove </a>

                                                </div>
                                                    <?php if ($_SESSION[indexno] == "") {

                                                    } else { ?><button type="submit" class="btn btn-primary">upload</button><?php } ?>

                                            </div>

                                        </form>
                                    </div>

                                </div>
                                <?php
                                if ($_GET[success] || $_GET["indexno"] || $_GET["error"]) {
                                    $student = $_SESSION[indexno] or $_GET[success];
                                    $query = $sql->Prepare("SELECT * FROM tpoly_students WHERE INDEXNO='$student'  ");

                                    $stmt = $sql->Execute($query);
                                    $rows = $stmt->FetchNextObject();
                                } elseif ($_GET["new"]) {
                                    
                                }
                                ?>
                                <form action="addStudent.php" class="form-horizontal" align="center" method="POST">
                                    <div class="form-body">

                                    </div>

                                    <h4 class="form-section">BIODATA</h4>
                                   
                                    <div class="row" style="margin-top:5%" >

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Student No  </label>
                                                <div class="col-md-9">
                                                    <input type="text" required="" readonly="readonly" class="form-control" name="indexno" value="<?php echo $rows->INDEXNO ?>" >

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">First Name  </label>
                                                <div class="col-md-9">
                                                    <input type="text" required=""   class="form-control" name="fname" value="<?php echo $rows->FIRSTNAME ?>" >

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Surname</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" required="" class="form-control" name="sname" value="<?php echo $rows->SURNAME ?>">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Other Names</span></label>
                                                <div class="col-md-9">
                                                    <input type="text"  class="form-control" name="oname" value="<?php echo $rows->OTHERNAMES ?>">

                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Gender</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" name="gender" required="">
                                                        <option>select gender</option>

                                                        <option value="M"    <?php if ($rows->SEX == "M") {
                                    echo "selected='selected'";
                                } ?>      >Male</option>
                                                        <option value="F"    <?php if ($rows->SEX == "F") {
                                    echo "selected='selected'";
                                } ?>      >Female</option>

                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Date of Birth</label>
                                                <div class="col-md-9">
                                                     <span id="dob">
                                                         <input type="text" required="" name="dob"  class="form-control" placeholder="dd/mm/yyyy" value="<?php echo $rows->DATEOFBIRTH ?>">
                                                     <span class="textfieldInvalidFormatMsg">Invalid date format.</span></span>
                                                   </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Level</label>
                                                <div class="col-md-9">
                                                    <select class="select2_category form-control" required="" name="level">
                                                        <option value=''>select level</option>
                                                        <option value='50'<?php if ($rows->LEVEL == '50') {
                                                            echo 'selected="selected"';
                                                        } ?>>50</option>
                                                                                <option value='100'<?php if ($rows->LEVEL == '100') {
                                                            echo 'selected="selected"';
                                                        } ?>>100</option>
                                                                                <option value='200'<?php if ($rows->LEVEL == '200') {
                                                            echo 'selected="selected"';
                                                        } ?>>200</option>
                                                                                <option value='300'<?php if ($rows->LEVEL == '300') {
                                                            echo 'selected="selected"';
                                                        } ?>>300</option>
                                                                                <option value='400'<?php if ($rows->LEVEL == '400') {
                                                            echo 'selected="selected"';
                                                        } ?>>400</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Student Type</label>
                                                <div class="col-md-9">
                                                    <div class="radio-list">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="student_type" value="1" value="<?php echo $rows->STUDENT_TYPE; ?>" <?php if ($rows->STUDENT_TYPE == 'Resident') {
                                    echo 'check="checked"';
                                } ?>/>
                                                            Resident </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="student_type" value="0" <?php if ($rows->STUDENT_TYPE == 'Non Resident') {
                                                            echo 'check="checked"';
                                                        } ?>/>
                                                            Non Resident </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Nationality</label>
                                                <div class="col-md-9">
                                                    <select class="select2_category form-control" required="" name="nationality">
                                                        <option value=''>Choose Nationality</option>

                                                            <?php
                                                            global $sql;

                                                            $query2 = $sql->Prepare("SELECT * FROM tbl_country");


                                                            $query = $sql->Execute($query2);


                                                            while ($row = $query->FetchRow()) {
                                                                ?>
                                                                                                                        <option value="<?php echo $row['Name']; ?>"   <?php if ($rows->COUNTRY== $row['Name']) {
                                                                                                                        echo "selected='selected'";
                                                                                                                    } ?>      ><?php echo $row['Name']; ?></option>

                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Religion</label>
                                                <div class="col-md-9">
                                                    <select class="select2_category form-control" required="" name="religion">
                                                        <option value=''>Choose religion</option>

                                                            <?php
                                                            global $sql;

                                                            $query2 = $sql->Prepare("SELECT * FROM tbl_religion");


                                                            $query = $sql->Execute($query2);


                                                            while ($row = $query->FetchRow()) {
                                                                ?>
                                                                                                                        <option value="<?php echo $row['religion']; ?>"   <?php if ($rows->RELIGION== $row['religion']) {
                                                                    echo "selected='selected'";
                                                                } ?>      ><?php echo $row['religion']; ?></option>

                                                            <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Social Security No.</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control"   name="ssn" value="<?php echo $rows->SSN ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Disability</label>
                                                <div class="col-md-9">
                                                   <select class='form-control' name='disability'  >
                                                        <option value='None'>None</option>
												
		                                         <option <?php if($rows->DISABILITY=='Blind'){ echo 'selected="selected"'; }?> >Blind</option>
		                                        <option <?php if($rows->DISABILITY=='Deaf'){ echo 'selected="selected"'; }?> >Deaf</option>
		                                        <option <?php if($rows->DISABILITY=='Dumb'){ echo 'selected="selected"'; }?> >Dumb</option>
		                                             
		                                        </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="form-section">ADDRESS</h4>
                                    <hr>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Residential Address</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" required="" name="resident_address" value="<?php echo $rows->RESIDENTIAL_ADDRESS ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Contact Address</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" required="" name="contact_address" value="<?php echo $rows->ADDRESS ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Hometown</label>
                                                <div class="col-md-9">
                                                    <input type="text" required="" class="form-control" name="hometown" value="<?php echo $rows->HOMETOWN ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Region</label>
                                                <div class="col-md-9">
                                                    <select class='form-control'  name='region'    required="">
                                                        <option value=''>Choose region</option>

                                                            <?php
                                                            global $sql;

                                                            $query2 = $sql->Prepare("SELECT * FROM tbl_regions");


                                                            $query = $sql->Execute($query2);


                                                            while ($row = $query->FetchRow()) {
                                                                ?>
                                                                                                                        <option value="<?php echo $row['NAME']; ?>" <?php if ($rows->REGION == $row['NAME']) {
                                                                    echo "selected='selected'";
                                                                } ?>        ><?php echo $row['NAME']; ?></option>

                                                          <?php } ?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Telephone</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" value="<?php echo $rows->TELEPHONENO ?>" name="phone" maxlength="10">
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Hall</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" required="" name="hall">
                                                        <option value=''>Choose hall</option>

                                                        <?php
                                                        global $sql;

                                                        $query2 = $sql->Prepare("SELECT * FROM tpoly_hall");


                                                        $query = $sql->Execute($query2);


                                                        while ($row = $query->FetchRow()) {
                                                            ?>
                                                                                                                    <option value="<?php echo $row['ID']; ?>" <?php if ($rows->HALL == $row['ID']) {
                                                                echo "selected='selected'";
                                                            } ?>        ><?php echo $row['HALL_NAME']; ?></option>

                                                        <?php } ?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Email</label>
                                                <div class="col-md-9">
                                                    <input type="email" class="form-control" value="<?php echo $rows->EMAIL ?>" required="" name="email" >
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Session Preference</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" required="" name="session_preference">
                                                        <option value=''>Choose session preference</option>

                                                        <?php
                                                        global $sql;

                                                        $query2 = $sql->Prepare("SELECT * FROM tbl_mode_application");


                                                        $query = $sql->Execute($query2);


                                                        while ($row = $query->FetchRow()) {
                                                            ?>
                                                                                                                    <option value="<?php echo $row['ID']; ?>" <?php if ($rows->SESSION_PREFERENCE == $row['ID']) {
                                                                echo "selected='selected'";
                                                            } ?>        ><?php echo $row['MODE']; ?></option>

                                                        <?php } ?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <h4 class="form-section">GUARDIAN INFORMATION</h4>
                                    <hr>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Guardian Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" required="" name="gname" value="<?php echo $rows->GUARDIAN_NAME ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Guardian Address</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" required="" name="gaddress" value="<?php echo $rows->GUARDIAN_ADDRESS ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Guardian Phone</label>
                                                <div class="col-md-9">
                                                    <input type="text" required="" class="form-control" name="gphone" value="<?php echo $rows->GUARDIAN_PHONE ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                      <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Guardian Occupation</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" required="" name="goccupation" value="<?php echo $rows->GUARDIAN_OCCUPATION ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                     
                                    <!--/row-->

                                    <h4 class="form-section">Academic Information</h4>
                                    <hr>
                                    <!--/row-->
                                     
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Year group</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" required="" name="yeargroup">
                                                       <option value=''>Filter by year group</option>
                                                        <?php
                                                                                                                     for($i=2008; $i<=date("Y")+1; $i++){
                                                                                                                             $a=$i - 1 ."/". $i;?>
                                                                                                                                      <option <?php if($rows->GRADUATING_GROUP==$a){echo 'selected="selected"'; }?>value='<?php echo $a ?>'><?php echo $a ?></option>";

                                                                                                                          <?php    } ?>


                                                                                                              ?>
                                                     </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Program</label>
                                                <div class="col-md-9">
                                                    <select class='form-control'  name='program'    required="">
                                                       <option value=''>select program</option>
                                                    <?php 
                                                      global $sql;

                                                          $query2=$sql->Prepare("SELECT * FROM tpoly_programme");


                                                          $query=$sql->Execute( $query2);


                                                       while( $row = $query->FetchRow())
                                                         {

                                                         ?>
                                                         <option <?php if($row['PROGRAMMECODE']==$rows->PROGRAMMECODE){echo 'selected="selected"'; }?> value="<?php echo $row['PROGRAMMECODE']; ?>"        ><?php echo $row['PROGRAMME']; ?></option>

                                                  <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Status</label>
                                                <div class="col-md-9">
                                                    <select class='form-control'  name='status'  required="" >
                                                        <option value=''>select status</option>
                                                      
                                                       <option value='Continuing Student'<?php if($rows->STATUS=='Continuing Student'){echo 'selected="selected"'; }?>>Continuing</option>
                                                       <option value='Deffered'<?php if($rows->STATUS=='Deffered'){echo 'selected="selected"'; }?>>Deffered</option>
                                                       <option value='Dead'<?php if($rows->STATUS=='Dead'){echo 'selected="selected"'; }?>>Dead</option>
                                                       <option value='Suspended'<?php if($rows->STATUS=='Suspended'){echo 'selected="selected"'; }?>>Suspended</option>
                                                       <option value='Rasticated'<?php if($rows->STATUS=='Rasticated'){echo 'selected="selected"'; }?>>Rasticated</option>
                                                       <option value='Alumni'<?php if($rows->STATUS=='Alumni'){echo 'selected="selected"'; }?>>Alumni</option>
                                                       <option value='Fresh'<?php if($rows->STATUS=='Fresh'){echo 'selected="selected"'; }?>>Fresh</option>
                                                   </select>

                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Level Admitted</label>
                                                <div class="col-md-9">
                                                    <select class='form-control select2_sample1'  name='level_admitted'  required="">
                                                        <option value=''>select level admitted</option>
                                                       
                                                       <option value='50'<?php if($rows->LEVEL_ADMITTED=='50'){echo 'selected="selected"'; }?>>50</option>
                                                           <option value='100'<?php if($rows->LEVEL_ADMITTED=='100'){echo 'selected="selected"'; }?>>100</option>
                                                           <option value='200'<?php if($rows->LEVEL_ADMITTED=='200'){echo 'selected="selected"'; }?>>200</option>
                                                       <option value='300'<?php if($rows->LEVEL_ADMITTED=='300'){echo 'selected="selected"'; }?>>300</option>
                                                       <option value='400'<?php if($rows->LEVEL_ADMITTED=='400'){echo 'selected="selected"'; }?>>400</option>

                                                   </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Financial type</label>
                                                <div class="col-md-9">
                                                    <select class='form-control select2_sample1'  name='finance'  required="">
                                                        <option value=''>select finance type</option>
                                                       
                                                       <option value='Bursary'<?php if($rows->FINANCE_TYPE=='Bursary'){echo 'selected="selected"'; }?>>Bursary</option>
                                                           <option value='Scholarship'<?php if($rows->FINANCE_TYPE=='Scholarship'){echo 'selected="selected"'; }?>>Scholarship</option>
                                                           <option value='Default'<?php if($rows->FINANCE_TYPE=='Default'){echo 'selected="selected"'; }?>>Default</option>
                                                   

                                                   </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Fee paying status</label>
                                                <div class="col-md-9">
                                                    <div class="radio-list">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="fee_paying" value="Non Fee Paying" value="<?php echo $rows->FEE_PAYING; ?>" <?php if ($rows->FEE_PAYING == 'Non Fee Paying') {
                                    echo 'check="checked"';
                                } ?>/>
                                                           Non Fee paying </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="fee_paying" value="Fee Paying" <?php if ($rows->FEE_PAYING == 'Fee Paying') {
                                                            echo 'check="checked"';
                                                        } ?>/>
                                                            Fee paying </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->

                                    <div class="form-actions">
                                        <div class="row" style="margin-left:30%">
                                            <div class="col-md-5">
                                                <div class="row">
                                                   
                                                        <div class="col-md-offset-3 col-md-9">
                                                            <button type="submit" name="submit" class="btn green">Submit</button>
                                                            <button type="button" class="btn default">Cancel</button>
                                                        </div>
                                                     
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
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
<?php include("_library_/_includes_/scripts.php"); ?>
<script src="assets/admin/pages/scripts/form-samples.js"></script>
<script src="assets/admin/pages/scripts/components-form-tools.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script src="assets/admin/pages/scripts/components-pickers.js"></script>

<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
        FormSamples.init();
        ComponentsFormTools.init();
        ComponentsPickers.init();

    });
    var date_froms = new Spry.Widget.ValidationTextField("dob", "date", {format:"dd/mm/yyyy", hint:"dd/mm/yyyy", validateOn:["blur", "change"], useCharacterMasking:true});
  
</script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="style">
 
<?php include("_library_/_includes_/export.php"); ?>


</html>