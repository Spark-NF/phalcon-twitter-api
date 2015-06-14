{% extends "templates/index.volt" %}

{% block content %}
    <div class="page-header">
        <h2>Pricing</h2>
    </div>

    <div class="row">
        <div class="col-md-4 offer {% if offer === 'test' %}active-offer{% endif %}">
            <h3 class="col-header">Test offer</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend, risus et scelerisque pellentesque, velit sem egestas lectus, non dignissim lectus enim non leo.</p>
            {% if (offer !== false) and (offer != 'test') %}
                <a class="btn btn-success" href="{{ url('pricing/switch/test') }}">Choose this offer</a>
            {% endif %}
        </div>
        <div class="col-md-4 offer {% if offer === 'classic' %}active-offer{% endif %}">
            <h3 class="col-header">Classic</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend, risus et scelerisque pellentesque, velit sem egestas lectus, non dignissim lectus enim non leo.</p>
            {% if (offer !== false) and (offer != 'classic') %}
                <a class="btn btn-success" href="{{ url('pricing/switch/classic') }}">Choose this offer</a>
            {% endif %}
        </div>
        <div class="col-md-4 offer {% if offer === 'premium' %}active-offer{% endif %}">
            <h3 class="col-header">Premium</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend, risus et scelerisque pellentesque, velit sem egestas lectus, non dignissim lectus enim non leo.</p>
            {% if (offer !== false) and (offer != 'premium') %}
                <a class="btn btn-success" href="{{ url('pricing/switch/premium') }}">Choose this offer</a>
            {% endif %}
        </div>
    </div>
{% endblock %}