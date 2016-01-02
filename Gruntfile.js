/*
 Author : Afroz Alam,
 Date   : 18 May 2015
 Copyright : None
*/

var Oven = Oven || {};


//All server related configurations must be put here
Oven.config = {

    cssLessDir: "public/css/less",
    cssDir: "public/css",
    jsDir: "public/js",
    svgDir:"public/svg",
    buildCssDir: "public/css/build",
    buildJsDir: "public/js/build",
    buildImgDir:"public/img",
    buildSvgDir:"public/img/svg",
    privateKeyPath:"/Users/afroz/Downloads/main-website.pem", // gets changed : Depending on the machine from where you are deploying
    websiteLocationOnServer :'/var/www/PantryCarWebsite/',
    websiteLocationOnServerTemp :'/var/www/PantryCarWebsiteTemp/',
    websiteLocationOnServerBackup :'/var/www/PantryCarWebsiteBackup/',
    HostName : '52.26.42.119',
    userName :'ubuntu'
};


var timer = require("grunt-timer");

module.exports = function(grunt) {

  timer.init(grunt, { deferLogs: true, friendlyTime: true, color: "blue" });

  var _privateKey = grunt.file.exists(Oven.config.privateKeyPath) ? grunt.file.read(Oven.config.privateKeyPath) : '';

  // Load all modules here
  // Automatically load required grunt tasks
    require('jit-grunt')(grunt, {
        useminPrepare: 'grunt-usemin'
    });

   grunt.initConfig({

    pkg: grunt.file.readJSON("package.json"),
    config: Oven.config,

    less: {
            production: {
                options: {
                    cleancss: false
                },
                files: {
                  '<%= config.buildCssDir %>/app.css' : '<%= config.cssLessDir %>/app.less',
                }
            }
      },

    // Take the processed style.css file and minify
    cssmin: {
      build: {
        files: {
          '<%= config.buildCssDir %>/vendors.min.css': ['<%= config.cssDir %>/vendors/animate.min.css','<%= config.cssDir %>/vendors/font-awesome.css','<%= config.cssDir %>/vendors/datetimepicker.min.css'],
          '<%= config.buildCssDir %>/app.min.css': ['<%= config.buildCssDir %>/app.css']
        }
      }
    },

   jshint: {
            options: {
                jshintrc: '.jshintrc',
                reporter: require('jshint-stylish')
            },
            all: ['<%= config.jsDir %>/**/*.js','!<%= config.jsDir %>/build/*.js','!<%= config.jsDir %>/vendors/*.js']
      },

    jsvalidate: {
            options:{
                globals: {},
                esprimaOptions: {},
                verbose: false
            },
            files: ['<%= config.jsDir %>/**/*.js','!<%= config.jsDir %>/build/*.js','!<%= config.jsDir %>/vendors/*.js']
        },

     phplint: {
            options: {
                swapPath: '/tmp',
                phpArgs: {
                "-l": null,
                "-d" :"display_errors=1"
              }
            },
            all: ['app/**/*.php','/resources/**/*.php']
      },

     uglify: {
        options: {
                 mangle: true,
                  compress: {
                        evaluate: false
                    }
        },
        build: {
            files: {
                '<%= config.buildJsDir %>/bundle.min.js': [ '<%= config.jsDir %>/modules/auth/Auth.js',
                                                            '<%= config.jsDir %>/modules/TrainsList.js',
                                                            '<%= config.jsDir %>/modules/Pnr.js',
                                                            '<%= config.jsDir %>/modules/Utils.js',
                                                            '<%= config.jsDir %>/main.js'

                                                          ],
                '<%= config.buildJsDir %>/cart.min.js':  ['<%= config.jsDir %>/modules/Cart.js'],

                '<%= config.buildJsDir %>/vendors.min.js':  [ '<%= config.jsDir %>/vendors/jquery-2.1.3.min.js',
                                                          '<%= config.jsDir %>/vendors/bootstrap.min.js',
                                                          '<%= config.jsDir %>/vendors/bootbox.min.js',
                                                          '<%= config.jsDir %>/vendors/bootstrap-datepicker.min.js',
                                                          '<%= config.jsDir %>/vendors/sticky.min.js'
                                                        ],
                '<%= config.buildJsDir %>/autosuggest.js':  ['<%= config.jsDir %>/vendors/awesomplete.min.js','<%= config.jsDir %>/modules/AutoSuggest.js']
            }
        }
   },

   svgmin: {
          options: {
              plugins: [
                  {
                      removeViewBox: false
                  }, {
                      removeUselessStrokeAndFill: false
                  }
              ]
          },
        dist: {
            files: [{
              expand: true,
              cwd: '<%= config.svgDir %>',
              src: ['**/*.svg'],
              dest: '<%= config.buildSvgDir %>',
              ext: '.svg'
            }]
        }
    },

     clean: {
        css: ["<%= config.buildCssDir %>/*.css"],
        js:  ["<%= config.buildJsDir %>/*.js"],
        svg: ["<%= config.buildSvgDir %>/*.svg"]
    },

    imagemin: {
              png: {
                  options: {
                      optimizationLevel: 7
                  },
                  files: [{
                      expand: true,
                      cwd: '<%= config.buildImgDir %>',
                      src: ['**/*.png'],
                      dest: '<%= config.buildImgDir %>',
                      ext: '.png'
                  }]
              },
              jpg: {
                  options: {
                      progressive: true
                  },
                  files: [{
                      expand: true,
                      cwd: '<%= config.buildImgDir %>',
                      src: ['**/*.jpg'],
                      dest: '<%= config.buildImgDir %>',
                      ext: '.jpg'
                  }]
              }
      },
    autoprefixer: {
            options: {
                browsers: ['last 2 versions', 'Firefox > 15', 'ie 8', 'ie 9'],
                cascade: false
            },
            dist:{
              files:{
                '<%= config.buildCssDir %>/app.css':'<%= config.buildCssDir %>/app.css'
              }
             }
    },

    sshconfig:{

        prodServer: {
            host: "<%= config.HostName %>",
            username: "<%= config.userName %>",
            privateKey: _privateKey,
            agent: process.env.SSH_AUTH_SOCK
      }

    },


   shell: {

      pull:{
        command:[
                    'git stash',
                    'git checkout master',
                    'git pull origin master',
          ].join(' && ')
       },
       readyToShip:{
           command:[
                'echo "--------------------------------------------------"',
                'echo "--------------------------------------------------\n"',
                'echo "             Ship it \\m\/"',
                'echo "\n--------------------------------------------------"',
                'echo "--------------------------------------------------"',
            ].join(' && ')
       }
   },

   sshexec: {
         deploy: {
                command: [
                    'sudo cp --preserve=mode,ownership,timestamps -r <%= config.websiteLocationOnServer %> <%= config.websiteLocationOnServerTemp %>',
                    'sudo chmod -R 777 <%= config.websiteLocationOnServerTemp %>',
                    'cd <%= config.websiteLocationOnServerTemp %>',
                    'sudo git stash',
                    'sudo git checkout master',
                    'sudo git pull origin master',
                    'ln -sf ~/Settings/.production.env <%= config.websiteLocationOnServerTemp %>/.production.env',
                    'sudo composer install',
                    'sudo npm install',
                    'grunt unlock;sudo grunt build'
                ].join(' && '),
            options:{
                config: 'prodServer'
            }
          },
        makeBuildLive: {
                command: [
                'sudo mv <%= config.websiteLocationOnServer %> <%= config.websiteLocationOnServerBackup %>',
                'sudo mv <%= config.websiteLocationOnServerTemp %> <%= config.websiteLocationOnServer %>',
                'sudo rm -rf <%= config.websiteLocationOnServerBackup %> || mv <%= config.websiteLocationOnServerBackup %> <%= config.websiteLocationOnServer %>'
                ].join(' && '),
            options:{
                config: 'prodServer'
            }
          },
     } ,

     hashres: {
        options: {
            encoding: 'utf8',
            fileNameFormat: '${name}.${hash}.${ext}',
            renameFiles: true
        },

        stage: {

            options: {
                // You can override encoding, fileNameFormat or renameFiles
            },

            src: [
                 '<%= config.buildCssDir %>/app.min.css' ,
                 '<%= config.buildJsDir %>/bundle.min.js',
                 '<%= config.buildJsDir %>/cart.min.js',
                 '<%= config.buildJsDir %>/autosuggest.js',
                 '<%= config.buildJsDir %>/vendors.min.js',
                 '<%= config.buildCssDir %>/vendors.min.css'
            ],
            dest: ['resources/views/footer.blade.php','resources/views/meta.blade.php','resources/views/restaurant-page.blade.php','resources/views/user-cart.blade.php','resources/views/home.blade.php']
        }
   },

    watch: {
      styles: {
        files: ['<%= config.cssLessDir %>**/*.less'], // which files to watch
        tasks: ['less:production','autoprefixer','cssmin'],
        options: {
                spawn: true,
                debounceDelay: 1000
        }
      }
    }
  });

   grunt.registerTask('lock', function() {
        var isLocked = grunt.file.exists('.lock');
        if(isLocked) {
            grunt.fail.fatal("Another deployment in progress. Please wait until it is finished for next deployment");
        } else {
            grunt.file.write('.lock', "1");
        }
    });

   grunt.registerTask('unlock', function() {
        grunt.file.delete('.lock');
    });



    grunt.registerTask('default' ,'localbuild');
    grunt.registerTask('localbuild', ['phplint' ,'jsvalidate','jshint' ,'clean','less:production','autoprefixer','cssmin','uglify','svgmin', 'shell:readyToShip','watch']);
    grunt.registerTask('deploy',['lock','sshexec:deploy','unlock'])
    grunt.registerTask('build', ['lock','phplint' ,'jsvalidate','jshint','clean','less:production','autoprefixer','cssmin','uglify','hashres','imagemin','svgmin', 'shell:readyToShip','unlock']);
    grunt.registerTask('shipit',['lock','sshexec:makeBuildLive','unlock']);

};
