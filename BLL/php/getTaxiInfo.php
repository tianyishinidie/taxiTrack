<?php
	$taxi_id=$_POST['license'];
	require '../../DAO/mysqlHelper.php';
	//$taxi_id='453365';
echo $taxi_id.'<br/>';
	$sql="
		select taxi_id,full_load,actual_load,info_date,lon,lat,attr1,attr2,attr3
		from taxi_info
		where
		taxi_id='{$taxi_id}'
	";
	$mh=new mysqlHelper();
	$taxi_info_byid_res=$mh->executeSql($sql);
	if(!$taxi_info_byid_res)
	{
		echo $mh->error();
		exit();
	}
	$wf = fopen("../../Data/one_taxi_info.txt", "w");
	while($perinfo=mysqli_fetch_array($taxi_info_byid_res))
	{
		$line=$perinfo['taxi_id'].',';
		$line.=$perinfo['full_load'].',';
		$line.=$perinfo['actual_load'].',';
		$line.=$perinfo['info_date'].',';
		$line.=$perinfo['lon'].',';
		$line.=$perinfo['lat'].',';
		$line.=$perinfo['attr1'].',';
		$line.=$perinfo['attr2'].',';
		$line.=$perinfo['attr3'];
		//echo $line.'<br/>';
		fwrite($wf,$line);
		fwrite($wf,"\r\n");
	}
	fclose($wf);
	echo 'over';
echo '<br/>';
$shell="python /home/ubuntu/taxiTrack/BLL/python/track2Gpx.py";
//$shell="/usr/bin/python3 /home/ubuntu/taxiTrack/Data/test.py";
//passthru($shell);
$a=exec($shell." 2>&1",$resultData,$ret);
print_r($a);
echo '<script>';
echo 'parent.location.href="../../View/html/index.html";';
echo '</script>';
?>