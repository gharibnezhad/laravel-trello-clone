<?php

namespace Web\Export\Services;

use Web\Board\Models\Board;
use Web\Export\Contracts\JsonExporterInterface;

class BoardExportService
{

    public function __construct(protected JsonExporterInterface $exporter)
    {
    }

    public function export(Board $board)
    {
        return $this->export($board);
    }

}
