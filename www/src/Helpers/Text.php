<?php
namespace App\Helpers;
class Text
{
    public static function excerpt(string $content, int $limit = 100): string
    {
        $text = strip_tags($content);

        if (mb_strlen($text) <= $limit) 
        {
            return $text;
        }
        $lastSpace = mb_strpos($text, ' ', $limit -1);
        if ($lastSpace == NULL){
            return mb_substr($text, 0, $limit) . '...';
        }
        return mb_substr($text, 0, $lastSpace) . '...';
        
    }

}