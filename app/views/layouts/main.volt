<div id="wrapper">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">Captain Falcon</a>
            </div>
            {{ elements.getMenu() }}
        </div>
    </nav>

    <div id="main">
        <div class="container" id="messages">
            {{ flash.output() }}
        </div>

        {{ content() }}
    </div>

    <footer id="footer">
        <div class="container">
            <p>&copy; 2015 - MTI "Trash" team</p>
        </div>
    </footer>
</div>