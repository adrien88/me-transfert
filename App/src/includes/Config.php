<?php

namespace App;

/**
 * Config class to handle Datafile like it.
 * 
 */
class Config
{
    use DataFile;

    function __construct(string $name)
    {
    }

    function load(string $path)
    {
        if (file_exists($path)) {
            $this->data = include $path;
            $this->path = $path;
            return true;
        }
        return false;
    }

    /**
     * 
     */
    function save(string $filename)
    {
        $str = $this->formatData($this->data);
        return file_put_contents($this->path, $str);
    }

    /**
     * 
     */
    function formatData(array $data, int $lvl = 0): string
    {
        $str = (0 == $lvl) ? '<?php return [' : '[';
        foreach ($data as $key => $value) {
            if (preg_match('/[\w]+/i', $key)) {
                $str .= '\'' . $key . '\'=>';
                $str .= $this->formatValue($value);
            }
        }
        $str .= (0 == $lvl) ? '];' : '],';
        return $str;
    }

    /**
     * 
     */
    function formatValue($value)
    {
        if (is_array($value)) {
            return $this->formatData($value, 1);
        } else if (is_string($value)) {
            $value = str_replace('\'', '\\\'', $value);
            return '\'' . $value . '\',';
        } else if (is_bool($value) && true == $value) {
            return 'true,';
        } else if (is_bool($value) && false == $value) {
            return 'false,';
        } else {
            return '' . $value . ',';
        }
    }
}
