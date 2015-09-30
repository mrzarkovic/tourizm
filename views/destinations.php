<section class="main content">
  <h1>Sve ponude</h1>
  <div class="destinations clearfix">
     <div class="search">
        <form action="/ponude" method="post">
           <label for="search">Pretraga: </label>
           <input type="text" name="search" placeholder="npr. Jamajka">
           <input type="submit" name="submit" value="Traži">
        </form>
     </div>
    <?php
    if ( $destination->list )
    {
      $i = 0;
     foreach ( $destination->list as $destination )
     {
      ?>
        <div class="destination">
          <div class="destination-image">
            <img src="/img/destinations/<?php echo $destination->image_path; ?>" width="200"/>
          </div>
          <h1><?php echo $destination->name; ?></h1>
          <div class="date">
             <time><?php echo $destination->date_from->format('d.m.Y.'); ?></time> - <time><?php echo $destination->date_to->format('d.m.Y.'); ?></time>
          </div>
          <p><?php echo get_excerpt($destination->description); ?></p>
          <div class="destination-price">
            <?php echo $destination->price; ?> RSD
          </div>
          <a href="/ponuda/<?php echo $destination->id; ?>" class="see-more">Pogledajte ponudu</a>
        </div>
        <!-- end of .destination -->
      <?php
        $i++;
        if ( $i % 4 == 0 )
           echo '<div class="clearfix"></div>';
      }
    }
    else
    {
    ?>
    <p>
      Trenutno nema destinacija.
    </p>
    <?php
    }
    ?>
  </div>
  <?php if( empty( $_POST['search'] ) ) : ?>
  <div class="pagination">
     <ul class="clearfix">
        <?php if ( $page > 0 ) : ?>
        <li>
           <a href="/ponude/<?php echo $page; ?>">« Prethodna</a>
        </li>
        <?php endif; ?>
        <?php if ( $page + 1 < $max_page ) : ?>
        <li>
           <a href="/ponude/<?php echo $page + 2; ?>">Sledeća »</a>
        </li>
        <?php endif; ?>
     </ul>
  </div>
  <?php endif; ?>
</section>
