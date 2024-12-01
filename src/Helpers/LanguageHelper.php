<?php

namespace Atin\LaravelBlog\Helpers;

use Atin\LaravelBlog\Enums\WritingSystem;

class LanguageHelper
{
    public static function detectWritingSystem(?string $text = ''): WritingSystem
    {
        $text = substr($text, 0, 1000);
        $logographicCount = 0;
        $alphabeticCount = 0;

        // Regular expression to match logographic characters (e.g., Chinese characters, Japanese Kanji)
        $logographicPattern = '/[\x{4e00}-\x{9fff}\x{3400}-\x{4DBF}\x{20000}-\x{2A6DF}\x{2A700}-\x{2B73F}\x{2B740}-\x{2B81F}\x{2B820}-\x{2CEAF}\x{F900}-\x{FAFF}\x{2F800}-\x{2FA1F}'.
            '\x{3040}-\x{309F}\x{30A0}-\x{30FF}\x{AC00}-\x{D7AF}]/u';

        // Regular expression to match alphabetic characters (Latin, Cyrillic, etc.)
        $alphabeticPattern = '/[a-zA-Zа-яА-ЯёЁáàäâãåāæçèéêëíìîïíïłñóòôøōœśùúüûýÿżź]/u';

        // Regular expression to match ignored characters (spaces, punctuation, digits, etc.)
        $ignoredPattern = '/[\s\p{P}\d]/u';  // \s - spaces, \p{P} - punctuation marks, \d - digits

        // Iterate through each character in the text
        $textLength = mb_strlen($text);
        for ($i = 0; $i < $textLength; $i++) {
            $char = mb_substr($text, $i, 1);

            // Skip characters that are spaces, punctuation, or digits
            if (preg_match($ignoredPattern, $char)) {
                continue;
            }

            // Check for logographic characters
            if (preg_match($logographicPattern, $char)) {
                $logographicCount++;
            }
            // Check for alphabetic characters
            elseif (preg_match($alphabeticPattern, $char)) {
                $alphabeticCount++;
            }
        }

        // Compare the counts of each writing system and return the predominant one
        if ($logographicCount > $alphabeticCount) {
            return WritingSystem::Logographic;
        }

        return WritingSystem::Alphabetic;
    }
}
