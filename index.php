<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>CG Ranks</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

    <nav>
        <div class="nav-wrapper deep-purple">
            <a href="#" class="brand-logo center">CG Ranks</a>
            <ul id="nav-mobile" class="hide-on-med-and-down right">
                <li><a class="modal-trigger" href="#about">About</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">

        <div style="margin-top: 22px;">
            <form class="row">

                <div class="input-field col s6 l3">
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
                </div>

                <div class="input-field col s6 l6">
                    <input id="pseudo" type="text" onkeydown="if (event.keyCode == 13) {addPlayer(this.value); return false;}">
                    <label for="pseudo">Player's pseudo</label>
                </div>

                <div class="input-field col s6 l2">
                    <a class="waves-effect btn-flat">Add filters</a>
                </div>

                <div class="input-field col s6 l1">
                    <a class="waves-effect waves-light btn deep-purple accent-4 right"
                    onclick="addPlayer(document.getElementById('pseudo').value)">Search</a>
                </div>

            </form>
        </div>


        <canvas id="chart" width="400" height="200"></canvas>
    </div>

    <!-- About -->
    <div class="modal" id="about">
        <div class="modal-content">
            <h2>About CG Ranks</h2>
            <p>Developed by Adrien VANNSON</p>
            <p>Contact: <a href="mailto:adrien.vannson@gmail.com">adrien.vannson@gmail.com</a>
        </div>
        <div class="modal-footer">
            <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat">Close</a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
