<?php
$content = [
    "intro" => "Useful to collect signatures for a (local) initiative.",
    "benefits" => [
        "Easy petition signing without email",
        "Limit to a certain neighbourhood",
        "No invalid signatures",
    ],
    "data" => [
        "description" => "The personal data card",
        "sources" => [
            [
                "url" => "https://yivi.nijmegen.nl/login",
                "label" => "the Dutch resident registration (BRP)"
            ]
        ]
    ],
    "sidenotes" => "This demo combines <a href='../chained'>chained sessions</a> and <a href='../signature'>signatures</a>. The demo doesn’t perform any checks, but shows what it would look like if first a user proves they live in the area where petition may be signed before signing. This way, signatures can be validated before storing, instead of after collecting all signatures."
];
