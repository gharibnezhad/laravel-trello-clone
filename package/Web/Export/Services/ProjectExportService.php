<?php

namespace Web\Export\Services;

use Web\Export\Contracts\JsonExporterInterface;
use Web\Project\Models\Project;

class ProjectExportService
{

    public function __construct(protected JsonExporterInterface $exporter)
    {
    }

    public function export(Project $project)
    {
        return $this->exporter->export($project);
    }
}
