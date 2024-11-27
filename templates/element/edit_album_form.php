<!-- Form -> edit album (initially hidden) -->
<div id="edit-album-form" style="display: none;">
    <h2>Edit Album</h2>
    <?= $this->Form->create($album, ['url' => ['action' => 'edit', $album->id]]) ?>
        <?= $this->Form->control('artist_name', [
            'type' => 'select',
            'label' => 'Artist',
            'options' => $artists,  // List of artists from the API
            'empty' => 'Select an artist',
            'id' => 'edit-artist-id',
            'data-test' => $album->artist_name
        ]) ?>
        <?= $this->Form->control('album_name', ['label' => 'Album name', 'id' => 'edit-name']) ?>
        <?= $this->Form->control('album_year', [
            'label' => 'Year', 
            'id' => 'edit-year', 
            'options' => array_combine(range(date('Y'), 1900), range(date('Y'), 1900)),
            'default' => $album->album_year // populate with the defined range
        ]) ?>
        <?= $this->Form->hidden('id', ['id' => 'edit-id']) ?> <!-- Hidden ID to edit -->
        <?= $this->Form->button('Save Changes', ['id' => 'save-changes-btn', 'disabled' => 'disabled']) ?>
    <?= $this->Form->end() ?>
</div>