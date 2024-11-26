<p>The album "<?php echo h($album->album_name); ?>" has been <?php echo h($actionType); ?> successfully!</p>
<p>Album Details:</p>
<ul>
    <li><strong>Artist:</strong> <?php echo h($artists[$album->artist_name]); ?></li>
    <li><strong>Year:</strong> <?php echo h($album->album_year); ?></li>
</ul>