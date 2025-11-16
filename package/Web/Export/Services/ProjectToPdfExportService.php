<?php

namespace Web\Export\Services;

use Web\Export\Contracts\PdfExporterInterface;
use Web\Project\Models\Project;

class ProjectToPdfExportService
{

    public function __construct(protected PdfExporterInterface $exporter)
    {
    }

    public function export(Project $project)
    {
        return $this->exporter->exportToPdf($project);
    }
}
