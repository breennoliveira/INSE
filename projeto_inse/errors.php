<?php  if (count($errors) > 0) : ?>
  <div class="error">
  	<p style="color: red"><?php foreach ($errors as $error) : ?>
  	  <?php echo $error ?> </br>
  	<?php endforeach ?></p>
  </div>
<?php  endif ?>