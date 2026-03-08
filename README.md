# Filament AI Rules 🤖

This repository contains strict AI coding guidelines for **FilamentPHP v4** to ensure AI coding assistants generate modern, optimized, and architecturally correct code instead of relying on legacy v2 or v3 syntax.

## 🚀 Supported AI Tools & How They Work

AI coding assistants (like Cursor, GitHub Copilot, and Windsurf) use specific hidden files to understand the "Context" or "Rules" of your project before generating code. 

By placing the appropriate file in the root directory of your Laravel/Filament project, the AI will automatically read it and apply the rules on every prompt.

This repository provides ready-made files for the most popular tools:

### 1. Cursor IDE
**File:** `.cursorrules` (Legacy) or `.cursor/rules/*.mdc` (Modern)
Cursor automatically detects these files. The `.mdc` file is highly recommended as it targets specific directories (e.g., `app/Filament/**/*.php`), making the AI context much faster and more accurate.

### 2. GitHub Copilot
**File:** `.github/copilot-instructions.md`
If you use GitHub Copilot in VS Code or any supported IDE, placing your guidelines inside the `.github` folder under this specific name will inject these rules into Copilot's chat and inline generation context.

### 3. Windsurf IDE (Codeium)
**File:** `.windsurfrules`
Windsurf reads this file from the root directory to enforce project-specific instructions during autocompletion and chat.

---

## 🛠️ How to Include This in Your Projects

You have two options:

### Option 1: Direct Copy (Recommended)
Simply copy the file that matches your AI tool into the root of your new project:
- For Cursor: Copy `.cursor/rules/filament.mdc` into your project's `.cursor/rules/` directory.
- For Copilot: Copy `.github/copilot-instructions.md` into your project's `.github/` folder.
- For Windsurf: Copy `.windsurfrules` to your project root.

### Option 2: Use as a Git Submodule
If you want to maintain a single source of truth and update all your projects when you update the rules here:
```bash
git submodule add https://github.com/jlildev/filament-ai-rules.git ai-rules
```
Then, you can create symlinks (اختصارات) in your project to point to the files inside this folder.

---

### What's Included in the Rules?
- **Standalone Classes Enforcement:** Preventing massive Resource files.
- **Unified Schema Usage:** Using `Filament\Schemas\Schema` instead of older implementations.
- **Modern Closure Types:** Banning `\Closure` in favor of `Set` and `Get`.
- **Client-Side JS Hooks:** Performance improvements.
- **Correct Type Hints:** Fixing PHP 8 enum errors (`\UnitEnum`, `\BackedEnum`).
- **Namespace fixes:** Using `Filament\Actions` instead of specific table/form namespaces.
