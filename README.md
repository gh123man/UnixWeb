Team Project Readme!
====================
Here you will find all you need to know about the site structure. Look for these docs in each folder of the site.

FYI: the format of this file is markdown: [Info here](https://help.github.com/articles/github-flavored-markdown/)

A nice markdown editor can be found [here](http://dillinger.io/)


The root folder
---------------

This is the site root. It contains important files for routing and our whole file structure.

####Some notes
 - do not delete your .git folder, its contents are gits meta data
 - never put html in the 'src' folder. that is for framework code.
 - only static data goes in 'static' (images, javascript, css)
 - only flat file content and minimal HTML goes in the 'content' folder


Setup Guide
-----------

###Windows

#### A) set up apache
1. Install Wamp
2. ensure browsing to "localhost" works
3. enable the rewrite engine
    1. left click on tray icon
    2. go to apache
    3. apache modules
    4. check rewrite module (mod rewrite)

#### B) get the code
1. open the windows github client
2. download the source to a temp area (your desktop)
3. ensure "show hidden files" is enabled
4. copy all of the source files out of the repo directory (including the .git folder!)
5. paste the files into the ROOT of your /www/ folder.
6. browse to "localhost" and ensure the page renders
7. now, follow very carefully. open the git client, right click on our repo and hit remove.
8. go to /www/ and go up one directory.
9. drag the /www/ folder into the git client and it will import the code properly, connect and sync. MAGIC!


Please edit this or reach out to me if it sucks - Brian
