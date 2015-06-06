{% extends "templates/mixed.volt" %}

{% block jumbotron %}
    <h1>Welcome to Captain Falcon</h1>
    <p>
        Captain Falcon is a revolutionary application to help you and your company use the Twitter social API more efficiently.
        Free for small companies, feel free to give us a try!
    </p>
    <p>{{ link_to('register', 'Start for free &raquo;', 'class': 'btn btn-primary btn-large btn-success') }}</p>
{% endblock %}

{% block content %}
    <div class="row">
        <div class="col-md-4">
            <h2 class="col-header">A better Twitter API</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend, risus et scelerisque pellentesque, velit sem egestas lectus, non dignissim lectus enim non leo.</p>
        </div>
        <div class="col-md-4">
            <h2 class="col-header">Dashboards and reports</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend, risus et scelerisque pellentesque, velit sem egestas lectus, non dignissim lectus enim non leo.</p>
        </div>
        <div class="col-md-4">
            <h2 class="col-header">Collaborate as a team</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend, risus et scelerisque pellentesque, velit sem egestas lectus, non dignissim lectus enim non leo.</p>
        </div>
    </div>
{% endblock %}