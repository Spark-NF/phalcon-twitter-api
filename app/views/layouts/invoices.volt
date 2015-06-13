{% extends "templates/index.volt" %}

{% block content %}
    {{ elements.getTabs() }}
    {{ content() }}
{% endblock %}