<?php
class Box
{
    /**
    * @var array
    */
    protected $items = [];

    /**
    * 使用给定项构造框
    *
    * @param array $items
    */
    public function __construct($items = [])
    {
        $this->items = $items;
    }

    /**
    * 检查指定的项目是否在框中。
    *
    * @param string $item
    * @return bool
    */
    public function has($item)
    {
        return in_array($item, $this->items);
    }

    /**
    * 从框中移除项，如果框为空，则为 null 。
    *
    * @return string
    */
    public function takeOne()
    {
        return array_shift($this->items);
    }

    /**
    * 从包含指定字母开头的框中检索所有项目。
    *
    * @param string $letter
    * @return array
    */
    public function startsWith($letter)
    {
        return array_filter($this->items, function ($item) use ($letter) {
            return stripos($item, $letter) === 0;
        });
    }
}