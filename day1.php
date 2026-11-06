<?php
    //День 1 - Система учёта успеваемости студентов

    function analyzeScores(array $scores) : array {
        $count = 0;
        $average = 0;
        $min = null;
        $max = null;
        $passed = $failed = 0;

        foreach ($scores as $score) {
            $count++;
            $average += $score;
            if ($min === null || $min > $score) {
                $min = $score;
            }
            if ($max === null || $max < $score) {
                $max = $score;
            }
            if ($score >= 60){
                $passed++;
            } else {
                $failed++;
            }
        }

        return [
            'count' => $count,
            'average' => $count > 0 ?$average / $count : null,
            'min' => $min,
            'max' => $max,
            'passed' => $passed,
            'failed' => $failed,
        ];
    }

    echo json_encode(analyzeScores([]));
?>