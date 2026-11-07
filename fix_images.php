
<?php
$files = [];
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('resources/views'));
foreach ($iterator as $file) {
    if ($file->isFile() && str_ends_with($file->getFilename(), '.blade.php')) {
        $files[] = $file->getPathname();
    }
}

foreach ($files as $file) {
    $content = file_get_contents($file);
    $original = $content;

    // {{ asset('storage/' . $profile->avatar) }}
    $content = preg_replace('/\{\{\s*asset\(\'storage\/\'\s*\.\s*\$([a-zA-Z0-9_\-\>]+)->profile->avatar\)\s*\}\}/', '{{ $$1->profile->avatar_url }}', $content);
    $content = preg_replace('/\{\{\s*asset\(\'storage\/\'\s*\.\s*\$profile->avatar\)\s*\}\}/', '{{ $profile->avatar_url }}', $content);
    $content = preg_replace('/\{\{\s*asset\(\'storage\/\'\s*\.\s*Auth::user\(\)->profile->avatar\)\s*\}\}/', '{{ Auth::user()->profile->avatar_url }}', $content);
    
    // {{ asset('storage/' . $media->file_path) }}
    $content = preg_replace('/\{\{\s*asset\(\'storage\/\'\s*\.\s*\$media->file_path\)\s*\}\}/', '{{ $media->file_url }}', $content);
    $content = preg_replace('/\{\{\s*asset\(\'storage\/\'\.\$media->file_path\)\s*\}\}/', '{{ $media->file_url }}', $content);
    
    // {{ asset('storage/' . $bg->content) }}
    $content = preg_replace('/\{\{\s*asset\(\'storage\/\'\s*\.\s*\$bg->content\)\s*\}\}/', '{{ $bg->content_url }}', $content);
    $content = preg_replace('/\{\{\s*asset\(\'storage\/\'\.\$bg->content\)\s*\}\}/', '{{ $bg->content_url }}', $content);

    if ($content !== $original) {
        file_put_contents($file, $content);
        echo "Updated $file\n";
    }
}
echo "Done.\n";
