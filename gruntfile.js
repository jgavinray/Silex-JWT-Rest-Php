module.exports = function(grunt) {
    grunt.initConfig({
        watch: {
            files: ["./src/**/*.php", "./test/**/*.php"],
            tasks: ["shell"]
        },
        shell: {
            options: {
                // Set as true if you want to see warning/errors in the window
                stderr: false
            },
            target: {
                command: 'phpunit'
            }
        }
    });
    grunt.loadNpmTasks("grunt-contrib-watch");
    grunt.loadNpmTasks('grunt-shell');
    grunt.registerTask('default', ['watch']);
};
