<!-- Albums list -->
<div id="new-albums">
    <h2>My Albums App</h2>
    <button id="add-album-btn">+</button>
</div>

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
            <td><?= h($artists[$album->artist_name]) ?></td> <!-- display the artist name -->
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

<!-- Load the add album form element -->
<?= $this->element('add_album_form', ['artists' => $artists]) ?>

<!-- Load the edit album form element -->
<?= $this->element('edit_album_form', ['album' => $album, 'artists' => $artists]) ?>