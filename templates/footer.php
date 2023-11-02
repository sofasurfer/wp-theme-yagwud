
        
        <script>
          const ajax_url = '<?=admin_url('admin-ajax.php');?>';
        </script>
        <script src="<?= get_stylesheet_directory_uri(); ?>/assets/js/lib.js?v=3"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>        
        <script src="<?= get_stylesheet_directory_uri(); ?>/assets/js/default.js?v=3"></script>


        <!-- Matomo -->
        <script type="text/javascript">
        var _paq = _paq || [];
        /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
          var u="https://piwik.sofasurfer.org/";
          _paq.push(['setTrackerUrl', u+'piwik.php']);
          _paq.push(['setSiteId', '35']);
          var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
          g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
        })();
        </script>
        <!-- End Matomo Code -->  

    </body>
</html>