<section class="main content">
  <?php if ( $destination && $destination->id ) : ?>
  <h1>Izmeni destinaciju: <?php echo $destination->name; ?></h1>
  <ul class="admin-submenu clearfix">
    <li>
      <a href="manage-destinations.php">Lista destinacija</a>
    </li>
    <li>
      <a href="add-destination.php">Dodaj destinaciju</a>
    </li>
  </ul>
  <p class="notice">
    <?php echo $this->msg_to_user; ?>
  </p>
  <form action="edit-destination.php" method="post" enctype="multipart/form-data">
     <input type="hidden" name="destination_id" value="<?php echo $destination->id; ?>">
     <input type="hidden" name="image_path" value="<?php echo $destination->image_path; ?>"/>
    <div class="form-field">
      <label for="name">Naslov:</label>
      <input type="text" name="name" id="name" value="<?php echo $destination->name; ?>" />
    </div>
    <div class="form-field">
      <label for="description">Opis:</label>
      <textarea name="description" id="description"><?php echo $destination->description; ?></textarea>
    </div>
    <div class="form-field">
      <label for="image">Fotografija:</label>
      <div class="image-preview"><img src="../img/destinations/<?php echo $destination->image_path;?>"/></div>
      <input type="file" name="image" id="image">
    </div>
    <div class="form-field">
      <label for="total_quota">Ukupno aranžmana:</label>
      <input type="text" name="total_quota" id="total_quota" value="<?php echo $destination->total_quota; ?>"/>
    </div>
    <div class="form-field">
      <label for="date_from">Datum od:</label>
      <input type="text" name="date_from" id="date_from" value="<?php echo $destination->date_from->format('d.m.Y.'); ?>">
    </div>
    <div class="form-field">
      <label for="date_to">Datum od:</label>
      <input type="text" name="date_to" id="date_to" value="<?php echo $destination->date_to->format('d.m.Y.'); ?>">
    </div>
    <div class="form-field">
      <label for="price">Cena:</label>
      <input type="text" name="price" id="price" value="<?php echo $destination->price; ?>"> RSD
    </div>
    <div class="form-field">
      <input type="submit" name="submit" value="Sačuvaj izmene" />
    </div>
  </form>
  <?php else : ?>
     <p class="notice">Destinacija ne postoji.</p>
  <?php endif; ?>
</section>
