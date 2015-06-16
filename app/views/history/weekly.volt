<h2>Call history</h2>
<p>Number of calls in the last week.</p>

<div><canvas id="chart" width="500" height="200"></canvas></div>
<script type="text/javascript">
    $(function() {
        var data = {
            labels: [
                {% for line in history %}
                    "{{ line.date }}",
                {% endfor %}
            ],
            datasets: [{
                label: "Call count",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [
                    {% for line in history %}
                        {{ line.calls }},
                    {% endfor %}
                ]
            }]
        };
        var options = {
            responsive: true,
            scaleOverride: true,
            scaleStartValue: 0,
            scaleSteps: {{ steps }},
            scaleStepWidth: {{ stepWidth }}
        };
        var ctx = document.getElementById("chart").getContext("2d");
        new Chart(ctx).Line(data, options);
    });
</script>