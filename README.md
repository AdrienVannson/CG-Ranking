# CG Ranking

CG-Ranking is an online tool displaying the evolution of players' ranking on CodinGame.

To clear the database, run the following SQL command:

```SQL
DELETE cgranking_ranks
FROM cgranking_ranks
JOIN cgranking_games ON cgranking_games.id = cgranking_ranks.game
WHERE cgranking_games.isWatched
  AND cgranking_ranks.date < DATE "2019-01-01";
```
