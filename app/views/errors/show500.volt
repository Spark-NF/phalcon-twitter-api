{% extends "templates/jumbotron.volt" %}

{% block jumbotron %}
    <h1>Internal error</h1>
    <p>Something went wrong, if the error continue please contact us</p>
    <p>{{ link_to('index', 'Home', 'class': 'btn btn-primary') }}</p>
{% endblock %}