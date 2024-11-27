<!-- Form -> add a new album (initially hidden) -->
<div id="add-album-form" style="display: none;">
    <h2>Add New Album</h2>
    <?= $this->Form->create(null, ['url' => ['action' => 'add']]) ?>
        <?= $this->Form->control('artist_name', [
            'type' => 'select',
            'label' => 'Artist',
            'options' => $artists,  // List of artists from the API
            'empty' => 'Select an artist',
            'id' => 'add-artist-id'
        ]) ?>
        <?= $this->Form->control('album_name', ['label' => 'Album name', 'id' => 'add-name']) ?>
        <?= $this->Form->control('album_year', [
            'label' => 'Year',
            'id' => 'add-year', 
            'options' => array_combine(range(date('Y'), 1900), range(date('Y'), 1900)),  // Key and value are the year
        ]) ?>
        <?= $this->Form->button('Add Album', ['id' => 'add-album-btn-save', 'disabled' => 'disabled']) ?>
    <?= $this->Form->end() ?>
</div>
