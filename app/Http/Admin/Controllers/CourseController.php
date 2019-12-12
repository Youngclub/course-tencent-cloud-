<?php

namespace App\Http\Admin\Controllers;

use App\Http\Admin\Services\Course as CourseService;

/**
 * @RoutePrefix("/admin/course")
 */
class CourseController extends Controller
{

    /**
     * @Get("/search", name="admin.course.search")
     */
    public function searchAction()
    {
        $courseService = new CourseService();

        $xmCategories = $courseService->getXmCategories(0);

        $this->view->setVar('xm_categories', $xmCategories);
    }

    /**
     * @Get("/list", name="admin.course.list")
     */
    public function listAction()
    {
        $courseService = new CourseService();

        $pager = $courseService->getCourses();

        $this->view->setVar('pager', $pager);
    }

    /**
     * @Get("/add", name="admin.course.add")
     */
    public function addAction()
    {

    }

    /**
     * @Post("/create", name="admin.course.create")
     */
    public function createAction()
    {
        $courseService = new CourseService();

        $course = $courseService->createCourse();

        $location = $this->url->get([
            'for' => 'admin.course.edit',
            'id' => $course->id,
        ]);

        $content = [
            'location' => $location,
            'msg' => '创建课程成功',
        ];

        return $this->ajaxSuccess($content);
    }

    /**
     * @Get("/{id}/edit", name="admin.course.edit")
     */
    public function editAction($id)
    {
        $courseService = new CourseService();

        $course = $courseService->getCourse($id);
        $xmTeachers = $courseService->getXmTeachers($id);
        $xmCategories = $courseService->getXmCategories($id);
        $xmCourses = $courseService->getXmCourses($id);

        $this->view->setVar('course', $course);
        $this->view->setVar('xm_teachers', $xmTeachers);
        $this->view->setVar('xm_categories', $xmCategories);
        $this->view->setVar('xm_courses', $xmCourses);
    }

    /**
     * @Post("/{id}/update", name="admin.course.update")
     */
    public function updateAction($id)
    {
        $courseService = new CourseService();

        $courseService->updateCourse($id);

        $content = ['msg' => '更新课程成功'];

        return $this->ajaxSuccess($content);
    }

    /**
     * @Post("/{id}/delete", name="admin.course.delete")
     */
    public function deleteAction($id)
    {
        $courseService = new CourseService();

        $courseService->deleteCourse($id);

        $content = [
            'location' => $this->request->getHTTPReferer(),
            'msg' => '删除课程成功',
        ];

        return $this->ajaxSuccess($content);
    }

    /**
     * @Post("/{id}/restore", name="admin.course.restore")
     */
    public function restoreAction($id)
    {
        $courseService = new CourseService();

        $courseService->restoreCourse($id);

        $content = [
            'location' => $this->request->getHTTPReferer(),
            'msg' => '还原课程成功',
        ];

        return $this->ajaxSuccess($content);
    }

    /**
     * @Get("/{id}/chapters", name="admin.course.chapters")
     */
    public function chaptersAction($id)
    {
        $courseService = new CourseService();

        $course = $courseService->getCourse($id);
        $chapters = $courseService->getChapters($id);

        $this->view->setVar('course', $course);
        $this->view->setVar('chapters', $chapters);
    }

}
