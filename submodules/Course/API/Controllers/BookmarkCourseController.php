<?php

namespace Course\API\Controllers;

use Assignment\Models\Assignment;
use Bookmark\Models\Bookmark;
use Catalogue\Models\Catalogue;
use Category\Models\Category;
use Content\Models\Content;
use Course\Models\Course;
use Course\Models\User;
use Course\Requests\CourseRequest;
use Illuminate\Http\Request;
use Lesson\Models\Lesson;
use Library\Models\Library;
use Pluma\API\Controllers\APIController;

class BookmarkCourseController extends APIController
{
    /**
     * Bookmark the course.
     *
     * @param  Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function bookmark(Request $request, $id)
    {
        $course = Course::find($id);
        $bookmark = new Bookmark();
        $bookmark->user()->associate(user()->id);
        $course->bookmarks()->save($bookmark);

        return response()->json($this->successResponse);
    }

    /**
     * Delete the bookmark of the course.
     *
     * @param  Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function unbookmark(Request $request, $id)
    {
        try {
            $course = Course::find($id);
            $course->bookmarks()->where('user_id', user()->id)->delete();
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        } finally {
            return response()->json($this->successResponse);
        }
    }
}
