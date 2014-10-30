module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    bower_concat: {
  all: {
    dest: 'js/<%= pkg.name %>.js',
    cssDest: 'css/<%= pkg.name %>.css',
    exclude: [
    ],
    dependencies: {
    },
    bowerOptions: {
      relative: false
    }
  }
}
});

  // Load the plugin that provides the "concat" task.
  grunt.loadNpmTasks('grunt-bower-concat');

};
