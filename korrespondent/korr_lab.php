<?php

require '../vendor/autoload.php';
$httpClient = new \simplehtmldom\HtmlWeb();
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
///////////////         HOME PAGE TRENDING            ///////////////////////////////
include 'includes/session.php';
$link = 'https://id.korrespondent.net/aut/user.hnd?_1682069554223=';
$output = '';
//Title
$response = $httpClient->load($link);

$data = [
    "aw"=>"WBcZtEpauTJt-16-7bb477367be14fab",
    "cf_ch_cp_return"=>'c42105f0ed714e0b16a8d2bb9cbc1fef|{"managed_clearance":"ni"}',
    "md"=>"B2LOU4VRGpQJI2aPw9SOGc2COEUELLcqouHcH4TS1dU-1682067930-0-AeK7wm3d5mEvpvfRs1N_Der8U4SbVeYlZw1RziavOsuoLwLQIheCZ7gXXK1pNzhhpsdFY3Bo6dI-6w1sbY4GhzhfwRbPksnG2fXSvE0kgHjaCCJnfLHSVplQ7y2Xe-Z9OEuWB2hS8VQzXTIgUM5UK7W15gZbva2s3IpH4bwyNn4MloPfC1WaaPbViLasAqHMrHfRpLG_KmWGk7qkoMwxrlvDp26wWUVuhpX0ZW7HwrAGKWnACWldXsLwU-9POhSvzrqmrU3desznDNEWQvpyrBimNuDo2bz1hlbT_Kyf7XcFCmtRipNieGs0sKkpCcfSpSRsC1Y5QDwDu0KZo6ROQdAJiZSxXAaeWS06WMWIplnnNiSZBQeT3ZzjeCWkEHRWKj7UTHNwqd3owL1l0SDh-D0_3rP5q_TUGH6X9i0xpp-p5CEC9qeq_CrdtP2UqeYUvnfGONHA_JtLD_-KMk7APL2wi9aE1qBQAJ96HSRiVGDNBBfCKElxaKvh0D4OqXlhzW1htaYMlpklNXIQoX3brOqlcRRAkkx6CxnekKAPcv7bns-9F2bzUthz1jhzq82jFOeQckdl10IF9Egns4VLsHNeFsjcJz0zpRJjp-YdaIjmZ9z7Zy2wRoKYjKLbx2dGlpyYO-07q92s6Yvmz0hvn1C4wHdI_bY8zl_YwE3b9N8Sz6qw1wN4DIgjTYgjq8ru_TT-0DhXAGEL-DywlqgyLm4HeEsiZT8sBcCvAF6o6u360KiKS2DrJXoV8wNu1NLvrJUvJ6x7mASnY0C9O7TCBk9uLwMHRpr08siJZjBUz2NpSrA332k9p8tM04qdEzSzqZGX56cEQScrgQ_gZuEudbh1Ynzj2x8EhNFL3xpZq9pGoVVLSFllp_WPrTUtL4Gr6xZpZgELwbK2FBZ01FB02qbsM_kPzvx7fYtfWp3L4AyheiTFSoSEPwXTvc-da6xHbu-MQDmswhqcBIItCXynmSp_sAo8ENhOdT5rSWNL0IADvUQkOSuhbEo1rirkTy0nJo31LlyTFFP9BhKR9hT40ZCCQS9c1T2DGQ-Z8F-dWZzsvZjvrJlXIABh8R0lqi-Do6wTm_pyTXJNxVROJY8Hpeh-SnE_CDU7WQ5Ik0PH6ir1atLw21oLT_2XPs-nTSdmJ4TnYy29uw9uLSSrFnVs2RKw9uQhLAfQaODznUIG_yoci7JiPwmzodolU6TBBb5O_N6ykQFPWPRoe6eetqQon8X33s7LUroaZAynO9QcbAZZcsSp6-1YJhO-dXZ4XyOYDqNh4UPQujSCTDYhu8IVk6zkA0lhMZcBgV4S6KnUuFeNNaSCvxxwU7YpExW9UzIV8_9DYRCj9PnhsOzaPya2oNS9KnqIrYVzVZN5D_CR_dELHDT1wXZRWWg5M7ZsvgrEp5gnK-_n-i0DBJNHA-fVidoPu2bH7T1sWxh_kosWL85bOF57C495ZxK-cqv4svifoKLeq5BRL8YuQs1N4AuawhHc1UbIC_VH52jFHb2T44DaUMCeZuI3gbYAJtcU382-Zhwlmi21_ZMtn6HoBuu8p6rshTmnE7OH-pYSdlhFigFEwk_w-C7gUPfBjDzgFbJElJQ19A3Djk199M8lQqhmgTd3jNpqViNVWgarcZoo_4jdJ3x_G0OvbQNMLKNyuiYZ7XXVSifIwaElmduxXOjj-ohl9ehEsFsZljNN96BJb085EIGPdl3ydhHohumOi8GB7kL7hA3TPyXK95R_sTG4Z7Wat-LJj-dFYeF_H2Qnh2V8NT6UEK1pUEwEvpJXQE-MbiKrz1NO6sQuV8MBgDBltUpczR0y15ZFx-RxxjUPG_3VlvCi71xGO-F6XJLBN408iC3Tkt9dVhz0xDX8NW94NzSfxBmTC5itHgtTstUd9AMSntcQoIHL0kPm8lt3bTPWjrm5-_ttZBKhPfqU9z1hYDe9I8FSTChTBjAnmEdj-CgqCVO5he1YmrfeW2A3ljVvLl4HrxRia5Y-bwXOn_KGeFc-y6LE70uo2fhgJtvAThdyx_al1cYLeaeGuQmDIzklTvohFNBdxi6OO5Eqwo-KJCGJWsPxSPNY9UjSKxNDfNGc9yN1E84d6D27l2c6I15y3ZIV9aQ46Vd6BeBkRJzXeuMjzlRoN0Y8Vm8J2eDJUEB-OBQzWhqzT6xavXjIrNkP-zYeJ02mZgwZ-kAwdP3OMp0Ik92gcIsXs8HAxLIlGUi62BjzkMYq6G7SXx0oxTzXpyfq9PfhMrbTXRlggHiKieHbjLh__14sdNQvSO0M4DCib_XHCQBMqZPsuHuGOKT9oMmSQ9tPhQPCllXXvD553VfzTeXonaFp15VBI3gL0ti746kuieh9VC-Trpwnby2SlBfyQmUeOqwf-PRiVWhpurikevY5OWisXbHMf2BDHgAvXaNI65Kl-ktenWHgRQcR2uC9MI-Z1vpD-UF0UNMYXr6sjYpB3kqcRvp5ItjeFkDulXRH1LXQPbaKOxHRCGoYUL330f0Y6pLGDDi4vyTbYOAUUoOjATsm8kqwV522lcf7JEro10b_CxZHdtGO-QF3lsbp4oHzt5YOp1X-fK4QaVtoZOaIHzXqjU_cgzeyhmrpHJ8jucRgkBGjigak6EImw_7oK7AcToKIJ_zezYCvrpGqEM2EX5L7vXLE0malMG-EekHiXErEpR_Wdl5jz5yDRRLE6OWb1bayO_ZSI61WlOxeZ44DWvqEiNEDkipgpNIVJP0WYOnCjGq029JxmMRghKPcK38hBBy_rh-oeKoY9Hgg2F55Gdw3XUtKyjQt-ISoN1MJKiv8M-9ISyoTqACW29jj3IO-8-zQ_lTWpMrvkAiC7mTPeT_sJ_Gg9IbIqIKt5Zfm1R08O3Sc8vC67IUNQOx9TyShqlMhU1QLWjp6k7UseFQlHS-s3sjgP7gJND_FXT7PYHlFWtEcDqcyz1bP3VF5ZyEe4DjljseKAOuOx7KxQGt2xiUUPdAwII__9ofuCJN0MzD4RCLHwVCJjiLG1JnBte_justb--XLurDO-xq8q2Z-HwkCUnnrzcO91JDdPWI84oGx7zNPJfNDHxik9ftzaeGiq6U5G4NL5NAcqzM",
    "sh"=>"22121d19bb54b2fca6452d3966c8d5a9"
];

$headers = [
    'Cookie: __cf_bm=Ub6WDv_gMn2v1SLUtxfMK1JqHMMnh5NwVPbsEhd8CfU-1682068619-0-AX2ck54S9zAC2OuVEsLpKlvX24TRCexXoycFlT1X4p+zqCjo+yTSETXq1SK1DIlgR2tFVrDVVjRWO7OxLjCW6Oh5iiaescz4nwRLJMERuH1OCLlZ5jel+T7DhM+LYBYa6aRtpjGaI9KtgvJtyMh2a0Y=; Path=/; Expires=Sun, 07 Jan 2030 11:23:18 GMT;',
    'Cookie: _pbjs_userid_consent_data=3524755945110770; Path=/; Expires=Sun, 07 Jan 2030 11:23:18 GMT;',
    'Cookie: cf_clearance=VJRAXOnV7N.msywtOihGiMiXJp5nolMDZy4PcvzTtlc-1682067930-0-160; Path=/; Expires=Sun, 07 Jan 2030 11:23:18 GMT;',
    'Cookie: dcw=44; Path=/; Expires=Sun, 07 Jan 2030 11:23:18 GMT;',
    'Cookie: panoramaId=ae8b9ba1408f4355e7db9ee7c6604945a702ca9b3b634ee68a4ba8bf12924e30; Path=/; Expires=Sun, 07 Jan 2030 11:23:18 GMT;',
    'Cookie: panoramaId_expiry=1682332949325; Path=/; Expires=Sun, 07 Jan 2030 11:23:18 GMT;',
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36'
    ];

    $cookies = '
        __cf_bm=Ub6WDv_gMn2v1SLUtxfMK1JqHMMnh5NwVPbsEhd8CfU-1682068619-0-AX2ck54S9zAC2OuVEsLpKlvX24TRCexXoycFlT1X4p+zqCjo+yTSETXq1SK1DIlgR2tFVrDVVjRWO7OxLjCW6Oh5iiaescz4nwRLJMERuH1OCLlZ5jel+T7DhM+LYBYa6aRtpjGaI9KtgvJtyMh2a0Y=;
        _pbjs_userid_consent_data=3524755945110770;
        cf_clearance=VJRAXOnV7N.msywtOihGiMiXJp5nolMDZy4PcvzTtlc-1682067930-0-160;
        dcw=44;
        panoramaId=ae8b9ba1408f4355e7db9ee7c6604945a702ca9b3b634ee68a4ba8bf12924e30;
        panoramaId_expiry=1682332949325;
        ';
$response = httpGet($link, [], $headers, $cookies);

echo $response;