{% extends "templates/jumbotron.volt" %}

{% block jumbotron %}
    <h1>Page not found</h1>
    <p>Sorry, you have accessed a page that does not exist or was moved</p>
    <p>{{ link_to('index', 'Home', 'class': 'btn btn-primary') }}</p>
{% endblock %}