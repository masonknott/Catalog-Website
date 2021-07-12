<nav>
  <!-- REG: 1801459 -->
  <ul class="navbar__menu">
    <li class="logo"><a href="#">Game Catalogue</a></li>
    <li class="navbar__item"><a href="/">Home</a></li>
    <?php
      if (isset($_SESSION['id'])) {
        echo '<li class="navbar__item"><a href="/bookmarks.php">Bookmarks</a></li>';
      }
    ?>
    <li class="navbar__item"><input type="checkbox" id="isDarkTheme" name="isDarkTheme"> Dark Theme
    </li>
    <?php
      if (isset($_SESSION['id'])) {
        echo '<li id="navbar__username" class="navbar__item">Hi '.$_SESSION['uname'].'</li><li class="button"><a href="/logout.php">Sign Out</a></li>';
      } else {
        echo '<a id="btnSignin" class="button" href="/signin.php">Sign In</a>';
      }
    ?>
    <li class="navbar__toggle"><a href="javascript:void(0)">=</a></li>
  </ul>
</nav>
