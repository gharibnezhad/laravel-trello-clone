<?php

namespace Web\Export\Contracts;

use Web\Project\Models\Project;

interface PdfExporterInterface
{
    public function exportToPdf(Project $project);
}
