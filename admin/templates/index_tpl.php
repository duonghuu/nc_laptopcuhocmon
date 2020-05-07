<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li class="active">Bảng điều khiển</li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<!-- Date Picker -->
<link rel="stylesheet" href="plugin/datepicker/datepicker3.css">
<!-- datepicker -->
<script src="plugin/datepicker/bootstrap-datepicker.js"></script>

<?php
    /* Set the default timezone */
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    /* Set the date */
    if($_GET['datepicker']!=''){
        $date = strtotime($_GET['datepicker']);
    } else {
        $date = strtotime(date('y-m-d'));
    } 

    $day = date('d', $date);
    $month = date('m', $date);
    $year = date('Y', $date);
    $firstDay = mktime(0,0,0,$month, 1, $year);
    $title = strftime('%B', $firstDay);
    $dayOfWeek = date('D', $firstDay);
    $daysInMonth = cal_days_in_month(0, $month, $year);
    /* Get the name of the week days */
    $timestamp = strtotime('next Sunday');
    $weekDays = array();
    for ($i = 0; $i < 7; $i++) {
        $weekDays[] = strftime('%a', $timestamp);
        $timestamp = strtotime('+1 day', $timestamp);
    }
    $blank = date('w', strtotime("{$year}-{$month}-01"));
?>

<script type="text/javascript">
    jQuery(function () {
        jQuery('#container').highcharts({
        chart: {
            backgroundColor: 'transparent',
            type: 'column'
        },
        title: {
            text: '<b style="font-family:tahoma">THỐNG KÊ TRUY CẬP THÁNG <?php echo $month ?> - <?php echo $year ?></b>'
        },
        subtitle: {
            text: '<span style="font-family:tahoma">ADMINISTRATOR <?=$config_title_index?></span>'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: 0,
                style: {
                    fontSize: '12px',
                    fontFamily: 'Arial'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Số người truy cập'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            headerFormat: '<span style="font-size: 10px;">Ngày {point.key}</span><br/>',
            pointFormat: 'Tổng : <b>{point.y:.1f} Lượt truy cập</b>'
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Population',
            data: [
            <?php for($i = 1; $i <= $daysInMonth; $i++):

                $k = $i+1;
                $begin = strtotime($year.'-'.$month.'-'.$i);
                $end = strtotime($year.'-'.$month.'-'.$k);

                $query             =    "SELECT COUNT(*) AS todayrecord FROM counter WHERE tm>='$begin' and tm<'$end' "; 
                $todayrc  = mysql_fetch_assoc($d->query($query)); 
                $today_visitors     =    $todayrc['todayrecord']; 

            ?>
                ['<?=$i?>', <?=$today_visitors?>],
            <?php endfor; ?>


            ],
            dataLabels: {
                enabled: true,
                rotation: 0,
                color: '#FFFFFF',
                align: 'center',
                format: '{point.y:.1f}',
                style: {
                    fontSize: '12px',
                    fontFamily: 'tahoma'
                }
            }
        }]
        });
        jQuery("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy-mm',
            onClose: function(dateText, inst) { 
                jQuery(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
        });
    });
</script>
<style>
    .ui-datepicker-calendar 
    {
        display: none !important;
    }
    .highcharts-button
    {
        display: none;
    }
</style>

<!-- Begin Panel Hello -->
<div class="maincontent">
	<div class="contentinner content-dashboard">
        <div class="row-fluid">
            <div class="span12">
                <!-- Begin Thống Kê Truy Cập -->
                <!-- <div class="formRow">
                    <div class="formRight" style="position: absolute; z-index: 9; width: 225px;">
                        <form name="supplier" id="validate" class="form" action="" method="get" enctype="multipart/form-data">
                            <input type="text" class="input-xxlarge" style="width: 100px;" id="datepicker" name="datepicker" placeholder="yyyy-mm-dd" value="<?=$_GET['datepicker']?>">
                            <input type="submit" class="btn btn-rounded xemthongke" value="Xem thống kê" />
                        </form>
                    </div>
                    <div class="clear"></div>
                </div> -->
                <div id="container" style="width: 100%; height: 550px; margin: 35px auto 0 auto;"></div>
                <!-- End Thống Kê Truy Cập -->
            </div>
        </div>
	</div>
</div>
<!-- End Panel Hello -->

<script src="js/highcharts/highcharts.src.js"></script>
<script src="js/highcharts/modules/exporting.js"></script>