// Start Gulp Modules
var gulp = require('gulp'),
		sass = require('gulp-sass'),
		concat = require('gulp-concat'),
		uglify = require('gulp-uglify'),
		autoprefixer = require('gulp-autoprefixer'),
		browserSync = require('browser-sync'),
		watch = require('gulp-watch'),
		gutil = require('gulp-util');

// Sass Function
gulp.task('sass', function(){
	gulp.src('assets/css/**/*.scss')
		.pipe(sass())
		.pipe(autoprefixer({
			browsers: ['last 2 versions'],
			cascade: false
		}))
		//.pipe(sass({outputStyle: 'compressed'}))
		.pipe(gulp.dest('./'))
		.pipe(browserSync.reload({ stream: true }))
});

// Plugins Concat
gulp.task('plugins-script', function() {
	gulp.src('assets/js/vendor/*.js')
		.pipe(concat('plugins.min.js'))
		// .pipe(uglify())
		.pipe(gulp.dest('assets/js/'))
		.pipe(browserSync.reload({ stream: true }))
});

// Main Concat
gulp.task('main-script', function() {
	gulp.src([
			'assets/js/main.js',
		])
		.pipe(concat('main.min.js'))
		// .pipe(uglify())
		.pipe(gulp.dest('assets/js/'))
		.pipe(browserSync.reload({ stream: true }))
});

// BrowserSync Function
gulp.task('browserSync', function() {
	var files = [
		'./style.css',
		'./*.php'
	];
	browserSync.init(files, {
	proxy: "dominio.com",
	notify: false
	});
});

// Watch Function
gulp.task('default', ['browserSync', 'sass'], function(){
  gulp.watch('css/**/*.scss', ['sass']);
  gulp.watch('js/main/*.js', ['main-script']);
  gulp.watch('js/plugins/*.js', ['plugins-script']);
  gulp.watch('./*.html', browserSync.reload);
  gulp.watch('./*.php', browserSync.reload);
  gulp.watch('js/**/*.js', browserSync.reload);
});

