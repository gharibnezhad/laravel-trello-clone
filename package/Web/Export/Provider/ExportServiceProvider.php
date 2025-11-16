<?php

namespace Web\Export\Provider;

use Illuminate\Support\ServiceProvider;
use Web\Export\Contracts\JsonExporterInterface;
use Web\Export\Contracts\PdfExporterInterface;
use Web\Export\Exporters\ProjectToJsonExporter;
use Web\Export\Exporters\ProjectToPdfExporter;

class ExportServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(JsonExporterInterface::class,ProjectToJsonExporter::class);
        $this->app->bind(PdfExporterInterface::class,ProjectToPdfExporter::class);
    }

    public function boot()
    {

    }
}
