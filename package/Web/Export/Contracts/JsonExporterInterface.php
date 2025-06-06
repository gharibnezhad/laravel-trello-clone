<?php

namespace Web\Export\Contracts;

interface JsonExporterInterface
{
    public function export(mixed $resource);
}
