# Hyva Compatibility Module

A skeleton module for creating Hyva theme compatibility extensions for Magento 2.

## Installation

### Via Composer (Recommended)

```bash
composer require vendor/magento2-hyva-compatibility
php bin/magento module:enable Hyva_PunchoutGateway
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy
php bin/magento cache:flush
```

### Manual Installation

1. Create directory: `app/code/Hyva/PunchoutGateway`
2. Copy all files to this directory
3. Run:
```bash
php bin/magento module:enable Hyva_PunchoutGateway
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy
php bin/magento cache:flush
```

## Module Structure

```
Vendor_HyvaCompatibility/
├── etc/
│   ├── module.xml                    # Module declaration
│   ├── hyva-themes.xml              # Hyva compatibility declaration
│   └── frontend/
│       └── di.xml                    # Dependency injection configuration
├── view/
│   └── frontend/
│       ├── layout/
│       │   └── catalog_product_view.xml  # Layout XML example
│       └── templates/
│           └── example.phtml         # Template example with Alpine.js
├── ViewModel/
│   └── Example.php                   # ViewModel example
├── registration.php                  # Module registration
└── composer.json                     # Composer configuration
```

## Key Features

### 1. Hyva Theme Declaration
The `etc/hyva-themes.xml` file declares compatibility with Hyva themes.

### 2. ViewModels
Hyva recommends using ViewModels instead of Blocks for business logic:
- Located in `ViewModel/` directory
- Implement `ArgumentInterface`
- Injected into templates via layout XML

### 3. Alpine.js Integration
Templates use Alpine.js for interactivity (Hyva's replacement for KnockoutJS/jQuery):
- Use `x-data` for component initialization
- Use `@click`, `x-show`, `x-text` directives
- Use `x-transition` for animations

### 4. Tailwind CSS
Use Tailwind utility classes for styling (Hyva's CSS framework).

## Customization Guide

### Replace Placeholder Names
1. Replace `Vendor` with your vendor name
2. Replace `HyvaCompatibility` with your module name
3. Update namespace in all PHP files
4. Update composer.json package name

### Adding New ViewModels
1. Create class in `ViewModel/` directory
2. Implement `ArgumentInterface`
3. Inject via layout XML arguments

### Adding Templates
1. Create `.phtml` file in `view/frontend/templates/`
2. Reference in layout XML
3. Use Alpine.js for interactivity
4. Use Tailwind for styling

## Best Practices

1. **Use ViewModels**: Keep business logic in ViewModels, not templates
2. **Alpine.js**: Use for all JavaScript interactivity
3. **Tailwind CSS**: Use utility classes for styling
4. **No jQuery**: Hyva doesn't include jQuery
5. **No RequireJS**: Hyva doesn't use RequireJS
6. **GraphQL Ready**: Consider GraphQL compatibility for headless features

## Resources

- [Hyva Documentation](https://docs.hyva.io/)
- [Hyva GitLab](https://gitlab.hyva.io/hyva-themes)
- [Alpine.js Documentation](https://alpinejs.dev/)
- [Tailwind CSS Documentation](https://tailwindcss.com/)

## Support

For Hyva-specific issues, consult the [Hyva Documentation](https://docs.hyva.io/) or [Hyva Slack Community](https://hyva.io/slack).

## License

OSL-3.0 / AFL-3.0
