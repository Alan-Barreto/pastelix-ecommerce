const { src, dest, watch, parallel ,series} = require('gulp');

// CSS
const sass = require('gulp-sass')(require('sass'));

const webpack = require('webpack-stream');
const webpackConfig = require('./webpack.config');

const clean = require('gulp-clean');

const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
    imagenes: 'src/img/**/*'
}

function css(){
    return src(paths.scss)
        .pipe( webpack(webpackConfig))
        .pipe( dest('public/build/css'))
}

function js(){
    return src(paths.js)
        .pipe( webpack(webpackConfig))
        .pipe( dest('public/build/js'));
}

function cleancss (){
    return src(['public/build/css/main.js','public/build/css/main.js.map'], { read: false, allowEmpty: true })
    .pipe(clean());
}

function dev(done){
    watch( paths.scss, css);
    watch( paths.js, js);
    watch( 'public/build/css/*.js', cleancss);
    done();
}

exports.css = css;
exports.js = js;
exports.cleancss = cleancss;


exports.dev = series(parallel(css,js,dev),cleancss) ;