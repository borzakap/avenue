"use strict";

// Load plugins
const autoprefixer = require("gulp-autoprefixer");
const browsersync = require("browser-sync").create();
const cleanCSS = require("gulp-clean-css");
const del = require("del");
const gulp = require("gulp");
const header = require("gulp-header");
const merge = require("merge-stream");
const plumber = require("gulp-plumber");
const rename = require("gulp-rename");
const sass = require("gulp-sass");
const uglify = require("gulp-uglify");
//const imagemin = require('gulp-imagemin');


// Load package.json for banner
const pkg = require('./package.json');

// Set the banner content
const banner = ['/*!\n',
    ' * Idilika Avenue - <%= pkg.title %> v<%= pkg.version %> (<%= pkg.homepage %>)\n',
    ' * Copyright 2021-' + (new Date()).getFullYear(), ' <%= pkg.author %>\n',
    ' */\n',
    '\n'
].join('');

// BrowserSync
function browserSync(done) {
    browsersync.init({
        server: {
            baseDir: "./"
        },
        port: 3000
    });
    done();
}

// BrowserSync reload
function browserSyncReload(done) {
    browsersync.reload();
    done();
}

// Clean vendor
function clean() {
    return del(["./modules/"]);
}

// Bring third party dependencies from node_modules into vendor directory
function modules() {
    // Bootstrap JS
    var bootstrapJS = gulp.src('./node_modules/bootstrap/dist/js/*')
            .pipe(gulp.dest('./modules/bootstrap/js'));
    // Bootstrap SCSS
    var bootstrapSCSS = gulp.src('./node_modules/bootstrap/scss/**/*')
            .pipe(gulp.dest('./modules/bootstrap/scss'));
    
    // Bootstrap Select SCSS
    var bootstrapSelect = gulp.src('./node_modules/bootstrap-select/sass/**/*')
            .pipe(gulp.dest('./modules/bootstrap-select/scss'));
    
    // jQuery
    var jquery = gulp.src([
        './node_modules/jquery/dist/*',
        '!./node_modules/jquery/dist/core.js'
    ])
            .pipe(gulp.dest('./modules/jquery'));
    
    // slik carusel
    var slick = gulp.src('./node_modules/slick-carousel/slick/**/*')
            .pipe(gulp.dest('./modules/slick'));
    // Font Awesome
    var fontAwesome = gulp.src('./node_modules/@fortawesome/**/*')
            .pipe(gulp.dest('./modules'));

    // js-cookie
    var jsCookie = gulp.src('./node_modules/js-cookie/src/*')
            .pipe(gulp.dest('./modules/js-cookie'));
    
    var jsBootstrapSelect = gulp.src('./node_modules/bootstrap-select/js/*')
            .pipe(gulp.dest('./modules/js-bootstrap-select'));
    
    var magnificPopup = gulp.src('./node_modules/magnific-popup/dist/*')
            .pipe(gulp.dest('./modules/magnific-popup'));
    // popper
//    var popper = gulp.src('./node_modules/popper.js/dist/*')
//            .pipe(gulp.dest('./modules/popper'));
    
    return merge(bootstrapJS, bootstrapSCSS, bootstrapSelect, jsBootstrapSelect, jquery, slick, fontAwesome, jsCookie, magnificPopup);
}

// CSS task
function css() {
    return gulp
            .src("./scss/**/*.scss")
            .pipe(plumber())
            .pipe(sass({
                outputStyle: "expanded",
                includePaths: "./node_modules",
            }))
            .on("error", sass.logError)
            .pipe(autoprefixer({
                cascade: false
            }))
            .pipe(header(banner, {
                pkg: pkg
            }))
            .pipe(gulp.dest("./css"))
            .pipe(rename({
                suffix: ".min"
            }))
            .pipe(cleanCSS())
            .pipe(gulp.dest("./css"))
            .pipe(browsersync.stream());
}

// JS task
function js() {
    return gulp
            .src([
                './js/*.js',
                './modules/js-cookie/*.js',
                './modules/js-bootstrap-select/bootstrap-select.js',
                '!./js/*.min.js',
                '!./modules/js-cookie/*.min.js',
                '!./modules/js-bootstrap-select/bootstrap-select.min.js'
            ])
            .pipe(uglify())
            .pipe(header(banner, {
                pkg: pkg
            }))
            .pipe(rename({
                suffix: '.min'
            }))
            .pipe(gulp.dest('./js'))
            .pipe(browsersync.stream());
}

// Watch files
function watchFiles() {
    gulp.watch("./scss/**/*", css);
    gulp.watch(["./js/**/*", "!./js/**/*.min.js"], js);
    gulp.watch("./**/*.html", browserSyncReload);
}

//function img(){
//    
//}


// Define complex tasks
const vendor = gulp.series(clean, modules);
const build = gulp.series(vendor, gulp.parallel(css, js));
const watch = gulp.series(build, gulp.parallel(watchFiles, browserSync));

// Export tasks
exports.css = css;
exports.js = js;
exports.clean = clean;
exports.vendor = vendor;
exports.build = build;
exports.watch = watch;
exports.default = build;
