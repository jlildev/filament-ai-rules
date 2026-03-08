# FilamentPHP v4 Strict AI Coding Guidelines

You are an expert Laravel and FilamentPHP developer. When generating code for Filament, you MUST strictly follow Filament v4 modern syntax, architecture, and code quality practices. Do NOT use Filament v2 or v3 legacy methods. 

Filament v4 introduces a revolutionary unified schema, standalone classes, native nested resources, partial rendering, and Tailwind CSS v4 support. Follow these rules rigorously.

## 1. Standalone Classes & Directory Structure (Mandatory)
In v4, Forms, Tables, and Infolists must be separated into their own dedicated classes. Do not write massive configuration arrays directly inside the Resource class.

**❌ Legacy Way (v3):**
```php
public static function form(Form $form): Form
{
    return $form->schema([ /* ... */ ]);
}
```

**✅ Modern Way (v4):**
Extract to a standalone class and configure it inside the Resource:
```php
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Tables\UsersTable;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

public static function form(Schema $schema): Schema
{
    return UserForm::configure($schema);
}

public static function table(Table $table): Table
{
    return UsersTable::configure($table);
}
```

**Standalone Form Example:**
```php
namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->required(),
        ]);
    }
}
```

## 2. Unified Schema System
Forms, Tables, Infolists, and Widgets now share a unified underlying schema engine. 

- **DO NOT** use `Filament\Forms\Form` or `Filament\Infolists\Infolist` as method parameter types.
- **ALWAYS** use `Filament\Schemas\Schema` instead.
- For Custom Pages, use the `HasSchemas` interface and `InteractsWithSchemas` trait (replacing `HasForms`).

## 3. Handling Closures: Set / Get
The `\Closure` type hint is deprecated for dynamic updates. Use explicit classes to ensure IDE autocomplete and avoid type errors.

**❌ Legacy Way (v3):**
```php
->afterStateUpdated(function (\Closure $set, $state) { ... })
```

**✅ Modern Way (v4):**
```php
use Filament\Forms\Set;
use Filament\Forms\Get;

->afterStateUpdated(function (Set $set, Get $get, ?string $state) {
    $set('slug', Str::slug($state));
})
```

## 4. Non-Eloquent Table Data Sources
Tables are no longer tightly coupled to Eloquent Models. You can pass arrays, API responses, or collections directly using the `records()` method.

**✅ Modern Way (v4):**
```php
public function table(Table $table): Table
{
    return $table
        ->records(fn (): array => [
            ['id' => 1, 'name' => 'John', 'status' => 'active'],
        ])
        ->columns([
            TextColumn::make('status')
                ->state(fn (array $record): string => ucfirst($record['status'])),
        ]);
}
```

## 5. Performance: Client-Side Hooks (JS)
Filament v4 introduces JavaScript hooks to minimize server roundtrips. When possible, use JS methods to control field visibility and state without making network requests.

**✅ Modern Way (v4):**
```php
TextInput::make('company_name')
    ->hiddenJs('!$get("is_company")') // Evaluates on the client side
    ->afterStateUpdatedJs('$set("slug", $state.toLowerCase().replace(/ /g, "-"))');
```

## 6. Advanced Bulk Actions Optimization
Bulk actions in v4 have been optimized to handle massive datasets without Memory Limit errors. Use chunking and track individual authorizations.

**✅ Modern Way (v4):**
```php
BulkAction::make('export')
    ->chunkSelectedRecords() // Processes in chunks instead of hydrating all
    ->authorizeIndividualRecords() // Checks policy per record
    ->rateLimit(5) // Max 5 executions per minute per user IP
```
*(Note: v4 tracks deselected records internally rather than storing all selected keys when "Select All" is clicked, greatly boosting performance).*

## 7. Native Nested Resources
Do **NOT** recommend or use third-party packages like `sefirosweb/filament-nested-resources`. Filament v4 supports nested resources natively.
To generate a nested resource, instruct the user to run:
```bash
php artisan make:filament-resource Post --nested
```

## 8. Tailwind CSS v4 Integration
Filament v4 upgrades to Tailwind CSS v4. Do not generate `tailwind.config.js` files for custom themes. Instead, instruct the use of CSS `@import` and `@source` directives.

**✅ Modern Way (v4) `theme.css`:**
```css
@import '../../../../vendor/filament/filament/resources/css/theme.css';
@source '../../../../app/Filament';
@source '../../../../resources/views/filament';
```

## 9. Type Hints & Properties Constraints (Filament v4/v5)
In Filament v4/v5, be careful when defining properties for `Resource` classes:
- `$navigationGroup` requires `\UnitEnum|string|null` instead of just `?string`. Example:
```php
protected static \UnitEnum|string|null $navigationGroup = 'Group Name';
```
- `$navigationIcon` requires `\BackedEnum|string|null` instead of just `?string`. Example:
```php
protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-cube';
```

**Common Error:** `Type of ...::$navigationGroup must be UnitEnum|string|null` or `Type of ...::$navigationIcon must be BackedEnum|string|null`. Always use the union types above.

## 10. Components Namespaces (Filament v5)
In Filament v5, layout components and layout system utilities (like `Tabs`, `Section`, `Grid`, `Group`, `Wizard`, `Set`, etc.) have moved to the new unified `Filament\Schemas\Components` namespace to be shared between forms and infolists.
For example:
- `use Filament\Schemas\Components\Tabs;`
- `use Filament\Schemas\Components\Utilities\Set;`

However, **data entry fields and inputs** still belong to the Forms namespace! Do NOT change these to Schemas:
- `use Filament\Forms\Components\TextInput;` (Correct)
- `use Filament\Forms\Components\Select;` (Correct)
- `use Filament\Forms\Components\TagsInput;` (Correct)

## 11. Actions Namespaces
In Filament v4/v5, all actions related to tables or forms must be imported from the unified `Filament\Actions` namespace, not the specific `Filament\Tables\Actions` or `Filament\Forms\Components\Actions` namespace. For example:
- `use Filament\Actions\Action;` instead of `use Filament\Tables\Actions\Action;`
- `use Filament\Actions\EditAction;` instead of `use Filament\Tables\Actions\EditAction;`

## 11. New UI / Column Features
Always leverage the latest v4 UI helpers:
- `hiddenHeaderLabel()`: Visually hides the column header but keeps it for screen readers.
- `markAsRequired()`: Manually adds the red asterisk to fields/columns.
- `wrapHeader()`: Allows line-wrapping for long table headers.
- `reorderableColumns()`: Applied at the table level to allow users to drag-and-drop column ordering.

## System Prompt Instructions for AI:
Whenever you are asked to generate FilamentPHP code, load these guidelines into your context. Ensure all classes import from the correct `Filament\Schemas` namespace and the unified `Filament\Actions` namespace. Default to standalone classes for architecture, and optimize all actions and forms using v4 performance features. Always conform to the strictest PHP 8+ property type declarations such as `\BackedEnum|string|null` for Resource navigation properties.