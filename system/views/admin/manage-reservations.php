<section class="main content">
  <h1>Sve rezervacije</h1>
  <div class="reservations">
    <?php
    if ( $reservation->list )
    {
    ?>
    <ol>
    <?php
    foreach ( $reservation->list as $reservation )
    {
      $destination->get_destination( $reservation->destination_id );
    ?>
      <li>
        <b><?php echo $destination->name; ?></b><br>Ime: <?php echo $reservation->customer_name; ?> | Tel: <?php echo $reservation->customer_phone; ?> |  Email: <a href="mailto:<?php echo $reservation->customer_email; ?>"><?php echo $reservation->customer_email; ?></a>
        <div class="control">
           <a data-role="del" href="/admin/delete-reservation/<?php echo $reservation->id; ?>">obriši</a>
        </div>
      </li>
    <?php
    }
    ?>
    </ol>
    <?php
    }
    else
    {
    ?>
    <p>
      Nema rezervacija.
    </p>
    <?php
    }
    ?>
  </div>
</section>
