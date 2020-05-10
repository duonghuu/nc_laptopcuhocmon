      
         <div id="slideshow">
           <div class="slideshow-slider-main">
             <?php for($i=0;$i<count($slider);$i++){ ?>
              <div class="slideshow-slider-item">
               <section>
                <a href="<?=$slider[$i]['link']?>" class="slider-link">
                  <img src="<?=_upload_photo_l?>1366x500x1/<?=$slider[$i]['photo']?>"
                   alt="<?=$slider[$i]['ten'.$lang]?>" /> 
                  </a>
                  </section>
                </div>
              <?php } ?>
            </div>
          </div>
        