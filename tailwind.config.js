import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    //presets: [preset],
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
}
