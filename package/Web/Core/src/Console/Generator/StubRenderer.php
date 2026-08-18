<?php

namespace Web\Core\Console\Generator;
use InvalidArgumentException;
class StubRenderer
{

    public function render(array $generatorConfig,array $moduleConfig ,string $name)
    {
        $stubPath = config('generator.stub_path')
            .DIRECTORY_SEPARATOR .$generatorConfig['stub'];

        if (!file_exists($stubPath)) {
            throw new InvalidArgumentException("Stub file not found.");
        }
        $content = file_get_contents($stubPath);

        $namespace = $moduleConfig['namespace'] . '\\' . $generatorConfig['directory'];

        $content = str_replace('DummyNamespace', $namespace, $content);
        return str_replace('DummyClass', $name, $content);
    }
}
