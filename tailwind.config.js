import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    //presets: [preset],
    darkMode: 'media',
    content: [
        // './app/Filament/**/*.php',
        // './resources/views/**/*.blade.php',
        // './vendor/filament/**/*.blade.php',
        './resources/**/*.blade.php', // Standard Laravel Blade views
        './vendor/filament/**/*.blade.php', // All Filament Blade files
        './storage/framework/views/*.php', // Cached Blade views
        './resources/views/filament/**/*.blade.php', // Custom Filament views
        './app/Http/Livewire/**/*.php', // Livewire components
        './resources/views/vendor/filament/**/*.blade.php', // Custom overrides
        './vendor/filament/forms/**/*.blade.php', // Filament form components
        './vendor/filament/tables/**/*.blade.php', // Filament table components
        './vendor/filament/clusters/**/*.blade.php', // Cluster-related Blade components
    ],
    theme: {
        extend: {
            colors: {
                darkred: '#8B0000',
                darkblue: '#00008B',
                darkcyan: '#008B8B',
                darkorange: '#FF8C00',
                cornflowerblue: '#6495ED',
                darkorchid: '#9932CC',
                darkmagenta: '#8B008B',
                darkviolet: '#9400D3',
                darkseagreen: '#8FBC8F',
            }
        }
    },
    variants: {
        extend: {
            backgroundColor: ['hover', 'dark'],
        },
    },
}
