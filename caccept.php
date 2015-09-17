<?php 
if(mysql_connect('localhost','ioeucp_gbucuser','PRINT45dull')){
	mysql_select_db('ioeucp_gbuc_results');
}

 
$type=$_POST[type];
$data=$_POST[data];
$type=$_POST[type];
$year=$_POST[year];
$term=$_POST[term];
$currectstuid=$_POST[currectstuid];
$oldstuid=$_POST[oldstuid];





$coll=$_POST['college'];
$table=$_POST['type'];
$indexno=$_POST['indexno'];
$data=$_POST['data'];
$user=$_POST['user'];
$pass=md5($_POST['pass']);

if( mysql_num_rows(mysql_query("select * from account where USERNAME='$user' and PASSWORD='$pass'  "))!=1){
echo "9";	
	}else{


if($type=='downloadgrades' and $year)
{
	 $string=" select distinct stuId from grades where year=\"$year\" and term=\"$term\" and updates=0";
	$gg=mysql_query($string)or die(mysql_error());
	while($g=mysql_fetch_array($gg)){
		$studata[]=$g[stuId];
		}
	echo json_encode($studata);
	}
if($type=='downloaddata'  and $year )
{
	if($oldstuid){
		$kl="update grades set updates=1 where year=\"$year\" and term=\"$term\" and stuId=\"$oldstuid\"  ";
	 $updateold=mysql_query($kl)or die(mysql_error());
	}
	if($currectstuid){
	$string=" select *  from grades where year=\"$year\" and term=\"$term\" and stuId=\"$currectstuid\" ";
	$gg=mysql_query($string)or die(mysql_error());
	while($g=mysql_fetch_array($gg)){
		$studata[]="stuId=\"$g[stuId]\",coursecode=\"$g[coursecode]\",program=\"$g[program]\",credits=\"$g[credits]\",quiz1=\"$g[quiz1]\",year=\"$g[year]\",term=\"$g[term]\",level=\"$g[level]\",yrgp=\"$g[yrgp]\" ";
		}
	echo json_encode($studata);
	}
}








if($table=='students'){		
$bb="insert into $table set $data,indexno='$indexno'  ON DUPLICATE KEY UPDATE $data";
mysql_query($bb)or die(mysql_error());
}
if($table=='grades'){		
 $bb="insert into $table set $data,stuid='$indexno'  ON DUPLICATE KEY UPDATE $data";
mysql_query($bb)or die(mysql_error());
}
if($table=='programs'){		
 $bb="insert into $table set $data  ON DUPLICATE KEY UPDATE $data";
mysql_query($bb)or die(mysql_error());
}

if($table=='subjects'){		
 $bb="insert into $table set $data  ON DUPLICATE KEY UPDATE $data";
mysql_query($bb)or die(mysql_error());
}

if($table=='cous'){		
 $bb="insert into $table set $data  ON DUPLICATE KEY UPDATE $data";
mysql_query($bb)or die(mysql_error());
}
if($table=='courses'){		
 $bb="insert into $table set $data  ON DUPLICATE KEY UPDATE $data";
mysql_query($bb)or die(mysql_error());
}


if($table=='coursecode'){		
 $bb="insert into $table set $data  ON DUPLICATE KEY UPDATE $data";
mysql_query($bb)or die(mysql_error());
}

if($table=='picture'){		
 
 $uploadfile = "studentPics/".basename($_FILES['file_contents']['name']);
//echo '<pre>'; 
	if (move_uploaded_file($_FILES['file_contents']['tmp_name'], $uploadfile)) {
	  echo "1";
	} else {
	   echo "0";
	}
 
}
	}

?>