<?php

namespace These\TagBuilder;

/**
 * Class TagBuilder.
 */
/**
 * Class TagBuilder.
 */
class TagBuilder
{
    /**
     * Tag mask.
     */
    const TAG_MASK = '%tag%';

    /**
     * Options Mask.
     */
    const OPTIONS_MASK = '%options%';

    /**
     * Inside Mask.
     */
    const INSIDE_MASK = '%inside%';

    /**
     * @var string
     */
    protected $tagHtml = '';

    /**
     * @var array
     */
    protected $tagList = [];
    /**
     * @var
     */
    protected $openTagMask;
    /**
     * @var
     */
    protected $closeTagMask;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->buildTagMask();
    }

    /**
     * Make a Tag.
     *
     * @param       $tag
     * @param null  $content
     * @param array $options
     *
     * @return $this
     */
    public function nest($tag, $content = null, $options = [])
    {
        $options = $this->prepareOptions($options);

        $open = $this->insertOptionsInMask($options, $this->insertTagInMask($tag, $this->openTagMask));

        $close = $this->insertTagInMask($tag, $this->closeTagMask);

        $this->tagList[] = [
            'open'    => $open,
            'close'   => $close,
            'content' => $content,
        ];

        return $this;
    }

    public function make($tag, $content = null, $options = [])
    {
        return (new self())->nest($tag, $content, $options);
    }
    /**
     * @return bool
     */
    protected function buildHtml()
    {
        $htmlOutput = '';

        foreach ($this->tagList as $tag) {
            $htmlOutput .= $tag['open'];
        }

        foreach (array_reverse($this->tagList) as $tag) {
            $htmlOutput .= $tag['content'];
            $htmlOutput .= $tag['close'];
        }

        $this->tagHtml = $htmlOutput;

        return true;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getHtml();
    }

    /**
     * Prepare options.
     *
     * @param $options
     *
     * @return string
     */
    protected function prepareOptions($options)
    {
        $optionsHtml = '';

        foreach ($options as $key => $value) {
            $optionsHtml .= "$key='$value' ";
        }

        $optionsHtml = (strlen($optionsHtml) > 0) ? ' '.trim($optionsHtml) : '';

        return $optionsHtml;
    }

    /**
     * Insert the Tag in the mask.
     *
     * @param      $tag
     * @param null $mask
     *
     * @return mixed
     */
    protected function insertTagInMask($tag, $mask = null)
    {
        $mask = ($mask) ?: $this->tagMask;

        $tagHtml = str_replace(self::TAG_MASK, trim($tag), $mask);

        return $tagHtml;
    }

    /**
     * Insert the options in the mask.
     *
     * @param $options
     * @param $mask
     *
     * @internal param $tagHtml
     *
     * @return mixed
     */
    protected function insertOptionsInMask($options, $mask)
    {
        $tagHtml = str_replace(self::OPTIONS_MASK, $options, $mask);

        return $tagHtml;
    }

    /**
     * Build the tag mask.
     */
    private function buildTagMask()
    {
        $this->openTagMask = '<'.Self::TAG_MASK.Self::OPTIONS_MASK.'>';

        $this->closeTagMask = '</'.Self::TAG_MASK.'>';
    }

    /**
     * Get the Html.
     *
     * @return string
     */
    public function getHtml()
    {
        $this->buildHtml();

        return $this->tagHtml;
    }
}
