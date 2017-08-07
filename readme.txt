=== Plugin Name ===
Contributors: warren.brown
Donate link: http://www.flmnh.ufl.edu/
Tags: UF, UFAD authentication, login, SAML, shibboleth
Requires at least: 3.2.1
Tested up to: 3.2.1
Stable tag: 1.6

This plugin extends the Shibboleth plugin to work with UFAD & Shibboleth at the University of Florida. Developed at the Florida Museum of Natural History.

== Description ==

Since this plugin extends the Shibboleth plugin, you must first have the Shibboleth plugin, available from http://wordpress.org/extend/plugins/shibboleth/
installed and activated. Otherwise, the plugin will fail to activate as the shibboleth_user_role filter hook will not be registered.

To use this plugin, you must already have the following setup on your server:
1. The above Shibbleth plugin.
2. UF Shibboleth ARP-Groups associated with your URN
3. A UFAD group created for each of the Wordpress roles (administrator, editor, author, contributor, and subscriber).

== Installation ==

1. Install, activate, configure and test the Shibbloeth plugin. When it is working, procede.
1. Create a UGRM directory in `/wp-content/plugins/` directory
1. Extract the contents of the UGRM.tar.gz plugin archive to the `/wp-content/plugins/UGRM` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Populate the 'UFAD Groups to Roles' options page under the 'Settings' menu in Wordpress.

== Frequently Asked Questions ==

= It's not working. What should I check? =

First, check for typos on the options page and ensure you've spelled your UFAD groups correctly.

Second, double check that your Shibboleth SP is vending the UFADGroupsDN attribute from ARP-Groups.
Refer to the UF Shibboleth PHP code examples at http://www.it.ufl.edu/identity/shibboleth/technicalcodeexamples.html
for ideas. If you are unsure what this means, have an adult do this for you.

`If $_SERVER['UFADGroupsDN']` for Apache or `$_SERVER['HTTP_UFADGROUPSDN']` for IIS is not present, then complete
the correct application to add ARP-Groups to your UF Shibboleth URN.

If you verify `$_SERVER['UFADGroupsDN']` is present, check for the value(s) you entered on the plugin options page. If they are not present,
you have UFAD group membership problem. If they are present, check for special characters. The plugin only allows a-z, A-Z, 0-9 and - (as in a hyphen or dash).
If you've used other characters, rename the group to elimated the disallowed characters.

= What if I've done all that and it still doesn't work? =

Contact the plugin author(s), who will respond in a vague and unspecified amount of time.

== Screenshots ==

1.  Plugin Screenshot
2.  Plugin Config Options

== Changelog ==
= 1.6 =
 * Fixed a glaring bug in when "Force Shibboleth return target to HTTPS" was checked and return target was already https the target would be munged to httpss.
 * Discovered Shibboleth on IIS prepends all Shibboleth server variables with a HTTP_ prefix because the variables are populated via CGI as IIS does not support
 environment variables (for details, check out: https://wiki.shibboleth.net/confluence/display/SHIB2/NativeSPAttributeAccess). Plugin now inspects SERVER_SOFTWARE
 variable and adjusts accordingly.

= 1.5 =
 * Fixed header in UGRM.php to resolve current version display on Wordpress site.
 
= 1.4 =
 * Attempting to correct Wordpress SVN tagging for current
 
= 1.3 =
 * Still working on SVN versioning

= 1.2 =
 * New version number to resolve wonkyness with Wordpress SVN.

= 1.1 =
 * Added a configuration option for requiring HTTPS on the return target. This hooks into the Shibboleth provided shibboleth_seesion_initiator_url filter and ensures
the return target uses HTTPS. This allows you seemless provide a Shibboleth integrated Wordpress site where the content side is delivered via HTTP and the admin
side is delivered VIA HTTPS.  The default  Shibboleth plugin behavior is to construct the return target using the current protocol, e.g. if you click the login link from
HTTP, your return target would be for HTTP.  UGRM now allows you to overide this behavior and alwasy use a HTTPS return target.

= 1.0 =
* Initial Release

== Upgrade Notice ==
= 1.6 =
Important upgrade. Bug fix for "Force return target to HTTPS" feature and adds IIS support.

= 1.5 =
Fixed header in UGRM.php to resolve current version display on Wordpress site.

= 1.4 =
Attemtpin to correct the Wordpress SVN current version labeling

= 1.3 =
Still working on SVN versioning

= 1.2 =
New version number to resolved wonkyness with Wordpress SVN.

= 1.1 =
Added functionality to allow UGRM to override return login target to always be HTTPS.

= 1.0 =
Initial Release. 
