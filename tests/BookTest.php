<?php

namespace tests;

class BookTest extends BookTestCase
{
    /**
     * @test
     */
    public function it_should_search_book_and_get_play_name()
    {
        $response = $this->json(
            'POST',
            route('book.search'),
            [
                'query' => 'free'
            ])->response;

        $data = json_decode($response->getContent(), true)['data'];

        $this->assertArrayHasKey('play_name', $data[0]);
        $this->assertArrayHasKey('text', $data[0]);
    }

    /**
     * @test
     */
    public function it_should_return_validation_error_when_query_field_is_empty()
    {
        $response = $this->json(
            'POST',
            route('book.search'),
            [
                'query' => ''
            ])->response;

        $data = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('query', $data);
        $this->assertEquals($data['query'][0], "The query field is required.");
    }
}
