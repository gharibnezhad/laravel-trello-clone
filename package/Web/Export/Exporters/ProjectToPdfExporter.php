<?php

namespace Web\Export\Exporters;

use Barryvdh\DomPDF\Facade\Pdf;
use Web\Export\Contracts\PdfExporterInterface;
use Web\Project\Models\Project;

class ProjectToPdfExporter implements PdfExporterInterface
{

    public function exportToPdf(Project $project)
    {
        $pdf = Pdf::loadView('Project::exports.project',[
            "project" => $project,
        ]);

        return $pdf->download("project-{$project->id}.pdf");
    }

}
