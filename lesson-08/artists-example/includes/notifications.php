<?php

  // get the success messages
  $notes['success'] = $notify->get_successes();

  // get the fail messages
  $notes['danger'] = $notify->get_fails();

  // get custom info messages (use this syntax to get custom notification types)
  $notes['info'] = $notify->get_notifications( 'info' );

  // clear the current notifications
  $notify->clear_notifications();

?>

<?php foreach ( $notes as $type => $note ): ?>
  <?php if ( $note ): ?>
    <div class="alert alert-<?= $type ?>">
      <?php foreach ( $note as $n ): ?>
        <p><?= $n ?></p>
      <? endforeach ?>
    </div>
  <?php endif ?>
<?php endforeach ?>