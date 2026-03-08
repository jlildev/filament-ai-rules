# Filament AI Rules 🤖

This repository contains strict AI coding guidelines for **FilamentPHP v4** to ensure AI coding assistants generate modern, optimized, and architecturally correct code instead of relying on legacy v2 or v3 syntax.

> **⚠️ Note:** This is an initial list of rules and guidelines. It will be continuously updated and expanded based on real-world issues, edge cases, and new challenges encountered during daily development.

## 🏗️ How to Update Rules (Single Source of Truth)

To follow the **DRY (Don't Repeat Yourself)** principle, you do **NOT** need to edit the rule files for each IDE manually. 

This repository uses a PHP build script and GitHub Actions to automate everything.

### Editing Process:
1. Open the **`rules.md`** file in the root directory.
2. Add, modify, or remove any Filament rules in this file.
3. Commit and push your changes to the `main` branch.

**That's it!** 🪄 A GitHub Action will automatically run the `build.php` script, generate the specific formats for Cursor, Copilot, Windsurf, and Antigravity, and push the updated files back to the repository.

*(If you are testing locally, you can just run `php build.php` in your terminal to generate the files).*

---

## 🚀 Supported AI Tools & How They Work

AI coding assistants (like Cursor, GitHub Copilot, Google Antigravity, and Windsurf) use specific hidden files to understand the "Context" or "Rules" of your project before generating code. 

By placing the appropriate file in the root directory of your Laravel/Filament project, the AI will automatically read it and apply the rules on every prompt.

This repository automatically generates ready-made files for the most popular tools:

### 1. Cursor IDE
**File:** `.cursorrules` (Legacy) or `.cursor/rules/*.mdc` (Modern)
Cursor automatically detects these files. The `.mdc` file is highly recommended as it targets specific directories (e.g., `app/Filament/**/*.php`), making the AI context much faster and more accurate.

### 2. Google Antigravity IDE
**File:** `.agent/rules/filament.md`
Google's new agent-first IDE (powered by Gemini 3) relies on the `.agent/rules/` directory to fetch workspace rules. Putting your instructions inside this path ensures that Antigravity's autonomous agents always follow your Filament architecture. *(Note: Depending on your Antigravity version, this might also be `.agents/rules/`).*

### 3. GitHub Copilot
**File:** `.github/copilot-instructions.md`
If you use GitHub Copilot in VS Code or any supported IDE, placing your guidelines inside the `.github` folder under this specific name will inject these rules into Copilot's chat and inline generation context.

### 4. Windsurf IDE (Codeium)
**File:** `.windsurfrules`
Windsurf reads this file from the root directory to enforce project-specific instructions during autocompletion and chat.

---

## 🛠️ How to Include This in Your Projects

You have two practical ways to integrate these rules into your Laravel projects, depending on your workflow.

### Option 1: The Quick Start (Direct Download)
Best for quick or standalone projects where you just want to set up the AI environment fast without linking to this repository permanently.

Run the command that matches your preferred IDE from your project's root directory:

**For Cursor IDE:**
```bash
mkdir -p .cursor/rules
curl -o .cursor/rules/filament.mdc https://raw.githubusercontent.com/jlildev/filament-ai-rules/main/.cursor/rules/filament.mdc
```

**For GitHub Copilot:**
```bash
mkdir -p .github
curl -o .github/copilot-instructions.md https://raw.githubusercontent.com/jlildev/filament-ai-rules/main/.github/copilot-instructions.md
```

**For Google Antigravity:**
```bash
mkdir -p .agent/rules
curl -o .agent/rules/filament.md https://raw.githubusercontent.com/jlildev/filament-ai-rules/main/.agent/rules/filament.md
```

**For Windsurf:**
```bash
curl -o .windsurfrules https://raw.githubusercontent.com/jlildev/filament-ai-rules/main/.windsurfrules
```

---

### Option 2: The Pro Setup (Git Submodules & Symlinks)
Best for SaaS apps and long-term projects. By using a Git Submodule, you maintain a single source of truth. If you update the rules in this main repository, you can easily pull the updates across all your projects.

**Step 1: Add this repository as a submodule**
Run this in your Laravel project's root directory:
```bash
git submodule add https://github.com/jlildev/filament-ai-rules.git ai-rules
```

**Step 2: Create Symlinks**
Link the rule files from the submodule to the locations your IDE expects. Run the commands for the IDEs you use:

*For Cursor:*
```bash
mkdir -p .cursor/rules
ln -s ../../ai-rules/.cursor/rules/filament.mdc .cursor/rules/filament.mdc
```

*For GitHub Copilot:*
```bash
mkdir -p .github
ln -s ../ai-rules/.github/copilot-instructions.md .github/copilot-instructions.md
```

*For Google Antigravity:*
```bash
mkdir -p .agent/rules
ln -s ../../ai-rules/.agent/rules/filament.md .agent/rules/filament.md
```

*For Windsurf:*
```bash
ln -s ai-rules/.windsurfrules .windsurfrules
```

**Step 3: How to update in the future**
Whenever the rules are updated in the main repository, simply run this inside your project to fetch the latest guidelines:
```bash
git submodule update --remote
```

---

### What's Included in the Rules?
- **Standalone Classes Enforcement:** Preventing massive Resource files.
- **Unified Schema Usage:** Using `Filament\Schemas\Schema` instead of older implementations.
- **Modern Closure Types:** Banning `\Closure` in favor of `Set` and `Get`.
- **Client-Side JS Hooks:** Performance improvements.
- **Correct Type Hints:** Fixing PHP 8 enum errors (`\UnitEnum`, `\BackedEnum`).
- **Namespace fixes:** Using `Filament\Actions` instead of specific table/form namespaces.
