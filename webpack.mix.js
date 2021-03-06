const mix = require('laravel-mix');

mix
    /* CSS */
    .sass('resources/sass/main.scss', 'public/css/codebase.css')
    .sass('resources/sass/app.scss', 'public/css/frontend/app.css')
    .sass('resources/sass/codebase/themes/corporate.scss', 'public/css/themes/')
    .sass('resources/sass/codebase/themes/earth.scss', 'public/css/themes/')
    .sass('resources/sass/codebase/themes/elegance.scss', 'public/css/themes/')
    .sass('resources/sass/codebase/themes/flat.scss', 'public/css/themes/')
    .sass('resources/sass/codebase/themes/pulse.scss', 'public/css/themes/')
        // Custom //
    .sass('resources/sass/custom/x-editable.scss', 'public/css/pages/')
    .sass('resources/sass/custom/nested.scss', 'public/css/pages/')


/* JS */

    .js('resources/js/codebase/app.js', 'public/js/codebase.app.js')
    .js('resources/js/app.js', 'public/js/laravel.app.js')
    .js('resources/js/stock.js','public/js/stock.js')
    .js('resources/js/cari.js','public/js/cari.js')
    .js('resources/js/invoices.js','public/js/invoices.js')

    // FrontEnd //
    .js('resources/js/frontend/app.js', 'public/js/frontend.js')
    /* Page JS */
    .js('resources/js/pages/tables_datatables.js', 'public/js/pages/tables_datatables.js')
    .js('resources/js/pages/be_comp_nestable.min.js', 'public/js/pages/nestable.js')
    .js('resources/js/pages/x-editable.js', 'public/js/pages/')

    /* Tools */
   // .browserSync('localhost:8000')
    .disableNotifications()

    /* Options */
    .options({
        processCssUrls: false
    });
