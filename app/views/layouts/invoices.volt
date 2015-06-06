{% extends "templates/index.volt" %}

{% block content %}
    {{ elements.getTabs() }}

    <div align="center">
        {{ content() }}
    </div>
{% endblock %}