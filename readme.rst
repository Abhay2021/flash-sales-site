###################
# Flash Sales Site MVP
###################

Create a flash sales site where customer save more when shop more.

Admin should be able to create deals with following information:

- title

- description

- price

- discounted price

- quantity

- publish date. 

- An Image


A deal should be publishable if:

- It has all the required attributes, and passes other validations, wherever required.

- No other deal is scheduled to be published on the same date.

  - Only one deal can be live at a time.


Deal will be live for 24 hours only, and every new deal will be published at 10 AM IST. 

The site wuld be membership only site, so customer need to be logged in to see any deal.

The site's home page would be displaying the deal of the day with deal details and buy now button. 

Buy Constraints:

  - Customer can buy one and only one quantity of the deal.

  - Clicking on buy now button should ask for confirmation before placing order. We'll not take any payment or shipping info for now, so the order is placed as soon as customer confirms the order.

  - Also ensure that we do not over sell i.e we sell only 'n' quantities if 'n' quantities were available. Handle race condition here.


- Make sure you deliver your best code (optimized, efficient and expendable). 

- We are looking forward to see your web development skills, in this exercise. 

- Don't implement customer's signup/login functionality. Just seed few customers in DB and switch account passing/changing customer id in cookie/url parameters. Cookie not set or have invalid customer id means customer not logged in. 

- Do not spend too much of time on CSS.

- Let us know the assumptions taken while development, if any.

- Also share the total time spent on the exercise.


Good to have features for plus points:


- Rewarding Returning Customers:     

   - Returning Customer would get additional 1% discount on the discounted price on his every next order and max up to 5%.

     - For example: Customer placing order for the first time would get no additional discount, but would get additional 1% on his second order, similarly 2% on third and so on. 

*******************
Release Information
*******************
make a folder with name "deals"
clone the repositery inside that folder.
admin dashboard : www.abc.com/deals/admin/dashboard/1 (last parameter in url is admin id)
add deals : click on add deals in admin dashboard
admin logout : click logout button in admin dashboard

User dashboard : www.abc.com/deals/user/dashboard/2 (last parameter in url is user id)
shop more : click on add deals in User dashboard
User logout : click logout button in User dashboard



**************************
Changelog and New Features
**************************


*******************
Server Requirements
*******************

PHP version 5.6 or newer is recommended.

It should work on 5.3.7 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

************
Installation
************

Please see the `installation section <https://codeigniter.com/user_guide/installation/index.html>`_
of the CodeIgniter User Guide.

*******
License
*******

Please see the `license
agreement <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/license.rst>`_.

*********
Resources
*********



***************
Acknowledgement
***************


