<?php

namespace Romanlazko\LaravelTelegram\Services;

use Illuminate\Filesystem\Filesystem;

class StubGenerator
{
    public function generateFileFromStub(string $stubPath, string $targetPath, array $replacements = []): bool
    {
        if ($this->exists($stubPath)) {
            $stub = str($this->fileGetContents($stubPath));

            foreach ($replacements as $key => $replacement) {
                $stub = $stub->replace("{{ {$key} }}", $replacement);
            }

            $stub = (string) $stub;

            $this->filePutContents($targetPath, $stub);

            return true;
        }

        return false;
    }

    protected function exists(string $path): bool
    {
        $filesystem = app(Filesystem::class);

        return $filesystem->exists($path);
    }

    protected function fileGetContents(string $path): string
    {
        $filesystem = app(Filesystem::class);

        return $filesystem->get($path);
    }

    protected function filePutContents(string $path, string $content): void
    {
        $filesystem = app(Filesystem::class);

        $this->generateDirectory(dirname($path));

        $filesystem->put($path, $content);
    }

    public function generateDirectory(string $path): string
    {
        $filesystem = app(Filesystem::class);

        if (! $filesystem->isDirectory($path)) {
            $filesystem->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }
}
