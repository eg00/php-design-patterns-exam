<?php
declare(strict_types=1);

namespace App\Adapter;

use RuntimeException;

class JsonAdapter extends AbstractAdapter {

    public function getData(): iterable
    {
        $file = $this->open();
        $data = $file->fread($file->getSize());

        $result = json_decode($data, false);

        if (!is_iterable($result)) {
            throw new RuntimeException('Wrong data format');
        }

        foreach ($result as $index=> $item) {
            $result[$index] = (object)$this->typecast((array) $item);
        }
        return $result;
    }
}