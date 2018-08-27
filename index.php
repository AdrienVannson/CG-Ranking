<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>CG Ranking</title>
    <meta name="description" content="CG-Ranking is a tool that shows the evolution of ranking during CodinGame contests."/>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

    <nav>
        <div class="nav-wrapper deep-purple">
            <a href="#" class="brand-logo center">CG Ranking</a>
            <ul id="nav-mobile" class="hide-on-med-and-down right">
                <li><a class="modal-trigger" href="#about">About</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">

        <div style="margin-top: 22px;">
            <form class="row">

                <div class="input-field col s8 m10 l6">
                    <input id="pseudo" type="text" onkeydown="if (event.keyCode == 13) {addPlayer(this.value); return false;}">
                    <label for="pseudo">Player's pseudo</label>
                </div>

                <div class="input-field col s4 m2 l6">
                    <a class="waves-effect waves-light btn deep-purple accent-4"
                    onclick="addPlayer(document.getElementById('pseudo').value)">Search</a>
                </div>

            </form>
        </div>


        <canvas id="chart"></canvas>
    </div>

    <div class="fixed-action-btn">
        <a class="btn-floating btn-large waves-effect modal-trigger deep-purple accent-4" href="#filters">
            <i class="large material-icons">mode_edit</i>
        </a>
    </div>

    <!-- Filters -->
    <div class="modal" id="filters">
        <div class="modal-content">
            <h2>Filters</h2>

            <form>
                <!--<div class="input-field">
                    <select>
                        <option value="" selected>Everything</option>
                        <option value="">Last 3 hours</option>
                        <option value="">Last 6 hours</option>
                        <option value="">Last 12 hours</option>
                        <option value="">Last 24 hours</option>
                        <option value="">Last 3 days</option>
                        <option value="">Last 5 days</option>
                    </select>
                    <label>Show only:</label>
                </div>-->

                <p>
                    <label>
                        <input type="checkbox" id="hideInProgress"/>
                        <span>Hide submissions in progress</span>
                    </label>
                </p>

                <p>
                    <label>
                        <input type="checkbox" id="showAgentID"/>
                        <span>Show agents IDs</span>
                    </label>
                </p>

            </form>
        </div>
        <div class="modal-footer">
            <a href="#" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
        </div>
    </div>

    <!-- About -->
    <div class="modal" id="about">
        <div class="modal-content">
            <h2>About CG Ranking</h2>
            <p>CG-Ranking is a tool that shows the evolution of ranking during CodinGame contests.</p>
            <p>Developed by Adrien VANNSON</p>
            <p>Contact: <a href="mailto:adrien.vannson@protonmail.com">adrien.vannson@protonmail.com</a>
        </div>
        <div class="modal-footer">
            <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat">Close</a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
