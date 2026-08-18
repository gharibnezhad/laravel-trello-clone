<?php

namespace Web\Core\Console\Support;

class ModuleMigrationPathResolver
{

    /**
     * Resolve migration path for a specific module
     */

    public function resolve(string $module): string
    {
        $moduleConfig = config("modules.$module");


        if (!$moduleConfig) {
            throw new \InvalidArgumentException(
                "Module [$module] not found"
            );
        }

        $path = $moduleConfig['base_path']
            . DIRECTORY_SEPARATOR
            . 'Database'
            . DIRECTORY_SEPARATOR
            . 'Migrations';

        if (!is_dir($path)) {
            throw new \InvalidArgumentException(
                "Migration directory for module [$module] does not exist."
            );
        }

        return $this->toRelativePath($path);
    }

    /**
     * Resolve migration paths for all modules.
     */

    public function resolveAll(): array
    {
        $modules = config('modules', []);

        $paths = [];

        foreach ($modules as $module => $moduleConfig) {

            if (!isset($moduleConfig['base_path'])) {
                continue;
            }

            $path = $moduleConfig['base_path']
                . DIRECTORY_SEPARATOR
                . 'Database'
                . DIRECTORY_SEPARATOR
                . 'Migrations';

            if (!is_dir($path)) {
                continue;
            }

            $paths[] = $this->toRelativePath($path);
        }

        return $paths;
    }


    /**
     * Convert absolute path to a path relative to the application base path.
     */

    private function toRelativePath(string $path): string
    {
        return str_replace(
            base_path() . DIRECTORY_SEPARATOR,
            '',
            $path
        );
    }
}
