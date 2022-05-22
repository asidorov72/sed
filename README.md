# sed - cli editor test project.

# Install
1. git clone https://github.com/asidorov72/sed.git 
2. export PATH="$HOME/.symfony/bin:$PATH"
3. composer install

# Usage
File: project_dir/input.txt

Replace 'str1' with 'str2' in the file. 
Result will be printed after that.

> php bin/console sed 's/string1/string2/' input.txt

Replace 'str1' with 'str2' in the file without printing the result.
> php bin/console sed 's/string1/string2/' input.txt --i



