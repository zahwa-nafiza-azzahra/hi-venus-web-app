<?php
$content = "asset('storage/' . \$product->image)";
$content = preg_replace('/asset\(\'storage\/\'\s*\.\s*\$([a-zA-Z0-9_]+)\-\>image\)/', '\$$1->image_url', $content);
echo $content . "\n";

$content2 = "asset('storage/' . \$user->avatar)";
$content2 = preg_replace('/asset\(\'storage\/\'\s*\.\s*\$([a-zA-Z0-9_]+)\-\>avatar\)/', '\$$1->avatar_url', $content2);
echo $content2 . "\n";

$content3 = "asset('storage/' . auth()->user()->avatar)";
$content3 = preg_replace('/asset\(\'storage\/\'\s*\.\s*auth\(\)\-\>user\(\)\-\>avatar\)/', 'auth()->user()->avatar_url', $content3);
echo $content3 . "\n";

$content4 = "asset('storage/' . (\$details['image'] ?? ''))";
$content4 = preg_replace('/asset\(\'storage\/\'\s*\.\s*\(\\$details\[\'image\'\]\s*\?\?\s*\'\'\)\)/', "(str_starts_with(\$details['image'] ?? '', 'http') ? \$details['image'] : asset('storage/' . (\$details['image'] ?? '')))", $content4);
echo $content4 . "\n";

$content5 = "asset('storage/' . \$firstItem->product->image)";
$content5 = preg_replace('/asset\(\'storage\/\'\s*\.\s*\$([a-zA-Z0-9_]+)\-\>product\-\>image\)/', '\$$1->product->image_url', $content5);
echo $content5 . "\n";
