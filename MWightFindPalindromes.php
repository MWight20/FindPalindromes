<!DOCTYPE html>
<html>
<head>
    <title>Find Palindromes</title>
</head>
    <?php 
        /**
         *  'FindPalindromes.php':
         * 
         *      This page allows a user to select a text file where the file contains one word or string. 
         *      After clicking "submit", the file will then be read and each line will be checked to see 
         *      if it is a palindrome or not. If a line is checked and it is a palindrome, that word will 
         *      be pushed into an array.
         * 
         *      After reading each line, the program will then sort through the 
         *      palindrome array and order the list from least number of characters to most number of characters.
         * 
         *      Once sorted, the program then opens a filestream and creates a new file that lists the newly created 
         *      palindrome list, line by line.
         *
         */
    ?>

    <?php

        /**
         *  isPalindrome($fileLine):
         *      This method calculates whether a given string is a palindrome or not.
         *      The $fileLine parameter is a string; a single line in the file that we're reading from.
         *     
         *      The function creates a reversed string from $fileLine and then compares to see if they
         *      are the same string. If yes, $result returns TRUE, else it returns FALSE.
         *
         */
        function isPalindrome($fileLine)
        {
            $reverseArray = array();

            for($i = strlen($fileLine)-1; $i >= 0; $i--)
            {
                array_push($reverseArray, $fileLine[$i]);
            }

            $reverseLine = implode("",  $reverseArray);

            return $result = ($reverseLine == $fileLine) ? TRUE : FALSE;
        }

        /**
         *  sortBylength($a, $b): 
         *      This is a comparison function used by the usort() method which will return an array that is sorted
         *      by the number of characters in each string from least to most.
         */
        
        function sortByLength($a, $b)
        {
            return strlen($a)-strlen($b);
        }

        /**
         * createNewFile($palindromeArray):
         *      This method is used to open a file stream and create a new file named 'palindromesOnly.txt'. 
         *      The '$palindromeArray' parameter is an array of palindrome strings, extracted and sorted from
         *      each line of the original selected text file.
         * 
         *      Each element of the palindrome array is then written to the newly created 'alindromesOnly.txt' 
         *      and a newline character is added to display a single word per line in the newly created file.
         * 
         */
        function createNewFile($palindromeArray)
        {
            $newFile = fopen('palindromesOnly.txt', 'w');
            for($i = 0; $i < count($palindromeArray); $i++)
            {
                fwrite($newFile, print_r($palindromeArray[$i]."\n", TRUE));
            }
            fclose($newFile);

            echo "Created file: 'palindromesOnly.txt'.";
        }
    ?>

<body>
    <h1>Find Palindromes</h1>
    <p> Choose the file you'd like to extract palindromes from: </p>

    <br/>

    <form action="" method="POST">
        <input type="file" name="userFile"/>
        <input type="submit" name="submit" value="Submit">
    </form>
    
    <br/>

    <?php 
        if(!empty($_POST['userFile']))
        {
            $palindromeArray = array();
            $userFile = $_POST['userFile'];
            $lines = file($userFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            for($i = 0; $i < count($lines); $i++)
            {
                if (isPalindrome(strtolower($lines[$i])))
                { 
                    array_push($palindromeArray, $lines[$i]);
                }
            }

            usort($palindromeArray, 'sortByLength');

            createNewFile($palindromeArray);
        }
    ?>

    

</body>
</html>