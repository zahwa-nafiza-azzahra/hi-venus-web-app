<?php

$dir = new RecursiveDirectoryIterator('resources/views');
$ite = new RecursiveIteratorIterator($dir);

foreach ($ite as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        $original = $content;
        
        $content = preg_replace('/asset\(\'storage\/\'\s*\.\s*\$([a-zA-Z0-9_]+)\-\>image\)/', '\$$1->image_url', $content);
        $content = preg_replace('/asset\(\'storage\/\'\s*\.\s*\$([a-zA-Z0-9_]+)\-\>avatar\)/', '\$$1->avatar_url', $content);
        $content = preg_replace('/asset\(\'storage\/\'\s*\.\s*auth\(\)\-\>user\(\)\-\>avatar\)/', 'auth()->user()->avatar_url', $content);
        $content = preg_replace('/asset\(\'storage\/\'\s*\.\s*\(\\$details\[\'image\'\]\s*\?\?\s*\'\'\)\)/', "(str_starts_with(\$details['image'] ?? '', 'http') ? \$details['image'] : asset('storage/' . (\$details['image'] ?? '')))", $content);
        $content = preg_replace('/asset\(\'storage\/\'\s*\.\s*\$([a-zA-Z0-9_]+)\-\>product\-\>image\)/', '\$$1->product->image_url', $content);
        
        if ($content !== $original) {
            file_put_contents($file->getPathname(), $content);
            echo "Updated: " . $file->getPathname() . "\n";
        }
    }
}
echo "Safe replacement complete.\n";
