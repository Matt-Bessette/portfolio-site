
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
        <li class="nav-link"><a href="/">Home</a></li>
        <li class="nav-link"><a href="/projects.php">Projects</a></li>
        <li class="nav-link"><a href="javascript:void(0)">Contact</a></li>
        <li class="nav-link logo">
          <a href="/" class="logo">
            <img src="/img/ico.png" alt="Logo image">
          </a>
        </li>
        <li class="nav-link more"><a href="javascript:void(0)">Other Sites</a>
          <ul class="submenu">
            <li><a href="https://github.com/Matt-Bessette">
          <i class="fa fa-github-square fa-lg"></i> GitHub
        </a></li>
        <li><a href="https://www.linkedin.com/in/mattbessette94">
          <i class="fa fa-linkedin-square fa-lg"></i> LinkedIn
        </a></li>
        <li><a href="https://www.facebook.com/matthew.bessette.1">
          <i class="fa fa-facebook-official fa-lg"></i> Facebook (Private)
        </a></li>
          </ul>
        </li>
        <li class="nav-link"><a href='https://github.com/Matt-Bessette/portfolio-site'><i class="fa fa-github-square fa-lg"></i> Site Source</a></li>
      </ul>
    </nav>
  </div>
</header>

