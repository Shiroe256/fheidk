<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Document</title>
</head>

<body>
    <div class="container p-3">
        <div class="row" data-masonry='{"percentPosition": true,  "itemSelector": ".grid-item" }'>
            <div class="grid-item col-3 mb-2">
                <div class="card shadow">
                    <div class="card-body">
                        <small class="fw-bold">TOTAL GRANTEES</small>
                        <div class="text-end">
                            <h2>17,200 <i class="bi bi-person-fill text-primary"></i></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid-item col-6 mb-2">
                <div class="card shadow">
                    <div class="card-body pt-3">
                        <small class="fw-bold">DISBURSEMENT HEAT MAP <i class="bi bi-fire text-danger"></i></small>
                        <div class="" id="chart_div" style="width: 500px; height: 400px;"></div>
                    </div>
                </div>
            </div>
            <div class="grid-item col-3 mb-2">
                <div class="card shadow">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="200"
                        xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap"
                        preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%"
                            fill="#dee2e6" dy=".3em">Image cap</text>
                    </svg>

                    <div class="card-body">
                        <h5 class="card-title">Card title that wraps to a new line</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                            additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
            <div class="grid-item col-3 mb-2">
                <div class="card shadow p-3">
                    <figure class="p-3 mb-0">
                        <blockquote class="blockquote">
                            <p>A well-known quote, contained in a blockquote element.</p>
                        </blockquote>
                        <figcaption class="blockquote-footer mb-0 text-muted">
                            Someone famous in <cite title="Source Title">Source Title</cite>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div class="grid-item col-3 mb-2">
                <div class="card shadow">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="200"
                        xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap"
                        preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%"
                            fill="#dee2e6" dy=".3em">Image cap</text>
                    </svg>

                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This card has supporting text below as a natural lead-in to additional
                            content.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
            <div class="grid-item col-3 mb-2">
                <div class="card text-bg-primary text-center p-3">
                    <figure class="mb-0">
                        <blockquote class="blockquote">
                            <p>A well-known quote, contained in a blockquote element.</p>
                        </blockquote>
                        <figcaption class="blockquote-footer mb-0 text-white">
                            Someone famous in <cite title="Source Title">Source Title</cite>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div class="grid-item col-3 mb-2">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This card has a regular title and short paragraph of text below it.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
            <div class="grid-item col-3 mb-2">
                <div class="card shadow">
                    <svg class="bd-placeholder-img card-img" width="100%" height="260"
                        xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Card image"
                        preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%"
                            fill="#dee2e6" dy=".3em">Card image</text>
                    </svg>

                </div>
            </div>
            <div class="grid-item col-3 mb-2">
                <div class="card p-3 text-end">
                    <figure class="mb-0">
                        <blockquote class="blockquote">
                            <p>A well-known quote, contained in a blockquote element.</p>
                        </blockquote>
                        <figcaption class="blockquote-footer mb-0 text-muted">
                            Someone famous in <cite title="Source Title">Source Title</cite>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div class="grid-item col-3 mb-2">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is another card with title and supporting text below. This card has
                            some additional content to make it slightly taller overall.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="https://code.highcharts.com/maps/highmaps.js"></script>
    <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
        integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
    </script>
    <script>
        (async () => {
            const topology = await fetch(
                'http://127.0.0.1:8000/files/regions.topo.0.001.json'
            ).then(response => response.json());

            const data = [{
                "code": "ARMM",
                "label": "tite",
                "value": 10
            }, {
                "code": "CAR",
                "label": "tite",
                "value": 11
            }, {
                "code": "NCR",
                "label": "tite",
                "value": 12
            }, {
                "code": "NIR",
                "label": "tite",
                "value": 13
            }, {
                "code": "Ilocos Region",
                "label": "tite",
                "value": 14
            }, {
                "code": "Cagayan Valley",
                "label": "tite",
                "value": 15
            }, {
                "code": "Central Luzon",
                "label": "tite",
                "value": 16
            }, {
                "code": "Calabarzon",
                "label": "tite",
                "value": 17
            }, {
                "code": "Mimaropa",
                "label": "tite",
                "value": 18
            }, {
                "code": "Zamboanga Peninsula",
                "label": "tite",
                "value": 19
            }, {
                "code": "Bicol Region",
                "label": "tite",
                "value": 20
            }, {
                "code": "Western Visayas",
                "label": "tite",
                "value": 21
            }, {
                "code": "Central Visayas",
                "label": "tite",
                "value": 22
            }, {
                "code": "Eastern Visayas",
                "label": "tite",
                "value": 23
            }, {
                "code": "Northern Mindanao",
                "label": "tite",
                "value": 24
            }, {
                "code": "Davao Region",
                "label": "tite",
                "value": 25
            }, {
                "code": "Soccsksargen",
                "label": "tite",
                "value": 26
            }, {
                "code": "Caraga",
                "label": "tite",
                "value": 27
            }];
            // Create the chart
            Highcharts.mapChart('chart_div', {
                chart: {
                    map: topology,
                    backgroundColor: 'transparent',
                    borderWidth: 0
                },
                legend: {
                    enabled: false
                },
                title: {
                    text: ''
                },
                colorAxis: {
                    minColor: '#1A1A2E',
                    maxColor: '#E94560',
                    min: 0
                },
                credits: {
                    enabled: false
                },
                series: [{
                    data: data,
                    joinBy: ['ADM1ALT1EN', 'code'],
                    name: 'Disbursed',
                    states: {
                        hover: {
                            color: '#000000'
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        format: '{point.label}'
                    }
                }]
            });

        })();
    </script>
</body>

</html>
