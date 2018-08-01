<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // My mom is just as disappointed in me as you are in this code

    const SIZE = 10000;
    const INDEX = "shakespeare";
    const MATCH = "text_entry";

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Validation\ValidationException
     */
    public function search(Request $request)
    {
        //validate request
        $validated = $this->validate($request, [
            'query' => "required",
        ]);

        $client = ClientBuilder::create()->build();

        $results = $client->search($this->getParams($validated['query']));

        return BookResource::collection(
            $this->getDocsCollection($results)
        );
    }

    /**
     * @param $results
     * @return \Illuminate\Support\Collection
     */
    private function getDocsCollection($results)
    {
        return collect($results["hits"]["hits"])->pluck("_source");
    }

    /**
     * @param $query
     * @return array
     */
    private function getParams($query)
    {
        return [
            "index" => self::INDEX,
            "size" => self::SIZE,
            "body" => [
                "query" => [
                    "match" => [
                        self::MATCH => $query
                    ]
                ]
            ]
        ];
    }
}
