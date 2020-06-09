<?php
declare(strict_types=1);

namespace App\Adapter;

use RuntimeException;
use SplFileObject;

class CsvAdapter extends AbstractAdapter
{
    private array $keys;


    public function getData(): iterable
    {
        $file = $this->open();
        $file->rewind();
        $file->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY);
        $this->keys = $this->getKeys($file);

        $result = [];
        foreach ($file as $index => $row) {
            if ($index === 0) {
                continue;
            }

            if ($row && count($this->keys) === count($row)) {
                $with_keys = array_combine($this->keys, array_values($row));
                $result[] = (object)$this->typecast($with_keys);
            }

        }

        return $result;
    }

    /**
     * @param SplFileObject $file
     * @return array
     */
    private function getKeys(SplFileObject $file): array
    {
        $data = $file->current();

        if (!is_array($data) || empty($data)) {
            throw new RuntimeException('Wrong data format');
        }

        return array_values($data);
    }
}