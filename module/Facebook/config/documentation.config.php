<?php
return array(
    'Facebook\\V1\\Rpc\\GetFacebookFriends\\Controller' => array(
        'GET' => array(
            'description' => 'Retrieves facebook ids and names of the friends/influenced people of a given user.',
            'request' => null,
            'response' => '{
    "total": 5,
    "customer_id": "100000000013",
    "friends": [
        {
            "id": "10100516715635018",
            "name": "Chakra Kiran"
        },
        {
            "id": "10101679387994947",
            "name": "Mohan Venigalla"
        },
        {
            "id": "10103312125510807",
            "name": "Afsar Afsar"
        },
        {
            "id": "10152094195476486",
            "name": "Mohan Bisht Theth Pahadi"
        },
        {
            "id": "10152094697711199",
            "name": "Pradeep Kumar"
        },
        {
            "id": "10152106669201734",
            "name": "Maganti Ram Chandran"
        }
    ]
}',
        ),
    ),
);
