<div class="wrap">
<div class="icon32" id="icon-edit-comments"><br/></div>
<?php echo "  <h2>" . __( 'Client Testimonials', 'wp-client-testimonials' ) . "</h2>"; ?>

<?php if (isset($_POST['addQuote'])) { ?>
<div class="updated fade" id="message" style="background-color: rgb(255, 251, 204);"><p><?php echo __('New client testimonial added successful', 'wp-client-testimonials' ); ?></p></div>
<?php } ?>

<?php if (isset($_POST['deleteQuote'])) { ?>
<div class="updated fade" id="message" style="background-color: rgb(255, 251, 204);"><p><?php echo __('Client testimonial successfully deleted', 'wp-client-testimonials' ); ?></p></div>
<?php } ?>

<?php echo "  <h3>" . __( 'Add new client testimonial:', 'wp-client-testimonials' ) . "</h3>"; ?>
<p><?php echo __( 'Fill in the form below to add a new client testimonial. All fields are required.', 'wp-client-testimonials' ); ?></p>

<?php
  if (isset($_POST['addQuote'])) {
    $query = sprintf("
      INSERT INTO wp_testimonials
      SET name = '%s', quote = '%s'",
      $_POST['name'], $_POST['quote']
    );
    $result = mysql_query($query);
  };

  if (isset($_POST['deleteQuote'])) {
    foreach($_POST as $id) {
      mysql_query("DELETE FROM wp_testimonials WHERE id='$id'");
    }
  };

?>

<form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
  <table class="form-table">
    <tbody>
      <tr valign="top">
        <th scope="row"><label for="name"><?php echo __('Client Name','wp-client-testimonials'); ?></label></th>
        <td>
          <input type="text" id="name" name="name" class="regular-text" />
        </td>
      </tr>
      <tr valign="top">
        <th scope="row"><label for="quote"><?php echo __('Testimonial','wp-client-testimonials'); ?></label></th>
        <td>
          <textarea class="large-text code" id="quote" cols="50" rows="3" name="quote"></textarea>
        </td>
      </tr>
    <tbody>
  </table>
  <p class="submit">
    <input type="hidden" value="addQuote" name="addQuote" />
    <input type="submit" value="Toevoegen" class="button-primary" name="Submit" />
  </p>
</form>


<?php echo "  <h3>" . __( 'List of testimonials:', 'wp-client-testimonials' ) . "</h3>"; ?>
<p><?php echo __('This is the list of already established and active testimonials as they are shown random on your website.','wp-client-testimonials'); ?></p>

<form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
  <table cellspacing="0" class="widefat fixed">
    <thead>
      <tr class="thead">
        <th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
        <th class="column-username" id="username" scope="col" style="width: 100px;"><?php echo __('Name','wp-client-testimonials'); ?></th>
        <th class="column-name" id="name" scope="col"><?php echo __('Testimonial','wp-client-testimonials'); ?></th>
      </tr>
    </thead>
    <tfoot>
      <tr class="thead">
        <th class="manage-column column-cb check-column" scope="col"><input type="checkbox"/></th>
        <th class="column-username" scope="col" style="width: 100px;"><?php echo __('Name','wp-client-testimonials'); ?></th>
        <th class="column-name" scope="col"><?php echo __('Testimonial','wp-client-testimonials'); ?></th>
      </tr>
    </tfoot>
<?php
  $query = sprintf("SELECT id, name, quote FROM wp_testimonials");
  $results = mysql_query($query); 
  $count = mysql_num_rows($results);
  while ($row = mysql_fetch_array($results)) {
?>
    <tbody class="list:user user-list" id="users">
      <tr class="alternate" id="user-1">
        <th class="check-column" scope="row">
          <input type="checkbox" value="<?php echo $row['id']; ?>" class="administrator" id="<?php echo $row['id']; ?>" name="<?php echo $row['id']; ?>"/>
<!--          <input type="checkbox" name="<?=$row[id]?>" id="<?=$row[id]?>" value="<?=$row[id]?>" /> -->
        </th>
        <td class="username column-username" style="width: 100px;">
          <?php echo $row['name']; ?>
        </td>
        <td class="name column-name">
          <?php echo $row['quote']; ?>
        </td>
      </tr>
    </tbody>
<?php
  }
  if ($count < 1){
?>
    <tbody class="list:user user-list" id="users">
      <tr class="alternate" id="user-1">
        <th class="check-column" scope="row">
        </th>
        <td class="name column-name" colspan="2">
          <?php echo __('There are no testimonials yet','wp-client-testimonials'); ?>
        </td>
      </tr>
    </tbody>
<?php
  };
?>
  </table>
  <p class="submit">
    <input type="hidden" value="deleteQuote" name="deleteQuote" />
    <input type="submit" value="<?php echo __('Delete','wp-client-testimonials'); ?>" class="button-primary" />
  </p>
</form>

</div>