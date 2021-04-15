const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass('app.scss')
       .webpack('app.js');
       
    mix.styles([
        '../vendors/bower_components/morris.js/morris.css',
        '../vendors/bower_components/datatables/media/css/jquery.dataTables.min.css',
        '../vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css',
        '../vendors/bower_components/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
        '../vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css',
        '../vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
        '../vendors/bower_components/bootstrap-daterangepicker/daterangepicker.css',
        '../vendors/bower_components/switchery/dist/switchery.min.css',
        '../vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
        '../vendors/bower_components/fullcalendar/dist/fullcalendar.css',
        '../vendors/bower_components/sweetalert/dist/sweetalert.css',
        '../vendors/bower_components/select2/dist/css/select2.min.css',
        '../vendors/bower_components/jquery-wizard.js/css/wizard.css',
        '../vendors/bower_components/jquery.steps/demo/css/jquery.steps.css',
        '../dist/css/material-design-iconic-font.min.css',
        '../dist/css/simple-line-icons.css',
        '../dist/css/font-awesome.min.css',
        '../dist/css/lightgallery.css',
        '../dist/css/style.css'
    ], 'public/css');
    mix.copy('../dist/fonts', 'public/fonts');
    mix.scripts([
        '../vendors/bower_components/jquery/dist/jquery.min.js',
        '../vendors/bower_components/bootstrap/dist/js/bootstrap.min.js',
        '../vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js',
        '../vendors/bower_components/datatables/media/js/jquery.dataTables.min.js',
        '../dist/js/jquery.slimscroll.js',
        '../vendors/bower_components/moment/min/moment.min.js',
        '../vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js',
        '../dist/js/simpleweather-data.js',
        '../vendors/bower_components/waypoints/lib/jquery.waypoints.min.js',
        '../vendors/bower_components/jquery.counterup/jquery.counterup.min.js',
        '../vendors/jquery.sparkline/dist/jquery.sparkline.min.js',
        '../vendors/bower_components/owl.carousel/dist/owl.carousel.min.js',
        '../vendors/chart.js/Chart.min.js',
        '../vendors/bower_components/raphael/raphael.min.js',
        '../vendors/bower_components/morris.js/morris.min.js',
        '../vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js',
        '../vendors/bower_components/switchery/dist/switchery.min.js',
        '../vendors/bower_components/select2/dist/js/select2.min.js',
        '../vendors/bower_components/moment/min/moment-with-locales.min.js',
        '../vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js',
        '../vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
        '../vendors/bower_components/bootstrap-daterangepicker/daterangepicker.js',
        '../vendors/bower_components/jquery.steps/build/jquery.steps.min.js',
        '../vendors/jquery-ui.min.js',
        '../vendors/bower_components/fullcalendar/dist/fullcalendar.min.js',
        '../vendors/bower_components/sweetalert/dist/sweetalert.min.js',
        '../dist/js/dropdown-bootstrap-extended.js',
        '../dist/js/form-picker-data.js',
        '../dist/js/init.js',
        // '../dist/js/dashboard-data.js',
        'autoNumeric.js',
        'autoNumeric-function.js',
        'function.js',

    ], 'public/js');
});
