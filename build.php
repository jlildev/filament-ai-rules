<?php

/**
 * Filament AI Rules Builder
 * 
 * This script reads from rules.md (the single source of truth)
 * and generates the appropriate files for all supported IDEs.
 */

$sourceFile = __DIR__ . '/rules.md';

if (!file_exists($sourceFile)) {
    die("Error: rules.md not found. Please create it first.\n");
}

$rulesContent = file_get_contents($sourceFile);

// 1. Cursor MDC (.cursor/rules/filament.mdc)
$cursorFrontmatter = <<<EOF
---
description: Strict AI Coding Guidelines for FilamentPHP v4 to ensure modern syntax and architecture.
globs: app/Filament/**/*.php, app/Providers/Filament/**/*.php, app/Livewire/**/*.php
---

EOF;

if (!is_dir(__DIR__ . '/.cursor/rules')) {
    mkdir(__DIR__ . '/.cursor/rules', 0755, true);
}
file_put_contents(__DIR__ . '/.cursor/rules/filament.mdc', $cursorFrontmatter . $rulesContent);
echo "✅ Generated: .cursor/rules/filament.mdc\n";

// 2. Cursor Legacy (.cursorrules)
file_put_contents(__DIR__ . '/.cursorrules', $rulesContent);
echo "✅ Generated: .cursorrules\n";

// 3. GitHub Copilot (.github/copilot-instructions.md)
if (!is_dir(__DIR__ . '/.github')) {
    mkdir(__DIR__ . '/.github', 0755, true);
}
file_put_contents(__DIR__ . '/.github/copilot-instructions.md', $rulesContent);
echo "✅ Generated: .github/copilot-instructions.md\n";

// 4. Windsurf (.windsurfrules)
file_put_contents(__DIR__ . '/.windsurfrules', $rulesContent);
echo "✅ Generated: .windsurfrules\n";

// 5. Google Antigravity (.agent/rules/filament.md)
if (!is_dir(__DIR__ . '/.agent/rules')) {
    mkdir(__DIR__ . '/.agent/rules', 0755, true);
}
file_put_contents(__DIR__ . '/.agent/rules/filament.md', $rulesContent);
echo "✅ Generated: .agent/rules/filament.md\n";

echo "\n🎉 All IDE rule files have been generated successfully from rules.md!\n";
