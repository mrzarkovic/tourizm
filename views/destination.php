<section class="main content">
   <div class="single-destination clearfix">
      <?php if ( isset($destination->name) && !empty($destination->name) ) : ?>
         <h1><?php echo $destination->name; ?></h1>
         <div class="date">
            <time><?php echo $destination->date_from->format('d.m.Y'); ?></time> - <time><?php echo $destination->date_to->format('d.m.Y'); ?></time>
         </div>
         <p>
            <img src="/img/destinations/<?php echo $destination->image_path; ?>" width="400"/>
            <?php echo $destination->description; ?>
         </p>
         <div class="destination-price">
            <?php echo $destination->price; ?> RSD
         </div>
         <a href="/rezervisi/<?php echo $destination->id; ?>">Rezervišite</a>
      <?php else : ?>
         <p>
            Destinacija ne postoji.
         </p>
      <?php endif; ?>
   </div>
</section>
