# Gather

Gather is a highly adaptable theme for displaying products, art, and content.  Choose your own fonts, update colors, or upload a logo using the theme customizer.  Multiple menu locations, social icons, and widget areas are available.  Integrates well with popular plugins like JetPack and Easy Digital Downloads.  Gather is responsive and looks great on all devices.

## Translations

* French (France) : @fxbenard
* Finnish : @samikeijonen

## Installation Instructions

This theme can be installed under "Appearance" > "Themes".  Click on the "Add New" button to upload the theme zip file.

## Developer Instructions

### Grunt

This theme uses Grunt to compile SASS and Javascript.  It also generates translation files, autoprefixes styles, and concats and minifies scripts.

If you have Grunt installed, just run `npm install` in the theme directory to download dependencies.

`grunt watch` can be used while editing SASS and JS.
`grunt release` should be used before browser testing or releasing.

## Change Log

0.9.2
---

* Enhancement: Add social icon for SoundCloud

0.9.1
---

* Fix: Customizer styles for secondary menu

0.9.0
---

* Update: Minimum height for tweet embeds
* Update: Display search results in masonry grid
* Update: Latest version of Customizer Library
* Fix: Make additional menu design strings translatable in customizer
* Fix: Navigation styling options in customizer

0.8.0
---

* Fix: 2px Menu toggle offset in Firefox
* Fix: Fix footer issue in IE11
* Update: Display excerpts on archives if available
* Enhancement: Filter title if EDD archive is set as home page

0.7.0
---

* Enhancement: Better support for changing image sizes
* Enhancement: Basic bbPress Support
* Enhancement: Editor Styles
* Translations: es_ES
* Fix: Make theme update strings translatable

0.6.0
---

* Enhancement: Favicon and Apple Touch icon support
* Enhancement: Basic Event Calendar Support (https://wordpress.org/plugins/the-events-calendar/)
* Enhancement: Option to display download archive on front page
* Enhancement: Download taxonomies displayed by default
* Enhancement: Sticky footer
* Enhancement: Full Width Page Template
* Enhancement: Author Box
* Translations: fr_FR (French) props @fxbenard
* Translations: fi (Finnish) props @samikeijonen
* Fix: Tumblr url detection for social menu

0.5.0
---

* Enhancement: Support RTL layouts
* Update: Post padding styles
* Fix: EDD masonry layouts
* Fix: Make sure post content clears
* Fix: Footer widget columns with more than 3 widgets
* Fix: Require jquery when loading minified scripts

0.4.0
---

* Enhancement: Better menu transitions
* Update: Display post archives in same format as standard archives
* Fix: Missing drop down indicator in menus

0.3.0
---

* Enhancement: Option to display archive excerpts
* Enhancement: Option to display archive featured images
* Update: Display featured images full-bleed in masonry layout only
* Fix: Apply primary color styling to "View More" background
* Fix: Apply primary color styling to archive page header
* Fix: Icon font loading

0.2.0
---

* Enhancement: More efficient font loading
* Update: Use bundled WordPress version of masonry.js
* Fix: Post dates option
* Fix: Featured image option

0.1.0
---

* Public release