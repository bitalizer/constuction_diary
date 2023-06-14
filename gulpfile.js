var gulp = require('gulp');
var postcss = require('gulp-postcss');
var uncss = require('postcss-uncss');
var unusedImages = require('gulp-unused-images');
var plumber = require('gulp-plumber');
var imagemin = require('gulp-imagemin');
var elixir = require("laravel-elixir");


// //over-ride laravel-elixir configuration
// elixir.config.assetsPath = 'src';
// elixir.config.publicPath = '';
// elixir.config.viewPath = './';
// elixir.config.sourcemaps = false;


/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 */
elixir.config.publicPath = 'public/assets';
var vendors = 'resources/assets/vendors/';
var resourcesAssets = 'resources/assets/';
var srcCss = resourcesAssets + 'css/';
var srcJs = resourcesAssets + 'js/';

//destination path configuration
var dest = 'public/assets/';
var destFonts = dest + 'fonts/';
var destCss = dest + 'css/';
var destJs = dest + 'js/';
var destImg = dest + 'img/';
var destImages = dest + 'images/';
var destVendors= dest + 'vendors/';


/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

var paths = {
    'jquery': vendors + 'jquery/dist/',
    'bootstrap': vendors + 'bootstrap/dist/',
    'fontawesome': vendors + 'font-awesome/',
    'tether': vendors + 'tether/dist/',
    'animate': vendors + 'animate.css/',
    'autosize': vendors + 'jquery-autosize/',
    'bootstrap_datepicker': vendors + 'bootstrap-datepicker/dist/',
    'bootstrap_daterangepicker': vendors + 'bootstrap-daterangepicker/',
    'bootstrap_switch': vendors + 'bootstrap-switch/dist/',
    'jquery_tagsinput': vendors + 'jquery.tagsinput/src/',
    'bootstrap_timepicker': vendors + 'bootstrap-timepicker/',
    'bootstrap_calendar': vendors + 'bootstrap_calendar/bootstrap_calendar/',
    'chosen': vendors + 'chosen/',
    'countup': vendors + 'countUp.js/dist/',
    'datatables': vendors + 'datatables.net/',
    'fullcalendar': vendors + 'fullcalendar/dist/',
    'inputlimiter': vendors + 'jquery-inputlimiter/',
    'jasny_bootstrap': vendors + 'jasny-bootstrap/',
    'jquery_uniform': vendors + 'jquery.uniform/',
    'modal': vendors + 'ModalWindowEffects/',
    'moment': vendors + 'moment/',
    'noty': vendors + 'noty/',
    'rangy': vendors + 'rangy-1.3/',
    'bootstrap_slider': vendors + 'seiyria-bootstrap-slider/dist/',
    'select2': vendors + 'select2/dist/',
    'slimscroll': vendors +'jquery-slimscroll/',
    'twitter_bootstrap_wizard': vendors + 'twitter-bootstrap-wizard/',
    'validation_engine': vendors +'jQuery-Validation-Engine/',
    'jquery_validation': vendors +'jquery-validation/dist/',
    'knob': vendors + 'jquery-knob/',
    'datatablesbs' : vendors + 'datatables.net-bs/',
    'datatablesbutton' : vendors + 'datatables.net-buttons/',
    'datatablesbsbuttons' : vendors + 'datatables.net-buttons-bs/',
    'datatablescolreorder' : vendors + 'datatables.net-colreorder/',
    'datatablescolreorderbs' : vendors + 'datatables.net-colreorder-bs/',
    'datatablesrowreorder' : vendors + 'datatables.net-rowreorder/',
    'datatablesrowreorderbs' : vendors + 'datatables.net-rowreorder-bs/',
    'datatablesscroll' : vendors + 'datatables.net-scroller/',
    'datatablesscrollbs' : vendors + 'datatables.net-scroller-bs/',
    'bootstrapValidator' : vendors + 'bootstrapValidator/dist/',
    'validval': vendors + 'jQuery.validVal/',
    'summernote': vendors + 'summernote/dist/',
    'sortable': vendors + 'Sortable/',
    'inputmask': vendors + 'jquery.inputmask/dist/',
    'radio_css': vendors + 'radiobox.css/dist/',
    'checkbox_css': vendors + 'checkbox.css/dist/',
    'datetimepicker': vendors + 'datetimepicker/build/',
    'j_timepicker' : vendors + 'jt.timepicker/',
    'sweetalert': vendors + 'sweetalert2/dist/',
    'bootstrap_tagsinput': vendors + 'bootstrap-tagsinput/dist/',
    'jquery_newsTicker' : vendors + 'jquery.newsTicker/js/',
    "fileinput": vendors + 'bootstrap-fileinput/',
    "jScrollPane":vendors + 'jScrollPane/',
    "tooltipster":vendors + 'tooltipster/dist/',
    "multiselect":vendors + 'multiselect/',
    'datatablesresponsive': vendors + 'datatables-responsive/',
    'clockpicker': vendors + 'clockpicker/dist/',
};

elixir(function(mix) {

    // Copy fonts straight to public
    mix.copy(paths.bootstrap + 'fonts', destFonts);

    mix.copy(paths.bootstrap + 'fonts', destFonts);
    mix.copy(paths.fontawesome + 'fonts', destFonts);

    //COPY CSS,JS AND IMAGES TO PUBLIC
    mix.copy(srcCss ,destCss);
    mix.copy(resourcesAssets + 'img',destImg);
    mix.copy(srcJs ,destJs);

    //bootstrap
    mix.copy(paths.bootstrap + 'js/bootstrap.min.js', destJs);

    //fontawesome
    mix.copy(paths.fontawesome + 'css/font-awesome.min.css', destCss);
    mix.copy(paths.fontawesome + 'fonts', destFonts);

    //jquery
    mix.copy(paths.jquery + 'jquery.min.js', destJs);

    //tether
    mix.copy(paths.tether + 'js/tether.min.js',destJs);
    //jquery.newsTicker
    mix.copy(paths.jquery_newsTicker + 'newsTicker.js',destVendors + 'jquery_newsTicker/js');

    // animate
    mix.copy(paths.animate + 'animate.min.css',  destVendors + 'animate/css');

    // animate
    mix.copy(paths.autosize + 'jquery.autosize.min.js',  destVendors + 'autosize/js');

    // bootstrap-datepicker
    mix.copy(paths.bootstrap_datepicker + 'js/bootstrap-datepicker.min.js', destVendors + 'datepicker/js');
    mix.copy(paths.bootstrap_datepicker + 'css/bootstrap-datepicker.min.css', destVendors + 'datepicker/css');
    mix.copy(paths.bootstrap_datepicker + 'css/bootstrap-datepicker3.css', destVendors + 'datepicker/css');

    // daterange picker
    mix.copy(paths.bootstrap_daterangepicker + 'daterangepicker.js', destVendors + 'daterangepicker/js');
    mix.copy(paths.bootstrap_daterangepicker + 'daterangepicker.css',  destVendors + 'daterangepicker/css');

    // bootstrap switch
    mix.copy(paths.bootstrap_switch + 'css/bootstrap3/bootstrap-switch.min.css',  destVendors + 'bootstrap-switch/css');
    mix.copy(paths.bootstrap_switch + 'js/bootstrap-switch.min.js',  destVendors + 'bootstrap-switch/js');

    // bootstrap tagsinput
    mix.copy(paths.jquery_tagsinput + 'jquery.tagsinput.css',  destVendors + 'jquery-tagsinput/css');
    mix.copy(paths.jquery_tagsinput + 'jquery.tagsinput.js',  destVendors + 'jquery-tagsinput/js');

    // bootstrap-timepicker
    mix.copy(paths.bootstrap_timepicker + 'css/bootstrap-timepicker.min.css',  destVendors + 'bootstrap-timepicker/css');
    mix.copy(paths.bootstrap_timepicker + 'js/bootstrap-timepicker.min.js',  destVendors + 'bootstrap-timepicker/js');

    //sweetalert
    mix.copy(paths.sweetalert + 'sweetalert2.min.css', destVendors + 'sweetalert/css');
    mix.copy(paths.sweetalert + 'sweetalert2.min.js', destVendors + 'sweetalert/js');

    //chosen
    mix.copy(paths.chosen + 'chosen.jquery.js', destVendors + 'chosen/js');
    mix.copy(paths.chosen + 'chosen.css', destVendors + 'chosen/css');
    mix.copy(paths.chosen + 'chosen-sprite.png', destVendors + 'chosen/css');
    mix.copy(paths.chosen + 'chosen-sprite@2x.png', destVendors + 'chosen/css');

    // countUp js
    mix.copy(paths.countup + 'countUp.min.js',  destVendors + 'countUp.js/js');


    // datatables
    mix.copy(paths.datatables + 'js/jquery.dataTables.min.js', destVendors + 'datatables/js');
    mix.copy(paths.datatablesbs + 'js/dataTables.bootstrap.min.js', destVendors + 'datatables/js');
    mix.copy(paths.datatablesbs + 'css/dataTables.bootstrap.min.css', destVendors + 'datatables/css');
    mix.copy(paths.datatablesbutton + 'js/buttons.print.min.js', destVendors + 'datatables/js');
    mix.copy(paths.datatablesbutton + 'js/dataTables.buttons.min.js', destVendors + 'datatables/js');
    mix.copy(paths.datatablesbsbuttons + 'css/buttons.bootstrap.css', destVendors + 'datatables/css');
    mix.copy(paths.datatablesbsbuttons + 'js/buttons.bootstrap.min.js', destVendors + 'datatables/js');
    mix.copy(paths.datatablescolreorder + 'js/dataTables.colReorder.min.js', destVendors + 'datatables/js');
    mix.copy(paths.datatablescolreorderbs + 'css/colReorder.bootstrap.min.css', destVendors + 'datatables/css');
    mix.copy(paths.datatablesrowreorder + 'js/dataTables.rowReorder.min.js', destVendors + 'datatables/js');
    mix.copy(paths.datatablesbutton + 'js/buttons.html5.min.js', destVendors + 'datatables/js');
    mix.copy(paths.datatablesbutton + 'js/buttons.colVis.min.js', destVendors + 'datatables/js');
    mix.copy(paths.datatablesbutton + 'js/buttons.print.min.js', destVendors + 'datatables/js');
    mix.copy(paths.datatablesrowreorderbs + 'css/rowReorder.bootstrap.css', destVendors + 'datatables/css');
    mix.copy(paths.datatablesscroll + 'js/dataTables.scroller.min.js', destVendors + 'datatables/js');
    mix.copy(paths.datatablesscrollbs + 'css/scroller.bootstrap.min.css', destVendors + 'datatables/css');

    // fullcalendar
    mix.copy(paths.fullcalendar + 'fullcalendar.min.css', destVendors + 'fullcalendar/css');
    mix.copy(paths.fullcalendar + 'fullcalendar.print.css', destVendors + 'fullcalendar/css');
    mix.copy(paths.fullcalendar + 'fullcalendar.min.js', destVendors + 'fullcalendar/js');
    mix.copy(paths.fullcalendar + 'locale/et.js', destVendors + 'fullcalendar/js/locale');


    //jasny-bootstrap
    mix.copy(paths.jasny_bootstrap + 'dist/css/jasny-bootstrap.min.css',  destVendors + 'jasny-bootstrap/css');
    mix.copy(paths.jasny_bootstrap + 'dist/js/jasny-bootstrap.min.js',  destVendors + 'jasny-bootstrap/js');
    mix.copy(paths.jasny_bootstrap + 'js/inputmask.js',  destVendors + 'jasny-bootstrap/js');

    // advanced modals
    mix.copy(paths.modal + 'css',  destVendors + 'modal/css');
    mix.copy(paths.modal + 'js/',  destVendors + 'modal/js');

    // moment
    mix.copy(paths.moment + 'min/moment.min.js',  destVendors + 'moment/js');

    // datatables responsive
    mix.copy(paths.datatablesresponsive + 'css/responsive.dataTables.scss', destVendors + 'datatables/css');
    mix.copy(paths.datatablesresponsive + 'js/dataTables.responsive.js', destVendors + 'datatables/js');

    // seiyria-bootstrap-slider
    mix.copy(paths.bootstrap_slider + 'css/bootstrap-slider.min.css',  destVendors + 'bootstrap-slider/css');
    mix.copy(paths.bootstrap_slider + 'bootstrap-slider.js',  destVendors + 'bootstrap-slider/js');

    //select2
    mix.copy(paths.select2 + 'css/select2.min.css',  destVendors + 'select2/css');
    mix.copy(paths.select2 + 'js/select2.js',  destVendors + 'select2/js');

    //twitter bootstrapWizard
    mix.copy(paths.twitter_bootstrap_wizard + 'jquery.bootstrap.wizard.min.js',  destVendors + 'twitter-bootstrap-wizard/js');

    // bootstrap_calendar
    mix.copy(paths.bootstrap_calendar + 'css/bootstrap_calendar.css',  destVendors + 'bootstrap_calendar/css');
    mix.copy(paths.bootstrap_calendar + 'js/bootstrap_calendar.min.js',  destVendors + 'bootstrap_calendar/js');

    //inputlimiter
    mix.copy(paths.inputlimiter + 'jquery.inputlimiter.css',  destVendors + 'inputlimiter/css');
    mix.copy(paths.inputlimiter + 'jquery.inputlimiter.js',  destVendors + 'inputlimiter/js');

    //jquery.uniform
    mix.copy(paths.jquery_uniform + 'jquery.uniform.js',  destVendors + 'jquery.uniform/js');

    //validation engine
    mix.copy(paths.validation_engine+ 'css/validationEngine.jquery.css',  destVendors + 'jquery-validation-engine/css');
    mix.copy(paths.validation_engine+ 'js/jquery.validationEngine.js',  destVendors + 'jquery-validation-engine/js');
    mix.copy(paths.validation_engine+ 'js/languages/jquery.validationEngine-en.js',  destVendors + 'jquery-validation-engine/js');

    //jquery validation
    mix.copy(paths.jquery_validation+ 'jquery.validate.js',  destVendors + 'jquery-validation/js');

    // knob jquery
    mix.copy(paths.knob+ 'js/jquery.knob.js',  destVendors + 'Knob/js');

    // bootstrapvalidator
    mix.copy(paths.bootstrapValidator + 'css/bootstrapValidator.min.css',  destVendors + 'bootstrapvalidator/css');
    mix.copy(paths.bootstrapValidator + 'js/bootstrapValidator.min.js',  destVendors + 'bootstrapvalidator/js');

    // bootstrapvalidator
    mix.copy(paths.summernote + 'summernote.css',  destVendors + 'summernote/css');
    mix.copy(paths.summernote + 'summernote.min.js',  destVendors + 'summernote/js');

    //Sortable
    mix.copy(paths.sortable + 'Sortable.min.js',  destVendors + 'sortable/js');

    //inputmask
    mix.copy(paths.inputmask + 'inputmask/inputmask.js',  destVendors + 'inputmask/js');
    mix.copy(paths.inputmask + 'inputmask/jquery.inputmask.js',  destVendors + 'inputmask/js');
    mix.copy(paths.inputmask + 'inputmask/inputmask.extensions.js',  destVendors + 'inputmask/js');
    mix.copy(paths.inputmask + 'inputmask/inputmask.phone.extensions.js',  destVendors + 'inputmask/js');
    mix.copy(paths.inputmask + 'inputmask/inputmask.date.extensions.js',  destVendors + 'inputmask/js');
    mix.copy(paths.inputmask + 'jquery.inputmask.bundle.js', destVendors + 'inputmask/js');

    //wow
    mix.copy(paths.checkbox_css + 'css/checkbox.min.css',  destVendors + 'checkbox_css/css');

    //bootstrap-datetimepicker
    mix.copy(paths.datetimepicker + 'jquery.datetimepicker.full.min.js',  destVendors + 'datetimepicker/js');
    mix.copy(paths.datetimepicker + 'jquery.datetimepicker.min.css', destVendors + 'datetimepicker/css');

    //jt timepicker
    mix.copy(paths.j_timepicker + 'jquery.timepicker.min.js',  destVendors + 'j_timepicker/js');
    mix.copy(paths.j_timepicker + 'jquery.timepicker.css', destVendors + 'j_timepicker/css');

    //bootstrap_tagsinput
    mix.copy(paths.bootstrap_tagsinput + 'bootstrap-tagsinput.css', destVendors + 'bootstrap-tagsinput/css');
    mix.copy(paths.bootstrap_tagsinput + 'bootstrap-tagsinput.js', destVendors + 'bootstrap-tagsinput/js');

    //clockpicker
    mix.copy(paths.clockpicker + 'jquery-clockpicker.css', destVendors + 'clockpicker/css');
    mix.copy(paths.clockpicker + 'jquery-clockpicker.min.js', destVendors + 'clockpicker/js');

    //fileinput
    mix.copy(paths.fileinput + 'css/fileinput.min.css', destVendors + 'fileinput/css');
    mix.copy(paths.fileinput + 'js/fileinput.min.js', destVendors + 'fileinput/js');
    mix.copy(paths.fileinput + 'themes/fa/theme.js', destVendors + 'fileinput/js');
    mix.copy(paths.fileinput + 'img/loading.gif', destVendors + 'fileinput/img');

    // jScrollPane
    mix.copy(paths.jScrollPane + 'style/jquery.jscrollpane.css', destVendors + 'jScrollPane/css');
    mix.copy(paths.jScrollPane + 'script/mwheelIntent.js', destVendors + 'jScrollPane/js');
    mix.copy(paths.jScrollPane + 'script/jquery.mousewheel.js', destVendors + 'jScrollPane/js');
    mix.copy(paths.jScrollPane + 'script/jquery.jscrollpane.min.js', destVendors + 'jScrollPane/js');

    // tooltipster
    mix.copy(paths.tooltipster + 'css/plugins/tooltipster/sideTip/themes', destVendors + 'tooltipster/css');
    mix.copy(paths.tooltipster + 'css/tooltipster.bundle.min.css', destVendors + 'tooltipster/css');
    mix.copy(paths.tooltipster + 'js/tooltipster.bundle.min.js', destVendors + 'tooltipster/js');

    /*
     browserSync for auto-reloading browser on changes
     */
    mix.browserSync({
        files: ['**/*.html', '**/*.css', '**/*.js'],
        proxy: undefined,
        server: {
            baseDir: "./"
        }
    });

    mix.sass('admire.scss',destCss +'custom.css');

    mix.sass('bootstrap/app.scss',destCss +'bootstrap.min.css');

    mix.sass('../../../public/assets/vendors/datatables/css/responsive.dataTables.scss', destCss +'responsive.dataTables.css');


    mix.styles(
        [
            '../../../public/assets/css/bootstrap.min.css',
            '../../../public/assets/css/font-awesome.min.css',
            '../../../public/assets/vendors/jScrollPane/css/jquery.jscrollpane.css',
            '../../../public/assets/vendors/checkbox_css/css/checkbox.min.css',
            '../../../public/assets/vendors/sweetalert/css/sweetalert2.min.css'

        ], destCss + 'components.css');
    mix.scripts(
        [
            '../../../public/assets/js/jquery.min.js',
            '../../../public/assets/js/tether.min.js',
            '../../../public/assets/js/bootstrap.min.js',
            '../../../public/assets/vendors/jScrollPane/js/jquery.mousewheel.js',
            '../../../public/assets/vendors/jScrollPane/js/mwheelIntent.js',
            '../../../public/assets/vendors/jScrollPane/js/jquery.jscrollpane.min.js',
            '../../../public/assets/vendors/sweetalert/js/sweetalert2.min.js'


        ], destJs + 'components.js');
    mix.scripts(
        [
            '../../assets/js/admire.js'

        ], destJs + 'custom.js');
});


/*
 | Finds un-used css and outputs css files into out folder
 | NOTE: sometimes even for used classes, it shows false positibe, be careful
 */
//directory
gulp.task('uncss', function () {
    //medical
    return gulp.src([
        // include custom css files here
    ])
        .pipe(uncss({
            html: ['**/*.html']
        }))
        .pipe(gulp.dest('./out'));

});

/*
 | Find for un-used images and show log
 */
gulp.task('images:filter', function () {
    return gulp.src(['images/**/*'])
        .pipe(plumber())
        .pipe(unusedImages({log:true, delete:false}))
        .pipe(plumber.stop());
});


/*
 | image minimisation
 */
gulp.task('images:min', function(){
    return gulp.src('images/**/*.+(png|jpg|gif|svg)')
        .pipe(imagemin())
        .pipe(gulp.dest('images/'))
});