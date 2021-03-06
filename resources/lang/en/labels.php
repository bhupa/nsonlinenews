<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Pagination Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the paginator library to build
    | the simple pagination links. You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */
    'form'=>[
        'No thing selected' =>'कुनै चीज चयन गरिएको छैन',
        'orderlist' =>'क्रम सूची',
        'on'=>'प्रकाशित',
        'off'=>'अप्रकाशित'
    ],
   'admin' =>[
       'dashboard' =>'ड्यासबोर्ड',
       'permission' => [
        'name' =>'अनुमति',
           'list' => 'अनुमति सूची',
           'add' => 'अनुमति थप गर्नुहोस्',
           'edit' =>'अनुमति सम्पादन गर्नुहोस्',
           'delete' => 'अनुमति मेटाउनुहोस्',

           'table' =>[
               'name' =>'नाम',
               'slug' =>'शीर्षक',
               'action' =>'कार्य'
           ]
    ],
       'role' => [
           'name' =>'भूमिका',
           'list' => 'भूमिका सूची',
           'add' => 'भूमिका थप गर्नुहोस्',
           'edit' =>'भूमिका सम्पादन गर्नुहोस्',
           'delete' => 'भूमिका मेटाउनुहोस्',
            'table' =>[
                'name' =>'नाम',
                'created_at' =>'मा बनाइयो',
                'updated_at' =>'अपडेट गरियो',
                'action' =>'कार्य'
            ]
       ],

       'category' => [
           'name' =>'वर्ग',
           'list' => 'वर्ग सूची',
           'add' => 'वर्ग थप गर्नुहोस्',
           'edit' =>'वर्ग सम्पादन गर्नुहोस्',
           'delete' => 'वर्ग मेटाउनुहोस्',
           'change_status' =>' वर्ग स्थति परिवर्तन गर्नुहोस्',
           'table' =>[
               'name' =>'नाम',
               'created_at' =>'मा बनाइयो',
               'updated_at' =>'अपडेट गरियो',
               'action' =>'कार्य',
               'display_in'=>'प्रदर्शन गर्नुहोस्',
               'orderlist'=>'क्रम सूची',
               'publish' =>'प्रकाशित गर्नुहोस्'
           ]
       ],
       'subcategory' => [
           'name' =>'उप-कोटि',
           'list' => 'उप-कोटि सूची',
           'add' => 'उप-कोटि थप गर्नुहोस्',
           'edit' =>'उप-कोटि सम्पादन गर्नुहोस्',
           'delete' => 'उप-कोटि मेटाउनुहोस्',
           'table' =>[
               'name' =>'नाम',
               'display_in' =>'प्रदर्शन गर्नुहोस्',
               'category' =>'वर्ग नाम',
               'action' =>'कार्य'
           ],
           'form' =>[],
           'button' =>''

       ],
       'news' =>[
           'name' => 'समाचार',
           'list' => 'समाचार सूची',
           'add' => 'समाचार थप गर्नुहोस्',
           'edit' =>'समाचार सम्पादन गर्नुहोस्',
           'delete' => 'समाचार मेटाउनुहोस्',
           'viewed' =>'धेरै हेरिएको',
           'change_status' =>' समाचार  स्थति परिवर्तन गर्नुहोस्',
           'table' =>[
               'name' =>'समाचार शीर्षक',
               'subcategory' =>'उप-कोटि नाम ',
               'category' =>'वर्ग नाम',
               'shortdescription' =>'छोटो वर्णन',
               'description'=>'वर्णन',
               'publish' =>'प्रकाशित मिति',
               'action' =>'कार्य',
               'images' =>'तस्बिरहरू'
           ]
       ],
       'gallery' =>[
    'name' => 'गैलरी',
           'list' => 'गैलरी सूची',
           'add' => 'गैलरी थप गर्नुहोस्',
           'edit' =>'गैलरी सम्पादन गर्नुहोस्',
           'delete' => 'गैलरी मेटाउनुहोस्',
           'change_status' =>' गैलरी स्थति परिवर्तन गर्नुहोस्',
           'add_image' =>'फोटो थप गर्नुहोस्',
           'table' =>[
               'name' =>'नाम',
               'image' =>'फोटो ',
               'description' =>'वर्णन',
               'action' =>'कार्य'
           ]
],
       'video' =>[
           'name' => 'भिडियो',
           'list' => 'भिडियो सूची',
           'add' => 'भिडियो थप गर्नुहोस्',
           'edit' =>'भिडियो सम्पादन गर्नुहोस्',
           'delete' => 'भिडियो मेटाउनुहोस्',
           'change_status' =>' भिडियो स्थति परिवर्तन गर्नुहोस्',
           'table' =>[
               'title' =>'नाम',
               'url' =>'भिडियो',
               'action' =>'कार्य',
               'image' =>'फोटो ',
           ]
       ],
            'user' =>[
                    'name' => 'प्रयोगकर्ता',
                    'list' => 'प्रयोगकर्ता सूची',
                    'add' => 'प्रयोगकर्ता थप गर्नुहोस्',
                    'edit' =>'प्रयोगकर्ता सम्पादन गर्नुहोस्',
                     'assign-role' =>'भूमिका थप गर्नुहोस्',
                    'assign-category' =>'वर्ग थप गर्नुहोस्',
                    'delete' => 'प्रयोगकर्ता मेटाउनुहोस्',
                    'change_status' =>' प्रयोगकर्ता स्थति परिवर्तन गर्नुहोस्',

                    'table' =>[
                        'name' =>'नाम',
                        'role' =>'भूमिका',
                        'phone' =>'फोन',
                        'email' =>'इमेल',
                        'action' =>'कार्य'
                    ]
],
       'advertising' =>[
           'name' => 'विज्ञापन',
           'list' => 'विज्ञापन सूची',
           'add' => 'विज्ञापन थप गर्नुहोस्',
           'edit' =>'विज्ञापन सम्पादन गर्नुहोस्',
           'delete' => 'विज्ञापन मेटाउनुहोस्',
           'change_status' =>' विज्ञापन स्थति परिवर्तन गर्नुहोस्',
           'table' =>[
               'name' =>'नाम',
               'image' =>'फोटो ',
               'action' =>'कार्य',
                'change_status' =>' विज्ञापन  स्थति परिवर्तन गर्नुहोस्',
           ]
       ],
       'popup' =>[
           'name' => 'पपअप',
           'list' => 'पपअप सूची',
           'add' => 'पपअप थप गर्नुहोस्',
           'edit' =>'पपअप सम्पादन गर्नुहोस्',
           'delete' => 'पपअप मेटाउनुहोस्',
           'change_status' =>' पपअप स्थति परिवर्तन गर्नुहोस्',
           'table' =>[
               'name' =>'नाम',
               'image' =>'फोटो ',
               'action' =>'कार्य',
               'change_status' =>' पपअप  स्थति परिवर्तन गर्नुहोस्',
           ]
       ]
    ],
    'next' => 'Next &raquo;',

];
