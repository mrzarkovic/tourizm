<section class="main content">
  <h1>Najnovije destinacije i aranžmani</h1>
  <div class="destinations clearfix">
    <?php
    if ( $destination->list )
    {
     foreach ( $destination->list as $destination )
     {
      ?>
        <div class="destination">
          <div class="destination-image">
            <img src="img/destinations/<?php echo $destination->image_path; ?>" width="200"/>
          </div>
          <h1><?php echo $destination->name; ?></h1>
          <div class="date">
             <time><?php echo $destination->date_from->format('d.m.Y.'); ?></time> - <time><?php echo $destination->date_to->format('d.m.Y.'); ?></time>
          </div>
          <p><?php echo get_excerpt($destination->description); ?></p>
          <div class="destination-price">
            <?php echo $destination->price; ?> RSD
          </div>
          <a href="ponuda.php?id=<?php echo $destination->id; ?>" class="see-more">Pogledajte ponudu</a>
        </div>
        <!-- end of .destination -->
      <?php
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
  <section class="about">
     <h1>O agenciji <span class="tourizm">Tourizm</span> d.o.o.</h1>
     <h2>Putovanja i putešestvije</h2>
     <p>Sed vel sapien fermentum, tincidunt tortor at, sagittis nunc. Etiam eu pharetra sapien. Fusce pretium orci neque, consequat fringilla sapien posuere a. Aenean ornare sapien vitae odio sollicitudin convallis.</p>
     <p>Donec viverra nisl sed consequat feugiat. Proin ornare justo a metus finibus, quis commodo mauris scelerisque. Ut magna nunc, elementum nec augue nec, sodales semper tortor. Vestibulum ullamcorper, sapien quis pulvinar mattis, erat odio congue lacus, vel pharetra velit est vel nulla.</p>
     <p>Cras varius ligula arcu, non suscipit tortor dapibus sed. Nulla vel molestie turpis. Quisque quis eleifend sem. Ut at imperdiet sapien, eu malesuada massa. Vestibulum nec commodo libero, gravida vestibulum nulla.</p>
  </section>
</section>
