<?php
return array(
    'Visitor\\V1\\Rpc\\SearchByVisitor\\Controller' => array(
        'POST' => array(
            'description' => '',
            'response' => '{
    "location": "fremont",
    "cll": "37.7057953,-121.8815994",
    "term": "biryani bowl",
    "sort": 0,
    "dollar_range_filter": [
        1,
        2,
        3,
        4
    ],
    "category_filter": [
        "restaurants",
        "nightlife",
        "bars",
        "coffee&tea",
        "shopping",
        "beautysvc"
    ],
    "additional_info_filter": [],
    "dollage_range_counts": [
        {
            "id": 1,
            "count": 13,
            "display_name": "$"
        },
        {
            "id": 2,
            "count": 3,
            "display_name": "$$"
        },
        {
            "id": 3,
            "count": 0,
            "display_name": "$$$"
        },
        {
            "id": 4,
            "count": 0,
            "display_name": "$$$$"
        }
    ],
    "additional_info_counts": [
        {
            "id": "4",
            "display_name": "Good For Kids",
            "count": 9,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor_selected@3x.png"
        },
        {
            "id": "7",
            "display_name": "Wheel Chair Access",
            "count": 12,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair_selected@3x.png"
        },
        {
            "id": "13",
            "display_name": "Full Bar",
            "count": 2,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar_selected@3x.png"
        },
        {
            "id": "14",
            "display_name": "Beer and Wine only",
            "count": 2,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine_selected@3x.png"
        },
        {
            "id": "17",
            "display_name": "Lunch",
            "count": 10,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch_selected@3x.png"
        },
        {
            "id": "18",
            "display_name": "Dinner",
            "count": 9,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner_selected@3x.png"
        },
        {
            "id": "20",
            "display_name": "Delivery Avaliable",
            "count": 10,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver_selected@3x.png"
        },
        {
            "id": "21",
            "display_name": "Takeout",
            "count": 11,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout_selected@3x.png"
        },
        {
            "id": "22",
            "display_name": "Catering Avaliable",
            "count": 9,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater_selected@3x.png"
        },
        {
            "id": "27",
            "display_name": "Private Lot",
            "count": 4,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_lot@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_lot_selected@3x.png"
        },
        {
            "id": "32",
            "display_name": "Vegetarian",
            "count": 14,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian_selected@3x.png"
        },
        {
            "id": "37",
            "display_name": "Healthy ",
            "count": 14,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy_selected@3x.png"
        },
        {
            "id": "16",
            "display_name": "Breakfast",
            "count": 5,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_breakfast@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_breakfast_selected@3x.png"
        },
        {
            "id": "6",
            "display_name": "Good for Groups",
            "count": 3,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/groups_goodfor@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/groups_goodfor_selected@3x.png"
        },
        {
            "id": "8",
            "display_name": "Outdoor Seating",
            "count": 5,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/seating_outdoor@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/seating_outdoor_selected@3x.png"
        },
        {
            "id": "11",
            "display_name": "Accept Reservations",
            "count": 10,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations_selected@3x.png"
        },
        {
            "id": "26",
            "display_name": "Street",
            "count": 2,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_street@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_street_selected@3x.png"
        },
        {
            "id": "33",
            "display_name": "Vegan",
            "count": 2,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegan@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegan_selected@3x.png"
        },
        {
            "id": "30",
            "display_name": "Wifi Avaliable",
            "count": 1,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/wifi@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/wifi_selected@3x.png"
        },
        {
            "id": "29",
            "display_name": "Free Parking",
            "count": 1,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_free@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_free_selected@3x.png"
        },
        {
            "id": "25",
            "display_name": "Garage ",
            "count": 1,
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_garage@3x.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_garage_selected@3x.png"
        }
    ],
    "category_count": [
        {
            "id": "coffee&tea",
            "count": 1,
            "display_name": "Coffee & Tea"
        },
        {
            "id": "shopping",
            "count": 0,
            "display_name": "Shopping"
        },
        {
            "id": "beautysvc",
            "count": 0,
            "display_name": "Beauty & Spa"
        },
        {
            "id": "restaurants",
            "count": 35,
            "display_name": "Restaurants"
        },
        {
            "id": "nightlife",
            "count": 0,
            "display_name": "Night Life"
        },
        {
            "id": "bars",
            "count": 0,
            "display_name": "Bars"
        }
    ],
    "count": 20,
    "businesses": [
        {
            "global_merchant_id": "2084",
            "name": "Biryani bowl",
            "yelp_id": "biryani-bowl-fremont",
            "url": null,
            "is_claimed": "1",
            "rating": "3.1",
            "review_count": 290,
            "snippet_image_url": "https://s3-media2.fl.yelpcdn.com/photo/bzByxx-s-obRzz4YFPXDNA/ms.jpg",
            "snippet_text": "A Small Indian Restaurant with good food\\n\\nOrderd 2 garlic NAN and 2 Butter NAN accompanied with Chettinad chicken \\n\\nChicken Chettinad was outstanding -...",
            "image_url": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/d55a0956f86a7a4a4af5ada168e3f0d4.jpg",
            "image_big_url": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/f1269bf2a48fa97ecc897cde9da303a1.jpg",
            "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars.png",
            "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@2x.png",
            "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@3x.png",
            "categories": [
                "Indian"
            ],
            "display_phone": "+1-510-247-9264",
            "is_closed": "0",
            "city": "Fremont",
            "display_address1": "3988 washington blvd",
            "display_address2": "Fremont, CA 94538",
            "display_address3": null,
            "postal_code": "94538",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": {
                "monday": [
                    [
                        "11:30",
                        "15:00"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "tuesday": [
                    [
                        "11:30",
                        "15:00"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "wednesday": [
                    [
                        "11:30",
                        "15:00"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "thursday": [
                    [
                        "11:30",
                        "15:00"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "friday": [
                    [
                        "11:30",
                        "15:00"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "saturday": [
                    [
                        "11:30",
                        "15:00"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "sunday": [
                    [
                        "11:30",
                        "15:00"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ]
            },
            "hours_display": "Open Daily 11:30 AM-3:00 PM, 5:30 PM-10:00 PM",
            "additional_info": [
                {
                    "value": "1",
                    "item_id": "4",
                    "item_name": "kids_goodfor",
                    "display_name": "Good For Kids",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "7",
                    "item_name": "accessible_wheelchair",
                    "display_name": "Wheel Chair Access",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "10",
                    "item_name": "payment_cashonly",
                    "display_name": "Cash Payment Only ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "13",
                    "item_name": "alcohol_bar",
                    "display_name": "Full Bar",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "14",
                    "item_name": "alcohol_beer_wine",
                    "display_name": "Beer and Wine only",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "17",
                    "item_name": "meal_lunch",
                    "display_name": "Lunch",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "18",
                    "item_name": "meal_dinner",
                    "display_name": "Dinner",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "20",
                    "item_name": "meal_deliver",
                    "display_name": "Delivery Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "21",
                    "item_name": "meal_takeout",
                    "display_name": "Takeout",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "22",
                    "item_name": "meal_cater",
                    "display_name": "Catering Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "27",
                    "item_name": "parking_lot",
                    "display_name": "Private Lot",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_lot@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_lot_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "30",
                    "item_name": "wifi",
                    "display_name": "Wifi Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/wifi@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/wifi_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "32",
                    "item_name": "options_vegetarian",
                    "display_name": "Vegetarian",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "37",
                    "item_name": "options_healthy",
                    "display_name": "Healthy ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "84",
                    "item_name": "open_24hrs",
                    "display_name": "Open 24 Hours",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs_selected@3x.png"
                },
                {
                    "value": "casual",
                    "item_id": "1",
                    "item_name": "attire",
                    "display_name": "Attire",
                    "item_format": "String",
                    "icon_url": "",
                    "icon_selected_url": ""
                }
            ],
            "latitude": "37.531938538381",
            "longitude": "-121.95873550175",
            "dollar_range": "1",
            "merchant_id": "179",
            "created_date": "2015-09-09 12:37:19",
            "last_updated_date": "2015-09-09 12:37:19",
            "is_online_store": "0",
            "dollar_range_symbol": "$",
            "todays_hours": "11:30 to 15:00 , 17:30 to 22:00",
            "now_open": 1,
            "review": [
                {
                    "review_text": "The best Hyderabadi Biryani in bay area!!! The staff is excellent . They are kid friendly as they give toys to kids if you dine in. It has become our favorite restaurant . I wish they had a bigger place with more room ........ Also they need to keep their door open for cross ventilation!!! Apart from these tiny issues the food is awesome!!! ",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-lsMpFOCTsfw/AAAAAAAAAAI/AAAAAAAABeU/tUD_to7QJSA/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "sumrana Farshori",
                    "review_date_string": "7 months ago"
                },
                {
                    "review_text": "I am in US more than 16 years and never find best biryani many cities long time. After a long time i found best biryani in biryani bowl. Now i am regular customer and part of our weekly dinner.",
                    "reviewer_image_url": "https://lh6.googleusercontent.com/-4ElVkd5ZYC0/AAAAAAAAAAI/AAAAAAAAAR4/QfcQhiiRjYA/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "sridhar sambangi",
                    "review_date_string": "6 months ago"
                },
                {
                    "review_text": "Best chicken dum biryani around Fremont\\n\\nNaan with Pepper chicken awesome taste \\nIt would be great if they have more seating...",
                    "reviewer_image_url": "https://s3-media2.fl.yelpcdn.com/photo/_kPe3RY1hIEewCTKXW7bDg/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f1def11e4e79/ico/stars/v1/stars_5.png",
                    "review_source": "yelp",
                    "Review_user_name": "Sirish Kumar M.",
                    "review_date_string": "5 months ago"
                },
                {
                    "review_text": "This review is one of the horrible customer service I experienced .... Please see pictures attached.\\n\\nThey need to take ownership of mistakes they...",
                    "reviewer_image_url": "https://s3-media4.fl.yelpcdn.com/photo/G1l-3M3cV42g2nDQ98JSAQ/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
                    "review_source": "yelp",
                    "Review_user_name": "Sairam K.",
                    "review_date_string": "5 months ago"
                },
                {
                    "review_text": "This review is one of the horrible customer service I experienced .... Please see pictures attached.\\n\\nThey need to take ownership of mistakes they make......\\n\\nBeen to this place today , ordered two vegetarian curries. Bhindi fry and Bagara baingan.\\n\\nWhen checked at home , it was mirchi Kia Salan instead of Bagara baingan.\\n\\nCalled the restaurant and explained them about the mistake and they asked me for the order number. When mentioned as order number 12 , restaurant guy said its a chicken biryani and goat biryani order and not I mentioned. \\n\\nI told him that the receipt shows as order number 12, he says that\'s not correct... See again..... Same conversation repeats.......\\n\\nHe was so rude and ultimately hung up the phone saying my order number is not right .....\\n\\nSorry Biryani Bowl ..... You are horrible at customer service even for a simple Togo order.....  Is it rocket science to serve customer. \\n\\nYou lost business from a regular customer. You might not care about it",
                    "reviewer_image_url": "https://lh4.googleusercontent.com/-SQGYUtZta3E/AAAAAAAAAAI/AAAAAAAAKVA/pVWEVMimE14/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "sairam konala",
                    "review_date_string": "5 months ago"
                },
                {
                    "review_text": "I wish I could give 0 stars to these bunch of idiots. So we ordered 4 biryanis, the call was 3 min long he said 20 mins it\'ll be ready. So I go there after...",
                    "reviewer_image_url": "https://s3-media4.fl.yelpcdn.com/photo/uG00jVAb7mDAjh5tu0oOFg/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
                    "review_source": "yelp",
                    "Review_user_name": "Gautam H.",
                    "review_date_string": "5 months ago"
                },
                {
                    "review_text": "Worst veggie biryani ever!!! Please don\'t go if you are expecting nice veggie biryani",
                    "reviewer_image_url": "https://lh5.googleusercontent.com/-4MmF_WKGd9w/AAAAAAAAAAI/AAAAAAAAAl4/Wf6D1kmlfMA/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "siddharth bhindi",
                    "review_date_string": "30 days ago"
                },
                {
                    "review_text": "A great hole in a wall place for biriyanis. The food can be quite spicy for people not used to it but you can add some yogurt to tone down the heat!",
                    "reviewer_image_url": "https://lh4.googleusercontent.com/-QvJXxAKuSYk/AAAAAAAAAAI/AAAAAAAAFdM/7wtrSDZKo0g/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Andy C.",
                    "review_date_string": "26 days ago"
                },
                {
                    "review_text": "Some items are good like the biryanis etc but some items like the indo chinese are horrible.",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Image Thoughts Photography",
                    "review_date_string": "22 days ago"
                },
                {
                    "review_text": "An excellent place for biriyani",
                    "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/cfda2dd913a89d60ca465c3ccb177bd7.jpeg",
                    "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
                    "review_source": "Privpass",
                    "Review_user_name": "Asif M",
                    "review_date_string": "11 days ago"
                },
                {
                    "review_text": "An excellent place for biriyani",
                    "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/cfda2dd913a89d60ca465c3ccb177bd7.jpeg",
                    "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
                    "review_source": "Privpass",
                    "Review_user_name": "Asif M",
                    "review_date_string": "11 days ago"
                },
                {
                    "review_text": "A great hole in a wall place for biriyanis. The food can be quite spicy for people not used to it but you can add some yogurt to tone down the heat!",
                    "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/cfda2dd913a89d60ca465c3ccb177bd7.jpeg",
                    "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
                    "review_source": "Privpass",
                    "Review_user_name": "Asif M",
                    "review_date_string": "11 days ago"
                },
                {
                    "review_text": "I would to be here again.",
                    "reviewer_image_url": "https://scontent.xx.fbcdn.net/hprofile-xaf1/v/t1.0-1/p200x200/391683_10150976524620029_1125910000_n.jpg?oh=1972e23075e13e7dfa3992f56a365d89&oe=56E52C23",
                    "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
                    "review_source": "Privpass",
                    "Review_user_name": "Pavan C",
                    "review_date_string": "2 days ago"
                },
                {
                    "review_text": "Great food",
                    "reviewer_image_url": "https://scontent.xx.fbcdn.net/hprofile-xaf1/v/t1.0-1/p200x200/391683_10150976524620029_1125910000_n.jpg?oh=1972e23075e13e7dfa3992f56a365d89&oe=56E52C23",
                    "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
                    "review_source": "Privpass",
                    "Review_user_name": "Pavan C",
                    "review_date_string": "16 hours ago"
                }
            ],
            "images": [
                {
                    "image_url": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/d55a0956f86a7a4a4af5ada168e3f0d4.jpg",
                    "image_big_url": "https://s3-us-west-1.amazonaws.com/privpass.deal.media/f1269bf2a48fa97ecc897cde9da303a1.jpg",
                    "uploader_profile_url": "https://s3-media2.fl.yelpcdn.com/photo/bzByxx-s-obRzz4YFPXDNA/ms.jpg",
                    "image_source": "Yelp",
                    "user_name": "Biryani bowl",
                    "date_string": ""
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp.png",
                    "site1_review_count": "232",
                    "site1_rating": "3.0",
                    "site1_rating_image": "https://s3-media3.fl.yelpcdn.com/assets/2/www/img/34bc8086841c/ico/stars/v1/stars_3.png"
                },
                "accumulative": "5"
            },
            "review_summary_new": [
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp@3x.png",
                    "site_review_count": "232",
                    "site_rating": "3",
                    "site_source": "Yelp",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp-3.0-stars@3x.png"
                },
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/googlePlaces@3x.png",
                    "site_review_count": "53",
                    "site_rating": "3.5",
                    "site_source": "Google",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/google-3.5-stars@3x.png"
                },
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/logo-93x35.png",
                    "site_review_count": "5",
                    "site_rating": "5",
                    "site_source": "Privpass",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-5.0-stars@3x.png"
                }
            ],
            "claimed_merchant": {
                "id": "179",
                "merchant_lead_id": null,
                "global_merchant_id": "2084",
                "business_name": "Biryani bowl",
                "phone": "+1-510-247-9264",
                "email": "klmallikarjun@gmail.com",
                "address1": "3988 washington blvd",
                "address2": "Fremont, CA 94538",
                "city": "Fremont",
                "city_id": "518",
                "state": "California",
                "state_id": "5",
                "zip": "94538",
                "about_business": null,
                "website": null,
                "yelp_url": "http://www.yelp.com/biz/biryani-bowl-fremont",
                "tripadvisor_url": null,
                "google_plus_url": null,
                "description": "Biryani bowl",
                "working_hours": "{\\"monday\\":[[\\"11:30\\",\\"15:00\\"],[\\"17:30\\",\\"22:00\\"]],\\"tuesday\\":[[\\"11:30\\",\\"15:00\\"],[\\"17:30\\",\\"22:00\\"]],\\"wednesday\\":[[\\"11:30\\",\\"15:00\\"],[\\"17:30\\",\\"22:00\\"]],\\"thursday\\":[[\\"11:30\\",\\"15:00\\"],[\\"17:30\\",\\"22:00\\"]],\\"friday\\":[[\\"11:30\\",\\"15:00\\"],[\\"17:30\\",\\"22:00\\"]],\\"saturday\\":[[\\"11:30\\",\\"15:00\\"],[\\"17:30\\",\\"22:00\\"]],\\"sunday\\":[[\\"11:30\\",\\"15:00\\"],[\\"17:30\\",\\"22:00\\"]]}",
                "privileges": "null",
                "status": null,
                "verification_status": "not verified",
                "registration_date": "2015-09-23 10:15:30",
                "hours_display": "",
                "dollar_range": ""
            }
        },
        {
            "global_merchant_id": "1814",
            "name": "Pakwan Restaurant",
            "yelp_id": "pakwan-restaurant-fremont-2",
            "url": null,
            "is_claimed": "1",
            "rating": "3.9",
            "review_count": 582,
            "snippet_image_url": "https://s3-media1.fl.yelpcdn.com/photo/MiY5yRcFhrKFZcZmtvA3bA/ms.jpg",
            "snippet_text": "We had the chicken kebab curry, chicken tandoori leg and biryani.\\nTaste: 8/10 good taste.\\nPortions: 6/10\\nQuality/freshness: 8/10\\nWait time after ordering:...",
            "image_url": "https://s3-media1.fl.yelpcdn.com/bphoto/zAPHhVDopN-8rhrV7c3XAA/ms.jpg",
            "image_big_url": "https://s3-media1.fl.yelpcdn.com/bphoto/zAPHhVDopN-8rhrV7c3XAA/o.jpg",
            "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.5-stars.png",
            "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.5-stars@2x.png",
            "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.5-stars@3x.png",
            "categories": [
                "Indian",
                "Pakistani"
            ],
            "display_phone": "+1-510-226-6234",
            "is_closed": "0",
            "city": "Fremont",
            "display_address1": "41068 Fremont Blvd",
            "display_address2": "Fremont, CA 94538",
            "display_address3": null,
            "postal_code": "94538",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": {
                "tuesday": [
                    [
                        "11:00",
                        "22:30"
                    ]
                ],
                "wednesday": [
                    [
                        "11:00",
                        "22:30"
                    ]
                ],
                "thursday": [
                    [
                        "11:00",
                        "22:30"
                    ]
                ],
                "friday": [
                    [
                        "11:00",
                        "22:30"
                    ]
                ],
                "saturday": [
                    [
                        "11:00",
                        "22:30"
                    ]
                ],
                "sunday": [
                    [
                        "11:00",
                        "22:30"
                    ]
                ]
            },
            "hours_display": "Tue-Sun 11:00 AM-10:30 PM",
            "additional_info": [
                {
                    "value": "1",
                    "item_id": "4",
                    "item_name": "kids_goodfor",
                    "display_name": "Good For Kids",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "7",
                    "item_name": "accessible_wheelchair",
                    "display_name": "Wheel Chair Access",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "10",
                    "item_name": "payment_cashonly",
                    "display_name": "Cash Payment Only ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "16",
                    "item_name": "meal_breakfast",
                    "display_name": "Breakfast",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_breakfast@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_breakfast_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "17",
                    "item_name": "meal_lunch",
                    "display_name": "Lunch",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "18",
                    "item_name": "meal_dinner",
                    "display_name": "Dinner",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "20",
                    "item_name": "meal_deliver",
                    "display_name": "Delivery Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "21",
                    "item_name": "meal_takeout",
                    "display_name": "Takeout",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "22",
                    "item_name": "meal_cater",
                    "display_name": "Catering Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "32",
                    "item_name": "options_vegetarian",
                    "display_name": "Vegetarian",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "37",
                    "item_name": "options_healthy",
                    "display_name": "Healthy ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "84",
                    "item_name": "open_24hrs",
                    "display_name": "Open 24 Hours",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs_selected@3x.png"
                },
                {
                    "value": "casual",
                    "item_id": "1",
                    "item_name": "attire",
                    "display_name": "Attire",
                    "item_format": "String",
                    "icon_url": "",
                    "icon_selected_url": ""
                }
            ],
            "latitude": "37.531718264847",
            "longitude": "-121.95846119316",
            "dollar_range": "1",
            "merchant_id": "233",
            "created_date": "2015-09-09 12:37:19",
            "last_updated_date": "2015-09-09 12:37:19",
            "is_online_store": "0",
            "dollar_range_symbol": "$",
            "todays_hours": "11:00 to 22:30",
            "now_open": 1,
            "review": [
                {
                    "review_text": "I had gone on Saturday morning. Yellow daal was fresh and hot, bengan bharta was ok. Tea was decent too. Would have liked it more if they had tandoori roti and bhindi as well. Vegetables are known to be oily, but most people go there once in a while for some good taste. Overall, a good restaurant to go to, if you happen to be in that area.",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-k_UgCeU4xBw/AAAAAAAAAAI/AAAAAAAAFtI/9-RzmGYv32w/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Shyam Bansal",
                    "review_date_string": "10 months ago"
                },
                {
                    "review_text": "Probably the best Indian food in Fremont. Often busy and noisy, but that is the atmosphere of the place and completely expected. Lunch will set you back between $10 and $13.",
                    "reviewer_image_url": "https://lh6.googleusercontent.com/-i1YLy-xmLhA/AAAAAAAAAAI/AAAAAAAAV6U/1JVdXlvGC0U/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Devin Ramdutt",
                    "review_date_string": "10 months ago"
                },
                {
                    "review_text": "Best butter chicken ever! It\'s not supposed to be a fancy place its great for casual family dinners and friends. Honestly love their food so much",
                    "reviewer_image_url": "https://lh5.googleusercontent.com/-7TZR8jRFsKc/AAAAAAAAAAI/AAAAAAAAAik/cnrjOR8C5pQ/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "naina pasricha",
                    "review_date_string": "8 months ago"
                },
                {
                    "review_text": "I had never eaten Pakistani food before coming here, but it was delicious! I came here with people who knew what to order, and we all shared dishes family-style. We had one chickpea dish, one lamb dish, and one tomato/eggplant dish in addition to fresh naan. I don\'t remember the names of the dishes, but they were all full of flavor! The meat was very tender. The best part about eating at Pakwan is that you get unlimited servings of their homemade hot chai, which is full of different spices.",
                    "reviewer_image_url": "https://lh5.googleusercontent.com/-B7O2DJPMR3U/AAAAAAAAAAI/AAAAAAAAAJM/lybWY-ZKYQY/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Mo McBirney",
                    "review_date_string": "8 months ago"
                },
                {
                    "review_text": "Don\'t eat there. Take out only. Service is terrible. Restaurant is DIRTY and has total chaos. If you eat there your order has lower priority than the many...",
                    "reviewer_image_url": "https://s3-media4.fl.yelpcdn.com/photo/bumW8VJGecRrdv7TMp8VLQ/ms.jpg",
                    "rating_image": "http://s3-media2.fl.yelpcdn.com/assets/2/www/img/b561c24f8341/ico/stars/v1/stars_2.png",
                    "review_source": "yelp",
                    "Review_user_name": "Manuel R.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "Pakwan is more than a restaurant, it is an experience. Tucked in a a nondescript building near Mission District of Fremont, you enter a world entirely...",
                    "reviewer_image_url": "https://s3-media3.fl.yelpcdn.com/photo/YYnHCAP-Zko3rr_dPtmfkQ/ms.jpg",
                    "rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
                    "review_source": "yelp",
                    "Review_user_name": "Pinaki P.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "Oh how I wanted to give this place 4 stars.. Except for the upset stomach I had right after.\\n\\nLoved their tandoori chicken. I would go there again just to...",
                    "reviewer_image_url": "https://s3-media1.fl.yelpcdn.com/photo/ax8InM3Ee85SeVPtrveu8Q/ms.jpg",
                    "rating_image": "http://s3-media3.fl.yelpcdn.com/assets/2/www/img/34bc8086841c/ico/stars/v1/stars_3.png",
                    "review_source": "yelp",
                    "Review_user_name": "smitha k.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "Delicious Food. If you are looking for authentic Pakistani food, this is the place to go. Try their mutton pulav on Fridays. Not fancy on the looks, but Pakistani food done right !! They also have a SFO location, which is equally good.",
                    "reviewer_image_url": "https://lh6.googleusercontent.com/-cal1XYEDwMk/AAAAAAAAAAI/AAAAAAAABa8/ANc0HrkjcfY/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Prakash Dodeja",
                    "review_date_string": "25 days ago"
                },
                {
                    "review_text": "We love Pakwan for their Pakastani food. This location has been remodeled a bit. You order and wait for your number to be called. Get your own plates and flatware and chai and wait.Then you pick up your own dishes at the counter. You can leave your plates at the table after you are done. Yummy.",
                    "reviewer_image_url": "https://lh5.googleusercontent.com/-w1S0stH4wHU/AAAAAAAAAAI/AAAAAAAAPZQ/AgphVMvZF5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Eugene C",
                    "review_date_string": "15 days ago"
                }
            ],
            "images": [
                {
                    "image_url": "https://s3-media1.fl.yelpcdn.com/bphoto/zAPHhVDopN-8rhrV7c3XAA/ms.jpg",
                    "image_big_url": "https://s3-media1.fl.yelpcdn.com/bphoto/zAPHhVDopN-8rhrV7c3XAA/o.jpg",
                    "uploader_profile_url": "https://s3-media1.fl.yelpcdn.com/photo/MiY5yRcFhrKFZcZmtvA3bA/ms.jpg",
                    "image_source": "Yelp",
                    "user_name": "Pakwan Restaurant",
                    "date_string": ""
                },
                {
                    "image_url": "https://s3-us-west-1.amazonaws.com/bug.images/3e452b15fcc29f40c49857c27525d479.png",
                    "image_big_url": "https://s3-us-west-1.amazonaws.com/bug.images/ee791dbe99266b564cbf7a451bce604c.png",
                    "uploader_profile_url": "https://scontent.xx.fbcdn.net/hprofile-xaf1/v/t1.0-1/p200x200/391683_10150976524620029_1125910000_n.jpg?oh=1972e23075e13e7dfa3992f56a365d89&oe=56E52C23",
                    "image_source": "Privpass",
                    "user_name": "Pavan C",
                    "date_string": "12 days ago"
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp.png",
                    "site1_review_count": "513",
                    "site1_rating": "4.0",
                    "site1_rating_image": "https://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png"
                },
                "accumulative": "5"
            },
            "review_summary_new": [
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp@3x.png",
                    "site_review_count": "513",
                    "site_rating": "4",
                    "site_source": "Yelp",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp-4.0-stars@3x.png"
                },
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/googlePlaces@3x.png",
                    "site_review_count": "69",
                    "site_rating": "3.5",
                    "site_source": "Google",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/google-3.5-stars@3x.png"
                }
            ],
            "claimed_merchant": {
                "id": "233",
                "merchant_lead_id": null,
                "global_merchant_id": "1814",
                "business_name": "Pakwan Restaurant",
                "phone": "+1-510-226-6234",
                "email": "asifoddin@gmail.com",
                "address1": "41068 Fremont Blvd",
                "address2": null,
                "city": "Fremont",
                "city_id": "518",
                "state": "California",
                "state_id": "5",
                "zip": "94538",
                "about_business": null,
                "website": null,
                "yelp_url": "http://www.yelp.com/biz/pakwan-restaurant-fremont-2",
                "tripadvisor_url": null,
                "google_plus_url": null,
                "description": "Pakwan Restaurant",
                "working_hours": "{\\"tuesday\\":[[\\"11:00\\",\\"22:30\\"]],\\"wednesday\\":[[\\"11:00\\",\\"22:30\\"]],\\"thursday\\":[[\\"11:00\\",\\"22:30\\"]],\\"friday\\":[[\\"11:00\\",\\"22:30\\"]],\\"saturday\\":[[\\"11:00\\",\\"22:30\\"]],\\"sunday\\":[[\\"11:00\\",\\"22:30\\"]]}",
                "privileges": null,
                "status": null,
                "verification_status": "not verified",
                "registration_date": "2015-12-09 13:30:14",
                "hours_display": "",
                "dollar_range": ""
            }
        },
        {
            "global_merchant_id": "1813",
            "name": "Shalimar Restaurant",
            "yelp_id": "shalimar-restaurant-fremont",
            "url": null,
            "is_claimed": "1",
            "rating": "3.5",
            "review_count": 1258,
            "snippet_image_url": "https://s3-media4.fl.yelpcdn.com/photo/SjW-nP43tjY47_1quZCErA/ms.jpg",
            "snippet_text": "4 stars just because I think the food (specially curries) is little extra oily otherwise very good tasting. \\n\\nTheir curries are good but you know you can...",
            "image_url": "https://s3-media4.fl.yelpcdn.com/bphoto/5nEHAkHTUudDmJknuch9uw/ms.jpg",
            "image_big_url": "https://s3-media4.fl.yelpcdn.com/bphoto/5nEHAkHTUudDmJknuch9uw/o.jpg",
            "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars.png",
            "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@2x.png",
            "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@3x.png",
            "categories": [
                "Indian",
                "Pakistani"
            ],
            "display_phone": "+1-510-494-1919",
            "is_closed": "0",
            "city": "Fremont",
            "display_address1": "3325 Walnut Ave",
            "display_address2": "Fremont, CA 94538",
            "display_address3": null,
            "postal_code": "94538",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": {
                "monday": [
                    [
                        "11:30",
                        "22:30"
                    ]
                ],
                "tuesday": [
                    [
                        "11:30",
                        "22:30"
                    ]
                ],
                "wednesday": [
                    [
                        "11:30",
                        "22:30"
                    ]
                ],
                "thursday": [
                    [
                        "11:30",
                        "22:30"
                    ]
                ],
                "friday": [
                    [
                        "11:30",
                        "22:30"
                    ]
                ],
                "saturday": [
                    [
                        "11:30",
                        "22:30"
                    ]
                ],
                "sunday": [
                    [
                        "11:30",
                        "22:30"
                    ]
                ]
            },
            "hours_display": "Open Daily 11:30 AM-10:30 PM",
            "additional_info": [
                {
                    "value": "1",
                    "item_id": "4",
                    "item_name": "kids_goodfor",
                    "display_name": "Good For Kids",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "6",
                    "item_name": "groups_goodfor",
                    "display_name": "Good for Groups",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/groups_goodfor@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/groups_goodfor_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "7",
                    "item_name": "accessible_wheelchair",
                    "display_name": "Wheel Chair Access",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "8",
                    "item_name": "seating_outdoor",
                    "display_name": "Outdoor Seating",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/seating_outdoor@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/seating_outdoor_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "10",
                    "item_name": "payment_cashonly",
                    "display_name": "Cash Payment Only ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "11",
                    "item_name": "reservations",
                    "display_name": "Accept Reservations",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "16",
                    "item_name": "meal_breakfast",
                    "display_name": "Breakfast",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_breakfast@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_breakfast_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "17",
                    "item_name": "meal_lunch",
                    "display_name": "Lunch",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "18",
                    "item_name": "meal_dinner",
                    "display_name": "Dinner",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "20",
                    "item_name": "meal_deliver",
                    "display_name": "Delivery Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "21",
                    "item_name": "meal_takeout",
                    "display_name": "Takeout",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "22",
                    "item_name": "meal_cater",
                    "display_name": "Catering Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "31",
                    "item_name": "smoking",
                    "display_name": "Smoking Allowed",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/smoking@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/smoking_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "32",
                    "item_name": "options_vegetarian",
                    "display_name": "Vegetarian",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "37",
                    "item_name": "options_healthy",
                    "display_name": "Healthy ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "84",
                    "item_name": "open_24hrs",
                    "display_name": "Open 24 Hours",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs_selected@3x.png"
                },
                {
                    "value": "casual",
                    "item_id": "1",
                    "item_name": "attire",
                    "display_name": "Attire",
                    "item_format": "String",
                    "icon_url": "",
                    "icon_selected_url": ""
                }
            ],
            "latitude": "37.550334502871",
            "longitude": "-121.98023322111",
            "dollar_range": "1",
            "merchant_id": "230",
            "created_date": "2015-09-09 12:37:19",
            "last_updated_date": "2015-09-09 12:37:19",
            "is_online_store": "0",
            "dollar_range_symbol": "$",
            "todays_hours": "11:30 to 22:30",
            "now_open": 1,
            "review": [
                {
                    "review_text": "I was waiting for my food one hour lo :) it\'s my first time in my life.Im not understand why they don\'t care about a service.When I remind to them I\'m waiting one hour ready but they don\'t care.Thatwhy I can say they are the bad service in Bay Area lo.",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "shinji zumi",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "If you\'re a first-time visitor, let\'s get this out of the way: Be prepared to go home smelling like smoke and Indian spices. Shalimar has a huge oven that...",
                    "reviewer_image_url": "https://s3-media3.fl.yelpcdn.com/photo/0ytPU3oLLu71peD_Nbb7ew/ms.jpg",
                    "rating_image": "http://s3-media3.fl.yelpcdn.com/assets/2/www/img/34bc8086841c/ico/stars/v1/stars_3.png",
                    "review_source": "yelp",
                    "Review_user_name": "Rachel L.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "Yep. This place got us hooked. I mean us as in the entire family!\\nNope, we\'re not Indian descent, but we drive 20+ miles to get here once a week, at least....",
                    "reviewer_image_url": "https://s3-media3.fl.yelpcdn.com/photo/Dbcfj0AIAN7UiyDK05Lhgw/ms.jpg",
                    "rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
                    "review_source": "yelp",
                    "Review_user_name": "J R.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "Awesome place. Can\'t believe  such good food at such great price \\nShould try there tandoor food item. \\nMost flavourful aromatic indo pak cusine you could...",
                    "reviewer_image_url": "https://s3-media4.fl.yelpcdn.com/photo/tOkHoVFspuKLbgHwE4_JdA/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f1def11e4e79/ico/stars/v1/stars_5.png",
                    "review_source": "yelp",
                    "Review_user_name": "Rachita C.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "inmho, they need to improve their food  and ambience/cleanliness.    I have been only twice in 2 years and my only comment is they need to improve the food quality and cleanliness.  I just went for a causal meal at 2:30pm.  People and servers are nice, ambience is ok.  But bathroom and hallways need to be cleaned up and need to bring at par with other area restauants. \\nam sure many people like their food, as   with the rush they have perhaps quality is acceptable by most , so they can afford to clean up and bring a sense of some cleanliness.  anyhow, I wish them success but really their food is not as good as other neaby resturants.  my family prefers always prefer Pakwan and we have been 3 yrs here now.",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Ahmed Mustafa",
                    "review_date_string": "2 months ago"
                },
                {
                    "review_text": "Food tastes good. Below average customer service. More like a bazaar atmosphere than a restaurant. Establishment needs some major cleaning. Fresh air wouldn\'t hurt either. ",
                    "reviewer_image_url": "https://lh5.googleusercontent.com/-jtQwpTkANcw/AAAAAAAAAAI/AAAAAAAAEno/5xrK-7Gl2pc/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Farhad Razi",
                    "review_date_string": "1 month ago"
                },
                {
                    "review_text": "If don\'t know why people are crazy to eat here like if they are getting food for free but wait...oh wow the food is not even cheap...ambiance, cleanliness and service is not even average...This was our first visit and unfortunately we made it there during rush hours of Friday night. After giving order I went to the restroom and oh my my the most disgusting and dirty toilet I have ever seen in my life that I couldn\'t dare to use :( came out and saw two men standing outside women\'s restroom kinda awkward..came on my table and told my husband that I don\'t want to eat here cancel our order but he was like let\'s just give it a try..Our order came I was so upset to see the quantity of the things we have ordered...We ordered  their newly added item Chicken malai boti,  they didnt bother to give any chutney or raita or salad with it and it was below average in taste as well..not authentic at all and its just plain and dry and u have to deal with it....not going there again not even any other shalimar..They asked few other  customers in front of us if they are done eating coz there are others who are waiting and  wants to dine in..Are you Serious? U should never ask ur customers to leave especially if they are having their last few bites..",
                    "reviewer_image_url": "https://lh4.googleusercontent.com/-gE_N70QwCVQ/AAAAAAAAAAI/AAAAAAAAACc/f6G4TzrWj7U/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Quratulain Ghazal",
                    "review_date_string": "27 days ago"
                },
                {
                    "review_text": "Tandoori style foods are really good here. Curries look little oily but we liked it. The chicken in Briyani is tender soft and juicy. ",
                    "reviewer_image_url": "https://lh5.googleusercontent.com/-1cPtT5Li6e4/AAAAAAAAAAI/AAAAAAAALow/MHQvBOSrcMk/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Manigandan Shri",
                    "review_date_string": "26 days ago"
                },
                {
                    "review_text": "Authentic Pak indo cuisine. Lots of condiments, chai complimentary.",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Image Thoughts Photography",
                    "review_date_string": "23 days ago"
                },
                {
                    "review_text": "Good Pakastani cheap eat. Most people find it too greasy. We love it. My kids have been eating here since they were five years old. Order your food and tell him which table you are sitting at. They deliver the food. Chai is self serve. We like the goat curry, Daal masala, palak paneer. The cashier guy looks really serious and no nonsense but he is actually really friendly and helpful.",
                    "reviewer_image_url": "https://lh5.googleusercontent.com/-w1S0stH4wHU/AAAAAAAAAAI/AAAAAAAAPZQ/AgphVMvZF5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Eugene C",
                    "review_date_string": "15 days ago"
                },
                {
                    "review_text": "Good food and low prices",
                    "reviewer_image_url": "https://scontent.xx.fbcdn.net/hprofile-xtp1/v/t1.0-1/p200x200/11825918_109436499407057_8009480685247878744_n.jpg?oh=33d8366c497410cb3ad133a373dab150&oe=56F8B091",
                    "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
                    "review_source": "Privpass",
                    "Review_user_name": "Vihaan K",
                    "review_date_string": "14 days ago"
                },
                {
                    "review_text": "Had a nice dum Biryani.. Tasted awesome",
                    "reviewer_image_url": "https://scontent.xx.fbcdn.net/hprofile-xaf1/v/t1.0-1/p200x200/391683_10150976524620029_1125910000_n.jpg?oh=1972e23075e13e7dfa3992f56a365d89&oe=56E52C23",
                    "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
                    "review_source": "Privpass",
                    "Review_user_name": "Pavan C",
                    "review_date_string": "2 days ago"
                }
            ],
            "images": [
                {
                    "image_url": "https://s3-media4.fl.yelpcdn.com/bphoto/5nEHAkHTUudDmJknuch9uw/ms.jpg",
                    "image_big_url": "https://s3-media4.fl.yelpcdn.com/bphoto/5nEHAkHTUudDmJknuch9uw/o.jpg",
                    "uploader_profile_url": "https://s3-media4.fl.yelpcdn.com/photo/SjW-nP43tjY47_1quZCErA/ms.jpg",
                    "image_source": "Yelp",
                    "user_name": "Shalimar Restaurant",
                    "date_string": ""
                },
                {
                    "image_url": "https://s3-us-west-1.amazonaws.com/bug.images/7e30b40269fc85fc85c5169abb0b9005.png",
                    "image_big_url": "https://s3-us-west-1.amazonaws.com/bug.images/432f93848d07ddeae1a237ab9262c66e.png",
                    "uploader_profile_url": "https://scontent.xx.fbcdn.net/hprofile-xaf1/v/t1.0-1/p200x200/391683_10150976524620029_1125910000_n.jpg?oh=1972e23075e13e7dfa3992f56a365d89&oe=56E52C23",
                    "image_source": "Privpass",
                    "user_name": "Pavan C",
                    "date_string": "12 days ago"
                },
                {
                    "image_url": "https://s3-us-west-1.amazonaws.com/bug.images/80b41f63e998ce17be47dfc87b2174cb.png",
                    "image_big_url": "https://s3-us-west-1.amazonaws.com/bug.images/029898b8e33583ced7a9b8fa7ec34e25.png",
                    "uploader_profile_url": "https://scontent.xx.fbcdn.net/hprofile-xaf1/v/t1.0-1/p200x200/391683_10150976524620029_1125910000_n.jpg?oh=1972e23075e13e7dfa3992f56a365d89&oe=56E52C23",
                    "image_source": "Privpass",
                    "user_name": "Pavan C",
                    "date_string": "12 days ago"
                },
                {
                    "image_url": "https://s3-us-west-1.amazonaws.com/bug.images/e75dd05a82e7f74564410cce2d31c27d.png",
                    "image_big_url": "https://s3-us-west-1.amazonaws.com/bug.images/eda2b96388ac3e1f82d6ac0b20ac371e.png",
                    "uploader_profile_url": "https://scontent.xx.fbcdn.net/hprofile-xaf1/v/t1.0-1/p200x200/391683_10150976524620029_1125910000_n.jpg?oh=1972e23075e13e7dfa3992f56a365d89&oe=56E52C23",
                    "image_source": "Privpass",
                    "user_name": "Pavan C",
                    "date_string": "12 days ago"
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp.png",
                    "site1_review_count": "1116",
                    "site1_rating": "3.5",
                    "site1_rating_image": "https://s3-media1.fl.yelpcdn.com/assets/2/www/img/5ef3eb3cb162/ico/stars/v1/stars_3_half.png"
                },
                "accumulative": "5"
            },
            "review_summary_new": [
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp@3x.png",
                    "site_review_count": "1116",
                    "site_rating": "3.5",
                    "site_source": "Yelp",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp-3.5-stars@3x.png"
                },
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/googlePlaces@3x.png",
                    "site_review_count": "140",
                    "site_rating": "3.5",
                    "site_source": "Google",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/google-3.5-stars@3x.png"
                },
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/logo-93x35.png",
                    "site_review_count": "2",
                    "site_rating": "4",
                    "site_source": "Privpass",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-4.0-stars@3x.png"
                }
            ],
            "claimed_merchant": {
                "id": "230",
                "merchant_lead_id": "612",
                "global_merchant_id": "1813",
                "business_name": "Shalimar Restaurant",
                "phone": "+1-510-494-1919",
                "email": "klmallikarjun@gmail.com",
                "address1": "3325 Walnut Ave",
                "address2": null,
                "city": "Fremont",
                "city_id": "518",
                "state": "California",
                "state_id": "5",
                "zip": "94538",
                "about_business": null,
                "website": null,
                "yelp_url": "http://www.yelp.com/biz/shalimar-restaurant-fremont",
                "tripadvisor_url": null,
                "google_plus_url": null,
                "description": "Shalimar Restaurant",
                "working_hours": "{\\"monday\\":[[\\"11:30\\",\\"22:30\\"]],\\"tuesday\\":[[\\"11:30\\",\\"22:30\\"]],\\"wednesday\\":[[\\"11:30\\",\\"22:30\\"]],\\"thursday\\":[[\\"11:30\\",\\"22:30\\"]],\\"friday\\":[[\\"11:30\\",\\"22:30\\"]],\\"saturday\\":[[\\"11:30\\",\\"22:30\\"]],\\"sunday\\":[[\\"11:30\\",\\"22:30\\"]]}",
                "privileges": null,
                "status": null,
                "verification_status": "not verified",
                "registration_date": "2015-11-24 00:34:12",
                "hours_display": "",
                "dollar_range": ""
            }
        },
        {
            "global_merchant_id": "4528",
            "name": "Peacock Indian Restaurants",
            "yelp_id": "peacock-indian-restaurants-fremont-2",
            "url": null,
            "is_claimed": "1",
            "rating": "3.0",
            "review_count": 214,
            "snippet_image_url": "https://s3-media4.fl.yelpcdn.com/assets/srv0/yelp_styleguide/cc4afe21892e/assets/img/default_avatars/user_medium_square.png",
            "snippet_text": "We ordered their food for catering our kid\'s birthday lunch party.\\nOur menu was spinach pakora, Butter naan, paneer tikka, chicken kadai and veg dum...",
            "image_url": "https://s3-media1.fl.yelpcdn.com/bphoto/G_KmbwoJ2P5axeg5sXROXw/ms.jpg",
            "image_big_url": "https://s3-media1.fl.yelpcdn.com/bphoto/G_KmbwoJ2P5axeg5sXROXw/o.jpg",
            "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars.png",
            "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@2x.png",
            "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@3x.png",
            "categories": [
                "Indian"
            ],
            "display_phone": "+1-510-226-6320",
            "is_closed": "0",
            "city": "Fremont",
            "display_address1": "39447 Fremont Blvd",
            "display_address2": "Fremont, CA 94538",
            "display_address3": null,
            "postal_code": "94538",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": {
                "monday": [
                    [
                        "11:30",
                        "15:00"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "tuesday": [
                    [
                        "11:30",
                        "15:00"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "wednesday": [
                    [
                        "11:30",
                        "15:00"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "thursday": [
                    [
                        "11:30",
                        "15:00"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "friday": [
                    [
                        "11:30",
                        "15:00"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "saturday": [
                    [
                        "11:30",
                        "15:00"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "sunday": [
                    [
                        "11:30",
                        "15:00"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ]
            },
            "hours_display": "Open Daily 11:30 AM-3:00 PM, 5:30 PM-10:00 PM",
            "additional_info": [
                {
                    "value": "1",
                    "item_id": "7",
                    "item_name": "accessible_wheelchair",
                    "display_name": "Wheel Chair Access",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "10",
                    "item_name": "payment_cashonly",
                    "display_name": "Cash Payment Only ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "11",
                    "item_name": "reservations",
                    "display_name": "Accept Reservations",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "17",
                    "item_name": "meal_lunch",
                    "display_name": "Lunch",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "18",
                    "item_name": "meal_dinner",
                    "display_name": "Dinner",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "20",
                    "item_name": "meal_deliver",
                    "display_name": "Delivery Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "21",
                    "item_name": "meal_takeout",
                    "display_name": "Takeout",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "32",
                    "item_name": "options_vegetarian",
                    "display_name": "Vegetarian",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "37",
                    "item_name": "options_healthy",
                    "display_name": "Healthy ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "84",
                    "item_name": "open_24hrs",
                    "display_name": "Open 24 Hours",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs_selected@3x.png"
                },
                {
                    "value": "casual",
                    "item_id": "1",
                    "item_name": "attire",
                    "display_name": "Attire",
                    "item_format": "String",
                    "icon_url": "",
                    "icon_selected_url": ""
                }
            ],
            "latitude": "37.544693",
            "longitude": "-121.9811859",
            "dollar_range": "1",
            "merchant_id": "232",
            "created_date": "2015-10-08 06:26:49",
            "last_updated_date": null,
            "is_online_store": "0",
            "dollar_range_symbol": "$",
            "todays_hours": "11:30 to 15:00 , 17:30 to 22:00",
            "now_open": 1,
            "review": [
                {
                    "review_text": "We ordered their food for catering our kid\'s birthday lunch party.\\nOur menu was spinach pakora, Butter naan, paneer tikka, chicken kadai and veg dum...",
                    "reviewer_image_url": "https://s3-media4.fl.yelpcdn.com/assets/srv0/yelp_styleguide/cc4afe21892e/assets/img/default_avatars/user_medium_square.png",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f1def11e4e79/ico/stars/v1/stars_5.png",
                    "review_source": "yelp",
                    "Review_user_name": "K K.",
                    "review_date_string": "5 months ago"
                },
                {
                    "review_text": "Its hit or miss. U get varying taste for the same item ordered in different days. I am a biryani fan, but vegetarian. First time I ordered from them I just loved it. But I did not  the same taste next 8 times. I got the same taste on 9th time. This happened with few items. \\n\\nSo I stopped going there. Not all that great. I agree with staff negative reviews\\nVenkata Sundaragiri",
                    "reviewer_image_url": "https://lh5.googleusercontent.com/-c4nqfhQcNzg/AAAAAAAAAAI/AAAAAAAAHqI/UTZMl0cqQjU/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Venkata Sundaragiri",
                    "review_date_string": "4 months ago"
                },
                {
                    "review_text": "ZERO STARS for this horrible, horrible restaurant. Had a scheduled \\"Food Tasting\\" on Friday June 26th for a wedding on August 15th. This appointment was made 3 months in advance. Dominic was recruited to be our contact person. He greeted us with a scowl on his face. Only part of the requested menu was available for tasting. Dominic asked us to return on Sunday June 28th at 4:30PM to complete the food tasting. Being from the Chicago area and so close to the big day, decided to put up with this nonsense and went back on Sunday only to be told by an even more rude receptionist that Dominic was off duty and he never works on Sundays. The owner Prasad Vasireddy and his partner Arif never completed the insurance papers for the Hyatt where the wedding was scheduled. They did not sign the contract. I finally dumped them and recruited other caterers in one day. My son\'s wedding is over and there was excellent food served by other Indian restaurants in the San Jose area.  ",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Sulekha Kumar",
                    "review_date_string": "4 months ago"
                },
                {
                    "review_text": "Worst food I have ever had.\\nIt\'s all about their poor buffet.\\nBiryani is too worst.\\nTandoori chicken seems to be just now taken out from the fridge, it\'s so...",
                    "reviewer_image_url": "https://s3-media2.fl.yelpcdn.com/photo/hSPYVpSm_ZUPSxOW3plbDw/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
                    "review_source": "yelp",
                    "Review_user_name": "Venkatesh C.",
                    "review_date_string": "4 months ago"
                },
                {
                    "review_text": "I prefer santa clara peacock\\nThis place is not good\\nVegetarian will not be able eat here .\\nStay away",
                    "reviewer_image_url": "https://s3-media3.fl.yelpcdn.com/photo/WGXTGdyYmy5xZ4qdBCM0FA/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
                    "review_source": "yelp",
                    "Review_user_name": "ramamurthy k.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "The food was average. The appetizer and the main course (vegetarian) mostly had huge chunks of onions in them. After we were done eating, the check that came after a long wait didn\'t include some of the items we had ordered. When we pointed out, our waiter went back to his station to find our orders but he couldn\'t. We had to personally go to the cashier, who made us wait again because she was busy attending phone calls, list out all the items we ordered by looking at the menu card and pay our check. We won\'t be going back here.",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Nidhishree Adiga",
                    "review_date_string": "2 months ago"
                },
                {
                    "review_text": "Very bad management. I ordered a veg briyani and it had a chicken piece in it. When I informed the manager she was not apologetic and was rude. Would not go there again. ",
                    "reviewer_image_url": "https://lh6.googleusercontent.com/-N2d2si2CCEE/AAAAAAAAAAI/AAAAAAAAEhY/U3mRaoY0SpE/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "ganesh raj kumar",
                    "review_date_string": "26 days ago"
                },
                {
                    "review_text": "Must try - Dum Biryani and malabar parathas. Okra fry is spicy crispy fried with peanuts. Avoid - dal makhani.",
                    "reviewer_image_url": "https://lh4.googleusercontent.com/-gH0bGNdFSis/AAAAAAAAAAI/AAAAAAAAIKM/yhh107VsSXs/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Tripti Bansal Burman",
                    "review_date_string": "25 days ago"
                },
                {
                    "review_text": "These guys serve stale and spoiled food. went to this place today, ordered malai kofta, the koftas were clearly spoiled, there were wires forming when cutting the kofta. Called the manager and chef, chef agreed that koftas are spoiled, even then manager was trying to prove that it\'s not spoiled. Would never goto this place again and never recommend anybody...",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-HRaXMH321Q4/AAAAAAAAAAI/AAAAAAAAAko/SG2ijGTaF2A/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "gaurav sharma",
                    "review_date_string": "13 days ago"
                }
            ],
            "images": [
                {
                    "image_url": "https://s3-media1.fl.yelpcdn.com/bphoto/G_KmbwoJ2P5axeg5sXROXw/ms.jpg",
                    "image_big_url": "https://s3-media1.fl.yelpcdn.com/bphoto/G_KmbwoJ2P5axeg5sXROXw/o.jpg",
                    "uploader_profile_url": "https://s3-media4.fl.yelpcdn.com/assets/srv0/yelp_styleguide/cc4afe21892e/assets/img/default_avatars/user_medium_square.png",
                    "image_source": "Yelp",
                    "user_name": "Peacock Indian Restaurants",
                    "date_string": ""
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp.png",
                    "site1_review_count": "130",
                    "site1_rating": "3.0",
                    "site1_rating_image": "https://s3-media3.fl.yelpcdn.com/assets/2/www/img/34bc8086841c/ico/stars/v1/stars_3.png"
                },
                "accumulative": "5"
            },
            "review_summary_new": [
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp@3x.png",
                    "site_review_count": "130",
                    "site_rating": "3",
                    "site_source": "Yelp",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp-3.0-stars@3x.png"
                },
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/googlePlaces@3x.png",
                    "site_review_count": "84",
                    "site_rating": "3",
                    "site_source": "Google",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/google-3.0-stars@3x.png"
                }
            ],
            "claimed_merchant": {
                "id": "232",
                "merchant_lead_id": "613",
                "global_merchant_id": "4528",
                "business_name": "Peacock Indian Restaurants",
                "phone": "+1-510-226-6320",
                "email": "l.m.kodali98@gmail.com",
                "address1": "39447 Fremont Blvd",
                "address2": null,
                "city": "Fremont",
                "city_id": "518",
                "state": "California",
                "state_id": "5",
                "zip": "94538",
                "about_business": null,
                "website": null,
                "yelp_url": "http://www.yelp.com/biz/peacock-indian-restaurants-fremont-2",
                "tripadvisor_url": null,
                "google_plus_url": null,
                "description": "Peacock Indian Restaurants",
                "working_hours": "{\\"monday\\":[[\\"11:30\\",\\"15:00\\"],[\\"17:30\\",\\"22:00\\"]],\\"tuesday\\":[[\\"11:30\\",\\"15:00\\"],[\\"17:30\\",\\"22:00\\"]],\\"wednesday\\":[[\\"11:30\\",\\"15:00\\"],[\\"17:30\\",\\"22:00\\"]],\\"thursday\\":[[\\"11:30\\",\\"15:00\\"],[\\"17:30\\",\\"22:00\\"]],\\"friday\\":[[\\"11:30\\",\\"15:00\\"],[\\"17:30\\",\\"22:00\\"]],\\"saturday\\":[[\\"11:30\\",\\"15:00\\"],[\\"17:30\\",\\"22:00\\"]],\\"sunday\\":[[\\"11:30\\",\\"15:00\\"],[\\"17:30\\",\\"22:00\\"]]}",
                "privileges": null,
                "status": null,
                "verification_status": "not verified",
                "registration_date": "2015-11-24 00:52:28",
                "hours_display": "",
                "dollar_range": ""
            }
        },
        {
            "global_merchant_id": "1826",
            "name": "Tandoori-n-Curry",
            "yelp_id": "tandoori-n-curry-fremont",
            "url": null,
            "is_claimed": "1",
            "rating": "3.5",
            "review_count": 132,
            "snippet_image_url": "https://s3-media3.fl.yelpcdn.com/photo/45n97fDzM9S8lP9I4DijpA/ms.jpg",
            "snippet_text": "I know NOTHING about Pakistani food. \\nFirst time to try their traditional cuisine. \\n\\n...I LOOVE IT. \\nFoods can be really greasy (for people who haven\'t...",
            "image_url": "https://s3-media3.fl.yelpcdn.com/bphoto/qEHvXBRiVypQazUfgc4Zdg/ms.jpg",
            "image_big_url": "https://s3-media3.fl.yelpcdn.com/bphoto/qEHvXBRiVypQazUfgc4Zdg/o.jpg",
            "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars.png",
            "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@2x.png",
            "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@3x.png",
            "categories": [
                "Indian",
                "Pakistani",
                "Halal"
            ],
            "display_phone": "+1-510-979-1615",
            "is_closed": "0",
            "city": "Fremont",
            "display_address1": "40559 Fremont Blvd",
            "display_address2": "Fremont, CA 94538",
            "display_address3": null,
            "postal_code": "94538",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": [
                {
                    "day": "Mon",
                    "hours": "11:30 am - 3:00 pm5:30 pm - 10:30 pm"
                },
                {
                    "day": "Tue",
                    "hours": "Closed"
                },
                {
                    "day": "Wed",
                    "hours": "11:30 am - 3:00 pm5:30 pm - 10:30 pm"
                },
                {
                    "day": "Thu",
                    "hours": "11:30 am - 3:00 pm5:30 pm - 10:30 pm"
                },
                {
                    "day": "Fri",
                    "hours": "11:30 am - 3:00 pm5:30 pm - 11:00 pm"
                },
                {
                    "day": "Sat",
                    "hours": "11:30 am - 3:00 pm5:30 pm - 11:00 pm"
                },
                {
                    "day": "Sun",
                    "hours": "11:30 am - 3:00 pm5:30 pm - 10:30 pm"
                }
            ],
            "hours_display": "",
            "additional_info": [],
            "latitude": "37.535974904895",
            "longitude": "-121.96471095085",
            "dollar_range": "2",
            "merchant_id": null,
            "created_date": "2015-09-09 12:37:19",
            "last_updated_date": "2015-09-09 12:37:19",
            "is_online_store": "0",
            "dollar_range_symbol": "$$",
            "todays_hours": "",
            "now_open": 0,
            "review": [
                {
                    "review_text": "I know NOTHING about Pakistani food. \\nFirst time to try their traditional cuisine. \\n\\n...I LOOVE IT. \\nFoods can be really greasy (for people who haven\'t...",
                    "reviewer_image_url": "https://s3-media3.fl.yelpcdn.com/photo/45n97fDzM9S8lP9I4DijpA/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f1def11e4e79/ico/stars/v1/stars_5.png",
                    "review_source": "yelp",
                    "Review_user_name": "Yukie H.",
                    "review_date_string": "8 months ago"
                },
                {
                    "review_text": "I went there couple of time cz of FISH MASALA was really good one time, looks like it was accident\\n\\nI called this weekend to place order for prawn masala,...",
                    "reviewer_image_url": "https://s3-media3.fl.yelpcdn.com/photo/Qs_W_Qstkc7FZ9vW4o5Azg/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
                    "review_source": "yelp",
                    "Review_user_name": "Hardy P.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "Place was dirty and found dead cockroach on the spoons and showed to the management people. They didn\'t even apologized for that and I cancelled the order...",
                    "reviewer_image_url": "https://s3-media4.fl.yelpcdn.com/photo/WA9rXW2B-HrntaDGW88_1Q/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
                    "review_source": "yelp",
                    "Review_user_name": "Kuncham C.",
                    "review_date_string": "3 months ago"
                }
            ],
            "images": [
                {
                    "image_url": "https://s3-media3.fl.yelpcdn.com/bphoto/qEHvXBRiVypQazUfgc4Zdg/ms.jpg",
                    "image_big_url": "https://s3-media3.fl.yelpcdn.com/bphoto/qEHvXBRiVypQazUfgc4Zdg/o.jpg",
                    "uploader_profile_url": "https://s3-media3.fl.yelpcdn.com/photo/45n97fDzM9S8lP9I4DijpA/ms.jpg",
                    "image_source": "Yelp",
                    "user_name": "Tandoori-n-Curry",
                    "date_string": ""
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp.png",
                    "site1_review_count": "132",
                    "site1_rating": "3.5",
                    "site1_rating_image": "https://s3-media1.fl.yelpcdn.com/assets/2/www/img/5ef3eb3cb162/ico/stars/v1/stars_3_half.png"
                },
                "accumulative": "5"
            },
            "review_summary_new": [
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp@3x.png",
                    "site_review_count": "132",
                    "site_rating": "3.5",
                    "site_source": "Yelp",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp-3.5-stars@3x.png"
                }
            ],
            "claimed_merchant": {}
        },
        {
            "global_merchant_id": "3673",
            "name": "Chutney",
            "yelp_id": "chutney-fremont",
            "url": null,
            "is_claimed": "1",
            "rating": "3.0",
            "review_count": 322,
            "snippet_image_url": "https://s3-media1.fl.yelpcdn.com/photo/3NrazfA4W3Z6OR-RGZF9dA/ms.jpg",
            "snippet_text": "Excellent  foods fresh and healthy \\nComplimentary tea and salad\\nReal tastes  of Indian mughlai khan a chicken korma.goat Karahi and sp.naan is really...",
            "image_url": "https://s3-media2.fl.yelpcdn.com/bphoto/i3zKg1HogYWvnPpYtEh_jg/ms.jpg",
            "image_big_url": "https://s3-media2.fl.yelpcdn.com/bphoto/i3zKg1HogYWvnPpYtEh_jg/o.jpg",
            "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars.png",
            "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@2x.png",
            "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@3x.png",
            "categories": [
                "Pakistani",
                "Indian"
            ],
            "display_phone": "+1-510-796-6666",
            "is_closed": "0",
            "city": "Fremont",
            "display_address1": "3352 Mowry Ave",
            "display_address2": "Fremont, CA 94538",
            "display_address3": null,
            "postal_code": "94538",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": {
                "monday": [
                    [
                        "11:00",
                        "23:00"
                    ]
                ],
                "tuesday": [
                    [
                        "11:00",
                        "23:00"
                    ]
                ],
                "wednesday": [
                    [
                        "11:00",
                        "23:00"
                    ]
                ],
                "thursday": [
                    [
                        "11:00",
                        "23:00"
                    ]
                ],
                "friday": [
                    [
                        "11:00",
                        "23:00"
                    ]
                ],
                "saturday": [
                    [
                        "11:00",
                        "23:00"
                    ]
                ],
                "sunday": [
                    [
                        "11:00",
                        "23:00"
                    ]
                ]
            },
            "hours_display": "Open Daily 11:00 AM-11:00 PM",
            "additional_info": [
                {
                    "value": "1",
                    "item_id": "7",
                    "item_name": "accessible_wheelchair",
                    "display_name": "Wheel Chair Access",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "10",
                    "item_name": "payment_cashonly",
                    "display_name": "Cash Payment Only ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "18",
                    "item_name": "meal_dinner",
                    "display_name": "Dinner",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "20",
                    "item_name": "meal_deliver",
                    "display_name": "Delivery Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "21",
                    "item_name": "meal_takeout",
                    "display_name": "Takeout",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "32",
                    "item_name": "options_vegetarian",
                    "display_name": "Vegetarian",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "37",
                    "item_name": "options_healthy",
                    "display_name": "Healthy ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "84",
                    "item_name": "open_24hrs",
                    "display_name": "Open 24 Hours",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs_selected@3x.png"
                },
                {
                    "value": "casual",
                    "item_id": "1",
                    "item_name": "attire",
                    "display_name": "Attire",
                    "item_format": "String",
                    "icon_url": "",
                    "icon_selected_url": ""
                }
            ],
            "latitude": "37.55238",
            "longitude": "-121.98488",
            "dollar_range": "1",
            "merchant_id": null,
            "created_date": "2015-09-18 07:50:11",
            "last_updated_date": "2015-09-18 07:50:11",
            "is_online_store": "0",
            "dollar_range_symbol": "$",
            "todays_hours": "11:00 to 23:00",
            "now_open": 1,
            "review": [
                {
                    "review_text": "Food quality is average. Don\'t try their kababs or tandoor items. Mostly they overcook it or even burn it.\\n\\nOnly plus here is they are open late.",
                    "reviewer_image_url": "https://s3-media2.fl.yelpcdn.com/photo/rXNSGpZz9NSU1CfS8P5pAA/ms.jpg",
                    "rating_image": "http://s3-media2.fl.yelpcdn.com/assets/2/www/img/b561c24f8341/ico/stars/v1/stars_2.png",
                    "review_source": "yelp",
                    "Review_user_name": "Senthil A.",
                    "review_date_string": "6 months ago"
                },
                {
                    "review_text": "Eh I have experienced much better. The customer service is okay, not at its best. \\n\\nThe Chicken Tikka Masala - tastes more like butter chicken - and isn\'t...",
                    "reviewer_image_url": "https://s3-media3.fl.yelpcdn.com/photo/G6Kk3LGCdoioIahju54mUw/ms.jpg",
                    "rating_image": "http://s3-media2.fl.yelpcdn.com/assets/2/www/img/b561c24f8341/ico/stars/v1/stars_2.png",
                    "review_source": "yelp",
                    "Review_user_name": "Wade Y.",
                    "review_date_string": "5 months ago"
                },
                {
                    "review_text": "Excellent  foods fresh and healthy \\nComplimentary tea and salad\\nReal tastes  of Indian mughlai khan a chicken korma.goat Karahi and sp.naan is really...",
                    "reviewer_image_url": "https://s3-media1.fl.yelpcdn.com/photo/3NrazfA4W3Z6OR-RGZF9dA/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f1def11e4e79/ico/stars/v1/stars_5.png",
                    "review_source": "yelp",
                    "Review_user_name": "Fareed S.",
                    "review_date_string": "4 months ago"
                }
            ],
            "images": [
                {
                    "image_url": "https://s3-media2.fl.yelpcdn.com/bphoto/i3zKg1HogYWvnPpYtEh_jg/ms.jpg",
                    "image_big_url": "https://s3-media2.fl.yelpcdn.com/bphoto/i3zKg1HogYWvnPpYtEh_jg/o.jpg",
                    "uploader_profile_url": "https://s3-media1.fl.yelpcdn.com/photo/3NrazfA4W3Z6OR-RGZF9dA/ms.jpg",
                    "image_source": "Yelp",
                    "user_name": "Chutney",
                    "date_string": ""
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp.png",
                    "site1_review_count": "322",
                    "site1_rating": "3.0",
                    "site1_rating_image": "https://s3-media3.fl.yelpcdn.com/assets/2/www/img/34bc8086841c/ico/stars/v1/stars_3.png"
                },
                "accumulative": "5"
            },
            "review_summary_new": [
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp@3x.png",
                    "site_review_count": "322",
                    "site_rating": "3",
                    "site_source": "Yelp",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp-3.0-stars@3x.png"
                }
            ],
            "claimed_merchant": {}
        },
        {
            "global_merchant_id": "1815",
            "name": "Chaat Bhavan",
            "yelp_id": "chaat-bhavan-fremont",
            "url": null,
            "is_claimed": "1",
            "rating": "3.6",
            "review_count": 740,
            "snippet_image_url": "https://s3-media2.fl.yelpcdn.com/photo/eB83aqqS8_qLaO3AZNoebg/ms.jpg",
            "snippet_text": "Tasty food. Good service. Great value for money. \\n\\nTHE best place in the bay for Indian chat !!",
            "image_url": "https://s3-media1.fl.yelpcdn.com/bphoto/VjMTSNm4mxCVxgz7VQdINQ/ms.jpg",
            "image_big_url": "https://s3-media1.fl.yelpcdn.com/bphoto/VjMTSNm4mxCVxgz7VQdINQ/o.jpg",
            "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.5-stars.png",
            "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.5-stars@2x.png",
            "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.5-stars@3x.png",
            "categories": [
                "Indian",
                "Vegetarian"
            ],
            "display_phone": "+1-510-795-1100",
            "is_closed": "0",
            "city": "Fremont",
            "display_address1": "5355 Mowry Ave",
            "display_address2": "Fremont, CA 94538",
            "display_address3": null,
            "postal_code": "94538",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": {
                "monday": [
                    [
                        "11:30",
                        "22:00"
                    ]
                ],
                "tuesday": [
                    [
                        "11:30",
                        "22:00"
                    ]
                ],
                "wednesday": [
                    [
                        "11:30",
                        "22:00"
                    ]
                ],
                "thursday": [
                    [
                        "11:30",
                        "22:00"
                    ]
                ],
                "friday": [
                    [
                        "11:30",
                        "22:00"
                    ]
                ],
                "saturday": [
                    [
                        "11:30",
                        "22:00"
                    ]
                ],
                "sunday": [
                    [
                        "11:30",
                        "22:00"
                    ]
                ]
            },
            "hours_display": "Open Daily 11:30 AM-10:00 PM",
            "additional_info": [
                {
                    "value": "1",
                    "item_id": "4",
                    "item_name": "kids_goodfor",
                    "display_name": "Good For Kids",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "6",
                    "item_name": "groups_goodfor",
                    "display_name": "Good for Groups",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/groups_goodfor@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/groups_goodfor_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "8",
                    "item_name": "seating_outdoor",
                    "display_name": "Outdoor Seating",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/seating_outdoor@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/seating_outdoor_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "10",
                    "item_name": "payment_cashonly",
                    "display_name": "Cash Payment Only ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "11",
                    "item_name": "reservations",
                    "display_name": "Accept Reservations",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "13",
                    "item_name": "alcohol_bar",
                    "display_name": "Full Bar",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "14",
                    "item_name": "alcohol_beer_wine",
                    "display_name": "Beer and Wine only",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "15",
                    "item_name": "alcohol_byob",
                    "display_name": "Bring Your Own Bottle",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_byob@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_byob_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "17",
                    "item_name": "meal_lunch",
                    "display_name": "Lunch",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "18",
                    "item_name": "meal_dinner",
                    "display_name": "Dinner",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "20",
                    "item_name": "meal_deliver",
                    "display_name": "Delivery Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "21",
                    "item_name": "meal_takeout",
                    "display_name": "Takeout",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "22",
                    "item_name": "meal_cater",
                    "display_name": "Catering Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "26",
                    "item_name": "parking_street",
                    "display_name": "Street",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_street@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_street_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "27",
                    "item_name": "parking_lot",
                    "display_name": "Private Lot",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_lot@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_lot_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "30",
                    "item_name": "wifi",
                    "display_name": "Wifi Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/wifi@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/wifi_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "32",
                    "item_name": "options_vegetarian",
                    "display_name": "Vegetarian",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "33",
                    "item_name": "options_vegan",
                    "display_name": "Vegan",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegan@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegan_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "37",
                    "item_name": "options_healthy",
                    "display_name": "Healthy ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "84",
                    "item_name": "open_24hrs",
                    "display_name": "Open 24 Hours",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs_selected@3x.png"
                },
                {
                    "value": "casual",
                    "item_id": "1",
                    "item_name": "attire",
                    "display_name": "Attire",
                    "item_format": "String",
                    "icon_url": "",
                    "icon_selected_url": ""
                }
            ],
            "latitude": "37.532644",
            "longitude": "-122.001878",
            "dollar_range": "1",
            "merchant_id": null,
            "created_date": "2015-09-09 12:37:19",
            "last_updated_date": "2015-09-09 12:37:19",
            "is_online_store": "0",
            "dollar_range_symbol": "$",
            "todays_hours": "11:30 to 22:00",
            "now_open": 1,
            "review": [
                {
                    "review_text": "I\'m not too impressed with this place. I went here last night for dinner, ordering for take out. The restaurant was half empty and it took almost 30 minutes to prepare my Matar Paneer. The food itself was just bland and felt too watery. I\'ve had a much better one at another place, and they cost less as well. I don\'t think I\'ll be coming back anytime soon.",
                    "reviewer_image_url": "https://lh4.googleusercontent.com/-23b79s3RYu0/AAAAAAAAAAI/AAAAAAABvKE/Hp1M0EY9hNY/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Ivan Yudhi",
                    "review_date_string": "7 months ago"
                },
                {
                    "review_text": "The food is so good!\\n\\nService is nice, a little slow, granted it was packed when we went, although the food came out rather fast. \\n\\nWe had:\\n- Dahi Bateta...",
                    "reviewer_image_url": "https://s3-media2.fl.yelpcdn.com/photo/uYJrXNmBg2ZgyeI3qGA11w/ms.jpg",
                    "rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
                    "review_source": "yelp",
                    "Review_user_name": "Sai K.",
                    "review_date_string": "4 months ago"
                },
                {
                    "review_text": "Food is okay. Nothing special. Parking is a little tricky, depending on the time you visit.\\nWe ordered Thali and we did not get the Chai that comes along...",
                    "reviewer_image_url": "https://s3-media1.fl.yelpcdn.com/photo/uNRZiyb1v4v8WOr_RSgkMQ/ms.jpg",
                    "rating_image": "http://s3-media3.fl.yelpcdn.com/assets/2/www/img/34bc8086841c/ico/stars/v1/stars_3.png",
                    "review_source": "yelp",
                    "Review_user_name": "Ranganathan S.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "Pathetic service and bad food! No one came to take our order for 20 minutes, water wasn\'t served even when we asked for it. Ordered Gobi Manchurian($8.99),...",
                    "reviewer_image_url": "https://s3-media1.fl.yelpcdn.com/photo/4ZUBzHeIxjq0sdcFVlUKqQ/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
                    "review_source": "yelp",
                    "Review_user_name": "Reshu A.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "Very less spices,  seems fine tuned for America. \\nDahi papdi was nice. ",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-Cd4B5C-DgN4/AAAAAAAAAAI/AAAAAAAAApQ/B7uiniQriHs/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Devesh Singh",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "These guys are serving fafda without chutney. It seems like they don\'t even know concept of fafda.",
                    "reviewer_image_url": "https://lh4.googleusercontent.com/-uXo0sM_Jryc/AAAAAAAAAAI/AAAAAAAADK8/27SyN8ki73g/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Kushal Chokshi",
                    "review_date_string": "2 months ago"
                },
                {
                    "review_text": "So, the food is not bad, pretty consistent and tasty.\\n\\nThe problem is the Service.  Owners please take proper note and care!\\n   In America, pleasant and prompt service is part and parcel of the dining in experience and menu price.   You shouldn\'t have to continuously flag down your waiter, feel like you need to hurry up and get out and keep asking for basic things you need.  Nor should you have to wait around to have your water glasses filled to the point that you have to get up and get the jug yourself.  \\n\\nOne more thing, I\'m Indian but my friends who are not refuse to go to this place alone (w/o an Indian person)... Please treat all customers nicely and be friendly and polite.  This all is part of running a sit down restaurant.  \\n\\nIt\'s not acceptable to think your restaurant is in demand so you can just feel free to dispense with basic good manners and proper service.",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "RD P",
                    "review_date_string": "1 month ago"
                },
                {
                    "review_text": "Nice Indian place with good chaat options for vegetarians.",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-zIBV3cE43zY/AAAAAAAAAAI/AAAAAAAAGI8/Nz1dNPDZQIU/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Soumya Singhi",
                    "review_date_string": "26 days ago"
                },
                {
                    "review_text": "Food is just about average. You will quite often experience queues, but I don\'t think the place justifies the queues it gets :)\\nChaat Bhavan in Dublin, CA is much better.\\nGood place for quick take outs",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-CJOVK2xb35M/AAAAAAAAAAI/AAAAAAAAeXs/EaIFivRMpgo/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Amit Nair",
                    "review_date_string": "24 days ago"
                },
                {
                    "review_text": "No doubts about food, best veggie home style food around. But but this place sucks in terms of parking and wait times. Plan ahead or order to go.",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Image Thoughts Photography",
                    "review_date_string": "23 days ago"
                },
                {
                    "review_text": "Likes:\\nFood is always fresh and tastes good...\\nQuality is consistent....\\nService is usually good but at times misses ur call....\\n\\nDislikes:\\nWait times are long during peak hours...\\n\\nOverall:\\nHappy tummy(after the meal) and peaceful mind(in terms of $$$)....",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XJ10_I7YNso/AAAAAAAAAAI/AAAAAAAATBI/RksZzpKZQas/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Radha Madhavi",
                    "review_date_string": "16 days ago"
                },
                {
                    "review_text": "Great vegetarian Indian food. Just ask the server for help deciding if you are unfamiliar with this style of food. I really like the freshness and quality of each of the dishes.",
                    "reviewer_image_url": "https://lh5.googleusercontent.com/-w1S0stH4wHU/AAAAAAAAAAI/AAAAAAAAPZQ/AgphVMvZF5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Eugene C",
                    "review_date_string": "15 days ago"
                }
            ],
            "images": [
                {
                    "image_url": "https://s3-media1.fl.yelpcdn.com/bphoto/VjMTSNm4mxCVxgz7VQdINQ/ms.jpg",
                    "image_big_url": "https://s3-media1.fl.yelpcdn.com/bphoto/VjMTSNm4mxCVxgz7VQdINQ/o.jpg",
                    "uploader_profile_url": "https://s3-media2.fl.yelpcdn.com/photo/eB83aqqS8_qLaO3AZNoebg/ms.jpg",
                    "image_source": "Yelp",
                    "user_name": "Chaat Bhavan",
                    "date_string": ""
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp.png",
                    "site1_review_count": "624",
                    "site1_rating": "3.5",
                    "site1_rating_image": "https://s3-media1.fl.yelpcdn.com/assets/2/www/img/5ef3eb3cb162/ico/stars/v1/stars_3_half.png"
                },
                "accumulative": "5"
            },
            "review_summary_new": [
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp@3x.png",
                    "site_review_count": "624",
                    "site_rating": "3.5",
                    "site_source": "Yelp",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp-3.5-stars@3x.png"
                },
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/googlePlaces@3x.png",
                    "site_review_count": "116",
                    "site_rating": "4",
                    "site_source": "Google",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/google-4.0-stars@3x.png"
                }
            ],
            "claimed_merchant": {}
        },
        {
            "global_merchant_id": "6556",
            "name": "Peacock Indian Cuisine",
            "yelp_id": "peacock-indian-cuisine-fremont-3",
            "url": null,
            "is_claimed": "1",
            "rating": "2.5",
            "review_count": 68,
            "snippet_image_url": "https://s3-media4.fl.yelpcdn.com/photo/TtcUhHkO3YihEO8oWubrTQ/ms.jpg",
            "snippet_text": "This is a review of the Sunday buffet offered from 1130-300. The tandoori chicken is full of flavor and is offered in smaller cuts. The naan is thin and not...",
            "image_url": "https://s3-media4.fl.yelpcdn.com/bphoto/2sqTXxbxAR6qhMUVU80V-A/ms.jpg",
            "image_big_url": "http://s3-media4.fl.yelpcdn.com/bphoto/2sqTXxbxAR6qhMUVU80V-A/o.jpg",
            "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-2.0-stars.png",
            "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-2.0-stars@2x.png",
            "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-2.0-stars@3x.png",
            "categories": [
                "Indian",
                "Specialty Food"
            ],
            "display_phone": "+1-510-745-1000",
            "is_closed": "0",
            "city": "Fremont",
            "display_address1": "Ardenwood Plaza Shopping Center",
            "display_address2": "4918 Paseo Padre Pkwy",
            "display_address3": "Fremont, CA 94555",
            "postal_code": "94555",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": {
                "monday": [
                    [
                        "11:30",
                        "15:00"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "tuesday": [
                    [
                        "11:30",
                        "15:00"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "wednesday": [
                    [
                        "11:30",
                        "15:00"
                    ]
                ],
                "thursday": [
                    [
                        "11:30",
                        "15:00"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "friday": [
                    [
                        "11:30",
                        "15:00"
                    ]
                ],
                "saturday": [
                    [
                        "11:30",
                        "15:00"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "sunday": [
                    [
                        "11:30",
                        "15:00"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ]
            },
            "hours_display": "Mon-Tue 11:30 AM-3:00 PM, 5:30 PM-10:00 PM; Wed 11:30 AM-3:00 PM; Thu 11:30 AM-3:00 PM, 5:30 PM-10:00 PM; Fri 11:30 AM-3:00 PM; Sat-Sun 11:30 AM-3:00 PM, 5:30 PM-10:00 PM",
            "additional_info": [
                {
                    "value": "1",
                    "item_id": "7",
                    "item_name": "accessible_wheelchair",
                    "display_name": "Wheel Chair Access",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "11",
                    "item_name": "reservations",
                    "display_name": "Accept Reservations",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "84",
                    "item_name": "open_24hrs",
                    "display_name": "Open 24 Hours",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs_selected@3x.png"
                },
                {
                    "value": "casual",
                    "item_id": "1",
                    "item_name": "attire",
                    "display_name": "Attire",
                    "item_format": "String",
                    "icon_url": "",
                    "icon_selected_url": ""
                }
            ],
            "latitude": "37.56718",
            "longitude": "-122.05261",
            "dollar_range": "",
            "merchant_id": null,
            "created_date": "2015-11-19 10:21:16",
            "last_updated_date": null,
            "is_online_store": "0",
            "dollar_range_symbol": "",
            "todays_hours": "11:30 to 15:00",
            "now_open": 1,
            "review": [
                {
                    "review_text": "Spicy Andhra food.yummy",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-qP6XypPF-Eo/AAAAAAAAAAI/AAAAAAAAJks/HXSSLK32D2g/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Sumithra Bash",
                    "review_date_string": "3 years ago"
                },
                {
                    "review_text": "delicious food.",
                    "reviewer_image_url": "https://lh6.googleusercontent.com/-BSuFOe7b2_4/AAAAAAAAAAI/AAAAAAAAAcE/GSazQedWKSM/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Dinesh Maheshwari",
                    "review_date_string": "9 months ago"
                },
                {
                    "review_text": "This is a review of the Sunday buffet offered from 1130-300. The tandoori chicken is full of flavor and is offered in smaller cuts. The naan is thin and not...",
                    "reviewer_image_url": "https://s3-media4.fl.yelpcdn.com/photo/TtcUhHkO3YihEO8oWubrTQ/ms.jpg",
                    "rating_image": "https://s3-media1.fl.yelpcdn.com/assets/2/www/img/f1def11e4e79/ico/stars/v1/stars_5.png",
                    "review_source": "yelp",
                    "Review_user_name": "Vincent G.",
                    "review_date_string": "6 months ago"
                },
                {
                    "review_text": "Very poor service. Dont host any parties here. Spend s few more dollars somewhere there is better service. We hosted our son\'s first birthday there and were...",
                    "reviewer_image_url": "https://s3-media1.fl.yelpcdn.com/photo/R9J18vXBaU227A9a81Gnig/ms.jpg",
                    "rating_image": "https://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
                    "review_source": "yelp",
                    "Review_user_name": "Jaspreet K.",
                    "review_date_string": "6 months ago"
                },
                {
                    "review_text": "One of the peacock restaurants that has the worst food to offer with the portion size of a kid. \\nI have been to 5 of the peacock restaurants but this one is...",
                    "reviewer_image_url": "https://s3-media2.fl.yelpcdn.com/photo/SnQS5iux1zYPS2WuqyliTQ/ms.jpg",
                    "rating_image": "https://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
                    "review_source": "yelp",
                    "Review_user_name": "Javish K.",
                    "review_date_string": "5 months ago"
                },
                {
                    "review_text": "Biryani is amazing at this place. However service is not up to the mark. Several times I placed to go order over phone. They typically say 20 min to pick up. Once them made me wait more than 1 hour. Even after inquiring several times. The guy at the counter blamed his kitchen staff but never once said he was sorry.\\n\\nThey have website to order food on-line. Its buggy and broken most of the time. I placed order for pick-up in Ardenwood. The order was placed in their El-camino location.\\n\\nThis place was owned Swagat before and the service then was much better.",
                    "reviewer_image_url": "https://lh4.googleusercontent.com/-jYWIEQ8eeo4/AAAAAAAAAAI/AAAAAAAAGcA/G1rA96zthb0/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Shashidhar Gandham",
                    "review_date_string": "4 months ago"
                }
            ],
            "images": [
                {
                    "image_url": "https://s3-media4.fl.yelpcdn.com/bphoto/2sqTXxbxAR6qhMUVU80V-A/ms.jpg",
                    "image_big_url": "http://s3-media4.fl.yelpcdn.com/bphoto/2sqTXxbxAR6qhMUVU80V-A/o.jpg",
                    "uploader_profile_url": "https://s3-media4.fl.yelpcdn.com/photo/TtcUhHkO3YihEO8oWubrTQ/ms.jpg",
                    "image_source": "Yelp",
                    "user_name": "Peacock Indian Cuisine",
                    "date_string": ""
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp.png",
                    "site1_review_count": "68",
                    "site1_rating": "2.5",
                    "site1_rating_image": "https://s3-media4.fl.yelpcdn.com/assets/2/www/img/c7fb9aff59f9/ico/stars/v1/stars_2_half.png"
                },
                "accumulative": "5"
            },
            "review_summary_new": [
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp@3x.png",
                    "site_review_count": "68",
                    "site_rating": "2.5",
                    "site_source": "Yelp",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp-2.5-stars@3x.png"
                }
            ],
            "claimed_merchant": {}
        },
        {
            "global_merchant_id": "1817",
            "name": "Taj-e Chaat",
            "yelp_id": "taj-e-chaat-fremont",
            "url": null,
            "is_claimed": "1",
            "rating": "4.0",
            "review_count": 132,
            "snippet_image_url": "https://s3-media4.fl.yelpcdn.com/photo/WSiE2HQmCNjK8XxHV_UosA/ms.jpg",
            "snippet_text": "One of the best place where we get good Indian food in Fremont. Worth the price ! Mango Lassi is so tasteful.\\n\\nBoth Non veg and veg starters are so...",
            "image_url": "https://s3-media2.fl.yelpcdn.com/bphoto/P6dcVsgCI-e2KsUqNqgkJQ/ms.jpg",
            "image_big_url": "https://s3-media2.fl.yelpcdn.com/bphoto/P6dcVsgCI-e2KsUqNqgkJQ/o.jpg",
            "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-4.0-stars.png",
            "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-4.0-stars@2x.png",
            "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-4.0-stars@3x.png",
            "categories": [
                "Indian",
                "Vegetarian"
            ],
            "display_phone": "+1-510-226-8081",
            "is_closed": "0",
            "city": "Fremont",
            "display_address1": "39497 Fremont Blvd",
            "display_address2": "Fremont, CA 94538",
            "display_address3": null,
            "postal_code": "94538",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": {
                "monday": [
                    [
                        "10:00",
                        "21:00"
                    ]
                ],
                "tuesday": [
                    [
                        "10:00",
                        "21:00"
                    ]
                ],
                "wednesday": [
                    [
                        "10:00",
                        "21:00"
                    ]
                ],
                "thursday": [
                    [
                        "10:00",
                        "21:00"
                    ]
                ],
                "friday": [
                    [
                        "10:00",
                        "21:00"
                    ]
                ],
                "saturday": [
                    [
                        "11:00",
                        "21:00"
                    ]
                ],
                "sunday": [
                    [
                        "11:00",
                        "21:00"
                    ]
                ]
            },
            "hours_display": "Mon-Fri 10:00 AM-9:00 PM; Sat-Sun 11:00 AM-9:00 PM",
            "additional_info": [
                {
                    "value": "0",
                    "item_id": "10",
                    "item_name": "payment_cashonly",
                    "display_name": "Cash Payment Only ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "11",
                    "item_name": "reservations",
                    "display_name": "Accept Reservations",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "32",
                    "item_name": "options_vegetarian",
                    "display_name": "Vegetarian",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "37",
                    "item_name": "options_healthy",
                    "display_name": "Healthy ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "84",
                    "item_name": "open_24hrs",
                    "display_name": "Open 24 Hours",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs_selected@3x.png"
                },
                {
                    "value": "casual",
                    "item_id": "1",
                    "item_name": "attire",
                    "display_name": "Attire",
                    "item_format": "String",
                    "icon_url": "",
                    "icon_selected_url": ""
                }
            ],
            "latitude": "37.544693425298",
            "longitude": "-121.98097452521",
            "dollar_range": "1",
            "merchant_id": null,
            "created_date": "2015-09-09 12:37:19",
            "last_updated_date": "2015-09-09 12:37:19",
            "is_online_store": "0",
            "dollar_range_symbol": "$",
            "todays_hours": "10:00 to 21:00",
            "now_open": 1,
            "review": [
                {
                    "review_text": "Ordered Choley Bhature and Paneer Tikka Kabob Plate.\\n\\nThe food was nice, the service was reasonably ok. I agree the ambience of the restaurant could be...",
                    "reviewer_image_url": "https://s3-media4.fl.yelpcdn.com/photo/52FWYNDhBK_YIReqc9Sa9A/ms.jpg",
                    "rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
                    "review_source": "yelp",
                    "Review_user_name": "Mitesh S.",
                    "review_date_string": "4 months ago"
                },
                {
                    "review_text": "We stopped by at Taj-e-Chaat pretty late at around 9:45 pm or so, on our way back from a long trip. It was a blessing that this place was open so late at...",
                    "reviewer_image_url": "https://s3-media4.fl.yelpcdn.com/photo/b6_5rVds3LMcmqig0y-a5w/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f1def11e4e79/ico/stars/v1/stars_5.png",
                    "review_source": "yelp",
                    "Review_user_name": "HK M.",
                    "review_date_string": "4 months ago"
                },
                {
                    "review_text": "My fellow Indian food fanatic friends who live in Fremont took me to Taj-e Chaat for my birthday to pick up take out. The restaurant is located in a...",
                    "reviewer_image_url": "https://s3-media3.fl.yelpcdn.com/photo/SqaTieahxiExOty3HLRhhg/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f1def11e4e79/ico/stars/v1/stars_5.png",
                    "review_source": "yelp",
                    "Review_user_name": "Julie H.",
                    "review_date_string": "3 months ago"
                }
            ],
            "images": [
                {
                    "image_url": "https://s3-media2.fl.yelpcdn.com/bphoto/P6dcVsgCI-e2KsUqNqgkJQ/ms.jpg",
                    "image_big_url": "https://s3-media2.fl.yelpcdn.com/bphoto/P6dcVsgCI-e2KsUqNqgkJQ/o.jpg",
                    "uploader_profile_url": "https://s3-media4.fl.yelpcdn.com/photo/WSiE2HQmCNjK8XxHV_UosA/ms.jpg",
                    "image_source": "Yelp",
                    "user_name": "Taj-e Chaat",
                    "date_string": ""
                },
                {
                    "image_url": "https://s3-us-west-1.amazonaws.com/bug.images/a467b366548ec92589836a34de90783d.png",
                    "image_big_url": "https://s3-us-west-1.amazonaws.com/bug.images/bf6705b550333974fdbd2b3c931cc197.png",
                    "uploader_profile_url": "https://scontent.xx.fbcdn.net/hprofile-xaf1/v/t1.0-1/p200x200/391683_10150976524620029_1125910000_n.jpg?oh=1972e23075e13e7dfa3992f56a365d89&oe=56E52C23",
                    "image_source": "Privpass",
                    "user_name": "Pavan C",
                    "date_string": "12 days ago"
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp.png",
                    "site1_review_count": "132",
                    "site1_rating": "4.0",
                    "site1_rating_image": "https://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png"
                },
                "accumulative": "5"
            },
            "review_summary_new": [
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp@3x.png",
                    "site_review_count": "132",
                    "site_rating": "4",
                    "site_source": "Yelp",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp-4.0-stars@3x.png"
                }
            ],
            "claimed_merchant": {}
        },
        {
            "global_merchant_id": "2265",
            "name": "Chaat Cafe",
            "yelp_id": "chaat-cafe-fremont",
            "url": null,
            "is_claimed": "1",
            "rating": "3.5",
            "review_count": 415,
            "snippet_image_url": "https://s3-media4.fl.yelpcdn.com/photo/FInV10Bu7Dc1JLZXZ4EJ5g/ms.jpg",
            "snippet_text": "First time trying an entire Indian meal. Previous experience Samosa. Vegetable samosa.\\n\\nLate night in Fremont. Very hungry and eager to try new cafe food in...",
            "image_url": "https://s3-media1.fl.yelpcdn.com/bphoto/N5kJcXHsqPGJ7RbX04viaQ/ms.jpg",
            "image_big_url": "https://s3-media1.fl.yelpcdn.com/bphoto/N5kJcXHsqPGJ7RbX04viaQ/o.jpg",
            "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars.png",
            "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@2x.png",
            "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@3x.png",
            "categories": [
                "Indian",
                "Halal"
            ],
            "display_phone": "+1-510-796-3408",
            "is_closed": "0",
            "city": "Fremont",
            "display_address1": "3954 Mowry Ave",
            "display_address2": "Fremont, CA 94538",
            "display_address3": null,
            "postal_code": "94538",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": {
                "monday": [
                    [
                        "11:30",
                        "22:00"
                    ]
                ],
                "tuesday": [
                    [
                        "11:30",
                        "22:00"
                    ]
                ],
                "wednesday": [
                    [
                        "11:30",
                        "22:00"
                    ]
                ],
                "thursday": [
                    [
                        "11:30",
                        "22:00"
                    ]
                ],
                "friday": [
                    [
                        "11:30",
                        "22:00"
                    ]
                ],
                "saturday": [
                    [
                        "11:30",
                        "22:00"
                    ]
                ],
                "sunday": [
                    [
                        "11:30",
                        "22:00"
                    ]
                ]
            },
            "hours_display": "Open Daily 11:30 AM-10:00 PM",
            "additional_info": [
                {
                    "value": "1",
                    "item_id": "4",
                    "item_name": "kids_goodfor",
                    "display_name": "Good For Kids",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "6",
                    "item_name": "groups_goodfor",
                    "display_name": "Good for Groups",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/groups_goodfor@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/groups_goodfor_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "7",
                    "item_name": "accessible_wheelchair",
                    "display_name": "Wheel Chair Access",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "8",
                    "item_name": "seating_outdoor",
                    "display_name": "Outdoor Seating",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/seating_outdoor@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/seating_outdoor_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "10",
                    "item_name": "payment_cashonly",
                    "display_name": "Cash Payment Only ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "11",
                    "item_name": "reservations",
                    "display_name": "Accept Reservations",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "13",
                    "item_name": "alcohol_bar",
                    "display_name": "Full Bar",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "14",
                    "item_name": "alcohol_beer_wine",
                    "display_name": "Beer and Wine only",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "16",
                    "item_name": "meal_breakfast",
                    "display_name": "Breakfast",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_breakfast@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_breakfast_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "17",
                    "item_name": "meal_lunch",
                    "display_name": "Lunch",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "18",
                    "item_name": "meal_dinner",
                    "display_name": "Dinner",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "20",
                    "item_name": "meal_deliver",
                    "display_name": "Delivery Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "21",
                    "item_name": "meal_takeout",
                    "display_name": "Takeout",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "22",
                    "item_name": "meal_cater",
                    "display_name": "Catering Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "27",
                    "item_name": "parking_lot",
                    "display_name": "Private Lot",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_lot@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_lot_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "30",
                    "item_name": "wifi",
                    "display_name": "Wifi Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/wifi@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/wifi_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "31",
                    "item_name": "smoking",
                    "display_name": "Smoking Allowed",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/smoking@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/smoking_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "32",
                    "item_name": "options_vegetarian",
                    "display_name": "Vegetarian",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "37",
                    "item_name": "options_healthy",
                    "display_name": "Healthy ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "84",
                    "item_name": "open_24hrs",
                    "display_name": "Open 24 Hours",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs_selected@3x.png"
                },
                {
                    "value": "casual",
                    "item_id": "1",
                    "item_name": "attire",
                    "display_name": "Attire",
                    "item_format": "String",
                    "icon_url": "",
                    "icon_selected_url": ""
                }
            ],
            "latitude": "37.548717383999",
            "longitude": "-121.98706702591",
            "dollar_range": "1",
            "merchant_id": null,
            "created_date": "2015-09-09 12:37:19",
            "last_updated_date": "2015-09-09 12:37:19",
            "is_online_store": "0",
            "dollar_range_symbol": "$",
            "todays_hours": "11:30 to 22:00",
            "now_open": 1,
            "review": [
                {
                    "review_text": "Great food and great service. Even when they are swamped with grumpy hungry customers everyone here is pleasant and professional. ",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Todd Stuart",
                    "review_date_string": "8 months ago"
                },
                {
                    "review_text": "Great food and better service. Lady at the counter is always friendly! ",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-9mJ-g6QYz8I/AAAAAAAAAAI/AAAAAAAAABA/gU46Y5tF39Q/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Mandeep Sidhu",
                    "review_date_string": "8 months ago"
                },
                {
                    "review_text": "Yuk. Yuk. \\n1. Un hygiene place. Simple.\\n2. Server look like they never took bath for couple to days.\\n3. Being vegetarian, I would want my food not to be...",
                    "reviewer_image_url": "https://s3-media1.fl.yelpcdn.com/photo/9hU_W_X2y264kT_tCu3AEw/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
                    "review_source": "yelp",
                    "Review_user_name": "anurag s.",
                    "review_date_string": "4 months ago"
                },
                {
                    "review_text": "I was travelling in Fremont from Vancouver and my relatives took me to this place I was amazed with the paneer wraps very delicious. I have never tasted anything like that back home in Surrey BC where we have countless Indian Restaurants. Do try them for sure.",
                    "reviewer_image_url": "https://lh5.googleusercontent.com/-1vKNU5SlV4o/AAAAAAAAAAI/AAAAAAAAABo/KfXKJqDBtz4/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Sarabpreet Singh",
                    "review_date_string": "4 months ago"
                },
                {
                    "review_text": "I loved the biryani. The chicken was cooked to perfection and seasoned well. The proportions were enough to take home and eat the next day. My boyfriend at...",
                    "reviewer_image_url": "https://s3-media3.fl.yelpcdn.com/photo/1loY0Ot_pZC-4qbTeWDvIw/ms.jpg",
                    "rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
                    "review_source": "yelp",
                    "Review_user_name": "Monique W.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "Authentic Indian Cuisine in a casual atmosphere! \\nI really like this place, the cashiers/servers are all very friendly, well at least all of the girls...",
                    "reviewer_image_url": "https://s3-media1.fl.yelpcdn.com/photo/bQQOSpOxuulX1GyBilteOA/ms.jpg",
                    "rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
                    "review_source": "yelp",
                    "Review_user_name": "Dave F.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "The rates displayed online are faulty. It\'s more expensive inside.",
                    "reviewer_image_url": "https://lh5.googleusercontent.com/-rsblHI54otA/AAAAAAAAAAI/AAAAAAAABM4/8ef7aAGpReo/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Harsh vora",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "The food is good, not too pricey. FYI the # listed here is the # to the Berkeley location, not Fremont. ",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Vivian Dinis",
                    "review_date_string": "1 month ago"
                }
            ],
            "images": [
                {
                    "image_url": "https://s3-media1.fl.yelpcdn.com/bphoto/N5kJcXHsqPGJ7RbX04viaQ/ms.jpg",
                    "image_big_url": "https://s3-media1.fl.yelpcdn.com/bphoto/N5kJcXHsqPGJ7RbX04viaQ/o.jpg",
                    "uploader_profile_url": "https://s3-media4.fl.yelpcdn.com/photo/FInV10Bu7Dc1JLZXZ4EJ5g/ms.jpg",
                    "image_source": "Yelp",
                    "user_name": "Chaat Cafe",
                    "date_string": ""
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp.png",
                    "site1_review_count": "364",
                    "site1_rating": "3.5",
                    "site1_rating_image": "https://s3-media1.fl.yelpcdn.com/assets/2/www/img/5ef3eb3cb162/ico/stars/v1/stars_3_half.png"
                },
                "accumulative": "5"
            },
            "review_summary_new": [
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp@3x.png",
                    "site_review_count": "364",
                    "site_rating": "3.5",
                    "site_source": "Yelp",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp-3.5-stars@3x.png"
                },
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/googlePlaces@3x.png",
                    "site_review_count": "51",
                    "site_rating": "3.5",
                    "site_source": "Google",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/google-3.5-stars@3x.png"
                }
            ],
            "claimed_merchant": {}
        },
        {
            "global_merchant_id": "1829",
            "name": "Bismillah Restaurant",
            "yelp_id": "bismillah-restaurant-fremont",
            "url": null,
            "is_claimed": "1",
            "rating": "3.6",
            "review_count": 124,
            "snippet_image_url": "https://s3-media2.fl.yelpcdn.com/photo/ymgCdajr-SL-koD0-Eyjew/ms.jpg",
            "snippet_text": "Sooo good !!! Soo fresh !!! The food is literally just off the tandoor fresh !\\n\\nHad the chicken breast n leg tandoori & chicken seekh .\\n\\nThe Nihari- beef...",
            "image_url": "https://s3-media1.fl.yelpcdn.com/bphoto/1rXEALo4F2kQpDx4mpvPPA/ms.jpg",
            "image_big_url": "https://s3-media1.fl.yelpcdn.com/bphoto/1rXEALo4F2kQpDx4mpvPPA/o.jpg",
            "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.5-stars.png",
            "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.5-stars@2x.png",
            "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.5-stars@3x.png",
            "categories": [
                "Indian",
                "Pakistani"
            ],
            "display_phone": "+1-510-713-1907",
            "is_closed": "0",
            "city": "Fremont",
            "display_address1": "37415 Fremont Blvd",
            "display_address2": "Fremont, CA 94536",
            "display_address3": null,
            "postal_code": "94536",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": {
                "monday": [
                    [
                        "11:30",
                        "22:30"
                    ]
                ],
                "tuesday": [
                    [
                        "11:30",
                        "22:30"
                    ]
                ],
                "wednesday": [
                    [
                        "11:30",
                        "22:30"
                    ]
                ],
                "thursday": [
                    [
                        "11:30",
                        "23:00"
                    ]
                ],
                "friday": [
                    [
                        "11:30",
                        "23:00"
                    ]
                ],
                "saturday": [
                    [
                        "11:30",
                        "23:00"
                    ]
                ],
                "sunday": [
                    [
                        "11:30",
                        "22:30"
                    ]
                ]
            },
            "hours_display": "Mon-Wed 11:30 AM-10:30 PM; Thu-Sat 11:30 AM-11:00 PM; Sun 11:30 AM-10:30 PM",
            "additional_info": [
                {
                    "value": "1",
                    "item_id": "4",
                    "item_name": "kids_goodfor",
                    "display_name": "Good For Kids",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "7",
                    "item_name": "accessible_wheelchair",
                    "display_name": "Wheel Chair Access",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "10",
                    "item_name": "payment_cashonly",
                    "display_name": "Cash Payment Only ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "11",
                    "item_name": "reservations",
                    "display_name": "Accept Reservations",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "13",
                    "item_name": "alcohol_bar",
                    "display_name": "Full Bar",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "14",
                    "item_name": "alcohol_beer_wine",
                    "display_name": "Beer and Wine only",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "15",
                    "item_name": "alcohol_byob",
                    "display_name": "Bring Your Own Bottle",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_byob@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_byob_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "20",
                    "item_name": "meal_deliver",
                    "display_name": "Delivery Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "22",
                    "item_name": "meal_cater",
                    "display_name": "Catering Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "26",
                    "item_name": "parking_street",
                    "display_name": "Street",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_street@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_street_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "30",
                    "item_name": "wifi",
                    "display_name": "Wifi Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/wifi@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/wifi_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "32",
                    "item_name": "options_vegetarian",
                    "display_name": "Vegetarian",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "37",
                    "item_name": "options_healthy",
                    "display_name": "Healthy ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "84",
                    "item_name": "open_24hrs",
                    "display_name": "Open 24 Hours",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs_selected@3x.png"
                },
                {
                    "value": "casual",
                    "item_id": "1",
                    "item_name": "attire",
                    "display_name": "Attire",
                    "item_format": "String",
                    "icon_url": "",
                    "icon_selected_url": ""
                }
            ],
            "latitude": "37.557712197304",
            "longitude": "-122.00613029301",
            "dollar_range": "1",
            "merchant_id": null,
            "created_date": "2015-09-09 12:37:19",
            "last_updated_date": "2015-09-09 12:37:19",
            "is_online_store": "0",
            "dollar_range_symbol": "$",
            "todays_hours": "11:30 to 23:00",
            "now_open": 1,
            "review": [
                {
                    "review_text": "It has the best food i have ever put in my mouth but the place is kind of dirty or old. You should really the chicken seek kabob with regular Naan and 1 chicken tikka masala+ a deal masala",
                    "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privypass.image/placeholders/photo200.png",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "A Google User",
                    "review_date_string": "3 years ago"
                },
                {
                    "review_text": "Thanks to all my frinds ",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-vtbgZNMikNw/AAAAAAAAAAI/AAAAAAAAA3k/8KAxF9eSUA0/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Muhammad Ilyas",
                    "review_date_string": "3 years ago"
                },
                {
                    "review_text": "I have been quite a few times to this restaurant.  \\nI like the food -  especially the brain masala.\\n\\nThe ambiance is nothing to write home about.\\nBut the food is great and very resaonably priced.",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Victor Kamat",
                    "review_date_string": "2 years ago"
                },
                {
                    "review_text": "thanks to the owner : kindest man in the world! droogh!!!!!!",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Raphkat Shalar",
                    "review_date_string": "2 years ago"
                },
                {
                    "review_text": "Food is alright, but the prices are not the same as the online prices. They would not honor their mistake\\n",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Mohammed Hasan",
                    "review_date_string": "4 months ago"
                },
                {
                    "review_text": "A very disgusting and dirty restaurant! We stepped in and right out.Can\'t imagine how they cook in their kitchen!!",
                    "reviewer_image_url": "https://s3-media2.fl.yelpcdn.com/photo/zuvIcGp77_HqFIKBc4nZYw/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
                    "review_source": "yelp",
                    "Review_user_name": "Varsha P.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "Meh!\\nNot going back again. The food was just OK. The service was slow and the place was dirty.\\nFelt like I wasted my money and time.",
                    "reviewer_image_url": "https://s3-media3.fl.yelpcdn.com/photo/IquCxXhJcSZp8W2ZB_Rm2A/ms.jpg",
                    "rating_image": "http://s3-media2.fl.yelpcdn.com/assets/2/www/img/b561c24f8341/ico/stars/v1/stars_2.png",
                    "review_source": "yelp",
                    "Review_user_name": "Manish R.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "Great Take Out Place.\\nCASH Only - This is a big con in my opinion\\n\\nI\'m giving Bismillah a big thumbs up for it\'s food. Please don\'t go there expecting a...",
                    "reviewer_image_url": "https://s3-media4.fl.yelpcdn.com/assets/srv0/yelp_styleguide/cc4afe21892e/assets/img/default_avatars/user_medium_square.png",
                    "rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
                    "review_source": "yelp",
                    "Review_user_name": "Anand V.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "Great food for such a low price.\\nAll items are very tasty but best of all are Chicken Tikka Masala and Nihari.",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Atiq A",
                    "review_date_string": "16 days ago"
                },
                {
                    "review_text": "Good authentic Punjabi food. Their haleem is the best",
                    "reviewer_image_url": "https://lh4.googleusercontent.com/-Fp0Wp5c_Q-U/AAAAAAAAAAI/AAAAAAAAEAo/qdiblXJrBsk/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Adnan Y",
                    "review_date_string": "12 days ago"
                },
                {
                    "review_text": "Amazing food...one of the best desi food in bay area ",
                    "reviewer_image_url": "https://lh4.googleusercontent.com/-SSu7ZGhbPys/AAAAAAAAAAI/AAAAAAAAcx4/HqQO0Ti4wA8/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Aman Kalra",
                    "review_date_string": "7 days ago"
                }
            ],
            "images": [
                {
                    "image_url": "https://s3-media1.fl.yelpcdn.com/bphoto/1rXEALo4F2kQpDx4mpvPPA/ms.jpg",
                    "image_big_url": "https://s3-media1.fl.yelpcdn.com/bphoto/1rXEALo4F2kQpDx4mpvPPA/o.jpg",
                    "uploader_profile_url": "https://s3-media2.fl.yelpcdn.com/photo/ymgCdajr-SL-koD0-Eyjew/ms.jpg",
                    "image_source": "Yelp",
                    "user_name": "Bismillah Restaurant",
                    "date_string": ""
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp.png",
                    "site1_review_count": "110",
                    "site1_rating": "3.5",
                    "site1_rating_image": "https://s3-media1.fl.yelpcdn.com/assets/2/www/img/5ef3eb3cb162/ico/stars/v1/stars_3_half.png"
                },
                "accumulative": "5"
            },
            "review_summary_new": [
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp@3x.png",
                    "site_review_count": "110",
                    "site_rating": "3.5",
                    "site_source": "Yelp",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp-3.5-stars@3x.png"
                },
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/googlePlaces@3x.png",
                    "site_review_count": "14",
                    "site_rating": "4",
                    "site_source": "Google",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/google-4.0-stars@3x.png"
                }
            ],
            "claimed_merchant": {}
        },
        {
            "global_merchant_id": "2086",
            "name": "Saravanaa Bhavan",
            "yelp_id": "saravanaa-bhavan-fremont-2",
            "url": null,
            "is_claimed": "1",
            "rating": "3.2",
            "review_count": 546,
            "snippet_image_url": "https://s3-media2.fl.yelpcdn.com/photo/DuUQX2--TOvfKLA45Vn10A/ms.jpg",
            "snippet_text": "On my usual pilgrimage of South Indian restaurants.\\nSaravanaa Bhavan is pretty good.  I\'d go back again.\\n\\nThis was my first visit. I ordered some sort of...",
            "image_url": "https://s3-media1.fl.yelpcdn.com/bphoto/kkr-P_8VjEvggKVmGJkiYw/ms.jpg",
            "image_big_url": "https://s3-media1.fl.yelpcdn.com/bphoto/kkr-P_8VjEvggKVmGJkiYw/o.jpg",
            "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars.png",
            "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@2x.png",
            "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@3x.png",
            "categories": [
                "Indian",
                "Vegetarian"
            ],
            "display_phone": "+1-510-791-7755",
            "is_closed": "0",
            "city": "Fremont",
            "display_address1": "3720 Mowry Ave",
            "display_address2": "Fremont, CA 94538",
            "display_address3": null,
            "postal_code": "94538",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": {
                "monday": [
                    [
                        "11:30",
                        "14:30"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "tuesday": [
                    [
                        "11:30",
                        "14:30"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "wednesday": [
                    [
                        "11:30",
                        "14:30"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "thursday": [
                    [
                        "11:30",
                        "14:30"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "friday": [
                    [
                        "11:30",
                        "14:30"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "saturday": [
                    [
                        "11:00",
                        "22:00"
                    ]
                ],
                "sunday": [
                    [
                        "11:00",
                        "22:00"
                    ]
                ]
            },
            "hours_display": "Mon-Fri 11:30 AM-2:30 PM, 5:30 PM-10:00 PM; Sat-Sun 11:00 AM-10:00 PM",
            "additional_info": [
                {
                    "value": "0",
                    "item_id": "10",
                    "item_name": "payment_cashonly",
                    "display_name": "Cash Payment Only ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "32",
                    "item_name": "options_vegetarian",
                    "display_name": "Vegetarian",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "37",
                    "item_name": "options_healthy",
                    "display_name": "Healthy ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "84",
                    "item_name": "open_24hrs",
                    "display_name": "Open 24 Hours",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs_selected@3x.png"
                },
                {
                    "value": "casual",
                    "item_id": "1",
                    "item_name": "attire",
                    "display_name": "Attire",
                    "item_format": "String",
                    "icon_url": "",
                    "icon_selected_url": ""
                }
            ],
            "latitude": "37.550531290054",
            "longitude": "-121.98620158349",
            "dollar_range": "",
            "merchant_id": null,
            "created_date": "2015-09-09 12:37:19",
            "last_updated_date": "2015-09-09 12:37:19",
            "is_online_store": "0",
            "dollar_range_symbol": "",
            "todays_hours": "11:30 to 14:30 , 17:30 to 22:00",
            "now_open": 1,
            "review": [
                {
                    "review_text": "Reminds me of eating in India. \\nAmbiance and overall service could be a bit better. \\nBut the food covers all those minor drawbacks. \\nEspecially i love their Filter Coffee. Very authentic i must say. \\nValue wise too this is a great place and do also their variety of chutney with any dish is really good. ",
                    "reviewer_image_url": "https://lh6.googleusercontent.com/-YTmcup_bjDo/AAAAAAAAAAI/AAAAAAAAAPc/-mgEIXXSGbc/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Chandrakanth Bobba",
                    "review_date_string": "6 months ago"
                },
                {
                    "review_text": "We usually go to Madras Cafe but as it\'s closed on Monday, we ended up at Saravanaa Bhavan.\\n\\nWe got seated almost instantly as it was a weekday night. Most...",
                    "reviewer_image_url": "https://s3-media3.fl.yelpcdn.com/photo/qtQzYvz8XlMI7hG0x-enLQ/ms.jpg",
                    "rating_image": "http://s3-media3.fl.yelpcdn.com/assets/2/www/img/34bc8086841c/ico/stars/v1/stars_3.png",
                    "review_source": "yelp",
                    "Review_user_name": "Rishabh A.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "The service was really bad today. The seems seems to be new. We were seated and within literally 10 seconds we were asked to order! Eye roll!!! We ask for...",
                    "reviewer_image_url": "https://s3-media1.fl.yelpcdn.com/photo/qmhm1JzNrjLEE_swQCepMA/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
                    "review_source": "yelp",
                    "Review_user_name": "Dee V.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "I came with a group of six to eat masala dosas! How ever two of the people ordered uthapum (spelling is probably wrong) and we had gotten our masala dosas...",
                    "reviewer_image_url": "https://s3-media2.fl.yelpcdn.com/photo/bSw-scBUZPyDqBfqqAMjPQ/ms.jpg",
                    "rating_image": "http://s3-media2.fl.yelpcdn.com/assets/2/www/img/b561c24f8341/ico/stars/v1/stars_2.png",
                    "review_source": "yelp",
                    "Review_user_name": "Nikita B.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "Very bad south India food. I am not sure why so many people favorite this place. I have tasted bisi bele bath, pongal, curd rice all were horribly bad. They prepare butter milk like they prepare lassi. Please teach them the difference.",
                    "reviewer_image_url": "https://lh4.googleusercontent.com/-I8Tpd-njWNQ/AAAAAAAAAAI/AAAAAAAAPcc/TadMWu1kM2k/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Sandeep Prakash",
                    "review_date_string": "26 days ago"
                },
                {
                    "review_text": "Not like the saravana bhavan that we are used to in India. South indian items taste consistently good. Others are a hit or miss.",
                    "reviewer_image_url": "https://lh5.googleusercontent.com/-dZWPqTxQA7U/AAAAAAAAAAI/AAAAAAAABC4/u_A1s_E_1eA/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Raghav Ayyamani",
                    "review_date_string": "26 days ago"
                },
                {
                    "review_text": "Authentic south Indian food. Their dosa AMD sambar are really up to the expectations. It gets crowded and noisy, but there are no longer waiting most of the time.",
                    "reviewer_image_url": "https://lh4.googleusercontent.com/-RGgTkpw7pls/AAAAAAAAAAI/AAAAAAAARKQ/XGxf8E7sgEo/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Darshak Koshiya",
                    "review_date_string": "26 days ago"
                },
                {
                    "review_text": "Nice south India restaurant. \\n\\nService is sometimes poor and people are arrogant.",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Vijaya Kumar",
                    "review_date_string": "26 days ago"
                }
            ],
            "images": [
                {
                    "image_url": "https://s3-media1.fl.yelpcdn.com/bphoto/kkr-P_8VjEvggKVmGJkiYw/ms.jpg",
                    "image_big_url": "https://s3-media1.fl.yelpcdn.com/bphoto/kkr-P_8VjEvggKVmGJkiYw/o.jpg",
                    "uploader_profile_url": "https://s3-media2.fl.yelpcdn.com/photo/DuUQX2--TOvfKLA45Vn10A/ms.jpg",
                    "image_source": "Yelp",
                    "user_name": "Saravanaa Bhavan",
                    "date_string": ""
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp.png",
                    "site1_review_count": "318",
                    "site1_rating": "3.0",
                    "site1_rating_image": "https://s3-media3.fl.yelpcdn.com/assets/2/www/img/34bc8086841c/ico/stars/v1/stars_3.png"
                },
                "accumulative": "5"
            },
            "review_summary_new": [
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp@3x.png",
                    "site_review_count": "318",
                    "site_rating": "3",
                    "site_source": "Yelp",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp-3.0-stars@3x.png"
                },
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/googlePlaces@3x.png",
                    "site_review_count": "228",
                    "site_rating": "3.5",
                    "site_source": "Google",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/google-3.5-stars@3x.png"
                }
            ],
            "claimed_merchant": {}
        },
        {
            "global_merchant_id": "5010",
            "name": "Biryani Pot",
            "yelp_id": "biryani-pot-newark",
            "url": null,
            "is_claimed": "1",
            "rating": "3.6",
            "review_count": 36,
            "snippet_image_url": "https://s3-media4.fl.yelpcdn.com/assets/srv0/yelp_styleguide/cc4afe21892e/assets/img/default_avatars/user_medium_square.png",
            "snippet_text": "previously spice hut / spice kitchen.\\n\\nOpen as new Biryani Pot with nice ambiance, menu and taste.\\n\\nBiryani is their special dish with some other tasty...",
            "image_url": "https://s3-media4.fl.yelpcdn.com/bphoto/g_dUN0mCrgTZ8H9rN5XBdw/ms.jpg",
            "image_big_url": "https://s3-media4.fl.yelpcdn.com/bphoto/g_dUN0mCrgTZ8H9rN5XBdw/o.jpg",
            "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.5-stars.png",
            "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.5-stars@2x.png",
            "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.5-stars@3x.png",
            "categories": [
                "Indian",
                "Halal"
            ],
            "display_phone": "+1-510-745-9870",
            "is_closed": "0",
            "city": "Newark",
            "display_address1": "39277 Cedar Blvd",
            "display_address2": "Newark, CA 94560",
            "display_address3": null,
            "postal_code": "94560",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": {
                "monday": [
                    [
                        "11:30",
                        "21:30"
                    ]
                ],
                "tuesday": [
                    [
                        "11:30",
                        "21:30"
                    ]
                ],
                "wednesday": [
                    [
                        "11:30",
                        "21:30"
                    ]
                ],
                "thursday": [
                    [
                        "11:30",
                        "21:30"
                    ]
                ],
                "friday": [
                    [
                        "11:30",
                        "21:30"
                    ]
                ],
                "saturday": [
                    [
                        "11:30",
                        "21:30"
                    ]
                ],
                "sunday": [
                    [
                        "11:30",
                        "21:30"
                    ]
                ]
            },
            "hours_display": "Open Daily 11:30 AM-9:30 PM",
            "additional_info": [
                {
                    "value": "1",
                    "item_id": "4",
                    "item_name": "kids_goodfor",
                    "display_name": "Good For Kids",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "7",
                    "item_name": "accessible_wheelchair",
                    "display_name": "Wheel Chair Access",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "8",
                    "item_name": "seating_outdoor",
                    "display_name": "Outdoor Seating",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/seating_outdoor@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/seating_outdoor_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "10",
                    "item_name": "payment_cashonly",
                    "display_name": "Cash Payment Only ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "11",
                    "item_name": "reservations",
                    "display_name": "Accept Reservations",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "13",
                    "item_name": "alcohol_bar",
                    "display_name": "Full Bar",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "14",
                    "item_name": "alcohol_beer_wine",
                    "display_name": "Beer and Wine only",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "15",
                    "item_name": "alcohol_byob",
                    "display_name": "Bring Your Own Bottle",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_byob@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_byob_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "17",
                    "item_name": "meal_lunch",
                    "display_name": "Lunch",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "18",
                    "item_name": "meal_dinner",
                    "display_name": "Dinner",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "20",
                    "item_name": "meal_deliver",
                    "display_name": "Delivery Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "21",
                    "item_name": "meal_takeout",
                    "display_name": "Takeout",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "22",
                    "item_name": "meal_cater",
                    "display_name": "Catering Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "27",
                    "item_name": "parking_lot",
                    "display_name": "Private Lot",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_lot@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_lot_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "29",
                    "item_name": "parking_free",
                    "display_name": "Free Parking",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_free@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_free_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "30",
                    "item_name": "wifi",
                    "display_name": "Wifi Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/wifi@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/wifi_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "32",
                    "item_name": "options_vegetarian",
                    "display_name": "Vegetarian",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "33",
                    "item_name": "options_vegan",
                    "display_name": "Vegan",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegan@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegan_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "37",
                    "item_name": "options_healthy",
                    "display_name": "Healthy ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "84",
                    "item_name": "open_24hrs",
                    "display_name": "Open 24 Hours",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs_selected@3x.png"
                },
                {
                    "value": "casual",
                    "item_id": "1",
                    "item_name": "attire",
                    "display_name": "Attire",
                    "item_format": "String",
                    "icon_url": "",
                    "icon_selected_url": ""
                }
            ],
            "latitude": "37.522403",
            "longitude": "-122.0031966",
            "dollar_range": "1",
            "merchant_id": null,
            "created_date": "2015-10-27 08:35:58",
            "last_updated_date": null,
            "is_online_store": "0",
            "dollar_range_symbol": "$",
            "todays_hours": "11:30 to 21:30",
            "now_open": 1,
            "review": [
                {
                    "review_text": "I have been there 2 times already and am going today again with friends. I love the place and the food.",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Jeevan Somarpu",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "I used to go to Spice Kitchen in this location for the South Indian Food quite often. They have been replaced recently by Biryani Pot. I was told that this...",
                    "reviewer_image_url": "https://s3-media3.fl.yelpcdn.com/photo/V71ceIEDR13MdevlzMPd6g/ms.jpg",
                    "rating_image": "http://s3-media3.fl.yelpcdn.com/assets/2/www/img/34bc8086841c/ico/stars/v1/stars_3.png",
                    "review_source": "yelp",
                    "Review_user_name": "Sunil R.",
                    "review_date_string": "2 months ago"
                },
                {
                    "review_text": "",
                    "reviewer_image_url": "https://lh6.googleusercontent.com/-ovDxAuvGi1U/AAAAAAAAAAI/AAAAAAAAFVk/BwO3qfQ8V3o/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Lenin Babu nampally",
                    "review_date_string": "2 months ago"
                },
                {
                    "review_text": "3 stars for the disappointing take out order!\\n\\nWe had called one hour ahead to place our order. But when we went to pick it up an hour later, our order...",
                    "reviewer_image_url": "https://s3-media2.fl.yelpcdn.com/photo/Vc8umvVht7JSK3fiDvfVXg/ms.jpg",
                    "rating_image": "http://s3-media3.fl.yelpcdn.com/assets/2/www/img/34bc8086841c/ico/stars/v1/stars_3.png",
                    "review_source": "yelp",
                    "Review_user_name": "Steffi C.",
                    "review_date_string": "2 months ago"
                },
                {
                    "review_text": "previously spice hut / spice kitchen.\\n\\nOpen as new Biryani Pot with nice ambiance, menu and taste.\\n\\nBiryani is their special dish with some other tasty...",
                    "reviewer_image_url": "https://s3-media4.fl.yelpcdn.com/assets/srv0/yelp_styleguide/cc4afe21892e/assets/img/default_avatars/user_medium_square.png",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f1def11e4e79/ico/stars/v1/stars_5.png",
                    "review_source": "yelp",
                    "Review_user_name": "Vamsi K.",
                    "review_date_string": "2 months ago"
                },
                {
                    "review_text": "Food is hot and spicy.",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Mythili Deenan",
                    "review_date_string": "2 months ago"
                },
                {
                    "review_text": "Awesome food. One of the best biryanis in Bay Area ",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "neeraj sinha",
                    "review_date_string": "2 months ago"
                },
                {
                    "review_text": "Awesome food. One of the best biryanis in Bay Area ",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "neeraj sinha",
                    "review_date_string": "2 months ago"
                },
                {
                    "review_text": "",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-ZTw64CFmFaw/AAAAAAAAAAI/AAAAAAAAB6A/lUtWbl2h08M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Ashrith Reddy",
                    "review_date_string": "1 month ago"
                },
                {
                    "review_text": "",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Srikanth G",
                    "review_date_string": "11 days ago"
                },
                {
                    "review_text": "Not impressed by the Biryani here. House chicken curry was good. Service and ambience is excellent.",
                    "reviewer_image_url": "https://lh4.googleusercontent.com/-jYWIEQ8eeo4/AAAAAAAAAAI/AAAAAAAAGcA/G1rA96zthb0/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Shashidhar Gandham",
                    "review_date_string": "7 days ago"
                }
            ],
            "images": [
                {
                    "image_url": "https://s3-media4.fl.yelpcdn.com/bphoto/g_dUN0mCrgTZ8H9rN5XBdw/ms.jpg",
                    "image_big_url": "https://s3-media4.fl.yelpcdn.com/bphoto/g_dUN0mCrgTZ8H9rN5XBdw/o.jpg",
                    "uploader_profile_url": "https://s3-media4.fl.yelpcdn.com/assets/srv0/yelp_styleguide/cc4afe21892e/assets/img/default_avatars/user_medium_square.png",
                    "image_source": "Yelp",
                    "user_name": "Biryani Pot",
                    "date_string": ""
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp.png",
                    "site1_review_count": "32",
                    "site1_rating": "4.0",
                    "site1_rating_image": "https://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png"
                },
                "accumulative": "5"
            },
            "review_summary_new": [
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp@3x.png",
                    "site_review_count": "32",
                    "site_rating": "4",
                    "site_source": "Yelp",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp-4.0-stars@3x.png"
                },
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/googlePlaces@3x.png",
                    "site_review_count": "4",
                    "site_rating": null,
                    "site_source": "Google",
                    "site_rating_image": ""
                }
            ],
            "claimed_merchant": {}
        },
        {
            "global_merchant_id": "2269",
            "name": "Dosa Place",
            "yelp_id": "dosa-place-fremont",
            "url": null,
            "is_claimed": "1",
            "rating": "3.4",
            "review_count": 158,
            "snippet_image_url": "https://s3-media4.fl.yelpcdn.com/photo/64BOuYbfJvl6Y-QTn5m1aw/ms.jpg",
            "snippet_text": "The food is fab. They even have no/low oil options.\\nMy favorites are paneer bhurji dosa, ginger dosa, upma, and even rava dosa, (which I find yum only...",
            "image_url": "https://s3-media3.fl.yelpcdn.com/bphoto/Utu9cE4K4CBjSdIFUwq-Vg/ms.jpg",
            "image_big_url": "https://s3-media3.fl.yelpcdn.com/bphoto/Utu9cE4K4CBjSdIFUwq-Vg/o.jpg",
            "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars.png",
            "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@2x.png",
            "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@3x.png",
            "categories": [
                "Indian",
                "Vegetarian"
            ],
            "display_phone": "+1-510-651-3672",
            "is_closed": "0",
            "city": "Fremont",
            "display_address1": "41043 Fremont Blvd",
            "display_address2": "Fremont, CA 94538",
            "display_address3": null,
            "postal_code": "94538",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": {
                "monday": [
                    [
                        "11:30",
                        "21:30"
                    ]
                ],
                "tuesday": [
                    [
                        "11:30",
                        "21:30"
                    ]
                ],
                "wednesday": [
                    [
                        "11:30",
                        "21:30"
                    ]
                ],
                "thursday": [
                    [
                        "11:30",
                        "21:30"
                    ]
                ],
                "friday": [
                    [
                        "11:30",
                        "22:00"
                    ]
                ],
                "saturday": [
                    [
                        "9:30",
                        "22:00"
                    ]
                ],
                "sunday": [
                    [
                        "9:30",
                        "21:30"
                    ]
                ]
            },
            "hours_display": "Mon-Thu 11:30 AM-9:30 PM; Fri 11:30 AM-10:00 PM; Sat 9:30 AM-10:00 PM; Sun 9:30 AM-9:30 PM",
            "additional_info": [
                {
                    "value": "1",
                    "item_id": "4",
                    "item_name": "kids_goodfor",
                    "display_name": "Good For Kids",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "8",
                    "item_name": "seating_outdoor",
                    "display_name": "Outdoor Seating",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/seating_outdoor@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/seating_outdoor_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "10",
                    "item_name": "payment_cashonly",
                    "display_name": "Cash Payment Only ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "16",
                    "item_name": "meal_breakfast",
                    "display_name": "Breakfast",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_breakfast@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_breakfast_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "17",
                    "item_name": "meal_lunch",
                    "display_name": "Lunch",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "20",
                    "item_name": "meal_deliver",
                    "display_name": "Delivery Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "21",
                    "item_name": "meal_takeout",
                    "display_name": "Takeout",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "22",
                    "item_name": "meal_cater",
                    "display_name": "Catering Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "32",
                    "item_name": "options_vegetarian",
                    "display_name": "Vegetarian",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "37",
                    "item_name": "options_healthy",
                    "display_name": "Healthy ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "84",
                    "item_name": "open_24hrs",
                    "display_name": "Open 24 Hours",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs_selected@3x.png"
                },
                {
                    "value": "business casual",
                    "item_id": "1",
                    "item_name": "attire",
                    "display_name": "Attire",
                    "item_format": "String",
                    "icon_url": "",
                    "icon_selected_url": ""
                }
            ],
            "latitude": "37.532117517906",
            "longitude": "-121.96027054526",
            "dollar_range": "1",
            "merchant_id": null,
            "created_date": "2015-09-09 12:37:19",
            "last_updated_date": "2015-09-09 12:37:19",
            "is_online_store": "0",
            "dollar_range_symbol": "$",
            "todays_hours": "11:30 to 22:00",
            "now_open": 1,
            "review": [
                {
                    "review_text": "Very good dosa.\\nAnd very good natural.worth for money.\\nRava dosa is ultimate for 6 $. ",
                    "reviewer_image_url": "https://lh4.googleusercontent.com/-6cuT-pGHwVo/AAAAAAAAAAI/AAAAAAAAA2g/VYbDKZql_eU/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "magesh v",
                    "review_date_string": "10 months ago"
                },
                {
                    "review_text": "Very good dosa.\\nAnd very good natural.worth for money.\\nRava dosa is ultimate for 6 $. ",
                    "reviewer_image_url": "https://lh4.googleusercontent.com/-6cuT-pGHwVo/AAAAAAAAAAI/AAAAAAAAA2g/VYbDKZql_eU/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "magesh v",
                    "review_date_string": "10 months ago"
                },
                {
                    "review_text": "I am not a guy who write reviews to any restaurant. This is my first review. I am in usa for past 7 years, travelled to many states and stayed for job. Am in fremont for past 2 years and here and then i used to buy food from this place. This is awesome and great place and worth for the price we pay. Now i feel why i paid or wasted my money at different place.\\n\\nI would recommend this restaurant for price, taste and wellness. Cheers",
                    "reviewer_image_url": "https://lh6.googleusercontent.com/-m9V7IEXS3Ss/AAAAAAAAAAI/AAAAAAAAHag/r_buzgU6d5U/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Manikandan Arumugam",
                    "review_date_string": "6 months ago"
                },
                {
                    "review_text": "The food is fab. They even have no/low oil options.\\nMy favorites are paneer bhurji dosa, ginger dosa, upma, and even rava dosa, (which I find yum only...",
                    "reviewer_image_url": "https://s3-media4.fl.yelpcdn.com/photo/64BOuYbfJvl6Y-QTn5m1aw/ms.jpg",
                    "rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
                    "review_source": "yelp",
                    "Review_user_name": "S C.",
                    "review_date_string": "6 months ago"
                },
                {
                    "review_text": "It pains me when I see a business which has good food, ok service and lots of customers faltering at the very basic of things like CLEANLINESS.\\n\\nIf only...",
                    "reviewer_image_url": "https://s3-media4.fl.yelpcdn.com/photo/nM5ntz84cemt1KcUzr6EzQ/ms.jpg",
                    "rating_image": "http://s3-media2.fl.yelpcdn.com/assets/2/www/img/b561c24f8341/ico/stars/v1/stars_2.png",
                    "review_source": "yelp",
                    "Review_user_name": "Prasenjit C.",
                    "review_date_string": "5 months ago"
                },
                {
                    "review_text": "Guy picked his nose and put the same hand in the dish ..lol \\nNever going there again !!",
                    "reviewer_image_url": "https://lh5.googleusercontent.com/-nTsHHkIQIXQ/AAAAAAAAAAI/AAAAAAAAAFU/Cee8hdxgjvY/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Big Bear",
                    "review_date_string": "4 months ago"
                },
                {
                    "review_text": "I wanted to kill my self after eating that Gobi, The restaurant inside smells really bad.But the people at the counter nice though.",
                    "reviewer_image_url": "https://lh5.googleusercontent.com/-Yxnth2JXpTw/AAAAAAAAAAI/AAAAAAAAABM/7iwrV2E2nGo/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Rocky Roy",
                    "review_date_string": "4 months ago"
                },
                {
                    "review_text": "Dosa was really yummy... Dont go for the layout and customer service..... reasonable price and yummy South Indian  food",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-D9cWbhMt41U/AAAAAAAAAAI/AAAAAAAAAIw/fTu-NSh4V5c/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Sujita Pokharel",
                    "review_date_string": "4 months ago"
                },
                {
                    "review_text": "Whats the point in having dosa when these guys fail to give chutney for the third fucking time.??\\n \\n   This includes me mentioning about about the chutney...",
                    "reviewer_image_url": "https://s3-media2.fl.yelpcdn.com/photo/2QG27BKeDtVwnrOSxoKcew/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
                    "review_source": "yelp",
                    "Review_user_name": "Cyk D.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "Good place to have a tummy full meal in economic cost ",
                    "reviewer_image_url": "https://lh5.googleusercontent.com/-I3vB2-JmGP8/AAAAAAAAAAI/AAAAAAAATPc/FrwTIcb3wAQ/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "venkat Lanka",
                    "review_date_string": "1 month ago"
                },
                {
                    "review_text": "This place satisfies my core hunger for spicy authentic food",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-v9dy34spdEg/AAAAAAAAAAI/AAAAAAAAQAM/bLTon8wqPEI/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Ashish Singh",
                    "review_date_string": "26 days ago"
                },
                {
                    "review_text": "Best veggie biryani in the bay area. Their raita is very yummy too. \\n\\nDo checkout their combo offerings, they are great. If you are a tea /coffee lover, masala chai and madras coffee are the best here.",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-nok83p9rlQA/AAAAAAAAAAI/AAAAAAAADhg/39XTUgxJ4X8/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Eswar Rajesh Pinapala",
                    "review_date_string": "20 days ago"
                }
            ],
            "images": [
                {
                    "image_url": "https://s3-media3.fl.yelpcdn.com/bphoto/Utu9cE4K4CBjSdIFUwq-Vg/ms.jpg",
                    "image_big_url": "https://s3-media3.fl.yelpcdn.com/bphoto/Utu9cE4K4CBjSdIFUwq-Vg/o.jpg",
                    "uploader_profile_url": "https://s3-media4.fl.yelpcdn.com/photo/64BOuYbfJvl6Y-QTn5m1aw/ms.jpg",
                    "image_source": "Yelp",
                    "user_name": "Dosa Place",
                    "date_string": ""
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp.png",
                    "site1_review_count": "137",
                    "site1_rating": "3.5",
                    "site1_rating_image": "https://s3-media1.fl.yelpcdn.com/assets/2/www/img/5ef3eb3cb162/ico/stars/v1/stars_3_half.png"
                },
                "accumulative": "5"
            },
            "review_summary_new": [
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp@3x.png",
                    "site_review_count": "137",
                    "site_rating": "3.5",
                    "site_source": "Yelp",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp-3.5-stars@3x.png"
                },
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/googlePlaces@3x.png",
                    "site_review_count": "21",
                    "site_rating": "2.5",
                    "site_source": "Google",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/google-2.5-stars@3x.png"
                }
            ],
            "claimed_merchant": {}
        },
        {
            "global_merchant_id": "1828",
            "name": "Ananda Bhavan",
            "yelp_id": "ananda-bhavan-fremont-2",
            "url": null,
            "is_claimed": "1",
            "rating": "3.5",
            "review_count": 277,
            "snippet_image_url": "https://s3-media2.fl.yelpcdn.com/photo/0457v7e-wBg4ASU1Kskmow/ms.jpg",
            "snippet_text": "Awesome Dosa \\nAwesome bhel and a fun musical environment \\nGreat mango lassi \\nGreat coffee and awesome service",
            "image_url": "https://s3-media1.fl.yelpcdn.com/bphoto/wiOZUYueYyD9w35bcSA7Fw/ms.jpg",
            "image_big_url": "https://s3-media1.fl.yelpcdn.com/bphoto/wiOZUYueYyD9w35bcSA7Fw/o.jpg",
            "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars.png",
            "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@2x.png",
            "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@3x.png",
            "categories": [
                "Indian",
                "Coffee & Tea",
                "Vegetarian"
            ],
            "display_phone": "+1-510-742-1111",
            "is_closed": "0",
            "city": "Fremont",
            "display_address1": "5168 Mowry Ave",
            "display_address2": "Fremont, CA 94538",
            "display_address3": null,
            "postal_code": "94538",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": {
                "monday": [
                    [
                        "11:30",
                        "14:30"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "tuesday": [
                    [
                        "11:30",
                        "14:30"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "wednesday": [
                    [
                        "11:30",
                        "14:30"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "thursday": [
                    [
                        "11:30",
                        "14:30"
                    ],
                    [
                        "17:30",
                        "22:00"
                    ]
                ],
                "friday": [
                    [
                        "11:30",
                        "14:30"
                    ],
                    [
                        "17:30",
                        "22:30"
                    ]
                ],
                "saturday": [
                    [
                        "8:30",
                        "22:30"
                    ]
                ],
                "sunday": [
                    [
                        "8:30",
                        "22:30"
                    ]
                ]
            },
            "hours_display": "Mon-Thu 11:30 AM-2:30 PM, 5:30 PM-10:00 PM; Fri 11:30 AM-2:30 PM, 5:30 PM-10:30 PM; Sat-Sun 8:30 AM-10:30 PM",
            "additional_info": [
                {
                    "value": "1",
                    "item_id": "7",
                    "item_name": "accessible_wheelchair",
                    "display_name": "Wheel Chair Access",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "10",
                    "item_name": "payment_cashonly",
                    "display_name": "Cash Payment Only ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "11",
                    "item_name": "reservations",
                    "display_name": "Accept Reservations",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "25",
                    "item_name": "parking_garage",
                    "display_name": "Garage ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_garage@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_garage_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "32",
                    "item_name": "options_vegetarian",
                    "display_name": "Vegetarian",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "37",
                    "item_name": "options_healthy",
                    "display_name": "Healthy ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "84",
                    "item_name": "open_24hrs",
                    "display_name": "Open 24 Hours",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs_selected@3x.png"
                },
                {
                    "value": "casual",
                    "item_id": "1",
                    "item_name": "attire",
                    "display_name": "Attire",
                    "item_format": "String",
                    "icon_url": "",
                    "icon_selected_url": ""
                }
            ],
            "latitude": "37.5340843",
            "longitude": "-121.9999466",
            "dollar_range": "1",
            "merchant_id": null,
            "created_date": "2015-09-09 12:37:19",
            "last_updated_date": "2015-09-09 12:37:19",
            "is_online_store": "0",
            "dollar_range_symbol": "$",
            "todays_hours": "11:30 to 14:30 , 17:30 to 22:30",
            "now_open": 1,
            "review": [
                {
                    "review_text": "Hygienic and decent looking place with good food and prices. \\n\\nA typical South Indian (although was surprised that it wasn\'t very spicy!) meal. \\n\\nGood...",
                    "reviewer_image_url": "https://s3-media1.fl.yelpcdn.com/photo/5_ZK_Wcpb4B55RZsAFe_sw/ms.jpg",
                    "rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
                    "review_source": "yelp",
                    "Review_user_name": "Sowmya S.",
                    "review_date_string": "5 months ago"
                },
                {
                    "review_text": "After experiencing some terrible services at Saravana Bhavan, we finally decided to check out Ananda Bhavan for some South Indian vegetarian food.\\nWe came...",
                    "reviewer_image_url": "https://s3-media2.fl.yelpcdn.com/photo/Vc8umvVht7JSK3fiDvfVXg/ms.jpg",
                    "rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
                    "review_source": "yelp",
                    "Review_user_name": "Steffi C.",
                    "review_date_string": "5 months ago"
                },
                {
                    "review_text": "Filter coffee was the highlight of my meal here. I could probably stop my review here, but I\'ll continue on so you get a sense of the food...\\n\\nI ordered the...",
                    "reviewer_image_url": "https://s3-media4.fl.yelpcdn.com/photo/7gAAlIb1gRDVH8ZYNXvB6A/ms.jpg",
                    "rating_image": "http://s3-media2.fl.yelpcdn.com/assets/2/www/img/b561c24f8341/ico/stars/v1/stars_2.png",
                    "review_source": "yelp",
                    "Review_user_name": "Mansi A.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "Chil",
                    "reviewer_image_url": "https://lh6.googleusercontent.com/--pbcToL8p40/AAAAAAAAAAI/AAAAAAAAERo/vHQx8qVeqWM/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Udaya Chandru",
                    "review_date_string": "2 months ago"
                },
                {
                    "review_text": "Excellent one ",
                    "reviewer_image_url": "https://lh4.googleusercontent.com/-BG4JL5V5Bz8/AAAAAAAAAAI/AAAAAAAAGQk/PoyP0_XMoqo/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Subbulakshmi Ganesh",
                    "review_date_string": "1 month ago"
                },
                {
                    "review_text": "We have been to this restaurant for the First time last week as one of the nearby Indian restaurant was full and couldn\'t get in. When you have a similar restaurant nearby which serves very good food, you have to try and keep up with them,\\n\\nWhen the food came out to our tables, Most of them were cold which is not something you want.  The vegetarian thali was okay but not a Jaw dropping experience and the Poori was okay but a bit chewy.",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Balaji Mohanakrishnan",
                    "review_date_string": "29 days ago"
                }
            ],
            "images": [
                {
                    "image_url": "https://s3-media1.fl.yelpcdn.com/bphoto/wiOZUYueYyD9w35bcSA7Fw/ms.jpg",
                    "image_big_url": "https://s3-media1.fl.yelpcdn.com/bphoto/wiOZUYueYyD9w35bcSA7Fw/o.jpg",
                    "uploader_profile_url": "https://s3-media2.fl.yelpcdn.com/photo/0457v7e-wBg4ASU1Kskmow/ms.jpg",
                    "image_source": "Yelp",
                    "user_name": "Ananda Bhavan",
                    "date_string": ""
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp.png",
                    "site1_review_count": "274",
                    "site1_rating": "3.5",
                    "site1_rating_image": "https://s3-media1.fl.yelpcdn.com/assets/2/www/img/5ef3eb3cb162/ico/stars/v1/stars_3_half.png"
                },
                "accumulative": "5"
            },
            "review_summary_new": [
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp@3x.png",
                    "site_review_count": "274",
                    "site_rating": "3.5",
                    "site_source": "Yelp",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp-3.5-stars@3x.png"
                },
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/googlePlaces@3x.png",
                    "site_review_count": "3",
                    "site_rating": "0",
                    "site_source": "Google",
                    "site_rating_image": ""
                }
            ],
            "claimed_merchant": {}
        },
        {
            "global_merchant_id": "2088",
            "name": "Taste Of India",
            "yelp_id": "taste-of-india-fremont",
            "url": null,
            "is_claimed": "1",
            "rating": "2.8",
            "review_count": 161,
            "snippet_image_url": "https://s3-media3.fl.yelpcdn.com/photo/atv43DrL-Vnvq9eO75qQFA/ms.jpg",
            "snippet_text": "I love this place, where else can you go for great spicy food, nice people and only pay $7.95 for a buffet in a Saturday afternoon. I had happily surprised...",
            "image_url": "https://s3-media4.fl.yelpcdn.com/bphoto/QpHfW4CH1Kxmt8CxgHPXXg/ms.jpg",
            "image_big_url": "https://s3-media4.fl.yelpcdn.com/bphoto/QpHfW4CH1Kxmt8CxgHPXXg/o.jpg",
            "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-2.5-stars.png",
            "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-2.5-stars@2x.png",
            "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-2.5-stars@3x.png",
            "categories": [
                "Indian"
            ],
            "display_phone": "+1-510-791-1316",
            "is_closed": "0",
            "city": "Fremont",
            "display_address1": "5144 Mowry Ave",
            "display_address2": "Fremont, CA 94538",
            "display_address3": null,
            "postal_code": "94538",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": {
                "monday": [
                    [
                        "10:00",
                        "22:00"
                    ]
                ],
                "tuesday": [
                    [
                        "10:00",
                        "22:00"
                    ]
                ],
                "wednesday": [
                    [
                        "10:00",
                        "22:00"
                    ]
                ],
                "thursday": [
                    [
                        "10:00",
                        "22:00"
                    ]
                ],
                "friday": [
                    [
                        "10:00",
                        "22:00"
                    ]
                ],
                "saturday": [
                    [
                        "10:00",
                        "22:00"
                    ]
                ],
                "sunday": [
                    [
                        "10:00",
                        "22:00"
                    ]
                ]
            },
            "hours_display": "Open Daily 10:00 AM-10:00 PM",
            "additional_info": [
                {
                    "value": "1",
                    "item_id": "4",
                    "item_name": "kids_goodfor",
                    "display_name": "Good For Kids",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "7",
                    "item_name": "accessible_wheelchair",
                    "display_name": "Wheel Chair Access",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "10",
                    "item_name": "payment_cashonly",
                    "display_name": "Cash Payment Only ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "11",
                    "item_name": "reservations",
                    "display_name": "Accept Reservations",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "17",
                    "item_name": "meal_lunch",
                    "display_name": "Lunch",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "20",
                    "item_name": "meal_deliver",
                    "display_name": "Delivery Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "21",
                    "item_name": "meal_takeout",
                    "display_name": "Takeout",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "22",
                    "item_name": "meal_cater",
                    "display_name": "Catering Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "30",
                    "item_name": "wifi",
                    "display_name": "Wifi Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/wifi@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/wifi_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "32",
                    "item_name": "options_vegetarian",
                    "display_name": "Vegetarian",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "37",
                    "item_name": "options_healthy",
                    "display_name": "Healthy ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "84",
                    "item_name": "open_24hrs",
                    "display_name": "Open 24 Hours",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs_selected@3x.png"
                },
                {
                    "value": "business casual",
                    "item_id": "1",
                    "item_name": "attire",
                    "display_name": "Attire",
                    "item_format": "String",
                    "icon_url": "",
                    "icon_selected_url": ""
                }
            ],
            "latitude": "37.53293928277",
            "longitude": "-121.99935436249",
            "dollar_range": "2",
            "merchant_id": null,
            "created_date": "2015-09-09 12:37:19",
            "last_updated_date": "2015-09-09 12:37:19",
            "is_online_store": "0",
            "dollar_range_symbol": "$$",
            "todays_hours": "10:00 to 22:00",
            "now_open": 1,
            "review": [
                {
                    "review_text": "Went for a buffett. The service was good, enjoyed the food, nice cozy enviornment. Im vegeterian, and the selection was limited but by no means inadequet.",
                    "reviewer_image_url": "https://lh5.googleusercontent.com/-kebS5PMwlEI/AAAAAAAAAAI/AAAAAAAAHzs/SbMdIOfPf3E/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Jagveer Singh",
                    "review_date_string": "11 months ago"
                },
                {
                    "review_text": "We just walked in for some lunch and the waiter is rude off the bat. Then as we go to get our food, it\'s immediately clear that everything is cold. Who...",
                    "reviewer_image_url": "https://s3-media4.fl.yelpcdn.com/photo/w__2qe3xuZHjgGx0wScvDQ/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
                    "review_source": "yelp",
                    "Review_user_name": "Immortal S.",
                    "review_date_string": "8 months ago"
                },
                {
                    "review_text": "Well I was looking for a Indian restaurant nearby since the one I usually go to was lacking dishes because there were going out of business soon so I tried...",
                    "reviewer_image_url": "https://s3-media2.fl.yelpcdn.com/photo/TvusC3MyOjSr5XHoxAaW-g/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f1def11e4e79/ico/stars/v1/stars_5.png",
                    "review_source": "yelp",
                    "Review_user_name": "Jan W.",
                    "review_date_string": "4 months ago"
                },
                {
                    "review_text": "So bad i will rather eat shit that this the service is so bad i well never go back their NEVER GO THEIR you gut going to waste you money if ypu what to eat shit go their ",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-JnM4yEHWhn4/AAAAAAAAAAI/AAAAAAAAAA0/Eq37UQBk46M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Nikhil Patel",
                    "review_date_string": "4 months ago"
                },
                {
                    "review_text": "Food is not flavorful like other Indian cuisine.  Buffet india style thought would have all the popular dishes.   I guess not.  Also food are not hot....",
                    "reviewer_image_url": "https://s3-media2.fl.yelpcdn.com/photo/4_ZuzXwbwgFjugdWOwYgtA/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
                    "review_source": "yelp",
                    "Review_user_name": "Scott J.",
                    "review_date_string": "4 months ago"
                },
                {
                    "review_text": "Excellent value for price. Thali non veg is $8. That\'s a big enough meal for a big guy. Sweet shop has good variety. Service is better than decent, never had to wait unless really busy. Lunch buffet one of better ones I\'ve been to in the area. Not sure where all the bad reviews come from, I\'ve been eating there for years and would not go back if it was not worthy of anything less than 4 stars. Noticed a lot if the one stars are just casual \\"Google user\\" so probably competitors taking pot shots.",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Rigo Sandwich",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "Finally found fresh and yummy modak pedhas! Love this place! Impressed by their variety of sweets and great food! ",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Anaya Singh",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "Buffet not worth at all . Nothing is served hot  and warm. Hated decision to have buffet here with friends ",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Harsh Vora",
                    "review_date_string": "29 days ago"
                }
            ],
            "images": [
                {
                    "image_url": "https://s3-media4.fl.yelpcdn.com/bphoto/QpHfW4CH1Kxmt8CxgHPXXg/ms.jpg",
                    "image_big_url": "https://s3-media4.fl.yelpcdn.com/bphoto/QpHfW4CH1Kxmt8CxgHPXXg/o.jpg",
                    "uploader_profile_url": "https://s3-media3.fl.yelpcdn.com/photo/atv43DrL-Vnvq9eO75qQFA/ms.jpg",
                    "image_source": "Yelp",
                    "user_name": "Taste Of India",
                    "date_string": ""
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp.png",
                    "site1_review_count": "135",
                    "site1_rating": "3.0",
                    "site1_rating_image": "https://s3-media3.fl.yelpcdn.com/assets/2/www/img/34bc8086841c/ico/stars/v1/stars_3.png"
                },
                "accumulative": "5"
            },
            "review_summary_new": [
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp@3x.png",
                    "site_review_count": "135",
                    "site_rating": "3",
                    "site_source": "Yelp",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp-3.0-stars@3x.png"
                },
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/googlePlaces@3x.png",
                    "site_review_count": "26",
                    "site_rating": "2",
                    "site_source": "Google",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/google-2.0-stars@3x.png"
                }
            ],
            "claimed_merchant": {}
        },
        {
            "global_merchant_id": "2263",
            "name": "Indian Chili",
            "yelp_id": "indian-chili-fremont",
            "url": null,
            "is_claimed": "1",
            "rating": "3.0",
            "review_count": 104,
            "snippet_image_url": "https://s3-media3.fl.yelpcdn.com/photo/1TdH2Au55tdbIlelwBQikA/ms.jpg",
            "snippet_text": "Slammin. Best chicken tikka masala this side of the Mississippi. Chicken biryani was excellent and spicy. I go to this place like 4 times a month and they...",
            "image_url": "https://s3-media1.fl.yelpcdn.com/bphoto/p1pwWG_udarGMVPqngC_4A/ms.jpg",
            "image_big_url": "https://s3-media1.fl.yelpcdn.com/bphoto/p1pwWG_udarGMVPqngC_4A/o.jpg",
            "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars.png",
            "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@2x.png",
            "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@3x.png",
            "categories": [
                "Indian"
            ],
            "display_phone": "+1-510-713-0183",
            "is_closed": "0",
            "city": "Fremont",
            "display_address1": "39030 Argonaut Way",
            "display_address2": "Fremont, CA 94538",
            "display_address3": null,
            "postal_code": "94538",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": {
                "monday": [
                    [
                        "11:00",
                        "22:00"
                    ]
                ],
                "tuesday": [
                    [
                        "11:00",
                        "22:00"
                    ]
                ],
                "wednesday": [
                    [
                        "11:00",
                        "22:00"
                    ]
                ],
                "thursday": [
                    [
                        "11:00",
                        "22:00"
                    ]
                ],
                "friday": [
                    [
                        "11:00",
                        "23:00"
                    ]
                ],
                "saturday": [
                    [
                        "11:00",
                        "23:00"
                    ]
                ],
                "sunday": [
                    [
                        "11:00",
                        "22:00"
                    ]
                ]
            },
            "hours_display": "Mon-Thu 11:00 AM-10:00 PM; Fri-Sat 11:00 AM-11:00 PM; Sun 11:00 AM-10:00 PM",
            "additional_info": [
                {
                    "value": "1",
                    "item_id": "7",
                    "item_name": "accessible_wheelchair",
                    "display_name": "Wheel Chair Access",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "11",
                    "item_name": "reservations",
                    "display_name": "Accept Reservations",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "84",
                    "item_name": "open_24hrs",
                    "display_name": "Open 24 Hours",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs_selected@3x.png"
                },
                {
                    "value": "casual",
                    "item_id": "1",
                    "item_name": "attire",
                    "display_name": "Attire",
                    "item_format": "String",
                    "icon_url": "",
                    "icon_selected_url": ""
                }
            ],
            "latitude": "37.545775378372",
            "longitude": "-121.98990588376",
            "dollar_range": "",
            "merchant_id": null,
            "created_date": "2015-09-09 12:37:19",
            "last_updated_date": "2015-09-09 12:37:19",
            "is_online_store": "0",
            "dollar_range_symbol": "",
            "todays_hours": "11:00 to 23:00",
            "now_open": 1,
            "review": [
                {
                    "review_text": "Slammin. Best chicken tikka masala this side of the Mississippi. Chicken biryani was excellent and spicy. I go to this place like 4 times a month and they...",
                    "reviewer_image_url": "https://s3-media3.fl.yelpcdn.com/photo/1TdH2Au55tdbIlelwBQikA/ms.jpg",
                    "rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
                    "review_source": "yelp",
                    "Review_user_name": "Andrew B.",
                    "review_date_string": "7 months ago"
                },
                {
                    "review_text": "Indian Chili use to be my go to Indian place until today.  \\n\\nSo disappointed!  \\n\\nThe chicken in the butter chicken was dry and hard like it was days old.  I...",
                    "reviewer_image_url": "https://s3-media3.fl.yelpcdn.com/photo/44CZaGpC1g-nvxag2u6z_w/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
                    "review_source": "yelp",
                    "Review_user_name": "Kathy J.",
                    "review_date_string": "7 months ago"
                },
                {
                    "review_text": "Happened to be in the area.  Dinner was exceptionally fresh.  Naan was outstanding along with the rice.  Chicken Tikka Masala was very tasty but with a...",
                    "reviewer_image_url": "https://s3-media1.fl.yelpcdn.com/photo/0IjW10jvYyneoY6auMxPZA/ms.jpg",
                    "rating_image": "http://s3-media3.fl.yelpcdn.com/assets/2/www/img/34bc8086841c/ico/stars/v1/stars_3.png",
                    "review_source": "yelp",
                    "Review_user_name": "S C.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "Came across this place late one Saturday night and was pleasantly surprised. I enjoy a good, rich and spicy Indian curry and their goat curry with a piece of naan on the side really hit the spot. Would recommend this as a local take out.",
                    "reviewer_image_url": "https://lh6.googleusercontent.com/-i1YLy-xmLhA/AAAAAAAAAAI/AAAAAAAAV6U/1JVdXlvGC0U/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Devin Ramdutt",
                    "review_date_string": "5 months ago"
                },
                {
                    "review_text": "Their Tandoori fish is great and fish pakroas are pretty good. Ask for their special chili sauce, green chutney and spicy onion, pickle and chili salad. According to my family, their chilli chicken and chicken wraps too are good. Their vegetarian fair (veg wrap and paneer butter masala). The naans are OK. People are friendly.",
                    "reviewer_image_url": "https://lh6.googleusercontent.com/-2DbIXt0qJn4/AAAAAAAAAAI/AAAAAAAACRk/RwK-TpNnQng/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Deepak Mohanty",
                    "review_date_string": "11 months ago"
                },
                {
                    "review_text": "I ate chicken biryani I felt eating chicken with tomato rice. The chicken also kind of sour taste and couldn\'t complete and didn\'t dare to take Togo also.\\n\\n",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Jai Reddy",
                    "review_date_string": "5 months ago"
                },
                {
                    "review_text": "Worst food and ambience .... Had lunch today and I have a upset stomach.",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Sanjib Dey",
                    "review_date_string": "7 months ago"
                },
                {
                    "review_text": "good food, good taste. worth a try",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Gaurav Chaddha",
                    "review_date_string": "11 months ago"
                },
                {
                    "review_text": "Horrible restaurant. Food sucks and the staff is rude. They even threatened me once , when complained about the food.",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Image Thoughts Photography",
                    "review_date_string": "23 days ago"
                },
                {
                    "review_text": "Don\'t waste your time and money here. I wish there was a zero star option. ",
                    "reviewer_image_url": "https://lh5.googleusercontent.com/-Sg4Wui5vrxA/AAAAAAAAAAI/AAAAAAAAAFQ/PHndug56NgQ/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "AKASH SINGH",
                    "review_date_string": "8 days ago"
                }
            ],
            "images": [
                {
                    "image_url": "https://s3-media1.fl.yelpcdn.com/bphoto/p1pwWG_udarGMVPqngC_4A/ms.jpg",
                    "image_big_url": "https://s3-media1.fl.yelpcdn.com/bphoto/p1pwWG_udarGMVPqngC_4A/o.jpg",
                    "uploader_profile_url": "https://s3-media3.fl.yelpcdn.com/photo/1TdH2Au55tdbIlelwBQikA/ms.jpg",
                    "image_source": "Yelp",
                    "user_name": "Indian Chili",
                    "date_string": ""
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp.png",
                    "site1_review_count": "98",
                    "site1_rating": "3.0",
                    "site1_rating_image": "https://s3-media3.fl.yelpcdn.com/assets/2/www/img/34bc8086841c/ico/stars/v1/stars_3.png"
                },
                "accumulative": "5"
            },
            "review_summary_new": [
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp@3x.png",
                    "site_review_count": "98",
                    "site_rating": "3",
                    "site_source": "Yelp",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp-3.0-stars@3x.png"
                },
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/googlePlaces@3x.png",
                    "site_review_count": "6",
                    "site_rating": "3.5",
                    "site_source": "Google",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/google-3.5-stars@3x.png"
                }
            ],
            "claimed_merchant": {}
        },
        {
            "global_merchant_id": "2268",
            "name": "Go Chaatzz",
            "yelp_id": "go-chaatzz-fremont",
            "url": null,
            "is_claimed": "1",
            "rating": "3.0",
            "review_count": 257,
            "snippet_image_url": "https://s3-media4.fl.yelpcdn.com/assets/srv0/yelp_styleguide/cc4afe21892e/assets/img/default_avatars/user_medium_square.png",
            "snippet_text": "This is one of the new place in fremont that opened up pretty recently and their food is absolutely amazing. Their service is very fast and they have a lot...",
            "image_url": "https://s3-media3.fl.yelpcdn.com/bphoto/y1TNGD6SNDyY2VL3rbcT_Q/ms.jpg",
            "image_big_url": "https://s3-media3.fl.yelpcdn.com/bphoto/y1TNGD6SNDyY2VL3rbcT_Q/o.jpg",
            "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars.png",
            "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@2x.png",
            "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@3x.png",
            "categories": [
                "Indian"
            ],
            "display_phone": "+1-510-794-9494",
            "is_closed": "0",
            "city": "Fremont",
            "display_address1": "39150 Paseo Padre Pkwy",
            "display_address2": "Fremont, CA 94538",
            "display_address3": null,
            "postal_code": "94538",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": {
                "monday": [
                    [
                        "11:00",
                        "20:45"
                    ]
                ],
                "tuesday": [
                    [
                        "11:00",
                        "20:45"
                    ]
                ],
                "wednesday": [
                    [
                        "11:00",
                        "20:45"
                    ]
                ],
                "thursday": [
                    [
                        "11:00",
                        "20:45"
                    ]
                ],
                "friday": [
                    [
                        "11:00",
                        "20:45"
                    ]
                ],
                "saturday": [
                    [
                        "16:00",
                        "20:45"
                    ]
                ],
                "sunday": [
                    [
                        "16:00",
                        "20:45"
                    ]
                ]
            },
            "hours_display": "Mon-Fri 11:00 AM-8:45 PM; Sat-Sun 4:00 PM-8:45 PM",
            "additional_info": [
                {
                    "value": "0",
                    "item_id": "10",
                    "item_name": "payment_cashonly",
                    "display_name": "Cash Payment Only ",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "11",
                    "item_name": "reservations",
                    "display_name": "Accept Reservations",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/reservations_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "16",
                    "item_name": "meal_breakfast",
                    "display_name": "Breakfast",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_breakfast@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_breakfast_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "17",
                    "item_name": "meal_lunch",
                    "display_name": "Lunch",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "18",
                    "item_name": "meal_dinner",
                    "display_name": "Dinner",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "20",
                    "item_name": "meal_deliver",
                    "display_name": "Delivery Avaliable",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver_selected@3x.png"
                },
                {
                    "value": "1",
                    "item_id": "21",
                    "item_name": "meal_takeout",
                    "display_name": "Takeout",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout_selected@3x.png"
                },
                {
                    "value": "0",
                    "item_id": "84",
                    "item_name": "open_24hrs",
                    "display_name": "Open 24 Hours",
                    "item_format": "Boolean",
                    "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs@3x.png",
                    "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs_selected@3x.png"
                },
                {
                    "value": "casual",
                    "item_id": "1",
                    "item_name": "attire",
                    "display_name": "Attire",
                    "item_format": "String",
                    "icon_url": "",
                    "icon_selected_url": ""
                }
            ],
            "latitude": "37.553093",
            "longitude": "-121.9799118",
            "dollar_range": "1",
            "merchant_id": null,
            "created_date": "2015-09-09 12:37:19",
            "last_updated_date": "2015-09-09 12:37:19",
            "is_online_store": "0",
            "dollar_range_symbol": "$",
            "todays_hours": "11:00 to 20:45",
            "now_open": 1,
            "review": [
                {
                    "review_text": "Crappy food and crappy service!\\nWe went there Saturday afternoon. Ordered Gobi Manchuria  and Hakka noodles. GM looked like cauliflower has been cooked till...",
                    "reviewer_image_url": "https://s3-media2.fl.yelpcdn.com/photo/7WDyIAoqSBO0z8JPl2gqSw/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
                    "review_source": "yelp",
                    "Review_user_name": "Foodierock n.",
                    "review_date_string": "5 months ago"
                },
                {
                    "review_text": "Ordered dahi bhella papdi chat and aloo pyaz stuffed paratha.. Didn\'t like both.. Aloo paratha is worse.. Papdi chat ok ok.. I may not visit again. Sorry guys.. ",
                    "reviewer_image_url": "https://lh4.googleusercontent.com/-J6pjJ7KQJhw/AAAAAAAAAAI/AAAAAAAABHo/Cnif2V7jIAk/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Raghuram Chary",
                    "review_date_string": "4 months ago"
                },
                {
                    "review_text": "Fantastic service, even for Take Out! Things are a lot difference since my last visit a few months ago. The staff is super attentive, and the manager is...",
                    "reviewer_image_url": "https://s3-media1.fl.yelpcdn.com/photo/TvVgkAcy9ITyvrcQ0PYCSw/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f1def11e4e79/ico/stars/v1/stars_5.png",
                    "review_source": "yelp",
                    "Review_user_name": "Hemanshu N.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "Ambience : Usually very crowded with lots of kids so don\'t expect a quiet atmosphere here.\\n\\nService : Pretty average. Not that slow\\n\\nFood: We ordered the...",
                    "reviewer_image_url": "https://s3-media2.fl.yelpcdn.com/photo/HASraXK_fZshfoT31PzEXQ/ms.jpg",
                    "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
                    "review_source": "yelp",
                    "Review_user_name": "Nupur S.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "I had the ragda patis and wierdly it had yogurt in it. So it made the hot ragda kinda cold..taste was decent.the vada pav was nothing great..had less salt.. Could have been better.. Missed the garlic chatni.. The south Indian Thai had some weird roti kinda thing Chole with a sorry looking sambar tasting like daal..rasam was ok...I liked the plate though.. Had dedicated place for the bowls..sorry Go Chaatzz..not coming to visit you again..",
                    "reviewer_image_url": "https://lh6.googleusercontent.com/-E43kTPAPgGU/AAAAAAAAAAI/AAAAAAAAGBg/XX_P5uXMhLU/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Arvind B",
                    "review_date_string": "2 months ago"
                },
                {
                    "review_text": "Ordered vada pav (which lacked salt and was a little in the sweet side).. Ragda pattzi, was just ok.. weird part being it had curd in it for some reason..  and South Indian thali which turned out to be a complete mistake. Won\'t be visiting again. ",
                    "reviewer_image_url": "https://lh5.googleusercontent.com/-WKB3tz9vYcI/AAAAAAAAAAI/AAAAAAAAK3A/Z9dSV-vDooY/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Prachi Gandhi",
                    "review_date_string": "2 months ago"
                },
                {
                    "review_text": "Service is really good. Innovative Indian cuisine tastes very delicious. Will definitely go back sometime.",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-okPFuQuooK4/AAAAAAAAAAI/AAAAAAAAFhY/QZowwxRSvp4/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Jason Wang",
                    "review_date_string": "1 month ago"
                },
                {
                    "review_text": "Good food, pathetic service. We have been going to this restaurant since inception and we loved food and service. Time after time I am seeing drastic drop in service quality and coordination between staff. Food is good but not outstanding to visit them and wait for a dosa 45 mins. I am done with this restaurant.",
                    "reviewer_image_url": "https://lh5.googleusercontent.com/-6mm5mxidQMg/AAAAAAAAAAI/AAAAAAAAFHM/WuZXT3RN8ug/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Manish Pathak",
                    "review_date_string": "26 days ago"
                }
            ],
            "images": [
                {
                    "image_url": "https://s3-media3.fl.yelpcdn.com/bphoto/y1TNGD6SNDyY2VL3rbcT_Q/ms.jpg",
                    "image_big_url": "https://s3-media3.fl.yelpcdn.com/bphoto/y1TNGD6SNDyY2VL3rbcT_Q/o.jpg",
                    "uploader_profile_url": "https://s3-media4.fl.yelpcdn.com/assets/srv0/yelp_styleguide/cc4afe21892e/assets/img/default_avatars/user_medium_square.png",
                    "image_source": "Yelp",
                    "user_name": "Go Chaatzz",
                    "date_string": ""
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp.png",
                    "site1_review_count": "233",
                    "site1_rating": "3.0",
                    "site1_rating_image": "https://s3-media3.fl.yelpcdn.com/assets/2/www/img/34bc8086841c/ico/stars/v1/stars_3.png"
                },
                "accumulative": "5"
            },
            "review_summary_new": [
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp@3x.png",
                    "site_review_count": "233",
                    "site_rating": "3",
                    "site_source": "Yelp",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp-3.0-stars@3x.png"
                },
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/googlePlaces@3x.png",
                    "site_review_count": "24",
                    "site_rating": "3.5",
                    "site_source": "Google",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/google-3.5-stars@3x.png"
                }
            ],
            "claimed_merchant": {}
        },
        {
            "global_merchant_id": "3670",
            "name": "Chaat House",
            "yelp_id": "chaat-house-fremont",
            "url": null,
            "is_claimed": "1",
            "rating": "4.0",
            "review_count": 148,
            "snippet_image_url": "https://s3-media1.fl.yelpcdn.com/photo/kFrdUdCWwGSN7WtqSM8zYQ/ms.jpg",
            "snippet_text": "The waiter was great about suggesting to us dishes that us \\"first-timers\\" to the restaurant, and pretty much also with \\"Indian\\" style food.\\n\\nThe dishes we...",
            "image_url": "https://s3-media2.fl.yelpcdn.com/bphoto/NXRDBz4x_EVOssG4X6nXFQ/ms.jpg",
            "image_big_url": "https://s3-media2.fl.yelpcdn.com/bphoto/NXRDBz4x_EVOssG4X6nXFQ/o.jpg",
            "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-4.0-stars.png",
            "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-4.0-stars@2x.png",
            "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-4.0-stars@3x.png",
            "categories": [
                "Indian",
                "Vegetarian"
            ],
            "display_phone": "+1-510-505-9999",
            "is_closed": "0",
            "city": "Fremont",
            "display_address1": "46465 Mission Blvd",
            "display_address2": "Fremont, CA 94539",
            "display_address3": null,
            "postal_code": "94539",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": null,
            "hours_display": "",
            "additional_info": [],
            "latitude": "37.492337184936",
            "longitude": "-121.92787497279",
            "dollar_range": "",
            "merchant_id": null,
            "created_date": "2015-09-18 07:50:07",
            "last_updated_date": "2015-09-18 07:50:07",
            "is_online_store": "0",
            "dollar_range_symbol": "",
            "todays_hours": "",
            "now_open": 0,
            "review": [
                {
                    "review_text": "nice chole bhature...but paav bhaaji not upto the mark...",
                    "reviewer_image_url": "https://lh4.googleusercontent.com/-wx9CZz2TzhQ/AAAAAAAAAAI/AAAAAAAAARw/ZrsR7GbBcWQ/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Rupali Negi",
                    "review_date_string": "11 months ago"
                },
                {
                    "review_text": "Naan was heavenly, the curry (mild) was phenomenal... So yummy!! Samosas were delightful, with just a mild bite... And the tamarind chutney was a great counterpart to the samosa... Definitely going there again! ",
                    "reviewer_image_url": "https://lh5.googleusercontent.com/-JfJ1yS31YuY/AAAAAAAAAAI/AAAAAAAAACc/658OA3-iJtw/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Carolin Sturtevant",
                    "review_date_string": "7 months ago"
                },
                {
                    "review_text": "Great food and great service! :-)\\n",
                    "reviewer_image_url": "https://lh6.googleusercontent.com/-TaQUZ6R43-w/AAAAAAAAAAI/AAAAAAAABDo/bLJhKHjb5X0/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Sharon S",
                    "review_date_string": "4 months ago"
                },
                {
                    "review_text": "Chole bhathure was very good, esp bhatura which was not greasy at all.\\nThat is the main plus of this restaurant, food is tasty but never greasy or...",
                    "reviewer_image_url": "https://s3-media1.fl.yelpcdn.com/photo/jHd1lmYUiwgvgis1IlTupw/ms.jpg",
                    "rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
                    "review_source": "yelp",
                    "Review_user_name": "Swati R.",
                    "review_date_string": "4 months ago"
                },
                {
                    "review_text": "The waiter was great about suggesting to us dishes that us \\"first-timers\\" to the restaurant, and pretty much also with \\"Indian\\" style food.\\n\\nThe dishes we...",
                    "reviewer_image_url": "https://s3-media1.fl.yelpcdn.com/photo/kFrdUdCWwGSN7WtqSM8zYQ/ms.jpg",
                    "rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
                    "review_source": "yelp",
                    "Review_user_name": "Eric B.",
                    "review_date_string": "4 months ago"
                },
                {
                    "review_text": "Hi guys ,\\nI came with my frnds for lunch and we enjoyed a lot with foods and food is awesome and we love a lot ,,,,, we ordered pani puri, paneer pakoda,...",
                    "reviewer_image_url": "https://s3-media4.fl.yelpcdn.com/photo/c5lL3TXgXpw70j6xZM2qhQ/ms.jpg",
                    "rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
                    "review_source": "yelp",
                    "Review_user_name": "Mantesh Y.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "Big Salute to the team, very quick turnaround and quality food, I had a shortage of food in a party I hosted, Called Chat House which was very close to the party location, needing food for thirty adults within 20mins, I expected Chat House to say no for my request since it\'s nearly impossible, to my surprise  they said yes and got my order ready within 25mins, very happy with the quality of service!",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Jay Mandyam",
                    "review_date_string": "2 months ago"
                },
                {
                    "review_text": "Daily Special Thali",
                    "reviewer_image_url": "https://lh6.googleusercontent.com/-G6BFQoPhWSE/AAAAAAAAAAI/AAAAAAAAAAA/_kABO5gInHY/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Sasha Mamaev",
                    "review_date_string": "1 month ago"
                },
                {
                    "review_text": "Easily One of the best indian snack places in Bay Area, can\'t beat the prices here. ",
                    "reviewer_image_url": "https://lh4.googleusercontent.com/-tTLg2Qq1bCs/AAAAAAAAAAI/AAAAAAAAItM/k5e0ct5lQB4/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Mannar Karyampudi",
                    "review_date_string": "20 days ago"
                }
            ],
            "images": [
                {
                    "image_url": "https://s3-media2.fl.yelpcdn.com/bphoto/NXRDBz4x_EVOssG4X6nXFQ/ms.jpg",
                    "image_big_url": "https://s3-media2.fl.yelpcdn.com/bphoto/NXRDBz4x_EVOssG4X6nXFQ/o.jpg",
                    "uploader_profile_url": "https://s3-media1.fl.yelpcdn.com/photo/kFrdUdCWwGSN7WtqSM8zYQ/ms.jpg",
                    "image_source": "Yelp",
                    "user_name": "Chaat House",
                    "date_string": ""
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp.png",
                    "site1_review_count": "138",
                    "site1_rating": "4.0",
                    "site1_rating_image": "https://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png"
                },
                "accumulative": "5"
            },
            "review_summary_new": [
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp@3x.png",
                    "site_review_count": "138",
                    "site_rating": "4",
                    "site_source": "Yelp",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp-4.0-stars@3x.png"
                },
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/googlePlaces@3x.png",
                    "site_review_count": "10",
                    "site_rating": "4",
                    "site_source": "Google",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/google-4.0-stars@3x.png"
                }
            ],
            "claimed_merchant": {}
        },
        {
            "global_merchant_id": "1825",
            "name": "Chatpatta Corner",
            "yelp_id": "chatpatta-corner-fremont-2",
            "url": null,
            "is_claimed": "0",
            "rating": "3.5",
            "review_count": 205,
            "snippet_image_url": "https://s3-media1.fl.yelpcdn.com/photo/CSwxDJGWOJshPraLM6CYpQ/ms.jpg",
            "snippet_text": "Love the Paani puri and Paav Bhaji. Reminds me of home. Service is a bit slow but worth the wait. Just giving them one star less since it\'s cash only. I...",
            "image_url": "https://s3-media3.fl.yelpcdn.com/bphoto/xmVW9RtBM3B30ets-BH-og/ms.jpg",
            "image_big_url": "https://s3-media3.fl.yelpcdn.com/bphoto/xmVW9RtBM3B30ets-BH-og/o.jpg",
            "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars.png",
            "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@2x.png",
            "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@3x.png",
            "categories": [
                "Vegetarian",
                "Indian"
            ],
            "display_phone": "+1-510-505-0400",
            "is_closed": "0",
            "city": "Fremont",
            "display_address1": "34751 Ardenwood Blvd",
            "display_address2": "Fremont, CA 94536",
            "display_address3": null,
            "postal_code": "94536",
            "country_code": "US",
            "state_code": "CA",
            "about_business": null,
            "working_hours": {
                "tuesday": [
                    [
                        "11:30",
                        "21:00"
                    ]
                ],
                "wednesday": [
                    [
                        "11:30",
                        "21:00"
                    ]
                ],
                "thursday": [
                    [
                        "11:30",
                        "21:00"
                    ]
                ],
                "friday": [
                    [
                        "11:30",
                        "21:00"
                    ]
                ],
                "saturday": [
                    [
                        "11:30",
                        "21:00"
                    ]
                ],
                "sunday": [
                    [
                        "11:30",
                        "21:00"
                    ]
                ]
            },
            "hours_display": "",
            "additional_info": [],
            "latitude": "37.5527573",
            "longitude": "-122.0549622",
            "dollar_range": "2",
            "merchant_id": null,
            "created_date": "2015-09-09 12:37:19",
            "last_updated_date": "2015-09-09 12:37:19",
            "is_online_store": "0",
            "dollar_range_symbol": "$$",
            "todays_hours": "11:30 to 21:00",
            "now_open": 1,
            "review": [
                {
                    "review_text": "Thali reminded me of Ghar ka khana",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-ArSDAP-r70s/AAAAAAAAAAI/AAAAAAAAPpg/r5j_sFN0BGI/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "pawan nimje",
                    "review_date_string": "2 years ago"
                },
                {
                    "review_text": "Great gol gappas (pani puri)!!",
                    "reviewer_image_url": "https://lh6.googleusercontent.com/-cP_eimpaYW4/AAAAAAAAAAI/AAAAAAAAK1U/veJBrXpX5BY/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Ameya Thatte",
                    "review_date_string": "1 year ago"
                },
                {
                    "review_text": "Pani puri best in bay area ",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-oHJKrC-Bg3I/AAAAAAAAAAI/AAAAAAAAVwY/lzEnMQ1e2rQ/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Bijal Shah Parekh",
                    "review_date_string": "10 months ago"
                },
                {
                    "review_text": "This is a review for their branch inside new INDIA bazaar ( off mowry and blacow). They are open only 4 days a week. I really like the chaat, especially the...",
                    "reviewer_image_url": "https://s3-media1.fl.yelpcdn.com/photo/qmhm1JzNrjLEE_swQCepMA/ms.jpg",
                    "rating_image": "http://s3-media4.fl.yelpcdn.com/assets/2/www/img/c2f3dd9799a5/ico/stars/v1/stars_4.png",
                    "review_source": "yelp",
                    "Review_user_name": "Dee V.",
                    "review_date_string": "5 months ago"
                },
                {
                    "review_text": "Good place to have Indian chaat. ",
                    "reviewer_image_url": "https://lh4.googleusercontent.com/-4YZYp7dhY70/AAAAAAAAAAI/AAAAAAAALMU/1lygnjwGa5g/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Himanshu Mehra",
                    "review_date_string": "5 months ago"
                },
                {
                    "review_text": "I\'d give them 3 out of 3 stars for the food. The food is great here. I\'d say much better than the other food joints. I\'ve had lot of dishes from the menu in...",
                    "reviewer_image_url": "https://s3-media1.fl.yelpcdn.com/photo/Nh0QnSVVFFBBDhv7OYo78Q/ms.jpg",
                    "rating_image": "http://s3-media3.fl.yelpcdn.com/assets/2/www/img/34bc8086841c/ico/stars/v1/stars_3.png",
                    "review_source": "yelp",
                    "Review_user_name": "Srinivas R.",
                    "review_date_string": "4 months ago"
                },
                {
                    "review_text": "Don\'t forget: ONLY CASH! \\n\\nThe place was very loki. \\nNot much on ambience or anything. But, I loved my dahi tikki chat and sweet lassi. The samosa was fine...",
                    "reviewer_image_url": "https://s3-media1.fl.yelpcdn.com/photo/5_ZK_Wcpb4B55RZsAFe_sw/ms.jpg",
                    "rating_image": "http://s3-media3.fl.yelpcdn.com/assets/2/www/img/34bc8086841c/ico/stars/v1/stars_3.png",
                    "review_source": "yelp",
                    "Review_user_name": "Sowmya S.",
                    "review_date_string": "3 months ago"
                },
                {
                    "review_text": "best Pani puri and chat in the bay area",
                    "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
                    "rating_image": "",
                    "review_source": "google",
                    "Review_user_name": "Vidya Premkumar",
                    "review_date_string": "25 days ago"
                }
            ],
            "images": [
                {
                    "image_url": "https://s3-media3.fl.yelpcdn.com/bphoto/xmVW9RtBM3B30ets-BH-og/ms.jpg",
                    "image_big_url": "https://s3-media3.fl.yelpcdn.com/bphoto/xmVW9RtBM3B30ets-BH-og/o.jpg",
                    "uploader_profile_url": "https://s3-media1.fl.yelpcdn.com/photo/CSwxDJGWOJshPraLM6CYpQ/ms.jpg",
                    "image_source": "Yelp",
                    "user_name": "Chatpatta Corner",
                    "date_string": ""
                }
            ],
            "review_summary": {
                "0": {
                    "site1_Source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp.png",
                    "site1_review_count": "181",
                    "site1_rating": "3.5",
                    "site1_rating_image": "https://s3-media1.fl.yelpcdn.com/assets/2/www/img/5ef3eb3cb162/ico/stars/v1/stars_3_half.png"
                },
                "accumulative": "5"
            },
            "review_summary_new": [
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp@3x.png",
                    "site_review_count": "181",
                    "site_rating": "3.5",
                    "site_source": "Yelp",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp-3.5-stars@3x.png"
                },
                {
                    "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/googlePlaces@3x.png",
                    "site_review_count": "24",
                    "site_rating": "3.5",
                    "site_source": "Google",
                    "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/google-3.5-stars@3x.png"
                }
            ],
            "claimed_merchant": {}
        }
    ]
}',
            'request' => '{
  "location":"fremont", // optional (either location or cll is required)
  "cll":"37.7057953,-121.8815994", // optional, cll=latitude,longitude
  "term":"biryani bowl", // optional
"sort": 0, // optional, Sort mode: 0=Best matched (default), 1=Distance, 2=Highest Rated. 
   "category_filter": [
        "coffee&tea",
        "shopping",
        "beautysvc"
    ], // optional , by default "category_filter": [ "restaurants",  "nightlife", "bars" "coffee&tea",  "shopping", "beautysvc"  ],
  "dollar_range_filter" : ["1", "2","3","4"], 
  "additional_info_filter" : ["4"] // optional, its additional info ids for search filter
}',
        ),
    ),
    'Visitor\\V1\\Rpc\\GetMerchantProfileByVisitor\\Controller' => array(
        'GET' => array(
            'response' => '{
    "id": "2084",
    "name": "Biryani bowl",
    "yelp_id": "biryani-bowl-fremont",
    "url": null,
    "is_claimed": "1",
    "rating": "3.1",
    "review_count": 296,
    "snippet_image_url": "http://s3-media2.fl.yelpcdn.com/photo/bzByxx-s-obRzz4YFPXDNA/ms.jpg",
    "snippet_text": "A Small Indian Restaurant with good food\\n\\nOrderd 2 garlic NAN and 2 Butter NAN accompanied with Chettinad chicken \\n\\nChicken Chettinad was outstanding -...",
    "image_url": "http://s3-media3.fl.yelpcdn.com/bphoto/kX4yu4nZwzw5wlfdR9jaTQ/ms.jpg",
    "rating_img_url_small": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars.png",
    "rating_img_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@2x.png",
    "rating_img_url_large": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@3x.png",
    "categories": [
        "Indian"
    ],
    "display_phone": "+1-510-247-9264",
    "is_closed": "0",
    "city": "Fremont",
    "display_address1": "3988 washington blvd",
    "display_address2": "Fremont, CA 94538",
    "display_address3": null,
    "postal_code": "94538",
    "country_code": "US",
    "state_code": "CA",
    "about_business": null,
    "working_hours": {
        "monday": [
            [
                "11:30",
                "15:00"
            ],
            [
                "17:30",
                "22:00"
            ]
        ],
        "tuesday": [
            [
                "11:30",
                "15:00"
            ],
            [
                "17:30",
                "22:00"
            ]
        ],
        "wednesday": [
            [
                "11:30",
                "15:00"
            ],
            [
                "17:30",
                "22:00"
            ]
        ],
        "thursday": [
            [
                "11:30",
                "15:00"
            ],
            [
                "17:30",
                "22:00"
            ]
        ],
        "friday": [
            [
                "11:30",
                "15:00"
            ],
            [
                "17:30",
                "22:00"
            ]
        ],
        "saturday": [
            [
                "11:30",
                "15:00"
            ],
            [
                "17:30",
                "22:00"
            ]
        ],
        "sunday": [
            [
                "11:30",
                "15:00"
            ],
            [
                "17:30",
                "22:00"
            ]
        ]
    },
    "hours_display": "Open Daily 11:30 AM-3:00 PM, 5:30 PM-10:00 PM",
    "additional_info": [
        {
            "value": "1",
            "item_name": "meal_cater",
            "display_name": "Catering Avaliable",
            "item_format": "Boolean",
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_cater_selected.png"
        },
        {
            "value": "1",
            "item_name": "meal_takeout",
            "display_name": "Takeout",
            "item_format": "Boolean",
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_takeout_selected.png"
        },
        {
            "value": "1",
            "item_name": "meal_deliver",
            "display_name": "Delivery Avaliable",
            "item_format": "Boolean",
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver_selected.png"
        },
        {
            "value": "1",
            "item_name": "meal_deliver",
            "display_name": "Deliver Avaliable",
            "item_format": "Boolean",
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_deliver_selected.png"
        },
        {
            "value": "1",
            "item_name": "meal_dinner",
            "display_name": "Dinner",
            "item_format": "Boolean",
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_dinner_selected.png"
        },
        {
            "value": "1",
            "item_name": "meal_lunch",
            "display_name": "Lunch",
            "item_format": "Boolean",
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/meal_lunch_selected.png"
        },
        {
            "value": "1",
            "item_name": "alcohol_beer_wine",
            "display_name": "Beer and Wine only",
            "item_format": "Boolean",
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_beer_wine_selected.png"
        },
        {
            "value": "1",
            "item_name": "alcohol_bar",
            "display_name": "Full Bar",
            "item_format": "Boolean",
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/alcohol_bar_selected.png"
        },
        {
            "value": "0",
            "item_name": "payment_cashonly",
            "display_name": "Cash Payment Only ",
            "item_format": "Boolean",
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/payment_cashonly_selected.png"
        },
        {
            "value": "1",
            "item_name": "accessible_wheelchair",
            "display_name": "Wheel Chair Access",
            "item_format": "Boolean",
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/accessible_wheelchair_selected.png"
        },
        {
            "value": "1",
            "item_name": "kids_goodfor",
            "display_name": "Good For Kids",
            "item_format": "Boolean",
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/kids_goodfor_selected.png"
        },
        {
            "value": "0",
            "item_name": "open_24hrs",
            "display_name": "Open 24 Hours",
            "item_format": "Boolean",
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/open_24hrs_selected.png"
        },
        {
            "value": "1",
            "item_name": "options_healthy",
            "display_name": "Healthy ",
            "item_format": "Boolean",
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_healthy_selected.png"
        },
        {
            "value": "1",
            "item_name": "options_vegetarian",
            "display_name": "Vegetarian",
            "item_format": "Boolean",
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/options_vegetarian_selected.png"
        },
        {
            "value": "0",
            "item_name": "wifi",
            "display_name": "Wifi Avaliable",
            "item_format": "Boolean",
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/wifi.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/wifi_selected.png"
        },
        {
            "value": "1",
            "item_name": "parking_lot",
            "display_name": "Private Lot",
            "item_format": "Boolean",
            "icon_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_lot.png",
            "icon_selected_url": "https://s3-us-west-1.amazonaws.com/additional.info.icons/parking_lot_selected.png"
        },
        {
            "value": "casual",
            "item_name": "attire",
            "display_name": "Attire",
            "item_format": "String",
            "icon_url": "",
            "icon_selected_url": ""
        }
    ],
    "latitude": "37.531938538381",
    "longitude": "-121.95873550175",
    "dollar_range": "1",
    "merchant_id": "179",
    "created_date": "2015-09-09 12:37:19",
    "last_updated_date": "2015-09-09 12:37:19",
    "image_big_url": "http://s3-media3.fl.yelpcdn.com/bphoto/kX4yu4nZwzw5wlfdR9jaTQ/o.jpg",
    "dollar_range_symbol": "$",
    "todays_hours": "11:30 to 15:00 , 17:30 to 22:00",
    "is_open": 1,
    "review_summary_new": [
        {
            "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp@3x.png",
            "site_review_count": "232",
            "site_rating": "3",
            "site_source": "Yelp",
            "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp-3.0-stars@3x.png"
        },
        {
            "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/googlePlaces@3x.png",
            "site_review_count": "54",
            "site_rating": "3.5",
            "site_source": "Google",
            "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/google-3.5-stars@3x.png"
        },
        {
            "site_source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/logo-93x35.png",
            "site_review_count": "10",
            "site_rating": "4",
            "site_source": "Privpass",
            "site_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-4.0-stars@3x.png"
        }
    ],
    "images": [
        {
            "image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/c7351839a56d6051e6dc1486c871106b.jpeg",
            "image_big_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/474102a1fd335f72283cbea901ac1ca3.jpeg",
            "uploader_profile_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/07ae00fc45f738b2cc019a9fe28ce308.png",
            "image_source": "Privpass",
            "user_name": "Lakshmi K",
            "date_string": "11 days ago"
        },
        {
            "image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/b66e189f4cd62bc1a02d5c9b2b927129.jpeg",
            "image_big_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/4827b72b1248776bf1c6748c7ff8578d.jpeg",
            "uploader_profile_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/07ae00fc45f738b2cc019a9fe28ce308.png",
            "image_source": "Privpass",
            "user_name": "Lakshmi K",
            "date_string": "11 days ago"
        },
        {
            "image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/8ece2170237bec74967c642d2a2aee77.jpeg",
            "image_big_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/51909b10604222e61e24890108710be1.jpeg",
            "uploader_profile_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/07ae00fc45f738b2cc019a9fe28ce308.png",
            "image_source": "Privpass",
            "user_name": "Lakshmi K",
            "date_string": "11 days ago"
        },
        {
            "image_url": "http://s3-media3.fl.yelpcdn.com/bphoto/kX4yu4nZwzw5wlfdR9jaTQ/ms.jpg",
            "image_big_url": "http://s3-media3.fl.yelpcdn.com/bphoto/kX4yu4nZwzw5wlfdR9jaTQ/o.jpg",
            "uploader_profile_url": "http://s3-media2.fl.yelpcdn.com/photo/bzByxx-s-obRzz4YFPXDNA/ms.jpg",
            "image_source": "Yelp",
            "user_name": "Biryani bowl",
            "date_string": ""
        }
    ],
    "reviews": [
        {
            "review_text": "this is review test",
            "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/07ae00fc45f738b2cc019a9fe28ce308.png",
            "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
            "review_source": "Privpass",
            "Review_user_name": "Lakshmi K",
            "review_date_string": "10 days ago"
        },
        {
            "review_text": "second review",
            "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/07ae00fc45f738b2cc019a9fe28ce308.png",
            "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
            "review_source": "Privpass",
            "Review_user_name": "Lakshmi K",
            "review_date_string": "10 days ago"
        },
        {
            "review_text": "review share third",
            "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/07ae00fc45f738b2cc019a9fe28ce308.png",
            "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
            "review_source": "Privpass",
            "Review_user_name": "Lakshmi K",
            "review_date_string": "10 days ago"
        },
        {
            "review_text": "review share third",
            "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/07ae00fc45f738b2cc019a9fe28ce308.png",
            "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
            "review_source": "Privpass",
            "Review_user_name": "Lakshmi K",
            "review_date_string": "10 days ago"
        },
        {
            "review_text": "this is an excellent restaurant and I enjoyed the food.",
            "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/07ae00fc45f738b2cc019a9fe28ce308.png",
            "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
            "review_source": "Privpass",
            "Review_user_name": "Lakshmi K",
            "review_date_string": "10 days ago"
        },
        {
            "review_text": "nice restaurant",
            "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/07ae00fc45f738b2cc019a9fe28ce308.png",
            "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
            "review_source": "Privpass",
            "Review_user_name": "Lakshmi K",
            "review_date_string": "4 days ago"
        },
        {
            "review_text": "nice restaurant",
            "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/07ae00fc45f738b2cc019a9fe28ce308.png",
            "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
            "review_source": "Privpass",
            "Review_user_name": "Lakshmi K",
            "review_date_string": "4 days ago"
        },
        {
            "review_text": "nice restaurant",
            "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/07ae00fc45f738b2cc019a9fe28ce308.png",
            "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
            "review_source": "Privpass",
            "Review_user_name": "Lakshmi K",
            "review_date_string": "4 days ago"
        },
        {
            "review_text": "nice restaurant",
            "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/07ae00fc45f738b2cc019a9fe28ce308.png",
            "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
            "review_source": "Privpass",
            "Review_user_name": "Lakshmi K",
            "review_date_string": "4 days ago"
        },
        {
            "review_text": "nice restaurant",
            "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/07ae00fc45f738b2cc019a9fe28ce308.png",
            "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
            "review_source": "Privpass",
            "Review_user_name": "Lakshmi K",
            "review_date_string": "4 days ago"
        },
        {
            "review_text": "I am in US more than 16 years and never find best biryani many cities long time. After a long time i found best biryani in biryani bowl. Now i am regular customer and part of our weekly dinner.",
            "reviewer_image_url": "https://lh6.googleusercontent.com/-4ElVkd5ZYC0/AAAAAAAAAAI/AAAAAAAAAR4/QfcQhiiRjYA/photo.jpg?sz=200",
            "rating_image": "",
            "review_source": "google",
            "Review_user_name": "sridhar sambangi",
            "review_date_string": "6 months ago"
        },
        {
            "review_text": "Best chicken dum biryani around Fremont\\n\\nNaan with Pepper chicken awesome taste \\nIt would be great if they have more seating...",
            "reviewer_image_url": "http://s3-media2.fl.yelpcdn.com/photo/_kPe3RY1hIEewCTKXW7bDg/ms.jpg",
            "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f1def11e4e79/ico/stars/v1/stars_5.png",
            "review_source": "yelp",
            "Review_user_name": "Sirish Kumar M.",
            "review_date_string": "6 months ago"
        },
        {
            "review_text": "This review is one of the horrible customer service I experienced .... Please see pictures attached.\\n\\nThey need to take ownership of mistakes they...",
            "reviewer_image_url": "http://s3-media4.fl.yelpcdn.com/photo/G1l-3M3cV42g2nDQ98JSAQ/ms.jpg",
            "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
            "review_source": "yelp",
            "Review_user_name": "Sairam K.",
            "review_date_string": "5 months ago"
        },
        {
            "review_text": "This review is one of the horrible customer service I experienced .... Please see pictures attached.\\n\\nThey need to take ownership of mistakes they make......\\n\\nBeen to this place today , ordered two vegetarian curries. Bhindi fry and Bagara baingan.\\n\\nWhen checked at home , it was mirchi Kia Salan instead of Bagara baingan.\\n\\nCalled the restaurant and explained them about the mistake and they asked me for the order number. When mentioned as order number 12 , restaurant guy said its a chicken biryani and goat biryani order and not I mentioned. \\n\\nI told him that the receipt shows as order number 12, he says that\'s not correct... See again..... Same conversation repeats.......\\n\\nHe was so rude and ultimately hung up the phone saying my order number is not right .....\\n\\nSorry Biryani Bowl ..... You are horrible at customer service even for a simple Togo order.....  Is it rocket science to serve customer. \\n\\nYou lost business from a regular customer. You might not care about it",
            "reviewer_image_url": "https://lh4.googleusercontent.com/-SQGYUtZta3E/AAAAAAAAAAI/AAAAAAAAKVA/pVWEVMimE14/photo.jpg?sz=200",
            "rating_image": "",
            "review_source": "google",
            "Review_user_name": "sairam konala",
            "review_date_string": "5 months ago"
        },
        {
            "review_text": "I wish I could give 0 stars to these bunch of idiots. So we ordered 4 biryanis, the call was 3 min long he said 20 mins it\'ll be ready. So I go there after...",
            "reviewer_image_url": "http://s3-media4.fl.yelpcdn.com/photo/uG00jVAb7mDAjh5tu0oOFg/ms.jpg",
            "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
            "review_source": "yelp",
            "Review_user_name": "Gautam H.",
            "review_date_string": "5 months ago"
        },
        {
            "review_text": "Worst veggie biryani ever!!! Please don\'t go if you are expecting nice veggie biryani",
            "reviewer_image_url": "https://lh5.googleusercontent.com/-4MmF_WKGd9w/AAAAAAAAAAI/AAAAAAAAAl4/Wf6D1kmlfMA/photo.jpg?sz=200",
            "rating_image": "",
            "review_source": "google",
            "Review_user_name": "siddharth bhindi",
            "review_date_string": "1 month ago"
        },
        {
            "review_text": "A great hole in a wall place for biriyanis. The food can be quite spicy for people not used to it but you can add some yogurt to tone down the heat!",
            "reviewer_image_url": "https://lh4.googleusercontent.com/-QvJXxAKuSYk/AAAAAAAAAAI/AAAAAAAAFdM/7wtrSDZKo0g/photo.jpg?sz=200",
            "rating_image": "",
            "review_source": "google",
            "Review_user_name": "Andy C.",
            "review_date_string": "29 days ago"
        },
        {
            "review_text": "Some items are good like the biryanis etc but some items like the indo chinese are horrible.",
            "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
            "rating_image": "",
            "review_source": "google",
            "Review_user_name": "Image Thoughts Photography",
            "review_date_string": "25 days ago"
        }
    ],
    "review": [
        {
            "review_text": "this is review test",
            "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/07ae00fc45f738b2cc019a9fe28ce308.png",
            "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
            "review_source": "Privpass",
            "Review_user_name": "Lakshmi K",
            "review_date_string": "10 days ago"
        },
        {
            "review_text": "second review",
            "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/07ae00fc45f738b2cc019a9fe28ce308.png",
            "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
            "review_source": "Privpass",
            "Review_user_name": "Lakshmi K",
            "review_date_string": "10 days ago"
        },
        {
            "review_text": "review share third",
            "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/07ae00fc45f738b2cc019a9fe28ce308.png",
            "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
            "review_source": "Privpass",
            "Review_user_name": "Lakshmi K",
            "review_date_string": "10 days ago"
        },
        {
            "review_text": "review share third",
            "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/07ae00fc45f738b2cc019a9fe28ce308.png",
            "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
            "review_source": "Privpass",
            "Review_user_name": "Lakshmi K",
            "review_date_string": "10 days ago"
        },
        {
            "review_text": "this is an excellent restaurant and I enjoyed the food.",
            "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/07ae00fc45f738b2cc019a9fe28ce308.png",
            "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
            "review_source": "Privpass",
            "Review_user_name": "Lakshmi K",
            "review_date_string": "10 days ago"
        },
        {
            "review_text": "nice restaurant",
            "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/07ae00fc45f738b2cc019a9fe28ce308.png",
            "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
            "review_source": "Privpass",
            "Review_user_name": "Lakshmi K",
            "review_date_string": "4 days ago"
        },
        {
            "review_text": "nice restaurant",
            "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/07ae00fc45f738b2cc019a9fe28ce308.png",
            "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
            "review_source": "Privpass",
            "Review_user_name": "Lakshmi K",
            "review_date_string": "4 days ago"
        },
        {
            "review_text": "nice restaurant",
            "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/07ae00fc45f738b2cc019a9fe28ce308.png",
            "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
            "review_source": "Privpass",
            "Review_user_name": "Lakshmi K",
            "review_date_string": "4 days ago"
        },
        {
            "review_text": "nice restaurant",
            "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/07ae00fc45f738b2cc019a9fe28ce308.png",
            "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
            "review_source": "Privpass",
            "Review_user_name": "Lakshmi K",
            "review_date_string": "4 days ago"
        },
        {
            "review_text": "nice restaurant",
            "reviewer_image_url": "https://s3-us-west-1.amazonaws.com/privpass.profile.image/07ae00fc45f738b2cc019a9fe28ce308.png",
            "rating_image": "http://www.yaactionadventurenovels.com/wp-content/uploads/2013/05/bth_5-star-rating_zps467d53321.png",
            "review_source": "Privpass",
            "Review_user_name": "Lakshmi K",
            "review_date_string": "4 days ago"
        },
        {
            "review_text": "I am in US more than 16 years and never find best biryani many cities long time. After a long time i found best biryani in biryani bowl. Now i am regular customer and part of our weekly dinner.",
            "reviewer_image_url": "https://lh6.googleusercontent.com/-4ElVkd5ZYC0/AAAAAAAAAAI/AAAAAAAAAR4/QfcQhiiRjYA/photo.jpg?sz=200",
            "rating_image": "",
            "review_source": "google",
            "Review_user_name": "sridhar sambangi",
            "review_date_string": "6 months ago"
        },
        {
            "review_text": "Best chicken dum biryani around Fremont\\n\\nNaan with Pepper chicken awesome taste \\nIt would be great if they have more seating...",
            "reviewer_image_url": "http://s3-media2.fl.yelpcdn.com/photo/_kPe3RY1hIEewCTKXW7bDg/ms.jpg",
            "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f1def11e4e79/ico/stars/v1/stars_5.png",
            "review_source": "yelp",
            "Review_user_name": "Sirish Kumar M.",
            "review_date_string": "6 months ago"
        },
        {
            "review_text": "This review is one of the horrible customer service I experienced .... Please see pictures attached.\\n\\nThey need to take ownership of mistakes they...",
            "reviewer_image_url": "http://s3-media4.fl.yelpcdn.com/photo/G1l-3M3cV42g2nDQ98JSAQ/ms.jpg",
            "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
            "review_source": "yelp",
            "Review_user_name": "Sairam K.",
            "review_date_string": "5 months ago"
        },
        {
            "review_text": "This review is one of the horrible customer service I experienced .... Please see pictures attached.\\n\\nThey need to take ownership of mistakes they make......\\n\\nBeen to this place today , ordered two vegetarian curries. Bhindi fry and Bagara baingan.\\n\\nWhen checked at home , it was mirchi Kia Salan instead of Bagara baingan.\\n\\nCalled the restaurant and explained them about the mistake and they asked me for the order number. When mentioned as order number 12 , restaurant guy said its a chicken biryani and goat biryani order and not I mentioned. \\n\\nI told him that the receipt shows as order number 12, he says that\'s not correct... See again..... Same conversation repeats.......\\n\\nHe was so rude and ultimately hung up the phone saying my order number is not right .....\\n\\nSorry Biryani Bowl ..... You are horrible at customer service even for a simple Togo order.....  Is it rocket science to serve customer. \\n\\nYou lost business from a regular customer. You might not care about it",
            "reviewer_image_url": "https://lh4.googleusercontent.com/-SQGYUtZta3E/AAAAAAAAAAI/AAAAAAAAKVA/pVWEVMimE14/photo.jpg?sz=200",
            "rating_image": "",
            "review_source": "google",
            "Review_user_name": "sairam konala",
            "review_date_string": "5 months ago"
        },
        {
            "review_text": "I wish I could give 0 stars to these bunch of idiots. So we ordered 4 biryanis, the call was 3 min long he said 20 mins it\'ll be ready. So I go there after...",
            "reviewer_image_url": "http://s3-media4.fl.yelpcdn.com/photo/uG00jVAb7mDAjh5tu0oOFg/ms.jpg",
            "rating_image": "http://s3-media1.fl.yelpcdn.com/assets/2/www/img/f64056afac01/ico/stars/v1/stars_1.png",
            "review_source": "yelp",
            "Review_user_name": "Gautam H.",
            "review_date_string": "5 months ago"
        },
        {
            "review_text": "Worst veggie biryani ever!!! Please don\'t go if you are expecting nice veggie biryani",
            "reviewer_image_url": "https://lh5.googleusercontent.com/-4MmF_WKGd9w/AAAAAAAAAAI/AAAAAAAAAl4/Wf6D1kmlfMA/photo.jpg?sz=200",
            "rating_image": "",
            "review_source": "google",
            "Review_user_name": "siddharth bhindi",
            "review_date_string": "1 month ago"
        },
        {
            "review_text": "A great hole in a wall place for biriyanis. The food can be quite spicy for people not used to it but you can add some yogurt to tone down the heat!",
            "reviewer_image_url": "https://lh4.googleusercontent.com/-QvJXxAKuSYk/AAAAAAAAAAI/AAAAAAAAFdM/7wtrSDZKo0g/photo.jpg?sz=200",
            "rating_image": "",
            "review_source": "google",
            "Review_user_name": "Andy C.",
            "review_date_string": "29 days ago"
        },
        {
            "review_text": "Some items are good like the biryanis etc but some items like the indo chinese are horrible.",
            "reviewer_image_url": "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=200",
            "rating_image": "",
            "review_source": "google",
            "Review_user_name": "Image Thoughts Photography",
            "review_date_string": "25 days ago"
        }
    ],
    "review_summary": {
        "0": {
            "site1_Source_logo_url": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/yelp.png",
            "site1_review_count": 296,
            "site1_rating": "3.1",
            "site1_rating_image": "https://s3-us-west-1.amazonaws.com/privypass.image/ratings/pp-3.0-stars@2x.png"
        },
        "accumulative": "5"
    },
    "claimed_business": {
        "id": "179",
        "merchant_lead_id": "580",
        "global_merchant_id": "2084",
        "business_name": "Biryani bowl",
        "phone": "+1-510-247-9264",
        "email": "klmallikarjun@gmail.com",
        "address1": "3988 washington blvd",
        "address2": "Fremont, CA 94538",
        "city": "Fremont",
        "city_id": "518",
        "state": "California",
        "state_id": "5",
        "zip": "94538",
        "about_business": null,
        "website": null,
        "yelp_url": "http://www.yelp.com/biz/biryani-bowl-fremont",
        "tripadvisor_url": null,
        "google_plus_url": null,
        "description": "Biryani bowl",
        "privileges": null,
        "status": null,
        "verification_status": "not verified",
        "registration_date": "2015-09-23 10:15:30",
        "hours_display": "",
        "dollar_range": ""
    }
}',
        ),
    ),
);
