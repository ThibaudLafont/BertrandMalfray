<?php
namespace App\Entity\Enumerations;

class ImageDisplay
{

    /**
     * Constants keys for DB persists
     */
    const FLOAT_RIGHT = "right";
    const FLOAT_LEFT = "left";
    const CENTER = "center";

    /**
     * String to display by cont key
     *
     * @var array
     */
    private static $values = [
        self::FLOAT_RIGHT => "float-right",
        self::FLOAT_LEFT => "float-left",
        self::CENTER => "center"
    ];

    /**
     * Return the differents availables keys
     *
     * @return array
     */
    public static function getAvailableTypes() : array
    {
        return [
            self::FLOAT_RIGHT,
            self::FLOAT_LEFT,
            self::CENTER
        ];
    }

    /**
     * Permit to get a value related to a key
     *
     * @param $key string
     *
     * @return mixed|string
     */
    public static function getValue(string $key) : string
    {
        if (!isset(self::$values[$key])) {
            return "Unknow " . get_called_class();
        } else {
            return self::$values[$key];
        }
    }
}