<?php
class Queue
{
    public $data = ["shit", "fuck", "piss"];
    public function add($record)
    {
        array_unshift($this->data, $record);
    }
    public function remove()
    {
        array_pop($this->data);
    }
}
