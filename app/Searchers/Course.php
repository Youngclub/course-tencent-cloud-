<?php

namespace App\Searchers;

use Phalcon\Mvc\User\Component as UserComponent;

class Course extends UserComponent
{

    private $xs;

    public function __construct()
    {
        $fileName = dirname(__FILE__) . '/course.ini';

        $this->xs = new \XS($fileName);
    }

    /**
     * 搜索
     * 
     * @param string $query
     * @param integer $limit
     * @param integer $offset
     * @throws \XSException
     * @return array
     */
    public function search($query, $limit = 15, $offset = 0)
    {
        $search = $this->xs->search;

        $items = $search->setQuery($query)->setLimit($limit, $offset)->search();

        $total = $search->getLastCount();

        return [
            'total' => $total,
            'items' => $items,
        ];
    }

    /**
     * 添加索引
     * 
     * @param CourseModel $course
     */
    public function addIndex($course)
    {
        $doc = $this->setXSDocument($course);

        $this->xs->index->add($doc);
    }

    /**
     * 更新索引
     * 
     * @param CourseModel $course
     * @throws \XSException
     */
    public function updateIndex($course)
    {
        $doc = $this->setXSDocument($course);

        $this->xs->index->update($doc);
    }

    /**
     * 删除索引
     * 
     * @param CourseModel $course
     */
    public function deleteIndex($course)
    {
        $this->xs->index->del($course->id);
    }

    /**
     * 设置文档
     * 
     * @param CourseModel $course
     * @return \XSDocument
     */
    private function setXSDocument($course)
    {
        $data = $course->toArray();

        $doc = new \XSDocument();

        $doc->setFields($data);

        return $doc;
    }

}
