module.exports = function(grunt){

	grunt.initConfig({
		concat: {
			options: {
				separator: ';',
			},
			dist: {
				src: [
					'web/js/jquery/jquery.js',
					'web/js/client/app.js',
                    'web/js/particle/particles.min.js',
                    'web/js/pathformer.js',
                    'web/js/vivus.js',
                    'web/js/scrollmagic/ScrollMagic.min.js',
                    'web/scrollmagic/animation.gsap.min.js',
                    'web/js/scrollmagic/TweenMax.min.js',
                    'web/js/isotope.js',
                    'web/js/height.js'
				],
				dest: 'web/js/client/app_min.js',
			},
		},

		uglify: {
			dist: {
				files: {
					'web/js/client/app_min.js': ['web/js/client/app_min.js']
				}
			}
		}
	});	

	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');

	grunt.registerTask('default',['concat','uglify']);

}