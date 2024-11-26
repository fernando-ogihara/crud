<!-- Listar todos os álbuns -->
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
            <td><?= h($artists[$album->artist_name]) ?></td> <!-- Exibe o nome do artista -->
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

<!-- Formulário para adicionar um novo álbum (inicialmente oculto) -->
<div id="add-album-form" style="display: none;">
    <h2>Add New Album</h2>
    <?= $this->Form->create(null, ['url' => ['action' => 'add']]) ?>
        <?= $this->Form->control('artist_name', [
            'type' => 'select',
            'label' => 'Artist',
            'options' => $artists,  // Lista de artistas obtida da API
            'empty' => 'Select an artist',  // Opção de seleção vazia
            'id' => 'add-artist-id'
        ]) ?>
        <?= $this->Form->control('album_name', ['label' => 'Album name', 'id' => 'add-name']) ?>
        <?= $this->Form->control('album_year', [
            'label' => 'Year',
            'id' => 'add-year', 
            'options' => array_combine(range(date('Y'), 1900), range(date('Y'), 1900)),  // Chave e valor serão o ano
        ]) ?>
        <?= $this->Form->button('Add Album', ['id' => 'add-album-btn-save', 'disabled' => 'disabled']) ?>
    <?= $this->Form->end() ?>
</div>

<!-- Formulário de edição (inicialmente oculto) -->
<div id="edit-album-form" style="display: none;">
    <h2>Edit Album</h2>
    <?= $this->Form->create($album, ['url' => ['action' => 'edit', $album->id]]) ?>
        <?= $this->Form->control('artist_name', [
            'type' => 'select',
            'label' => 'Artist',
            'options' => $artists,  // Lista de artistas obtida da API
            'empty' => 'Select an artist',
            'id' => 'edit-artist-id',
            'data-test' => $album->artist_name
        ]) ?>
        <?= $this->Form->control('album_name', ['label' => 'Album name', 'id' => 'edit-name']) ?>
        <?= $this->Form->control('album_year', [
            'label' => 'Year', 
            'id' => 'edit-year', 
            'options' => array_combine(range(date('Y'), 1900), range(date('Y'), 1900)),
            'default' => $album->album_year // Preenche o ano do álbum corretamente
        ]) ?>
        <?= $this->Form->hidden('id', ['id' => 'edit-id']) ?> <!-- ID oculto para editar -->
        <?= $this->Form->button('Save Changes', ['id' => 'save-changes-btn', 'disabled' => 'disabled']) ?>
    <?= $this->Form->end() ?>
</div>