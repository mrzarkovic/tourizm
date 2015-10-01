<section class="main content">
   <h1>Dodaj novu destinaciju</h1>
   <ul class="admin-submenu clearfix">
      <li>
         <a href="/admin/manage-destinations">Lista destinacija</a>
      </li>
   </ul>
   <p class="notice">
      <?php echo $this->msg_to_user; ?>
   </p>
   <form action="/admin/add-destination" method="post" enctype="multipart/form-data">
      <div class="form-field">
         <label for="name">Naslov:</label>
         <input type="text" name="name" id="name" />
      </div>
      <div class="form-field">
         <label for="description">Opis:</label>
         <textarea name="description" id="description"></textarea>
      </div>
      <div class="form-field">
         <label for="image">Fotografija:</label>
         <input type="file" name="image" id="image">
      </div>
      <div class="form-field">
         <label for="total_quota">Ukupno aranžmana:</label>
         <input type="number" name="total_quota" id="total_quota" />
      </div>
      <div class="form-field">
         <label for="date_from">Datum od:</label>
         <input type="text" name="date_from" id="date_from">
      </div>
      <div class="form-field">
         <label for="date_to">Datum od:</label>
         <input type="text" name="date_to" id="date_to">
      </div>
      <div class="form-field">
         <label for="price">Cena:</label>
         <input type="number" name="price" id="price"> RSD
      </div>
      <div class="form-field">
         <input type="submit" name="submit" value="Dodaj destinaciju" />
      </div>
   </form>
</section>
