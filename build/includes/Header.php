<div class='wrapper-for-content-outside-of-footer'>
<header class="centered-navigation" role="banner">

<script>
$(document).ready(function() {
  var menuToggle = $('#js-centered-navigation-mobile-menu').unbind();
  $('#js-centered-navigation-menu').removeClass("show");
  
  menuToggle.on('click', function(e) {
    e.preventDefault();
    $('#js-centered-navigation-menu').slideToggle(function(){
      if($('#js-centered-navigation-menu').is(':hidden')) {
        $('#js-centered-navigation-menu').removeAttr('style');
      }
    });
  });
});

</script>
  <div class="centered-navigation-wrapper">
    <a href="javascript:void(0)" class="centered-navigation-mobile-menu" id="js-centered-navigation-mobile-menu"><i class="fa fa-bars fa-2x"></i></a>
    <nav role="navigation">
      <ul id="js-centered-navigation-menu" class="centered-navigation-menu show">
        <?php 
          $selected = explode('/',$_SERVER['REQUEST_URI'])[1];
        ?>

        <li class="nav-link"><a href="/"><span class="<?php echo $selected === '' ? 'underline' : '' ?>" >Home</span></a></li>
        <li class="nav-link"><a href="/projects"><span class="<?php echo $selected === 'projects' ? 'underline' : '' ?>" >Projects</span></a></li>
        <li class="nav-link"><a href="/contact"><span class="<?php echo $selected === 'contact' ? 'underline' : '' ?>" >Contact</span></a></li>
        <li class="nav-link logo">
          <a href="/" class="logo">
            <img src="/img/ico.png" alt="Logo image">
          </a>
        </li>
        <li class="nav-link more"><a href="javascript:void(0)">Other Sites</a>
          <ul class="submenu">
            <li><a href="https://github.com/Matt-Bessette" target="_blank">
          <i class="fa fa-github-square fa-lg"></i> GitHub
        </a></li>
        <li><a href="https://www.linkedin.com/in/mattbessette94" target="_blank">
          <i class="fa fa-linkedin-square fa-lg"></i> LinkedIn
        </a></li>
          </ul>
        </li>
        <li class="nav-link"><a href='https://github.com/Matt-Bessette/portfolio-site' target="_blank"><i class="fa fa-github-square fa-lg"></i> Site Source</a></li>
      </ul>
    </nav>
  </div>
</header>

