<section class="main content">
  <?php if ( $destination ) : ?>
  <h1>Rezerviši <?php echo $destination->name; ?></h1>
  <div class="date">
     <time><?php echo $destination->date_from->format('d.m.Y.'); ?></time> - <time><?php echo $destination->date_to->format('d.m.Y.'); ?></time>
  </div>
  <p>Preostalo je još <span class="bold"><?php echo $destination->get_reservatons_left(); ?></span> aranžmana.</p>
  <p class="notice">
    <?php echo $this->msg_to_user; ?>
  </p>
  <form action="rezervisi.php" method="post">
    <input type="hidden" name="destination_id" value="<?php echo $destination->id; ?>">
    <div class="form-field">
      <label for="name">Vaše ime:</label>
      <input type="text" name="customer_name" id="name" value="" />
    </div>
    <div class="form-field">
      <label for="phone">Vaš telefon:</label>
      <input type="text" name="customer_phone" id="phone" value="" />
    </div>
    <div class="form-field">
      <label for="email">Vaš email:</label>
      <input type="email" name="customer_email" id="email" value="" placeholder="npr. vase.ime@primer.rs" />
    </div>
    <div class="form-field">
      <input type="submit" name="submit" value="Rezerviši" />
    </div>
  </form>
  <?php else : ?>
    <p>
      Destinacija ne postoji.
    </p>
  <?php endif; ?>
</section>
