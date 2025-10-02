<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/sanctum/csrf-cookie' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'sanctum.csrf-cookie',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/health' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7DJbs54BkHRb6sHt',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/health/database' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PKGoyToUGISH3Skr',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/health/info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::wM2sGaGbjjR1wltl',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/diagnose/data-flow' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fKUy6fiPUDsDDF74',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/verify/webhook-execution' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::shR0u8zLBiQ3yhnk',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/webhook/status' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::07LEBsZknjig6oDM',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/test/simple' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Md2xD7mb3HByhjeT',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/test/system' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::NZE8h4wY79ebBW03',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/test/auth' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::m4q1UnwwtjMpuLkS',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/test/setup' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::XL1WWQeJXn6Ao02e',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/test/cookies' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::wkOrg3ObGFsqYeFK',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/test/simple-debug' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7ekHzhyGd67Q81fM',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/test/debug-auth' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5EBVBdohyfitMRHd',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/test/customers-basic' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::k9mNaXzpPpKFqR4X',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/test/line-user/system' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::84MMTPU4MxcCcs5p',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/test/line-user/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::zzZbaLGd4C2gj1N7',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/test/line-user/re-adding' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2xdJkJ3uJNSbwQ3w',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/test/line-user/business-name' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qKY22DLNEhxTM5BE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/test/line-user/check-columns' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::LcBcGCN8yNJovDca',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/test/line-user/basic' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::MAyrvluTuieOcCDU',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/websites-filled-test' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cTgYSlj8ZXpMdqAb',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/websites-direct-test' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::nk612sUVPpvl56kd',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/websites-simple-step' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KFPsHDxRfayscdUJ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/websites-step-by-step' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RRCQhZfrcvbRMMNE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/websites-frontend-test' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::eznzEifJ4OEetMkc',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/websites-check' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::aGtCHKa5XMSOQo8d',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/test/webhook-firebase' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::N3J1ccqxhf3oSdiA',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/line/settings/test' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HCpCvKTcdn58oTwZ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/line/info-with-signature-test' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VfZDJRUR7iaTrB3n',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/webhook-diagnosis' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::uVGtaEtBEkDIokFH',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/simulate-webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Bw0rMiTVbzfntlvj',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/firebase/diagnostic' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::gi2ezbJGNsCCsdVr',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/firebase/diagnostic' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Lsfyo1MSZYSmowcq',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/firebase/status' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pMl4z8tJU1SIT0wq',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/test/webhook-firebase-sync' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::XNyGDDlzrm7ifnv0',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/test/complete-webhook-flow' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5gNcrQRhRwNQlS6m',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/recent-chats' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZyVyjEOYZ0weSIk6',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/simple-health' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::lDaVChLZK0EvWKtS',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/test-mysql-creation' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::d32wIcyz8FFw2YT9',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/point20-mysql-test' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::X0eb4wvCVCrGW2NV',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/point20-simple-test' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3j2oA8cJkFypqC3P',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/point20-customer-test' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QUVmtieH2QzUnJ6U',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/point20-database-test' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tTL889wfLY1qucGE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/point20-conversation-raw-test' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CzwLJRYAQPSd75Ju',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/diagnostic/basic-health' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::q4yAV39mWgKYDJWw',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/diagnostic/database-check' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::zIHrMwJ00qLezTIE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/diagnostic/test-data-creation' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::XeGYf1Gz6H0w1GlL',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/auth/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'login',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/auth/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::AAsd6x2hEAdOMzEN',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/auth/refresh' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::SXgh8PTNXxMr4ZBJ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/line/webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rcXqcHqfsW3pgwjP',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/line/webhook-test' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9qnjfE64YfohJTyR',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/line/webhook-simple' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::s1DgM9nPkgc9pTQd',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/line/webhook-debug' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KXqogTboQnKBMa2J',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/line/webhook-nosig' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KHRhTCxX7vFFFwJj',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/line/webhook-simulate' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::6gyHwxunBHbDBG9m',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/webhook/wp' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::eyPQJYWuBMWNyRDy',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/webhook/execution-logs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WgUVgqdTeDGoLqqL',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/broadcasting/auth' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::945MJzAH9V9U6Oad',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/auth/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VCgwGqL1yHFI5VjF',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/auth/me' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Mzga77e2fMjQKFSL',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/auth/profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ef0uZUaqtKyCuKRX',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/dashboard/stats' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7oT5a9EKwPJzE6UX',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/dashboard/recent-customers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7Vt1niaUp1figPns',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/dashboard/monthly-summary' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BPC6a4MCfVGOvEMH',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/dashboard/charts' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::u4VPsHsAcGRsREKQ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/customers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customers.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'customers.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/tracking/customers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ARv2XIASBlPZqRoy',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/tracking/sales-users' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::wqK0Xy6p27UHR6Hl',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/contact-schedules' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0AUY90UrkmlViMpJ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::JoMihPCS7GHxqK24',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/contact-schedules/overdue/list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OpqPuBUSoNhZqY86',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/contact-schedules/today/list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::8W06ltABKXbONnTz',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/contact-schedules/reminders/list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::aiazpSjDuqunFTTV',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/contact-schedules/calendar/data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rRqDQ3Dlr1v1IrPN',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/chats' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::iB75R4PgcxTLzXqo',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/chats/search' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::uRt3VbaX5wFKq2it',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/chats/stats' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PlVUaaZxJIlgAIBi',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/chats/test-permissions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pWzAtkhtCIwXhPgE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/chats/unread/count' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::XZtMvfYCQIChoYin',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/chats/poll-updates' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::1pA5bTSoeUD5uU9Q',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/chats/incremental' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ObBdnendkmIRFio3',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/chats/validate-checksum' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::V7XTR9OF34pQErBc',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/firebase/chat/conversations' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CuIfuqIrMmHbH68U',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/firebase/chat/sync' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::uLtMLMvWCzPr08WY',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/firebase/chat/health' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::70gnKkD1UecZiwu2',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/firebase/chat/validate' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qwhVe10JGQIXIwxL',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/firebase/chat/cleanup' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hYmg9TY6RxxZhOdv',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/system/health' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KLN6ox4TIRVNodYa',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/system/info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::N88QwqPIQi0BRGmJ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/firebase/batch-sync' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::nvX4hrNPaOjEEeKU',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/firebase/reset' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ktqAxxV1qcbIR0Vl',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/firebase/test-connection' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::19FXCzEvvsoywBA7',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/line/settings' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ajbWmuVSne08S0Gq',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9jF3WCuzwi9VzNP4',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/chat/batch-sync' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RivVfx8jqhncqVQG',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/chat/full-sync' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BPHdNqUFNBwjMi7f',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/chat/validate-integrity' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mP1D8gMYEdWjBNxj',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/chat/cleanup-firebase' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mlDPq8FNmHJ81IJz',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/debug/firebase/health-extended' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hLBZorSLhAgepgRn',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/version/current' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Us4KYRMVCZ41ahlG',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/version/changes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mzLgLJtzIUS5sknN',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/version/history' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ODizBnI4ZZG3YlHA',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/version/check-conflict' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xrlrv5SHwaJetF2U',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/version/stats' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ytSuKVy3uFxjSFup',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/websites/options' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::DQBogEnoDqV2l8QA',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/webhook-logs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::d1YjQk7AIWKsEdZ6',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/webhook-logs/statistics' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::omSERDRIDTsOf5oE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/webhook-logs/recent' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hd1SdZCBKaWlwCBM',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/webhook-logs/export' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::zzWYpIvWMGxcUuTN',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/chats/admin/query-stats' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mVZSsI0RlW5F1NkK',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/chats/admin/clear-cache' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::UQAIHO2nNAHD0Rox',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/users' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RggGKSVdUKOCOALj',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cOcrHi0VMqIxxvSM',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/roles' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::GTBBZTTZIPvYOCfW',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/users/stats/overview' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BcCMdMkCK2WjEPoy',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/permissions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ShtMm5DyobONXMu6',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/websites' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'websites.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'websites.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/websites-statistics' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::wqsJJwNnctU365Sq',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/field-mappings/system-fields' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hySbqx7Xg03judy6',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::F2al8jbcWrnKsQXB',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/leads' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WH9WDHWKVmrBVEGO',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/leads/submittable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tbE4Swaor81daPMb',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/cases' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::98gHNTw0RW5vOI4N',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::bVNBK9KlqrFpm42B',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/cases/status-summary' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::UYH7IrLLSvBdoGrb',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/bank-records' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0Eh4ZdRsyQ67DlnP',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xjonFFi8qPGoNKoR',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/reports/daily' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PRd6HuHtaS8MzoF6',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/reports/monthly' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::18yPiPX5qOEPpdQ0',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/reports/website-performance' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::w6VtTJ7TMMcIj9tv',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/reports/region-performance' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sHief9q1vnRkCuyp',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/reports/approval-rates' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2VWbaNIpEIhvtrk7',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/custom-fields' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WVvbKxWDKLjIHeGD',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FpDeaVsmRwaec736',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/line-integration/settings' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::bcYfNQV5wQfVlxIa',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tc2vjCQL6TVLyLo7',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/line-integration/test-connection' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WM9wu9FZv4yjyqle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/line-integration/debug-connection' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::NmZZvWqL9cjmx9g4',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/line-integration/bot-info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::8u9ipZTpZMV55LVK',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/line-integration/stats' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::B9jPtmjozj42Xd4b',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/line-integration/recent-conversations' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::wM6gbjWPzs9CnV5a',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/line-integration/send-message' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::lCjbsxQYpCSwHdw0',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/test-mysql-point20' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::nNF2FC8WBAsVLuJl',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::GoUHrtc22pTCD8vJ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/health' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3ALxlaFQtZ24Vl1f',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/broadcasting/auth' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9zDCNe6iT6EzHCe4',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/firebase-test' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZQJkSKFzwEKaOh9h',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/env-diagnosis' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::eLCRC2Hy7kXxdZ53',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/refresh-firebase-config' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VCinGu2v9oxCJwVk',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/debug-login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::28MTwC2sWv3s1JFG',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/api/(?|test/customers/([^/]++)/(?|delete(*:48)|force\\-delete(*:68))|web(?|hook(?|/execution\\-logs/([^/]++)(*:114)|\\-logs/(?|execution/([^/]++)(*:150)|([^/]++)(*:166)|cleanup(*:181)))|sites/([^/]++)(?|(*:208)|/(?|statistics(*:230)|field\\-mappings(?|(*:256)|/(?|defaults(*:276)|test(*:288))))))|c(?|ustom(?|ers/(?|([^/]++)(?|(*:331)|/(?|track(*:348)|status(*:362)|assign(*:376)|history(*:391)))|submittable(*:412)|([^/]++)/(?|l(?|evel(*:440)|ine/(?|link(*:459)|unlink(*:473)|friend\\-status(*:495)))|blacklist/(?|report(*:524)|approve(*:539)|toggle\\-hide(*:559))|cases(*:573)))|\\-fields/(?|([^/]++)(?|(*:606))|set\\-value(*:625)))|ontact\\-schedules/([^/]++)(?|(*:664)|/(?|contacted(*:685)|reschedule(*:703)))|hats/(?|([^/]++)(?|(*:732)|/re(?|ply(*:749)|ad(*:759))|(*:768))|test\\-websocket(*:792))|ases/([^/]++)(?|(*:817)|/assign(*:832)|(*:840)))|firebase/chat/(?|messages/([^/]++)(*:884)|sync/customer/([^/]++)(*:914))|sync/([^/]++)(?|(*:939)|/(?|validate(*:959)|stats(*:972)))|users/([^/]++)(?|(*:999)|/roles(?|(*:1016)|/([^/]++)(*:1034)|(*:1043)))|permissions/category/([^/]++)(*:1083)|roles/([^/]++)/permissions(?|(*:1121)|/([^/]++)(*:1139))|leads/([^/]++)(?|(*:1166)|/line\\-name(*:1186))|bank\\-records/([^/]++)(*:1218)))/?$}sDu',
    ),
    3 => 
    array (
      48 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::e3EWMxSQ2SgSOPIM',
          ),
          1 => 
          array (
            0 => 'customer',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      68 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qxhiw74WHQQKLeYT',
          ),
          1 => 
          array (
            0 => 'customer',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      114 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ntTC0RJK8lMrf9lx',
          ),
          1 => 
          array (
            0 => 'executionId',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      150 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qwHw3dd7vfs5nPfF',
          ),
          1 => 
          array (
            0 => 'executionId',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      166 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::naDPPHMP87x6qS67',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      181 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7zCHacC9k9tfRAEt',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      208 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'websites.show',
          ),
          1 => 
          array (
            0 => 'website',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'websites.update',
          ),
          1 => 
          array (
            0 => 'website',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'websites.destroy',
          ),
          1 => 
          array (
            0 => 'website',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      230 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::adr3KRE5nTKY0E7w',
          ),
          1 => 
          array (
            0 => 'website',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      256 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::M07nHe0jds9ZZlLj',
          ),
          1 => 
          array (
            0 => 'website',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ssddCNu7iNj0BVbX',
          ),
          1 => 
          array (
            0 => 'website',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      276 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::N6EbuDOgLs4Skrh8',
          ),
          1 => 
          array (
            0 => 'website',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      288 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::uOeOSlw1rC30MApO',
          ),
          1 => 
          array (
            0 => 'website',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      331 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customers.show',
          ),
          1 => 
          array (
            0 => 'customer',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'customers.update',
          ),
          1 => 
          array (
            0 => 'customer',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'customers.destroy',
          ),
          1 => 
          array (
            0 => 'customer',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      348 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::MBfQg8Zv56oF331M',
          ),
          1 => 
          array (
            0 => 'customer',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      362 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QPazaw8sSLOcEuMR',
          ),
          1 => 
          array (
            0 => 'customer',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      376 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::X41Jq81VHF9TnE7E',
          ),
          1 => 
          array (
            0 => 'customer',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      391 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::GOWAxlbx4EI2M5Pb',
          ),
          1 => 
          array (
            0 => 'customer',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      412 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PNWExloxOhGtDY4q',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      440 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9uu7ns7G0itz5WSG',
          ),
          1 => 
          array (
            0 => 'customer',
          ),
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      459 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::X3U2eaMGT7PtfUhP',
          ),
          1 => 
          array (
            0 => 'customer',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      473 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HMh9MArohYEWJrbO',
          ),
          1 => 
          array (
            0 => 'customer',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      495 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QyVR6wnhQziloXO1',
          ),
          1 => 
          array (
            0 => 'customer',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      524 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::x4iYXwCMEdLFGOeK',
          ),
          1 => 
          array (
            0 => 'customer',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      539 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CJqpstD3OAJHTlSg',
          ),
          1 => 
          array (
            0 => 'customer',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      559 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7X2kDkanV9Mub3Nt',
          ),
          1 => 
          array (
            0 => 'customer',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      573 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tXVuGty8N4RcinRc',
          ),
          1 => 
          array (
            0 => 'customer',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      606 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HLMn7aIe4jQywOQA',
          ),
          1 => 
          array (
            0 => 'field',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TBHdnjche85SDMDU',
          ),
          1 => 
          array (
            0 => 'field',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      625 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2WcUjzkhN5e7KMWm',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      664 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::oUsUwmJB81k6AJjT',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ucIjEztckBcFidEC',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7ILWxAgAoprLbMTP',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      685 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OXBkbQ2K5AZKIIi1',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      703 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hOcngqddfyDFO91H',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      732 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::EYJrCLW5bVlfB2ls',
          ),
          1 => 
          array (
            0 => 'userId',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      749 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::boe48eSeW8wtn7gT',
          ),
          1 => 
          array (
            0 => 'userId',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      759 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YV1fNM3yD1fOa5sM',
          ),
          1 => 
          array (
            0 => 'userId',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      768 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TntEROkHuihCimne',
          ),
          1 => 
          array (
            0 => 'userId',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      792 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xeh9I9mZFbJDoMQJ',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      817 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::EyBviiTW0bMlV41b',
          ),
          1 => 
          array (
            0 => 'case',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::oBxuoGPM0qfQNNu7',
          ),
          1 => 
          array (
            0 => 'case',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      832 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::1HeVm2uTckcnayip',
          ),
          1 => 
          array (
            0 => 'case',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      840 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::EHKXe1AIwBFQdSKQ',
          ),
          1 => 
          array (
            0 => 'case',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      884 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::n3D7lJipmtSbk7Ts',
          ),
          1 => 
          array (
            0 => 'userId',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      914 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::n58ItzfOSVd1iteK',
          ),
          1 => 
          array (
            0 => 'customerId',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      939 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PXPIMM8cIKvpgLxc',
          ),
          1 => 
          array (
            0 => 'entityType',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      959 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pBk32lz7Ave3FhuE',
          ),
          1 => 
          array (
            0 => 'entityType',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      972 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::oftqdClvRtgSjk0m',
          ),
          1 => 
          array (
            0 => 'entityType',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      999 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fMtez7CTAKB6xMBi',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cmkIyfBI7NXdEust',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BxXp9VGTk7lmGwO4',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1016 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Ulfk5KCULffF2J2i',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1034 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::bSwPspz0LFqMP4uQ',
          ),
          1 => 
          array (
            0 => 'user',
            1 => 'role',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1043 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cTgB9nooA72wLO1q',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1083 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tnIHdPQMEhULkXre',
          ),
          1 => 
          array (
            0 => 'category',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1121 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ymBST9LDRfCGIFkP',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jzLUfjPsl6qnKgKC',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1139 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KptrZLXKI08fcRUP',
          ),
          1 => 
          array (
            0 => 'role',
            1 => 'permissionName',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1166 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sdxBJnF7aKMG7qCD',
          ),
          1 => 
          array (
            0 => 'lead',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Rqip8P9Bym1Yboxi',
          ),
          1 => 
          array (
            0 => 'lead',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rhdYSRmzJIYSR0X9',
          ),
          1 => 
          array (
            0 => 'lead',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1186 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ReabcagiP9i9RtMU',
          ),
          1 => 
          array (
            0 => 'lead',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1218 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::zxgRxuDcwWX17Mxn',
          ),
          1 => 
          array (
            0 => 'record',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'sanctum.csrf-cookie' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sanctum/csrf-cookie',
      'action' => 
      array (
        'uses' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'controller' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'namespace' => NULL,
        'prefix' => 'sanctum',
        'where' => 
        array (
        ),
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'sanctum.csrf-cookie',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7DJbs54BkHRb6sHt' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/health',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\HealthController@check',
        'controller' => 'App\\Http\\Controllers\\HealthController@check',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::7DJbs54BkHRb6sHt',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PKGoyToUGISH3Skr' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/health/database',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\HealthController@database',
        'controller' => 'App\\Http\\Controllers\\HealthController@database',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::PKGoyToUGISH3Skr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wM2sGaGbjjR1wltl' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/health/info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\HealthController@info',
        'controller' => 'App\\Http\\Controllers\\HealthController@info',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::wM2sGaGbjjR1wltl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fKUy6fiPUDsDDF74' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/diagnose/data-flow',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@diagnoseDataFlow',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@diagnoseDataFlow',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::fKUy6fiPUDsDDF74',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::shR0u8zLBiQ3yhnk' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/verify/webhook-execution',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@verifyWebhookExecution',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@verifyWebhookExecution',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::shR0u8zLBiQ3yhnk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::07LEBsZknjig6oDM' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webhook/status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@webhookStatus',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@webhookStatus',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::07LEBsZknjig6oDM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Md2xD7mb3HByhjeT' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/test/simple',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:77:"function() { return [\'status\' => \'ok\', \'timestamp\' => \\now()->format(\'c\')]; }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000000000074d0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::Md2xD7mb3HByhjeT',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NZE8h4wY79ebBW03' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/test/system',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\TestController@systemTest',
        'controller' => 'App\\Http\\Controllers\\TestController@systemTest',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::NZE8h4wY79ebBW03',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::m4q1UnwwtjMpuLkS' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/test/auth',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\TestController@authTest',
        'controller' => 'App\\Http\\Controllers\\TestController@authTest',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::m4q1UnwwtjMpuLkS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::XL1WWQeJXn6Ao02e' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/test/setup',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\TestController@setupStatus',
        'controller' => 'App\\Http\\Controllers\\TestController@setupStatus',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::XL1WWQeJXn6Ao02e',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wkOrg3ObGFsqYeFK' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/test/cookies',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\TestController@cookieTest',
        'controller' => 'App\\Http\\Controllers\\TestController@cookieTest',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::wkOrg3ObGFsqYeFK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7ekHzhyGd67Q81fM' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/test/simple-debug',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\TestController@simpleDebug',
        'controller' => 'App\\Http\\Controllers\\TestController@simpleDebug',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::7ekHzhyGd67Q81fM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5EBVBdohyfitMRHd' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/test/debug-auth',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\TestController@detailedAuthDebug',
        'controller' => 'App\\Http\\Controllers\\TestController@detailedAuthDebug',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::5EBVBdohyfitMRHd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::k9mNaXzpPpKFqR4X' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/test/customers-basic',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\TestController@testCustomersBasic',
        'controller' => 'App\\Http\\Controllers\\TestController@testCustomersBasic',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::k9mNaXzpPpKFqR4X',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::84MMTPU4MxcCcs5p' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/test/line-user/system',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\LineUserTestController@testSystem',
        'controller' => 'App\\Http\\Controllers\\Api\\LineUserTestController@testSystem',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::84MMTPU4MxcCcs5p',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::zzZbaLGd4C2gj1N7' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/test/line-user/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\LineUserTestController@testCreateUser',
        'controller' => 'App\\Http\\Controllers\\Api\\LineUserTestController@testCreateUser',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::zzZbaLGd4C2gj1N7',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2xdJkJ3uJNSbwQ3w' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/test/line-user/re-adding',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\LineUserTestController@testReAddingFriend',
        'controller' => 'App\\Http\\Controllers\\Api\\LineUserTestController@testReAddingFriend',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::2xdJkJ3uJNSbwQ3w',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qKY22DLNEhxTM5BE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/test/line-user/business-name',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\LineUserTestController@testBusinessDisplayName',
        'controller' => 'App\\Http\\Controllers\\Api\\LineUserTestController@testBusinessDisplayName',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::qKY22DLNEhxTM5BE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::LcBcGCN8yNJovDca' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/test/line-user/check-columns',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:1050:"function() {
    try {
        $columns = \\Schema::getColumnListing(\'line_users\');
        $hasBusinessColumns = \\in_array(\'business_display_name\', $columns);
        
        return \\response()->json([
            \'success\' => true,
            \'table_exists\' => \\Schema::hasTable(\'line_users\'),
            \'all_columns\' => $columns,
            \'has_business_columns\' => $hasBusinessColumns,
            \'business_columns\' => [
                \'business_display_name\' => \\in_array(\'business_display_name\', $columns),
                \'business_name_updated_by\' => \\in_array(\'business_name_updated_by\', $columns),
                \'business_name_updated_at\' => \\in_array(\'business_name_updated_at\', $columns),
            ],
            \'migration_status\' => $hasBusinessColumns ? \'completed\' : \'pending\',
            \'timestamp\' => \\now()->format(\'c\')
        ]);
    } catch (\\Exception $e) {
        return \\response()->json([
            \'success\' => false,
            \'error\' => $e->getMessage()
        ], 500);
    }
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000000000075a0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::LcBcGCN8yNJovDca',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MAyrvluTuieOcCDU' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/test/line-user/basic',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:543:"function() {
    try {
        $exists = \\Schema::hasTable(\'line_users\');
        $count = $exists ? \\DB::table(\'line_users\')->count() : null;
        
        return \\response()->json([
            \'success\' => true,
            \'line_users_table_exists\' => $exists,
            \'record_count\' => $count,
            \'timestamp\' => \\now()->format(\'c\')
        ]);
    } catch (\\Exception $e) {
        return \\response()->json([
            \'success\' => false,
            \'error\' => $e->getMessage()
        ], 500);
    }
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000000000075c0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::MAyrvluTuieOcCDU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cTgYSlj8ZXpMdqAb' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/debug/websites-filled-test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:1148:"function() {
    try {
        $request = \\request();
        
        return \\response()->json([
            \'success\' => true,
            \'parameters\' => [
                \'status_value\' => $request->get(\'status\', \'not_set\'),
                \'type_value\' => $request->get(\'type\', \'not_set\'),
                \'search_value\' => $request->get(\'search\', \'not_set\'),
            ],
            \'has_checks\' => [
                \'has_status\' => $request->has(\'status\'),
                \'has_type\' => $request->has(\'type\'), 
                \'has_search\' => $request->has(\'search\'),
            ],
            \'filled_checks\' => [
                \'filled_status\' => $request->filled(\'status\'),
                \'filled_type\' => $request->filled(\'type\'),
                \'filled_search\' => $request->filled(\'search\'),
            ],
            \'basic_website_count\' => \\App\\Models\\Website::count(),
            \'timestamp\' => \\now()->format(\'c\')
        ]);
        
    } catch (\\Exception $e) {
        return \\response()->json([
            \'success\' => false,
            \'error\' => $e->getMessage()
        ]);
    }
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000000000075e0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::cTgYSlj8ZXpMdqAb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::nk612sUVPpvl56kd' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/debug/websites-direct-test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:2597:"function() {
    try {
        // Test the exact same logic as the controller
        $query = \\App\\Models\\Website::query();
        
        // Test the filtering logic with empty parameters
        $request = \\request();
        $status = $request->get(\'status\', \'\');
        $type = $request->get(\'type\', \'\');
        $search = $request->get(\'search\', \'\');
        
        $beforeFilters = $query->count();
        
        // Test filled() method behavior
        $statusFilled = $request->filled(\'status\');
        $typeFilled = $request->filled(\'type\'); 
        $searchFilled = $request->filled(\'search\');
        
        // Apply same filters as controller
        if ($request->filled(\'status\')) {
            $query->where(\'status\', $request->status);
        }
        
        if ($request->filled(\'type\')) {
            $query->where(\'type\', $request->type);
        }
        
        if ($request->filled(\'search\')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where(\'name\', \'like\', "%{$search}%")
                  ->orWhere(\'domain\', \'like\', "%{$search}%");
            });
        }
        
        $afterFilters = $query->count();
        
        // Apply ordering and pagination
        $query->orderBy(\'created_at\', \'desc\');
        $websites = $query->paginate(15);
        
        return \\response()->json([
            \'success\' => true,
            \'debug_info\' => [
                \'parameters\' => [
                    \'status\' => $status,
                    \'type\' => $type,
                    \'search\' => $search
                ],
                \'filled_checks\' => [
                    \'status_filled\' => $statusFilled,
                    \'type_filled\' => $typeFilled,
                    \'search_filled\' => $searchFilled
                ],
                \'counts\' => [
                    \'before_filters\' => $beforeFilters,
                    \'after_filters\' => $afterFilters,
                    \'paginated_total\' => $websites->total(),
                    \'paginated_count\' => $websites->count()
                ],
                \'first_item\' => $websites->items()[0] ?? null
            ],
            \'websites_data\' => $websites,
            \'timestamp\' => \\now()->format(\'c\')
        ]);
        
    } catch (\\Exception $e) {
        return \\response()->json([
            \'success\' => false,
            \'error\' => $e->getMessage(),
            \'trace\' => $e->getTraceAsString()
        ]);
    }
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000007600000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::nk612sUVPpvl56kd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KFPsHDxRfayscdUJ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/debug/websites-simple-step',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:1902:"function() {
    try {
        // Step 1: Basic counts
        $rawCount = \\App\\Models\\Website::count();
        $basicQuery = \\App\\Models\\Website::query();
        $withRelCount = \\App\\Models\\Website::with([\'createdBy\', \'updatedBy\'])->count();
        
        // Step 2: Test pagination without filters
        $simplePagedQuery = \\App\\Models\\Website::query();
        $simplePaged = $simplePagedQuery->paginate(15);
        
        // Step 3: Test with relationships
        $relPagedQuery = \\App\\Models\\Website::with([\'createdBy\', \'updatedBy\']);
        $relPaged = $relPagedQuery->paginate(15);
        
        // Step 4: Get actual first website data
        $firstWebsite = \\App\\Models\\Website::first();
        
        return \\response()->json([
            \'success\' => true,
            \'counts\' => [
                \'raw_count\' => $rawCount,
                \'with_relations_count\' => $withRelCount,
                \'simple_paged_total\' => $simplePaged->total(),
                \'simple_paged_count\' => $simplePaged->count(),
                \'rel_paged_total\' => $relPaged->total(),
                \'rel_paged_count\' => $relPaged->count(),
            ],
            \'first_website\' => $firstWebsite ? [
                \'id\' => $firstWebsite->id,
                \'name\' => $firstWebsite->name,
                \'domain\' => $firstWebsite->domain,
                \'created_by\' => $firstWebsite->created_by,
                \'updated_by\' => $firstWebsite->updated_by,
                \'created_at\' => $firstWebsite->created_at,
            ] : null,
            \'timestamp\' => \\now()->format(\'c\')
        ]);
        
    } catch (\\Exception $e) {
        return \\response()->json([
            \'success\' => false,
            \'error\' => $e->getMessage(),
            \'file\' => $e->getFile(),
            \'line\' => $e->getLine()
        ]);
    }
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000007620000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::KFPsHDxRfayscdUJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::RRCQhZfrcvbRMMNE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/debug/websites-step-by-step',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:3421:"function() {
    try {
        $page = \\request()->get(\'page\', 1);
        $perPage = \\request()->get(\'per_page\', 15);
        $search = \\request()->get(\'search\', \'\');
        $status = \\request()->get(\'status\', \'\');
        $type = \\request()->get(\'type\', \'\');
        
        // Step 1: Raw count
        $rawCount = \\App\\Models\\Website::count();
        
        // Step 2: Initial query
        $query = \\App\\Models\\Website::query();
        $initialCount = $query->count();
        
        // Step 3: With relationships
        $query = \\App\\Models\\Website::with([\'createdBy\', \'updatedBy\']);
        $withRelationshipsCount = $query->count();
        
        // Step 4: Apply filters one by one
        $afterStatusFilter = 0;
        $afterTypeFilter = 0;
        $afterSearchFilter = 0;
        
        $query = \\App\\Models\\Website::with([\'createdBy\', \'updatedBy\']);
        
        if ($status) {
            $query->where(\'status\', $status);
        }
        $afterStatusFilter = $query->count();
        
        if ($type) {
            $query->where(\'type\', $type);
        }
        $afterTypeFilter = $query->count();
        
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where(\'name\', \'like\', "%{$search}%")
                  ->orWhere(\'domain\', \'like\', "%{$search}%");
            });
        }
        $afterSearchFilter = $query->count();
        
        // Step 5: Get final paginated results
        $query->orderBy(\'created_at\', \'desc\');
        $paginatedResults = $query->paginate($perPage);
        
        // Step 6: Check user authentication and roles
        $user = \\Illuminate\\Support\\Facades\\Auth::user();
        $userRoles = $user ? $user->getRoleNames()->toArray() : [];
        
        return \\response()->json([
            \'success\' => true,
            \'debug_steps\' => [
                \'step_1_raw_count\' => $rawCount,
                \'step_2_initial_count\' => $initialCount,
                \'step_3_with_relationships_count\' => $withRelationshipsCount,
                \'step_4_after_status_filter\' => $afterStatusFilter,
                \'step_4_after_type_filter\' => $afterTypeFilter,
                \'step_4_after_search_filter\' => $afterSearchFilter,
                \'step_5_paginated_total\' => $paginatedResults->total(),
                \'step_5_paginated_count\' => $paginatedResults->count(),
                \'step_5_paginated_data_count\' => \\count($paginatedResults->items()),
            ],
            \'applied_filters\' => [
                \'status\' => $status ?: \'none\',
                \'type\' => $type ?: \'none\', 
                \'search\' => $search ?: \'none\',
                \'page\' => $page,
                \'per_page\' => $perPage
            ],
            \'user_info\' => [
                \'authenticated\' => $user ? true: false,
                \'user_id\' => $user ? $user->id : null,
                \'roles\' => $userRoles,
            ],
            \'sample_data\' => \\App\\Models\\Website::take(2)->get([\'id\', \'name\', \'domain\', \'status\', \'type\']),
            \'timestamp\' => \\now()->format(\'c\')
        ]);
        
    } catch (\\Exception $e) {
        return \\response()->json([
            \'success\' => false,
            \'error\' => $e->getMessage(),
            \'trace\' => $e->getTraceAsString()
        ]);
    }
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000007640000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::RRCQhZfrcvbRMMNE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::eznzEifJ4OEetMkc' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/debug/websites-frontend-test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:1607:"function() {
    try {
        // Simulate exact same parameters as frontend
        $page = \\request()->get(\'page\', 1);
        $perPage = \\request()->get(\'per_page\', 15);
        $search = \\request()->get(\'search\', \'\');
        $status = \\request()->get(\'status\', \'\');
        $type = \\request()->get(\'type\', \'\');
        
        // Log the exact parameters
        \\Log::info(\'Point 49 - Frontend API test called\', [
            \'page\' => $page,
            \'per_page\' => $perPage,
            \'search\' => $search,
            \'status\' => $status,
            \'type\' => $type,
            \'all_params\' => \\request()->all()
        ]);
        
        // Use the exact same controller logic
        $controller = new \\App\\Http\\Controllers\\Api\\WebsiteController();
        $response = $controller->index(\\request());
        
        return \\response()->json([
            \'success\' => true,
            \'controller_response\' => $response->getContent(),
            \'status_code\' => $response->getStatusCode(),
            \'headers\' => $response->headers->all(),
            \'test_params\' => [
                \'page\' => $page,
                \'per_page\' => $perPage,
                \'search\' => $search,
                \'status\' => $status,
                \'type\' => $type
            ],
            \'timestamp\' => \\now()->format(\'c\')
        ]);
        
    } catch (\\Exception $e) {
        return \\response()->json([
            \'success\' => false,
            \'error\' => $e->getMessage(),
            \'trace\' => $e->getTraceAsString()
        ]);
    }
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000007660000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::eznzEifJ4OEetMkc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::aGtCHKa5XMSOQo8d' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/debug/websites-check',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:1817:"function() {
    try {
        // Check basic database connection and table existence
        $tableExists = \\Schema::hasTable(\'websites\');
        
        if (!$tableExists) {
            return \\response()->json([
                \'success\' => false,
                \'error\' => \'websites table does not exist\'
            ]);
        }
        
        // Get basic counts
        $totalCount = \\App\\Models\\Website::count();
        $activeCount = \\App\\Models\\Website::where(\'status\', \'active\')->count();
        
        // Get sample data
        $sampleData = \\App\\Models\\Website::take(3)->get([\'id\', \'name\', \'domain\', \'status\', \'created_at\']);
        
        // Test the exact same query as index method
        $query = \\App\\Models\\Website::with([\'createdBy\', \'updatedBy\']);
        $testPagination = $query->paginate(15);
        
        return \\response()->json([
            \'success\' => true,
            \'table_exists\' => $tableExists,
            \'total_websites\' => $totalCount,
            \'active_websites\' => $activeCount,
            \'sample_data\' => $sampleData,
            \'pagination_test\' => [
                \'total\' => $testPagination->total(),
                \'per_page\' => $testPagination->perPage(),
                \'current_page\' => $testPagination->currentPage(),
                \'last_page\' => $testPagination->lastPage(),
                \'data_count\' => $testPagination->count(),
                \'first_item\' => $testPagination->items()[0] ?? null,
            ],
            \'timestamp\' => \\now()->format(\'c\')
        ]);
        
    } catch (\\Exception $e) {
        return \\response()->json([
            \'success\' => false,
            \'error\' => $e->getMessage(),
            \'trace\' => $e->getTraceAsString()
        ]);
    }
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000007680000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::aGtCHKa5XMSOQo8d',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::e3EWMxSQ2SgSOPIM' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/test/customers/{customer}/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:403:"function(\\App\\Models\\Customer $customer) {
    \\Log::info(\'Point 34 - Test delete route called\', [
        \'customer_id\' => $customer->id,
        \'customer_name\' => $customer->name
    ]);
    
    return \\response()->json([
        \'message\' => \'Test delete route works\',
        \'customer\' => [
            \'id\' => $customer->id,
            \'name\' => $customer->name
        ]
    ]);
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000000000076a0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::e3EWMxSQ2SgSOPIM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qxhiw74WHQQKLeYT' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/test/customers/{customer}/force-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:1514:"function(\\App\\Models\\Customer $customer) {
    $user = \\Illuminate\\Support\\Facades\\Auth::user();
    
    \\Log::info(\'Point 34 - Force delete test route called\', [
        \'customer_id\' => $customer->id,
        \'customer_name\' => $customer->name,
        \'user_id\' => $user->id,
        \'user_name\' => $user->name,
        \'is_manager\' => $user->isManager()
    ]);
    
    try {
        // Create activity log
        \\App\\Models\\CustomerActivity::create([
            \'customer_id\' => $customer->id,
            \'user_id\' => $user->id,
            \'activity_type\' => \'deleted\',
            \'description\' => "客戶資料已刪除（測試路由）",
            \'old_data\' => $customer->toArray(),
            \'ip_address\' => \\request()->ip(),
        ]);
        
        $customer->delete();
        
        \\Log::info(\'Point 34 - Force delete completed\', [
            \'customer_id\' => $customer->id,
            \'user_id\' => $user->id
        ]);
        
        return \\response()->json([
            \'message\' => \'Customer deleted successfully via test route\',
            \'customer_id\' => $customer->id
        ]);
        
    } catch (\\Exception $e) {
        \\Log::error(\'Point 34 - Force delete failed\', [
            \'customer_id\' => $customer->id,
            \'error\' => $e->getMessage()
        ]);
        
        return \\response()->json([
            \'error\' => \'Delete failed\',
            \'message\' => $e->getMessage()
        ], 500);
    }
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000000000076c0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::qxhiw74WHQQKLeYT',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::N3J1ccqxhf3oSdiA' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/test/webhook-firebase',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@testWebhookFirebase',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@testWebhookFirebase',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::N3J1ccqxhf3oSdiA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::HCpCvKTcdn58oTwZ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/debug/line/settings/test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@testLineSettingsApi',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@testLineSettingsApi',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::HCpCvKTcdn58oTwZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VfZDJRUR7iaTrB3n' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/debug/line/info-with-signature-test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@lineInfoWithSignatureTest',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@lineInfoWithSignatureTest',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::VfZDJRUR7iaTrB3n',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::uVGtaEtBEkDIokFH' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/debug/webhook-diagnosis',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@webhookDiagnosis',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@webhookDiagnosis',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::uVGtaEtBEkDIokFH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Bw0rMiTVbzfntlvj' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/debug/simulate-webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@simulateWebhookEvent',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@simulateWebhookEvent',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::Bw0rMiTVbzfntlvj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::gi2ezbJGNsCCsdVr' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/firebase/diagnostic',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@diagnosticFirebaseConnection',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@diagnosticFirebaseConnection',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::gi2ezbJGNsCCsdVr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Lsfyo1MSZYSmowcq' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/debug/firebase/diagnostic',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@diagnosticFirebaseConnection',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@diagnosticFirebaseConnection',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::Lsfyo1MSZYSmowcq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pMl4z8tJU1SIT0wq' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/firebase/status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@quickFirebaseStatus',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@quickFirebaseStatus',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::pMl4z8tJU1SIT0wq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::XNyGDDlzrm7ifnv0' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/test/webhook-firebase-sync',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@testWebhookFirebaseSync',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@testWebhookFirebaseSync',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::XNyGDDlzrm7ifnv0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5gNcrQRhRwNQlS6m' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/test/complete-webhook-flow',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@testCompleteWebhookFlow',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@testCompleteWebhookFlow',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::5gNcrQRhRwNQlS6m',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZyVyjEOYZ0weSIk6' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/debug/recent-chats',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@checkRecentChats',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@checkRecentChats',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::ZyVyjEOYZ0weSIk6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::lDaVChLZK0EvWKtS' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/debug/simple-health',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@simpleHealthCheck',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@simpleHealthCheck',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::lDaVChLZK0EvWKtS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::d32wIcyz8FFw2YT9' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/debug/test-mysql-creation',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@testMysqlConversationCreation',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@testMysqlConversationCreation',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::d32wIcyz8FFw2YT9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::X0eb4wvCVCrGW2NV' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/debug/point20-mysql-test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@point20MysqlDirectTest',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@point20MysqlDirectTest',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::X0eb4wvCVCrGW2NV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3j2oA8cJkFypqC3P' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/debug/point20-simple-test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@point20SimpleTest',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@point20SimpleTest',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::3j2oA8cJkFypqC3P',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QUVmtieH2QzUnJ6U' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/debug/point20-customer-test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@point20CustomerTest',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@point20CustomerTest',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::QUVmtieH2QzUnJ6U',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tTL889wfLY1qucGE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/debug/point20-database-test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@point20DatabaseTest',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@point20DatabaseTest',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::tTL889wfLY1qucGE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::CzwLJRYAQPSd75Ju' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/debug/point20-conversation-raw-test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@point20ConversationRawTest',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@point20ConversationRawTest',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::CzwLJRYAQPSd75Ju',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::q4yAV39mWgKYDJWw' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/diagnostic/basic-health',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DiagnosticController@basicHealth',
        'controller' => 'App\\Http\\Controllers\\Api\\DiagnosticController@basicHealth',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::q4yAV39mWgKYDJWw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::zIHrMwJ00qLezTIE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/diagnostic/database-check',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DiagnosticController@databaseCheck',
        'controller' => 'App\\Http\\Controllers\\Api\\DiagnosticController@databaseCheck',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::zIHrMwJ00qLezTIE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::XeGYf1Gz6H0w1GlL' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/diagnostic/test-data-creation',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DiagnosticController@testDataCreation',
        'controller' => 'App\\Http\\Controllers\\Api\\DiagnosticController@testDataCreation',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::XeGYf1Gz6H0w1GlL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'login' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/auth/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\AuthController@login',
        'controller' => 'App\\Http\\Controllers\\Api\\AuthController@login',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::AAsd6x2hEAdOMzEN' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/auth/register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\AuthController@register',
        'controller' => 'App\\Http\\Controllers\\Api\\AuthController@register',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::AAsd6x2hEAdOMzEN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::SXgh8PTNXxMr4ZBJ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/auth/refresh',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\AuthController@refresh',
        'controller' => 'App\\Http\\Controllers\\Api\\AuthController@refresh',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::SXgh8PTNXxMr4ZBJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rcXqcHqfsW3pgwjP' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/line/webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@webhook',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@webhook',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::rcXqcHqfsW3pgwjP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9qnjfE64YfohJTyR' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/line/webhook-test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@webhookTest',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@webhookTest',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::9qnjfE64YfohJTyR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::s1DgM9nPkgc9pTQd' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/line/webhook-simple',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@webhookSimpleTest',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@webhookSimpleTest',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::s1DgM9nPkgc9pTQd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KXqogTboQnKBMa2J' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/line/webhook-debug',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@webhookDebugTest',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@webhookDebugTest',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::KXqogTboQnKBMa2J',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KHRhTCxX7vFFFwJj' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/line/webhook-nosig',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@webhookNoSignature',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@webhookNoSignature',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::KHRhTCxX7vFFFwJj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::6gyHwxunBHbDBG9m' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/line/webhook-simulate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@webhookSimulate',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@webhookSimulate',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::6gyHwxunBHbDBG9m',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::eyPQJYWuBMWNyRDy' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/webhook/wp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\WebhookController@wp',
        'controller' => 'App\\Http\\Controllers\\Api\\WebhookController@wp',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::eyPQJYWuBMWNyRDy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::WgUVgqdTeDGoLqqL' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webhook/execution-logs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\WebhookController@getExecutionLogs',
        'controller' => 'App\\Http\\Controllers\\Api\\WebhookController@getExecutionLogs',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::WgUVgqdTeDGoLqqL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ntTC0RJK8lMrf9lx' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webhook/execution-logs/{executionId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\WebhookController@getExecutionLogDetail',
        'controller' => 'App\\Http\\Controllers\\Api\\WebhookController@getExecutionLogDetail',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::ntTC0RJK8lMrf9lx',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::945MJzAH9V9U6Oad' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/broadcasting/auth',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:85:"function () {
    return \\Illuminate\\Support\\Facades\\Broadcast::auth(\\request());
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000007900000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::945MJzAH9V9U6Oad',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VCgwGqL1yHFI5VjF' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/auth/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\AuthController@logout',
        'controller' => 'App\\Http\\Controllers\\Api\\AuthController@logout',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::VCgwGqL1yHFI5VjF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Mzga77e2fMjQKFSL' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/auth/me',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\AuthController@me',
        'controller' => 'App\\Http\\Controllers\\Api\\AuthController@me',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::Mzga77e2fMjQKFSL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ef0uZUaqtKyCuKRX' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/auth/profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\AuthController@updateProfile',
        'controller' => 'App\\Http\\Controllers\\Api\\AuthController@updateProfile',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::ef0uZUaqtKyCuKRX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7oT5a9EKwPJzE6UX' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/dashboard/stats',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DashboardController@getStats',
        'controller' => 'App\\Http\\Controllers\\Api\\DashboardController@getStats',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::7oT5a9EKwPJzE6UX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7Vt1niaUp1figPns' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/dashboard/recent-customers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DashboardController@getRecentCustomers',
        'controller' => 'App\\Http\\Controllers\\Api\\DashboardController@getRecentCustomers',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::7Vt1niaUp1figPns',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BPC6a4MCfVGOvEMH' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/dashboard/monthly-summary',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DashboardController@getMonthlySummary',
        'controller' => 'App\\Http\\Controllers\\Api\\DashboardController@getMonthlySummary',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::BPC6a4MCfVGOvEMH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::u4VPsHsAcGRsREKQ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/dashboard/charts',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DashboardController@getChartsData',
        'controller' => 'App\\Http\\Controllers\\Api\\DashboardController@getChartsData',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::u4VPsHsAcGRsREKQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customers.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/customers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'as' => 'customers.index',
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customers.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/customers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'as' => 'customers.store',
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerController@store',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customers.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/customers/{customer}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'as' => 'customers.show',
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerController@show',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customers.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'api/customers/{customer}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'as' => 'customers.update',
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerController@update',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'customers.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/customers/{customer}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'as' => 'customers.destroy',
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerController@destroy',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerController@destroy',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MBfQg8Zv56oF331M' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/customers/{customer}/track',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerController@setTrackDate',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerController@setTrackDate',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::MBfQg8Zv56oF331M',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QPazaw8sSLOcEuMR' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/customers/{customer}/status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerController@updateStatus',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerController@updateStatus',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::QPazaw8sSLOcEuMR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::X41Jq81VHF9TnE7E' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/customers/{customer}/assign',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerController@assignToUser',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerController@assignToUser',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::X41Jq81VHF9TnE7E',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GOWAxlbx4EI2M5Pb' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/customers/{customer}/history',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerController@getHistory',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerController@getHistory',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::GOWAxlbx4EI2M5Pb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PNWExloxOhGtDY4q' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/customers/submittable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerController@submittable',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerController@submittable',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::PNWExloxOhGtDY4q',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ARv2XIASBlPZqRoy' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/tracking/customers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerController@trackingList',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerController@trackingList',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::ARv2XIASBlPZqRoy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9uu7ns7G0itz5WSG' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'api/customers/{customer}/level',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerController@updateCustomerLevel',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerController@updateCustomerLevel',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::9uu7ns7G0itz5WSG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wqK0Xy6p27UHR6Hl' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/tracking/sales-users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerController@getSalesUsers',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerController@getSalesUsers',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::wqK0Xy6p27UHR6Hl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0AUY90UrkmlViMpJ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/contact-schedules',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerContactScheduleController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerContactScheduleController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::0AUY90UrkmlViMpJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::JoMihPCS7GHxqK24' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/contact-schedules',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerContactScheduleController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerContactScheduleController@store',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::JoMihPCS7GHxqK24',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::oUsUwmJB81k6AJjT' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/contact-schedules/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerContactScheduleController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerContactScheduleController@show',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::oUsUwmJB81k6AJjT',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ucIjEztckBcFidEC' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/contact-schedules/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerContactScheduleController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerContactScheduleController@update',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::ucIjEztckBcFidEC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7ILWxAgAoprLbMTP' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/contact-schedules/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerContactScheduleController@destroy',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerContactScheduleController@destroy',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::7ILWxAgAoprLbMTP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OXBkbQ2K5AZKIIi1' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/contact-schedules/{id}/contacted',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerContactScheduleController@markAsContacted',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerContactScheduleController@markAsContacted',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::OXBkbQ2K5AZKIIi1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hOcngqddfyDFO91H' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/contact-schedules/{id}/reschedule',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerContactScheduleController@reschedule',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerContactScheduleController@reschedule',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::hOcngqddfyDFO91H',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OpqPuBUSoNhZqY86' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/contact-schedules/overdue/list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerContactScheduleController@getOverdue',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerContactScheduleController@getOverdue',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::OpqPuBUSoNhZqY86',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::8W06ltABKXbONnTz' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/contact-schedules/today/list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerContactScheduleController@getToday',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerContactScheduleController@getToday',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::8W06ltABKXbONnTz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::aiazpSjDuqunFTTV' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/contact-schedules/reminders/list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerContactScheduleController@getNeedingReminder',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerContactScheduleController@getNeedingReminder',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::aiazpSjDuqunFTTV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rRqDQ3Dlr1v1IrPN' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/contact-schedules/calendar/data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerContactScheduleController@getCalendarData',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerContactScheduleController@getCalendarData',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::rRqDQ3Dlr1v1IrPN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::X3U2eaMGT7PtfUhP' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/customers/{customer}/line/link',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerController@linkLineUser',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerController@linkLineUser',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::X3U2eaMGT7PtfUhP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::HMh9MArohYEWJrbO' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/customers/{customer}/line/unlink',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerController@unlinkLineUser',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerController@unlinkLineUser',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::HMh9MArohYEWJrbO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QyVR6wnhQziloXO1' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/customers/{customer}/line/friend-status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomerController@checkLineFriendStatus',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomerController@checkLineFriendStatus',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::QyVR6wnhQziloXO1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::x4iYXwCMEdLFGOeK' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/customers/{customer}/blacklist/report',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\BlacklistController@report',
        'controller' => 'App\\Http\\Controllers\\Api\\BlacklistController@report',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::x4iYXwCMEdLFGOeK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::CJqpstD3OAJHTlSg' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/customers/{customer}/blacklist/approve',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\BlacklistController@approve',
        'controller' => 'App\\Http\\Controllers\\Api\\BlacklistController@approve',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::CJqpstD3OAJHTlSg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7X2kDkanV9Mub3Nt' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/customers/{customer}/blacklist/toggle-hide',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\BlacklistController@toggleHide',
        'controller' => 'App\\Http\\Controllers\\Api\\BlacklistController@toggleHide',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::7X2kDkanV9Mub3Nt',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::iB75R4PgcxTLzXqo' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/chats',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::iB75R4PgcxTLzXqo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::uRt3VbaX5wFKq2it' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/chats/search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@searchConversations',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@searchConversations',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::uRt3VbaX5wFKq2it',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PlVUaaZxJIlgAIBi' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/chats/stats',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@getChatStats',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@getChatStats',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::PlVUaaZxJIlgAIBi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pWzAtkhtCIwXhPgE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/chats/test-permissions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@testPermissions',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@testPermissions',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::pWzAtkhtCIwXhPgE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::XZtMvfYCQIChoYin' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/chats/unread/count',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@getUnreadCount',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@getUnreadCount',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::XZtMvfYCQIChoYin',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::1pA5bTSoeUD5uU9Q' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/chats/poll-updates',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@pollUpdates',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@pollUpdates',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::1pA5bTSoeUD5uU9Q',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ObBdnendkmIRFio3' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/chats/incremental',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@getIncrementalUpdates',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@getIncrementalUpdates',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::ObBdnendkmIRFio3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::V7XTR9OF34pQErBc' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/chats/validate-checksum',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@validateChecksum',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@validateChecksum',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::V7XTR9OF34pQErBc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::EYJrCLW5bVlfB2ls' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/chats/{userId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@getConversation',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@getConversation',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::EYJrCLW5bVlfB2ls',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::boe48eSeW8wtn7gT' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/chats/{userId}/reply',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@reply',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@reply',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::boe48eSeW8wtn7gT',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::YV1fNM3yD1fOa5sM' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/chats/{userId}/read',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@markAsRead',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@markAsRead',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::YV1fNM3yD1fOa5sM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TntEROkHuihCimne' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/chats/{userId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@deleteConversation',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@deleteConversation',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::TntEROkHuihCimne',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::xeh9I9mZFbJDoMQJ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/chats/test-websocket',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@testWebSocketBroadcast',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@testWebSocketBroadcast',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::xeh9I9mZFbJDoMQJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::CuIfuqIrMmHbH68U' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/firebase/chat/conversations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@getFirebaseConversations',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@getFirebaseConversations',
        'namespace' => NULL,
        'prefix' => 'api/firebase/chat',
        'where' => 
        array (
        ),
        'as' => 'generated::CuIfuqIrMmHbH68U',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::n3D7lJipmtSbk7Ts' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/firebase/chat/messages/{userId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@getFirebaseMessages',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@getFirebaseMessages',
        'namespace' => NULL,
        'prefix' => 'api/firebase/chat',
        'where' => 
        array (
        ),
        'as' => 'generated::n3D7lJipmtSbk7Ts',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::uLtMLMvWCzPr08WY' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/firebase/chat/sync',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@syncToFirebase',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@syncToFirebase',
        'namespace' => NULL,
        'prefix' => 'api/firebase/chat',
        'where' => 
        array (
        ),
        'as' => 'generated::uLtMLMvWCzPr08WY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::n58ItzfOSVd1iteK' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/firebase/chat/sync/customer/{customerId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@syncCustomerToFirebase',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@syncCustomerToFirebase',
        'namespace' => NULL,
        'prefix' => 'api/firebase/chat',
        'where' => 
        array (
        ),
        'as' => 'generated::n58ItzfOSVd1iteK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::70gnKkD1UecZiwu2' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/firebase/chat/health',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@checkFirebaseHealth',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@checkFirebaseHealth',
        'namespace' => NULL,
        'prefix' => 'api/firebase/chat',
        'where' => 
        array (
        ),
        'as' => 'generated::70gnKkD1UecZiwu2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qwhVe10JGQIXIwxL' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/firebase/chat/validate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@validateFirebaseData',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@validateFirebaseData',
        'namespace' => NULL,
        'prefix' => 'api/firebase/chat',
        'where' => 
        array (
        ),
        'as' => 'generated::qwhVe10JGQIXIwxL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hYmg9TY6RxxZhOdv' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/firebase/chat/cleanup',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@cleanupFirebaseData',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@cleanupFirebaseData',
        'namespace' => NULL,
        'prefix' => 'api/firebase/chat',
        'where' => 
        array (
        ),
        'as' => 'generated::hYmg9TY6RxxZhOdv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KLN6ox4TIRVNodYa' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/debug/system/health',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@systemHealthCheck',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@systemHealthCheck',
        'namespace' => NULL,
        'prefix' => 'api/debug',
        'where' => 
        array (
        ),
        'as' => 'generated::KLN6ox4TIRVNodYa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::N88QwqPIQi0BRGmJ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/debug/system/info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@getDebugInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@getDebugInfo',
        'namespace' => NULL,
        'prefix' => 'api/debug',
        'where' => 
        array (
        ),
        'as' => 'generated::N88QwqPIQi0BRGmJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::nvX4hrNPaOjEEeKU' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/debug/firebase/batch-sync',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@batchSyncToFirebase',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@batchSyncToFirebase',
        'namespace' => NULL,
        'prefix' => 'api/debug',
        'where' => 
        array (
        ),
        'as' => 'generated::nvX4hrNPaOjEEeKU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ktqAxxV1qcbIR0Vl' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/debug/firebase/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
          3 => 'role:admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@resetFirebaseData',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@resetFirebaseData',
        'namespace' => NULL,
        'prefix' => 'api/debug',
        'where' => 
        array (
        ),
        'as' => 'generated::ktqAxxV1qcbIR0Vl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::19FXCzEvvsoywBA7' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/debug/firebase/test-connection',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@testFirebaseConnection',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@testFirebaseConnection',
        'namespace' => NULL,
        'prefix' => 'api/debug',
        'where' => 
        array (
        ),
        'as' => 'generated::19FXCzEvvsoywBA7',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ajbWmuVSne08S0Gq' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/debug/line/settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@getLineSettings',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@getLineSettings',
        'namespace' => NULL,
        'prefix' => 'api/debug',
        'where' => 
        array (
        ),
        'as' => 'generated::ajbWmuVSne08S0Gq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9jF3WCuzwi9VzNP4' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/debug/line/settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DebugController@updateLineSettings',
        'controller' => 'App\\Http\\Controllers\\Api\\DebugController@updateLineSettings',
        'namespace' => NULL,
        'prefix' => 'api/debug',
        'where' => 
        array (
        ),
        'as' => 'generated::9jF3WCuzwi9VzNP4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::RivVfx8jqhncqVQG' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/debug/chat/batch-sync',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@batchSyncToFirebaseDebug',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@batchSyncToFirebaseDebug',
        'namespace' => NULL,
        'prefix' => 'api/debug',
        'where' => 
        array (
        ),
        'as' => 'generated::RivVfx8jqhncqVQG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BPHdNqUFNBwjMi7f' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/debug/chat/full-sync',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@fullSyncToFirebase',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@fullSyncToFirebase',
        'namespace' => NULL,
        'prefix' => 'api/debug',
        'where' => 
        array (
        ),
        'as' => 'generated::BPHdNqUFNBwjMi7f',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mP1D8gMYEdWjBNxj' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/debug/chat/validate-integrity',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@validateFirebaseDataIntegrity',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@validateFirebaseDataIntegrity',
        'namespace' => NULL,
        'prefix' => 'api/debug',
        'where' => 
        array (
        ),
        'as' => 'generated::mP1D8gMYEdWjBNxj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mlDPq8FNmHJ81IJz' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/debug/chat/cleanup-firebase',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
          3 => 'role:admin|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@cleanupFirebaseDataDebug',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@cleanupFirebaseDataDebug',
        'namespace' => NULL,
        'prefix' => 'api/debug',
        'where' => 
        array (
        ),
        'as' => 'generated::mlDPq8FNmHJ81IJz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hLBZorSLhAgepgRn' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/debug/firebase/health-extended',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@checkFirebaseHealth',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@checkFirebaseHealth',
        'namespace' => NULL,
        'prefix' => 'api/debug',
        'where' => 
        array (
        ),
        'as' => 'generated::hLBZorSLhAgepgRn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Us4KYRMVCZ41ahlG' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/version/current',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\VersionController@getCurrentVersion',
        'controller' => 'App\\Http\\Controllers\\Api\\VersionController@getCurrentVersion',
        'namespace' => NULL,
        'prefix' => 'api/version',
        'where' => 
        array (
        ),
        'as' => 'generated::Us4KYRMVCZ41ahlG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mzLgLJtzIUS5sknN' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/version/changes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\VersionController@getIncrementalChanges',
        'controller' => 'App\\Http\\Controllers\\Api\\VersionController@getIncrementalChanges',
        'namespace' => NULL,
        'prefix' => 'api/version',
        'where' => 
        array (
        ),
        'as' => 'generated::mzLgLJtzIUS5sknN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ODizBnI4ZZG3YlHA' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/version/history',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\VersionController@getVersionHistory',
        'controller' => 'App\\Http\\Controllers\\Api\\VersionController@getVersionHistory',
        'namespace' => NULL,
        'prefix' => 'api/version',
        'where' => 
        array (
        ),
        'as' => 'generated::ODizBnI4ZZG3YlHA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::xrlrv5SHwaJetF2U' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/version/check-conflict',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\VersionController@checkVersionConflict',
        'controller' => 'App\\Http\\Controllers\\Api\\VersionController@checkVersionConflict',
        'namespace' => NULL,
        'prefix' => 'api/version',
        'where' => 
        array (
        ),
        'as' => 'generated::xrlrv5SHwaJetF2U',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ytSuKVy3uFxjSFup' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/version/stats',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\VersionController@getVersionStats',
        'controller' => 'App\\Http\\Controllers\\Api\\VersionController@getVersionStats',
        'namespace' => NULL,
        'prefix' => 'api/version',
        'where' => 
        array (
        ),
        'as' => 'generated::ytSuKVy3uFxjSFup',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PXPIMM8cIKvpgLxc' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/sync/{entityType}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\SyncController@getUpdates',
        'controller' => 'App\\Http\\Controllers\\Api\\SyncController@getUpdates',
        'namespace' => NULL,
        'prefix' => 'api/sync',
        'where' => 
        array (
        ),
        'as' => 'generated::PXPIMM8cIKvpgLxc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pBk32lz7Ave3FhuE' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/sync/{entityType}/validate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\SyncController@validateIntegrity',
        'controller' => 'App\\Http\\Controllers\\Api\\SyncController@validateIntegrity',
        'namespace' => NULL,
        'prefix' => 'api/sync',
        'where' => 
        array (
        ),
        'as' => 'generated::pBk32lz7Ave3FhuE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::oftqdClvRtgSjk0m' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/sync/{entityType}/stats',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\SyncController@getStats',
        'controller' => 'App\\Http\\Controllers\\Api\\SyncController@getStats',
        'namespace' => NULL,
        'prefix' => 'api/sync',
        'where' => 
        array (
        ),
        'as' => 'generated::oftqdClvRtgSjk0m',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::DQBogEnoDqV2l8QA' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/websites/options',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\WebsiteController@options',
        'controller' => 'App\\Http\\Controllers\\Api\\WebsiteController@options',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::DQBogEnoDqV2l8QA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::d1YjQk7AIWKsEdZ6' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webhook-logs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\WebhookLogController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\WebhookLogController@index',
        'namespace' => NULL,
        'prefix' => 'api/webhook-logs',
        'where' => 
        array (
        ),
        'as' => 'generated::d1YjQk7AIWKsEdZ6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::omSERDRIDTsOf5oE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webhook-logs/statistics',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\WebhookLogController@statistics',
        'controller' => 'App\\Http\\Controllers\\Api\\WebhookLogController@statistics',
        'namespace' => NULL,
        'prefix' => 'api/webhook-logs',
        'where' => 
        array (
        ),
        'as' => 'generated::omSERDRIDTsOf5oE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hd1SdZCBKaWlwCBM' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webhook-logs/recent',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\WebhookLogController@recent',
        'controller' => 'App\\Http\\Controllers\\Api\\WebhookLogController@recent',
        'namespace' => NULL,
        'prefix' => 'api/webhook-logs',
        'where' => 
        array (
        ),
        'as' => 'generated::hd1SdZCBKaWlwCBM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::zzWYpIvWMGxcUuTN' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webhook-logs/export',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\WebhookLogController@export',
        'controller' => 'App\\Http\\Controllers\\Api\\WebhookLogController@export',
        'namespace' => NULL,
        'prefix' => 'api/webhook-logs',
        'where' => 
        array (
        ),
        'as' => 'generated::zzWYpIvWMGxcUuTN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qwHw3dd7vfs5nPfF' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webhook-logs/execution/{executionId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\WebhookLogController@getByExecutionId',
        'controller' => 'App\\Http\\Controllers\\Api\\WebhookLogController@getByExecutionId',
        'namespace' => NULL,
        'prefix' => 'api/webhook-logs',
        'where' => 
        array (
        ),
        'as' => 'generated::qwHw3dd7vfs5nPfF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::naDPPHMP87x6qS67' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webhook-logs/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\WebhookLogController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\WebhookLogController@show',
        'namespace' => NULL,
        'prefix' => 'api/webhook-logs',
        'where' => 
        array (
        ),
        'as' => 'generated::naDPPHMP87x6qS67',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7zCHacC9k9tfRAEt' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/webhook-logs/cleanup',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\WebhookLogController@cleanup',
        'controller' => 'App\\Http\\Controllers\\Api\\WebhookLogController@cleanup',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::7zCHacC9k9tfRAEt',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mVZSsI0RlW5F1NkK' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/chats/admin/query-stats',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@getQueryStats',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@getQueryStats',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::mVZSsI0RlW5F1NkK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::UQAIHO2nNAHD0Rox' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/chats/admin/clear-cache',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ChatController@clearQueryCache',
        'controller' => 'App\\Http\\Controllers\\Api\\ChatController@clearQueryCache',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::UQAIHO2nNAHD0Rox',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::RggGKSVdUKOCOALj' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::RggGKSVdUKOCOALj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cOcrHi0VMqIxxvSM' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@store',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::cOcrHi0VMqIxxvSM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fMtez7CTAKB6xMBi' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@show',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::fMtez7CTAKB6xMBi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cmkIyfBI7NXdEust' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@update',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::cmkIyfBI7NXdEust',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BxXp9VGTk7lmGwO4' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@destroy',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@destroy',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::BxXp9VGTk7lmGwO4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Ulfk5KCULffF2J2i' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/users/{user}/roles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@assignRole',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@assignRole',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::Ulfk5KCULffF2J2i',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bSwPspz0LFqMP4uQ' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/users/{user}/roles/{role}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@removeRole',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@removeRole',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::bSwPspz0LFqMP4uQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GTBBZTTZIPvYOCfW' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/roles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@getRoles',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@getRoles',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::GTBBZTTZIPvYOCfW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BcCMdMkCK2WjEPoy' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/users/stats/overview',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@getStats',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@getStats',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::BcCMdMkCK2WjEPoy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ShtMm5DyobONXMu6' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/permissions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\PermissionController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\PermissionController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::ShtMm5DyobONXMu6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tnIHdPQMEhULkXre' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/permissions/category/{category}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\PermissionController@getByCategory',
        'controller' => 'App\\Http\\Controllers\\Api\\PermissionController@getByCategory',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::tnIHdPQMEhULkXre',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cTgB9nooA72wLO1q' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/users/{user}/roles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\PermissionController@getUserRoles',
        'controller' => 'App\\Http\\Controllers\\Api\\PermissionController@getUserRoles',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::cTgB9nooA72wLO1q',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ymBST9LDRfCGIFkP' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/roles/{role}/permissions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\PermissionController@getRolePermissions',
        'controller' => 'App\\Http\\Controllers\\Api\\PermissionController@getRolePermissions',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::ymBST9LDRfCGIFkP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jzLUfjPsl6qnKgKC' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/roles/{role}/permissions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\PermissionController@assignPermissionToRole',
        'controller' => 'App\\Http\\Controllers\\Api\\PermissionController@assignPermissionToRole',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::jzLUfjPsl6qnKgKC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KptrZLXKI08fcRUP' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/roles/{role}/permissions/{permissionName}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\PermissionController@removePermissionFromRole',
        'controller' => 'App\\Http\\Controllers\\Api\\PermissionController@removePermissionFromRole',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::KptrZLXKI08fcRUP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'websites.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/websites',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'as' => 'websites.index',
        'uses' => 'App\\Http\\Controllers\\Api\\WebsiteController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\WebsiteController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'websites.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/websites',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'as' => 'websites.store',
        'uses' => 'App\\Http\\Controllers\\Api\\WebsiteController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\WebsiteController@store',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'websites.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/websites/{website}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'as' => 'websites.show',
        'uses' => 'App\\Http\\Controllers\\Api\\WebsiteController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\WebsiteController@show',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'websites.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'api/websites/{website}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'as' => 'websites.update',
        'uses' => 'App\\Http\\Controllers\\Api\\WebsiteController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\WebsiteController@update',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'websites.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/websites/{website}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'as' => 'websites.destroy',
        'uses' => 'App\\Http\\Controllers\\Api\\WebsiteController@destroy',
        'controller' => 'App\\Http\\Controllers\\Api\\WebsiteController@destroy',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::adr3KRE5nTKY0E7w' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/websites/{website}/statistics',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\WebsiteController@updateStatistics',
        'controller' => 'App\\Http\\Controllers\\Api\\WebsiteController@updateStatistics',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::adr3KRE5nTKY0E7w',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wqsJJwNnctU365Sq' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/websites-statistics',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\WebsiteController@statistics',
        'controller' => 'App\\Http\\Controllers\\Api\\WebsiteController@statistics',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::wqsJJwNnctU365Sq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::M07nHe0jds9ZZlLj' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/websites/{website}/field-mappings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\WebsiteFieldMappingController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\WebsiteFieldMappingController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::M07nHe0jds9ZZlLj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ssddCNu7iNj0BVbX' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/websites/{website}/field-mappings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\WebsiteFieldMappingController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\WebsiteFieldMappingController@store',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::ssddCNu7iNj0BVbX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::N6EbuDOgLs4Skrh8' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/websites/{website}/field-mappings/defaults',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\WebsiteFieldMappingController@createDefaults',
        'controller' => 'App\\Http\\Controllers\\Api\\WebsiteFieldMappingController@createDefaults',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::N6EbuDOgLs4Skrh8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::uOeOSlw1rC30MApO' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/websites/{website}/field-mappings/test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\WebsiteFieldMappingController@test',
        'controller' => 'App\\Http\\Controllers\\Api\\WebsiteFieldMappingController@test',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::uOeOSlw1rC30MApO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hySbqx7Xg03judy6' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/field-mappings/system-fields',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\WebsiteFieldMappingController@systemFields',
        'controller' => 'App\\Http\\Controllers\\Api\\WebsiteFieldMappingController@systemFields',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::hySbqx7Xg03judy6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::F2al8jbcWrnKsQXB' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/field-mappings/system-fields',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\WebsiteFieldMappingController@addSystemField',
        'controller' => 'App\\Http\\Controllers\\Api\\WebsiteFieldMappingController@addSystemField',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::F2al8jbcWrnKsQXB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::WH9WDHWKVmrBVEGO' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/leads',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\LeadController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\LeadController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::WH9WDHWKVmrBVEGO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tbE4Swaor81daPMb' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/leads/submittable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\LeadController@submittable',
        'controller' => 'App\\Http\\Controllers\\Api\\LeadController@submittable',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::tbE4Swaor81daPMb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sdxBJnF7aKMG7qCD' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/leads/{lead}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\LeadController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\LeadController@show',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::sdxBJnF7aKMG7qCD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Rqip8P9Bym1Yboxi' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/leads/{lead}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\LeadController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\LeadController@update',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::Rqip8P9Bym1Yboxi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rhdYSRmzJIYSR0X9' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/leads/{lead}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\LeadController@destroy',
        'controller' => 'App\\Http\\Controllers\\Api\\LeadController@destroy',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::rhdYSRmzJIYSR0X9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ReabcagiP9i9RtMU' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/leads/{lead}/line-name',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\LeadController@updateLineUserName',
        'controller' => 'App\\Http\\Controllers\\Api\\LeadController@updateLineUserName',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::ReabcagiP9i9RtMU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::98gHNTw0RW5vOI4N' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/cases',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CaseController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\CaseController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::98gHNTw0RW5vOI4N',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bVNBK9KlqrFpm42B' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/cases',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CaseController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\CaseController@store',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::bVNBK9KlqrFpm42B',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::UYH7IrLLSvBdoGrb' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/cases/status-summary',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CaseController@statusSummary',
        'controller' => 'App\\Http\\Controllers\\Api\\CaseController@statusSummary',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::UYH7IrLLSvBdoGrb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::EyBviiTW0bMlV41b' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/cases/{case}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CaseController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\CaseController@show',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::EyBviiTW0bMlV41b',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::oBxuoGPM0qfQNNu7' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/cases/{case}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CaseController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\CaseController@update',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::oBxuoGPM0qfQNNu7',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::1HeVm2uTckcnayip' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/cases/{case}/assign',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CaseController@assign',
        'controller' => 'App\\Http\\Controllers\\Api\\CaseController@assign',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::1HeVm2uTckcnayip',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::EHKXe1AIwBFQdSKQ' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/cases/{case}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CaseController@destroy',
        'controller' => 'App\\Http\\Controllers\\Api\\CaseController@destroy',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::EHKXe1AIwBFQdSKQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tXVuGty8N4RcinRc' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/customers/{customer}/cases',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CaseController@storeForCustomer',
        'controller' => 'App\\Http\\Controllers\\Api\\CaseController@storeForCustomer',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::tXVuGty8N4RcinRc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0Eh4ZdRsyQ67DlnP' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/bank-records',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\BankRecordController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\BankRecordController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::0Eh4ZdRsyQ67DlnP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::xjonFFi8qPGoNKoR' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/bank-records',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\BankRecordController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\BankRecordController@store',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::xjonFFi8qPGoNKoR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::zxgRxuDcwWX17Mxn' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/bank-records/{record}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\BankRecordController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\BankRecordController@update',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::zxgRxuDcwWX17Mxn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PRd6HuHtaS8MzoF6' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/reports/daily',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ReportController@dailyReport',
        'controller' => 'App\\Http\\Controllers\\Api\\ReportController@dailyReport',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::PRd6HuHtaS8MzoF6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::18yPiPX5qOEPpdQ0' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/reports/monthly',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ReportController@monthlyReport',
        'controller' => 'App\\Http\\Controllers\\Api\\ReportController@monthlyReport',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::18yPiPX5qOEPpdQ0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::w6VtTJ7TMMcIj9tv' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/reports/website-performance',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ReportController@websiteReport',
        'controller' => 'App\\Http\\Controllers\\Api\\ReportController@websiteReport',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::w6VtTJ7TMMcIj9tv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sHief9q1vnRkCuyp' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/reports/region-performance',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ReportController@regionReport',
        'controller' => 'App\\Http\\Controllers\\Api\\ReportController@regionReport',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::sHief9q1vnRkCuyp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2VWbaNIpEIhvtrk7' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/reports/approval-rates',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ReportController@approvalRate',
        'controller' => 'App\\Http\\Controllers\\Api\\ReportController@approvalRate',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::2VWbaNIpEIhvtrk7',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::WVvbKxWDKLjIHeGD' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/custom-fields',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomFieldController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomFieldController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
          0 => 'role:admin|executive|manager',
        ),
        'as' => 'generated::WVvbKxWDKLjIHeGD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::FpDeaVsmRwaec736' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/custom-fields',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomFieldController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomFieldController@store',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::FpDeaVsmRwaec736',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::HLMn7aIe4jQywOQA' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/custom-fields/{field}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomFieldController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomFieldController@update',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::HLMn7aIe4jQywOQA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TBHdnjche85SDMDU' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/custom-fields/{field}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomFieldController@destroy',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomFieldController@destroy',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::TBHdnjche85SDMDU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2WcUjzkhN5e7KMWm' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/custom-fields/set-value',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CustomFieldController@setValue',
        'controller' => 'App\\Http\\Controllers\\Api\\CustomFieldController@setValue',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::2WcUjzkhN5e7KMWm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bcYfNQV5wQfVlxIa' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/line-integration/settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\LineIntegrationController@getSettings',
        'controller' => 'App\\Http\\Controllers\\Api\\LineIntegrationController@getSettings',
        'namespace' => NULL,
        'prefix' => 'api/line-integration',
        'where' => 
        array (
        ),
        'as' => 'generated::bcYfNQV5wQfVlxIa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tc2vjCQL6TVLyLo7' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/line-integration/settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\LineIntegrationController@updateSettings',
        'controller' => 'App\\Http\\Controllers\\Api\\LineIntegrationController@updateSettings',
        'namespace' => NULL,
        'prefix' => 'api/line-integration',
        'where' => 
        array (
        ),
        'as' => 'generated::tc2vjCQL6TVLyLo7',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::WM9wu9FZv4yjyqle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/line-integration/test-connection',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\LineIntegrationController@testConnection',
        'controller' => 'App\\Http\\Controllers\\Api\\LineIntegrationController@testConnection',
        'namespace' => NULL,
        'prefix' => 'api/line-integration',
        'where' => 
        array (
        ),
        'as' => 'generated::WM9wu9FZv4yjyqle',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NmZZvWqL9cjmx9g4' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/line-integration/debug-connection',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\LineIntegrationController@debugConnection',
        'controller' => 'App\\Http\\Controllers\\Api\\LineIntegrationController@debugConnection',
        'namespace' => NULL,
        'prefix' => 'api/line-integration',
        'where' => 
        array (
        ),
        'as' => 'generated::NmZZvWqL9cjmx9g4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::8u9ipZTpZMV55LVK' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/line-integration/bot-info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\LineIntegrationController@getBotInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\LineIntegrationController@getBotInfo',
        'namespace' => NULL,
        'prefix' => 'api/line-integration',
        'where' => 
        array (
        ),
        'as' => 'generated::8u9ipZTpZMV55LVK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::B9jPtmjozj42Xd4b' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/line-integration/stats',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\LineIntegrationController@getStats',
        'controller' => 'App\\Http\\Controllers\\Api\\LineIntegrationController@getStats',
        'namespace' => NULL,
        'prefix' => 'api/line-integration',
        'where' => 
        array (
        ),
        'as' => 'generated::B9jPtmjozj42Xd4b',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wM6gbjWPzs9CnV5a' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/line-integration/recent-conversations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\LineIntegrationController@getRecentConversations',
        'controller' => 'App\\Http\\Controllers\\Api\\LineIntegrationController@getRecentConversations',
        'namespace' => NULL,
        'prefix' => 'api/line-integration',
        'where' => 
        array (
        ),
        'as' => 'generated::wM6gbjWPzs9CnV5a',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::lCjbsxQYpCSwHdw0' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/line-integration/send-message',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'role:admin|executive|manager',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\LineIntegrationController@sendMessage',
        'controller' => 'App\\Http\\Controllers\\Api\\LineIntegrationController@sendMessage',
        'namespace' => NULL,
        'prefix' => 'api/line-integration',
        'where' => 
        array (
        ),
        'as' => 'generated::lCjbsxQYpCSwHdw0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::nNF2FC8WBAsVLuJl' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'test-mysql-point20',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:3267:"function () {
    try {
        // 檢查用戶
        $user = \\App\\Models\\User::first();
        if (!$user) {
            return \\response()->json([\'error\' => \'沒有可用用戶\', \'success\' => false]);
        }
        
        // 創建測試客戶
        $customerData = [
            \'name\' => \'Point20測試_\' . \\time(),
            \'phone\' => \'0900\' . \\rand(100000, 999999),
            \'line_user_id\' => \'U_point20_\' . \\time(),
            \'region\' => \'台北市\',
            \'website_source\' => \'Point20測試\',
            \'status\' => \'new\',
            \'assigned_to\' => $user->id
        ];
        
        $customer = \\App\\Models\\Customer::create($customerData);
        
        // 測試ChatConversation創建
        $conversationData = [
            \'customer_id\' => $customer->id,
            \'line_user_id\' => $customer->line_user_id,
            \'status\' => \'unread\',
            \'last_message\' => \'Point20測試訊息: \' . \\now()->format(\'H:i:s\'),
            \'last_message_at\' => \\now(),
        ];
        
        // 記錄測試開始
        \\file_put_contents(
            \\storage_path(\'logs/webhook-debug.log\'),
            \\date(\'Y-m-d H:i:s\') . " - Point20測試 - 開始創建ChatConversation，customer_id: {$customer->id}\\n",
            FILE_APPEND | LOCK_EX
        );
        
        $conversation = \\App\\Models\\ChatConversation::create($conversationData);
        
        \\file_put_contents(
            \\storage_path(\'logs/webhook-debug.log\'),
            \\date(\'Y-m-d H:i:s\') . " - Point20測試 - ChatConversation創建成功，ID: {$conversation->id}, version: {$conversation->version}\\n",
            FILE_APPEND | LOCK_EX
        );
        
        return \\response()->json([
            \'success\' => true,
            \'message\' => \'Point 20 MySQL測試完全成功！\',
            \'results\' => [
                \'customer\' => [
                    \'id\' => $customer->id,
                    \'name\' => $customer->name,
                    \'line_user_id\' => $customer->line_user_id,
                    \'status\' => $customer->status
                ],
                \'conversation\' => [
                    \'id\' => $conversation->id,
                    \'version\' => $conversation->version,
                    \'status\' => $conversation->status,
                    \'last_message\' => $conversation->last_message
                ]
            ],
            \'point_20_status\' => \'MYSQL_CREATION_WORKING\',
            \'timestamp\' => \\now()->format(\'Y-m-d H:i:s\')
        ]);
        
    } catch (\\Exception $e) {
        \\file_put_contents(
            \\storage_path(\'logs/webhook-debug.log\'),
            \\date(\'Y-m-d H:i:s\') . " - Point20測試失敗: " . $e->getMessage() . " at " . $e->getFile() . ":" . $e->getLine() . "\\n",
            FILE_APPEND | LOCK_EX
        );
        
        return \\response()->json([
            \'success\' => false,
            \'message\' => \'Point 20 MySQL測試失敗\',
            \'error\' => $e->getMessage(),
            \'file\' => $e->getFile(),
            \'line\' => $e->getLine(),
            \'point_20_status\' => \'NEEDS_MORE_WORK\'
        ], 200); // 使用200避免被當作500錯誤
    }
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000007930000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::nNF2FC8WBAsVLuJl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GoUHrtc22pTCD8vJ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:168:"function () {
    return \\response()->json([
        \'message\' => \'Finance CRM Backend API\',
        \'version\' => \'1.0.0\',
        \'status\' => \'running\'
    ]);
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000008190000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::GoUHrtc22pTCD8vJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3ALxlaFQtZ24Vl1f' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'health',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:135:"function () {
    return \\response()->json([
        \'status\' => \'healthy\',
        \'timestamp\' => \\now()->toISOString()
    ]);
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000008250000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::3ALxlaFQtZ24Vl1f',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9zDCNe6iT6EzHCe4' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'broadcasting/auth',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:api',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:85:"function () {
    return \\Illuminate\\Support\\Facades\\Broadcast::auth(\\request());
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000000000082f0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::9zDCNe6iT6EzHCe4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZQJkSKFzwEKaOh9h' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'firebase-test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:4080:"function () {
    $output = [];
    
    try {
        $output[] = \'=== Firebase Service Test ===\';
        
        // 1. 測試日誌功能
        $output[] = \'1. Testing logging functionality...\';
        \\Illuminate\\Support\\Facades\\Log::info(\'Firebase service test started\', [\'timestamp\' => \\now()]);
        \\Illuminate\\Support\\Facades\\Log::channel(\'firebase\')->info(\'Firebase channel test message\');
        $output[] = \'   ✓ Log messages sent\';
        
        // 2. 測試 Firebase Database 服務綁定
        $output[] = \'2. Testing Firebase Database service binding...\';
        
        try {
            $database = \\app(\'firebase.database\');
            $output[] = \'   ✓ Firebase Database service resolved successfully\';
            $output[] = \'   Database class: \' . \\get_class($database);
            
            // 測試獲取引用
            try {
                $ref = $database->getReference(\'test\');
                $output[] = \'   ✓ Reference obtained successfully\';
            } catch (\\Exception $e) {
                $output[] = \'   ⚠ Reference test failed (expected if mock): \' . $e->getMessage();
            }
            
        } catch (\\Exception $e) {
            $output[] = \'   ✗ Firebase Database service binding failed: \' . $e->getMessage();
            \\Illuminate\\Support\\Facades\\Log::error(\'Firebase service test failed\', [
                \'error\' => $e->getMessage(),
                \'trace\' => $e->getTraceAsString()
            ]);
        }
        
        // 3. 測試其他 Firebase 服務
        $output[] = \'3. Testing other Firebase services...\';
        
        try {
            $firestore = \\app(\'firebase.firestore\');
            $output[] = \'   ✓ Firebase Firestore service resolved\';
        } catch (\\Exception $e) {
            $output[] = \'   ⚠ Firestore service: \' . $e->getMessage();
        }
        
        try {
            $auth = \\app(\'firebase.auth\');
            $output[] = \'   ✓ Firebase Auth service resolved\';
        } catch (\\Exception $e) {
            $output[] = \'   ⚠ Auth service: \' . $e->getMessage();
        }
        
        // 4. 檢查配置
        $output[] = \'4. Checking Firebase configuration...\';
        $config = [
            \'project_id\' => \\config(\'services.firebase.project_id\') ?: \'Not set\',
            \'database_url\' => \\config(\'services.firebase.database_url\') ?: \'Not set\',
            \'credentials_exist\' => \\file_exists(\\config(\'services.firebase.credentials\') ?: \'\') ? \'Yes\' : \'No\',
            \'credentials_path\' => \\config(\'services.firebase.credentials\') ?: \'Not set\'
        ];
        
        foreach ($config as $key => $value) {
            $output[] = "   {$key}: {$value}";
        }
        
        // 記錄配置到日誌
        \\Illuminate\\Support\\Facades\\Log::channel(\'firebase\')->info(\'Firebase configuration check\', $config);
        
        // 5. 檢查日誌檔案
        $output[] = \'5. Checking log files...\';
        $logPath = \\storage_path(\'logs/laravel.log\');
        $firebaseLogPath = \\storage_path(\'logs/firebase.log\');
        
        if (\\file_exists($logPath)) {
            $size = \\filesize($logPath);
            $output[] = "   ✓ Laravel log file exists: {$logPath} (" . \\number_format($size) . " bytes)";
        } else {
            $output[] = "   ⚠ Laravel log file not found: {$logPath}";
        }
        
        if (\\file_exists($firebaseLogPath)) {
            $output[] = "   ✓ Firebase log file exists: {$firebaseLogPath}";
        } else {
            $output[] = "   ⚠ Firebase log file not found: {$firebaseLogPath}";
        }
        
        $output[] = \'=== Firebase service test completed! ===\';
        
    } catch (\\Exception $e) {
        $output[] = \'FATAL ERROR: \' . $e->getMessage();
        $output[] = \'Stack trace: \' . $e->getTraceAsString();
    }
    
    // 返回文本響應
    return \\response(\\implode("\\n", $output), 200, [\'Content-Type\' => \'text/plain\']);
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000008310000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::ZQJkSKFzwEKaOh9h',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::eLCRC2Hy7kXxdZ53' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'env-diagnosis',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:3298:"function () {
    $output = [];
    
    try {
        $output[] = \'=== Environment Variable Diagnosis ===\';
        
        // 檢查環境變數
        $output[] = \'1. Checking Firebase Environment Variables:\';
        $firebaseEnvVars = [
            \'FIREBASE_PROJECT_ID\',
            \'FIREBASE_DATABASE_URL\', 
            \'FIREBASE_CREDENTIALS\'
        ];
        
        foreach ($firebaseEnvVars as $var) {
            $value = \\env($var);
            $output[] = "   {$var}: " . ($value ? $value : \'NOT SET\');
        }
        
        $output[] = \'\';
        $output[] = \'2. Checking Laravel Configuration:\';
        
        $configs = [
            \'services.firebase.project_id\' => \\config(\'services.firebase.project_id\'),
            \'services.firebase.database_url\' => \\config(\'services.firebase.database_url\'),
            \'services.firebase.credentials\' => \\config(\'services.firebase.credentials\'),
        ];
        
        foreach ($configs as $key => $value) {
            $output[] = "   {$key}: " . ($value ?: \'NOT SET\');
        }
        
        $output[] = \'\';
        $output[] = \'3. Checking App Environment:\';
        $output[] = \'   APP_ENV: \' . \\app()->environment();
        $output[] = \'   Config Cached: \' . (\\app()->configurationIsCached() ? \'YES\' : \'NO\');
        
        $output[] = \'\';
        $output[] = \'4. Checking Firebase Credentials File:\';
        $credentialsPath = \\config(\'services.firebase.credentials\');
        if ($credentialsPath && \\file_exists($credentialsPath)) {
            $output[] = "   ✓ File exists: {$credentialsPath}";
            $content = \\file_get_contents($credentialsPath);
            $json = \\json_decode($content, true);
            if ($json && isset($json[\'project_id\'])) {
                $output[] = "   Project ID in file: {$json[\'project_id\']}";
            } else {
                $output[] = "   ✗ Invalid JSON or missing project_id";
            }
        } else {
            $output[] = "   ✗ File not found: {$credentialsPath}";
        }
        
        $output[] = \'\';
        $output[] = \'5. System Information:\';
        $output[] = \'   PHP Version: \' . PHP_VERSION;
        $output[] = \'   Laravel Version: \' . \\app()->version();
        $output[] = \'   Current Directory: \' . \\getcwd();
        
        // 測試直接讀取 .env 檔案
        $output[] = \'\';
        $output[] = \'6. Direct .env file check:\';
        $envPath = \\base_path(\'.env\');
        if (\\file_exists($envPath)) {
            $envContent = \\file_get_contents($envPath);
            $lines = \\explode("\\n", $envContent);
            foreach ($lines as $line) {
                if (\\strpos($line, \'FIREBASE_\') === 0) {
                    $output[] = "   .env: {$line}";
                }
            }
        } else {
            $output[] = "   .env file not found at: {$envPath}";
        }
        
        $output[] = \'\';
        $output[] = \'=== Diagnosis completed ===\';
        
    } catch (\\Exception $e) {
        $output[] = \'FATAL ERROR: \' . $e->getMessage();
        $output[] = \'Stack trace: \' . $e->getTraceAsString();
    }
    
    return \\response(\\implode("\\n", $output), 200, [\'Content-Type\' => \'text/plain\']);
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000008330000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::eLCRC2Hy7kXxdZ53',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VCinGu2v9oxCJwVk' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'refresh-firebase-config',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:2374:"function () {
    $output = [];
    
    try {
        $output[] = \'=== Refreshing Firebase Configuration ===\';
        
        // Clear all caches
        $output[] = \'1. Clearing configuration cache...\';
        \\Artisan::call(\'config:clear\');
        $output[] = \'   ✓ Config cache cleared\';
        
        $output[] = \'2. Clearing route cache...\';
        \\Artisan::call(\'route:clear\');
        $output[] = \'   ✓ Route cache cleared\';
        
        $output[] = \'3. Clearing view cache...\';
        \\Artisan::call(\'view:clear\');
        $output[] = \'   ✓ View cache cleared\';
        
        // Re-cache config with updated environment variables
        $output[] = \'4. Re-caching configuration...\';
        \\Artisan::call(\'config:cache\');
        $output[] = \'   ✓ Configuration cached\';
        
        $output[] = \'5. Testing Firebase configuration...\';
        
        // Test the configuration
        $config = [
            \'project_id\' => \\config(\'services.firebase.project_id\'),
            \'database_url\' => \\config(\'services.firebase.database_url\'),
            \'credentials_exist\' => \\file_exists(\\config(\'services.firebase.credentials\') ?: \'\'),
            \'credentials_path\' => \\config(\'services.firebase.credentials\')
        ];
        
        foreach ($config as $key => $value) {
            if ($key === \'credentials_exist\') {
                $output[] = "   {$key}: " . ($value ? \'Yes\' : \'No\');
            } else {
                $output[] = "   {$key}: " . ($value ?: \'NOT SET\');
            }
        }
        
        // Test Firebase service binding
        try {
            $database = \\app(\'firebase.database\');
            $output[] = \'   ✓ Firebase Database service binding successful\';
            $output[] = \'   Database class: \' . \\get_class($database);
        } catch (\\Exception $e) {
            $output[] = \'   ✗ Firebase Database service binding failed: \' . $e->getMessage();
        }
        
        $output[] = \'\';
        $output[] = \'=== Firebase configuration refresh completed! ===\';
        
    } catch (\\Exception $e) {
        $output[] = \'FATAL ERROR: \' . $e->getMessage();
        $output[] = \'Stack trace: \' . $e->getTraceAsString();
    }
    
    return \\response(\\implode("\\n", $output), 200, [\'Content-Type\' => \'text/plain\']);
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000008350000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::VCinGu2v9oxCJwVk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::28MTwC2sWv3s1JFG' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'debug-login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:4788:"function (\\Illuminate\\Http\\Request $request) {
    $output = [];
    
    try {
        $output[] = \'=== Login API Debug ===\';
        $output[] = \'Request data: \' . \\json_encode($request->all());
        
        // 檢查資料庫連接
        $output[] = \'1. Testing database connection...\';
        try {
            \\DB::connection()->getPdo();
            $output[] = \'   ✓ Database connection successful\';
            
            $userCount = \\App\\Models\\User::count();
            $output[] = "   Users in database: {$userCount}";
            
        } catch (\\Exception $e) {
            $output[] = \'   ✗ Database connection failed: \' . $e->getMessage();
        }
        
        // 檢查 JWT 配置
        $output[] = \'2. Testing JWT configuration...\';
        try {
            $jwtSecret = \\config(\'jwt.secret\');
            $output[] = \'   JWT Secret: \' . ($jwtSecret ? \'SET\' : \'NOT SET\');
            
            $factory = \\Tymon\\JWTAuth\\Facades\\JWTAuth::factory();
            $output[] = \'   ✓ JWT factory created successfully\';
            
        } catch (\\Exception $e) {
            $output[] = \'   ✗ JWT configuration failed: \' . $e->getMessage();
        }
        
        // 檢查 Spatie Permissions
        $output[] = \'3. Testing Spatie Permissions...\';
        try {
            $roles = \\Spatie\\Permission\\Models\\Role::count();
            $permissions = \\Spatie\\Permission\\Models\\Permission::count();
            $output[] = "   Roles in database: {$roles}";
            $output[] = "   Permissions in database: {$permissions}";
            $output[] = \'   ✓ Spatie Permissions working\';
            
        } catch (\\Exception $e) {
            $output[] = \'   ✗ Spatie Permissions failed: \' . $e->getMessage();
        }
        
        // 測試用戶查詢
        if ($request->has(\'username\')) {
            $output[] = \'4. Testing user lookup...\';
            try {
                $user = \\App\\Models\\User::where(\'username\', $request->username)
                                      ->orWhere(\'email\', $request->username)
                                      ->first();
                
                if ($user) {
                    $output[] = "   ✓ User found: {$user->name} ({$user->username})";
                    $output[] = "   User status: {$user->status}";
                    $output[] = "   User roles: " . $user->getRoleNames()->implode(\', \');
                } else {
                    $output[] = \'   ⚠ User not found\';
                }
                
            } catch (\\Exception $e) {
                $output[] = \'   ✗ User lookup failed: \' . $e->getMessage();
            }
        }
        
        // 實際測試登入流程
        if ($request->has(\'username\') && $request->has(\'password\')) {
            $output[] = \'5. Testing actual login...\';
            try {
                $validator = \\Illuminate\\Support\\Facades\\Validator::make($request->all(), [
                    \'username\' => \'required|string\',
                    \'password\' => \'required|string|min:6\',
                ]);
                
                if ($validator->fails()) {
                    $output[] = \'   ⚠ Validation failed: \' . \\json_encode($validator->errors());
                } else {
                    $user = \\App\\Models\\User::where(\'username\', $request->username)
                                          ->orWhere(\'email\', $request->username)
                                          ->first();
                    
                    if ($user && \\Illuminate\\Support\\Facades\\Hash::check($request->password, $user->password)) {
                        if ($user->status === \'active\') {
                            $token = \\Tymon\\JWTAuth\\Facades\\JWTAuth::fromUser($user);
                            $user->updateLastLogin($request->ip());
                            $output[] = \'   ✓ Login successful, token generated\';
                        } else {
                            $output[] = \'   ⚠ User account not active\';
                        }
                    } else {
                        $output[] = \'   ⚠ Invalid credentials\';
                    }
                }
                
            } catch (\\Exception $e) {
                $output[] = \'   ✗ Login process failed: \' . $e->getMessage();
                $output[] = \'   Stack trace: \' . $e->getTraceAsString();
            }
        }
        
    } catch (\\Exception $e) {
        $output[] = \'FATAL ERROR: \' . $e->getMessage();
        $output[] = \'Stack trace: \' . $e->getTraceAsString();
    }
    
    return \\response(\\implode("\\n", $output), 200, [\'Content-Type\' => \'text/plain\']);
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000008370000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::28MTwC2sWv3s1JFG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
