## Overview
The Google Drive file module enable a teacher to create a new file of type: Document, Presentation, SpreadSheet or MindMup (Mindmap)
On the teacher's own Google account, and give writing or commenting permissions to some or all the students in the course.
Student's must have a Google account for getting write access, and any other type of email for just making comments.

Initially, when starting a new document, a teacher will be asked to approve "offline" permission for the Moodle to create and manage
 the new files in the teacher's Google drive account. the permission is good for X amount of time and will expire afterwards, at that time
 the teacher will be ask to extent his/her permission for Moodle to act on his/her behalf again.

## Installing
Use the command line to run the following command from your root Moodle folder:
```
git clone https://github.com/nadavkav/moodle-mod_googledrive.git mod/googledrive
```
Or Download the plugin as a ZIP file and open it into mod/googledrive

[Get composer](https://getcomposer.org/download/), 
cd into mod/googledrive

And run `php composer.phar require google/apiclient:^2.0`

### Enabling The Plugin
* In Moodle, go to administrator -> plugin overview, and press 'Update database'.
* Make sure Google drive repository is setup correctly 
(navigate to: Site administration -> Plugins -> Repositories -> Google Drive)
Follow the instructions concerning setting up a Google developer account and enabling Google Drive SDK API privileges. 

## Settings

Settings can be found at: Site Administration -> Plugins -> Activity Modules -> Google Drive

## Unresolved issues
* We are currently using the latest Google Drive API v2, as Moodle 3.1 core Google SDK API is using an older version which is missing
important functionality. As it is causing some conflicts, I am not using the Moodle HTML Editor with the Intro form field and just 
a simple textarea box. This should be solved in future versions :-)

## TODO 
* Be able to choose an already available document
* Share the document manually by the teacher, at a later time. (after the teacher put some content into the document, and not immediately as the module was added to the course)

Good luck and have fun!
