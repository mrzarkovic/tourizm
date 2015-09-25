<header class="header">
  <div class="content clearfix">
    <a href="/tourizm/index.php">
      <div class="logo">
        Tourizm Logo
      </div>
      <div class="tagline">
        Tourizm <small>Putovanja i Putešestvije</small>
      </div>
    </a>
  </div>
  <nav class="navigation">
    <div class="content">
      <ul class="clearfix">
        <li>
          <a href="/tourizm/index.php">Početna</a>
        </li>
        <li>
          <a href="/tourizm/ponude.php">Sve ponude</a>
        </li>
        <li>
          <a href="/tourizm/kontakt.php">Kontakt</a>
        </li>
        <?php
          if (!$app->user_logged_in())
          {
        ?>
        <li class="admin-login">
          <a href="/tourizm/login.php">Administracija</a>
        </li>
        <?php
          }
          else
          {
        ?>
        <li class="admin-login">
          <a href="/tourizm/admin/logout.php">Odjavi se</a>
        </li>
        <li class="admin-login">
          <a href="/tourizm/admin/manage-destinations.php">Destinacije</a>
        </li>
        <li class="admin-login">
          <a href="/tourizm/admin/manage-reservations.php">Rezervacije</a>
        </li>
        <?php
          }
        ?>
      </ul>
    </div>
  </nav>
</header>
