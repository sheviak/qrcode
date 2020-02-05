# Qr-code coding and decoding website
This website have simple interface. Allows you to create and decode Qr-code.

![website](https://user-images.githubusercontent.com/25076062/73794403-0d87ab80-47b1-11ea-878a-c464640e10ba.png)

## Views
Project have one master page with set default paremetrs in particular:
- foregroud color
- backgroud color
- margin
- size (px)
- error correction
- format output file
- and opportunity to added logo to your qr-code

and 8 partial views, in particular:

- link
- email
- geoposition
- telephone
- sms
- Wi-Fi
- vCard
- decode qr-code

## Localization
All views are localized in three languages: en, ua, ru. The selected language is saved in session.

## Used tech
Used a number of open source projects to work properly:
* [Laravel](https://laravel.com/) - is a free, open-source PHP web framework, intended for the development of web applications following the model–view–controller (MVC) architectural pattern and based on Symfony. 
* [Bootstrap](https://getbootstrap.com/) - great UI boilerplate for modern web apps
* [jQuery](https://jquery.com/) - is a JavaScript library designed to simplify HTML DOM tree traversal and manipulation, as well as event handling, CSS animation, and Ajax.
* [PHP](https://www.php.net/) - scripting development language
* HTML5

## Installing
- download project
- added in server
- update in composer 

    ```sh
    $ composer update
    ```
- add folders: qrcode_images, logo, decode_qrcode on the way to:
    - project_name/public/qrcode_images
    - project_name/public/decode_qrcode
    - project_name/public/logo
- run website

Please make sure that you are using the version of PHP 7+

## Version
Created first version website to coding and decoding Qr-codes

## Todo
- create data validation on frontend and backend

## Authors
[Sheviak Kyrylo](https://mssg.me/sheviak.k) - developer and UI designer.
