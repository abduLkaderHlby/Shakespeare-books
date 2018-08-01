# Shakespeare books search

A small web app that allows users to search within Shakespeare books.

### Prerequisites

- [php](http://php.net/manual/en/install.php)
- [composer](https://getcomposer.org/download/)
- [docker](https://docs.docker.com/install/)

### Installing

- clone the repo

- go to the repo folder and install all required packages via composer
    ```
    composer install
    ```

- pulling elasticsearch image
    ```
    docker pull docker.elastic.co/elasticsearch/elasticsearch:6.3.1
    ```

- Running Elasticsearch from the command line

    ```
    docker run -p 9200:9200 -p 9300:9300 -e "discovery.type=single-node"
    docker.elastic.co/elasticsearch/elasticsearch:6.3.1
    ```

- set up mappings
    ```
    curl -X PUT "localhost:9200/shakespeare" -H 'Content-Type: application/json' -d'
        {
        "mappings": {
        "doc": {
        "properties": {
            "speaker": {"type": "keyword"},
            "play_name": {"type": "keyword"},
            "line_id": {"type": "integer"},
            "speech_number": {"type": "integer"}
        }
        }
        }
        }
    '
    ```
- load the data sets
    ```
    curl -H 'Content-Type: application/x-ndjson' -XPOST     'localhost:9200/shakespeare/doc/_bulk?pretty' --data-binary @shakespeare_6.0.json
    ```
    this will take few minutes.


### Testing

- go to the repo folder and run:

    ```
    vendor/bin/phpunit
    ```

### usage

- Serving Your Application
    ```
    php -S localhost:8000 -t public
    ```
    
- go to :

    ```
    localhost:8000
    ```