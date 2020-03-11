module.exports = {

    createCharts: function(){

        var url = window.location.origin;
        var id = $('#notouchid').text();
        var year = $("#year_selection").val();
        //var id = {{json_encode($apartment->id)}};
        var msgGraph;
        var viewGraph;
        $("#year_selection").change(function(){
            year = $(this).val();

            getData(destMsg);
            getData(destView);
        });

        //ajax Call
        function getData(dest) {
            $.ajax({
                url: url + dest,
                method: "GET",
                data: {
                    year_jq: year,
                    id_jq: id
                },
                success: function (data) {
                    console.log(data)
                    if (dest == '/stat-msg') {

                        messagesData(data);
                    } else {

                        viewsData(data);
                    }

                },
                error: function (err) {
                    console.log("error", err);
                }
            });
        }

        // grafico messaggi
        function messagesGraph(count) {

            var messagesChart = $("#messagesChart");

            if (msgGraph) msgGraph.destroy();
            console.log('inside table'+year)
            window.msgGraph = new Chart(messagesChart, {

                type: "bar",
                data: {
                    labels: moment.months(),
                    datasets: [{
                        label: "Messaggi",
                        data: count,
                        backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(163, 174, 24, 0.6)',
                        'rgba(68, 122, 247, 0.6)',
                        'rgba(232, 34, 209, 0.6)',
                        'rgba(21, 51, 221, 0.6)',
                        'rgba(194, 139, 128, 0.6)',
                        'rgba(87, 4, 131, 0.6)',
                        'rgba(169, 26, 127, 0.6)'
                        ]
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Messaggi '+year,
                        fontSize: 25
                    },
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                            display: false
                            }
                        }]
                    },
                    // responsive: true
                },
            });
        }

        // grafico views
        function viewsGraph(count) {

            var viewsChart = $("#viewsChart");

            if (viewGraph) viewGraph.destroy();

            window.viewGraph = new Chart(viewsChart, {

                type: "bar",
                data: {
                    labels: moment.months(),
                    datasets: [{
                    label: "Visualizzazioni",
                    data: count,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(163, 174, 24, 0.6)',
                        'rgba(68, 122, 247, 0.6)',
                        'rgba(232, 34, 209, 0.6)',
                        'rgba(21, 51, 221, 0.6)',
                        'rgba(194, 139, 128, 0.6)',
                        'rgba(87, 4, 131, 0.6)',
                        'rgba(169, 26, 127, 0.6)'
                    ]
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Visualizzazioni '+year,
                        fontSize: 25
                    },
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                            display: false
                            }
                        }]
                    },
                    // responsive: true
                },
            })

        }

        // dati da passare per messaggi
        function messagesData(data) {

            var months = data.map(function(e) {
                var x = e.created_at;
                return (moment(x).month()+1);
            });

            var rowCount = [{1: 0}, {2: 0}, {3: 0}, {4: 0}, {5: 0}, {6: 0}, {7: 0}, {8: 0}, {9: 0}, {10: 0}, {11: 0}, {12: 0}];
            // var rowCount = [{1: 2}, {2: 5}, {3: 3}, {4: 7}, {5: 5}, {6: 2}, {7: 9}, {8: 7}, {9: 8}, {10: 6}, {11: 8}, {12: 5}]; //serve per testare

            $.each(months, function(i, el) {
                rowCount[el-1][el] = (rowCount[el-1][el])+1;
            });

            var count = Object.keys(rowCount).map(x => Object.values(rowCount[x]));

            messagesGraph(count);
        }

        // dati da passare per views
        function viewsData(data) {

            var months = data.map(function(e) {
                var x = e.created_at;
                return (moment(x).month()+1);
            });

            var rowCount = [{1: 0}, {2: 0}, {3: 0}, {4: 0}, {5: 0}, {6: 0}, {7: 0}, {8: 0}, {9: 0}, {10: 0}, {11: 0}, {12: 0}];

            $.each(months, function(i, el) {
                rowCount[el-1][el] = (rowCount[el-1][el])+1;
            });

            var count = Object.keys(rowCount).map(x => Object.values(rowCount[x]));

            viewsGraph(count);
        }

        var destMsg = '/stat-msg';
        var destView = '/view-stat';

        getData(destMsg);
        getData(destView);
    },
}
