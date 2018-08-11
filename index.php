<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>CG Ranking</title>

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

                <!--<div class="input-field col s6 l3">
                    <select class="icons">
                        <option value="" data-icon="https://static.codingame.com/assets/league_wood_04.b7a42fec.png" selected>Wood 3</option>
                        <option value="" data-icon="https://static.codingame.com/assets/league_wood_04.b7a42fec.png">Wood 2</option>
                        <option value="" data-icon="https://static.codingame.com/assets/league_wood_04.b7a42fec.png">Wood 1</option>
                        <option value="" data-icon="https://static.codingame.com/assets/league_bronze_04.99f05c39.png">Bronze</option>
                        <option value="" data-icon="https://static.codingame.com/assets/league_silver_04.fe77a073.png">Silver</option>
                        <option value="" data-icon="https://static.codingame.com/assets/league_gold_04.588a6052.png">Gold</option>
                        <option value="" data-icon="https://static.codingame.com/assets/league_legend_04.5e7a7052.png">Legend</option>
                    </select>
                    <label>League</label>
                </div>-->

                <div class="input-field col s8 m10 l6">
                    <input id="pseudo" type="text" onkeydown="if (event.keyCode == 13) {addPlayer(this.value); return false;}">
                    <label for="pseudo">Player's pseudo</label>
                </div>

                <!--<div class="input-field col s6 l2">
                    <a class="waves-effect btn-flat modal-trigger" href="#filters">Add filters</a>
                </div>-->

                <div class="input-field col s4 m2 l6">
                    <a class="waves-effect waves-light btn deep-purple accent-4"
                    onclick="addPlayer(document.getElementById('pseudo').value)">Search</a>
                </div>

            </form>
        </div>


        <canvas id="chart"></canvas>
    </div>

    <!-- Filters -->
    <!--<div class="modal" id="filters">
        <div class="modal-content">
            <h2>Filters</h2>

            <form>
                <div class="input-field">
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
                </div>

                <div class="input-field">
                    <label>
                        <input type="checkbox"/>
                        <span>Hide computing submissions</span>
                    </label>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <a href="#" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
        </div>
    </div>-->

    <!-- About -->
    <div class="modal" id="about">
        <div class="modal-content">
            <h2>About CG Ranking</h2>
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
