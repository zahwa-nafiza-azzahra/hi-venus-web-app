<?php

$dir = new RecursiveDirectoryIterator('resources/views');
$ite = new RecursiveIteratorIterator($dir);

foreach ($ite as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        
        // This regex looks for: asset('storage/' . $variable->property)
        // and replaces it with: $variable->property_url
        // E.g. asset('storage/' . $product->image) -> $product->image_url
        $content = preg_replace('/asset\(\'storage\/\'\s*\.\s*(\$[a-zA-Z0-9_\-\>]+)\->image\)/', '$1->image_url', $content);
        $content = preg_replace('/asset\(\'storage\/\'\s*\.\s*(\$[a-zA-Z0-9_\-\>]+)\->avatar\)/', '$1->avatar_url', $content);
        
        $content = preg_replace('/asset\(\'storage\/\'\s*\.\s*auth\(\)->user\(\)->avatar\)/', 'auth()->user()->avatar_url', $content);
        
        // For arrays like $details['image']
        $content = preg_replace('/asset\(\'storage\/\'\s*\.\s*\(\$details\[\'image\'\] \?\? \'\'\)\)/', "(str_starts_with(\$details['image'] ?? '', 'http') ? \$details['image'] : asset('storage/' . (\$details['image'] ?? '')))", $content);
        
        file_put_contents($file->getPathname(), $content);
    }
}
echo "Replacement complete.\n";
