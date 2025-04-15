<?php

declare(strict_types=1);

namespace Mountz\HypervelVite;

use Error;

class ViteHelper
{
    protected static string $host = 'http://localhost:5173';
    protected static array $modules = [];
    private static $isHot = false;

    public static function render(array $modules = [])
    {
        self::$modules = $modules;
        self::$isHot = file_exists(public_path('/hot'));
        self::combineModule();

        if (self::$isHot) {
            $tags = '';
            $tags .= '<script type="module" src="' . self::$host . '/@vite/client"></script>';
            foreach (self::$modules as $module) {
                $tags .= '<script type="module" src="' . self::$host . '/' . $module . '"></script>';
            }
            return $tags;
        }

        $manifestPath = public_path('build/manifest.json');
        if (! file_exists($manifestPath)) {
            return '<!-- Vite manifest not found. Run "npm run build" first. -->';
        }

        $manifest = json_decode(file_get_contents($manifestPath), true);
        $tags = '';
        foreach (self::$modules as $module) {
            dd(self::$modules);
            if (! isset($manifest[$module])) {
                continue;
            }
            if (isset($manifest[$module]['css'])) {
                foreach ($manifest[$module]['css'] as $cssFile) {
                    $tags .= '<link rel="stylesheet" href="/build/' . $cssFile . '">';
                }
            }
            $tags .= '<script type="module" src="/build/' . $manifest[$module]['file'] . '"></script>';
        }
        return $tags;
    }

    private static function getViteConfig()
    {
        $path = base_path('vite.config.js');
        if (! file_exists($path)) {
            throw new Error("vite.config.js not found");
        }
        $result = [];
        $content = file_get_contents($path);
        if (preg_match('/input:\s*\[(.*?)\]/s', $content, $matches)) {
            $entriesStr = $matches[1];
            preg_match_all('/[\'"]([^\'"]+)[\'"]/', $entriesStr, $entriesMatches);
            $result['input'] = $entriesMatches[1] ?? [];
        }

        return $result;
    }

    private static function combineModule()
    {
        self::$modules = array_merge(self::$modules, self::getViteConfig()['input'] ?? []);
    }
}
