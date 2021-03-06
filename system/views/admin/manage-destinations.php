<section class="main content">
  <h1>Lista destinacija</h1>
  <ul class="admin-submenu clearfix">
    <li>
      <a href="/admin/add-destination">Dodaj destinaciju</a>
    </li>
  </ul>
  <div class="admin-destinations">
    <?php
    if ( $destinations->list )
    {
     foreach ( $destinations->list as $destination )
     { ?>
      <div class="destination clearfix">
        <h1><?php echo $destination->name; ?> <small>još <span class="bold"><?php echo $destination->get_reservatons_left(); ?></span> aranžmana (<time><?php echo $destination->date_from->format('d.m.Y.'); ?></time> - <time><?php echo $destination->date_to->format('d.m.Y.'); ?></time>)</small></h1>
        <p><?php echo get_excerpt( $destination->description ); ?></p>
        <div class="control">
          <a href="/admin/edit-destination/<?php echo $destination->id; ?>">Izmeni</a>
          <a href="/admin/delete-destination/<?php echo $destination->id; ?>" data-role="del">Obriši</a>
        </div>
        <div class="destination-price">
          <?php echo $destination->price; ?> RSD
        </div>

      </div>
      <!-- end of .destination -->
    <?php
    }
  }
  else
  {
  ?>
  <p>
    Nema destinacija u bazi.
  </p>
  <?php
  }
  ?>
  </div>
</section>
