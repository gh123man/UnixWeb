**Note: this is a list of commands to be used in the website. These need to be inserted in a database with respective definitions**

## Listed alphabetically



###cat
Definition: concatenates (or appends) and displays files.
The command will display file contents to a screen. You can also use the command
to create a file as well as read/write to it. 

Uses: 
+ cat filename
  + displays a file
+ cat > filename
  + creates the file
+ cat file | command
  + view a large file with cat command
  + use "| more" or " | less" to view the file in parts
+ cat file1 file2 > file3
  + combines two or more files into one
+ cat >>file
  + add to existing file
  + can be binary or a rar file as well (.bin / .rar)
  + must follow this command with text to enter
  + enter "ctrl-D" to stop entering text
+ cat -n file
  + numbers each line of the output
  + also can type cat --number file
+ cat *
  + view all files
  + can be used to view all of a specific file
    + cat *.html
+ cat /proc/(system info)
  + can use to see LINUX information
    + meminfo
    + cpuinfo
    + version
+ tac filename
  + conceates files in reverse
  + can also use:
    + cat filename | tac
    + tac <<< "$myFileName"


Examples:
+ cat helloWorld.txt
+ cat > hellowWorld.txt
+ cat /links/helloWorld.txt
+ cat helloWorld | more
+ cat helloWorld.txt byeWorld.txt > helloBye.txt
+  cat >>helloWorld.txt
  + This world is nice. <ctrl-D>
+ cat -n helloWorld.txt
+ cat *
+ cat *.html
+ cat /proc/cpuinfo
+ 


