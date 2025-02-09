<!-- Albums list -->
<div id="new-albums">
    <h2>My Albums App</h2>
    <button id="add-album-btn">+</button>
</div>

<!-- conditional message added 28/11 -->
<?php if (!empty($albums)): ?>
    <table>
    <thead>
        <tr>
            <th>Artist</th>
            <th>Album Name</th>
            <th>Year</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($albums as $album): ?>
        <tr>
            <td><?= h($artists[$album->artist_name] ?? 'Unknown Artist') ?></td> <!-- Display the artist name -->
            <td><?= h($album->album_name) ?></td>
            <td><?= h($album->album_year) ?></td>
            <td>
                <button class="edit-album-btn"
                data-id="<?= h($album->id) ?>"
                data-name="<?= h($album->album_name) ?>"
                data-year="<?= h($album->album_year) ?>"
                data-artist="<?= h($album->artist_name) ?>"
                >Edit</button>
                <button class="delete-album-btn" data-album-id="<?= h($album->id) ?>">Delete</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!-- warning message added 28/11 -->
<?php else: ?>
    <p id="no-albums-message">No albums found. Please add some albums to display them here.</p>
<?php endif; ?>

<!-- Load the add album form element -->
<?= $this->element('add_album_form', ['artists' => $artists]) ?>

<!-- Conditional Added 28/11 -->
<?php if (isset($album)): ?>
    <!-- Load the edit album form element -->
    <?= $this->element('edit_album_form', ['album' => $album, 'artists' => $artists]) ?>    
<?php endif; ?>
