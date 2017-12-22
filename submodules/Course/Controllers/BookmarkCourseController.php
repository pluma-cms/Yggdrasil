<?php

namespace Course\Controllers;

use Assignment\Models\Assignment;
use Bookmark\Models\Bookmark;
use Catalogue\Models\Catalogue;
use Category\Models\Category;
use Content\Models\Content;
use Course\Models\Course;
use Course\Models\User;
use Course\Requests\CourseRequest;
use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Lesson\Models\Lesson;
use Library\Models\Library;

class BookmarkCourseController extends AdminController
{
    /**
     * Display list of bookmarked resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Course::onlyBookmarkedBy(user()->id)->get();

        return view("Theme::bookmarked.index")->with(compact("resources"));
    }

    /**
     * Bookmark the course.
     *
     * @param  Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function bookmark(Request $request, $id)
    {
        $bookmark = new Bookmark();
        $bookmark->user()->associate(user()->id);
        $course = Course::find($id);
        $course->bookmarks()->save($bookmark);

        return back();
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
            return back()->with($e->getMessage());
        } finally {
            return back();
        }
    }
}
