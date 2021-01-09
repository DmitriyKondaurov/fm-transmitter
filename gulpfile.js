var gulp            = require('gulp'),
    sass            = require('gulp-sass'),
    concat          = require('gulp-concat'),
    uglify          = require('gulp-uglify'),
    cssnano         = require('gulp-cssnano'),
    rename          = require('gulp-rename'),
    browserSync     = require('browser-sync'),
    del             = require('del'),
    // postcss         = require('gulp-postcss'),
    // sourcemaps      = require('gulp-sourcemaps'),
    imagemin        = require('gulp-imagemin'),
    pngquant        = require('imagemin-pngquant'),
    cache           = require('gulp-cache'),
    autoprefixer    = require('gulp-autoprefixer');

gulp.task('sass',  function() {
    return gulp.src('./wp-content/themes/underscores-child-fm-transmitter/sass/*.+(scss|sass)')
        .pipe(sass())
        .pipe(autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true}))
        .pipe(gulp.dest('./wp-content/themes/underscores-child-fm-transmitter'))
        .pipe(browserSync.reload({stream: true}))
});
gulp.task('css-libs', function() {
    return gulp.src([
        './bower_components/owl.carousel/dist/assets/owl.carousel.css',
        './bower_components/animate.css/animate.min.css',
        './bower_components/owl.carousel/dist/assets/owl.theme.default.css'
    ])
        .pipe(concat('libs-style.css'))
        .pipe(cssnano())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('./wp-content/themes/underscores-child-fm-transmitter'));
});

gulp.task('browser-sync', function() {
    browserSync.init({
        //     baseDir: './wp-content/themes'
        proxy: "localhost/fm-transmitter",
        // proxy: "https://shops/sytes.net",
        // server: {
        // },
        // browser: ["chrome"].,
        notify: false
    });
});

gulp.task('scripts', function() {
    return gulp.src([
        './bower_components/jquery/dist/jquery.min.js',
        './bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js',
        './bower_components/owl.carousel/dist/owl.carousel.min.js',
        './bower_components/parallax.js/parallax.min.js',
        './bower_components/waypoints/lib/jquery.waypoints.min.js',
        './wp-content/themes/underscores-child-fm-transmitter/js/*.js'
    ])
        .pipe(concat('libs.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./wp-content/themes/underscores-child-fm-transmitter/'));
});

gulp.task('build', gulp.series('sass', 'css-libs', 'scripts'), function () {});

gulp.task('watch', gulp.series('browser-sync', 'build'), function() {
    gulp.watch('./wp-content/themes/underscores-child-fm-transmitter/sass/**/*.+(scss|sass)', ['sass']);
    gulp.watch('./wp-content/themes/underscores-child-fm-transmitter/**/*.+(php|js)', browserSync.reload);
});
//перед watch, build надо сделать clean папки dist
gulp.task('clean', function () {
    return del.sync('./wp-content/themes/underscores-child-fm-transmitter/dist');
});
// отчистка кеша
gulp.task('clear', function () {
    return cache.clearAll();
});
// зжатие картинок
gulp.task('img', function() {
    return gulp.src('./wp-content/themes/underscores-child-fm-transmitter/img/**/*')
        .pipe(cache(imagemin({
            interlaced: true,
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            une: [pngquant()]
        })))
        .pipe(gulp.dest('./wp-content/themes/underscores-child-fm-transmitter/image_min'));
});
//////////////////////////////
// Default Task
//////////////////////////////

gulp.task('default', gulp.series('watch'));