<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class AlbumsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Defina o nome da tabela e a chave primária
        $this->setTable('albums');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
    }
}
