<div class="wrap">
  <h1>Black Ribbon</h1>
  <form method="post" action="options.php">
      <?php
          settings_fields("section");
          do_settings_sections("blackribbon-options");
          submit_button();
      ?>
  </form>
</div>
