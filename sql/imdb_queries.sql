1. SELECT name FROM movies WHERE year = 1995;
2. SELECT COUNT(r.role) from movies m, roles r WHERE m.id = r.movie_id AND m.name = "Lost in Translation";
3. SELECT a.first_name, a.last_name from movies m, roles r, actors a WHERE m.id = r.movie_id AND a.id = r.actor_id AND m.name = "Lost in Translation";
4. SELECT d.first_name, d.last_name from movies m, directors d, movies_directors md WHERE m.id = md.movie_id AND d.id = md.director_id AND m.name = "Fight Club";
5. SELECT COUNT(m.name) from movies m, directors d, movies_directors md WHERE m.id = md.movie_id AND d.id = md.director_id AND d.first_name = "Clint" AND d.last_name = "Eastwood";
6. SELECT m.name from movies m, directors d, movies_directors md WHERE m.id = md.movie_id AND d.id = md.director_id AND d.first_name = "Clint" AND d.last_name = "Eastwood";
7. SELECT d.first_name, d.last_name from directors_genres dg, directors d WHERE genre = "Horror" AND dg.director_id = d.id;
8. SELECT a.first_name, a.last_name from movies m, roles r, actors a, movies_directors md, directors d WHERE d.first_name = "Christopher" AND d.last_name = "Nolan" AND d.id = md.director_id AND m.id = md.movie_id AND r.movie_id = m.id AND a.id = r.actor_id;