# phpBB Studio - Battlenet OAuth2 light

## Installation

Copy the extension to phpBB/ext/phpbbstudio/bna

Go to "ACP" > "Customise" > "Extensions" and enable the "phpBB Studio - Battlenet OAuth2 light" extension.

## Application settings:

Login to https://develop.battle.net/access/clients
And create a New Client for your forum.

Specify the "Client name" for your site

Copy and save the `Client ID` and `Client Secret` to use in the `ACP / Client communication / Authentication` page.

## OAuth2 Redirects:

Specify the "Redirect URIs" as

`https://www.example.com/board/ucp.php?mode=login&login=external&oauth_service=studio_battlenet_us`
`https://www.example.com/board/ucp.php?mode=login&login=external&oauth_service=studio_battlenet_en`
`https://www.example.com/board/ucp.php?mode=login&login=external&oauth_service=studio_battlenet_cn`
`https://www.example.com/board/ucp.php?mode=login&login=external&oauth_service=studio_battlenet_apac`

replace `http://www.example.com/board` with your Board's URL ;-D

You can use all or just some of the Regions ;)

## License

[GPLv2](license.txt)
