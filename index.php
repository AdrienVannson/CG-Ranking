<!DOCTYPE HTML>
<html>
<head>
  <title>CG Ranks</title>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>

  <nav>
    <div class="nav-wrapper">
      <a href="#" class="brand-logo center">CG Ranks</a>
      <ul id="nav-mobile" class="hide-on-med-and-down right">
        <li><a>About</a></li>
      </ul>
    </div>
  </nav>

  <div class="container">

    <div class="row" style="margin-top: 22px;">
      <form class="col s12 m6">

        <div class="input-field col s6">
          <input id="pseudo" type="text" onkeydown="if (event.keyCode == 13) {addPlayer(this.value); return false;}">
          <label for="pseudo">Player's pseudo</label>
        </div>

        <div class="input-field col s6">
          <a class="waves-effect waves-light btn" onclick="addPlayer(document.getElementById('pseudo').value)">Search</a>
        </div>

      </form>
    </div>


    <canvas id="chart" width="400" height="200"></canvas>

  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>
