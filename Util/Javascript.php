<?php

namespace Biliboo\ChartBundle\Util;

/**
 * Description of Javascript
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
class Javascript  implements \JsonSerializable
{
    const START = '<![JAVASCRIPT[';
    const END   = ']JAVASCRIPT]>';

    /**
     * @var string
     */
    protected $content;

    /**
     * @param string $raw
     * @return string
     */
    public static function parse($raw)
    {
        return str_replace(
            ['"'.self::START, self::END.'"', '\n'],
            [],
            $raw
        );
    }

    /**
     * @param string $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return self::START . $this->content . self::END;
    }

    /**
     * @return string
     */
    public function jsonSerialize()
    {
        return $this->getContent();
    }
}
