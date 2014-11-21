var basePaths = {
    src: 'assets/',
    dest: 'site/'
};
var paths = {
    images: {
        src: basePaths.src + 'images/**',
        dest: basePaths.dest + 'img/'
    },
    styles: {
        src: basePaths.src + 'styles/',
        dest: basePaths.dest + 'css/'
    },
    sprite: {
        src: basePaths.src + 'sprite/*'
    }
};
var appFiles = {
    styles: paths.styles.src + '*.scss'
};
var vendorFiles = {
    styles: ''
};
var spriteConfig = {
    imgName: 'sprite_n.png',
    cssName: '_sprite.scss',
    imgPath: '../image/sprite_n.png' // Gets put in the css
};
/*
    Let the magic begin
*/
var     gulp    =       require('gulp');

var     es      =       require('event-stream');
var     gutil   =       require('gulp-util');

var     plugins =       require("gulp-load-plugins")({
                            pattern: ['gulp-*', 'gulp.*'],
                            replaceString: /\bgulp[\-.]/
                        });
var     imageop     =   require('gulp-image-optimization');
var changeEvent = function(evt) {
    gutil.log('File', gutil.colors.cyan(evt.path.replace(new RegExp('/.*(?=/' + basePaths.src + ')/'), '')), 'was', gutil.colors.magenta(evt.type));
};


gulp.task('css', function() {
    return gulp.src(appFiles.styles)
        .pipe(plugins.sass({
            errLogToConsole: true,
            outputStyle: 'compressed'
        }))
        .pipe(plugins.autoprefixer('last 2 version', '> 5%', 'ie 8', 'iOS', 'OperaMobile', 'OperaMini', {map: false}))
        .pipe(gulp.dest(paths.styles.dest))
        .pipe(plugins.size());
});



gulp.task('image', function(cb) {
    gulp.src(paths.images.src)
    .pipe(plugins.cache(
        imageop({
            optimizationLevel: 5,
            progressive: true,
            interlaced: true
        })
    ))
    .pipe(gulp.dest(paths.images.dest))
    .on('end', cb)
    .on('error', cb)
    .pipe(plugins.size())
});


/*
    Sprite Generator
*/
gulp.task('sprite', function () {
    var spriteData = gulp.src(paths.sprite.src).pipe(plugins.spritesmith({
        imgName: spriteConfig.imgName,
        cssName: spriteConfig.cssName,
        imgPath: spriteConfig.imgPath,
        cssVarMap: function (sprite) {
            sprite.name = 'sprite-' + sprite.name;
        }
    }));
    spriteData.img.pipe(gulp.dest(paths.images.dest));
    spriteData.css.pipe(gulp.dest(paths.styles.src));
});

gulp.task('watch', function () {
    gulp.watch(appFiles.styles, ['css', 'image']);
    gulp.watch(paths.images.src, ['image']);
});


/*
gulp.task('watch', ['sprite', 'css', 'image'], function(){
    gulp.watch(appFiles.styles, ['css', 'image']).on('change', function(evt) {
        changeEvent(evt);
    });
    gulp.watch(paths.images.src, ['image']).on('change', function(evt) {
        changeEvent(evt);
    });

});
*/
gulp.task('default', ['css', 'image']);