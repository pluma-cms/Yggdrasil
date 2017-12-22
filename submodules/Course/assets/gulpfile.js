let gulp = require('gulp');
let data = require('gulp-data');
let stylus = require('gulp-stylus');
let autoprefixer = require('gulp-autoprefixer');
let cssnano = require('gulp-cssnano');
let jshint = require('gulp-jshint');
let uglify = require('gulp-uglify');
let imagemin = require('gulp-imagemin');
let rename = require('gulp-rename');
let concat = require('gulp-concat');
let notify = require('gulp-notify');
let cache = require('gulp-cache');
let livereload = require('gulp-livereload');
let del = require('del');

let sourcemaps = require('gulp-sourcemaps');

let directories = {
    stylus: {
        dir: './src/stylus/',
        src: ['./src/stylus/app.styl'],
        dist: './assets/css',
        inc: [
            __dirname,
            __dirname + '/node_modules',
        ],
    },
    sass: {
        src: [],
        dist: '',
    },
    javascript: {
        src: [],
        dist: '',
    },
}

let app = {
    name: {
        css: 'app.css',
        js: 'app.js',
    }
}

let tasks = {
    compile: {
        stylus: 'compile:stylus',
    },
};

/**
 * Compile Stylus
 *
 * @run  gulp compile:stylus
 */
gulp.task(tasks.compile.stylus, function () {
    return gulp.src(directories.stylus.src)
        .pipe(stylus({
            compress: true,
            linenos: true,
            paths: directories.stylus.inc,
            'include css': true,
        }))
        .pipe(autoprefixer('last 2 version'))
        .pipe(rename(app.name.css))
        .pipe(gulp.dest(directories.stylus.dist))
        .pipe(rename({ suffix: '.min' }))
        .pipe(cssnano())
        .pipe(gulp.dest(directories.stylus.dist))
        .pipe(notify({ message: 'Completed compiling SASS Files' }));
});

/**
 * Watcher Task
 *
 * @run  gulp watch
 */
gulp.task('watch', function () {
    // Watch stylesheet files
    gulp.watch(directories.stylus.dir + '/**/*', [tasks.compile.stylus]);
    // Watch .js files
    // gulp.watch(directories.javascript.src + '/**/*.js', [tasks.compile.javascript]);
    // Add more...

});

/**
 * Default Task
 *
 * @run  gulp
 */
gulp.task('default', [tasks.compile.stylus]);
