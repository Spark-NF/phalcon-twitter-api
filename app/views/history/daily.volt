<h2>Call history</h2>
<p>Number of calls in the last 24 hours.</p>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Hour</th>
            <th>Number of calls</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        {% for line in history %}
            <tr>
                <td>{{ line.date }}</td>
                <td>{{ line.calls }}</td>
                <td><span class="label label-success">Success</span></td>
            </tr>
        {% endfor %}
    </tbody>
</table>

