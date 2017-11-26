## Overview
The atto image accessability is plugin for Moodle Atto editor that use google vision api 
to add automaticly image alternative if it not already set when user upload a new image
and add it to the editor.

The plugin develop by SysBind and it releated on the default image load provide by Moodle.
You are more then welcome to contrib to this plugin

## Installing
### Use the ui plugin install
If your moodle directory is writable by PHP you can upload zip file and the plugin will do
the rest (recommended)
### Upload the files menually
extract the files in lib/editor/atto/plugin/imageaccessability
[Get composer](https://getcomposer.org/download/), 
enter to the plugin directory and run composer install 
```
cd lib/editor/atto/plugin/imageaccessability
composer install
```

### Enabling The Plugin
* In Moodle, go to administrator -> plugin overview, and press 'Update database'.
* You have to be able to create a service account in goole cloud and download json key file.
In this file you will found all the data that require for the plugin settings.
* pay atteantion to [google api priceing](https://cloud.google.com/vision/pricing)
## Settings

Settings can be found at: Site administrator -> Plugins -> Text Editors -> Image accessabilty

Good luck and have fun!
