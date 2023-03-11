<?php

namespace App\Repositories;

use App\Models\Document;

class DocumentRepository extends ModelRepository
{
    public function getModel()
    {
        return Document::class;
    }

    public function getRules()
    {
        // TODO: Implement getRules() method.
    }
}
