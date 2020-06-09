<?php
declare(strict_types=1);

namespace App\Adapter;


use DateTime;
use RuntimeException;
use SplFileObject;

abstract class AbstractAdapter
{
    /**
     * @var string
     */
    protected string $file;

    /**
     * @var array|string[]
     */
    protected static array $dateFields = ['date', 'birthday', 'issueDate'];


    public function __construct(string $file)
    {
        $this->file = $file;
    }

    /**
     * @return SplFileObject
     */
    public function open()
    {
        if (is_file($this->file) && is_readable($this->file)) {
            return new SplFileObject($this->file);
        }
        throw new RuntimeException(sprintf('Unable to open \'%s\'', $this->file));
    }

    /**
     * @param array $data
     * @return array
     */

    protected function typecast(array $data): array
    {
        $result = [];
        foreach ($data as $key => $value) {
            if (!empty($value)) {
                if ($key === 'id') $value = (int)$value;
                if (in_array($key, self::$dateFields)) $value = DateTime::createFromFormat('d.m.Y', $value);

            } else {
                $value = null;
            }
            $result[$key] = $value;
        }
        return $result;

    }

    abstract public function getData(): iterable;
}