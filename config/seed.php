<?php
return [
    'cms_blocks' => [
        [
            'id' => '01dab545-cd82-427e-a1d5-9763cb2ca7cb',
            'cms_row_id' => '7a8dc8ff-c3bb-4116-a2ab-440b45de775b',
            'status' => 'active',
            'column_index' => 1,
            'position' => 1,
            'widget' => 'Cms.Html',
            'block_data' => [
                'html' => 'Hello',
            ],
            'created' => '2015-09-15 07:29:35',
            'modified' => '2015-09-15 07:29:45'
        ],
        [
            'id' => '1cf60b5a-84ff-4404-a6ee-299b37033f56',
            'cms_row_id' => '7a8dc8ff-c3bb-4116-a2ab-440b45de775b',
            'status' => 'active',
            'column_index' => 2,
            'position' => 1,
            'widget' => 'Cms.TinyMce',
            'block_data' => [
                'html' => '<p><strong>World</strong></p>',
            ],
            'created' => '2015-09-15 07:29:52',
            'modified' => '2015-09-15 07:30:11'
        ],
        [
            'id' => '66ea9935-6f1c-423a-9ab5-c2e2e4c54a3e',
            'cms_row_id' => '7a8dc8ff-c3bb-4116-a2ab-440b45de775b',
            'status' => 'active',
            'column_index' => 3,
            'position' => 1,
            'widget' => 'Cms.Html',
            'block_data' => [
                'html' => '!',
            ],
            'created' => '2015-09-15 07:30:21',
            'modified' => '2015-09-15 07:30:28'
        ],

    ],
    'cms_pages' => [
        [
            'id' => '71650c0c-9ce6-4faa-9f8e-f7475e1a1e88',
            'slug' => 'demo/content/cms-page',
            'name' => 'CMS Demo Page',
            'status' => 'active',
            'created' => '2015-09-15 07:29:23',
            'modified' => '2015-09-15 07:29:23'
        ],

    ],
    'cms_rows' => [
        [
            'id' => '7a8dc8ff-c3bb-4116-a2ab-440b45de775b',
            'cms_page_id' => '71650c0c-9ce6-4faa-9f8e-f7475e1a1e88',
            'layout' => '4-4-4',
            'position' => 1,
            'created' => '2015-09-15 07:29:29',
            'modified' => '2015-09-15 07:29:29'
        ],

    ],
    'i18n' => [
        [
            'id' => 1,
            'locale' => 'en',
            'model' => 'NotificationContents',
            'foreign_key' => 'fd77e860-dbe0-4e60-8939-56cc841cc3eb',
            'field' => 'email_subject',
            'content' => 'Reset your password'
        ],
        [
            'id' => 2,
            'locale' => 'en',
            'model' => 'NotificationContents',
            'foreign_key' => 'fd77e860-dbe0-4e60-8939-56cc841cc3eb',
            'field' => 'email_html',
            'content' => 'Dear {{user.firstname}} {{user.lastname}},
<br><br>
here\'s the link to reset your password: {{reset_password_link}}'
        ],

    ],
    'notification_contents' => [
        [
            'id' => 'fd77e860-dbe0-4e60-8939-56cc841cc3eb',
            'notification_identifier' => 'forgot_password',
            'notes' => '{user.firstname} {user.lastname}',
            'created' => '2015-08-18 09:52:32',
            'modified' => '2015-08-18 09:52:32'
        ],

    ],
    'users' => [
        [
            'id' => 'ec3a29cf-063e-4e48-a9a0-0c266b4f8503',
            'status' => 'active',
            'role' => 'admin',
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => '$2y$10$M8Mhbt2q2rwB49NeWApElO52lR2M1vVlom/cnxjoevuFUPuk.Mm0.',
            'failed_login_count' => 0,
            'failed_login_timestamp' => null,
            'api_token' => null,
            'created' => '2015-08-28 14:25:16',
            'modified' => '2015-09-09 09:04:40'
        ],

    ],
];
