**Note: this is a list of commands to be used in the website. These need to be inserted in a database with respective definitions**

## Listed alphabetically

###bg
Category: Process Management

--------------------

###cal
Category: System Info

----------------

###cat
Category: File 
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

-------

###cd
Category: File
Definition: changes the current working directory. cd stands for "current directory" 

See **Directory Structure** for more information

Additional explanation: Unix shells use a tree system. The root directory is represented by "/" whereas
the current directory is represented by "."
To move up to the parent directory in the tree, you can use ".."
A "/" separates the names of file 


Uses:
+ cd /
  + changes the directory to the root directory
+ cd directoryName
  + changes to the directory
+ cd /path/directoryName
+ cd ~
   + ~ represents our username
   +  will function the same as typing cd /home/username

Examples:
+ cd Links
+ cd /330/Links
+ cd ../..
+ cd ..
+ cd ~
+ cd /

------------

###chmod
Category: File Permissions

------------------

###cp
Category: File

--------------

###date
Category: System Info

--------------

###df
Category: System Info

----------

###dig
Category: Network

--------------

###dpkg
Category: Installation

---------

###du
Category: System Info

--------------

###finger
Category: System Info

-----------

##free
Category: System Info

---------

###fg
Category: Process Management

---------------

###grep
Category: Searching

------------

###gzip
Category: Compression

--------

###head
Category: File 

----------

##kill
Category: Process Management

---------

###ln
Category: File

--------------

###make
Category Installation

----------

###man
Category: System Info

---------

###mkdir
Category: File
Definiton: creates a directory.

Options:
+ -m / --mode
  + set the file mode (see **chmod**)
+ -p / --parents
  + create parent directory
  + if directory exists, no response will appear
+  -v / --verbose
  + prints a message for each created directory
+  -Z / --context
  + sets the SELinux security context
+  --help
  + displays help message
  + will exit after
+  --version
  + displays the version information
  + will exit after

Uses:
+ mkdir directoryName
+  mkdir -m a=rwx directoryName
  + creates directory
  + m = mode
  + sets permissions (a=rwx) to read, write, and excuete)
    + see **permissions**
  + mkdir - p /path/directory/directory2
    + creates a directory at that path
    + if parent directories do not exist, will create them

Examples:
+ mkdir /330/Links
+ mkdir -m a=rx Links
+ mkdir p /home/330/Links/a/b/c

-------------
###more 
Category: File


------------------

###mv
Category: File

-------------
###pwd
Category: File
Defintion: prints the current working directory. you can use it to find the full path to the current directory,
store the full path, and verify the physical path.

Options:
+ -L
  + displays the logical current working directory
  + causes the pwd to use a $PWD environment despite symlinks
  + see **_**
+ -P
  + defualt
  + displays the physical current working directory
+ /bin/pwd -- version
  + displays the pwd command version
+ /bin/pwd --help
  + diaplays information about the pwd

Uses:
+ pwd
  + prints the path
+ x=$(pwd)
  + stores the path
  + can do with the variable
    + echo "The current working directory: $x"
    + printf "The current directory is: %s" $x
+ type -a pwd
  + shows all locations containing an excueetable named pwd
+ 

------

###rm
Category: File

-----------

###ssh
Category: SSH

-------------

###tail
Category: File

-----

###top
Category: Process Management

-------------

###touch 
Category: File

-------




