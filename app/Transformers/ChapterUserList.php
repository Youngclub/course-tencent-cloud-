<?php

namespace App\Transformers;

use App\Repos\Chapter as ChapterRepo;
use App\Repos\User as UserRepo;

class ChapterUserList extends Transformer
{

    public function handleChapters($relations)
    {
        $courses = $this->getChapters($relations);

        foreach ($relations as $key => $value) {
            $relations[$key]['course'] = $courses[$value['chapter_id']];
        }

        return $relations;
    }

    public function handleUsers($relations)
    {
        $users = $this->getUsers($relations);

        foreach ($relations as $key => $value) {
            $relations[$key]['user'] = $users[$value['user_id']];
        }

        return $relations;
    }

    protected function getChapters($relations)
    {
        $ids = kg_array_column($relations, 'chapter_id');

        $courseRepo = new ChapterRepo();

        $courses = $courseRepo->findByIds($ids, ['id', 'title'])->toArray();

        $result = [];

        foreach ($courses as $course) {
            $result[$course['id']] = $course;
        }

        return $result;
    }

    protected function getUsers($relations)
    {
        $ids = kg_array_column($relations, 'user_id');

        $userRepo = new UserRepo();

        $users = $userRepo->findByIds($ids, ['id', 'name', 'avatar'])->toArray();

        $result = [];

        foreach ($users as $user) {
            $result[$user['id']] = $user;
        }

        return $result;
    }

}
