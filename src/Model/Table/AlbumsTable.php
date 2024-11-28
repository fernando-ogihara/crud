<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class AlbumsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Set the table name and primary key
        $this->setTable('albums');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
    }
}
