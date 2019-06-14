# Directory structure

```
.
├── bin                     # Excecutable files
│   └── cli.php             # The command line tool
├── build                   # Compiled files (artifacts)
├── config                  # Configuration files
├── docs                    # Documentation files
├── public                  # Web server files
├── resources               # Other resource files
│   ├── assets              # Raw, un-compiled assets such as LESS, SASS and JavaScript
│   ├── locale              # Language files (translations)
│   ├── migrations          # Database migration files (Phinx)
│   └── seeds               # Data seeds
├── src                     # PHP source code (The App namespace)
│   ├── Action              # Controller actions (application layer)
│   ├── Console             # Console commands for cli.php
│   ├── Domain              # The business logic
│   ├── Factory             # Application service factories
│   ├── Http                # Responder and Url helper (application layer)
│   ├── Middleware          # Middleware (application layer)
│   ├── Repository          # Base repositories
│   └── Utility             # Helper classes and functions
├── templates               # Twig and Vue templates + JS and CSS
├── tests                   # Automated tests
├── tmp                     # Temporary files
│   ├── assets-cache        # Internal assets cache
│   ├── locale-cache        # Locale cache
│   ├── logs                # Log files
│   └── twig-cache          # Internal twig cache
├── vendor                  # Reserved for composer
├── build.xml               # Ant build tasks
├── composer.json           # Project dependencies
├── LICENSE                 # The license
└── README.md               # This file
```

<hr>

Navigation: [Index](readme.md)