<?php
    $d->reset();
    $sql = "select photo,link from #_photo where type='slide' order by stt,id desc";
    $d->query($sql);
    $result_slider=$d->result_array();

    if(!empty($result_slider)) { ?>
        <link rel="stylesheet" href="assets/vegas/css/vegas.css">
        <script src="assets/vegas/js/vegas.js"></script>
        <script type="text/javascript">
            $('#full, body').vegas({
                slides: [
                    <?php for($i=0,$count_result_slider=count($result_slider);$i<$count_result_slider;$i++) { ?>
                        { src: "<?= _upload_photo_l.$result_slider[$i][photo] ?>" },
                    <?php } ?>  
                        ],
                timer: false,
                transition: [ 'fade', 'zoomOut' ],
                transitionDuration: 5000,
                animation: 'random',
                animationDuration: 8500,
                valign: 'center',
                delay: 7000,
            });
        </script>
    <?php } 
?>