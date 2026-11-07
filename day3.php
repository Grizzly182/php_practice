<?php
    function analyzeComment(string $text) : array
    {
        // Обрезаем лишнее
        $text = trim($text);
        
        $text = preg_replace('/\s+/', ' ', $text);

        // Если строка пустая, то сразу возвращаем
        if ($text === '') {
            return [
                'text' => $text,
                'char_count' => 0,
                'word_count' => 0,
                'is_valid' => false
            ];
        }

        $strLength = mb_strlen($text);

        return [
            'text' => $text,
            'char_count' => $strLength,
            'word_count' => count(preg_split('/\s+/', $text)),
            'is_valid' => $strLength >= 10 && $strLength <= 500
        ];
    }

    echo json_encode(analyzeComment("PHP rocks!"));