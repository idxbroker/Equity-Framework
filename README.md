Equity Framework
===
Equity Framework is a WordPress theme framework for Real Estate Themes by IDX, LLC.


Changelog

== 1.7.13 ==
* New: Google My Business option added to Equity Theme Settings
* Fix: Compatibility fix for IMPress for IDX Broker 3.0+

== 1.7.12 ==
* New: Completed Font Awesome 5 transition
* Fix: Minified CSS file

== 1.7.11 ==
* Fix: Resolves issue with custom CSS section not loading correctly
* Fix: Rest route registration warning

== 1.7.10 ==
* Fix: Removed reference to Google+

== 1.7.9 ==
* New: Font Awesome 5 added

== 1.7.8 ==
* Fix: State is now shown in the Equity Quick Search widget's city list

== 1.7.7 ==
* Feature: IDX HOME - Equity featured page widget now supports community pages

== 1.7.6 ==
* Update: Rebranded Agent Evolution to IDX, LLC

== 1.7.5 ==
Release: 08.23.2018
* Fix: Update link to Font Awesome cheatsheet in Icon Box widget.
* Fix: Update CMB2 library for custom metabox creation in child themes.

== 1.7.4 ==
Release: 04.11.2018
* New: IDX Sitemap URL is now retrieved from API. Feed URL metabox field removed from Theme Settings.
* New: Saved links in widgets will now use clients/savedlinks API endpoint, no longer requiring Equity license and URL validation.
* Fix: Header right menu alignment issue in some themes.
* Fix: Carousel scripts only loading when necessary.

== 1.7.3 ==
Released: 03.01.2018
* New: Added skip links for themes that have declared accessibility support
* Fix: Extra quote removed from icon box shortcode output
* Fix: Removed duplicate input from Post Carousel widget admin
* Fix: Featured Listings scroller widget script updated for compatibility
* Update: CMB2 library
* Update: TGMPA library

== 1.7.2 ==
Released: 01.24.2018
* Fix: Changed alt text on carousel widget due to display issues
* Fix: Changed how quick search hidden fields are added with equity_idx_quick_search_hidden_fields action

== 1.7.1 ==
Released: 01.23.2018
* Fix: Update Equity IDX Carousel script to v2 to prevent conflicts

== 1.7.0==
Released: 01.23.2018
* New: Icon box shortcode now available as a widget.
* New: Featured Page Carousel widget is now a Featured Post Carousel and allows display of posts from any of the same post type.
* New: Added agent selection to Equity IDX Carousel and Showcase widget to filter properties by agent.
* New: Added equity_header_right and equity_after_header_right action hooks
* New: Added filters for equity_off_canvas_open_markup and equity_off_canvas_close_markup
* New: Functions for flexible width widgets in themes
* New: Filters for Equity IDX Carousel and Showcase widget HTML using equity_idx_carousel_property_html and equity_idx_showcase_property_html
* New: Added filters for property widget and search URL suffixes for adding multisite support with IMPress for IDX 2.4+
* Fix: PHP warnings for social_icons shortcode in PHP7+

== 1.6.6 ==
Released: 08.11.2017
* Fix: Footer output filters being applied incorrectly causing no output
* Fix: Change FontAwesome enqueue priority so WP handles versioning correctly
* Update: FontAwesome version to 4.7.0 and URL source

== 1.6.5 ==
Released: 04.18.2017
* Fix: Removed Equity Lead Signup widget and shortcode in favor of IMPress signup widget with reCaptcha for added security

== 1.6.4 ==
Released: 02.16.2017
* Fix: schema.org validation errors
* Fix: Equity site logo now uses core functions
* Fix: Updated 401 error code admin alert with more information

== 1.6.3 ==
Released: 12.06.2016
* Fix: Issue with WP 4.7+ where Equity layout choices would no longer display or function
* Fix: schema.org markup error on wrapper post type template
* New: Added support for selective refresh of widgets in WP 4.6+

== 1.6.2 ==
Released 10.06.2016
* Fix: Bug with listing scroller widget not displaying on paginated page
* Fix: Removed historical as option in IDX widgets as its no longer available via API
* Fix: IDX domain check logic

== 1.6.1 ==
Released 09.13.2016
* Fix: Removed unusued sample property data function

== 1.6.0 ==
Released: 08.12.2016
* Added: IDX Property widgets will use fullDetailsURL if it exists
* Added: WP API endpoint for support
* Fix: Fatal error in WP 4.6+ due to change in WP_Post_type object 
* Fix: IDX components loading with plugin inactive
* Fix: Remove data-equalizer markup from footer widgets
* Fix: Include widget defaults on front end
* Update: Font Awesome version to 4.6.3

== 1.5.10 ==
Released: 06.14.2016
* Fix: Only output disclaimer markup if it exists
* Fix: PHP error when using a saved link with no results in widget or shortcode

== 1.5.9 ==
Released: 06.02.2016
* Fix: PHP error for disclaimers in widgets and shortcodes
* Fix: Modify search not carrying over original city values
* Added: Yelp to social icons shortcode

== 1.5.8 ==
Released: 05.05.2016
* New: Added error handling for IDX lead signup widget and shortcode
* Enhancement: Added required disclaimers and courtesies to IDX Carousel and Showcase widgets
* Fix: Added admin notice if Equity API returns 401 unauthorized
* Fix: Increase timeout for API calls

== 1.5.7 ==
* Fix: Update property widgets to account for image return change

== 1.5.6 ==
* Added: Ability to set a static page for the front page
* Added: Ability to set a listing post as the front page
* Fix: Equity Page Carousel was limited to admin setting for blog pages show number
* Fix: Property widgets showed unrendered shortcodes on some Turn Key sites

== 1.5.5 ==
* Fix: Issue with property showcase shortcode output
* Fix: Add Theme Settings field for IDX URL for use in dev environments or when it doesn't match WP site_url()

== 1.5.4 ==
* Fix: Issue with Equity/IDX key validation method

== 1.5.3 ==
* New: Support for native WP site icon, instead of Equity functions
* New: Add Equity Layout and Equity Scripts support to the idx-wrapper post type
* Update: Footer settings page
* Update: Equity property widgets changed to use single address field to prevent wierdness when parsing address parts
* Update: Font Awesome version to 4.5.0
* Update: IDX listing importer moved to IMPress Listings plugin

== 1.5.2 ==
* Fix: Slow loading WP Admin
* Update: Conditionally not load some IDX components if they already exist

== 1.5.1 ==
* Fix: Add conditional to register IDX page post type in preparation for upcoming IDX Broker plugin update
* Note: Do not use the "Equity IDX Pages" in your Menus as this will be removed completely in a future version due to its inclusion in the IDX Broker plugin 1.3
* Fix: Update Shortcode UI parameters due to update in Shortcake plugin
* Fix: Delete Single listing transient if it's empty

== 1.5 ==
* New: Added ability to import IDX listings as custom post type in WP Listings plugin
* New: Added listing_meta shortcode to display listing post type meta data on single listings
* New: Added shortcodes for Equity IDX widgets (Showcase, Carousel, City Links, Lead Login, Lead Signup)
* Fix: Removed demo MLS ID that caused errors for some users

== 1.4.1 == 
* New: Added Clear IDX Dynamic Wrapper Cache button
* New: Added CMB2 Library
* Enhancement: Add the_content filter to wrapper post type
* Fix: Author box now turns off as expected

== 1.4 ==
* New: IDX Saved Links now available in Equity Carousel and Showcase property widgets
* Update: Font Awesome icons updated to v4.4.0

== 1.3.7 ==
* Fix: Remove fastclick.js due to bug with UI interaction on mobile OS's

== 1.3.6 ==
* New: Filters for Equity IDX Quick Search widget field labels
* New: Added support for WP Engine GeoIP on Equity IDX property widgets (for TurnKey Complete only)
* Fix: Phone number field on Equity IDX Sign Up widget
* Fix: Update widgets to use PHP5 style object constructors
* Fix: Updated Advanced Search link on Equity IDX Quick Search widget
* New: Included Equity child theme updated to magazine style layout

== 1.3.5 ==
* Enhancement: Added fallback image for properties that have no image in Equity - IDX property widgets
* Enhancement: Changed IDX data caching time as WP transients to 2 hours
* Enhancement: Function added to use minified CSS (style.min.css) if that file exists in the child theme folder
* Update: Change Equity custom CSS function priority to load after others without a priority
* New: Added validation for Equity subscribers, added domain header to API requests

== 1.3.4 ==
* Fix: Featured post widget title and meta not showing up on wrapper post type
* New: Filters for IDX wrapper post types opening and closing markup
* Updated: Foundation 5.5.1

== 1.3.3 ==
* New: Added Equity - Featured Page Carousel widget
* Update: Update Shortcode UI plugin to wordpress.org source as it is now a feature plugin, planned for inclusion in core.
* Enhancement: Improve microformat support for post date and author
* Fix: Left aligned post image with caption padding
* Fix: Change IDX sitemap `<link>` rel attribute to sitemap

== 1.3.2 ==
* Fix: Author box not output on archive pages if selected

== 1.3.1 ==
* Fix: Error in icon box shortcode markup

== 1.3 ==
* New: Support for Shortcode UI via Shortcake plugin for all content shortcodes (See: https://github.com/fusioneng/Shortcake/)
* New: Added Shortcake as a recommended plugin
* New: Author box feature to optionally display author bio on posts
* New: Redirect to custom feed URL in Theme Settings
* New: Field added for IDX Broker listings sitemap XML
* New: Shortcode added for [idx_sitemap] to output link to IDX sitemap
* New: Phone number option added to IDX Lead Sign up widget
* New: [agent_phone] and [agent_email] shortcodes modified to accept icon parameter (accepts Font Awesome icon CSS classes)
* Enhancement: Removed app.js to reduce HTTP requests. app.js now merged with theme.js.
* Fix: Bug that would reset settings saved in Customizer

== 1.2 ==
* New: Add support for Foundation off canvas menu
* New: Sample blog child theme included
* New: Add support for new Jetpack site logo feature
* Update: Upgrade to Font Awesome 4.2 icons
* Update: Foundation updated to 5.4.7

== 1.1.4 ==
* Fix: IDX Wrapper post type not showing custom content before IDX content

== 1.1.3 ==
* Fix: Bug that would not show the theme screenshot or current version number on Updates page

== 1.1.2 ==
* Fix: Issue with shortcodes being stripped when nested inside column shortcodes

== 1.1.1 ==
* New: IDX Start/Stop tags automatically added to Wrapper post type
* New: IDX Showcase widget now gives option to not display image
* New: Testimonial shortcode
* Fix: CSS clear fix for quick search widget button
* Fix: Add CSS for IDX wrapper and IDX form elements

== 1.1 ==
* New: IDX components and widgets added
** Quick Search – Horizontal or vertical orientation
** City Links
** Property Carousel
** Property Showcase
** Lead Login
** Lead Signup
* New: Default CSS Styling for Equity IDX widgets
* Fix: Removed license deactivation on theme change function
* Update: Updated translation pot file

== 1.0.1 ==
* Fix: Top header widget areas adding extra markup

== 1.0 ==
* Initial release
