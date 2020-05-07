<?php
	$time=time();
	$time_check=$time-600; // Tạo thời gian kiểm tra là 10 phút
	$ip=$_SERVER['REMOTE_ADDR'];

	$tbl_name="user_online";

	$sql="SELECT * FROM $tbl_name WHERE session='$session'";
	$result=$d->query($sql);
	
	if(count($result)==0)
	{
		$d->reset();
		$sql1="INSERT INTO $tbl_name(session,time,ip)VALUES('$session','$time','$ip')";
		$result1=$d->query($sql1);
	}
	else
	{
		$d->reset();
		$sql2="UPDATE $tbl_name SET time='$time' WHERE session = '$session'";
		$result2=$d->query($sql2);
	}

	// nếu quá 10 phút mà ko thấy session này làm việc thì tiến hành xóa
	$d->reset();
	$sql4="DELETE FROM $tbl_name WHERE time<$time_check";
	$result4=$d->query($sql4);

	$d->reset();
	$sql3="SELECT * FROM $tbl_name";
	$result3=$d->query($sql3);

	$count_user_online=count($result3);
?>