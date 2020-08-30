<?php

require 'vendor/autoload.php';

use SamZuckerberg\SearchCourses\Search;
use Symfony\Component\DomCrawler\Crawler;

$client = new \GuzzleHttp\Client();
$crawler = new Crawler();

$search = new Search($client, $crawler);
$courses = $search->search('https://www.alura.com.br/cursos-online-programacao/php');

foreach ($courses as $course) {
    echo $course->textContent . PHP_EOL;
}
