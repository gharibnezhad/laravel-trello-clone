<?php

namespace Web\Core\Console\Generator;

class ModuleGenerator
{

    public function __construct(private StubRenderer $stubRenderer,
                                private FileWriter   $fileWriter)
    {
    }

    public function generate(string $type, string $module, string $name)
    {

        $generatorConfig = config("generator.$type");

        if (!$generatorConfig) {
            throw new \InvalidArgumentException("Generator [$type] not found.");
        }

        $moduleConfig = config("modules.$module");

        if (!$moduleConfig) {
            throw new \InvalidArgumentException("Module [$module] not found");
        }

        $content = $this->stubRenderer->render($generatorConfig, $moduleConfig, $name);

        $directory = $moduleConfig['base_path'] . DIRECTORY_SEPARATOR . $generatorConfig['directory'];

        $this->fileWriter->write($directory,$name,$content);
    }
}
