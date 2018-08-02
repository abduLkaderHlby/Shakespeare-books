<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>search</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<div class="container" id="app">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1> Search books</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-3">
            <form action="" class="search-form" onsubmit="event.preventDefault();return false;">
                <div class="form-group has-feedback">
                    <label for="search" class="sr-only"> Search</label>
                    <input type="text" class="form-control" name="search" id="search" placeholder="search"
                           v-model="query">
                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3" v-for="result in results">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @{{ result.play_name }}
                </div>
                <div class="panel-body">
                    <p>@{{ result.text }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>

<script>
    var app = new Vue({
        el: '#app',
        data: {
            message: 'Hello Vue!',
            results: [],
            query: ''
        },
        methods: {
            search: function () {
                url = "http://localhost:8000/search";
                params = {query: this.query};
                axios.post(url, params)
                    .then(response => {
                        console.log(response.data.data);
                        this.results = response.data.data;
                    }).catch(response => {
                    console.log(response);
                })
            }
        },
        watch: {
            query: function () {
                this.search();
            }
        }

    })
</script>

</body>
</html>
