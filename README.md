Craft Sitemap Plugin
=====================

### Summary

This is a plugin for the Craft CMS to add sitemap generation functionality. Based on the options you select for your Sections, it provides a sitemap.xml endpoint that automatically includes all the entries of the sections you selected.  Entries must be live to be included.

###Installation

1. Clone this project into `craft/plugins/sitemap`
2. Install the plugin through the Craft admin panel

###Usage

1. Click Sitemap on Control Panel Navigation
2. Select the checkbox of Sections you would like included in your sitemap.xml file
3. Select the frequency in which you believe changes will be made to the Entries in each Section.
4. Select the priority of included files. 1.0 is the highest priority and 0.0 is the lowest.
5. Either click
    - 'Save' to just save your configurations.
    - 'Save & Ping' to save configurations, and ping search engines to let them know to crawl your site

###Optional Widget

This plugin has a built-in widget for the Dashboard that tells you the date and time of your last search engine ping.
However, it is not enabled by default and must be added by clicking the 'cog' next to the heading 'Dashboard', clicking the 'New Widget' button, and selecting the 'Last Sitemap Ping Date' widget.
