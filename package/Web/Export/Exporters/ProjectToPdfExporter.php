<?php

namespace Web\Export\Exporters;

use Web\Export\Contracts\PdfExporterInterface;
use Web\Project\Models\Project;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class ProjectToPdfExporter implements PdfExporterInterface
{

    public function exportToPdf(Project $project)
    {
        $pdf = Pdf::loadView('Project::exports.project',compact('project'))
        ->setPaper('A4')
        ->setOption('encoding', 'UTF-8')
        ->setOption('enable-local-file-access', true);
        return $pdf->download("project-{$project->id}.pdf");
    }

}
