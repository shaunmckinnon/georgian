<?php
  
  // Fireside Web Flow Hierarchy
  $hierarcy = [
    'Prospecting Phase' => [
      'Wait for call ...',
      'Cold calling ... (new clients)',
      'Warm calling ... (existing clients)'
    ],

    'Qualifying Phase' => [
      'Research the company online',
      'Research the industry',
      'Ensure a good relationship',
      'What are their goals?' => [
        'Business',
        'Site'
      ],
      'What are their opportunities' => [
        'Potential investor',
        'Potential SaaS/product opportunity',
        'Impact/growth'
      ],
    ],

    'Researching Phase' => [
      'Research the competition',
      'Researching the market',
      'Researching the industry',
      'Deliverables' => [
        'Project brief based on competition, and goals' => [
          'Sell discovery'
        ]
      ]
    ],

    'Discovery Phase' => [
      'Client questionnaire/interview' => [
        'What do you do?',
        'What makes you special?',
        'What are you goals?',
        'Whod is your target market?',
        'Where are you now?',
        'Where do you want to be?'
      ],
      'Research' => [
        'Learn about the client' => [
          'industry',
          'overall market/demographic'
        ],
        'Learn about the target market/demogrpahic'
      ],
      'Deliverables' => [
        'Strategy guide'
      ]
    ],

    'Strategy Phase' => [
      'Conceptulize solutions from research' => [
        'Think tank' => [
          'What we know' => [
            'Client expectations',
            'industry',
            'Overall market/demographic',
            'Target market/demographic'
          ],
          'Available project hours/budget',
          'Create strategies to maximize ROI for client',
          'Create pitch'
        ],
        'Pitch meeting' => [
          'Deliverables' => [
            'Price',
            'Sitemap'
          ]
        ]
      ]
    ],

    'Proposal Phase' => [
      'Deliverables' => [
        'Price',
        'Working wireframe prototype',
        'High-level functionality requirements',
        'Sitemap'
      ]
    ],

    'Setup Phase' => [
      'Setup Project' => [
        'Setup project roadmap'
      ],
      'Kickoff meeting' => [
        'Reviewing all collected info and ideas',
        'Talk next steps',
        'Establish final deliverables'
      ],
      'Setup initializing tasks' => [
        'Design tasks' => [
          'Initial homepage design',
          'One other page design',
          'Design pitch'
        ],
        'Copy tasks' => [
          'Setting up facilitating copy'
        ],
        'SEO tasks' => [
          'Keyword research',
          'Collecting information from client',
          'Setting up common tasks'
        ],
        'Development tasks' => [
          'Setup staging environment',
          'Provision domain names',
          'Setup production environment'
        ]
      ],
      'Initial client communication' => [
        'Client kickoff email' => [
          'Information process',
          'Tool introductions',
          'Initial needed content/info from client',
          '"The next steps" at a high-level'
        ]
      ],
      'Finalizing designs' => [
        'Imagery',
        'Icons',
        'Functionality'
      ],
      'Design pitch' => [
        'Deliverables' => [
          'Emailed approval'
        ]
      ],
      'Design technical assessment',
      'Project kickoff meeting' => [
        'Team design approval',
        'Role specific notes/discovery'
      ],
      'Design revision/finalization' => [
        'Approval'
      ]
    ],

    'Build Phase' => [
      'Design delivery to development',
      'Setup development tasks' => [
        'Front-end conversion of design' => [
          'Build all pages',
          'Populate pages with current end user content',
          'Screenshot for QA'
        ],
        'Front-end QA' => [
          'Visual tests' => [
            'Browser sizing tests' => [
              'Collapsing, stacking, margins, and padding'
            ],
            'Fonts',
            'Colour',
            'Content (copy and images)'
          ]
        ],
        'Back-end requirement discovery' => [
          'Functionality requirements'
        ],
        'Back-end implementations' => [
          'CMS, ERD, APIs, Functional Solutions',
          'Back-end QA' => [
            'Functional requirements',
            'Technology requirements'
          ]
        ],
        'Full-tilt production'
      ]
    ],

    'Quality Assurance Phase' => [
      'Tech lead QA' => [
        'Browser testing (device and size)' => [
          'Visual QA',
          'Functional QA' => [
            'Form testing',
            'CMS testing'
          ],
          'Link test',
          'Speed/optimization tests'
        ],
        'Meta/SEO testing'
      ],
      'Team QA (design and operations)' => [
        'Final QA approval'
      ]
    ],

    'Client Review Phase' => [
      'Round 1 of revisions' => [
        'Fine tooth comb list (page by page)' => [
          'Copy',
          'Visual'
        ]
      ], 
      'Round 2 of revisions' => [
        'Any final outliers'
      ]
    ],

    'Go Live Phase' => [
      'Domain hosting setup (if not done in setup)',
      'Analytics' => [
        'Implemented UA code',
        'Setting up goals in GA'
      ],
      'Quality assessment' => [
        'Speed/optimization testing',
        'Link test',
        'Crawl test',
        'Browser testing across devices',
        'Testing initial goals and traffic in GA'
      ]
    ],

    'Launch Phase' => [
      '24/48 hour check of analytics',
      '24/48 hour link check',
      '24/48 hour form check',
      '24/48 hour email check'
    ]
  ];


  // Build out tree
  $tree = [];

  $result = html_build_tree( $hierarcy, $tree );

  function html_build_tree ( $hierarcy, &$tree ) {
    $tree = !empty ( $tree ) ? $tree : [];

    $tree[] = "<ul>";
    foreach ( $hierarcy as $key => $value ) {
      if ( is_array( $value ) ) {
        $tree[] = "<li class='heading'>";
        $tree[] = "<span class='heading-closed'>{$key}</span>";
        html_build_tree( $value, $tree );
      } else {
        $tree[] = "<li><span>{$value}</span></li>";
      }
      $tree[] = "</li>";
    }

    $tree[] = "</ul>";

    return $tree;
  }

?>

<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fireside Web Process Flow</title>

    <style>
      ul {
        list-style: none;
      }

      ul > li {
        line-height: 1.8em;
      }
      
      div > ul:first-child > li {
        margin-bottom: 2em;
        border-bottom: 1px solid #ccc;
      }

      div > ul:first-child > li > span {
        font-size: 1.25em;
      }

      div > ul:first-child > li > ul {
        margin-top: 1em !important;
        margin-bottom: 2em !important;
      }

      .heading > .heading-closed:after {
        font-family: FontAwesome;
        content: " \f0da";
      }

      .heading > ul {
        display: none;
      }

      .heading > .heading-open:after {
        font-family: FontAwesome;
        content: " \f0d7";
      }

      .show {
        display: inherit;
      }
    </style>
  </head>

  <body>
    <div class="container">
      <h1 class="page-header">Fireside Web Process Flow</h1>

      <div>
        <?= implode( '', $result ) ?>
      </div>

      <div>
        <button id="de-collapse" class="btn btn-danger" type="button">Toggle Collapse</button>
      </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      $(function(){
        $(".heading").on("click", function (e) {
          if ( $(this).find('ul').first().hasClass('show') ) {
            $(this).find('.heading-closed').removeClass('heading-open');
            $(this).find('ul').removeClass('show');
          } else {
            $(this).find('.heading-closed').first().addClass('heading-open');
            $(this).find('ul').first().addClass('show');
          }
          e.stopPropagation();
        });

        $("#de-collapse").on("click", function () {
          $('.heading').click();
        });
      })
    </script>
  </body>
  
</html>




















