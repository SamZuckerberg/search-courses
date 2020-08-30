<?php

namespace SamZuckerberg\SearchCourses;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Search
{
    private ClientInterface $httpClient;
    private Crawler $crawler;

    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function search(string $url): array
    {
        $request = $this->httpClient->request('GET', $url);
        $this->crawler->addHtmlContent($request->getBody());
        $courses = [];
        foreach ($this->crawler->filter('span.card-curso__nome') as $course) {
            $courses[] = $course;
        }
        return $courses;
    }
}
