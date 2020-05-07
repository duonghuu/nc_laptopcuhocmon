<?php
    $today            =    'Ngày hôm nay';
    $yesterday        =    'Ngày hôm qua';
    $x_month        =    'Tháng hiện tại';
    $x_week            =    'Tuần hiện tại';
    $all            =    'Tổng lượt truy cập';
    
    $locktime        =  15;
    $initialvalue    =    1;
    $records        =    100000;
    
    $s_today        =    1;
    $s_yesterday    =    1;
    $s_all            =    1;
    $s_week            =    0;
    $s_month        =    1;
    
    $s_digit        =    1;
    $disp_type        =     'Mechanical';
    
    $widthtable        =    '60';
    $pretext        =     '';
    $posttext        =     '';
    $locktime        =    $locktime * 60;
    // Now we are checking if the ip was logged in the database. Depending of the value in minutes in the locktime variable.
    $day             =    date('d');
    $month             =    date('n');
    $year             =    date('Y');
    $daystart         =    mktime(0,0,0,$month,$day,$year);
    $monthstart         =  mktime(0,0,0,$month,1,$year);
    // weekstart
    $weekday         =    date('w');
    $weekday--;
    if ($weekday < 0)    $weekday = 7;
    $weekday         =    $weekday * 24*60*60;
    $weekstart         =    $daystart - $weekday;

    $yesterdaystart     =    $daystart - (24*60*60);
    $now             =    time();
    $ip                 =    $_SERVER['REMOTE_ADDR'];
    
    $query             =    "SELECT MAX(id) AS total FROM counter";
    $t = $d->fetch_array($d->query($query));
    $all_visitors     =    $t['total'];
    
    if ($all_visitors !== NULL) {
        $all_visitors += $initialvalue;
    } else {
        $all_visitors = $initialvalue;
    }
    
    // Delete old records
    $temp = $all_visitors - $records;
    
    if ($temp>0){
        $query         =  "DELETE FROM counter WHERE id<'$temp'";
        $d->query($query);
    }
    
    $query             =    "SELECT COUNT(*) AS visitip FROM counter WHERE ip='$ip' AND (tm+'$locktime')>'$now'";
    $vip  = $d->fetch_array($d->query($query));
    $items             =    $vip['visitip'];
    
    if (empty($items))
    {
        $query = "INSERT INTO counter (tm, ip) VALUES ('$now', '$ip')";
        $d->query($query);
    }
    
    $n                 =     $all_visitors;
    $div = 100000;
    while ($n > $div) {
        $div *= 10;
    }

    $query             =    "SELECT COUNT(*) AS todayrecord FROM counter WHERE tm>'$daystart'";
    $todayrec  = $d->fetch_array($d->query($query));
    $today_visitors     =    $todayrec['todayrecord'];
    
    $query             =    "SELECT COUNT(*) AS yesterdayrec FROM counter WHERE tm>'$yesterdaystart' and tm<'$daystart'";
    $yesrec  = $d->fetch_array($d->query($query));
    $yesterday_visitors     =    $yesrec['yesterdayrec'];
        
    $query             =    "SELECT COUNT(*) AS weekrec FROM counter WHERE tm>='$weekstart'";
    $weekrec = $d->fetch_array($d->query($query));
    $week_visitors     =    $weekrec['weekrec'];

    $query             =    "SELECT COUNT(*) AS monthrec FROM counter WHERE tm>='$monthstart'";
    $monthrec  = $d->fetch_array($d->query($query));
    $month_visitors     =    $monthrec['monthrec'];
   
    // $today_visitors
    // $yesterday_visitors
    // $week_visitors
    // $month_visitors
    // $all_visitors
?>