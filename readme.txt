=== Cr3ativ Portfolio ===
Contributors: Cr3ativ
Tags: portfolio, filterable
Requires at least: 3.0.1
Tested up to: 4.3
Stable tag: 1.2.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


== Description ==

Easily add as many portfolio items as you'd like, with or without filtering capabilities and use the custom page templates to display a variation of possibilities.  

For your convenience, the plugin also contains a directory called languages, you will find the mo/po files used for this plugin here.



== Required Files ==

Included in the templates directory are 9 templates that require uploading to your current theme’s root directory:

Single Portfolio Page - single-cr3ativportfolio.php
Filter 4 Column - template-portfolio4columnfilter.php
Filter 3 Column - template-portfolio3columnfilter.php
Filter 2 Column - template-portfolio2columnfilter.php
Filter 1 Column - template-portfolio1columnfilter.php
NoFilter 4 Column - template-portfolio4column.php
NoFilter 3 Column - template-portfolio3column.php
NoFilter 2 Column - template-portfolio2column.php
NoFilter 1 Column - template-portfolio1column.php
Portfolio Category Page - taxonomy-cr3ativportfolio_type.php



== Plugin Installation ==

1. Upload the `cr3ativ-portfolio` folder to your to the `/wp-content/plugins/` directory or alternatively upload the cr3ativ-portfolio.zip via the plugin page of WordPress by clicking 'Add New' and select the zip from your local computer.

2. Activate the plugin once uploaded.

3. Inside the 'cr3ativ-portfolio' plugin folder, there is a directory called 'templates', upload the 9 template files into your current theme directory (as mentioned above).

4. You will now see a new post type on the left of the WP admin menu named ‘Portfolio'.

5. Under the ‘Portfolio’ menu option, you will see ‘Portfolio Options’.  You will need to read through this section, you can set your permalink structure for your single portfolio item pages from http://yourdomain.com/cr3ativportfolio/yourportfoliotitle as well as the ‘Portfolio Category’ url from http://yourdomain.com/portfolio-category/yourportfoliocategoryname.  Set these items as you wish and click ‘Save options’.  Then you will need to navigate to Settings > Permalinks and re-save your permalink options (or you will receive 404 not found page errors).


== Creating a Single Portfolio Item ==

1. Click ‘Portfolio > Add New' from your WordPress admin menu.

2. Name your post with your portfolio item name you wish to use.

3. Add regular content including images, text, links or a WordPress gallery as you normally would when creating a post.

4. Below the regular content editor you should see a new section named ‘Portfolio Info’ (if you do not see this then please click the ‘Screen Options’ tab at the top of the page and make sure to select all items to view them).

5. Complete all relevant sections including Date, Client, Link, Link Text, Left Intro Text and Skills - note that if you do not enter information on any or all of these sections then they will simply not display for you.

6. Add a featured image for your portfolio item - this will be used on the main index page displaying all your portfolio items but will not display on the single page, that should be accomplished by simply adding images to your content area.

7. If you will be using a filterable page for your index then you will want to categorize your portfolio items. Doing so is simple and quick. On the right of the page while creating your portfolio item you will see a box named ‘Portfolio Category’ - you can add or assign categories to this portfolio item in the normal method in WordPress.

8. Click ‘Publish’.



== Creating a Portfolio Index Page ==

1. Create a new page in WordPress as normal by clicking ‘Pages’ > ‘Add New’

2. Give your page a name such as ‘Portfolio’ 

3. Select the desired template from the 'Page Templates' drop down on the right of the screen (templates are listed above) and click publish (no content is required).

4. Add your ‘Portfolio’ index page to your menu by going to ‘Appearance’ > ‘Menus’ in the admin and drag or add to your menu.



== Cr3ativ Portfolio Single Page Widget ==

New with update 1.0.5 there is now a widget area for the single portfolio page.  If you navigate to ‘Appearance’ > ‘Widgets’ you will now see a widget area named ‘Cr3ativ Portfolio Single Page’.  This is a full width widget area we added.  You can use whatever widgets you want here (social icons to share/follow etc) or you could use the new drag/drop widget ‘Cr3ativ Portfolio Loop’ and follow the on screen prompts for selecting how many columns, how many to display, if you would like random order (defaults to most recent portfolio item first) and from what category (or All).  This loop/widget will show up at the bottom of the content area on a single portfolio page.


== Screenshots ==

1. Adding a new portfolio item
2. Setting the url format for single portfolio pages
3. Portfolio admin screen
4. Portfolio loop widget

== Styling ==
Styling for these page templates are included in the includes directory under :

/includes/css/cr3ativportfolio.css



== Changelog ==

= 1.2.0 =
Updated templates directory to include missing template for portfolio category page.  If you go to Portfolio > Portfolio Options after the update, you should now see a box to set the slug name for portfolio category.  After you enter your information you will need to go to Settings > Permalinks and click ‘save’ again to flush out the rewrite rules.

= 1.1.0 =
Updated widget section to support WP 4.3.

= 1.0.6 =
Updated admin column view incase short codes are being used and added CSS to column to scroll when a lot of text is used in the intro area.

= 1.0.4 =
* Updated the template files that do not use the filter to add pagination.  This setting is based on the WordPress Settings > Reading selection.

= 1.0.3 =
* Updated single-cr3ativportfolio.php to use the default date for the date picker from the WordPress > Settings > General selection.

= 1.0.2 =
* Updated plugin to include ability to set slug names for single and category pages.

= 1.0 =
* First release.