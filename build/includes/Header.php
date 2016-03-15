<div class="wrapper-for-content-outside-of-footer">
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
<header class="navigation" role="banner">
  <div class="navigation-wrapper">
    <a href="javascript:void(0)" class="navigation-menu-button" id="js-mobile-menu">MENU</a>
    <nav role="navigation">
      <ul id="js-navigation-menu" class="navigation-menu show">
        <li class="nav-link"><a href="">Home</a></li>
        <li class="nav-link"><a href="projects.php">Projects</a></li>
        <li class="nav-link"><a href="javascript:void(0)">Contact</a></li>
        <li class="nav-link more"><a href="javascript:void(0)">Other Sites</a>
          <ul class="submenu">
            <li><a href="https://github.com/Matt-Bessette">
          <i class="fa fa-github-square fa-lg"></i> GitHub
        </a></li>
        <li><a href="https://www.linkedin.com/in/mattbessette94">
          <i class="fa fa-linkedin-square fa-lg"></i> LinkedIn
        </a></li>
        <li><a href="https://twitter.com/blade30912">
          <i class="fa fa-twitter fa-lg"></i> Twitter (Private)
          </a></li>
        <li><a href="https://www.facebook.com/matthew.bessette.1">
          <i class="fa fa-facebook-official fa-lg"></i> Facebook (Private)
        </a></li>
          </ul>
        </li>
      </ul>
    </nav>
    <div class="navigation-tools">
      <nav role="navigation">
      <ul id="js-navigation-menu" class="navigation-menu show">
        <li class="nav-link"><a href='https://github.com/Matt-Bessette/portfolio-site'><i class="fa fa-github-square fa-lg"></i> Site Source</a></li>
      </ul>
    </nav>
      
    </div>
  </div>
</header>
