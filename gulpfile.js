/*!
* How to install and use gulp
* Install Node at www.node.js
* Install Gulp globally on your computer with command, 'sudo npm install gulp -g' (exclude sudo on pc)
* Change directory in command line. Point to theme folder (example: cd /Users/DanielO/Desktop/buffiniandcompany.dev/wp-content/themes/buffini-and-company)
* Install gulp on theme directory with this command: 'npm install gulp --save-dev'
* Run command: 'npm install gulp-sass gulp-autoprefixer gulp-cssnano gulp-rename gulp-changed browser-sync --save-dev'
* Run command: 'gulp' to run the gulp tasks listed below (i.e. compiling sass and seeing changes live in the browser)
*/


// Load gulp plugins
var gulp = require('gulp'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    cssnano = require('gulp-cssnano'),
		rename = require('gulp-rename'),
    browserSync = require('browser-sync'),
		browserSyncReload = browserSync.reload;


// browser-sync task for starting the server.
gulp.task('browser-sync', function() {
	//watch files
	var files = [
	'scripts/**/*.js',
	'styles/scss/**/*.scss',
	'*.php'
	];
	//initialize browsersync
	browserSync.init(files, {
	//browsersync with a php server
	proxy: "buffiniandcompany.dev",
	notify: false
	});
});


gulp.task('sass', function () {
	return gulp.src('styles/scss/*.scss')
	.pipe(sass())
	.pipe(autoprefixer('last 2 version'))
	.pipe(gulp.dest('styles/css'))
	.pipe(cssnano())
	.pipe(rename({ suffix: '.min' }))
	.pipe(gulp.dest('styles/css'))
	.pipe(browserSyncReload({stream:true}));
});
 

gulp.task('default', ['sass', 'browser-sync'], function () {
	gulp.watch("styles/scss/**/*.scss", ['sass']);
  gulp.watch('*.scss', browserSync.reload); 
	gulp.watch('*.php', browserSync.reload); 
  gulp.watch('scripts/**/*.js', browserSync.reload); 
});
