<header class="header">
  <div class="content clearfix">
    <a href="/">
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
          <a href="/">Početna</a>
        </li>
        <li>
          <a href="/ponude">Sve ponude</a>
        </li>
        <li>
          <a href="/kontakt">Kontakt</a>
        </li>
        <?php
          if (!user_logged_in())
          {
        ?>
        <li class="admin-login">
          <a href="/login">Administracija</a>
        </li>
        <?php
          }
          else
          {
        ?>
        <li class="admin-login">
          <a href="/admin/logout">Odjavi se</a>
        </li>
        <li class="admin-login">
          <a href="/admin/manage-destinations">Destinacije</a>
        </li>
        <li class="admin-login">
          <a href="/admin/manage-reservations">Rezervacije</a>
        </li>
        <?php
          }
        ?>
      </ul>
    </div>
  </nav>
</header>
