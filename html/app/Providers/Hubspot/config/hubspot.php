<?php

return [
    'api_key' => env('HUBSPOT_API_KEY', 'eu1-9424-1757-4697-89e1-428fdb11d348'),
    'app_id' => env('HUBSPOT_APP_ID', '940573'),
    'client_id' => env('HUBSPOT_CLIENT_ID', '6f6b84ab-2ed3-4520-89eb-2344996eb592'),
    'client_secret' => env('HUBSPOT_CLIENT_SECRET', '3add7a5b-558b-48ac-8a37-db954d8dbf6c'),
    'timeline_event_template_id' => env('HUBSPOT_TIMELINE_EVENT_TEPLATE_ID', 1153875),
    'auth_middleware' => env('HUBSPOT_AUTH_MIDDLEWARE', 'auth.basic'),
    'jsons' => [
        0 => [
            'actionName' => 'Send SMS',
            'payload' =>
            '
            {
                "actionUrl": "' . env('HUBSPOT_APP_URL') . '/hubspot/smsto/send",
                "published": true,
                "inputFields": [
                    {
                        "typeDefinition": {
                            "name": "to",
                            "type": "string",
                            "fieldType": "text"
                        },
                        "supportedValueTypes": [
                            "STATIC_VALUE"
                        ],
                        "isRequired": true
                    },
                    {
                        "typeDefinition": {
                            "name": "message",
                            "type": "string",
                            "fieldType": "textarea"
                        },
                        "supportedValueTypes": [
                            "STATIC_VALUE"
                        ],
                        "isRequired": true
                    },
                    {
                        "typeDefinition": {
                            "name": "sender_id",
                            "type": "string",
                            "fieldType": "text"
                        },
                        "supportedValueTypes": [
                            "STATIC_VALUE"
                        ],
                        "isRequired": false
                    }
                ],
                "labels": {
                    "en": {
                        "actionName": "Send SMS",
                        "actionDescription": "Send single sms message to a number",
                        "actionCardContent": "Create send single message",
                        "inputFieldLabels": {
                            "to": "Phone number",
                            "message": "Your message",
                            "sender_id": "Sender ID"
                        },
                        "inputFieldDescriptions": {
                            "to": "Choose the mobile phone of the contact/lead",
                            "message": "Insert here the message to send.",
                            "sender_id": "The displayed value of who sent the message"
                        }
                    }
                },
                "objectTypes": [
                    "CONTACT",
                    "DEAL"
                ]
            }
            '
        ],
    ],
];
