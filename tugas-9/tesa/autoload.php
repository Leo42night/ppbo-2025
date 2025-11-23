<?php
// Minimal PSR-4 autoloader for the local `App\` namespace.
// This keeps the project runnable without Composer.

spl_autoload_register(function (string $class) {
	// Only handle the App\ namespace
	$prefix = 'App\\';
	// Base directory for the App\ namespace should be the 'App' folder
	// within the same PerpustakaanApp directory.
	$baseDir = __DIR__ . '/App/';

	$len = strlen($prefix);
	if (strncmp($prefix, $class, $len) !== 0) {
		// not our namespace
		return;
	}

	// get the relative class name
	$relativeClass = substr($class, $len);

	// replace namespace separators with directory separators
	$file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

	if (file_exists($file)) {
		require $file;
	}
});

// Optionally you can add more mappings here if needed.

