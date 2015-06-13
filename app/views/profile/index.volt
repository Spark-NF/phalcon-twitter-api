{% extends "templates/index.volt" %}

{% block content %}
    <div class="profile">
        <div class="page-header">
            <h2>Profile</h2>
        </div>
        {{ form('profile/index', 'id': 'profileForm', 'onbeforesubmit': 'return false') }}
            <fieldset>
                <div class="form-group">
                    <label for="name">Full name</label>
                    <div class="controls">
                        {{ text_field("name", "size": "30", "class": "form-control") }}
                        <div class="alert" id="name_alert">
                            <strong>Warning!</strong> Please enter your full name
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <div class="controls">
                        {{ text_field("email", "size": "30", "class": "form-control") }}
                        <div class="alert" id="email_alert">
                            <strong>Warning!</strong> Please enter your email
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="button" value="Update" class="btn btn-primary btn-large btn-info" onclick="Profile.validate()">
                    &nbsp;
                    {{ link_to('invoices/index', 'Cancel') }}
                </div>
            </fieldset>
        </form>
    </div>
{% endblock %}