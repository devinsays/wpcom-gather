'use strict';
module.exports = function(grunt) {

	// load all tasks
	require('load-grunt-tasks')(grunt, {scope: 'devDependencies'});

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		watch: {
			files: ['scss/*.scss'],
			tasks: ['sass', 'postcss'],
			options: {
				livereload: true,
			},
		},
		sass: {
			default: {
				options : {
					style : 'expanded',
					sourceMap: true
				},
				files: {
					'style.css': 'scss/style.scss',
				}
			}
		},
		postcss: {
			options: {
			map: true,
			processors: [
				require('autoprefixer-core')({browsers: 'last 2 versions'}),
			]
			},
			files: {
				'style.css':'style.css'
			}
		},
		cssjanus: {
			theme: {
				options: {
					swapLtrRtlInUrl: false
				},
				files: [
					{
						src: 'style.css',
						dest: 'style-rtl.css'
					}
				]
			}
		},
		replace: {
			styleVersion: {
				src: [
					'scss/style.scss',
				],
				overwrite: true,
				replacements: [{
					from: /Version:.*$/m,
					to: 'Version: <%= pkg.version %>'
				}]
			},
			functionsVersion: {
				src: [
					'functions.php'
				],
				overwrite: true,
				replacements: [ {
					from: /^define\( 'GATHER_VERSION'.*$/m,
					to: 'define( \'GATHER_VERSION\', \'<%= pkg.version %>\' );'
				} ]
			},
		}
	});

	grunt.registerTask( 'default', [
		'sass',
		'postcss'
	]);

	grunt.registerTask( 'release', [
		'replace',
		'sass',
		'postcss',
		'cssjanus'
	]);

};
