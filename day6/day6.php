<?php

declare(strict_types=1);

// Работа с файлами и JSON
function loadNotes(string $path): array
{
    $file = file_get_contents($path, true);

    if ($file === false) {
        throw new RuntimeException('File not found or could not be read!');
    }
    if ($file === '') {
        throw new JsonException('Invalid JSON!');
    }
    
    $decodedFile = json_decode($file, true, flags: JSON_THROW_ON_ERROR);

    foreach ($decodedFile as $note) {
        if (
            count($note) > 4
            || !isset($note['id']) && is_int($note['id'])
            || !isset($note['title']) && is_string($note['title'])
            || !isset($note['content']) && is_string($note['content'])
            || !isset($note['created_at']) && is_string($note['created_at'])) 
        {
            throw new UnexpectedValueException('Invalid data in file!');
        }
    }

    return $decodedFile;
}


function saveNotes(string $path, array $notes): void
{
    $notes = json_encode($notes, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    if (file_put_contents($path, $notes, LOCK_EX) === false) {
        throw new RuntimeException('Could not save to file!');
    }
}

function addNote(array $notes, array $newNote): array
{
    if (
        count($newNote) > 4
        || !isset($newNote['id']) && is_int($newNote['id'])
        || !isset($newNote['title']) && is_string($newNote['title'])
        || !isset($newNote['content']) && is_string($newNote['content'])
        || !isset($newNote['created_at']) && is_string($newNote['created_at']))
    {
        throw new UnexpectedValueException('Invalid note data!');
    }

    foreach ($notes as $note) {
        if ($note['id'] === $newNote['id']) {
            throw new InvalidArgumentException("Id is already exists!");
        }
    }

    return array_merge($notes, [$newNote]);
}

function findNoteById(array $notes, int $id): ?array
{
    foreach ($notes as $note) {
        if ($note['id'] === $id) {
            return $note;
        }
    }

    return null;
}

try {
    $notes = loadNotes('notesTest.json');
    
    $newNote = [
        'id' => 2,
        'title' => 'Learn Laravel!',
        'content' => 'Read more routing!',
        'created_at' => '2026-11-09'
    ];

    $notes = addNote($notes, $newNote);

    echo json_encode($notes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL;
} catch (Throwable $e) {
    echo $e->getMessage() . PHP_EOL;
}
