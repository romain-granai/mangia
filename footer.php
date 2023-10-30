<footer class="footer">
    <div class="footer__nl">
    
    <!-- https://gmail.us21.list-manage.com/subscribe/post?u=f9138a877b7e33863a21294d7&amp;id=6d661aae6f&amp;f_id=00e867e1f0 -->
      <form
        action="https://eatmangia.us21.list-manage.com/subscribe/post?u=9479afe50cdc173c1b419fe46&amp;id=5468a45281&amp;f_id=00dfe7e6f0"
        method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate footer__form"
        target="_blank">

        <div class="footer__nl__top">
          <h2 class="footer__nl__title">Let us keep you up to date:</h2>

          <div class="mc-field-group footer__nl__field">
            <label for="mce-EMAIL" class="d-none">Email Address</label>
            <input type="email" name="EMAIL" class="required email footer__nl__input-email" id="mce-EMAIL" required=""
              value="">
          </div>

          <div style="position: absolute; left: -5000px;" aria-hidden="true">
            /* real people should not fill this in and expect good things - do not remove this or risk form bot
            signups */
            <input type="text" name="b_f9138a877b7e33863a21294d7_6d661aae6f" tabindex="-1" value="">
          </div>

          <button type="submit" name="subscribe" id="mc-embedded-subscribe" class="btn footer__nl__submit"
            value="Newsletter" style="--bg-shadow: black"><span>Newsletter</span></button>
        </div>

        <div id="mce-responses" class="clear foot footer__nl__responses">
          <div class="response" id="mce-error-response" style="display: none;"></div>
          <div class="response" id="mce-success-response" style="display: none;"></div>
        </div>





      </form>

      <script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"></script>
      <script
        type="text/javascript">(function ($) { window.fnames = new Array(); window.ftypes = new Array(); fnames[0] = 'EMAIL'; ftypes[0] = 'email'; }(jQuery)); var $mcj = jQuery.noConflict(true);</script>
    </div>

    <a href="<?php echo get_home_url(); ?>" class="footer__logo">
      <svg class="footer__logo__svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1131 276">
        <g>
          <path class="footer__logo__letter"
            d="M210.732,272.532V3.46817H145.08L115.556,161.606c-2.202,11.803-6.154,17.453-10.557,17.453-3.951,0-7.9594-5.706-10.161-17.453L65.6528,3.46817H0V272.532H34.8304V113.555c0-11.803.4516-17.0613,7.9596-17.0613,7.9596,0,11.008,4.8103,13.2096,17.4523l25.1208,158.53H129.612l25.121-158.53c1.75-12.642,4.855-17.4523,12.758-17.4523s7.959,5.2583,7.959,17.0613V272.532Z" />
        </g>
        <g>
          <path class="footer__logo__letter"
            d="M365.014,3.4682V30.98987C356.659,12.64209,337.691,0,314.32,0c-36.128,0-63.902,19.6344-63.902,67.68542V208.315c0,48.051,27.774,67.685,63.902,67.685,23.371,0,42.339-12.642,50.694-30.598v27.074h32.628V3.4682ZM322.28,183.422c-25.121,0-45.838-20.529-45.838-45.422s20.717-45.422,45.838-45.422S368.118,113.107,368.118,138,347.401,183.422,322.28,183.422Z" />
        </g>
        <g>
          <path class="footer__logo__letter"
            d="M599.512,272.532V3.46817H564.681V162.445c0,11.803-.45105,17.061-8.354,17.061-7.50806,0-10.16205-4.81-12.75806-17.453L506.932,3.46817H441.674V272.532h34.831V113.555c0-11.803.451-17.0613,7.959-17.0613,7.96,0,10.162,4.8103,13.21,17.4523l36.58,158.53h65.258Z" />
        </g>
        <g>
          <path class="footer__logo__letter"
            d="M782.414,272.532V125.749H708.35v27.522h45.838c-5.758,17.9-20.717,30.151-43.185,30.151a45.42388,45.42388,0,1,1,0-90.844h67.008V3.46817H711.003c-36.129,0-71.862,23.99752-71.862,72.04862V204.79c0,47.157,26.87,70.762,56.846,70.762,24.218,0,42.338-8.726,53.798-30.15v27.074h32.629Z" />
        </g>
        <g>
          <rect class="footer__logo__letter" x="819.89697" y="3.46817" width="40.53204" height="269.06383" />
        </g>
        <g>
          <path class="footer__logo__letter"
            d="M1014.65,3.4682V30.98987C1006.3,12.64209,987.332,0,963.961,0c-36.129,0-63.903,19.6344-63.903,67.68542V208.315c0,48.051,27.774,67.685,63.903,67.685,23.371,0,42.339-12.642,50.689-30.598v27.074h32.63V3.4682ZM971.92,183.478c-25.12,0-45.838-20.529-45.838-45.422S946.8,92.634,971.92,92.634c25.121,0,45.84,20.529,45.84,45.422S997.041,183.478,971.92,183.478Z" />
        </g>
        <g>
          <path class="footer__logo__letter"
            d="M1125.75,197.015h-36.13v75.573h36.13Zm-.9-35.801L1131,3.52411h-46.29l5.76,157.68989Z" />
        </g>

      </svg>
    </a>

    <?php 
      $footerLegal = get_field('footer_legal', 'option');
      if($footerLegal):
    ?>

    <div class="footer__legal">
      <div class="footer__legal__in">
        <p><?php echo $footerLegal; ?></p>
      </div>
    </div>

    <?php endif; ?>

  </footer>


  
  <?php wp_footer(); ?>
  <script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.min.js" type="module"></script>

</body>

</html>