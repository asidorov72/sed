<?php
/**
 * src/App/Helper/StringHelper.php
 *
 * @author Alexander Sidorov
 * @email alexsidorov1972@gmail.com
 * @date 16-05-2022
 */

namespace Console\App\Helper;

use Exception;

class StringHelper
{
    const RAND_DICTIONARY = ['hello', 'world', 'team', 'ball', 'music', 'Alenochka', 'tea'];

    /**
     * @param int $length
     * @return string
     */
     public static function generateRandomWord(int $length = 4)
     {
         return substr(str_shuffle("qwertyuiopasdfghjklzxcvbnm"),0, $length);
     }

    /**
     * @return string
     */
     public static function getRandomWordOfDict()
     {
         $dict = self::RAND_DICTIONARY;
         $randomKey = array_rand($dict);

         return $dict[$randomKey];
     }

    /**
     * @param int $words
     * @return string
     */
     public static function generateRandomText(int $words = 10)
     {
         $text = '';

         for ($i = 0; $i < $words; $i++) {
             $text .= self::generateRandomWord() . ' ';
             //$text .= self::getRandomWordOfDict() . ' ';
         }

         return trim($text);
     }
}