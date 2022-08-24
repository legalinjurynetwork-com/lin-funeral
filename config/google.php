<?php

return [

'client_id'        => env('GOOGLE_CLIENT_ID', ''),
'client_secret'    => env('GOOGLE_CLIENT_SECRET', ''),
'redirect_uri'     => env('GOOGLE_REDIRECT', ''),
'scopes'           => [\Google_Service_Sheets::DRIVE, \Google_Service_Sheets::SPREADSHEETS],
'access_type'      => 'online',
'approval_prompt'  => 'auto',
'prompt'           => 'consent',

];
