# A Stuff Exchange Website
* FRONT-END: HTML5, CSS, Javascript, JQuery, AJAX
* BACK-END: PHP7.2, MYSQL DB

###Different User Levels
As what I proposed in project proposal document, there are two different
user levels, and they have different access to the database.

Guest users do not have accounts
Authenicated users account: 123456789
password: 123456789
the password was secure hashed into tokens and saved in the database

|User Levels  | Create Items | Update Items   | Delete Items | View Items|
|---|---|---|---|---|
| Guest User  | NO  | NO  | NO  | YES |
| Authenticated User  | YES  | YES  | YES  | YES|

Since the website designed by a P2P business model, so guest users do not have
access to the database until they sign up as an authenticated user.

###Responsive
Bootstrap UI framework was used to make the webpages responsive. Most of the
columns were given multiple class attributes to match different device views.

Example: `<div class="row row-cols-1 row-cols-md-2"> `


### Data Analysis and reporting techniques
JQuery & Ajax are frequently used among the webpages.
- Sign in: call `$.ajax()` on `keyup()` events, if the combination is not correct
, it will show a red line indicating wrong combinations. Otherwise,
it will show a green line indicating login successfully.

- Sign up: Since the data input by user will be insert into the database, I used jquery for 
input validation on the client side. Then the user inputs are passed by ajax to check if the username
already exist in the database. The returned output will be shown on the form without refreshing
because of the AJAX features.

- Filter: I add a filter beside item lists, allow users to sort items by price
from low to high / high to low. 

- Search items in search bar: AJAX was used to dynamically show the search results
in the search bar. It was called by `keyup()` events.



