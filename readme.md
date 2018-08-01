# Shakespeare books search

A small web app that allows users to search within Shakespeare books.

## Installation

### Prerequisites

* To run this project, you must have :
    *    [php](http://php.net/manual/en/install.php)
    *    [composer](https://getcomposer.org/download/)
    *    [docker](https://docs.docker.com/install/)
    
### Step 1

Begin by cloning this repository to your machine, and installing all Composer dependencies.

```bash
git clone git@github.com:kaderHlby/shakespeare-books.git
cd shakespeare-books && composer install
cp .env.example .env
php artisan Shakespeare-books:install
```

### Step 2
Setup elasticsearch
    
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


### Step 3
Next, boot up a server and visit your search forum.
    ```
    php -S localhost:8000 -t public
    ```

Visit: `localhost:8000` to search Shakespeare books.