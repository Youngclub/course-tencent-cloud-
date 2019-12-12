<?php

namespace App\Models;

class Config extends Model
{

    /**
     * 主键
     * 
     * @var integer
     */
    public $id;

    /**
     * 配置块
     * 
     * @var string
     */
    public $section;

    /**
     * 配置键
     * 
     * @var string
     */
    public $item_key;

    /**
     * 配置值
     * 
     * @var string
     */
    public $item_value;

    public function getSource()
    {
        return 'config';
    }

}
