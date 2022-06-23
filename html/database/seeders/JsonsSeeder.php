<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JsonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Smsto\Hubspot\Models\Jsons::create([
            'name' => 'Send Single SMS',
            'payload' => '
            {
                "actionUrl": "'.route('hubspot.smsto.send').'",
                "published": true,
                "inputFields": [
                    {
                        "typeDefinition": {
                            "name": "api_key",
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
                            "name": "sender_id",
                            "type": "string",
                            "fieldType": "text"
                        },
                        "supportedValueTypes": [
                            "STATIC_VALUE"
                        ],
                        "isRequired": false
                    },
                    {
                        "typeDefinition": {
                            "name": "bypass_optout",
                            "type": "bool",
                            "fieldType": "booleancheckbox"
                        },
                        "supportedValueTypes": [
                            "STATIC_VALUE"
                        ],
                        "isRequired": false
                    },
                    {
                        "typeDefinition": {
                            "name": "callback_url",
                            "type": "string",
                            "fieldType": "text"
                        },
                        "supportedValueTypes": [
                            "STATIC_VALUE"
                        ],
                        "isRequired": false
                    },
                    {
                        "typeDefinition": {
                            "name": "scheduled_for",
                            "type": "datetime",
                            "fieldType": "date"
                        },
                        "supportedValueTypes": [
                            "STATIC_VALUE"
                        ],
                        "isRequired": false
                    },
                    {
                        "typeDefinition": {
                            "name": "timezone",
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
                            "api_key": "API key",
                            "message": "Your message",
                            "to": "Phone number",
                            "sender_id": "Sender ID",
                            "bypass_optout": "Bypass optout",
                            "callback_url": "Callback url",
                            "scheduled_for": "Schedule For",
                            "timezone": "Timezone"
                        },
                        "inputFieldDescriptions": {
                            "api_key": "To sned successful SMS messages, you need a verified account on SMS.to. Insert here your API key that you can get from sms.to",
                            "message": "Insert here the message to send.",
                            "to": "Choose the mobile phone of the contact/lead",
                            "sender_id": "The displayed value of who sent the message",
                            "bypass_optout": "True will bypass optouts",
                            "callback_url": "A callback URL that will be used to send back information about updates of message status.",
                            "scheduled_for": "Date and time when the message(s) will be sent. Leave empty to send immediately.",
                            "timezone": "The timezone of the scheduled date/time. Leave empty if not using scheduling"
                        }
                    }
                },
                "objectTypes": [
                    "CONTACT",
                    "DEAL"
                ]
            }
            ',
       ]);
    }
}
