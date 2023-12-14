<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class NilaiMoodleController extends Controller
{
    public function getMoodleCourses()
    {
        // URL API Moodle
        $apiUrl = 'http://localhost/moodle/webservice/rest/server.php';

        // Token Moodle
        $token = '77e020ae6f8d716e42ab406a4a10861c';

        // Fungsi yang ingin dijalankan
        $wsFunction = 'core_course_get_courses';

        // Format respons JSON
        $format = 'json';

        // ID awal untuk mengambil course (mulai dari ID 2)
        $startId = 2;

        // Membuat instance dari Guzzle HTTP Client
        $client = new Client();

        // Melakukan permintaan ke API Moodle
        $response = $client->request('GET', $apiUrl, [
            'query' => [
                'wstoken' => $token,
                'moodlewsrestformat' => $format,
                'wsfunction' => $wsFunction,
            ],
        ]);

        // Mengambil data dari respons
        $data = json_decode($response->getBody(), true);

        // Filter course yang memiliki ID lebih besar atau sama dengan 2
        $filteredCourses = array_filter($data, function ($course) use ($startId) {
            return $course['id'] >= $startId;
        });
        // dd($filteredCourses);
        // Lakukan sesuatu dengan data, misalnya tampilkan ke view
        return view('pages.akademik.data-nilai-moodle.course-moodle', ['courses' => $filteredCourses])->with('title', 'Data Course Moodle');
    }
    
    public function getGradeItems($courseId, Request $request)
    {
        // URL API Moodle
        $apiUrl = 'http://localhost/moodle/webservice/rest/server.php';
        $token = '77e020ae6f8d716e42ab406a4a10861c';
        $wsFunction = 'gradereport_user_get_grade_items';
        $format = 'json';

        // Membuat instance dari Guzzle HTTP Client
        $client = new Client();

        // Melakukan permintaan ke API Moodle
        $response = $client->request('POST', $apiUrl, [
            'query' => [
                'wstoken' => $token,
                'moodlewsrestformat' => $format,
                'wsfunction' => $wsFunction,
                'courseid' => $courseId,
            ],
        ]);

        // Mengambil data dari respons
        $gradeItems = json_decode($response->getBody(), true);

        // Get the search query from the request
        $searchQuery = $request->input('search');

        // Filter gradeItems based on the search query
        if (!empty($searchQuery)) {
            $gradeItems['usergrades'] = array_filter($gradeItems['usergrades'], function ($grade) use ($searchQuery) {
                return stripos($grade['userfullname'], $searchQuery) !== false;
            });
        }

        return view('pages.akademik.data-nilai-moodle.course-moodle-nilai', [
            'gradeItems' => $gradeItems,
            'courseId' => $courseId,
            'title' => 'Detail Nilai',
        ]);
    }
}
