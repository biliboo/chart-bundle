<?php

namespace Biliboo\ChartBundle\Lib\Formatter;

use Symfony\Component\Translation\TranslatorInterface;
use Biliboo\ChartBundle\Formatter\AbstractFormatter;
use Biliboo\ChartBundle\Serie\SerieInterface;

/**
 * Description of TranslationFormatter
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
class TranslationFormatter extends AbstractFormatter
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param array $data
     * @param array $options
     * @param SerieInterface $serie
     * @return array
     */
    public function format(array $data, array $options, SerieInterface $serie)
    {
        $data[0] = $this->translator->trans(/** @Ignore*/ $data[0]);

        return $data;
    }
}
