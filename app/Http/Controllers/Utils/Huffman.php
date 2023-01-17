<?php

namespace App\Http\Controllers\Utils;

use Exception;

class Huffman
{
    private $dictionary = null;

    public function setDictionary(HuffmanDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function getDictionary()
    {
        return $this->dictionary;
    }

    public function unsetDictionary()
    {
        $this->dictionary = null;
    }

    public function encode($data): string
    {
        if (!is_string($data)) {
            $data = serialize($data);
        }
        if (empty($data)) {
            return '';
        }
        if ($this->dictionary === null) {
            $this->generateDictionary($data);
        }
        $binaryString = '';
        for ($i = 0; isset($data[$i]); ++$i) {
            $binaryString .= $this->dictionary->get($data[$i]);
        }
        $splittedBinaryString = str_split('1'.$binaryString.'1', 8);
        $binaryString = '';
        foreach ($splittedBinaryString as $i => $c) {
            while (strlen($c) < 8) {
                $c .= '0';
            }
            $binaryString .= chr(bindec($c));
        }
        return $binaryString;
    }

    /**
     * @throws Exception
     */
    public function decode($data): string
    {
        if (!is_string($data)) {
            throw new Exception('The data must be a string.');
        }
        if (empty($data)) {
            return '';
        }
        if ($this->dictionary === null) {
            throw new Exception('The dictionary has not been set.');
        }
        $binaryString = '';
        $dataLength = strlen($data);
        $uncompressedData = '';
        for ($i = 0; $i < $dataLength; ++$i) {
            $decBin = decbin(ord($data[$i]));
            while (strlen($decBin) < 8) {
                $decBin = '0'.$decBin;
            }
            if (!$i) {
                $decBin = substr($decBin, strpos($decBin, '1') + 1);
            }
            if ($i + 1 == $dataLength) {
                $decBin = substr($decBin, 0, strrpos($decBin, '1'));
            }
            $binaryString .= $decBin;
            while (($c = $this->dictionary->getEntry($binaryString)) !== null) {
                $uncompressedData .= $c;
            }
        }
        return $uncompressedData;
    }

    public function generateDictionary($data)
    {
        if (!is_string($data)) {
            $data = serialize($data);
        }
        $occurrences = array();
        while (isset($data[0])) {
            $occurrences[] = array(substr_count($data, $data[0]), $data[0]);
            $data = str_replace($data[0], '', $data);
        }
        sort($occurrences);
        while (count($occurrences) > 1) {
            $row1 = array_shift($occurrences);
            $row2 = array_shift($occurrences);
            $occurrences[] = array($row1[0] + $row2[0], array($row1, $row2));
            sort($occurrences);
        }
        $this->dictionary = new HuffmanDictionary();
        $this->fillDictionary(is_array($occurrences[0][1]) ? $occurrences[0][1] : $occurrences);
    }

    private function fillDictionary($data, $value = '')
    {
        if (!is_array($data[0][1])) {
            $this->dictionary->set($data[0][1], $value.'0');
        } else {
            $this->fillDictionary($data[0][1], $value.'0');
        }
        if (isset($data[1])) {
            if (!is_array($data[1][1])) {
                $this->dictionary->set($data[1][1], $value.'1');
            } else {
                $this->fillDictionary($data[1][1], $value.'1');
            }
        }
    }
}
