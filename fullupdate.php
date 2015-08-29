<?php 
include('check.php');
$college='025';
$prog = new ProgressBar();
$prog->progress("pb-start");
 
$target_url="ifciaucc.org/caccept.php";
$online_target_url="http://www.cuconline.com/caccept.php";

if($_SESSION[clevel]){
$lev=$_SESSION[clevel];
if($lev=="All Level"){$inlev=""; }else {
	//$inlev=" and level = '$lev' "  ;
}
}




	

function progressBar($current,$total) {
	set_time_limit(500);
	$percentage=$current/$total*100;
$percentage=number_format($percentage, 0, '.', ',');
	$data = "<div id=\"progress-bar\" cblass=\"all-rounded\">\n";
    $data .= "<div id=\"progress-bar-percentage\" class=\"all-rounded\" style=\"width: $percentage%\">";
        $data .= "$percentage% ($current/$total)";
    $data .= "</div></div>";
echo "<script>
document.getElementById('parentbar').innerHTML=$data
</script>";
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
.all-rounded {
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
}

.spacer {
    display: block;
}

#progress-bar {
    width: 300px;
    margin: 0 auto;
    background: #cccccc;
    border: 3px solid #f2f2f2;
}

#progress-bar-percentage {
    background: #3063A5;
    padding: 5px 0px;
    color: #FFF;
    font-weight: bold;
    text-align: center;
}
</style>

<div id="parentbar1"></div>

</head>
<body >
<div align="center">
  <form id="form1" name="form1" enctype="multipart/form-data" >
    <?php 
//For courses
//delete Courses present
//search for courses on server with current term
//


	function save_image($inPath,$outPath)
{ //Download images from remote server
    $in=    @fopen($inPath, "rb");
    $out=   @fopen($outPath, "wb");
    if($inPath){
	//echo $inPath."<br/>";
	while ($chunk = @fread($in,8192))
    {
        @fwrite($out, $chunk, 8192);
    }
    @fclose($in);
    @fclose($out);
}
}
//for resits




//pictures
if($_POST['students']){

	  $serverlist="select * from students where updates=0  and programme='$_SESSION[uploadprog]'";
$sev=mysql_query($serverlist)or die(mysql_error());
$tot=mysql_num_rows($sev);
if($tot){
											$prog->progress("<h2>UPLOADING STUDENTS RECORDS TO IFCIA....</h2>");

}else {echo "NO DATA TO TRANSMIT";}
while($f=mysql_fetch_array($sev)){	

$surname=mysql_prep($f[surname]);$othernames=mysql_prep($f[othernames]);$indexno=mysql_prep($f[indexno]);$middlename=mysql_prep($f[middlename]);
$loa=mysql_prep($f[loa]);$sex=mysql_prep($f[sex]);$tel=mysql_prep($f[tel]);$programme=mysql_prep($f[programme]);$level=mysql_prep($f[level]);
$dob=mysql_prep($f[dob]);$yrOfAd=mysql_prep($f[yrOfAd]);
 $email=mysql_prep($f[email]);$totalCredits=mysql_prep($f[totalCredits]);$totalGP=mysql_prep($f[totalGP]);$doa=mysql_prep($f[doa]);$yeargroup=mysql_prep($f[yeargroup]);$cgpa=mysql_prep($f[cgpa]);$class=mysql_prep($f['class']);
 $semesters=mysql_prep($f[semesters]);$issues=mysql_prep($f[issues]);

$ins=" surname='$surname', othernames='$othernames',  middlename='$middlename', loa='$loa', sex='$sex', tel='$tel', programme='$programme', level='$level', dob='$dob', yrOfAd='$yrOfAd', email='$email', totalCredits='$totalCredits', totalGP='$totalGP', doa='$doa', yeargroup='$yeargroup', cgpa='$cgpa', class='$class', semesters='$semesters', issues='$issues'";

$post = array('college' => $college,'type'=>'students','indexno'=>$indexno,'data'=>$ins,'user'=>$_POST['headings'],'pass'=>$_POST['footing']);
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$target_url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result=curl_exec($ch);
if($result==9){die("WRONG USERNAME OR PASSWORD");}
	
//echo "<br/>";
	   $insert="Insert into students set $ins, indexno='$f[indexno]',college='$college'  ON DUPLICATE KEY UPDATE $ins ";
    	if($result){$total++; }
	
	mysql_query("update students set updates='1' where id='$f[id]'")or die(mysql_error());
		set_time_limit(500);

	$prog->progress("", $total, $tot);
	//echo "$total/$tot<br/>";
	curl_close ($ch);

	}
// 

}

if($_POST['online_students']){
	
	 $_POST['fe']; $filter=buildall($_POST['fe'],'indexno');

 echo $serverlist="select * from students where stupdate=0 and currentyear!='' $filter ";
$sev=mysql_query($serverlist)or die(mysql_error());
echo $tot=mysql_num_rows($sev);
echo " RECORDS";
if($tot){
											$prog->progress("<h2>UPLOADING STUDENTS RECORDS TO PORTAL....</h2>");

}else {echo "NO DATA TO TRANSMIT";}
while($f=mysql_fetch_array($sev)){	

$surname=mysql_prep($f[surname]);$othernames=mysql_prep($f[othernames]);$indexno=mysql_prep($f[indexno]);$middlename=mysql_prep($f[middlename]);
$loa=mysql_prep($f[loa]);$sex=mysql_prep($f[sex]);$tel=mysql_prep($f[tel]);$programme=mysql_prep($f[programme]);$level=mysql_prep($f[level]);
$dob=mysql_prep($f[dob]);$yrOfAd=mysql_prep($f[yrOfAd]);
 $email=mysql_prep($f[email]);$totalCredits=mysql_prep($f[totalCredits]);$totalGP=mysql_prep($f[totalGP]);$doa=mysql_prep($f[doa]);$yeargroup=mysql_prep($f[yeargroup]);$cgpa=mysql_prep($f[cgpa]);$class=mysql_prep($f['class']);
 $register=mysql_prep($f[register]);$result=mysql_prep($f[result]); $currentyear=mysql_prep($f[currentyear]); $currentterm=mysql_prep($f[currentterm]); $session=mysql_prep($f[session]);

 $ins=" surname='$surname', othernames='$othernames',  middlename='$middlename', loa='$loa', sex='$sex', tel='$tel', programme='$programme', level='$level', dob='$dob', yrOfAd='$yrOfAd', email='$email', totalCredits='$totalCredits', totalGP='$totalGP', doa='$doa', yeargroup='$yeargroup', cgpa='$cgpa', class='$class', register='$register', result='$result',currentyear='$currentyear',currentterm='$currentterm', session='$session'";

$post = array('type'=>'students','indexno'=>$indexno,'data'=>$ins,'user'=>$_POST['headings'],'pass'=>$_POST['footing']);
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$online_target_url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result=curl_exec($ch);
if($result==9){die("WRONG USERNAME OR PASSWORD");}
		curl_close ($ch);

//echo "<br/>";
	  // $insert="Insert into students set $ins, indexno='$f[indexno]',college='$college'  ON DUPLICATE KEY UPDATE $ins ";
    	//echo $result;
		if($result=='correct'){$total++; 
	
	mysql_query("update students set stupdate='1' where id='$f[id]'")or die(mysql_error());
		set_time_limit(500);
	$prog->progress("", $total, $tot);
	//echo "$total/$tot<br/>";
		}
	}
// 

}


if($_POST['online_grades']){
	
		echo "UPLOADING STUDENTS ACADEMIC RECORDS TO SERVER..<br/>";
				
	  $serverlist="select *,quiz1+quiz2+quiz3+quiz4 as quiz from grades  where  program='$_SESSION[uploadprog]' and year='$_SESSION[uploadyear]' and level='$_SESSION[uploadclevel]' and updates=0 ";
$sev=mysql_query($serverlist)or die(mysql_error());
 $tot=mysql_num_rows($sev);
echo "<br/>program:$_SESSION[uploadprog] , year:$_SESSION[uploadyear], level:$_SESSION[uploadclevel]";

if($tot==0){die("<br/> No data to transfer");}
while($f=mysql_fetch_array($sev)){	
$vari="";
	  $ins="coursecode='$f[coursecode]',program='$f[program]', credits='$f[credits]',quiz1='$f[quiz]', term='$f[term]',level='$f[level]',year='$f[year]', yrgp='$f[yrgp]',score='$f[score]', exam='$f[exam]', total='$f[total]', gpoint='$f[gpoint]' ";
	
	
$post = array('type'=>'grades','indexno'=>$f[stuId],'data'=>$ins,'user'=>$_POST['headings'],'pass'=>$_POST['footing']);
  //print_r($post);
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$online_target_url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 $result=curl_exec($ch);
if($result==9){die("WRONG USERNAME OR PASSWORD");}
	//$fa=mysql_query($insert,$out)or die(mysql_error($out));
	if($result=='correct'){
	$total++;
	$prog->progress("", $total, $tot);
	 $bb="update grades set updates='1' where id='$f[id]'";
	mysql_query($bb)or die(mysql_error());

	}
	
	
	}
// 

}

if($_POST['online_courses']){
	
		echo "UPLOADING COURSES MOUNTED FOR THIS SEMESTER TO PORTAL ..<br/>";
				
				echo "YEAR :$_SESSION[uploadyear]";
	  $serverlist="select * from courses  where year='$_SESSION[uploadyear]'  ";
$sev=mysql_query($serverlist)or die(mysql_error());
 $tot=mysql_num_rows($sev);
//echo "sdsdsd";
while($f=mysql_fetch_array($sev)){	
$vari="";

	  $ins="year='$f[year]',term='$f[term]', credits='$f[credits]',code='$f[code]', program='$f[program]',level='$f[level]' ";
	
	
$post = array('type'=>'courses','data'=>$ins,'user'=>$_POST['headings'],'pass'=>$_POST['footing']);
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$online_target_url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 $result=curl_exec($ch);
if($result==9){die("WRONG USERNAME OR PASSWORD");}
	//$fa=mysql_query($insert,$out)or die(mysql_error($out));
	if($result='correct'){
	$total++;
	$prog->progress("", $total, $tot);

	}
	
	
	}
// 

}

if($_POST['DOWNLOADCOURSES']){
	
	
		echo "DOWNLOADING  COURSES REGISTERED FROM SERVER ..<br/>";
				
				echo "YEAR :$_SESSION[uploadyear], SEMESTER:$_SESSION[uploadterm]";
	  $serverlist=$_SESSION[uploadyear];

$post = array('type'=>'downloadgrades','year'=>$_SESSION[uploadyear],'term'=>$_SESSION[uploadterm],'user'=>$_POST['headings'],'pass'=>$_POST['footing']);
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$online_target_url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 $result=curl_exec($ch);

if($result=='9'){die("WRONG USERNAME OR PASSWORD");}
	//$fa=mysql_query($insert,$out)or die(mysql_error($out));
 $result;
	 $result=json_decode($result);
	
		if(is_array($result)){
		
	$fulldata=$result;
	$tot=count($fulldata);
	foreach($fulldata as $variables){

	 $serverlist=$variables;
$post = array('type'=>'downloaddata','currectstuid'=>$variables,'oldstuid'=>$oldstuid,'year'=>$_SESSION[uploadyear],'term'=>$_SESSION[uploadterm],'user'=>$_POST['headings'],'pass'=>$_POST['footing']);
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$online_target_url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 $returned=curl_exec($ch);
//echo $result;
$data=json_decode($returned);

//print_r($data);

foreach($data as $individualrecords){
	 $query="insert into grades set $individualrecords ON DUPLICATE KEY UPDATE $individualrecords ";

	$hjh=mysql_query($query)or die(mysql_error());
	}
	$oldstuid=$variables;
		if($hjh){
			$total++;
			$prog->progress("",$total, $tot);
	
	}

	}
	
	 $laststudent=$fulldata[count($fulldata)-1];

		if($laststudent){
	 $serverlist=$variables;
$post = array('type'=>'downloaddata','currectstuid'=>'','oldstuid'=>$laststudent,'year'=>$_SESSION[uploadyear],'term'=>$_SESSION[uploadterm],'user'=>$_POST['headings'],'pass'=>$_POST['footing']);
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$online_target_url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 $returned=curl_exec($ch);
//echo $returned;
//$data=json_decode($returned);

	
	
	
	}
	}
	
	
	
	}

if($_POST['online_subjects']){
	echo "<br/>";
		echo "UPLOADING ALL COURSES  TO PORTAL ..<br/>";
				
	 echo $serverlist="select * from  coursecode   ";
$sev=mysql_query($serverlist)or die(mysql_error());
 $tot=mysql_num_rows($sev);
//echo "sdsdsd";
while($f=mysql_fetch_array($sev)){	
$vari="";

	  $ins="name='".mysql_prep($f['name'])."',code='$f[code]', credit='$f[credit]' ";
	
	
$post = array('type'=>'coursecode','data'=>$ins,'user'=>$_POST['headings'],'pass'=>$_POST['footing']);
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$online_target_url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 $result=curl_exec($ch);
if($result==9){die("WRONG USERNAME OR PASSWORD");}
	//$fa=mysql_query($insert,$out)or die(mysql_error($out));
	if($result and $result!=9){
	$total++;
	$prog->progress("", $total, $tot);
	//mysql_query("update grades set updates='1' where id='$f[id]'")or die(mysql_error());

	}
	
	
	}
// 

}
if($_POST['online_programmes']){
	
		echo "UPLOADING PROGRAMMES TO PORTAL ..<br/>";
				
	  $serverlist="select * from  programs   ";
$sev=mysql_query($serverlist)or die(mysql_error());
 $tot=mysql_num_rows($sev);
//echo "sdsdsd";
while($f=mysql_fetch_array($sev)){	
$vari="";
	  $ins="pcode='".mysql_prep($f['pcode'])."',name='$f[name]', certificate='$f[certificate]', semtype='$f[semtype]', mother='$f[mother]', department='$f[department]'";
$post = array('type'=>'programs','data'=>$ins,'user'=>$_POST['headings'],'pass'=>$_POST['footing']);
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$online_target_url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 $result=curl_exec($ch);
if($result==9){die("WRONG USERNAME OR PASSWORD");}
	//$fa=mysql_query($insert,$out)or die(mysql_error($out));
	if($result and $result!=9){
	$total++;
	$prog->progress("", $total, $tot);
	//mysql_query("update grades set updates='1' where id='$f[id]'")or die(mysql_error());

	}
	
	
	}
// 

}

if($_POST['grades']){
	
		echo "UPLOADING STUDENTS ACADEMIC RECORDS TO SERVER..<br/>";
				
	  $serverlist="select *,quiz1+quiz2+quiz3+quiz4 as quiz from grades  where  program='$_SESSION[uploadprog]' and year='$_SESSION[uploadyear]' and level='$_SESSION[uploadclevel]' and term='$_SESSION[uploadterm]'  ";
$sev=mysql_query($serverlist)or die(mysql_error());
 $tot=mysql_num_rows($sev);
//echo "sdsdsd";
while($f=mysql_fetch_array($sev)){	
$vari="";
	  $ins="coursecode='$f[coursecode]',program='$f[program]', credits='$f[credits]',quiz1='$f[quiz]', term='$f[term]',level='$f[level]',year='$f[year]', yrgp='$f[yrgp]',score='$f[score]', exam='$f[exam]', total='$f[total]', gpoint='$f[gpoint]' ";
	
	
$post = array('college' => $college,'type'=>'grades','indexno'=>$f[stuId],'data'=>$ins,'user'=>$_POST['headings'],'pass'=>$_POST['footing']);
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$target_url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 $result=curl_exec($ch);
if($result==9){die("WRONG USERNAME OR PASSWORD");}
	//$fa=mysql_query($insert,$out)or die(mysql_error($out));
	if($result and $result!=9){
	$total++;
	$prog->progress("", $total, $tot);
	mysql_query("update grades set updates='1' where id='$f[id]'")or die(mysql_error());

	}
	
	
	}
// 

}
if($_POST['programs']){
			echo "UPLOADING PROGRAMS TO FOR IFCIA...";

//delete * resits from client
//search for resits on server for client by college
 $serverlist="select * from  programs where mother='UCC' ";
$sev=mysql_query($serverlist)or die(mysql_error());
$tot=mysql_num_rows($sev);
while($f=mysql_fetch_array($sev)){
	
$pcode=mysql_prep($f[pcode]);$name=mysql_prep($f[name]);$certificate=mysql_prep($f[certificate]);$duration=mysql_prep($f[duration]);$min_credit=mysql_prep($f[min_credit]);$department=mysql_prep($f[department]);$semesters=mysql_prep($f[semesters]);		
$ins=" `pcode`='$pcode', `name`='$name', `certificate`='$certificate', `duration`='$duration', `min_credit`='$min_credit', `department`='$department', `semesters`='$semesters' ";
	
	$post = array('college' => $college,'type'=>'programs','data'=>$ins,'user'=>$_POST['headings'],'pass'=>$_POST['footing']);

	  $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$target_url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 $result=curl_exec($ch);
if($result==9){die("WRONG USERNAME OR PASSWORD");}

	if($result){$total++;
	//echo $total;
//echo $total;
	$prog = new ProgressBar();
	set_time_limit(500);

		$prog->progress("",$total, $tot);

	}
	}
// 
}

if($_POST['subjects']){
			echo "UPLOADING PROGRAMS TO FOR IFCIA...";

//delete * resits from client
//search for resits on server for client by college
 $serverlist="select * from   coursecode   ";
$sev=mysql_query($serverlist)or die(mysql_error());
$tot=mysql_num_rows($sev);
while($f=mysql_fetch_array($sev)){
	$code=mysql_prep($f[code]); $name=mysql_prep($f[name]); $credit=mysql_prep($f[credit]);
		
$ins=" `code`='$code', `name`='$name', `credit`='$credit' ";
	
	$post = array('college' => $college,'type'=>'cous','data'=>$ins,'user'=>$_POST['headings'],'pass'=>$_POST['footing']);

	  $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$target_url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 $result=curl_exec($ch);

if($result==9){die("WRONG USERNAME OR PASSWORD");}

	if($result){$total++;
	//echo $total;
//echo $total;
	$prog = new ProgressBar();
	set_time_limit(500);

		$prog->progress("",$total, $tot);

	}
	}
// 
}
if($_POST['online_pictures']){

$total='';
	   $serverlist="select * from students  where  picupdates='0'    ";
$sev=mysql_query($serverlist)or die(mysql_error());
  $tot=mysql_num_rows($sev);

if($tot){echo "<br/>UPLOADING STUDENTS PICTURES TO SERVER..";
}else {echo "NO DATA TO TRANSMIT";}
while($f=mysql_fetch_array($sev)){	


	if($f){$total++;
{
//	echo "passed here";
$picid=str_replace("/","",$f[indexno]).".jpg";


	 $file_name = "studentPics/$picid";
	$file_name = realpath($file_name);

	if(file_exists($file_name)){
		
$post = array('type'=>'picture','user'=>$_POST['headings'],'pass'=>$_POST['footing'],'file_contents'=>'@'.$file_name);
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$online_target_url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 $result=curl_exec($ch);
	
	if($result==1){
	$CC="update students set picupdates='1' where indexno='$f[indexno]'";
	mysql_query($CC)or die(mysql_error());
	}
	curl_close ($ch);

	}
	
	//$CC="update students set updatespic='1' where id='$f[id]'";
	//mysql_query($CC,$LOC)or die(mysql_error());

	}}
	
	
	progressBar($total,$tot);

	}
// 



}

$prog->progress("pb-end");
?>
  </form>
</div>
</body>
</html>