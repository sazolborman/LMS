<?php

use App\Http\Controllers\Admin\AffiliateController;
use App\Http\Controllers\Admin\BootcampController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CurriculumController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\EbookController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\AiController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'admin'])->group(function () {

    // dashboard
    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
    });
    // category route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('category', 'index')->name('category');
        Route::post('category/store', 'category_store')->name('category.store');
        Route::post('category/update/{id}', 'update')->name('category.update');
        Route::get('category/delete/{id}', 'delete')->name('category.delete');
    });
    // course route
    Route::controller(CourseController::class)->group(function () {
        Route::get('course', 'index')->name('course');
        Route::get('course/create', 'course_create')->name('course.create');
        Route::get('course/edit/{id}', 'course_edit')->name('course.edit');
        Route::post('course/store', 'course_store')->name('course.store');
        Route::post('course/update', 'course_update')->name('course.update');
        Route::get('course/status/{id}', 'course_status')->name('course.status');
        Route::get('course/delete/{id}', 'course_delete')->name('course.delete');


        //course bundle route
        Route::get('course/bundle', 'course_bundle')->name('bundle');
        Route::get('course/bundle/create', 'course_bundle_create')->name('bundle.create');
        Route::get('course/bundle/status/{id}', 'course_bundle_status')->name('bundle.status');
        Route::get('course/bundle/subscription_report', 'subscription_report')->name('subscription.report');
        Route::get('course/bundle/edit/{id}', 'course_bundle_edit')->name('bundle.edit');
        Route::post('course/bundle/store', 'course_bundle_store')->name('bundle.store');
        Route::post('course/bundle/update', 'course_bundle_update')->name('bundle.update');
        Route::get('course/bundle/delete/{id}', 'course_bundle_delete')->name('bundle.delete');

        //schedule route
        Route::get('course/schedule', 'course_schedule')->name('schedule');
        Route::post('show/section', 'show_section')->name('show.section');
        Route::post('show/lesson', 'show_lesson')->name('show.lesson');
        Route::post('course/schedule/store', 'schedule_store')->name('schedule.store');
    });
    // curriculum route
    Route::controller(CurriculumController::class)->group(function () {
        // section route
        Route::post('section/store', 'section_store')->name('section.store');
        Route::post('section/sort', 'section_sort')->name('section.sort');
        Route::post('section/update', 'section_update')->name('section.update');
        Route::get('section/delete/{id}', 'section_delete')->name('section.delete');

        //lesson route
        Route::post('lesson/store', 'lesson_store')->name('lesson.store');
        Route::post('lesson/sort', 'lesson_sort')->name('lesson.sort');
        Route::post('lesson/update', 'lesson_update')->name('lesson.update');
        Route::get('lesson/delete/{id}', 'lesson_delete')->name('lesson.delete');

        //Quiz route
        Route::post('quiz/store', 'quiz_store')->name('quiz.store');
        Route::post('quiz/update', 'quiz_update')->name('quiz.update');

        //Question route
        Route::post('question/store', 'question_store')->name('question.store');
        Route::post('question/update', 'question_update')->name('question.update');
        Route::get('question/type', 'question_type')->name('question.type');
        Route::get('question/sort', 'question_sort')->name('question.sort');
        Route::delete('question/delete/{id}', 'question_delete')->name('question.delete');

        //assignment route
        Route::post('assignment/store', 'assignment_store')->name('assignment.store');
        Route::post('assignment/update', 'assignment_update')->name('assignment.update');
    });

    // coupon route
    Route::controller(BootcampController::class)->group(function () {

        //bootcamp management
        Route::get('bootcamp', 'index')->name('bootcamp');
        Route::get('bootcamp-create', 'bootcamp_create')->name('bootcamp.create');
        Route::post('bootcamp-store', 'bootcamp_store')->name('bootcamp.store');
        Route::get('bootcamp-edit/{id}', 'bootcamp_edit')->name('bootcamp.edit');
        Route::post('bootcamp-update', 'bootcamp_update')->name('bootcamp.update');
        Route::get('bootcamp-delete/{id}', 'bootcamp_delete')->name('bootcamp.delete');

        //bootcamp category
        Route::get('bootcamp-category', 'bootcamp_category')->name('bootcamp.category');
        Route::post('bootcamp-category/store', 'bootcamp_category_store')->name('bootcamp.category.store');
        Route::post('bootcamp-category/update', 'bootcamp_category_update')->name('bootcamp.category.update');
        Route::get('bootcamp-category/delete/{id}', 'bootcamp_category_delete')->name('bootcamp.category.delete');

        // Module route
        Route::post('bootcamp-module/store', 'module_store')->name('module.store');
        Route::post('bootcamp-module/sort', 'module_sort')->name('module.sort');
        Route::post('bootcamp-module/update', 'module_update')->name('module.update');
        Route::get('bootcamp-module/delete/{id}', 'module_delete')->name('module.delete');

        //Class route
        Route::post('bootcamp-class/store', 'class_store')->name('class.store');
        Route::post('bootcamp-class/sort', 'class_sort')->name('class.sort');
        Route::post('bootcamp-class/update', 'class_update')->name('class.update');
        Route::get('bootcamp-class/delete/{id}', 'class_delete')->name('class.delete');


        //purchase history
        Route::get('bootcamp-purchase-history', 'bootcamp_purchasehistory')->name('bootcamp.purchasehistory');
    });

    // User route
    Route::controller(UserController::class)->group(function () {
        // admin route
        Route::get('admins', 'admin_admins')->name('admins');
        Route::get('admin/create', 'admin_create')->name('admin.create');
        Route::post('admin/store', 'admin_store')->name('admin.store');
        Route::get('admin/edit/{id}', 'admin_edit')->name('admin.edit');
        Route::post('admin/update', 'admin_update')->name('admin.update');
        Route::get('admin/delete/{id}', 'admin_delete')->name('admin.delete');
        Route::get('permission/{id}', 'permission')->name('permission');
        Route::post('permission/store', 'permission_store')->name('permission.store');

        // instructor route
        Route::get('instructor', 'instructor')->name('instructor');
        Route::get('instructor/create', 'instructor_create')->name('instructor.create');
        Route::post('instructor/store', 'instructor_store')->name('instructor.store');
        Route::get('instructor/edit/{id}', 'instructor_edit')->name('instructor.edit');
        Route::post('instructor/update', 'instructor_update')->name('instructor.update');
        Route::get('instructor/setting', 'instructor_setting')->name('instructor.setting');
        Route::post('instructor/setting/store', 'instructor_setting_store')->name('instructor.setting.store');
        Route::get('instructor/delete/{id}', 'instructor_delete')->name('instructor.delete');

        // student route
        Route::get('student', 'student')->name('student');
        Route::get('student/create', 'student_create')->name('student.create');
        Route::post('student/store', 'student_store')->name('student.store');
        Route::get('student/edit/{id}', 'student_edit')->name('student.edit');
        Route::post('student/update', 'student_update')->name('student.update');
        Route::get('student/delete/{id}', 'student_delete')->name('student.delete');
    });

    // Blog route
    Route::controller(BlogController::class)->group(function () {
        //blog
        Route::get('blog', 'blog')->name('blog');
        Route::get('blog/create', 'blog_create')->name('blog.create');
        Route::post('blog/store', 'blog_store')->name('blog.store');
        Route::get('blog/edit/{id}', 'blog_edit')->name('blog.edit');
        Route::post('blog/update', 'blog_update')->name('blog.update');
        Route::get('blog/status/{id}', 'blog_status')->name('blog.status');
        Route::get('blog/delete/{id}', 'blog_delete')->name('blog.delete');

        //blog category
        Route::get('blog/category', 'blog_category')->name('blog.category');
        Route::post('blog/category/store', 'blog_category_store')->name('blog.category.store');
        Route::post('blog/category/update', 'blog_category_update')->name('blog.category.update');
        Route::get('blog/category/delete/{id}', 'blog_category_delete')->name('blog.category.delete');

        //blog setting
        Route::get('blog/setting', 'blog_setting')->name('blog.setting');
        Route::post('blog/setting/update', 'blog_setting_update')->name('blog.setting.update');
    });

    // coupon route
    Route::controller(CouponController::class)->group(function () {
        Route::get('coupon', 'index')->name('coupon');
        Route::post('coupon/store', 'store')->name('coupon.store');
        Route::post('coupon/update', 'update')->name('coupon.update');
        Route::get('coupon/status/{id}', 'status')->name('coupon.status');
        Route::get('coupon/delete/{id}', 'delete')->name('coupon.delete');
    });
    // ebook route
    Route::controller(EbookController::class)->group(function () {
        Route::get('ebook', 'index')->name('ebook');
        Route::get('ebook/create', 'create')->name('ebook.create');
        Route::post('ebook/store', 'store')->name('ebook.store');
        Route::get('ebook/edit/{id}', 'edit')->name('ebook.edit');
        Route::post('ebook/update', 'update')->name('ebook.update');
        Route::get('ebook/status/{id}', 'status')->name('ebook.status');
        Route::get('ebook/delete/{id}', 'delete')->name('ebook.delete');

        //ebook category
        Route::get('ebook-category', 'ebook_category')->name('ebook.category');
        Route::post('ebook-category/store', 'ebook_category_store')->name('ebook.category.store');
        Route::post('ebook-category/update', 'ebook_category_update')->name('ebook.category.update');
        Route::get('ebook-category/delete/{id}', 'ebook_category_delete')->name('ebook.category.delete');
    });
    // Enrollment route
    Route::controller(EnrollmentController::class)->group(function () {
        Route::get('enrollment', 'index')->name('enrollment');
        Route::post('enrollment/store', 'store')->name('enrollment.store');

        //enrollment history
        Route::get('enrollment-history', 'enrollment_history')->name('enrollment.history');
        Route::get('enrollment-history/delete/{id}', 'enrollment_history_delete')->name('enrollment.history.delete');
    });
    // newsletter route
    Route::controller(NewsletterController::class)->group(function () {
        Route::get('newsletter', 'index')->name('newsletter');
        Route::post('newsletter/store', 'store')->name('newsletter.store');
        Route::post('newsletter/update', 'update')->name('newsletter.update');
        Route::post('newsletter/send', 'send')->name('newsletter.send');
        Route::get('newsletter/delete/{id}', 'delete')->name('newsletter.delete');

        //Subscribed user
        Route::get('subscribed-user', 'subscribed_user')->name('subscribed.user');
        Route::post('subscribed-user/send', 'subscribed_user_send')->name('subscribed.user.send');
        Route::get('subscribed-user/delete/{id}', 'subscribed_user_delete')->name('subscribed.user.delete');
    });
    // Affiliator route
    Route::controller(AffiliateController::class)->group(function () {

        Route::get('affiliator', 'affiliator')->name('affiliator');
        Route::post('affiliator/store', 'affiliator_store')->name('affiliator.store');
        Route::get('affiliator/status/{id}', 'affiliator_status')->name('affiliator.status');
        Route::get('affiliator/delete/{id}', 'affiliator_delete')->name('affiliator.delete');
    });
    // Setting route
    Route::controller(SettingController::class)->group(function () {
        //system settings
        Route::get('system-settings', 'system_settings')->name('system.settings');
        Route::post('system-settings/update', 'system_settings_update')->name('system.settings.update');
        //website setting
        Route::get('website-setting', 'website_settings')->name('website.settings');
        Route::post('website-settings/update', 'website_settings_update')->name('website.settings.update');
    });
    // Ai route
    Route::controller(AiController::class)->group(function () {
        Route::get('setting/ai', 'settings')->name('ai.settings');
        Route::post('settings/ai/update', 'settings_update')->name('ai.settings.update');
        Route::post('generate/ai', 'generate')->name('ai.generate');
    });

    // Language route
    Route::controller(LanguageController::class)->group(function () {
        Route::get('setting/language', 'language')->name('language');
        Route::post('setting/language/store', 'language_store')->name('language.store');
        Route::post('setting/language/update', 'language_update')->name('language.update');
        Route::post('setting/language/direction/update', 'direction_update')->name('language.direction.update');
        Route::get('setting/language/delete/{id}', 'language_delete')->name('language.delete');

        //select language
        Route::get('language/select/{param}', 'language_select')->name('language.select');

        //language phrase
        Route::get('setting/language/phrase/{id}', 'language_phrase')->name('language.phrase.edit');
        Route::post('setting/language/phrase/update/{phrase_id?}', 'language_phrase_update')->name('language.phrase.update');
    });
});
