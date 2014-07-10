PHP-Wink
========

Early pass at a PHP interface to the Wink Hub (http://www.winkapp.com/) API.
Allows you to query the devices attached to the hub for their current 
state.  

See wink.php for a simple example.  

Credentials
-----------

You need a client ID and secret to talk to the hub as well as your own user credentials.
Right now Wink doesn't have a means to get a key (I've got a support ticket
open with them), but some quick googling will turn up the key pair that the
Android and IOS apps use.

Future Features
---------------

Upcoming versions will support a wider range of connected devices (right
now it falls back to a generic device class if it doesn't recognize the
device type) and the ability to set device states.