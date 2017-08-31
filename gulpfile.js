const gulp = require('gulp')
const pug = require('gulp-pug')
const bluebird = require('bluebird')
const fileMappings = require('./fileMappings')
const webpackCompiler = require('webpack')(require('./webpack.config.js'))

gulp.task('compile-views', () => {
  gulp.src(fileMappings.views)
    .pipe(pug())
    .pipe(gulp.dest(fileMappings.distDir))
})

gulp.task('move-vendor', () => {
  const materialize = new Promise((resolve) => {
    gulp.src('node_modules/materialize-css/**/*.*')
    .pipe(gulp.dest(`${fileMappings.vendorDir}/materialize`))
    .once('end', resolve)
  })

  const jquery = new Promise((resolve) => {
    gulp.src('node_modules/jquery/**/*.*')
    .pipe(gulp.dest(`${fileMappings.vendorDir}/jquery`))
    .once('end', resolve)
  })

  return bluebird.all([materialize, jquery])
})

gulp.task('move-public', ['move-vendor'], () => {
  gulp.src('public/**/*')
    .pipe(gulp.dest(fileMappings.distDir))
})

gulp.task('compile-modules', ['move-vendor'], () => {
  return new Promise((resolve, reject) => {
    webpackCompiler.run((err, stats) => {
      if (err) reject(err)
      else resolve(stats)
    })
  })
})

gulp.task('watch', () => {
  gulp.watch(fileMappings.views, ['compile-views'])
  gulp.watch(['public/fonts/**/*.*', 'public/images/**/*.*'], ['move-public'])
  gulp.watch(['public/stylesheets/**/*.*', 'public/javascripts/**/*.*'], ['compile-modules'])
})

gulp.task('default', ['compile-views', 'move-public', 'compile-modules'])
