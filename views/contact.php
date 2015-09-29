<section class="main content">
  <div class="contact-map">
     <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d181139.85102770833!2d20.42032235!3d44.81524535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2srs!4v1443014457554" width="450" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
  </div>
  <h1>Kontakt</h1>
  <p>Adresa: Danijelova 32<br>
     Telefon: 011/123-4-567<br>
     Email: kontakt@tourizm.app</p>
  <p class="notice"><?php echo $this->msg_to_user; ?></p>
  <form action="kontakt.php" method="post" class="contact">
     <div class="form-field">
        <label for="name">Vaše ime:</label>
        <input type="text" name="name" id="name"/>
     </div>
     <div class="form-field">
        <label for="email">Vaš email:</label>
        <input type="email" name="email" id="email" placeholder="npr. vase.ime@primer.rs"/>
     </div>
     <div class="form-field">
        <label for="message">Vaša poruka:</label>
        <textarea name="message" id="message"></textarea>
     </div>
     <div class="form-field">
        <input type="submit" name="submit" value="Pošalji poruku" />
     </div>
  </form>
</section>
