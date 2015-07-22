var gulp = require('gulp');
var _    = require('./bower_components/underscore/underscore.js');
var sass = require('gulp-sass');


gulp.task('default', function() {
   console.log('TESTING');
});

gulp.task('copy-assets', function() {
   var assets = {
        js: [
            './bower_components/requirejs/require.js',
            './bower_components/jquery/dist/jquery.min.js',
            './bower_components/underscore/underscore.js',
            './bower_components/bootstrap-sass/assets/javascripts/**/*.js'
        ],
        scss: [
            './bower_components/bootstrap-sass/assets/stylesheets/**/*.scss'
        ],
        css: [
            './bower_components/select2/dist/css/select2.min.css'
        ]
   };
    _.each(assets, function(path, type){
        gulp.src(path).pipe(gulp.dest('web/' + type + '/lib'));
    });
});

gulp.task('compile-sass', function() {
    gulp.src('app/Resources/assets/scss/style.scss')
       .pipe(sass())
       .pipe(gulp.dest('web/css'));

    //gulp.src('app/Resources/assets/css/**').pipe(gulp.dest('web/css'));
});

gulp.task('js-dump', function() {
    gulp.src('app/Resources/assets/js/**').pipe(gulp.dest('web/js'));
});

gulp.task('watch', function () {
    var onChange = function (event) {
        console.log('File '+event.path+' has been '+event.type);
    };
    gulp.watch('app/Resources/assets/scss/**/*.scss', ['compile-sass'])
        .on('change', onChange);
    gulp.watch('app/Resources/assets/js/**/*.js', ['js-dump'])
        .on('change', onChange);
});