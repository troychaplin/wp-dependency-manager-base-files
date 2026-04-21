# WordPress Monorepo Base

A reusable base setup for WordPress projects using a monorepo architecture with [Turbo](https://turbo.build/) for build orchestration and [pnpm](https://pnpm.io/) workspaces for package management. Includes a starter theme and a block plugin with ESLint, Stylelint, PHPCS, and Webpack pre-configured.

## Prerequisites

- Node.js (version pinned in `.nvmrc`)
- pnpm (version pinned in `package.json` `packageManager` field)
- Composer (for PHP linting and theme/plugin PHP dependencies)
- WordPress >= 6.6

## Project Structure

```
.
├── .github/workflows/         # GitHub Actions CI
├── .husky/                    # Git hooks (pre-commit → lint-staged)
├── wordpress/
│   └── wp-content/
│       ├── plugins/
│       │   └── base-plugin/   # Starter block plugin
│       └── themes/
│           └── base-theme/    # Starter theme
├── .eslintrc.json
├── .prettierrc
├── .stylelintrc.json
├── composer.json
├── package.json               # Root workspace config
├── phpcs.xml.dist
├── pnpm-workspace.yaml
└── turbo.json
```

## Getting Started

1. Clone the repository and place a WordPress install in `wordpress/`.
2. Install dependencies:
   ```bash
   pnpm install
   composer install
   ```
3. Start development mode:
   ```bash
   pnpm run start        # Watch both plugin and theme
   pnpm run start:plugin # Plugin only
   pnpm run start:theme  # Theme only
   ```

## Scripts

### Build

| Script                  | Description                |
| ----------------------- | -------------------------- |
| `pnpm run build`        | Build both plugin and theme |
| `pnpm run build:plugin` | Build plugin only          |
| `pnpm run build:theme`  | Build theme only           |

### Lint & Format

| Script                 | Description                                |
| ---------------------- | ------------------------------------------ |
| `pnpm run lint`        | Run all linters (JS, CSS, PHP)             |
| `pnpm run lint:plugin` | Lint plugin (JS, CSS, PHP)                 |
| `pnpm run lint:theme`  | Lint theme (JS, CSS, PHP)                  |
| `pnpm run format`      | Auto-fix all formatters (JS, CSS, PHP)     |

Granular targets exist per language (e.g. `lint:plugin-js`, `format:theme-css`).

### Maintenance

| Script                  | Description                                        |
| ----------------------- | -------------------------------------------------- |
| `pnpm run clean`        | Remove build artifacts and node_modules            |
| `pnpm run clean:fresh`  | Full reset (removes lockfile, reinstalls, rebuilds) |

### Bundle Analysis

Set `ANALYZE=1` to emit a webpack bundle report into `./bundle-analysis/`:

```bash
ANALYZE=1 pnpm run build:plugin
ANALYZE=1 pnpm run build:theme
```

## Code Standards

- JavaScript — ESLint with `@wordpress/eslint-plugin`
- CSS/SCSS — Stylelint with `@wordpress/stylelint-config/scss`
- PHP — `wp-coding-standards/wpcs` via PHPCS
- Formatting — Prettier (tabs, single quotes, 100-char width)

Pre-commit hook runs `lint-staged` on changed files across all three languages.
