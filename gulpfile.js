const   { watch, series, src, dest, parallel}   = require('gulp'),
        sass                                    = require('gulp-sass'),
        concat                                  = require('gulp-concat'),
        uglify                                  = require('gulp-uglify'),
        cssnano                                 = require('gulp-cssnano'),
        rename                                  = require('gulp-rename'),
        browserSync                             = require('browser-sync'),
        del                                     = require('del'),
        imagemin                                = require('gulp-imagemin'),
        pngquant                                = require('imagemin-pngquant'),
        cache                                   = require('gulp-cache'),
        autoprefixer                            = require('gulp-autoprefixer');

function sassTask() {
    return src('./wp-content/themes/underscores-child-fm-transmitter/sass/*.+(scss|sass)')
        .pipe(sass())
        .pipe(autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true}))
        .pipe(dest('./wp-content/themes/underscores-child-fm-transmitter'))
        .pipe(browserSync.reload({stream: true}))
}

function cssLibsTask() {
    return src([
        './bower_components/owl.carousel/dist/assets/owl.carousel.css',
        './bower_components/animate.css/animate.min.css',
        './bower_components/owl.carousel/dist/assets/owl.theme.default.css'
    ])
        .pipe(concat('libs-style.css'))
        .pipe(cssnano())
        .pipe(rename({suffix: '.min'}))
        .pipe(dest('./wp-content/themes/underscores-child-fm-transmitter'));
}

function browserSyncTask() {
    return  browserSync.init({
            // baseDir: './wp-content/themes',
        // proxy: "localhost/fm-transmitter",
        proxy: "localhost",
        // server:
        // },
        // browser: ["google chrome"],
        notify: false
    });
}

function browserSyncReloadTask(cb) {
    browserSync.reload();
    cb();
}

function scriptsTask() {
    return src([
        './bower_components/jquery/dist/jquery.min.js',
        './bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js',
        './bower_components/owl.carousel/dist/owl.carousel.min.js',
        './bower_components/parallax.js/parallax.min.js',
        './bower_components/waypoints/lib/jquery.waypoints.min.js',
        './wp-content/themes/underscores-child-fm-transmitter/js/*.js'
    ])
        .pipe(concat('libs.min.js'))
        .pipe(uglify())
        .pipe(dest('./wp-content/themes/underscores-child-fm-transmitter/'))
        .pipe(browserSync.reload({stream: true}))

}

function buildTask(cb) {
   series(sassTask, cssLibsTask, scriptsTask);
   cb();
}

function watchTask() {
    watch('wp-content/themes/underscores-child-fm-transmitter/sass/**/*.+(scss|sass)', sassTask);
    watch('wp-content/themes/underscores-child-fm-transmitter/**/*.+php', browserSyncReloadTask);
    watch(['wp-content/themes/underscores-child-fm-transmitter/**/*.+js',
        '!./wp-content/themes/underscores-child-fm-transmitter/libs.min.js'], scriptsTask);
}


//перед watch, build надо сделать clean папки dist
function clean(cb) {
    del.sync('./wp-content/themes/underscores-child-fm-transmitter/dist');
    cb();
}

// отчистка кеша
function clear(cb) {
    cache.clearAll();
    cb();
}

// зжатие картинок
exports.img = function() {
    return src('./wp-content/themes/underscores-child-fm-transmitter/img/**/*')
        .pipe(cache(imagemin({
            interlaced: true,
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            une: [pngquant()]
        })))
        .pipe(dest('./wp-content/themes/underscores-child-fm-transmitter/image_min'));
};
//////////////////////////////
// Default Task
//////////////////////////////

exports.default = series(clean, clear, buildTask, parallel(browserSyncTask, watchTask) );