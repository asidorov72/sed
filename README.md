# sed - cli editor test project.

# Task description
Sed is a stream editor. 
A stream editor is used to perform basic text transformations on an input stream.

Normally sed is invoked like this:

sed SCRIPT INPUTFILE
For example, to replace all occurrences of ‘hello’ to ‘world’ in the file input.txt:

> sed 's/search/replace/' input.txt

Here 's' is the comand for substitude, the word after the first '/' is the word that should be substituted and the word after second '/' is the word with which we will do the substitution.

Sed writes output to standard output. Use -i to edit files in-place instead of printing to standard output.
The following command modifies file.txt and does not produce any output:

> sed -i 's/search/replace/' file.txt

Task:

Implement in any language of your choice a Stream Editor like sed. 
We expect you to implement just the mentioned above featurees - the substitude 's' command and the -i flag for in-place edit. 
Send us back your solution with written unit tests and READ.me file with instructions how to execute/use your code and the unit tests

# What was done
1. Task requirements (commad string was a bit changed)
2. Logger (errors and debug)
3. Tests (phpunit)

# Install
1. git clone https://github.com/asidorov72/sed.git
2. composer install

# Usage
File: project_dir/input.txt

Replace 'search' with 'replace' in the file. 
Result will be printed after that.

> php bin/console sed 's/search/replace/' input.txt

Replace 'search' with 'replace' in the file without printing the result.
> php bin/console sed 's/search/replace/' input.txt --i

# Testing

Navigate the project directory

> cd sed

Run phpunit test

> ./vendor/phpunit/phpunit/phpunit test/SedCommandTest.php




