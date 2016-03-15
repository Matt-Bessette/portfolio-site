
<header class="centered-navigation" role="banner">
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script>
$(document).ready(function() {
  var menuToggle = $('#js-mobile-menu').unbind();
  $('#js-navigation-menu').removeClass("show");

  menuToggle.on('click', function(e) {
    e.preventDefault();
    $('#js-navigation-menu').slideToggle(function(){
      if($('#js-navigation-menu').is(':hidden')) {
        $('#js-navigation-menu').removeAttr('style');
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
          <a href="javascript:void(0)" class="logo">
            <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_3_dark.png" alt="Logo image">
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

